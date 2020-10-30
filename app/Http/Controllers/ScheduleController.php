<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Imports\SchedulesImport;
use Maatwebsite\Excel\Facades\Excel;

class ScheduleController extends Controller
{
    public function index()
    {
        return view('schedules.index');
    }

    public function download()
    {
        $name = __('schedules.file-name').'.xlsx';
        return Excel::download(new LecturesExport, $name);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'excel' => 'required|mimes:xlsx|max:2048',
        ]);

        if ($request->hasFile('excel')) {
            if ($request->file('excel')->isValid()) {
                $extension = $request->excel->extension();
                $file_name = Str::random(10).'.'.$extension;
                $file_path = $request->excel->storeAs('', $file_name);

                $fingerprint = Str::random(40);
                $user_name = $request->user()->name;
                Excel::import(new SchedulesImport($fingerprint, $user_name), $file_path);

                if (file_exists($file_path)) {
                    unlink($file_path);
                }

                return back()->with('success', __('schedules.excel-uploaded'));
            } else {
                return back()->with('error', __('schedules.excel-invalid'));
            }
        }
    }
}
