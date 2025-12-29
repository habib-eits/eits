<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ExcelLedger implements WithMultipleSheets
{
   


  

    public function sheets(): array
    {

       $party = DB::table('party')->select('City')->distinct()->whereNotNull('City')->get();

        
       if($party)
       {
       	 dd('No data found');
       }


        $sheets = [];

        


         foreach($party as $key => $value){
            $sheets[] = new PartyBalanceExcel('2021-01-01','2023-12-31',$value->City);
          
			}
        return $sheets;
    }
}