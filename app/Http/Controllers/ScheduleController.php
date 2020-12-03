<?php

namespace App\Http\Controllers;

use App\{Instructor, Schedule};
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Imports\ExcelImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        abort_if(!$request->user()->is_admin, 403);

        return view('schedules.index', [
            'rows' => Schedule::paginate(),
            'title' => 'الجداول',
        ]);
    }

    public function download(Request $request)
    {
        abort_if(!$request->user()->is_admin, 403);

        $name = 'الجدول التدريبي الشامل.xlsx';
        $pathToFile = storage_path('files/excel.xlsx');
        return response()->download($pathToFile, $name);
    }

    public function upload(Request $request)
    {
        abort_if(!$request->user()->is_admin, 403);

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

                try {
                    Excel::import(new ExcelImport(), $file_path);
                } catch (ValidationException $e) {
                    DB::rollBack();
                    $failures = $e->failures();
                    foreach ($failures as $failure) {
                        return back()->with('warning',  __('excel.failure', ['row' => $failure->row(), 'attribute' => $failure->attribute()]));
                    }
                }

                $files = Storage::disk('excel')->files();
                foreach ($files as $f) {
                    Storage::disk('excel')->delete($f);
                }

                $request->user()->logs()->create([
                    'screen_id' => 0,
                    'message' => __('logs.schedules'),
                ]);

                DB::commit();

                return back()->with('success', __('schedules.excel-uploaded'));
            } else {
                return back()->with('error', __('schedules.excel-invalid'));
            }
        }
    }
}
