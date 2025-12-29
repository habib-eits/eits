<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;

//export
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
class PartyLedgerExcel implements FromView,WithTitle,WithColumnWidths,WithStyles
{
   
    protected $PartyID;
    protected $PartyName;

    public function __construct($PartyID,$PartyName)
    {
         
        $this->PartyID = $PartyID;
        $this->PartyName = $PartyName;
    }



   public function styles(Worksheet $sheet)
    {
        // return [
        //     // Style the first row as bold text.
        //     1    => ['font' => ['bold' => true]],

        //     // Styling a specific cell by coordinate.
        //     'B2' => ['font' => ['italic' => true]],

        //     // Styling an entire column.
        //     'C'  => ['font' => ['size' => 16]],
        // ];


        $sheet->getStyle('A1:G1')->getFont()->setBold(true);
        $sheet->getStyle('B')->getFont()->setBold(true);
        $sheet->getStyle('5')->getFont()->setBold(true);
 $sheet->getStyle('D')->getAlignment()->setWrapText(true);


 $sheet->cell('A65', function($cell){
    $cell->setBorder('thin','thin','thin','thin');
});




    }



     public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 15,            
            'C' => 10,            
            'D' => 60,            
            'E' => 15,            
            'F' => 15,            
            'G' => 15,            
            'H' => 15,            
        ];
    }

     public function title(): string
    {
        return $this->PartyName;
    }


    public function view(): View
    {
 
$pagetitle = $this->PartyID;
 
    $sql = DB::table('journal')
    ->select( DB::raw('sum(if(ISNULL(Dr),0,Dr)-if(ISNULL(Cr),0,Cr)) as Balance'))
    ->where('PartyID',$this->PartyID)
    ->where('ChartOfAccountID',110400)
    ->where('Date','<','2022-11-01')
    // ->whereBetween('date',array($request->StartDate,$request->EndDate))
    ->get();
    

    $journal = DB::table('v_journal')
    ->where('PartyID',$this->PartyID)
    ->whereBetween('Date',array('2022-11-01',date('Y-m-d')))
        ->where('ChartOfAccountID',110400)
    ->get();


 
 
    $sql[0]->Balance = ($sql[0]->Balance ==null) ? '0' :  $sql[0]->Balance;

    return view ('export.party_sales_ledger',compact('journal','pagetitle','sql' ,));
      



    }

}



 




 
