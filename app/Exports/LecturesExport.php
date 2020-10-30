<?php

namespace App\Exports;

use App\Lecture;
use Maatwebsite\Excel\Concerns\FromCollection;

class LecturesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Lecture::all();
    }
}
