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
        $lectures = Schedule::where('hall', $screen->hall)->get();

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
        $day = today()->dayOfWeek;
        $screen = Screen::findOrFail($id);
        $lectures = Schedule::where([
            'hall' => $screen->hall,
            'day_index' => $day,
        ])
        ->get();

        dd($lectures->toArray());

        if (isset($lecture)) {
            $now = now();
            if ($now->greaterThanOrEqualTo($lecture->start) && $now->lessThanOrEqualTo($lecture->start)) {

            }
            dd($lecture->toArray());
        }
        dd('no lectures');

        return view('screens.monitor');
    }
}
