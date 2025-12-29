<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;


class PurchaseOrderController extends Controller
{
    public function Estimate()
    {

        $pagetitle = 'All Estimates';
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
                    $btn = '

                       <div class="d-flex align-items-center col-actions">


                <a href="' . URL('/EstimateView/' . $row->EstimateMasterID) . '"><i class="font-size-18 mdi mdi-eye-outline align-middle me-1 text-secondary"></i></a>

                <a href="' . URL('/EstimateEdit/' . $row->EstimateMasterID) . '"><i class="font-size-18 mdi mdi-pencil align-middle me-1 text-secondary"></i></a>
                
                <a  target="_blank" href="' . URL('/EstimateViewPDF/' . $row->EstimateMasterID) . '"><i class="font-size-18 mdi mdi-file-pdf-outline align-middle me-1 text-secondary"></i></a>
                
                 <a href="' . URL('/EstimateDelete/' . $row->EstimateMasterID) . '"><i class="font-size-18 mdi mdi-trash-can-outline align-middle me-1 text-secondary"></i></a>




                       </div>';

                    //class="edit btn btn-primary btn-sm"
                    // <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
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
        
        $job = DB::table('job')->get();
        $po = DB::table('invoice_master')->select('InvoiceNo')->where('InvoiceType','PO')->get();

        // dd($item);
        $user = DB::table('user')->get();
        $chartofacc = DB::table('chartofaccount')->get();
        $estimate_master = DB::table('estimate_master')
            ->select(DB::raw('LPAD(IFNULL(MAX(right(EstimateNo,5)),0)+1,5,0) as EstimateNo'))
            ->get();

           $vhno = DB::table('invoice_master')
            ->select(DB::raw('LPAD(IFNULL(MAX(right(InvoiceNo,5)),0)+1,5,0) as VHNO '))->whereIn(DB::raw('left(InvoiceNo,3)'), ['TAX'])->get();    
 $unit = DB::table('unit')->get();

        $tax = DB::table('tax')->where('Section', 'Estimate')->get();

        $challan_type = DB::table('challan_type')->get();
        $invoice_type = DB::table('invoice_type')->get();
        return view('estimate.estimate_create', compact('chartofacc', 'party', 'pagetitle', 'estimate_master', 'items', 'item', 'challan_type', 'user', 'invoice_type', 'tax','job','po','vhno','unit','branch'));
    }

    public  function EstimateSave(Request $request)
    {
         // dd($request->all());
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
        // dd($challan_mst);
        // $id= DB::table('')->insertGetId($data);

        $EstimateMasterID = DB::table('estimate_master')->insertGetId($estimate_master);


        //  start for item array from invoice
        for ($i = 0; $i < count($request->ItemID); $i++) {
            $challan_det = array(
                'EstimateMasterID' =>  $EstimateMasterID,
                'EstimateNo' => $request->input('EstimateNo'),
                'EstimateDate' => $request->input('Date'),
                'ItemID' => $request->ItemID[$i],
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



                'UnitName' => $request->UnitName[$i],
                'UnitQty' => $request->UnitQty[$i],


                




            );

            $id = DB::table('estimate_detail')->insertGetId($challan_det);
        }


        // end foreach

        // dd('hello');
        return redirect('Estimate')->with('error', 'Challan Saved')->with('class', 'success');
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

    public function EstimateViewPDF($id)
    {
        // dd('hello');
        $pagetitle = 'Estimate';
        $estimate = DB::table('v_estimate_master')->where('EstimateMasterID', $id)->get();
        $estimate_detail = DB::table('v_estimate_detail')->where('EstimateMasterID', $id)->get();
        $company = DB::table('company')->get();
        $pdf = PDF::loadView('estimate.estimate_view_pdf', compact('estimate', 'pagetitle', 'company', 'estimate_detail'));
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

        $tax = DB::table('tax')->where('Section', 'Estimate')->get();

        $items = DB::table('item')->get();
        $item = json_encode($items);

        $branch = DB::table('branch')->get();
        $unit = DB::table('unit')->get();
        // dd($item);
        $user = DB::table('user')->get();
        $chartofacc = DB::table('chartofaccount')->get();
        $challan_master = DB::table('challan_master')
            ->select(DB::raw('LPAD(IFNULL(MAX(ChallanMasterID),0)+1,4,0) as ChallanMasterID'))
            ->get();
        $challan_type = DB::table('challan_type')->get();
        $estimate_master = DB::table('estimate_master')->where('EstimateMasterID', $id)->get();
        $estimate_detail = DB::table('estimate_detail')->where('EstimateMasterID', $id)->get();
         // dd($estimate_detail);




        return view('estimate.estimate_edit', compact('chartofacc', 'party', 'pagetitle', 'estimate_master', 'items', 'item',  'user',  'estimate_detail', 'tax','branch','unit'));
    }


    public  function EstimateUpdate(Request $request)
    {
// dd($request->all());
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


        // dd($challan_mst);
        // $id= DB::table('')->insertGetId($data);
        // dd($request->EstimateMasterID);
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
                'ItemID' => $request->ItemID[$i],
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



                'UnitName' => $request->UnitName[$i],
                'UnitQty' => $request->UnitQty[$i],

            );

            $id = DB::table('estimate_detail')->insertGetId($estimate_detail);
        }


        // end foreach


        return redirect('Estimate')->with('error', 'Estimate updated')->with('class', 'success');
    }
}
