<?php

namespace App\Exports;

use App\Enum\TransactionGroup;
use App\Enum\TransactionStatus;
use App\Models\Savings;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use App\Http\Resources\SavingsResource;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SavingsChargedTodayExport implements  FromView, WithStyles
{
    public function view(): View
    {
       
        $savings = Transaction::whereTrxGroup(TransactionGroup::SAVINGS)->status(TransactionStatus::SUCCESSFUL)->whereNull('payment_type')->with('user','savings')->whereDate('created_at', today())->get();
        return view('exports.savings-charged-today', [
            'transactions' => $savings
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        // Apply bold font to header row (row 1)
        $sheet->getStyle('A1:Z1')->applyFromArray(['font' => ['bold' => true]]);
    
        // Apply background color to header row (row 1)
        $sheet->getStyle('A1:Z1')->applyFromArray(['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => 'F0F0F0']]]);
    
        // Autofit columns A to Z
        foreach (range('A', 'Z') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    
        // Set the format code to treat the entire range as text
        $sheet->getStyle('A2:Z' . $sheet->getHighestRow())
              ->getNumberFormat()
              ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
    }
}
