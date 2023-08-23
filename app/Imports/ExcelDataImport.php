<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ExcelDataImport implements ToArray, WithHeadingRow
{
    public function array(array $row)
    {
        // Process each row's data if needed
        return $row;
    }
}
