<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BoqExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithEvents
{
    protected $id;
    protected $referenceNo;

    public function __construct($id)
    {
        $this->id = $id;
        $this->referenceNo = DB::table('estimate_master')->where('EstimateMasterID', $id)->value('ReferenceNo');
    }

    public function collection()
    {
        $estimate_details = DB::table('estimate_detail')
            ->where('EstimateMasterID', $this->id)
            ->get();

        return $estimate_details->map(function ($item) {
            return [
                DB::table('services')->where('id', $item->services_id)->value('name') ?? '-',
                $item->Description,
                $item->unit_net_cost,
                $item->vat_per_unit,
                $item->unit_with_vat,
                $item->LS == 'NO' ? $item->quantity : 'L/S',
                $item->unit_with_vat * $item->quantity,
            ];
        });
    }

    public function headings(): array
    {
        return [
            [
                "Reference No: {$this->referenceNo} | Date: " . now()->format('d-m-Y')
            ],
            [ // Actual table headers start from second row
                'Item Name',
                'Description',
                'Unit Cost',
                'VAT per Unit',
                'Unit with VAT',
                'Quantity',
                'Total Cost',
            ]
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
            2 => ['font' => ['bold' => true]], // Column headers row
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Merge and center the first row across 7 columns
                $event->sheet->mergeCells('A1:G1');
                $event->sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
                $event->sheet->getStyle('A1')->getFont()->setBold(true);
            },
        ];
    }
}
