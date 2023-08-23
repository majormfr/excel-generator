<?php

namespace App\Http\Controllers;

use App\Imports\ExcelGenerate;
use Illuminate\Http\Request;
use App\Http\Traits\CurlTrait;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelDataImport;
class SpreadsheetController extends Controller
{
    //
    use CurlTrait;

    public function index(){
        //generate zip codes
        //read file here
        $file =  public_path('Zipcodes_needed.xlsx');
        $data = Excel::toArray(new ExcelDataImport, $file)[0];
$response = [];
foreach($data as $k=>$v){
    if($k ==3){
        break;
    }
        $stringified_zip = $this->curl_get("https://www.".$v['product_name']."/wp-json/form-ping-post/v1/theme-settings",'{
            "all_or_once":"zip_code"
        }');
        print_r($stringified_zip);
        try{
        $response[] = [$v['product_name'],json_decode($stringified_zip)[0]];
        }catch(\Exception $ex){
            continue;
        }
        catch(\Error $err){
            continue;
        }
    }

        ExcelGenerate::generateNewSheet($response);
        return $response;
        }
}
