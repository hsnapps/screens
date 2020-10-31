<?php

namespace App\Http\Controllers;

use App\{Instructor, Schedule};
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Imports\ExcelImport;
use App\Exports\SchedulesExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ScheduleController extends Controller
{
    public function index()
    {
        return view('schedules.index', [
            'rows' => Schedule::paginate(),
        ]);
    }

    public function download()
    {
        $name = __('schedules.file-name').'.xlsx';
        return Excel::download(new SchedulesExport, $name);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'excel' => 'required|mimes:xlsx|max:2048',
        ]);

        if ($request->hasFile('excel')) {
            if ($request->file('excel')->isValid()) {
                DB::beginTransaction();

                $extension = $request->excel->extension();
                $file_name = Str::random(10).'.'.$extension;
                $file_path = $request->excel->storeAs('excel', $file_name);

                Instructor::truncate();
                Schedule::truncate();

                Excel::import(new ExcelImport(), $file_path);

                $files = Storage::disk('excel')->files();
                foreach ($files as $f) {
                    Storage::disk('excel')->delete($f);
                }

                DB::commit();

                return back()->with('success', __('schedules.excel-uploaded'));
            } else {
                return back()->with('error', __('schedules.excel-invalid'));
            }
        }
    }
}
