<?php

namespace App\Http\Controllers;

use App\Screen;
use App\Schedule;
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
        return view('screens.monitor', ['screen' => $id]);
    }

    public function getMonitorContnet($id)
    {
        $day = today()->dayOfWeek;
        $screen = Screen::findOrFail($id);
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
            return view('monitor.lecture', ['lecture' => $current])->render();
        }

        return 'no lectures';
    }
}
