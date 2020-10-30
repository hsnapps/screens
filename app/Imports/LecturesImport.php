<?php

namespace App\Imports;

use App\Lecture;
use Maatwebsite\Excel\Concerns\ToModel;

class LecturesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Lecture([
            //
        ]);
    }
}
