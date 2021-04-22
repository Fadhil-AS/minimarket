<?php

namespace App\Exports;

use App\Models\Penarikan;
use Maatwebsite\Excel\Concerns\FromCollection;

class PenarikanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Penarikan::all();
    }
}
