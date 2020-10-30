<?php

namespace App\Http\Controllers;

use App\Timing;
use Illuminate\Http\Request;

class TimingController extends Controller
{
    public function show()
    {
        return view('timing', [
            'title' => __('timing.title')
        ]);
    }

    public function update(Request $request)
    {
        // dd($request->all());

        $start = $request->start;
        $end = $request->end;

        if ($request->morning == '1') {
            $times = Timing::where('morning', true)->orderBy('lecture')->get();
            for ($i=0; $i < count($start); $i++) {
                $times[$i]->start = $start[$i];
                $times[$i]->end = $end[$i];
                $times[$i]->save();
            }
        }

        if ($request->morning == '0') {
            $times = Timing::where('morning', false)->orderBy('lecture')->get();
            for ($i=0; $i < count($start); $i++) {
                $times[$i]->start = $start[$i];
                $times[$i]->end = $end[$i];
                $times[$i]->save();
            }
        }

        return back()->with('success', __('timing.update-confirmation'));
    }
}
