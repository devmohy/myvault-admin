<?php

namespace App\Http\Controllers\Export;

use App\Exports\SavingsChargedTodayExport;
use Illuminate\Http\Request;
use App\Exports\SavingsExport;
use App\Exports\SavingsToChargedExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class SavingsExportController extends Controller
{
    public function export() 
    {
        $filePath = time()."_savings.xlsx";

        Excel::store(new SavingsExport, $filePath, 'public');
    
        return response()->json([
            'file_path' =>  asset('storage/'.$filePath),
            'file_name' => $filePath
        ]);
    }

    public function chargedToday() 
    {
        $filePath = date("Y-m-d H:i:s")."Savings_Charged_Today.xlsx";

        Excel::store(new SavingsChargedTodayExport, $filePath, 'public');
    
        return response()->json([
            'file_path' =>  asset('storage/'.$filePath),
            'file_name' => $filePath
        ]);
    }

    public function toBeChargedToday() 
    {
        $filePath = date("Y-m-d H:i:s")."Savings_Charged_Today.xlsx";

        Excel::store(new SavingsToChargedExport, $filePath, 'public');
    
        return response()->json([
            'file_path' =>  asset('storage/'.$filePath),
            'file_name' => $filePath
        ]);
    }
}
