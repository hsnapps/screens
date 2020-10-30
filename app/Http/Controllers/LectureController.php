<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LectureController extends Controller
{
    public function index()
    {
        return view('schedules.index');
    }

    public function download()
    {
        $pathToFile = storage_path('files/lectures.xlsx');
        $name = __('schedules.file-name');
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ];

        return response()->download($pathToFile, $name, $headers);
    }
}
