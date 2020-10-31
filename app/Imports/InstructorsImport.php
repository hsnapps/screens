<?php

namespace App\Imports;

use App\Instructor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\{
    ToCollection,
    WithHeadingRow
};
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class InstructorsImport implements ToCollection, WithHeadingRow
{
    public function __construct()
    {
        HeadingRowFormatter::default('none');
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Instructor::create([
                'computer_id' => $row['رقم المدرب'],
                'name' => $row['اسم المدرب'],
            ]);
        }
    }
}
