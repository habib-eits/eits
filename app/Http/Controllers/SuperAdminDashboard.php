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

class SuperAdminDashboard extends Controller
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
    
            $leads_updated_today =  DB::table('leads')
           
            ->whereDate('updated_at', $today)
            ->count();
          
            $pagetitle = 'Dashboard';
    
            $invoice_master = DB::table('invoice_master')
                ->select(DB::raw('ifnull(sum(IFNULL(Grandtotal,0)),0) as Paid'))->where('Date', date('Y-m-d'))->get();
    
    
            $sale = DB::table('v_journal')
                ->select(DB::raw('sum(if(ISNULL(Cr),0,Cr))-sum(if(ISNULL(Dr),0,Dr)) as Total'))
                ->WhereIn('ChartOfAccountID', [410175, 410100])
                ->where(DB::raw('DATE_FORMAT(Date,"%Y-%m")'), date('Y-m'))
                ->get();
    
    
            $v_cashflow = DB::table('v_cashflow')->get();
            $data = array();
    
            foreach ($v_cashflow as $key => $value) {
    
                $cashflow_chart[] = $value->Balance;
            }
    
            $expense = DB::table('v_journal')
                ->select(DB::raw('sum(if(ISNULL(Dr),0,Dr))-sum(if(ISNULL(Cr),0,Cr)) as Balance'))
                ->where('CODE', 'E')
                ->where(DB::raw('DATE_FORMAT(Date,"%Y-%m")'), date('Y-m'))
                ->get();
    
            $revenue = DB::table('v_journal')
                ->select(DB::raw('sum(if(ISNULL(Cr),0,Cr))-sum(if(ISNULL(Dr),0,Dr)) as Balance'))
                ->where('CODE', 'R')
                ->where(DB::raw('DATE_FORMAT(Date,"%Y-%m")'), date('Y-m'))
                ->get();
    
    
            $r = DB::table('v_journal')
                ->select(DB::raw('sum(if(ISNULL(Cr),0,Cr))-sum(if(ISNULL(Dr),0,Dr)) as Balance'))
                ->where(DB::raw('DATE_FORMAT(Date,"%Y-%m")'), date('Y-m'))
                ->where('CODE', 'R')
                ->get();
    
    
            $e = DB::table('v_journal')
                ->select(DB::raw('sum(if(ISNULL(Dr),0,Dr))-sum(if(ISNULL(Cr),0,Cr)) as Balance'))
                ->where(DB::raw('DATE_FORMAT(Date,"%Y-%m")'), date('Y-m'))
                ->where('CODE', 'E')
                ->get();
    
    
            $r = ($r[0]->Balance == null) ? '0' :  $r[0]->Balance;
            $e = ($e[0]->Balance == null) ? '0' :  $e[0]->Balance;
    
            $profit_loss = $r - $e;
    
    
            $cash = DB::table('v_journal')
                ->select('ChartOfAccountName',  DB::raw('sum(if(ISNULL(Dr),0,Dr)) - sum(if(ISNULL(Cr),0,Cr)) as Balance'))
                ->whereIn('ChartOfAccountID', [110101, 110200, 110201, 110250])
                // ->where('ChartOfAccountID',$request->ChartOfAccountID)
                ->groupBy('ChartOfAccountName')
                ->get();
    
    
            $cash1 = DB::table('v_rev_exp_chart')->get();
            // $exp_chart = DB::table('v_expense_chart')->where('MonthName','February-2022')->get();
    
    
    
            // 'exp_chart'
            return view('super_admin_dashboard', compact('pagetitle', 'v_cashflow', 
            'invoice_master', 'expense', 'revenue', 'profit_loss', 'cash', 'cash1', 
            'sale','total_booking','total_leads','leads_won','leads_lost',
            'leads_pending','leads_not_assigned','leads_reject',
            'booking_payment','agents','leadsNotUpdatedIn4Days',
        'leads_created_today','leads_updated_today'));
        
    
    
    }
}
