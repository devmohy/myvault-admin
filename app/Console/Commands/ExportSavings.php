<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SavingsChargedTodayExport;
use App\Exports\SavingsExport;

class ExportSavings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:export-savings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        echo "Start Exporting \n";

        $filePath = date("Y-m-d H:i:s")."_Savings.xlsx";
        // Excel::store(new SavingsChargedTodayExport, $filePath, 'public');
        Excel::store(new SavingsExport, $filePath, 'public');
        echo "Complete Exporting \n";
    
        
    }
}
