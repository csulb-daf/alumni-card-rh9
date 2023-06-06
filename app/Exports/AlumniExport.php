<?php

namespace App\Exports;
use App\Alumni;

use Maatwebsite\Excel\Concerns\FromCollection;

class AlumniExport implements FromCollection
{
    public function collection()
    {
        return Alumni::all();
    }
}
