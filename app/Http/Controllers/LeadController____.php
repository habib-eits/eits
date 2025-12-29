<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Campaign;
use App\Models\Lead;
use App\Models\LeadDetails;
use App\Models\LeadActivity;
use App\Models\QualifiedStatus;
use App\Models\Service;
use App\Models\Status;
use App\Models\SubService;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;
use Session;
use Illuminate\Support\Arr; 

class LeadController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
   
         // dd(Carbon::now()->endOfQuarter()->format('Y-m-d'));
        try {

             
                $id=session::get('UserID');
            

                 $agents = DB::table('user')->where('UserType', 'Agent')->get();

            
                $statuses = Status::all();
                $Q_statuses = QualifiedStatus::all();
                $campaigns = Campaign::all();
                $data = Lead::with('branch', 'agent', 'campaign')
                    ->when($request->has('filter_status') && $request->filter_status != null, function ($query) use ($request) {
                        $query->where('status', $request->filter_status);
                    })
                    ->when($request->has('filter_agent_id') && $request->filter_agent_id != null, function ($query) use ($request) {
                        if ($request->filter_agent_id == '-1') {
                            $query->whereNull('agent_id');
                        } else {
                            $query->where('agent_id', $request->filter_agent_id);
                        }
                    })
                    ->when($request->has('filter_campaign_id') && $request->filter_campaign_id != null, function ($query) use ($request) {
                        if ($request->filter_campaign_id == '-1') {
                            $query->whereNull('campaign_id');
                        } else {
                            $query->where('campaign_id', $request->filter_campaign_id);
                        }
                    })
                    ->when($request->has('filter_last_updated') && $request->filter_last_updated != null, function ($query) use ($request) {
                        $updatedAt = $request->filter_last_updated;
                        if ($updatedAt == 'Today') {
                            $minUdate = Carbon::now()->format('Y-m-d');
                            $maxUdate = Carbon::now()->format('Y-m-d');
                        } elseif ($updatedAt == 'Yesterday') {
                            $minUdate = Carbon::now()->subDay()->format('Y-m-d');
                            $maxUdate = Carbon::now()->subDay()->format('Y-m-d');
                        } elseif ($updatedAt == '3') {
                            $minUdate = Carbon::now()->subDays(3)->format('Y-m-d');
                            $maxUdate = Carbon::now()->subDay()->format('Y-m-d');
                        } elseif ($updatedAt == 'week') {
                            $minUdate = Carbon::now()->startOfWeek()->format('Y-m-d');
                            $maxUdate = Carbon::now()->endOfWeek()->format('Y-m-d');
                        } elseif ($updatedAt == 'month') {
                            $minUdate = Carbon::now()->startOfMonth()->format('Y-m-d');
                            $maxUdate = Carbon::now()->endOfMonth()->format('Y-m-d');
                        } elseif ($updatedAt == 'last_month') {
                            $minUdate = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
                            $maxUdate = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
                        } elseif ($updatedAt == 'quarter') {
                            $minUdate = Carbon::now()->startOfQuarter()->format('Y-m-d');
                            $maxUdate = Carbon::now()->endOfQuarter()->format('Y-m-d');
                        } elseif ($updatedAt == 'year') {
                            $minUdate = Carbon::now()->startOfYear()->format('Y-m-d');
                            $maxUdate = Carbon::now()->endOfYear()->format('Y-m-d');
                        }
                        $query->whereBetween(DB::raw('DATE(updated_at)'), [$minUdate, $maxUdate]);
                    })
                    ->when($request->has('filter_creation_date') && $request->filter_creation_date != null, function ($query) use ($request) {
                        $createdAt = $request->filter_creation_date;
                        if ($createdAt == 'Today') {
                            $minCdate = Carbon::now()->format('Y-m-d');
                            $maxCdate = Carbon::now()->format('Y-m-d');
                        } elseif ($createdAt == 'Yesterday') {
                            $minCdate = Carbon::now()->subDay()->format('Y-m-d');
                            $maxCdate = Carbon::now()->subDay()->format('Y-m-d');
                        } elseif ($createdAt == '3') {
                            $minCdate = Carbon::now()->subDays(3)->format('Y-m-d');
                            $maxCdate = Carbon::now()->subDay()->format('Y-m-d');
                        } elseif ($createdAt == 'week') {
                            $minCdate = Carbon::now()->startOfWeek()->format('Y-m-d');
                            $maxCdate = Carbon::now()->endOfWeek()->format('Y-m-d');
                        } elseif ($createdAt == 'month') {
                            $minCdate = Carbon::now()->startOfMonth()->format('Y-m-d');
                            $maxCdate = Carbon::now()->endOfMonth()->format('Y-m-d');
                        } elseif ($createdAt == 'last_month') {
                            $minCdate = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
                            $maxCdate = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
                        } elseif ($createdAt == 'quarter') {
                            $minCdate = Carbon::now()->startOfQuarter()->format('Y-m-d');
                            $maxCdate = Carbon::now()->endOfQuarter()->format('Y-m-d');
                        } elseif ($createdAt == 'year') {
                            $minCdate = Carbon::now()->startOfYear()->format('Y-m-d');
                            $maxCdate = Carbon::now()->endOfYear()->format('Y-m-d');
                        }
                        $query->whereBetween(DB::raw('DATE(created_at)'), [$minCdate, $maxCdate]);
                    })
                    ->when($request->has('filter_min_created_at') && $request->filter_min_created_at != null && $request->has('filter_max_created_at') && $request->filter_max_created_at != null , function ($query) use ($request) {
                        $min_created_at = $request->filter_min_created_at;
                        $max_created_at = $request->filter_max_created_at;
                         $query->whereBetween(DB::raw('DATE(created_at)'), [$min_created_at, $max_created_at]);
                     })
                     ->when(
                        $request->has('filter_min_updated_at') && 
                        $request->filter_min_updated_at != null && 
                        $request->has('filter_max_updated_at') && 
                        $request->filter_max_updated_at != null, 
                        function ($query) use ($request) {
                            $min_updated_at = $request->filter_min_updated_at;
                            $max_updated_at = $request->filter_max_updated_at;
                    
                            $query->whereBetween(DB::raw('DATE(updated_at)'), [$min_updated_at, $max_updated_at])
                                  ->whereColumn('updated_at', '!=', 'created_at');
                        }
                    )
                    ->when($request->has('filter_Q_status') && $request->filter_Q_status != null, function ($query) use ($request) {
                        $query->where('approved_status', $request->filter_Q_status);
                    })
                    ->when(Session::get('UserType')== 'Agent', function ($query){
                        $query->where('agent_id', session::get('UserID'));

                    })
                        
                    
                   
                    ->orderByDesc('id')
                    ->get();

                    

                return view('leads.index', compact('agents', 'data', 'request', 'Q_statuses', 'statuses', 'campaigns'));
            // } else {
            //     // $agents = User:: where('UserType','Agent')->get();
            //     $data = Lead::with('branch', 'agent', 'campaign')
            //         ->where('agent_id', Auth::user()->id)
            //         ->orderByDesc('id')
            //         ->get();
            //     return view('leads.index', compact('data'));
            

            // return view('leads.index', compact('data'));
        } catch (\Exception $e) {
            dd( $e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }


    public function ajax_leads(Request $request)
    {
        // dd($request->all());
   
         // dd(Carbon::now()->endOfQuarter()->format('Y-m-d'));
        try {

            $id=session::get('UserID');
                

            $agents = DB::table('user')->where('UserType', 'Agent')->get();

        
            $statuses = Status::all();
            $Q_statuses = QualifiedStatus::all();
            $campaigns = Campaign::all();

            
                if($request->ajax()){

                    $data = Lead::with('branch', 'agent', 'campaign')
                        ->when($request->has('filter_status') && $request->filter_status != null, function ($query) use ($request) {
                            $query->where('status', $request->filter_status);
                        })
                        ->when($request->has('filter_agent_id') && $request->filter_agent_id != null, function ($query) use ($request) {
                            if ($request->filter_agent_id == '-1') {
                                $query->whereNull('agent_id');
                            } else {
                                $query->where('agent_id', $request->filter_agent_id);
                            }
                        })
                        ->when($request->has('filter_campaign_id') && $request->filter_campaign_id != null, function ($query) use ($request) {
                            if ($request->filter_campaign_id == '-1') {
                                $query->whereNull('campaign_id');
                            } else {
                                $query->where('campaign_id', $request->filter_campaign_id);
                            }
                        })
                        ->when($request->has('filter_last_updated') && $request->filter_last_updated != null, function ($query) use ($request) {
                            $updatedAt = $request->filter_last_updated;
                            if ($updatedAt == 'Today') {
                                $minUdate = Carbon::now()->format('Y-m-d');
                                $maxUdate = Carbon::now()->format('Y-m-d');
                            } elseif ($updatedAt == 'Yesterday') {
                                $minUdate = Carbon::now()->subDay()->format('Y-m-d');
                                $maxUdate = Carbon::now()->subDay()->format('Y-m-d');
                            } elseif ($updatedAt == '3') {
                                $minUdate = Carbon::now()->subDays(3)->format('Y-m-d');
                                $maxUdate = Carbon::now()->subDay()->format('Y-m-d');
                            } elseif ($updatedAt == 'week') {
                                $minUdate = Carbon::now()->startOfWeek()->format('Y-m-d');
                                $maxUdate = Carbon::now()->endOfWeek()->format('Y-m-d');
                            } elseif ($updatedAt == 'month') {
                                $minUdate = Carbon::now()->startOfMonth()->format('Y-m-d');
                                $maxUdate = Carbon::now()->endOfMonth()->format('Y-m-d');
                            } elseif ($updatedAt == 'last_month') {
                                $minUdate = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
                                $maxUdate = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
                            } elseif ($updatedAt == 'quarter') {
                                $minUdate = Carbon::now()->startOfQuarter()->format('Y-m-d');
                                $maxUdate = Carbon::now()->endOfQuarter()->format('Y-m-d');
                            } elseif ($updatedAt == 'year') {
                                $minUdate = Carbon::now()->startOfYear()->format('Y-m-d');
                                $maxUdate = Carbon::now()->endOfYear()->format('Y-m-d');
                            }
                            $query->whereBetween(DB::raw('DATE(updated_at)'), [$minUdate, $maxUdate]);
                        })
                        ->when($request->has('filter_creation_date') && $request->filter_creation_date != null, function ($query) use ($request) {
                            $createdAt = $request->filter_creation_date;
                            if ($createdAt == 'Today') {
                                $minCdate = Carbon::now()->format('Y-m-d');
                                $maxCdate = Carbon::now()->format('Y-m-d');
                            } elseif ($createdAt == 'Yesterday') {
                                $minCdate = Carbon::now()->subDay()->format('Y-m-d');
                                $maxCdate = Carbon::now()->subDay()->format('Y-m-d');
                            } elseif ($createdAt == '3') {
                                $minCdate = Carbon::now()->subDays(3)->format('Y-m-d');
                                $maxCdate = Carbon::now()->subDay()->format('Y-m-d');
                            } elseif ($createdAt == 'week') {
                                $minCdate = Carbon::now()->startOfWeek()->format('Y-m-d');
                                $maxCdate = Carbon::now()->endOfWeek()->format('Y-m-d');
                            } elseif ($createdAt == 'month') {
                                $minCdate = Carbon::now()->startOfMonth()->format('Y-m-d');
                                $maxCdate = Carbon::now()->endOfMonth()->format('Y-m-d');
                            } elseif ($createdAt == 'last_month') {
                                $minCdate = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
                                $maxCdate = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
                            } elseif ($createdAt == 'quarter') {
                                $minCdate = Carbon::now()->startOfQuarter()->format('Y-m-d');
                                $maxCdate = Carbon::now()->endOfQuarter()->format('Y-m-d');
                            } elseif ($createdAt == 'year') {
                                $minCdate = Carbon::now()->startOfYear()->format('Y-m-d');
                                $maxCdate = Carbon::now()->endOfYear()->format('Y-m-d');
                            }
                            $query->whereBetween(DB::raw('DATE(created_at)'), [$minCdate, $maxCdate]);
                        })
                        ->when($request->has('filter_min_created_at') && $request->filter_min_created_at != null && $request->has('filter_max_created_at') && $request->filter_max_created_at != null , function ($query) use ($request) {
                            $min_created_at = $request->filter_min_created_at;
                            $max_created_at = $request->filter_max_created_at;
                            $query->whereBetween(DB::raw('DATE(created_at)'), [$min_created_at, $max_created_at]);
                        })
                        ->when(
                            $request->has('filter_min_updated_at') && 
                            $request->filter_min_updated_at != null && 
                            $request->has('filter_max_updated_at') && 
                            $request->filter_max_updated_at != null, 
                            function ($query) use ($request) {
                                $min_updated_at = $request->filter_min_updated_at;
                                $max_updated_at = $request->filter_max_updated_at;
                        
                                $query->whereBetween(DB::raw('DATE(updated_at)'), [$min_updated_at, $max_updated_at])
                                    ->whereColumn('updated_at', '!=', 'created_at');
                            }
                        )
                        ->when($request->has('filter_Q_status') && $request->filter_Q_status != null, function ($query) use ($request) {
                            $query->where('approved_status', $request->filter_Q_status);
                        })
                        ->when(Session::get('UserType')== 'Agent', function ($query){
                            $query->where('agent_id', session::get('UserID'));

                        })
                            
                        
                    
                        ->orderByDesc('id')
                        ->get();

                        return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('agent_name', function($row){
                           return ($row->agent) ? $row->agent->name: '-'; 
                        })
                        ->addColumn('created_at', function($row){
                            return dmY($row->created_at);
                        })
                        ->addColumn('updated_at', function($row){
                            if($row->created_at != $row->updated_at )
                                return dmY($row->updated_at);
                            else
                                return "-";
                        })
                        ->addColumn('service_name', function($row){
                            $service = DB::table('services')->where('id',$row->service_id)->first();
                            return ($service) ? $service->name : '-'; 
                        })
                        ->addColumn('total_margin', function($row){

                            if($row->BOQ_number){
                                $estimate_master = DB::table('estimate_master')
                                ->where('EstimateNo', $row->BOQ_number)
                                ->orderBy('EstimateMasterID', 'desc') // Order by the highest revision number
                                ->first(); 
                                return $estimate_master->total_margin; 
                            }
                            else return '-'; 
                            
                        })
                     
                        ->addColumn('grand_total', function($row){
                            if($row->BOQ_number){
                                $estimate_master = DB::table('estimate_master')
                                ->where('EstimateNo', $row->BOQ_number)
                                ->orderBy('EstimateMasterID', 'desc') // Order by the highest revision number
                                ->first();  
                                 return $estimate_master->GrandTotal; 
                            }
                            else return '-'; 
                            
                           
                        })
                        ->addColumn('boq_col', function($row){
                            if($row->BOQ_number){
                                // Fetch the latest estimate based on BOQ_number
                                $estimate_master = DB::table('estimate_master')
                                    ->where('EstimateNo', $row->BOQ_number)
                                    ->orderBy('EstimateMasterID', 'desc') // Order by the highest revision number
                                    ->first();
                                
                               
                             
                                    // Create the column content
                                    $col = '
                                        <a target="_blank" href="'.route('boqViewPDF', ['EstimateMasterID' => $estimate_master->EstimateMasterID, 'BranchID' => $estimate_master->BranchID]).'">
                                            <small>BOQ: </small> '.$row->BOQ_number.'
                                        </a><br>
                                        <a href="'.url('/EstimateViewPDF/' . $estimate_master->EstimateMasterID . '/' . $estimate_master->BranchID).'" target="_blank">
                                            <small>QUO: </small> '.$estimate_master->ReferenceNo.'
                                        </a>';
                               
                                
                                return $col;
                            } else {
                                return '-';
                            }
                        }) 

                        ->addColumn('actions', function($row){

                            $estimate_master = DB::table('estimate_master')
                                    ->where('EstimateNo', $row->BOQ_number)
                                    ->orderBy('EstimateMasterID', 'desc') // Order by the highest revision number
                                    ->first();


                            $editUrl = route('lead.edit', $row->id);
                            $viewUrl = route('lead.show', $row->id);
                            $deleteUrl = "javascript:void(0)";
                            $boqCreateUrl = $row->BOQ_number == NULL ? route('boq-create', $row->id) : '';
                        
                            $actions = '
                                <div class="d-flex align-items-center col-actions">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end"
                                            style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-33px, 27px);"
                                            data-popper-placement="bottom-end">
                                            <li><a href="'.$editUrl.'" class="dropdown-item">
                                                <i class="bx bx-pencil font-size-16 text-secondary me-1"></i></i>Edit Lead</a>
                                            </li>
                                            <li><a href="'.$viewUrl.'" class="dropdown-item">
                                                <i class="mdi mdi-eye-outline font-size-16 text-secondary me-1"></i>View Lead</a>
                                            </li>';
                        
                            // Conditionally show "Create BOQ" option if BOQ_number is null
                            if ($row->BOQ_number == NULL) {
                                $actions .= '<li><a href="'.$boqCreateUrl.'" class="dropdown-item">
                                                <i class="mdi mdi-eye-outline font-size-16 text-secondary me-1"></i>Create BOQ</a>
                                            </li>';
                            }
                        
                            $actions .= '<li><a href="'.$deleteUrl.'" onclick="delete_confirm_n(`leadDelete`, '.$row->id.')" class="dropdown-item">
                                            <i class="bx bx-trash font-size-16 text-danger me-1"></i></i>Delete Lead</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>';
                        
                            return $actions;
                        })

                        


                        ->rawColumns(['actions','boq_col'])
                        ->with('agents', $agents)
                        ->with('statuses', $statuses)
                        ->with('Q_statuses', $Q_statuses)
                        ->with('campaigns', $campaigns)
                        ->make(true);
                        return view('leads.index');
                    }    

                    

                return view('leads.index', compact('agents', 'request', 'Q_statuses', 'statuses', 'campaigns'));
            // } else {
            //     // $agents = User:: where('UserType','Agent')->get();
            //     $data = Lead::with('branch', 'agent', 'campaign')
            //         ->where('agent_id', Auth::user()->id)
            //         ->orderByDesc('id')
            //         ->get();
            //     return view('leads.index', compact('data'));
            

            // return view('leads.index', compact('data'));
        } catch (\Exception $e) {
            dd( $e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }





    public function create()
    {


        try {
            $branches = Branch::all();
            $services = Service::all();
            $subServices = SubService::all();

            $channel = DB::table('channel')->get();

            if(session::get('Type')=='Agent')
            {
            $agents = User::where('id', session::get('UserID'))->get();
            }    
            else
            {
            $agents = User:: where('UserType','Agent')->get();
          
            }
            $campaigns = Campaign::all();
            return view('leads.create', compact('branches', 'agents', 'services', 'subServices', 'campaigns','channel'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
    public function store(Request $request)
    {
       
         
         try {
            DB::beginTransaction();
            // $request->validate(
            //     [
            //         'name' => 'required|max:255',
            //         'tel' => 'required|max:255',
            //         'other_tel' => 'nullable|max:255',
            //         'bussiness_details' => 'nullable|max:255',
            //         'service' => 'nullable|max:255',
            //         'channel' => 'nullable|max:255',
            //         'amount' => 'nullable|numeric|regex:/^\d{1,18}(\.\d{1,3})?$/',
            //     ],
            //     [
            //         'amount.regex' => 'Please add a valid amount i-e number with max 18 digits (quintillion) and upto 3 decimal points.',
            //     ]
            // );
            // dd($request->all());
            // Manually set the timestamps
            $createdAt = Carbon::now();
            $updatedAt = Carbon::now();

                $leadData = array(
                'name' => $request->name,
                'tel' => $request->tel,
                'other_tel' => $request->other_tel,
                'business_details' => $request->business_details,
                'service' => $request->service,
                'channel' => $request->channel,
                'campaign_id' => $request->campaign_id,
                'branch_id' => $request->branch_id,
                'agent_id' => $request->agent_id,
                'service_id' => $request->service_id,
                'sub_service_id' => $request->sub_service_id,
                'currency' => $request->currency,
                'amount' => $request->amount,
                'created_at' => $createdAt,
                'updated_at' => NULL,
                // 'status' => isset($request->status) ? $request->status : $lead->status,
                // 'approved_status' => !isset($request->status) ? $request->qualified_status : ($request->status == 'Qualified' ? $request->qualified_status : null),

            );


 


            $data = array(
                            'PartyName' => $request->name, 
                            'Phone' => $request->tel, 
                            'Address' => $request->business_details,
                            
                            );
            

            $party = DB::table('party')->where('PartyName',$request->name)->get(); 

            if(count($party)==0)
            {

            $partyid= DB::table('party')->insertGetId($data);
            }
            else
            {
                $partyid = $party[0]->PartyID;;
            }


 
            $leadData = Arr::add($leadData, 'partyid', $partyid);


 

            $id_save= DB::table('leads')->insertGetId($leadData);
            
            
            



            DB::commit();
            return redirect('leads')->withSuccess('Lead Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
             dd($e->getMessage());
            return back()->with('error', $e->getMessage())->withInput();
        }
    }


    public function show($id)
    {
        try {
            $lead = Lead::with('branch','leadDetails.user', 'branchService', 'subService', 'agent', 'campaign')->findOrFail($id);
            // dd($lead);
            $lead_activities = LeadActivity::where('lead_id', $id)->get();
            return view('leads.view', compact('lead','lead_activities'));
        } catch (\Exception $e) {
            // DB::rollBack();
            // dd($e->getMessage());
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
    public function edit($id)
    {
 

        try {
            $lead = Lead::findOrFail($id);
            $branches = Branch::all();
            $statuses = Status::all();
            $Q_statuses = QualifiedStatus::all();
            $campaigns = Campaign::all();
            $channel = DB::table('channel')->get();
            $lead_activities = LeadActivity::where('lead_id', $id)
            ->orderBy('updated_at','desc')    
            ->get();

 

            if(session::get('Type')=='Agent')
            {

                if ($lead->branch_id != null) {
                $agents = DB::table('user')
                    ->where('id', session::get('UserID'))
                    // ->where('branch_id', $lead->branch_id)
                    ->get();
                    $services = Service::where('branch_id', $lead->branch_id)->get();
                } else {
                    $agents = User:: where('UserType','Agent')->get();
                    $services = Service::all();
                }
            }

            else

            {   
                if ($lead->branch_id != null) {
                $agents = User:: where('UserType','Agent')
                // ->where('branch_id', $lead->branch_id)
                ->get();
                $services = Service::where('branch_id', $lead->branch_id)->get();
                } else {
                    $agents = User:: where('UserType','Agent')->get();
                    $services = Service::all();
                }
            }    
         


            if ($lead->service_id != null) {
                $subServices = SubService::where('service_id', $lead->service_id)->get();
            } else {
                $subServices = SubService::all();
            }
            return view('leads.edit', compact('lead','lead_activities' ,'branches', 'agents', 'services', 'subServices', 'statuses', 'Q_statuses', 'campaigns','channel'));
        } catch (\Exception $e) {
            // DB::rollBack();
            // dd($e->getMessage());
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
    public function update(Request $request, $id)
    {   
        
      
     


         // dump($id);
          // dd($request->all());
        try {
            DB::beginTransaction();
            $request->validate(
                [
                    'name' => 'required|max:255',
                    'tel' => 'required|max:255',
                    'other_tel' => 'nullable|max:255',
                    'bussiness_details' => 'nullable|max:255',
                    'service' => 'nullable|max:255',
                    'channel' => 'nullable|max:255',
                    'amount' => 'nullable|numeric|regex:/^\d{1,18}(\.\d{1,3})?$/',
                ],
                [
                    'amount.regex' => 'Please add a valid amount i-e number with max 18 digits (quintillion) and upto 3 decimal points.',
                ]
            );


            $lead = Lead::findOrFail($id);  
            $current_time = Carbon::now();

            $leadData = [
                'name' => $request->name,
                'tel' => $request->tel,
                'other_tel' => $request->other_tel,
                'business_details' => $request->business_details,
                'service' => $request->service,
                'channel' => $request->channel,
                'campaign_id' => $request->campaign_id,
                'branch_id' => $request->branch_id,
                'agent_id' => $request->agent_id,
                'service_id' => $request->service_id,
                'sub_service_id' => $request->sub_service_id,
                'currency' => $request->currency,
                'amount' => $request->amount,
                'status' => isset($request->status) ? $request->status : $lead->status,
                // 'approved_status' =>  $request->qualified_status,
                'approved_status' => !isset($request->status)
                    ? $request->qualified_status
                    : ($request->status == 'Qualified' ? $request->qualified_status : null),

                'updated_at' => $lead->updated_at,
                'remarks' => $request->remarks,
            ];


            $note = [];
            $needsUpdate = false;

            if ($lead->status != $leadData["status"]) {
                $note[] = "status: " . $lead->status . " -> " . $leadData["status"];
                $needsUpdate = true;
            }

            if ($lead->approved_status != $leadData["approved_status"]) {
                $note[] = "approved_status: " . $lead->approved_status . " -> " . $leadData["approved_status"];
                $needsUpdate = true;
            }

            // Update the 'updated_at' field if any changes were detected
            if ($needsUpdate) {
                $leadData["updated_at"] = $current_time;
            }
            
            // Combine notes if necessary
            $noteString = implode(", ", $note);
            Lead::findOrFail($id)->update($leadData);
            
            //if chnages are made in statuses
            if($noteString != ''){

                $leadDetailData = [
                    'lead_id' => $lead->id,
                    'description' => $noteString,
                    'created_at' => $current_time,
                    'updated_at' => NULL,
                    
                ];
                LeadActivity::create($leadDetailData);

            }
            
    
             $data = array(
                'PartyName' => $request->name, 
                'Phone' => $request->tel, 
            );
            

            $party = DB::table('party')->where('PartyName',$request->name)->get(); 

            if(count($party)==0) {

            $partyid= DB::table('party')->insertGetId($data);
            }
            else{
                $partyid = $party[0]->PartyID;
            }
            Arr::add($leadData, 'partyid', $partyid);
           
            DB::commit();

               if( ($request->qualified_status=='Closed Won') && ($request->action==1))
            {
            return redirect('BookingCreate/'.$id)->withSuccess('Lead Won Successfully. Now create booking')->withInput();
            }
            else
            {
            return redirect('leads')->withSuccess('Lead Updated Successfully');
            } 


        } catch (\Exception $e) {
            DB::rollBack();
            // dd($e->getMessage());
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $lead = Lead::with('leadDetails')->findOrFail($id);
            $lead->leadDetails()->delete();
            $lead->delete();
            DB::commit();
            return back()->with('error', 'Lead Data Deleated Successfully')->where('class','succuess')->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
    public function downloadFile($file)
    {
        try {
            $filePath = public_path('document/' . $file);
            if (File::exists($filePath)) {
                return response()->download($filePath, $file);
            } else {
                return back()->with('error', 'File not found.');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function import(Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $request->validate([
                'file' => 'required|mimes:csv'
            ]);
            $insert_data = 0;
            set_time_limit(0);
            ini_set('max_execution_time', 36000);
            if (!isset($request->file)) {
                return redirect()->back()->with('error', 'Please Upload a file');
            } else {
                $path = $request->file('file')->getRealPath();
                $mim_type = $request->file('file')->getMimeType();
                if ($mim_type != "text/csv") {
                    return redirect()->back()->with('error', 'Please Upload CSV File Only');
                } else {
                    $records = array_map('str_getcsv', file($path));
                    $fields = $records[0];
                    // dump($fields);
                    if (!count($records) > 0) {
                        return redirect()->back()->with('error', 'you have no record in csv!');
                    } elseif (count($fields) != 12) {
                        return redirect()->back()->with('error', 'The CSV file do not match with the sample of given Csv!');
                    } elseif (count($fields) == 12) {
                        // $field_check = ['Name', 'Mobile No', 'Other No', 'Business Details', 'Service', 'Channel', 'Branch Name', 'Agent Name', 'Branch Service', 'Branch Sub Service', 'Currency', 'Quoted Amount'];
                        // foreach ($fields as $key => $record) {
                        //     if ($record != $field_check[$key]) {
                        //         return redirect()->back()->with('error', 'Your Column headers do not match with the sample of given Csv!');
                        //     }
                        // }
                        array_shift($records);
                        // dd($records);
                        foreach ($records as $key => $record) {
                            // dd($employee);
                            if ($record[0] == '') {
                                return back()->with('error', 'Import Interrupted. The name is required. on line ' . $insert_data + 2);
                            } elseif ($record[1] == '') {
                                return back()->with('error', 'Import Interrupted. The Mobile Number is required. on line ' . $insert_data + 2);
                            } else {
                                if ($record[6] != '') {
                                    $branch = Branch::where('name', $record[6])->first();
                                    if (!$branch) {
                                        return back()->with('error', 'Import Interrupted. No Branch Found for the name ' . $record[6] . '. on line ' . $insert_data + 2);
                                    } else {
                                        $branch_id = $branch->id;
                                    }
                                } else {
                                    $branch_id = null;
                                }
                                if ($record[7] != '') {
                                    if ($record[6] != '') {
                                        $agent = User:: where('UserType','Agent')->where('name', $record[7])->where('branch_id', $branch_id)->first();
                                        if (!$agent) {
                                            return back()->with('error', 'Import Interrupted. No Agent Found for the name ' . $record[7] . ' in the branch ' . $record[6] . '. on line ' . $insert_data + 2);
                                        } else {
                                            $agent_id = $agent->id;
                                        }
                                    } else {
                                        $agent = User:: where('UserType','Agent')->where('name', $record[7])->first();
                                        if (!$agent) {
                                            return back()->with('error', 'Import Interrupted. No Agent Found for the name ' . $record[7] . '. on line ' . $insert_data + 2);
                                        } else {
                                            $agent_id = $agent->id;
                                        }
                                    }
                                } else {
                                    $agent_id = null;
                                }
                                $data = [
                                    'name' =>  $record[0],
                                    'tel' =>  $record[1],
                                    'other_tel' =>  $record[2] != '' ? $record[2] : null,
                                    'business_details' =>  $record[3] != '' ? $record[3] : null,
                                    'service' =>  $record[4] != '' ? $record[4] : null,
                                    'channel' =>  $record[5] != '' ? $record[5] : null,
                                    'branch_id' =>  $record[6] != '' ? $branch_id : null,
                                    'agent_id' =>  $record[7] != '' ? $agent_id : null,
                                    // 'service_id' =>  $record[8] != '' ? $record[8] : null,
                                    // 'sub_service_id' =>  $record[9] != '' ? $record[9] : null,
                                    'service_id' =>  null,
                                    'sub_service_id' => null,
                                    'currency' =>  $record[10] != '' ? $record[10] : null,
                                    'amount' =>  $record[11] != '' ? $record[11] : null,
                                ];
                                Lead::create($data);
                                $insert_data++;
                            }
                        }
                    }
                }
            }
            DB::commit();
            return back()->withSuccess('Data Imported successfully. ' . $insert_data . ' Rows Imported.');
        } catch (\Exception $e) {
            DB::rollBack();
            // dd($e->getMessage());
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
    public function addLeadNote(Request $request)
    {
     
        try {
            $request->validate([
                // 'notes' => 'required'
            ]);
            DB::beginTransaction();
            $lead = Lead::findOrFail($request->lead_id);
            $leadDetailData = [
                'lead_id' => $request->lead_id,
                // 'user_id' => Auth::user()->id,
                'status_from' => $lead->status != 'Qualified' ? $lead->status : $lead->approved_status,
                // 'status_to' =>  $request->status != 'Qualified' ? $request->status : $request->qualified_status,
                'date' => Carbon::now()->format('Y-m-d'),
                'follow_up_date' => $request->follow_up_date,
                'notes' => $request->notes
            ];
            LeadDetails::create($leadDetailData);
            DB::commit();
            return back()->withSuccess('Note Added successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            // dd($e->getMessage());
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
    public function bulkDeleteLeads(Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $ids = $request->ids;
            // dd($ids);
            foreach ($ids as $id) {
                // dump($id);
                $data = Lead::with('leadDetails')
                    ->findOrFail($id);
                $data->leadDetails()->delete();
                $data->delete();
                // dump($data);
            }
            DB::commit();
            // dd('end');
            return response()->json(['success' => 'Leads Data Deleted Successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            // dd($e->getMessage());
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    public function bulkReassignLeads(Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $agent = User::findOrFail($request->agent_id);
            $branch = Branch::findOrFail($agent->branch_id);
            $ids = $request->ids;
            foreach ($ids as $id) {
                Lead::findOrFail($id)->update([
                    'branch_id' => $branch->id,
                    'agent_id' => $agent->id,
                ]);
            }
            DB::commit();
            return response()->json(['success' => 'Leads Reassigned Successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    public function bulkReassignNewLeads(Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $agent = User::findOrFail($request->agent_id);
            $branch = Branch::findOrFail($agent->branch_id);
            $ids = $request->ids;
            foreach ($ids as $id) {
                $data = Lead::with('leadDetails')
                    ->findOrFail($id);
                $data->leadDetails()->delete();
                Lead::findOrFail($id)->update([
                    'branch_id' => $branch->id,
                    'agent_id' => $agent->id,
                    'status' => 'Pending',
                    'approved_status' => NULL
                ]);
            }
            DB::commit();
            return response()->json(['success' => 'Leads Reassigned Successfully As New']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
    }


    public function fetchLeads(Request $request)
    {
        $status = $request->input('status');
        $leads = Lead::where('status', $status)->get();
        return response()->json(['leads' => $leads]);
    }
}
