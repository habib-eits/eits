<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lead;
use App\Models\User;
use App\Models\Party;
use App\Models\Branch;
use App\Models\Status;
use App\Models\Service;
use App\Models\Campaign;
use App\Models\Followup;
use App\Models\SubService;
use App\Models\LeadDetails;
use App\Models\LeadActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Arr; 
use App\Models\QualifiedStatus;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\LeadStoreRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\LeadUpdateRequest;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
        
        $date = Carbon::now(); // or Carbon::parse('2025-06-18');
        // $twoMonthsAgo = $date->subMonths(1)->format('Y-m-d');
        
        // Set default to a very old date to load all records, or use current year start if preferred
        $twoMonthsAgo = $request->has('filter_min_created_at') && $request->filter_min_created_at != null 
            ? $request->filter_min_created_at 
            : '2020-01-01'; // Load all records from 2020 onwards by default

   
         // dd(Carbon::now()->endOfQuarter()->format('Y-m-d'));
        try {

             
                $id=session::get('UserID');
            

                 $agents = DB::table('user')->where('UserType', 'Agent')->get();

                $services = Service::all();
                $statuses = Status::all();
                $Q_statuses = QualifiedStatus::all();
                $campaigns = Campaign::all();
                $channels = DB::table('channel')->get();
                $data = Lead::with('branch', 'agent', 'campaign')
                    ->when($request->has('filter_status') && $request->filter_status != null, function ($query) use ($request) {
                        $query->where('status', $request->filter_status);
                    })
                    ->when($request->has('filter_channel_name') && $request->filter_channel_name != null, function ($query) use ($request) {
                        $query->where('channel', $request->filter_channel_name);
                    })
                    ->when($request->has('filter_agent_id') && $request->filter_agent_id != null, function ($query) use ($request) {
                        if ($request->filter_agent_id == '-1') {
                            $query->whereNull('agent_id');
                        } else {
                            $query->where('agent_id', $request->filter_agent_id);
                        }
                    })
                    ->when($request->has('filter_service_id') && $request->filter_service_id != null, function ($query) use ($request) {
                        if ($request->filter_service_id == '-1') {
                            $query->whereNull('service_id');
                        } else {
                            $query->where('service_id', $request->filter_service_id);
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
                   

                    // ->when($request->has('filter_min_created_at') && $request->filter_min_created_at != null && $request->has('filter_max_created_at') && $request->filter_max_created_at != null , function ($query) use ($request) {
                    //     $min_created_at = $request->filter_min_created_at;
                    //     $max_created_at = $request->filter_max_created_at;
                    //     $query->whereBetween(DB::raw('DATE(created_at)'), [$min_created_at, $max_created_at]);
                    //  })
                    ->when($request->has('filter_min_created_at') && $request->filter_min_created_at != null, function ($query) use ($request) {
                        $min_created_at = $request->filter_min_created_at;
                        $max_created_at = $request->has('filter_max_created_at') && $request->filter_max_created_at != null
                            ? $request->filter_max_created_at
                            : now()->format('Y-m-d');
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
                    // ->paginate(20);
                    ->get();

                    

                return view('leads.index', compact('services','agents', 'data', 'request', 'Q_statuses', 'statuses', 'campaigns','channels','twoMonthsAgo'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function ajax_leads(Request $request)
    {
        try {
            $query = Lead::with('branch', 'agent', 'campaign')
                ->when($request->has('filter_status') && $request->filter_status != null, function ($query) use ($request) {
                    $query->where('status', $request->filter_status);
                })
                ->when(request()->filled('filter_channel_name'), fn ($query) =>
                    $query->where('channel', request('filter_channel_name'))
                )
                ->when(request()->filled('filter_agent_id'), function ($query) {
                    $agentId = request('filter_agent_id');

                    $agentId == '-1'
                        ? $query->whereNull('agent_id')
                        : $query->where('agent_id', $agentId);
                })
                ->when(request()->filled('filter_service_id'), function ($query) {
                    $serviceId = request('filter_service_id');

                    $serviceId == '-1'
                        ? $query->whereNull('service_id')
                        : $query->where('service_id', $serviceId);
                })
                ->when(request()->filled('filter_campaign_id'), function ($query) {
                    $campaignId = request('filter_campaign_id');

                    $campaignId == '-1'
                        ? $query->whereNull('campaign_id')
                        : $query->where('campaign_id', $campaignId);
                })
                ->when(request()->filled('filter_last_updated'), function ($query) {
                    $now = Carbon::now();
                    [$from, $to] = match (request('filter_last_updated')) {
                        'Today'       => [$now->toDateString(), $now->toDateString()],
                        'Yesterday'   => [$now->subDay()->toDateString(), $now->subDay()->toDateString()],
                        '3'           => [$now->subDays(3)->toDateString(), Carbon::yesterday()->toDateString()],
                        'week'        => [$now->startOfWeek()->toDateString(), $now->endOfWeek()->toDateString()],
                        'month'       => [$now->startOfMonth()->toDateString(), $now->endOfMonth()->toDateString()],
                        'last_month'  => [$now->subMonth()->startOfMonth()->toDateString(), $now->subMonth()->endOfMonth()->toDateString()],
                        'quarter'     => [$now->startOfQuarter()->toDateString(), $now->endOfQuarter()->toDateString()],
                        'year'        => [$now->startOfYear()->toDateString(), $now->endOfYear()->toDateString()],
                        default       => [null, null],
                    };

                    if ($from && $to) {
                        $query->whereBetween(DB::raw('DATE(updated_at)'), [$from, $to]);
                    }
                })
                ->when(request()->filled('filter_creation_date'), function ($query) {
                    $now = Carbon::now();
                    [$from, $to] = match (request('filter_creation_date')) {
                        'Today'       => [$now->toDateString(), $now->toDateString()],
                        'Yesterday'   => [$now->subDay()->toDateString(), $now->subDay()->toDateString()],
                        '3'           => [$now->subDays(3)->toDateString(), Carbon::yesterday()->toDateString()],
                        'week'        => [$now->startOfWeek()->toDateString(), $now->endOfWeek()->toDateString()],
                        'month'       => [$now->startOfMonth()->toDateString(), $now->endOfMonth()->toDateString()],
                        'last_month'  => [$now->subMonth()->startOfMonth()->toDateString(), $now->subMonth()->endOfMonth()->toDateString()],
                        'quarter'     => [$now->startOfQuarter()->toDateString(), $now->endOfQuarter()->toDateString()],
                        'year'        => [$now->startOfYear()->toDateString(), $now->endOfYear()->toDateString()],
                        default       => [null, null],
                    };

                    if ($from && $to) {
                        $query->whereBetween(DB::raw('DATE(created_at)'), [$from, $to]);
                    }
                })
                ->when(request()->filled('filter_min_created_at'), function ($query) {
                    $min = request('filter_min_created_at');
                    $max = request('filter_max_created_at', now()->toDateString());

                    $query->whereBetween(DB::raw('DATE(created_at)'), [$min, $max]);
                })

                ->when(request()->filled(['filter_min_updated_at', 'filter_max_updated_at']), function ($query) {
                    $min = request('filter_min_updated_at');
                    $max = request('filter_max_updated_at');

                    $query->whereBetween(DB::raw('DATE(updated_at)'), [$min, $max])
                        ->whereColumn('updated_at', '!=', 'created_at');
                })
                ->when(request()->filled('filter_Q_status'), fn($query) =>
                    $query->where('approved_status', request('filter_Q_status'))
                )

                ->when(Session::get('UserType') == 'Agent', function ($query) {
                    $query->where('agent_id', Session::get('UserID'));
                });

            return DataTables::of($query)
                ->addColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="check_' . $row->id . '" class="dt-select" name="lead_ids[]" onclick="checkValue(' . $row->id . ')" value="' . $row->id . '">';
                })
                ->addColumn('contact_number_clean', function ($row) {
                    return str_replace(' ', '', $row->tel);
                })
                ->addColumn('campaign_name', function ($row) {
                    return isset($row->campaign) ? $row->campaign->name : 'N/A';
                })
                ->addColumn('agent_name', function ($row) {
                    return isset($row->agent) ? $row->agent->name : 'N/A';
                })
                ->addColumn('approved_status_display', function ($row) {
                    return isset($row->approved_status) ? $row->approved_status : 'N/A';
                })
                ->addColumn('created_at_formatted', function ($row) {
                    return isset($row->created_at) ? dmY($row->created_at) : 'N/A';
                })
                ->addColumn('updated_at_formatted', function ($row) {
                    if ($row->created_at != $row->updated_at) {
                        return isset($row->updated_at) ? dmY($row->updated_at) : '-';
                    }
                    return '-';
                })
                ->addColumn('service_name', function ($row) {
                    $service = DB::table('services')->where('id', $row->service_id)->first();
                    return isset($service) ? $service->name : 'N/A';
                })
                ->addColumn('boq_col', function ($row) {
                    if ($row->BOQ_number != NULL) {
                        $estimate_master = DB::table('estimate_master')
                            ->where('EstimateNo', $row->BOQ_number)
                            ->orderBy('EstimateMasterID', 'desc')
                            ->first();
                        
                        if ($estimate_master) {
                            $boqLink = '<a target="_blank" href="' . route('boqViewPDF', ['EstimateMasterID' => $estimate_master->EstimateMasterID, 'BranchID' => $estimate_master->BranchID]) . '"><small>BOQ: </small>' . $row->BOQ_number . '</a><br>';
                            $quoLink = '<a href="' . url('/EstimateViewPDF/' . $estimate_master->EstimateMasterID . '/' . $estimate_master->BranchID) . '" target="_blank"><small>QUO: </small>' . $estimate_master->ReferenceNo . '</a>';
                            return $boqLink . $quoLink;
                        }
                    }
                    return 'N/A';
                })
                ->addColumn('margin', function ($row) {
                    if ($row->BOQ_number != NULL) {
                        $estimate_master = DB::table('estimate_master')
                            ->where('EstimateNo', $row->BOQ_number)
                            ->orderBy('EstimateMasterID', 'desc')
                            ->first();
                        return $estimate_master ? $estimate_master->total_margin : 'N/A';
                    }
                    return 'N/A';
                })
                ->addColumn('total_amount', function ($row) {
                    if ($row->BOQ_number != NULL) {
                        $estimate_master = DB::table('estimate_master')
                            ->where('EstimateNo', $row->BOQ_number)
                            ->orderBy('EstimateMasterID', 'desc')
                            ->first();
                        return $estimate_master ? $estimate_master->GrandTotal : 'N/A';
                    }
                    return 'N/A';
                })
                ->addColumn('remarks', function ($row) {
                    $followup = DB::table('followups')->where('lead_id', $row->id)->orderBy('id', 'desc')->select('remarks')->first();
                    return $followup && $followup->remarks ? $followup->remarks : '-';
                })
                ->addColumn('actions', function ($row) {
                    $actions = '<div class="d-flex align-items-center col-actions">
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal font-size-18"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-33px, 27px);" data-popper-placement="bottom-end">
                                <li><a href="' . route('lead.edit', $row->id) . '" class="dropdown-item"><i class="bx bx-pencil font-size-16 text-secondary me-1"></i>Edit Lead</a></li>
                                <li><a href="' . route('lead.show', $row->id) . '" class="dropdown-item"><i class="mdi mdi-eye-outline font-size-16 text-primary me-1"></i>View Lead</a></li>
                                <li><a href="' . route('boq-create', $row->id) . '" class="dropdown-item"><i class="mdi mdi-plus font-size-16 text-success me-1"></i>Create BOQ</a></li>
                                <li><a href="javascript:void(0)" onclick="delete_confirm_n(`leadDelete`,\'' . $row->id . '\')" class="dropdown-item"><i class="bx bx-trash font-size-16 text-danger me-1"></i>Delete Lead</a></li>
                            </ul>
                        </div>
                    </div>';
                    return $actions;
                })
                ->rawColumns(['checkbox', 'boq_col', 'actions'])
                ->make(true);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function create()
    {


        try {
            $branches = Branch::all();
            $services = Service::all();
            $subServices = SubService::all();
            $parties = DB::table('party')->get();

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
            return view('leads.create', compact('parties','branches', 'agents', 'services', 'subServices', 'campaigns','channel'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    // public function store(Request $request)
    // {
       
    //     $party = DB::table('party')->where('PartyID',$request->input('partyid'))->first();
       

    //      try {
    //         DB::beginTransaction();
    //         // $request->validate(
    //         //     [
    //         //         'name' => 'required|max:255',
    //         //         'tel' => 'required|max:255',
    //         //         'other_tel' => 'nullable|max:255',
    //         //         'bussiness_details' => 'nullable|max:255',
    //         //         'service' => 'nullable|max:255',
    //         //         'channel' => 'nullable|max:255',
    //         //         'amount' => 'nullable|numeric|regex:/^\d{1,18}(\.\d{1,3})?$/',
    //         //     ],
    //         //     [
    //         //         'amount.regex' => 'Please add a valid amount i-e number with max 18 digits (quintillion) and upto 3 decimal points.',
    //         //     ]
    //         // );
    //         // dd($request->all());
    //         // Manually set the timestamps
    //         $createdAt = Carbon::now();
    //         $updatedAt = Carbon::now();

    //             $leadData = array(
    //             'partyid' => $party->PartyID,
    //             'name' => $party->PartyName,
    //             'tel' => $party->Phone,
    //             'other_tel' => $request->other_tel,
    //             'business_details' => $request->business_details,
    //             'service' => $request->service,
    //             'channel' => $request->channel,
    //             'campaign_id' => $request->campaign_id,
    //             'branch_id' => $request->branch_id,
    //             'agent_id' => $request->agent_id,
    //             'service_id' => $request->service_id,
    //             'sub_service_id' => $request->sub_service_id,
    //             'currency' => $request->currency,
    //             'amount' => $request->amount,
    //             'created_at' => $createdAt,
    //             'updated_at' => NULL,
    //             // 'status' => isset($request->status) ? $request->status : $lead->status,
    //             // 'approved_status' => !isset($request->status) ? $request->qualified_status : ($request->status == 'Qualified' ? $request->qualified_status : null),

    //         );




    //         // $data = array(
    //         //                 'PartyName' => $request->name, 
    //         //                 'Phone' => $request->tel, 
    //         //                 'Address' => $request->business_details,
                            
    //         //                 );
            

    //         // $party = DB::table('party')->where('PartyName',$request->name)->get(); 

    //         // if(count($party)==0)
    //         // {

    //         // $partyid= DB::table('party')->insertGetId($data);
    //         // }
    //         // else
    //         // {
    //         //     $partyid = $party[0]->PartyID;;
    //         // }


 
    //         // $leadData = Arr::add($leadData, 'partyid', $partyid);


 

    //         $id_save= DB::table('leads')->insertGetId($leadData);
            
            
            



    //         DB::commit();
    //         return redirect('leads')->withSuccess('Lead Created Successfully');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //          dd($e->getMessage());
    //         return back()->with('error', $e->getMessage())->withInput();
    //     }
    // }

    public function store(LeadStoreRequest $request)
        {
            $party = Party::where('PartyID', $request->partyid)->first();

            try {
                DB::beginTransaction();

                $leadData = array_merge($request->validated(), [
                    'partyid' => $party->PartyID,
                    'name'    => $party->PartyName,
                    'tel'     => $party->Phone,
                    'created_at' => Carbon::now(),
                    'updated_at' => null,
                ]);

                Lead::create($leadData);

                DB::commit();
                return redirect('leads')->withSuccess('Lead Created Successfully');

            } catch (\Exception $e) {
                DB::rollBack();
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
 
        // Check if the session already has 'previous_url'
        if (!session()->has('previous_url')) {
            // Get the previous URL
            $previous_url = url()->previous();
            // Store the previous URL in the session if it contains 'filter'
            session(['previous_url' => $previous_url]);
          
        }

        //     // Get the previous URL
        // $previous_url = url()->previous();

        // // Check if the previous URL contains the word 'filter'
        // if (str_contains($previous_url, 'filter')) {
        //     // Store the previous URL in the session if it contains 'filter'
        //     session(['previous_url' => $previous_url]);
        // }


        try {
            $lead = Lead::findOrFail($id);
            $party = Party::all();

            $followups = Followup::where('lead_id',$lead->id)->get();

            $current_party = DB::table('party')->where('PartyID',$lead->partyid)->first();

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





            return view('leads.edit', compact('followups','current_party','party','lead','lead_activities' ,'branches', 'agents', 'services', 'subServices', 'statuses', 'Q_statuses', 'campaigns','channel'));
        } catch (\Exception $e) {
            // DB::rollBack();
            // dd($e->getMessage());
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    // public function update(Request $request, $id)
    // {             
        
    //     $request->session()->forget('previous_url');


    //      // dump($id);
         
    //     try {
    //         DB::beginTransaction();
    //         $request->validate(
    //             [
    //                 'partyid' => 'required|max:255',
    //                 'other_tel' => 'nullable|max:255',
    //                 'bussiness_details' => 'nullable|max:255',
    //                 'service' => 'nullable|max:255',
    //                 'channel' => 'nullable|max:255',
    //                 'amount' => 'nullable|numeric|regex:/^\d{1,18}(\.\d{1,3})?$/',
    //             ],
    //             [
    //                 'amount.regex' => 'Please add a valid amount i-e number with max 18 digits (quintillion) and upto 3 decimal points.',
    //             ]
    //         );


    //         $lead = Lead::findOrFail($id);  
    //         $party = DB::table('party')->where('PartyID',$request->partyid)->first();
            

    //         $current_time = Carbon::now();

    //         $leadData = [
    //             'partyid' => $party->PartyID,
    //             'name' => $party->PartyName,
    //             'tel' => $party->Phone,
    //             'business_details' => $request->business_details,
    //             'service' => $request->service,
    //             'channel' => $request->channel,
    //             'campaign_id' => $request->campaign_id,
    //             'branch_id' => $request->branch_id,
    //             'agent_id' => $request->agent_id,
    //             'service_id' => $request->service_id,
    //             'sub_service_id' => $request->sub_service_id,
    //             'currency' => $request->currency,
    //             'amount' => $request->amount,
    //             'status' => isset($request->status) ? $request->status : $lead->status,
    //             // 'approved_status' =>  $request->qualified_status,
    //             'approved_status' => !isset($request->status)
    //                 ? $request->qualified_status
    //                 : ($request->status == 'Qualified' ? $request->qualified_status : null),

    //             'updated_at' => $lead->updated_at,
    //             'remarks' => $request->remarks,
    //         ];

    //         $note = [];
    //         $needsUpdate = false;

    //         if ($lead->status != $leadData["status"]) {
    //             $note[] = "status: " . $lead->status . " -> " . $leadData["status"];
    //             $needsUpdate = true;
    //         }

    //         if ($lead->approved_status != $leadData["approved_status"]) {
    //             $note[] = "approved_status: " . $lead->approved_status . " -> " . $leadData["approved_status"];
    //             $needsUpdate = true;
    //         }

    //         // Update the 'updated_at' field if any changes were detected
    //         if ($needsUpdate) {
    //             $leadData["updated_at"] = $current_time;
    //         }
            
    //         // Combine notes if necessary
    //         $noteString = implode(", ", $note);
    //         Lead::findOrFail($id)->update($leadData);
            
    //         //if chnages are made in statuses
    //         if($noteString != ''){

    //             $leadDetailData = [
    //                 'lead_id' => $lead->id,
    //                 'description' => $noteString,
    //                 'created_at' => $current_time,
    //                 'updated_at' => NULL,
                    
    //             ];
    //             LeadActivity::create($leadDetailData);

    //         }
            
    
    //         //  $data = array(
    //         //     'PartyName' => $request->name, 
    //         //     'Phone' => $request->tel, 
    //         // );
            

    //         // $party = DB::table('party')->where('PartyName',$request->name)->get(); 

    //         // if(count($party)==0) {

    //         // $partyid= DB::table('party')->insertGetId($data);
    //         // }
    //         // else{
    //         //     $partyid = $party[0]->PartyID;
    //         // }
    //         // Arr::add($leadData, 'partyid', $partyid);
           
    //         DB::commit();

    //            if( ($request->qualified_status=='Closed Won') && ($request->action==1))
    //         {
    //         return redirect('BookingCreate/'.$id)->withSuccess('Lead Won Successfully. Now create booking')->withInput();
    //         }
    //         else
    //         {
    //             // return redirect('leads')->withSuccess('Lead Updated Successfully');
    //             return redirect($request->previous_url)->withSuccess('Lead Updated Successfully');
    //         } 


    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         // dd($e->getMessage());
    //         return back()->with('error', $e->getMessage())->withInput();
    //     }
    // }

    public function update(LeadUpdateRequest $request, $id)
    {
        $request->session()->forget('previous_url');

        try {
            DB::beginTransaction();

            $lead = Lead::findOrFail($id);

            $party = Party::where('PartyID', $request->partyid)->first();
            if ($party) {
                $lead->partyid = $party->PartyID;
                $lead->name = $party->PartyName;
                $lead->tel = $party->Phone;
            }

            $leadData = $request->validatedForUpdate($lead); 

            // Track changes for status and approved_status
            $note = [];
            $needsUpdate = false;

            if ($lead->status != $leadData['status']) {
                $note[] = "status: {$lead->status} -> {$leadData['status']}";
                $needsUpdate = true;
            }

            if ($lead->approved_status != $leadData['approved_status']) {
                $note[] = "approved_status: {$lead->approved_status} -> {$leadData['approved_status']}";
                $needsUpdate = true;
            }

            // Update 'updated_at' only if changes in status or approved_status
            if ($needsUpdate) {
                $leadData['updated_at'] = now();
            } else {
                $leadData['updated_at'] = $lead->updated_at;
            }

            $lead->update($leadData);

            if (!empty($note)) {
                LeadActivity::create([
                    'lead_id' => $lead->id,
                    'description' => implode(", ", $note),
                    'created_at' => now(),
                    'updated_at' => null,
                ]);
            }

            DB::commit();

            if (($request->qualified_status == 'Closed Won') && ($request->action == 1)) {
                return redirect("BookingCreate/{$lead->id}")
                    ->withSuccess('Lead Won Successfully. Now create booking')
                    ->withInput();
            }

            return redirect($request->previous_url)->withSuccess('Lead Updated Successfully');

        } catch (\Exception $e) {
            DB::rollBack();
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
            return back()->with('error', 'Lead Data Deleted Successfully')->with('class', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
    public function downloadFile($file)
    {
        try {
            $filePath = public_path('download/' . $file);
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
                                // if ($record[6] != '') {
                                //     $branch = Branch::where('name', $record[6])->first() ?? null;
                                //     if (!$branch) {
                                //         return back()->with('error', 'Import Interrupted. No Branch Found for the name ' . $record[6] . '. on line ' . $insert_data + 2);
                                //     } else {
                                //         $branch_id = $branch->id;
                                //     }
                                // } else {
                                //     $branch_id = null;
                                // }
                                // if ($record[7] != '') {
                                //     if ($record[6] != '') {
                                //         $agent = User:: where('UserType','Agent')->where('name', $record[7])->first();
                                //         if (!$agent) {
                                //             return back()->with('error', 'Import Interrupted. No Agent Found for the name ' . $record[7] . ' in the branch ' . $record[6] . '. on line ' . $insert_data + 2);
                                //         } else {
                                //             $agent_id = $agent->id;
                                //         }
                                //     } else {
                                //         $agent = User:: where('UserType','Agent')->where('name', $record[7])->first();
                                //         if (!$agent) {
                                //             return back()->with('error', 'Import Interrupted. No Agent Found for the name ' . $record[7] . '. on line ' . $insert_data + 2);
                                //         } else {
                                //             $agent_id = $agent->id;
                                //         }
                                //     }
                                // } else {
                                //     $agent_id = null;
                                // }
                                $data = [
                                    'name' =>  $record[0],
                                    'tel' =>  $record[1],
                                    'other_tel' =>  $record[2] ?? null,
                                    'business_details' =>  $record[3] ?? null,
                                    'service' =>  $record[4] ?? null,
                                    'channel' =>  $record[5] ?? null,
                                    // 'branch_id' =>  $record[6] ?? null,
                                    'agent_id' =>  $agent_id ?? null,
                                    // 'service_id' =>  $record[8] != '' ? $record[8] : null,
                                    // 'sub_service_id' =>  $record[9] != '' ? $record[9] : null,
                                    'service_id' =>  null,
                                    'sub_service_id' => null,
                                    'currency' =>  $record[10] ?? null,
                                    'amount' =>  floatval($record[11]) ?? null,
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
