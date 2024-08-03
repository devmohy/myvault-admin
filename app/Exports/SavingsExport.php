<?php

namespace App\Exports;

use App\Models\Savings;
use Illuminate\Contracts\View\View;
use App\Http\Resources\SavingsResource;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SavingsExport implements FromView, WithStyles, ShouldQueue
{
    public function view(): View
    {
        $savings = SavingsResource::collection(
            Savings::with('user')->whereDate('end_date','>',now())->get()
        );
        return view('exports.savings', [
            'savings' => $savings
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
