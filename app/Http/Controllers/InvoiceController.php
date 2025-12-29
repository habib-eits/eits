<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use URL;
use Image;
use File;
use PDF;
use Yajra\DataTables\DataTables;


class InvoiceController extends Controller
{
  
    public function edit($id)
    {
       $invoice = DB::table('invoice_master')->where('InvoiceMasterID',$id)->first();

       $receipts = DB::table('receipt_master')->where('InvoiceMasterID',$id)->get();
    //    dd( $receipts );

       $party = DB::table('party')->where('PartyID',$invoice->PartyID)->first();

       $paymentModes = DB::table('payment_mode')->get();
        
       return view('invoice.edit', compact('invoice','receipts','party','paymentModes'));
    }

    public function update(Request $request, $id)
    {
      

        $invoice = DB::table('invoice_master')->where('InvoiceMasterID',$id)->first();

       
        
        
        DB::table('receipt_master')->insert([
            'InvoiceMasterID' => $invoice->InvoiceMasterID,
            'PartyID' => $invoice->PartyID,
            'UserID' => Session::get('UserID'),
            'Paid' => $request->input('received_amount'),
            'date' => $request->input('Date'),
            'Description' => $request->input('Description'),
            'PaymentMode' => $request->input('PaymentMode'),
            'ReferenceNo' => $request->input('ReferenceNo'),
        ]);

        $new_Paid = $invoice->Paid+ $request->input('received_amount');

        


        
        DB::table('invoice_master')
            ->where('InvoiceMasterID', $id)
            ->update([
                'Paid' => $new_Paid,
                'Balance' => ( $invoice->GrandTotal) - $new_Paid,
            
        ]);

        if($new_Paid == $invoice->GrandTotal)
        {
            DB::table('invoice_master')
            ->where('InvoiceMasterID', $id)
            ->update([
                'Status' => 'Paid',
            
            ]);
        }
        else{

            DB::table('invoice_master')
            ->where('InvoiceMasterID', $id)
            ->update([
                'Status' => 'Pending',
            
            ]);

        }

        

        return redirect('/Invoice');


    }
    
    public  function Invoice()
    {
        session::put('menu', 'Invoice');
        $pagetitle = 'Invoice';
        $users = DB::table('user')->get();   
        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        // $allow = check_role(session::get('UserID'), 'Invoice', 'List');
        // if ($allow == 0) {
        //     return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        // }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////


        return view('invoice.invoice', compact('pagetitle','users'));
    }

    public function ajax_invoice(Request $request)
    {
        $users = DB::table('user')->get();   
        session::put('menu', 'Invoice');
        $pagetitle = 'Invoice';
        if ($request->ajax()) {
            $data = DB::table('v_estimate_invoice_master')
                ->where('InvoiceType', 'Invoice')
                ->when($request->start_date, function ($query, $startDate) {
                        return $query->where('Date', '>=', $startDate);
                    })
                    ->when($request->end_date, function ($query, $endDate) {
                        return $query->where('Date', '<=', $endDate);
                    })
                    ->when($request->status, function ($query, $status) {
                        return $query->where('Status', $status);
                    })
                    ->when($request->user_id, function ($query, $user_id) {
                        return $query->where('UserID', $user_id);
                    })
                    ->orderBy('Date')
                ->get();




                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('margin_percent', function($row){

                    // $profit = ($row->GrandTotal > 0 ? $row->total_margin/$row->GrandTotal : 0)*100;
                    $profit = ($row->Total > 0 ? $row->total_margin/$row->Total : 0)*100;
                    return $profit.'%';
                })
                ->addColumn('action', function ($row) {
                    $btn = '
                    <div class="d-flex align-items-center col-actions">
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal font-size-18"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-33px, 27px);" data-popper-placement="bottom-end">';
                            $btn .= '<li><a href="' . URL('/InvoicePDF/' . $row->InvoiceMasterID) . '" target="_blank" class="dropdown-item"><i class="mdi mdi-file-plus font-size-15 mx-2 text-success"></i> View Invoice</a></li>';
                            $btn .= '<li><a href="' . URL('/ReceiptPDF/' . $row->InvoiceMasterID) . '" target="_blank" class="dropdown-item"><i class="mdi mdi-file-plus font-size-15 mx-2 text-primary"></i> View Receipt</a></li>';
                            $btn .= '<li><a href="' . URL('/invoice/' . $row->InvoiceMasterID) ."/edit/" .'" class="dropdown-item"><i class="mdi mdi-plus-box font-size-15 mx-2 text-warning"></i> Add Receiving</a></li>';

                               
                    $btn .= '</ul>
                        </div>
                    </div>';

                    return $btn;
                })    

           
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('invoice.invoice', 'pagetitle','users');
    }
    

    public  function InvoicePDF($id)
    {
       
     
        session::put('menu', 'Invoice');

        $invoice_mst = DB::table('v_invoice_master')->where('InvoiceMasterID', $id)->get();
        $invoice_det = DB::table('v_estimate_detail')->where('EstimateMasterID', $id)->get();
        $company = DB::table('company')->get();
        $party = DB::table('party')->where('PartyID',$invoice_mst[0]->PartyID)->first();

        $services=DB::table('services')->whereIn('id', function($query) use ($id)
        {
            $query->select('services_id')
                  ->from('v_estimate_detail')
                  ->where('EstimateMasterID',$id);
        })
        ->get();
    

        $invoice_type = DB::table('invoice_type')->get();
        $items = DB::table('item')->get();
        $supplier = DB::table('supplier')->get();

        $vhno = DB::table('invoice_master')->select(DB::raw('max(InvoiceMasterID)+1 as VHNO'))->get();

      
        // return View ('invoice_pdf',compact('invoice_type','items','supplier','vhno','invoice_mst','invoice_det'));
        // $filename = $invoice_mst[0]->InvoiceCode . '-' . $invoice_mst[0]->Date . '-PartyCode-' . $invoice_mst[0]->PartyID;
        $filename =  $invoice_mst[0]->Date . '-PartyCode-' . $invoice_mst[0]->PartyID;
        $pdf = PDF::loadView('invoice_pdf', compact('services','party','company','invoice_type', 'items', 'supplier', 'vhno', 'invoice_mst', 'invoice_det'));
        // $pdf->setpaper('A4', 'portiate');
        // return $pdf->download($filename . '.pdf');
        return $pdf->stream();
    }





    public function ReceiptList(){
        $receipts = DB::table('v_receipt_master')->get();
        
        return view('receipt.index', compact('receipts'));

    }


    public function editReceipt($id)
    {

        try {
            $receipt = DB::table('receipt_master')->where('id', $id)->first();// InvoiceMasterID is same as EstimateMasterID just table is different
            return response()->json($receipt);

        } catch (\Exception $e) {
            // Return a JSON response with an error message
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 'danger'
            ], 500);
        }
      
        
    }

    public function updateReceipt(Request $request,$id)
    {
        // Validate the request data
        $data = $request->validate([
           'ReferenceNo' => 'nullable|string',
           'date' => 'nullable',
           'Description' => 'nullable|string',
           
       ]);


       DB::beginTransaction();

       try {
        
        $receipt = DB::table('receipt_master')->where('id',$id)->first();
        $invoice = DB::table('invoice_master')->where('InvoiceMasterID',$receipt->InvoiceMasterID)->first();

        DB::table('invoice_master')
        ->where('InvoiceMasterID', $invoice->InvoiceMasterID)
        ->update([
            'Paid' => $invoice->Paid - $receipt->Paid,
            'Balance' => ( $invoice->GrandTotal) - $receipt->Paid,
        
        ]);


        DB::table('receipt_master')
            ->where('id', $id)
            ->update([
                'ReferenceNo' => $request->ReferenceNo,
                'date' => $request->date,
                'Description' => $request->Description,
                'Paid' => $request->Paid,
                'UserID' => Session::get('UserID'),
            ]);

            
        $updated_invoice = DB::table('invoice_master')->where('InvoiceMasterID',$receipt->InvoiceMasterID)->first();


        $new_Paid = $updated_invoice->Paid  + $request->Paid;

            DB::table('invoice_master')
            ->where('InvoiceMasterID', $updated_invoice->InvoiceMasterID)
            ->update([
                'Paid' => $new_Paid,
                'Balance' => ( $updated_invoice->GrandTotal) - $new_Paid,
            
            ]);
            if($new_Paid == $updated_invoice->GrandTotal)
            {
                DB::table('invoice_master')   
                ->where('InvoiceMasterID', $updated_invoice->InvoiceMasterID)
                ->update([
                    'Status' => 'Paid',
                
                ]);
            }
            else{
                DB::table('invoice_master')
                ->where('InvoiceMasterID', $updated_invoice->InvoiceMasterID)
                ->update([
                    'Status' => 'Pending',
                
                ]);
            }
            

        

           DB::commit();// Commit the transaction
            return response()->json([
                '$new_Paid ' => $new_Paid ,
                '$invoice ' => $invoice ,
                '$old_paid ' => $receipt->Paid ,
            ]);
           // Return a JSON response with a success message
            // return  redirect()->back();


       } catch (\Exception $e) {
          
           DB::rollBack(); // Rollback the transaction if there is an error

           // Return a JSON response with an error message
           return response()->json([
               'message' => $e->getMessage(),
               'status' => 'danger'
           ], 500);
       }
   }






    public  function ReceiptPDF($id)
    {
       
     
        session::put('menu', 'Receipt');

        $invoice_mst = DB::table('v_invoice_master')->where('InvoiceMasterID', $id)->get();// InvoiceMasterID is same as EstimateMasterID just table is different
        $invoice_det = DB::table('v_estimate_detail')->where('EstimateMasterID', $id)->get();
        $company = DB::table('company')->get();
        $party = DB::table('party')->where('PartyID',$invoice_mst[0]->PartyID)->first();

        $services=DB::table('services')->whereIn('id', function($query) use ($id)
        {
            $query->select('services_id')
                  ->from('v_estimate_detail')
                  ->where('EstimateMasterID',$id);
        })
        ->get();
    

        $invoice_type = DB::table('invoice_type')->get();
        $items = DB::table('item')->get();
        $supplier = DB::table('supplier')->get();

        $vhno = DB::table('invoice_master')->select(DB::raw('max(InvoiceMasterID)+1 as VHNO'))->get();

        $receipts = DB::table('receipt_master')->where('InvoiceMasterID',$id)->get();

       
        
        // return View ('invoice_pdf',compact('invoice_type','items','supplier','vhno','invoice_mst','invoice_det'));
        // $filename = $invoice_mst[0]->InvoiceCode . '-' . $invoice_mst[0]->Date . '-PartyCode-' . $invoice_mst[0]->PartyID;
        $filename =  $invoice_mst[0]->Date . '-PartyCode-' . $invoice_mst[0]->PartyID;
        $pdf = PDF::loadView('receipt_pdf', compact('receipts','services','party','company','invoice_type', 'items', 'supplier', 'vhno', 'invoice_mst', 'invoice_det'));
        // $pdf->setpaper('A4', 'portiate');
        // return $pdf->download($filename . '.pdf');
        return $pdf->stream();
    }

    


    public function subReceiptPDF($id){
      
        $receipt = DB::table('v_receipt_master')->where('id',$id)->first();
        $company = DB::table('company')->get();

        $invoice_det = DB::table('v_estimate_detail')->where('EstimateMasterID', $receipt->InvoiceMasterID)->get();
       
        $party = DB::table('party')->where('PartyID',$receipt->PartyID)->first();

        $idd = $receipt->InvoiceMasterID;
        $services=DB::table('services')->whereIn('id', function($query) use ($idd)
        {
            $query->select('services_id')
                  ->from('v_estimate_detail')
                  ->where('EstimateMasterID',$idd);
        })
        ->get();



        $pdf = PDF::loadView('sub_receipt_pdf', compact('company','receipt','invoice_det','party','services'));
        return $pdf->stream();

    }
}
