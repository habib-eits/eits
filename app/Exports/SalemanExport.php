<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SalemanExport implements WithMultipleSheets
{
   

 
    protected $city;

    public function __construct($city)
    {
      
        $this->City = $city;
    }
  

    public function sheets(): array
    {

       $party = DB::table('party')->select('PartyName','PartyID')->where('City',$this->City)->whereNotNull('City')->get();

        $sheets = [];

         foreach($party as $key => $value){
            $sheets[] = new PartyLedgerExcel($value->PartyID,$value->PartyName);
          
			}
        return $sheets;
    }
}