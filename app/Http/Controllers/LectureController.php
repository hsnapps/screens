<?php

namespace App\Http\Controllers;

use App\Lecture;
use App\Exports\LecturesExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LectureController extends Controller
{
    public function index()
    {
        return view('schedules.index');
    }

    public function download()
    {
        $name = __('lectures.file-name').'.xlsx';

        // $blank = [''];
        // $lectures = array_merge($blank, __('timing.lectures'));
        // $start = new \DateTime(today()->toDateTimeString());
        // $end = new \DateTime(today()->addMonth()->toDateTimeString());
        // $days = [1, 2, 3, 4, 7];
        // $data = [];

        // array_push($data, $lectures);

        // while ($start < $end) {
        //     if (in_array($start->dayOfWeekIso, $days)) {
        //         array_push($data, [$start->format('Y-m-t')]);
        //     }

        //     $interval = new \DateInterval('P1D');
        //     $start->add($interval);
        // }

        // date_default_timezone_set('Asia/Riyadh');
        // $d = new \DateTime(today()->toDateTimeString());
        // $interval = new \DateInterval('P5D');
        // $d->add($interval);

        // dd($d->format('Y-m-d'));

        return Excel::download(new LecturesExport, $name);
    }
}
