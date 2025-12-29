<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
// for API data receiving from http source
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;

// use Datatables;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
// for excel export
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
// end for excel export
use Illuminate\Support\Arr;

use Session;
use DB;
use URL;
use Image;
use File;
use PDF;
use Illuminate\Support\Facades\Hash;

use Maatwebsite\Excel\Facades\Excel;

use App\Exports\ExcelLedger;
use App\Exports\PartyBalanceExcel;

use App\Exports\SalemanExport;
use App\Exports\PartyLedgerExcel;
class AgentDashboard extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
   
    {
       
        session::put('menu', 'Dashboard');



        $total_booking = DB::table('bookings')
        ->where(DB::raw('DATE_FORMAT(start,"%Y-%m-%d")'), date('Y-m-d'))
        ->count();


        $total_leads = DB::table('leads')
        // ->where(DB::raw('DATE_FORMAT(start,"%Y-%m-%d")'), date('Y-m-d'))
        ->where('agent_id',session::get('UserID'))
        ->count();

          $leads_reject = DB::table('leads')
        // ->where(DB::raw('DATE_FORMAT(start,"%Y-%m-%d")'), date('Y-m-d'))
        ->where('agent_id',session::get('UserID'))
        ->where('status','Rejected')
        ->count();

          $leads_pending = DB::table('leads')
        // ->where(DB::raw('DATE_FORMAT(start,"%Y-%m-%d")'), date('Y-m-d'))
        ->where('agent_id',session::get('UserID'))
        ->where('status','Pending')
        ->count();


         $leads_won = DB::table('leads')
        // ->where(DB::raw('DATE_FORMAT(start,"%Y-%m-%d")'), date('Y-m-d'))
        ->where('agent_id',session::get('UserID'))
        ->where('approved_status','Closed Won')
        ->count();
       
        $leads_lost = DB::table('leads')
        // ->where(DB::raw('DATE_FORMAT(start,"%Y-%m-%d")'), date('Y-m-d'))
        ->where('agent_id',session::get('UserID'))
        ->where('approved_status','Closed Lost')
        ->count();

        $leads_new = DB::table('leads')
        // ->where(DB::raw('DATE_FORMAT(start,"%Y-%m-%d")'), date('Y-m-d'))
        ->whereNull('agent_id')
        ->count();
        
        $today = Carbon::today();
        
        $leads_created_today = DB::table('leads')
        ->where('agent_id',session::get('UserID'))
        ->whereDate('created_at', $today)
        ->count();

        $leads_updated_today =  DB::table('leads')
        ->where('agent_id',session::get('UserID'))
        ->whereDate('updated_at', $today)
        ->count();
        
        $fourDaysAgo = Carbon::now()->subDays(4);
        $leadsNotUpdatedIn4Days = DB::table('leads')
            ->where('agent_id',session::get('UserID'))
            ->where('status','Pending')
            ->where('updated_at', '<', $fourDaysAgo)->count();
       

        $booking_payment = DB::table('v_bookings_admin')->where('amount','>',0)->where('status','Pending')->count();

        
        // dd( storage_path());

        // $encrypted = Crypt::encryptString('Hello DevDojo');
        // print_r($encrypted);
        //     echo "<br>";
        // $encrypted = crypt::decryptString($encrypted);
        // print_r($encrypted);
        //     die;
        // if(session::get('UserType')=='OM')
        //              {

        //                return redirect('Login')->with('error','Access Denied!')->with('class','success');

        //              }
        $pagetitle = 'Dashboard';

       

        // 'exp_chart'
        return view('agent_dashboard', compact('pagetitle', 'total_booking','total_leads','leads_won',
        'leads_lost','leads_pending','leads_new','leads_reject',
        'booking_payment','leadsNotUpdatedIn4Days','leads_created_today','leads_updated_today'));
    }
    
}
