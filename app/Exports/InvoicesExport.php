<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;

class InvoicesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Invoice::all();
        return Invoice::select('invoice_number', 'invoice_Date', 'Due_date','Total', 'Status')->get();
    }
}
