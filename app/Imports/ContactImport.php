<?php

namespace App\Imports;

use App\Models\Contact as ModelsContact;
use App\Models\Models\Contact;
use Maatwebsite\Excel\Concerns\ToModel;

class ContactImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ModelsContact([
            'name' => $row[0] ?? '',
            'email' => $row[1] ?? '',
            'phone' => $row[2] ?? '',

        ]);
    }
}
