<?php

namespace App\Exports;

use App\Models\Contact as ModelsContact;
use App\Models\Guest;
use App\Models\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;

class ContactExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Excel::download(new ContactExport, 'merged.xlsx');
    }
}
