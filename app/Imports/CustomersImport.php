<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;

class CustomersImport implements ToModel
{
    use Importable;

    public function model(array $row)
    {
        return new Customer([
            'fname' => $row[0],
            'lname' => $row[1],
            'company' => $row[2],
            'address' => $row[3],
            'phone' => $row[4],
            'email' => $row[5],
        ]);
    }
}
