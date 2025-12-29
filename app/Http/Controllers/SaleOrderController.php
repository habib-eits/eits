<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
// use Session;
use Yajra\DataTables\DataTables;

use PDF;

class SaleOrderController extends Controller
{
    public function SaleOrder()
    {
        $pagetitle = 'Sale Orders';
        return view('saleorder.saleorder', compact('pagetitle'));
    }
    public function ajax_saleorder(Request $request)
    {
        Session::put('menu', 'Vouchers');
        $pagetitle = 'Sale Orders';
        if ($request->ajax()) {
            $data = DB::table('v_saleorder_master')->orderBy('SaleOrderMasterID')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex align-items-center col-actions">';
                    if ($row->status == 'Pending') {
                        $btn .= '<a href="' . URL('/SaleOrderApprove/' . $row->SaleOrderMasterID) . '"><i class="font-size-18 mdi mdi-check align-middle me-1 text-secondary"></i></a><a href="' . URL('/SaleOrderView/' . $row->SaleOrderMasterID) . '"><i class="font-size-18 mdi mdi-eye-outline align-middle me-1 text-secondary"></i></a>
                        <a href="' . URL('/SaleOrderEdit/' . $row->SaleOrderMasterID) . '"><i class="font-size-18 mdi mdi-pencil align-middle me-1 text-secondary"></i></a><a href="' . URL('/SaleOrderDelete/' . $row->SaleOrderMasterID) . '"><i class="font-size-18 mdi mdi-trash-can-outline align-middle me-1 text-secondary"></i></a>';
                    } else {
                        $btn .= '<a href="' . URL('/createLPO/' . $row->SaleOrderMasterID) . '"><span class="font-size-14 align-middle me-1 text-secondary">LPO</span></a><a href="' . URL('/SaleOrderView/' . $row->SaleOrderMasterID) . '"><i class="font-size-18 mdi mdi-eye-outline align-middle me-1 text-secondary"></i></a><a  target="_blank" href="' . URL('/SaleOrderViewPDF/' . $row->SaleOrderMasterID) . '"><i class="font-size-18 mdi mdi-file-pdf-outline align-middle me-1 text-secondary"></i></a>';
                    }
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('saleorder.saleorder', 'pagetitle');
    }
    public function SaleOrderCreate()
    {
        $pagetitle = 'Create Sale Order';
        $party = DB::table('party')->get();

        $items = DB::table('item')->get();
        $item = json_encode($items);
        $user = DB::table('user')->get();
        $chartofacc = DB::table('chartofaccount')->get();
        $saleorder_master = DB::table('saleorder_master')
            ->select(DB::raw('LPAD(IFNULL(MAX(right(SaleOrderNo,5)),0)+1,5,0) as SaleOrderNo'))
            ->get();
        $job_number = DB::table('saleorder_master')
            ->select(DB::raw('LPAD(IFNULL(MAX(right(JobNo,5)),0)+1,5,0) as JobNo'))
            ->orderBy('JobNo', 'desc')
            ->first();
        $tax = DB::table('tax')->where('Section', 'SaleOrder')->get();

        $challan_type = DB::table('challan_type')->get();
        $invoice_type = DB::table('invoice_type')->get();
        return view('saleorder.saleorder_create', compact('chartofacc', 'party', 'pagetitle', 'saleorder_master', 'items', 'item', 'challan_type', 'user', 'invoice_type', 'tax', 'job_number'));
    }
    public  function SaleOrderSave(request $request)
    {
        // dd($request->all());
        $challan_mst = array(
            'SaleOrderNo' => $request->input('SaleOrderNo'),
            'PartyID' => $request->input('PartyID'),
            'WalkinCustomerName' => $request->input('WalkinCustomerName'),
            'PlaceOfSupply' => $request->input('PlaceOfSupply'),
            'ReferenceNo' => $request->input('ReferenceNo'),
            'Date' => $request->input('Date'),
            'SaleOrderDate' => $request->input('Date'),
            'ExpiryDate' => $request->input('DueDate'),
            'Subject' => $request->input('Subject'),
            'SubTotal' => $request->input('SubTotal'),
            'Discount' => $request->input('DiscountAmount'),
            'DiscountPer' => $request->input('DiscountPer'),
            'TaxType' => $request->input('TaxType'),
            // 'TaxPer' => $request->input('Taxpercentage'),
            'TaxPer' => $request->input('grandtotaltax') == 0 ? 0 : 5,
            'Tax' => $request->input('grandtotaltax'),
            'Shipping' => $request->input('Shipping'),
            'Total' => $request->input('Total'),
            'GrandTotal' => $request->input('Grandtotal'),
            'CustomerNotes' => $request->input('CustomerNotes'),
            'DescriptionNotes' => $request->input('DescriptionNotes'),
            'JobNo' => $request->input('JobNo'),
            'UserID' => session::get('UserID'),
        );
        $SaleOrderMasterID = DB::table('saleorder_master')->insertGetId($challan_mst);
        for ($i = 0; $i < count($request->ItemID); $i++) {
            $challan_det = array(
                'SaleOrderMasterID' =>  $SaleOrderMasterID,
                'SaleOrderNo' => $request->input('SaleOrderNo'),
                'SaleOrderDate' => $request->input('Date'),
                'ItemID' => $request->ItemID[$i],
                'Description' => $request->Description[$i],
                // 'TaxPer' => $request->Tax[$i],
                // 'Tax' => $request->TaxVal[$i],
                'Qty' => $request->Qty[$i],
                'Rate' => $request->Price[$i],
                'Total' => $request->ItemTotal[$i],
                // 'Discount' => $request->Discount[$i],
                // 'DiscountType' => $request->DiscountType[$i],
                'Gross' => $request->Gross[$i],
                // 'DiscountAmountItem' => $request->DiscountAmountItem[$i],

            );
            $id = DB::table('saleorder_detail')->insertGetId($challan_det);
        }
        return redirect('SaleOrder')->with('error', 'Challan Saved')->with('class', 'success');
    }
    public function SaleOrderDelete($id)
    {
        $pagetitle = 'SaleOrder';
        $id = DB::table('saleorder_master')->where('SaleOrderMasterID', $id)->delete();
        $id = DB::table('saleorder_detail')->where('SaleOrderMasterID', $id)->delete();
        return redirect('SaleOrder')->with('error', 'Deleted Successfully')->with('class', 'success');
    }
    public function SaleOrderApprove($id)
    {
        $pagetitle = 'SaleOrder';
        DB::table('saleorder_master')
            ->where('SaleOrderMasterID', $id)
            ->update(['status' => 'Approved']);
        return redirect('SaleOrder')->with('error', 'Approved Successfully')->with('class', 'success');
    }
    public function SaleOrderView($id)
    {
        $pagetitle = 'SaleOrder';
        $saleorder = DB::table('v_saleorder_master')->where('SaleOrderMasterID', $id)->get();
        $saleorder_detail = DB::table('v_saleorder_detail')->where('SaleOrderMasterID', $id)->get();
        $company = DB::table('company')->get();
        session()->forget('VHNO');
        session::put('VHNO', $saleorder[0]->SaleOrderNo);
        return view('saleorder.saleorder_view', compact('saleorder', 'pagetitle', 'company', 'saleorder_detail'));
    }

    public function SaleOrderViewPDF($id)
    {
        $pagetitle = 'SaleOrder';
        $saleorder = DB::table('v_saleorder_master')->where('SaleOrderMasterID', $id)->get();
        $saleorder_detail = DB::table('v_saleorder_detail')->where('SaleOrderMasterID', $id)->get();
        $company = DB::table('company')->get();
        $pdf = PDF::loadView('saleorder.saleorder_view_pdf', compact('saleorder', 'pagetitle', 'company', 'saleorder_detail'));
        return $pdf->stream();
    }
    public function SaleOrderEdit($id)
    {
        $pagetitle = 'SaleOrder';
        $party = DB::table('party')->get();
        $tax = DB::table('tax')->where('Section', 'SaleOrder')->get();
        $items = DB::table('item')->get();
        $item = json_encode($items);
        $user = DB::table('user')->get();
        $chartofacc = DB::table('chartofaccount')->get();
        $challan_master = DB::table('challan_master')
            ->select(DB::raw('LPAD(IFNULL(MAX(ChallanMasterID),0)+1,4,0) as ChallanMasterID'))
            ->get();
        $challan_type = DB::table('challan_type')->get();
        $saleorder_master = DB::table('saleorder_master')->where('SaleOrderMasterID', $id)->get();
        $saleorder_detail = DB::table('saleorder_detail')->where('SaleOrderMasterID', $id)->get();
        return view('saleorder.saleorder_edit', compact('chartofacc', 'party', 'pagetitle', 'saleorder_master', 'items', 'item',  'user',  'saleorder_detail', 'tax'));
    }
    public  function SaleOrderUpdate(request $request)
    {
        // dd($request->all());
        $saleorder_mst = array(
            'SaleOrderNo' => $request->input('SaleOrderNo'),
            'PartyID' => $request->input('PartyID'),
            'WalkinCustomerName' => $request->input('WalkinCustomerName'),
            'PlaceOfSupply' => $request->input('PlaceOfSupply'),
            'ReferenceNo' => $request->input('ReferenceNo'),
            'Date' => $request->input('SaleOrderDate'),
            'SaleOrderDate' => $request->input('SaleOrderDate'),
            'ExpiryDate' => $request->input('DueDate'),
            'Subject' => $request->input('Subject'),
            'SubTotal' => $request->input('SubTotal'),
            'Discount' => $request->input('DiscountAmount'),
            'DiscountPer' => $request->input('DiscountPer'),
            'TaxType' => $request->input('TaxType'),
            // 'TaxPer' => $request->input('Taxpercentage'),
            'TaxPer' => $request->input('grandtotaltax') == 0 ? 0 : 5,
            'Tax' => $request->input('grandtotaltax'),
            'Shipping' => $request->input('Shipping'),
            'Total' => $request->input('Total'),
            'Grandtotal' => $request->input('Grandtotal'),
            'CustomerNotes' => $request->input('CustomerNotes'),
            'DescriptionNotes' => $request->input('DescriptionNotes'),
            'UserID' => session::get('UserID'),
        );
        $challanmaster = DB::table('saleorder_master')->where('SaleOrderMasterID', $request->SaleOrderMasterID)->update($saleorder_mst);
        $challanmasterdelete = DB::table('saleorder_detail')->where('SaleOrderMasterID', $request->SaleOrderMasterID)->delete();
        $SaleOrderMasterID = $request->SaleOrderMasterID;
        for ($i = 0; $i < count($request->ItemID); $i++) {
            $saleorder_detail = array(
                'SaleOrderMasterID' =>  $SaleOrderMasterID,
                'SaleOrderNo' => $request->input('SaleOrderNo'),
                'SaleOrderDate' => $request->input('Date'),
                'ItemID' => $request->ItemID[$i],
                'Description' => $request->Description[$i],
                // 'TaxPer' => $request->Tax[$i],
                // 'Tax' => $request->TaxVal[$i],
                'Qty' => $request->Qty[$i],
                'Rate' => $request->Price[$i],
                'Total' => $request->ItemTotal[$i],
                // 'Discount' => $request->Discount[$i],
                // 'DiscountType' => $request->DiscountType[$i],
                'Gross' => $request->Gross[$i],
                // 'DiscountAmountItem' => $request->DiscountAmountItem[$i],
            );
            $id = DB::table('saleorder_detail')->insertGetId($saleorder_detail);
        }
        return redirect('SaleOrder')->with('error', 'Challan Saved')->with('class', 'success');
    }
    public function createLPO($id){
        $saleorder_master = DB::table('saleorder_master')->where('SaleOrderMasterID',$id)->first();
        // dd($saleorder_master);
        $saleorder_detail = DB::table('saleorder_detail')->where('SaleOrderMasterID',$id)->get();
        $pagetitle = 'Local Purchase Order';
        $vhno = DB::table('purchase_order_master')
            ->select(DB::raw('LPAD(IFNULL(MAX(PurchaseOrderMasterID),0)+1,5,0) as VHNO '))
            ->get();

        session::put('VHNO', 'PON-' . $vhno[0]->VHNO);

        $tax = DB::table('tax')->where('Section', 'SaleOrder')->get();
        $supplier = DB::table('supplier')->get();
        $items = DB::table('item')->get();
        $user = DB::table('user')->get();


        $item = json_encode($items);
        return view('saleorder.createLPO', compact('vhno', 'supplier', 'user', 'items', 'item', 'tax', 'pagetitle', 'saleorder_detail', 'saleorder_master'));
    }
}
