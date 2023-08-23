<?php
namespace App\Imports;
use App\Exports\ExcelDataExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelGenerate{
    public static function generateNewSheet($processedData){
        $newFilePath = storage_path('new_excel_file.xlsx');
        Excel::store(new ExcelDataExport($processedData), $newFilePath);
 
    }
}