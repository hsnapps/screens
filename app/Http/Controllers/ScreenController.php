<?php

namespace App\Http\Controllers;

use App\Screen;
use App\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ScreenController extends Controller
{
    public function index(Request $request)
    {
        $buttonText = $request->user()->is_admin ? __('screens.add-global') : __('screens.add-mine');
        $screens = Screen::all();

        return view('screens.index', [
            'title' => __('screens.title'),
            'button' => $buttonText,
            'screens' => $screens,
        ]);
    }

    public function add(Request $request)
    {
        // dd($request->all());

        Screen::create([
            'id' => $request->id,
            'fingerprint' => Str::random(80),
            'hall' => $request->hall,
        ]);

        return back()->with('success', __('screens.added'));
    }

    public function delete(Request $request, Screen $screen)
    {
        if ($request->isMethod('DELETE')) {
            $screen->delete();
            return redirect()->route('screens.index');
        }

        return back();
    }

    public function show(Request $request, Screen $screen)
    {
        $show = false;
        if($request->user()->is_admin) {
            $show = true;
        } else {
            if (isset($screen->user)) {
                if ($screen->user->id == $request->user()->id) {
                    $show = true;
                }
            }
        }

        abort_if(!$show, 403);

        $lectures = Schedule::where('hall', $screen->hall)
            ->orderBy('day_index', 'asc')
            ->orderBy('start', 'asc')
            ->get();

        return view('screens.show', [
            'title' => __('screens.screen', ['number' => $screen->id]),
            'screen' => $screen,
            'lectures' => $lectures,
        ]);
    }

    public function update(Request $request, Screen $screen)
    {
        $screen->hall = $request->hall;
        $screen->save();

        return back()->with('success', __('screens.updated'));
    }

    public function minitor($id)
    {
        $screen = Screen::findOrFail($id);
        $fingerprint = $screen->fingerprint;

        return view('screens.monitor', [
            'screen' => $id,
            'fingerprint' => $fingerprint,
        ]);
    }

    /**
     * API Get Request
     * @param int $id
     * @return string
     */
    public function getMonitorContnet(Request $request)
    {
        $screen = Screen::findOrFail($request->screen);
        $fingerprint = $screen->fingerprint;

        // Check For Text Announcements
        if(isset($screen->content_start) && isset($screen->content_end)) {
            // If content_end greater than now remove timings and change fingerprint
            if (now()->greaterThanOrEqualTo($screen->content_end)) {
                $screen->content_start = null;
                $screen->content_end = null;
                $screen->fingerprint = Str::random(80);
                $screen->save();
            } else {
                $announcements = $screen->announcements()->where([
                    ['is_active', '=', true],
                    ['type', '=', 'text'],
                ])->get();
                $html = view('monitor.announcements', ['announcements' => $announcements])->render();
                return json_encode([
                    'html' => $html,
                    'fingerprint' => $fingerprint,
                ]);
            }
        }

        // Check For Lectures
        $day = today()->dayOfWeek;
        $lectures = Schedule::where([
            'hall' => $screen->hall,
            'day_index' => $day,
        ])
        ->get();
        $current = null;
        $now = now();
        foreach ($lectures as $lecture) {
            if($now >= $lecture->start && $now <= $lecture->end) {
                $current = $lecture;
                break;
            }
        }
        if (isset($current)) {
            // Change the fingerprint if the lecture end greater than or equals the screen's last update
            if ($current->end->greaterThanOrEqualTo($screen->updated_at)) {
                $screen->fingerprint = Str::random(80);
                $screen->save();
            }

            $html = view('monitor.lecture', ['lecture' => $current])->render();

            return json_encode([
                'html' => $html,
                'fingerprint' => $fingerprint,
            ]);
        }


        // Check For Othrt Announcements
        if(isset($screen->content_start) && isset($screen->content_end)) {
            // If content_end greater than now remove timings and change fingerprint
            if (now()->greaterThanOrEqualTo($screen->content_end)) {
                $screen->content_start = null;
                $screen->content_end = null;
                $screen->fingerprint = Str::random(80);
                $screen->save();
            } else {
                $announcements = $screen->announcements()->where([
                    ['is_active', '=', true],
                    ['type', '!=', 'text'],
                ])->get();
                $html = view('monitor.announcements', ['announcements' => $announcements])->render();
                return json_encode([
                    'html' => $html,
                    'fingerprint' => $fingerprint,
                ]);
            }
        }

    RETURN_DEFAULT:
        // Return default
        $html = view('monitor.default')->render();
        return json_encode([
            'html' => $html,
            'fingerprint' => $fingerprint,
        ]);
    }

    public function updateTimes(Request $request, Screen $screen)
    {
        $screen->content_start = Carbon::parse($request->content_start);
        $screen->content_end = Carbon::parse($request->content_end);
        $screen->save();

        return back()->with('success', __('announcements.update'));
    }

    public function removeTimes(Screen $screen)
    {
        $screen->content_start = null;
        $screen->content_end = null;
        $screen->save();

        return back()->with('success', __('announcements.update'));
    }
}
