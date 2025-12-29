<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;


class EstimateController extends Controller
{
    public function Estimate()
    {

        $pagetitle = 'Quotation';
        return view('estimate.estimate', compact('pagetitle'));
    }


    public function ajax_estimate(Request $request)
    {
        Session::put('menu', 'Vouchers');
        $pagetitle = 'Estimates';
        if ($request->ajax()) {
            $data = DB::table('v_estimate_master')->orderBy('EstimateMasterID')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // if you want to use direct link instead of dropdown use this line below
                    // <a href="javascript:void(0)"  onclick="edit_data('.$row->customer_id.')" >Edit</a> | <a href="javascript:void(0)"  onclick="del_data('.$row->customer_id.')"  >Delete</a>

                     // <a href="' . URL('/EstimateView/' . $row->EstimateMasterID) . '"><i class="font-size-18 mdi mdi-eye-outline align-middle me-1 text-secondary"></i></a>
                    
                    
                     $btn = '
                    <div class="d-flex align-items-center col-actions">
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal font-size-18"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-33px, 27px);" data-popper-placement="bottom-end">
                            <li><a href="' .URL('/EstimateViewPDF/' . $row->EstimateMasterID) . '/' . $row->BranchID . '" target="_blank" class="dropdown-item"><i class="mdi mdi-file-pdf font-size-16  me-1" style="color:#FF5733;"></i> View Quotation</a></li>
                                <li><a href="' . URL('/EstimateEdit/' . $row->EstimateMasterID) . '" class="dropdown-item"><i class="bx bx-pencil font-size-16 text-secondary me-1"></i> Edit Quotation</a></li>
                                <li><a href="javascript:void(0)" onclick="confirmRedirect(\' ' . URL('/CreateEstimateRevision/' . $row->EstimateMasterID) . '\')" class="dropdown-item">  <i class="text-primary font-size-18 mdi mdi-content-copy align-middle me-1 text-secondary"></i> Create Revision</a></li>
                                <li><a href="javascript:void(0)" onclick="delete_estimate(' . $row->EstimateMasterID . ')" class="dropdown-item"><i class="bx bx-trash font-size-16 text-danger me-1"></i> Delete Quotation</a></li>
                            </ul>
                        </div>
                    </div>';
                   
                    
                    
                    
                //      $btn = '

                //        <div class="d-flex align-items-center col-actions">';

                //          if ($row->Status == 'Pending') {
                //         $btn .= '<a href="' . URL('/EstimateApprove/' . $row->EstimateMasterID) . '"><i class="font-size-18 mdi mdi-check align-middle me-1 text-secondary"></i></a>';
                //     }  else
                //     {
                //         $btn .= '<a href="' . URL('/InvoiceCreateAuto/' . $row->EstimateMasterID) . '">INV</a>';
                //     }  


                //     $btn = '
                //     <a target="_blank" href="' . URL('/EstimateViewPDF/' . $row->EstimateMasterID) . '/' . $row->BranchID . '">
                //         <i class="font-size-18 mdi mdi-file-pdf-outline align-middle me-1 text-secondary"></i>
                //     </a>
                //     <a href="javascript:void(0)" onclick="delete_estimate(' . $row->EstimateMasterID . ')" ><i class="font-size-18 bx bx-trash text-danger align-middle me-1 text-secondary"></i></a>

                //     <a href="' . URL('/EstimateEdit/' . $row->EstimateMasterID) . '">
                //         <i class="font-size-18 mdi mdi-pencil align-middle me-1 text-secondary"></i>
                //     </a>
                    
                  
                //     <a href="#" onclick="confirmRedirect(\' ' . URL('/CreateEstimateRevision/' . $row->EstimateMasterID) . '\'); return false;">
                //         <i class="font-size-18 mdi mdi-content-copy align-middle me-1 text-secondary"></i>
                //     </a>
                // </div>';
                
                return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('estimate.estimate', 'pagetitle');
    }



     public  function ajax_estimate_vhno(request $request)
    {
        $d = array(
            'BranchID' => $request->BranchID,

        );

        $branch = DB::table('branch')->select('BranchCode')->where('BranchID',$request->BranchID)->first();

        $data = DB::table('estimate_master')
                ->select(DB::raw('LPAD(IFNULL(MAX(right(EstimateNo,5)),0)+1,5,0) as VHNO '))->where('BranchID',$request->BranchID)->get();

        $vhno = $branch->BranchCode.'-'.date('Y').'-'.$data[0]->VHNO;

        return array('vhno' => $vhno);
        

    }

    public function EstimateCreate()
    {

        // dd('reached');
        $pagetitle = 'Create Estimate';
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
        return view('estimate.estimate_create', compact('referanceNo','chartofacc', 'party', 'pagetitle', 'estimate_master', 'items', 'item', 'challan_type', 'user', 'invoice_type', 'tax','job','po','vhno','unit','branch','services'));
    }

    public  function EstimateSave(Request $request)
    {
   
         $estimate_master = array(
            'EstimateNo' => $request->input('EstimateNo'),
            'BranchID' => $request->input('BranchID'),
            'PartyID' => $request->input('PartyID'),
            'WalkinCustomerName' => $request->input('WalkinCustomerName'),
            'PlaceOfSupply' => $request->input('PlaceOfSupply'),
            'ReferenceNo' => $request->input('ReferenceNo'),
            'Date' => $request->input('Date'),
            'EstimateDate' => $request->input('Date'),
            'ExpiryDate' => $request->input('DueDate'),
            'Subject' => $request->input('Subject'),
            'SubTotal' => $request->input('SubTotal'),
            'Discount' => $request->input('DiscountAmount'),
            'DiscountPer' => $request->input('DiscountPer'),

            'TaxType' => $request->input('TaxType'),
            'TaxPer' => $request->input('grandtotaltax') == 0 ? 0 : 5,
            'Tax' => $request->input('grandtotaltax'),
            'Shipping' => $request->input('Shipping'),
            'Total' => $request->input('Total'),
            'GrandTotal' => $request->input('Grandtotal'),
            'CustomerNotes' => $request->input('CustomerNotes'),
            'DescriptionNotes' => $request->input('DescriptionNotes'),
            'UserID' => Session::get('UserID'),

            'InquiryDate' => $request->input('InquiryDate'),
            'InquiryNo' => $request->input('InquiryNo'),
            'Country' => $request->input('Country'),
            'EquipmentUser_PlantSite' => $request->input('EquipmentUser_PlantSite'),
            'VendorReference' => $request->input('VendorReference'),
            'Equipment' => $request->input('Equipment'),
            'Type' => $request->input('Type'),
            'SectionalAssemblyGroup' => $request->input('SectionalAssemblyGroup'),
            'OriginMaterial' => $request->input('OriginMaterial'),
            'SectionalAssemblyGroup' => $request->input('SectionalAssemblyGroup'),
            'CoveringLetter' => $request->input('CoveringLetter'),



        );
     

        $EstimateMasterID = DB::table('estimate_master')->insertGetId($estimate_master);
     
            for ($i = 0; $i < count($request->ItemID); $i++) {
                $challan_det = array(
                    'EstimateMasterID' =>  $EstimateMasterID,
                    'EstimateNo' => $request->input('EstimateNo'),
                    'EstimateDate' => $request->input('Date'),
                    'services_id' => $request->services_id[$i],
                    // 'ItemID' => $request->ItemID[$i],
                    'ItemID' => 197,
                    'Description' => $request->Description[$i],
                    'TaxPer' => $request->Tax[$i],
                    'Tax' => $request->TaxVal[$i],
                    'LS' => $request->LS[$i],
                    'Qty' => $request->Qty[$i],
                    'Rate' => $request->Price[$i],
                    'Total' => $request->ItemTotal[$i],
                    // 'Discount' => $request->Discount[$i],
                    // 'DiscountType' => $request->DiscountType[$i],
                    'Gross' => $request->Gross[$i],
                    // 'DiscountAmountItem' => $request->DiscountAmountItem[$i],
                    // 'UnitName' => $request->UnitName[$i],
                    // 'UnitQty' => $request->UnitQty[$i],
                );

                $id = DB::table('estimate_detail')->insertGetId($challan_det);
            }
      
        return redirect('Estimate')->with('error', 'Saved Successfully')->with('class', 'success');
    }


    public function EstimateDelete($id)
    {

        $pagetitle = 'Estimate';
        $id = DB::table('estimate_master')->where('EstimateMasterID', $id)->delete();
        $id = DB::table('estimate_detail')->where('EstimateMasterID', $id)->delete();




        return redirect('Estimate')->with('error', 'Deleted Successfully')->with('class', 'success');
    }



    public function EstimateView($id)
    {
        // dd('hello');
        $pagetitle = 'Estimate';
        $estimate = DB::table('v_estimate_master')->where('EstimateMasterID', $id)->get();
        $estimate_detail = DB::table('v_estimate_detail')->where('EstimateMasterID', $id)->get();
        $company = DB::table('company')->get();

        Session()->forget('VHNO');

        Session::put('VHNO', $estimate[0]->EstimateNo);



        return view('estimate.estimate_view', compact('estimate', 'pagetitle', 'company', 'estimate_detail'));
    }

    public function EstimateViewPDF($id,$brancid)
    {
        // dd('hello');
        $pagetitle = 'Estimate';
        $estimate = DB::table('v_estimate_master')->where('EstimateMasterID', $id)->get();
        $sub_service_id = 
        $estimate_detail = DB::table('v_estimate_detail')->where('EstimateMasterID', $id)->get();
       
       



        $services=DB::table('services')->whereIn('id', function($query) use ($id)
    {
        $query->select('services_id')
              ->from('v_estimate_detail')
              ->where('EstimateMasterID',$id);
    })
    ->get();

 
        
        // foreach ($service_ids as $service_id)
        //    {
        //          $estimate_detail = DB::table('v_estimate_detail')
        //          ->where('EstimateMasterID', $EstimateMasterID)
        //          ->where('service_id', $service_id)
        //          ->get();

        //          dd( $estimate_detail);
        //    } 


       
        $company = DB::table('company')->get();
        $pdf = PDF::loadView('estimate.estimate_view_pdf', compact('services','estimate', 'pagetitle', 'company', 'estimate_detail'));
        //return $pdf->download('pdfview.pdf');
        // $pdf->setpaper('A4', 'portiate');
        $pdf->set_option('isPhpEnabled',true);
        return $pdf->stream();
    }


    public function EstimateEdit($id)
    {
        // dd($id);
        $pagetitle = 'Estimate';
        $party = DB::table('party')->get();

        $tax = DB::table('tax')->where('Section', 'Estimate')->orderBy('TaxID','desc')->get();

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
 
        return view('estimate.estimate_edit', compact('services','chartofacc', 'party', 'pagetitle', 'estimate_master', 'items', 'item',  'user',  'estimate_detail', 'tax','branch','unit'));
        // return view('estimate.estimate_edit', compact('services','chartofacc', 'party', 'pagetitle', 'estimate_master', 'items', 'item',  'user',  'estimate_detail', 'tax','branch','unit','payment_plan'));
    }


    public  function EstimateUpdate(Request $request)
    {
      

        $estimate_mst = array(
             'EstimateNo' => $request->input('EstimateNo'),
            'BranchID' => $request->input('BranchID'),
            'PartyID' => $request->input('PartyID'),
            'WalkinCustomerName' => $request->input('WalkinCustomerName'),
            'PlaceOfSupply' => $request->input('PlaceOfSupply'),
            'ReferenceNo' => $request->input('ReferenceNo'),
            'Date' => $request->input('Date'),
            'EstimateDate' => $request->input('Date'),
            'ExpiryDate' => $request->input('DueDate'),
            'Subject' => $request->input('Subject'),
            'SubTotal' => $request->input('SubTotal'),
            'Discount' => $request->input('DiscountAmount'),
            'DiscountPer' => $request->input('DiscountPer'),

            'TaxType' => $request->input('TaxType'),
            'TaxPer' => $request->input('grandtotaltax') == 0 ? 0 : 5,
            'Tax' => $request->input('grandtotaltax'),
            'Shipping' => $request->input('Shipping'),
            'Total' => $request->input('Total'),
            'GrandTotal' => $request->input('Grandtotal'),
            'CustomerNotes' => $request->input('CustomerNotes'),
            'DescriptionNotes' => $request->input('DescriptionNotes'),
            'UserID' => Session::get('UserID'),

            'InquiryDate' => $request->input('InquiryDate'),
            'InquiryNo' => $request->input('InquiryNo'),
            'Country' => $request->input('Country'),
            'EquipmentUser_PlantSite' => $request->input('EquipmentUser_PlantSite'),
            'VendorReference' => $request->input('VendorReference'),
            'Equipment' => $request->input('Equipment'),
            'Type' => $request->input('Type'),
            'SectionalAssemblyGroup' => $request->input('SectionalAssemblyGroup'),
            'OriginMaterial' => $request->input('OriginMaterial'),
            'SectionalAssemblyGroup' => $request->input('SectionalAssemblyGroup'),
            'CoveringLetter' => $request->input('CoveringLetter'),


        );

        $estimate_mst = DB::table('estimate_master')->where('EstimateMasterID', $request->EstimateMasterID)->update($estimate_mst);

        $challanmasterdelete = DB::table('estimate_detail')->where('EstimateMasterID', $request->EstimateMasterID)->delete();





        $EstimateMasterID = $request->EstimateMasterID;

        // dd($ChallanMasterID);
        // when full payment is made


        // END OF SALE RETURN

        //  start for item array from invoice
        for ($i = 0; $i < count($request->ItemID); $i++) {
            $estimate_detail = array(
               'EstimateMasterID' =>  $EstimateMasterID,
                'EstimateNo' => $request->input('EstimateNo'),
                'EstimateDate' => $request->input('Date'),
                'services_id' => $request->services_id[$i],
                'ItemID' => 197,// set by default on both create and edit
                'Description' => $request->Description[$i],
                 'TaxPer' => $request->Tax[$i],
                 'Tax' => $request->TaxVal[$i],
                'LS' => $request->LS[$i],
                'Qty' => $request->Qty[$i],
                'Rate' => $request->Price[$i],
                'Total' => $request->ItemTotal[$i],
                // 'Discount' => $request->Discount[$i],
                // 'DiscountType' => $request->DiscountType[$i],
                'Gross' => $request->Gross[$i],
                // 'DiscountAmountItem' => $request->DiscountAmountItem[$i],



                // 'UnitName' => $request->UnitName[$i],
                // 'UnitQty' => $request->UnitQty[$i],

            );

            $id = DB::table('estimate_detail')->insertGetId($estimate_detail);
        }


        // end foreach


        return redirect('Estimate')->with('error', 'Estimate updated')->with('class', 'success');
    }

      public function EstimateApprove($id)
    {
        $pagetitle = 'SaleOrder';
        DB::table('estimate_master')
            ->where('EstimateMasterID', $id)
            ->update(['Status' => 'Approved']);
        return redirect('Estimate')->with('error', 'Approved Successfully')->with('class', 'success');
    }


    public function PaymentPlan($id)
    {       

        $pagetitle='Payment Plan';
        $payment_plan = DB::table('payment_plan')->where('EstimateMasterID',$id)->get();
         return view ('estimate.payment_plan',compact('pagetitle','payment_plan')); 
    }


    public  function EstimatePaymentReceived (request $request){
      if ($request->file('File')!=null)
                     {
 
                   $this->validate($request, [
     
                        // 'file' => 'required|mimes:jpeg,png,jpg,gif,svg,xlsx,pdf|max:1000',
                          'File' => 'required|image|mimes:jpeg,png,jpg,gif,doc,png,docx,|max:20000',
     
                     ] );
     
                  $file = $request->file('File');
                  $input['filename'] = time().'.'.$file->extension();
                  
                  
     
     
     
                  $destinationPath = public_path('/payments');
     
                  $file->move($destinationPath, $input['filename']);
                
                     // $destinationPath = public_path('/images');
                     // $image->move($destinationPath, $input['imagename']);
     
                    // $input['filename']===========is final data in it.
                   
     
                  
     
                  $data = array ( 
                 
                  'PaymentDate' => date('Y-m-d'),
     
                
                 'Status' => 'Done',  
                  'JobCompletionReport'=> $input['filename'],
                
                );
     
                   
     
        
        $up= DB::table('payment_plan')->where('PaymentPlanID' ,$request->PaymentPlanID)->update($data);


        
        return redirect()->back()->with('error','Updated Successfully')->with('class','success');
        }

    }

    public function createEstimateRevision($id)
    {

        $estimate_mst = DB::table('estimate_master')->where('EstimateMasterID', $id)->first();
        

        $no_records = DB::table('estimate_master')->where('EstimateNo', $estimate_mst->EstimateNo)->count();

            




        $estimate_master = array(
            'EstimateNo' => $estimate_mst->EstimateNo,
            'BranchID' => $estimate_mst->BranchID,
            'PartyID' => $estimate_mst->PartyID,
            'WalkinCustomerName' => $estimate_mst->WalkinCustomerName,
            'PlaceOfSupply' => $estimate_mst->PlaceOfSupply,
            'ReferenceNo' => $this->updateString($estimate_mst->ReferenceNo, $no_records),
            'Date' => $estimate_mst->Date,
            'EstimateDate' => $estimate_mst->Date,
            'ExpiryDate' => $estimate_mst->ExpiryDate,
            'Subject' => $estimate_mst->Subject,
            'SubTotal' => $estimate_mst->SubTotal,
            'Discount' => $estimate_mst->Discount,
            'DiscountPer' => $estimate_mst->DiscountPer,

            'TaxType' => $estimate_mst->TaxType,
            'TaxPer' => $estimate_mst->TaxPer,
            'Tax' => $estimate_mst->Tax,
            'Shipping' => $estimate_mst->Shipping,
            'Total' => $estimate_mst->Total,
            'GrandTotal' => $estimate_mst->GrandTotal,
            'CustomerNotes' => $estimate_mst->CustomerNotes,
            'DescriptionNotes' => $estimate_mst->DescriptionNotes,
            'UserID' => Session::get('UserID'),

            'InquiryDate' => $estimate_mst->InquiryDate,
            'InquiryNo' => $estimate_mst->InquiryNo,
            'Country' => $estimate_mst->Country,
            'EquipmentUser_PlantSite' => $estimate_mst->EquipmentUser_PlantSite,
            'VendorReference' => $estimate_mst->VendorReference,
            'Equipment' => $estimate_mst->Equipment,
            'Type' => $estimate_mst->Type,
            'SectionalAssemblyGroup' => $estimate_mst->SectionalAssemblyGroup,
            'OriginMaterial' => $estimate_mst->OriginMaterial,
            'SectionalAssemblyGroup' => $estimate_mst->SectionalAssemblyGroup,
            'CoveringLetter' => $estimate_mst->CoveringLetter,



        );
     

        $EstimateMasterID = DB::table('estimate_master')->insertGetId($estimate_master);


        $estimate_detail = DB::table('estimate_detail')->where('EstimateMasterID', $id)->get();

     
            foreach($estimate_detail as $value){

                DB::table('estimate_detail')->insert([
                    'EstimateMasterID' =>  $EstimateMasterID,
                    'EstimateNo' => $value->EstimateNo,
                    'EstimateDate' => $value->EstimateDate,
                    'services_id' => $value->services_id,
                    'ItemID' => $value->ItemID,
                    'Description' => $value->Description,
                    'TaxPer' => $value->TaxPer,
                    'Tax' => $value->Tax,
                    'LS' => $value->LS,
                    'Qty' => $value->Qty,
                    'Rate' => $value->Rate,
                    'Total' => $value->Total,
                    'Gross' => $value->Gross,
                ]);          
            }
                
      
        return redirect('Estimate')->with('error', 'Saved Successfully')->with('class', 'success');
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



}//end of controller