<?php

namespace App\Http\Controllers;

use App\Screen;
use App\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScreenController extends Controller
{
    public function index()
    {
        return view('screens.index', [
            'title' => __('screens.title'),
        ]);
    }

    public function show(Screen $screen)
    {
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
        $interval = 60 * 1000;
        return view('screens.monitor', [
            'screen' => $id,
            'interval' => $interval,
        ]);
    }

    /**
     * API Get Request
     * @param int $id
     * @return string
     */
    public function getMonitorContnet($id) : string
    {
        $screen = Screen::findOrFail($id);
        $interval = 60 * 1000;

        // Check For Announcements
        $announcements = $screen->announcements()->where('is_active', true)->get();
        if ($announcements->count() > 0 && isset($screen->content_start)) {
            $begin = $screen->content_start;
            $interval = $begin->diffInRealMilliseconds($screen->content_end);
            $html = view('monitor.announcements', ['announcements' => $announcements])->render();

            return json_encode([
                'html' => $html,
                'interval' => $interval,
            ]);
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
            $begin = now();
            $end = $current->end;
            $interval = $begin->diffInRealMilliseconds($end);
            $html = view('monitor.lecture', ['lecture' => $current])->render();

            return json_encode([
                'html' => $html,
                'interval' => $interval,
            ]);
        }

        // Return default
        $html = view('monitor.default')->render();
        return json_encode([
            'html' => $html,
            'interval' => $interval,
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
