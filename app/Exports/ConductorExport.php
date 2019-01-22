<?php

namespace App\Exports;

use App\Conductor;
use Maatwebsite\Excel\Concerns\FromCollection;

class ConductorExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Conductor::all();
    }
}
