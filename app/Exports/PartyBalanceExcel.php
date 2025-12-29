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

class PartyBalanceExcel implements FromView,WithTitle
{
    protected $StartDate;
	protected $EndDate;
    protected $City;

    public function __construct($StartDate,$EndDate,$City)
    {
        $this->StartDate = $StartDate;
        $this->EndDate = $EndDate;
        $this->City = $City;
    }


    public function headings(): array
    {
        return [
            '#',
            'Date',
            'COA',
            'Chart of Account Name',
         
        ];
    }


    // from view or query excel file will be generated
    // public function collection()
    // {	

    // 	$journal=DB::table('v_journal')->whereBetween('Date',array($this->StartDate,$this->EndDate) )->get();
    //     return  ($journal);
    // }


 public function title(): string
    {
        return $this->City;
    }


    public function view(): View
    {
 $pagetitle='Party Balance';


       $city = DB::table('party')->select('City')->distinct()->whereNotNull('City')->where('City',$this->City)->get();

        return view('export.party_ledger_excel', compact('city','pagetitle'));
    }

}



 




 
