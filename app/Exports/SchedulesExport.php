<?php

namespace App\Exports;

use App\Schedule;
use Maatwebsite\Excel\Concerns\FromCollection;

class SchedulesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Schedule::all();
    }
}
