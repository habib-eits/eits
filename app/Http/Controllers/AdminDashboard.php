<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
// for API data receiving from http source
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
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

class AdminDashboard extends Controller
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
        
            ->count();
    
              $leads_reject = DB::table('leads')
        
            ->where('status','Rejected')
            ->count();
    
              $leads_pending = DB::table('leads')
        
            ->where('status','Pending')
            ->count();
    
    
             $leads_won = DB::table('leads')
        
            ->where('approved_status','Closed Won')
            ->count();
           
            $leads_lost = DB::table('leads')
        
            ->where('approved_status','Closed Lost')
            ->count();
    
            $leads_not_assigned = DB::table('leads')
            ->whereNull('agent_id')
            ->count();


            $leads_not_assigned = DB::table('leads')
            ->whereNull('agent_id')
            ->count();

            $fourDaysAgo = Carbon::now()->subDays(4);
            
            $leadsNotUpdatedIn4Days = DB::table('leads')
            ->where('status','Pending')
            ->where('updated_at', '<', $fourDaysAgo)->count();
           
   
            $booking_payment = DB::table('v_bookings_admin')->where('amount','>',0)->where('status','Pending')->count();
            
            $agents = DB::table('user')->where('UserType' , 'Agent')->get();
            // $agents = DB::table('user')
            // ->where('UserType', 'Agent')
            // ->select('user.*', 
            //     DB::raw('(SELECT COUNT(*) FROM bookings WHERE DATE_FORMAT(start, "%Y-%m-%d") = CURDATE()) as bookings_count'),
            //     DB::raw('(SELECT COUNT(*) FROM leads WHERE leads.agent_id = user.UserID) as leads_count'),
            //     DB::raw('(SELECT COUNT(*) FROM leads WHERE status = "Pending" AND leads.agent_id = user.UserID) as pending_leads_count'),
            //     DB::raw('(SELECT COUNT(*) FROM leads WHERE approved_status = "Closed Won" AND leads.agent_id = user.UserID) as leads_won_count'),
            //     DB::raw('(SELECT COUNT(*) FROM leads WHERE approved_status = "Closed Lost" AND leads.agent_id = user.UserID) as leads_lost_count'),
            //     DB::raw('(SELECT COUNT(*) FROM leads WHERE status = "Rejected" AND leads.agent_id = user.UserID) as rejected_leads_count')
            // )
            // ->get();

           
            $today = Carbon::today();
        
            $leads_created_today = DB::table('leads')
          
            ->whereDate('created_at', $today)
            ->count();
    
            $leads_updated_today = DB::table('leads')
            ->whereDate('updated_at', $today)
            ->count();
          
            $pagetitle = 'Dashboard';
    
            
    
    
            // 'exp_chart'
            return view('admin_dashboard', compact('pagetitle', 
            'total_booking','total_leads','leads_won','leads_lost',
            'leads_pending','leads_not_assigned','leads_reject',
            'booking_payment','agents','leadsNotUpdatedIn4Days',
            'leads_created_today','leads_updated_today'
        
        ));
        
    
    
    }
}