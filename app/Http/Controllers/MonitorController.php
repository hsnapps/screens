<?php

namespace App\Http\Controllers;

use App\Screen;
use App\Schedule;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    public function show(Request $request, $id = null)
    {
        if ($request->isMethod('POST')) {
            return redirect()->route('monitor', ['id' => $request->id]);
        }

        if (isset($id)) {
            $screen = Screen::findOrFail($id);

            return view('monitor.show', [
                'screen' => $id,
                'fingerprint' => $screen->fingerprint,
            ]);
        }

        return view('monitor.setup');
    }

    /**
     * API Get Request
     * @param int $id
     * @return string
     */
    public function getMonitorContnet(Request $request)
    {
        $screen = Screen::findOrFail($request->screen);

        // Text Announcements
        $textAnnouncements = $screen->announcements()->where([
            ['is_active', '=', true],
            ['type', '=', 'text'],
        ])->get();
        if($textAnnouncements->count() > 0) {
            $announcements = [];
            foreach ($textAnnouncements as $ann) {
                if (now()->lessThanOrEqualTo($ann->content_end)) {
                    array_push($announcements, $ann);
                }
            }
            if (count($announcements) > 0) {
                $html = view('monitor.announcements', ['announcements' => $announcements])->render();
                return json_encode([
                    'html' => $html,
                    'fingerprint' => $screen->fingerprint,
                ]);
            }
        }

        // Lectures
        $day = today()->dayOfWeek;
        $lectures = Schedule::where([
            'hall' => $screen->hall,
            'day_index' => $day,
        ])->get();
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
                'fingerprint' => $screen->fingerprint,
            ]);
        }

        // Check For Othrt Announcements
        $otherAnnouncements = $screen->announcements()->where([
            ['is_active', '=', true],
            ['type', '!=', 'text'],
        ])->get();
        if($otherAnnouncements->count() > 0) {
            $html = view('monitor.announcements', ['announcements' => $otherAnnouncements])->render();
            return json_encode([
                'html' => $html,
                'fingerprint' => $screen->fingerprint,
            ]);
        }

        // Return default
        $html = view('monitor.default')->render();
        return json_encode([
            'html' => $html,
            'fingerprint' => $screen->fingerprint,
        ]);
    }
}
