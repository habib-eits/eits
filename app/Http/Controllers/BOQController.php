<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\State;
use ArPHP\I18N\Arabic;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use App\Exports\BoqExport;

use Maatwebsite\Excel\Facades\Excel;


class BOQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagetitle = 'BOQ';
        return view('boq.index', compact('pagetitle'));  
    }

    public function ajax_boq(Request $request)
    {
        Session::put('menu', 'Vouchers');
        $pagetitle = 'Estimates';
        if ($request->ajax()) {
            $data = DB::table('v_estimate_master')
            ->where('Status','!=', 'Revised')
            ->orderBy('EstimateDate', 'desc')
            ->orderBy('EstimateMasterID', 'desc')
            ->get();

            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
               $btn = '
                <div class="d-flex align-items-center col-actions" style="z-index: 1000;">
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-horizontal font-size-18"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-33px, 27px);" data-popper-placement="bottom-end">
                            <li><a href="' . URL('/EstimateViewPDF/' . $row->EstimateMasterID) . '/' . $row->BranchID . '" target="_blank" class="dropdown-item"><span class="badge bg-primary me-1" >QUO </span>'. $row->ReferenceNo .'</a></li>
                            <li><a href="' . URL('/boqViewPDF/' . $row->EstimateMasterID) . '/' . $row->BranchID . '" target="_blank" class="dropdown-item"><span class="badge bg-dark me-1" >BOQ </span>'. $row->ReferenceNo .'</a></li>
                            <li><a href="' . URL('/boq-export/' . $row->EstimateMasterID) . '"class="dropdown-item"><span class="badge bg-success me-1" >Excel </span>'. $row->ReferenceNo .'</a></li>
                            ';
            
                $revised_boqs = DB::table('v_estimate_master')
                                    ->where('Status', 'Revised')
                                    ->where('EstimateNo', $row->EstimateNo)
                                    ->orderBy('EstimateDate', 'desc')
                                    ->orderBy('EstimateMasterID', 'desc')
                                    ->get();
            
                if ($revised_boqs->isNotEmpty()) {
                    $btn .= '<div class="dropdown-divider"></div><div class="text-center" style="margin-top:-5px;"><span>History</span></div>';
                    foreach ($revised_boqs as $revised_boq) {
                        $btn .= '<li><a href="' . URL('/boqViewPDF/' . $revised_boq->EstimateMasterID) . '/' . $revised_boq->BranchID . '" target="_blank" class="dropdown-item"><span class="badge bg-warning me-1" >BOQ </span>'. $revised_boq->ReferenceNo . '</a></li>';
                    }
                }
            
                // Open for edit at any point
                $btn .= '<li><a href="' . route('boq.edit', $row->EstimateMasterID) . '" class="dropdown-item"><span><i class="mdi mdi-file-edit font-size-15 text-primary px-2"></i></span> Edit BOQ</a></li>';
            
                // Add condition for 'boq.destroy' route
                if ($row->Status == 'Pending') {

                    $btn .= '<li><a href="javascript:void(0)" onclick="confirmRedirect(\'' . URL('/boq/create-revision/' . $row->EstimateMasterID) . '\')" class="dropdown-item">  <i class="text-primary font-size-15 mdi mdi-content-duplicate px-2 text-warning"></i> Create Revision</a></li>';

                    // $btn .= '<li>';
                    // $btn .= '<form action="' . route('boq.destroy', $row->EstimateMasterID) . '" method="POST" class="d-inline" onsubmit="return confirm(\'Are you sure you want to delete this item,?\')">';
                    // $btn .= csrf_field(); // Add CSRF protection
                    // $btn .= method_field('DELETE'); // Specify DELETE method
                    // $btn .= '<button type="submit" class="dropdown-item">';
                    // $btn .= '<span><i class="mdi mdi-delete font-size-15 text-danger px-2"></i></span> Delete';
                    // $btn .= '</button>';
                    // $btn .= '</form>';
                    // $btn .= '</li>';
            
                }
            
                $btn .= '
                        </ul>
                    </div>
                </div>';
            
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('boq.index', compact( 'pagetitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         // dd('reached');
         $pagetitle = 'Create BOQ';
         $party = DB::table('party')->get();
 
         $items = DB::table('item')->get();
         $item = json_encode($items);
 
         $branch = DB::table('branch')->get();
         
         $services = DB::table('services')->get();
 
         $job = DB::table('job')->get();
         $po = DB::table('invoice_master')->select('InvoiceNo')->where('InvoiceType','PO')->get();
 
         // dd($item);
         $user = DB::table('user')->where('UserType','Agent')->get();
 
        
        
 
         $chartofacc = DB::table('chartofaccount')->get();
         $estimate_master = DB::table('estimate_master')
             ->select(DB::raw('LPAD(IFNULL(MAX(right(EstimateNo,5)),0)+1,5,0) as EstimateNo'))
             ->get();
 
             
         $estimate_master_no = DB::table('estimate_master')
             ->select(DB::raw('LPAD(IFNULL(MAX(right(EstimateNo,5)),0)+1,5,0) as EstimateNo'))
             ->get();
 
         $referanceNo = 'R0 - '.date("y - ").$estimate_master[0]->EstimateNo;
     
 
         $vhno = DB::table('invoice_master')
         ->select(DB::raw('LPAD(IFNULL(MAX(right(InvoiceNo,5)),0)+1,5,0) as VHNO '))->whereIn(DB::raw('left(InvoiceNo,3)'), ['TAX'])->get();    
         $unit = DB::table('unit')->get();
 
         $tax = DB::table('tax')->where('Section', 'Estimate')->orderBy('TaxID','desc')->get();
 
         $challan_type = DB::table('challan_type')->get();
         $invoice_type = DB::table('invoice_type')->get();
         return view('boq.create', compact('referanceNo','chartofacc', 'party', 'pagetitle', 'estimate_master', 'items', 'item', 'challan_type', 'user', 'invoice_type', 'tax','job','po','vhno','unit','branch','services'));
    }


    public function createBOQ($lead_id)
    {
        DB::beginTransaction(); // Start the database transaction

        try {
            $pagetitle = 'Create BOQ';
            $lead = DB::table('leads')->where('id', $lead_id)->first();

            $party = DB::table('party')->where('PartyID', $lead->partyid)->first();

            $states = State::all();
            $items = DB::table('item')->get();
            $item = json_encode($items);

            $branch = DB::table('branch')->get();
            $services = DB::table('services')->get();
            $job = DB::table('job')->get();
            $po = DB::table('invoice_master')->select('InvoiceNo')->where('InvoiceType', 'PO')->get();

            $user = DB::table('user')->where('UserType', 'Agent')->get();
            $chartofacc = DB::table('chartofaccount')->get();

            $estimate_master = DB::table('estimate_master')
                ->select(DB::raw('LPAD(IFNULL(MAX(right(EstimateNo,5)),0)+1,5,0) as EstimateNo'))
                ->get();

            $estimate_master_no = DB::table('estimate_master')
                ->select(DB::raw('LPAD(IFNULL(MAX(right(EstimateNo,5)),0)+1,5,0) as EstimateNo'))
                ->get();

            $referanceNo = 'R0 - ' . date("y - ") . $estimate_master[0]->EstimateNo;

            $vhno = DB::table('invoice_master')
                ->select(DB::raw('LPAD(IFNULL(MAX(right(InvoiceNo,5)),0)+1,5,0) as VHNO'))
                ->whereIn(DB::raw('left(InvoiceNo,3)'), ['TAX'])
                ->get();

            $unit = DB::table('unit')->get();
            $tax = DB::table('tax')->where('Section', 'Estimate')->orderBy('TaxID', 'desc')->get();
            $challan_type = DB::table('challan_type')->get();
            $invoice_type = DB::table('invoice_type')->get();

            DB::commit(); // Commit the transaction

            return view('boq.create', compact('lead_id', 'referanceNo', 'chartofacc', 'party', 'pagetitle', 'estimate_master', 'items', 'item', 'challan_type', 'user', 'invoice_type', 'tax', 'job', 'po', 'vhno', 'unit', 'branch', 'services','states'));

        } catch (\Exception $e) {
            DB::rollBack(); // Rollback the transaction if any error occurs

            // You can log the error or return a specific error view/message
            return redirect()->back()->with('error', 'An error occurred while creating the BOQ. Please try again.');
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->has('ItemID'))
        {
            return redirect()->back()->withInput()->with('error', 'Failed to create BOQ atleast one item is required ')->with('class', 'danger');
        }
        
        $EstimateNo = $this->generateEstimateNo($request->input('BranchID'));
        $ReferenceNo  =$this->generateReferenceNo();

        // Start the database transaction
        DB::beginTransaction();

        try {
            // Master data for estimate_master table
            $master_data = array(
                // 'EstimateNo' => $request->input('EstimateNo'),
                'EstimateNo' => $EstimateNo,
                'BranchID' => $request->input('BranchID'),
                'PartyID' => $request->input('PartyID'),
                'state' =>$request->state,
                'location' =>$request->location,
                'WalkinCustomerName' => $request->input('WalkinCustomerName'),
                'ReferenceNo' => $ReferenceNo,
                'Date' => $request->input('Date'),
                'EstimateDate' => $request->input('Date'),
                'ExpiryDate' => $request->input('DueDate'),
                'Subject' => $request->input('Subject'),
                'SubTotal' => $request->input('subtotal'),
                'Discount' => $request->input('discount'),
                'TaxType' => $request->input('TaxType'),
                'Tax' => $request->input('incl_vat_total_amount'),
                'Shipping' => $request->input('Shipping'),
                'Total' => $request->input('total_amount'),
                'GrandTotal' => $request->input('grand_total'),
                'CustomerNotes' => $request->input('CustomerNotes'),
                'UserID' => Session::get('UserID'),
                'total_margin' => $request->input('total_margin'),
                'material_cost'  => $request->input('material_cost'),
                'labour_cost' => $request->input('labour_cost'),
                'transport_cost' => $request->input('transport_cost'),
                'material_delivery_cost' => $request->input('material_delivery_cost'),
                'project_cost' => $request->input('project_cost'),
            );

            // Insert into estimate_master table and get the ID
            $EstimateMasterID = DB::table('estimate_master')->insertGetId($master_data);

            // Loop to insert into estimate_detail table
            for ($i = 0; $i < count($request->ItemID); $i++) {

               


                $detail_data = array(
                    'EstimateMasterID' =>  $EstimateMasterID,
                    'EstimateNo' => $EstimateNo,
                    'EstimateDate' => $request->input('Date'),
                    'services_id' => $request->services_id[$i],
                    'ItemID' => 197, // Hardcoded ItemID
                    'Description' => $request->Description[$i],
                    'DescriptionDetail' => $request->DescriptionDetail[$i],
                    'TaxPer' => 5.00,
                    'Tax' => $request->vat_per_unit[$i],
                    'LS' => $request->LS[$i],
                    'Qty' => $request->quantity[$i],
                    'Rate' => $request->unit_with_vat[$i],
                    'Total' => $request->item_total[$i],
                    'Gross' => $request->item_total[$i],
                    'unit_net_cost' => $request->unit_net_cost[$i],
                    'vat_per_unit' => $request->vat_per_unit[$i],
                    'unit_with_vat' => $request->unit_with_vat[$i],
                    'per_unit_profit_margin' => $request->per_unit_profit_margin[$i],
                    'per_unit_selling_price' => $request->per_unit_selling_price[$i],
                    'quantity' => $request->quantity[$i],
                    'total_cost_with_vat' => $request->total_cost_with_vat[$i],
                    'total_profit_margin' => $request->total_profit_margin[$i],
                    'item_total' => $request->item_total[$i],
                    'image' => null
                );

                // Check if the image input is provided
                if ($request->hasFile('image') && isset($request->image[$i])) {
                   
                    $image = $request->file('image')[$i]; 
                    $imageName = time() . '-' . $i . '.' . $image->extension();
                    
                    $image->move(public_path('boq-images'), $imageName);
                    
                    $detail_data['image'] = $imageName; // Store images in an array
                }

                // Insert into estimate_detail table
                DB::table('estimate_detail')->insertGetId($detail_data);
            }

            // Update the BOQ_number in the lead table
            $lead = Lead::find($request->lead_id);
            $lead->update(['BOQ_number' => $EstimateNo]);

            // Commit the transaction if everything is successful
            DB::commit();

            // Redirect with success message
            return redirect(route('boq.index'))->with('error', 'Saved Successfully')->with('class', 'success');
        } catch (\Exception $e) {

            dd($e);
            // Rollback the transaction if an error occurs
            DB::rollback();

            // Log the exception for debugging
            // Log::error($e);

            // Redirect back with an error message
            return redirect()->back()->with('error', 'An error occurred while saving the data. Please try again.')->with('class', 'danger');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $pagetitle = 'BOQ';
        $party = DB::table('party')->get();

        $tax = DB::table('tax')->where('Section', 'Estimate')->orderBy('TaxID','desc')->get();
            $states = State::all();

        $items = DB::table('item')->get();
        $item = json_encode($items);
        $services = DB::table('services')->get();
        $branch = DB::table('branch')->get();
        $unit = DB::table('unit')->get();
        // dd($item);
        $user = DB::table('user')->where('UserType','Agent')->get();
        $chartofacc = DB::table('chartofaccount')->get();
        $challan_master = DB::table('challan_master')
            ->select(DB::raw('LPAD(IFNULL(MAX(ChallanMasterID),0)+1,4,0) as ChallanMasterID'))
            ->get();
        $challan_type = DB::table('challan_type')->get();
        $estimate_master = DB::table('estimate_master')->where('EstimateMasterID', $id)->get();
       
      
        $estimate_detail = DB::table('estimate_detail')->where('EstimateMasterID', $id)->get();
         // dd($estimate_detail);

        // $payment_plan = DB::table('payment_plan')->where('EstimateMasterID',$id)->get();
 
        return view('boq.edit', compact('services','chartofacc', 'party', 'pagetitle', 'estimate_master', 'items', 'item',  'user',  'estimate_detail', 'tax','branch','unit','states'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!$request->has('ItemID'))
        {
            return redirect()->back()->withInput()->with('error', 'Failed to update BOQ Item is required ')->with('class', 'danger');
        }
      

        DB::beginTransaction(); // Start the transaction
        try {
            $estimate_mst = array(
                'EstimateNo' => $request->input('EstimateNo'),
                'BranchID' => $request->input('BranchID'),
                'WalkinCustomerName' => $request->input('WalkinCustomerName'),
                'PlaceOfSupply' => $request->input('PlaceOfSupply'),
                'ReferenceNo' => $request->input('ReferenceNo'),
                'state' =>$request->state,
                'location' =>$request->location,
                'Date' => $request->input('Date'),
                'EstimateDate' => $request->input('Date'),
                'ExpiryDate' => $request->input('DueDate'),
                'Subject' => $request->input('Subject'),
                'SubTotal' => $request->input('subtotal'),
                'Discount' => $request->input('discount'),
                'TaxType' => $request->input('TaxType'),
                'Tax' => $request->input('incl_vat_total_amount'),
                'Shipping' => $request->input('Shipping'),
                'Total' => $request->input('total_amount'),
                'GrandTotal' => $request->input('grand_total'),
                'CustomerNotes' => $request->input('CustomerNotes'),
                'DescriptionNotes' => $request->input('DescriptionNotes'),
                'UserID' => Session::get('UserID'),
                'total_margin' => $request->input('total_margin'),
                'material_cost' => $request->input('material_cost'),
                'labour_cost' => $request->input('labour_cost'),
                'transport_cost' => $request->input('transport_cost'),
                'material_delivery_cost' => $request->input('material_delivery_cost'),
                'project_cost' => $request->input('project_cost'),
            );

            $EstimateMasterID = $id;

            // Update estimate master
            DB::table('estimate_master')->where('EstimateMasterID', $EstimateMasterID)->update($estimate_mst);

            // Delete existing estimate details
            DB::table('estimate_detail')->where('EstimateMasterID', $EstimateMasterID)->delete();

            // Insert new estimate details
            for ($i = 0; $i < count($request->ItemID); $i++) {
                $detail_data = array(
                    'EstimateMasterID' => $EstimateMasterID,
                    'EstimateNo' => $request->input('EstimateNo'),
                    'EstimateDate' => $request->input('Date'),
                    'services_id' => $request->services_id[$i],
                    'ItemID' => 197,
                    'Description' => $request->Description[$i],
                    'DescriptionDetail' => $request->DescriptionDetail[$i],
                    'TaxPer' => 5.00,
                    'Tax' => $request->vat_per_unit[$i],
                    'LS' => $request->LS[$i],
                    'Qty' => $request->quantity[$i],
                    'Rate' => $request->unit_with_vat[$i],
                    'Total' => $request->item_total[$i],
                    'Gross' => $request->item_total[$i],
                    'unit_net_cost' => $request->unit_net_cost[$i],
                    'vat_per_unit' => $request->vat_per_unit[$i],
                    'unit_with_vat' => $request->unit_with_vat[$i],
                    'per_unit_profit_margin' => $request->per_unit_profit_margin[$i],
                    'per_unit_selling_price' => $request->per_unit_selling_price[$i],
                    'quantity' => $request->quantity[$i],
                    'total_cost_with_vat' => $request->total_cost_with_vat[$i],
                    'total_profit_margin' => $request->total_profit_margin[$i],
                    'item_total' => $request->item_total[$i],
                    'image' => ($request->old_image[$i]) ? $request->old_image[$i] : null // if it has no value assign null
                );


                 // Check if the image input is provided
                 if ($request->hasFile('image') && isset($request->image[$i])) {

                    //delete the previous image first check that it has old image value and file also exist then delete  
                    if ( $request->old_image[$i] != null  &&   file_exists(public_path('boq-images/' . $request->old_image[$i]))) {
                        unlink(public_path('boq-images/' . $request->old_image[$i]));
                    }

                    $image = $request->file('image')[$i]; 
                    $imageName = time() . '-' . $i . '.' . $image->extension();
                    
                    $image->move(public_path('boq-images'), $imageName);
                    
                    $detail_data['image'] = $imageName; // Store images in an array
                }


                DB::table('estimate_detail')->insertGetId($detail_data);
            }

            // Update invoice if it exists
            $invoice = DB::table('invoice_master')->where('InvoiceNo', $request->input('EstimateNo'))->first();
            if ($invoice) {
                $estimate_master = DB::table('estimate_master')->where('EstimateMasterID', $EstimateMasterID)->first();

                DB::table('invoice_master')
                    ->where('InvoiceNo', $request->input('EstimateNo'))
                    ->update([
                        'DiscountAmount' => $estimate_master->Discount,
                        'TaxType' => $estimate_master->TaxType,
                        'Tax' => $estimate_master->Tax,
                        'SubTotal' => $estimate_master->SubTotal,
                        'Total' => $estimate_master->SubTotal - $estimate_master->Discount,
                        'GrandTotal' => $estimate_master->GrandTotal,
                        'Balance' => $estimate_master->GrandTotal - $invoice->Paid,
                        'UserID' => session::get('UserID'),
                    ]);
            }

            DB::commit(); // Commit the transaction if everything is successful
            return redirect(route('boq.index'))->with('error', 'Estimate updated successfully')->with('class', 'success');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback the transaction if there is an error
            dd($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to update estimate: ' . $e->getMessage())->with('class', 'danger');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        // $pagetitle = 'BOQ Delete';
        // $boq = DB::table('estimate_master')->where('EstimateMasterID', $id)->first();
        
        // $estimate_no = $boq->EstimateNo;
        // $lead = DB::table('leads')->where('BOQ_number', $estimate_no)->first();
        // if ($lead) {
        //     // Update the lead to remove the BOQ number
        //     DB::table('leads')->where('BOQ_number', $estimate_no)->update(['BOQ_number' => null]);
        // }


       
        // DB::table('estimate_master')->where('EstimateMasterID', $id)->delete();

        // DB::table('estimate_detail')->where('EstimateMasterID', $id)->delete();

        // return redirect(route('boq.index'))->with('error', 'BOQ Delete Successful')->with('class', 'success');

    }

   
    public function boqViewPDF($EstimateMasterID,$BranchID)
    {
      
        // $obj = new Arabic();
        // $eits =  $obj->en2ar("Extensive IT Service");
    

        
        $pagetitle = 'BOQ';
        $estimate = DB::table('v_estimate_master')->where('EstimateMasterID', $EstimateMasterID)->get();
        // $sub_service_id = 
        $estimate_details = DB::table('v_estimate_detail')->where('EstimateMasterID', $EstimateMasterID)->get();

        $services=DB::table('services')->whereIn('id', function($query) use ($EstimateMasterID)
        {
            $query->select('services_id')
                ->from('v_estimate_detail')
                ->where('EstimateMasterID',$EstimateMasterID);
        })->get();

        $party = DB::table('party')->where('PartyID',$estimate[0]->PartyID)->first();



        $company = DB::table('company')->get();
        $pdf = PDF::loadView('boq.boq_view_pdf', compact('party','services','estimate', 'pagetitle', 'company', 'estimate_details'));
        //return $pdf->download('pdfview.pdf');
        // $pdf->setpaper('A4', 'portiate');
        $pdf->set_option('isPhpEnabled',true);
        return $pdf->stream();
    }

    public function createRevision($id){
    
        // Fetch the estimate master record
        $estimate_master = DB::table('estimate_master')->where('EstimateMasterID', $id)->first();

        // Count the number of records with the same EstimateNo
        $no_records = DB::table('estimate_master')->where('EstimateNo', $estimate_master->EstimateNo)->count();

        // convert into array 
        $new_estimate_master = collect($estimate_master)->except('EstimateMasterID')->toArray();

       
        $new_estimate_master['ReferenceNo'] = $this->updateString($estimate_master->ReferenceNo, $no_records);
        $new_estimate_master['EstimateDate'] =  date('Y-m-d'); // changing the date to today

        // Insert the new estimate master record and get the ID
        $NewEstimateMasterID = DB::table('estimate_master')->insertGetId($new_estimate_master);

        //fetching the record of estimate master detail
        $estimate_detail = DB::table('estimate_detail')
        ->select('EstimateMasterID','EstimateDetailID')
        ->where('EstimateMasterID', $id)
        ->get();

        //looping to each record to create a copy
        foreach($estimate_detail as $detail){
            $new_detail = collect(
                DB::table('estimate_detail')->where('EstimateDetailID', $detail->EstimateDetailID)->first())
                ->except('EstimateDetailID')
                ->toArray();
                $new_detail['EstimateMasterID'] =  $NewEstimateMasterID ; // changing the date to today
                $new_detail['EstimateDate'] =  date('Y-m-d'); // changing the date to today

            $store_new_detail = DB::table('estimate_detail')->insertGetId($new_detail);
        }

        DB::table('estimate_master')
        ->where('EstimateMasterID', $estimate_master->EstimateMasterID)
        ->update(['Status' => 'Revised']);
          return redirect(route('boq.index'))->with('error', 'Saved Successfully')->with('class', 'success');


    }

    function updateString($string, $no) {
        $leftValue = '';
        
        // Iterate through each character in the string to find the position of the first hyphen
        for ($i = 0; $i < strlen($string); $i++) {
            if ($string[$i] == '-') {
                break;
            }
            $leftValue .= $string[$i];
        }
    
        // Rebuild the string with the new number
        $updatedString = 'R' . $no ." " .substr($string, strlen($leftValue));
        
        return $updatedString;
    }


    public function createInvoice($id){

        // Fetch the estimate master record
        $estimate_master = DB::table('estimate_master')->where('EstimateMasterID', $id)->first();

      
      

        $invoice_mst = array(
            'InvoiceMasterID' => $estimate_master->EstimateMasterID,
            'InvoiceNo' => $estimate_master->EstimateNo,
            'InvoiceType' =>'Invoice',
            // 'InvoiceTypeID' => '',
            'Date' => today(),
            'PartyID' => $estimate_master->PartyID,
            // 'DueDate' => '',
            // 'PaymentMode' => '',
            'DiscountAmount' => $estimate_master->Discount,
            'TaxType' => $estimate_master->TaxType,
            'Tax' => $estimate_master->Tax,
            'SubTotal' => $estimate_master->SubTotal,
            'Total' => $estimate_master->SubTotal - $estimate_master->Discount ,
            'GrandTotal' => $estimate_master->GrandTotal,
            'Paid' => 0,
            'Balance' => $estimate_master->GrandTotal,
            'UserID' => session::get('UserID'),
        );

        $id = DB::table('invoice_master')->insertGetId($invoice_mst);

        //changing the status
        DB::table('estimate_master')
        ->where('EstimateMasterID', $estimate_master->EstimateMasterID)
        ->update(['Status' => 'Invoice Created']);

        return redirect('/Invoice');
              
    }

    public function generateEstimateNo($branch_id)
    {
        $branch = DB::table('branch')->select('BranchCode')->where('BranchID',$branch_id)->first();

        $data = DB::table('estimate_master')
                ->select(DB::raw('LPAD(IFNULL(MAX(right(EstimateNo,5)),0)+1,5,0) as VHNO '))->where('BranchID',$branch_id)->get();

        $vhno = $branch->BranchCode.'-'.date('Y').'-'.$data[0]->VHNO;

        return $vhno;


       
    }

    public function generateReferenceNo(){
        $estimate_master = DB::table('estimate_master')
                ->select(DB::raw('LPAD(IFNULL(MAX(right(EstimateNo,5)),0)+1,5,0) as EstimateNo'))
                ->get();

        $referanceNo = 'R0 - ' . date("y - ") . $estimate_master[0]->EstimateNo;

        return $referanceNo;
    }
    
 public function boqExport($id)
    {
        $referenceNo = DB::table('estimate_master')->where('EstimateMasterID', $id)->value('ReferenceNo');

         return Excel::download(new BoqExport($id), $referenceNo.'.xlsx');
    }



       
}
