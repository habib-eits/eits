<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;


class JobController extends Controller
{
    public function Job()
    {

        $pagetitle = 'All Jobs';
        return view('job.job', compact('pagetitle'));
    }


    public function ajax_job(Request $request)
    {
        Session::put('menu', 'Vouchers');
        $pagetitle = 'Estimates';
        if ($request->ajax()) {
            $data = DB::table('v_job')->orderBy('JobID')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // if you want to use direct link instead of dropdown use this line below
                    // <a href="javascript:void(0)"  onclick="edit_data('.$row->customer_id.')" >Edit</a> | <a href="javascript:void(0)"  onclick="del_data('.$row->customer_id.')"  >Delete</a>
                    $btn = '

                       <div class="d-flex align-items-center col-actions">


                <a href="' . URL('/JobView/' . $row->JobID) . '"><i class="font-size-18 mdi mdi-eye-outline align-middle me-1 text-secondary"></i></a>


                  <a targe="_blank" href="' . URL('/JobCompletionReport/' . $row->JobID) . '"><i class="font-size-18 mdi mdi-file-pdf-outline me-1 text-secondary"></i></a>

                <a href="' . URL('/JobEdit/' . $row->JobID) . '"><i class="font-size-18 mdi mdi-pencil align-middle me-1 text-secondary"></i></a>
              
                 <a href="' . URL('/JobDelete/' . $row->JobID) . '"><i class="font-size-18 mdi mdi-trash-can-outline align-middle me-1 text-secondary"></i></a>




                       </div>';

                    //class="edit btn btn-primary btn-sm"
                    // <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('job.job', 'pagetitle');
    }


    public function JobCreate()
    {

        // dd('reached');
        $pagetitle = 'Create Job';
        $party = DB::table('party')->get();
        $branch = DB::table('branch')->get();
        
        return view('job.job_create', compact('party', 'pagetitle','branch'));
    }

    public  function JobSave(Request $request)
    {
        // dd($request->all());
        $data = array(
            'JobNo' => $request->JobNo,
            'JobDate' => $request->JobDate,
            'JobDueDate' => $request->JobDueDate,
            'JobDetail' => $request->JobDetail,
            'PartyID' => $request->PartyID,
            'UserID' => session::get('UserID'),
         
        );
       

        $job = DB::table('job')->insertGetId($data);


       

        // end foreach

        // dd('hello');
        return redirect('Job')->with('error', 'Job saved')->with('class', 'success');
    }









    public function JobView($id=null)
    {
        // dd('hello');
        $pagetitle = 'Job';


        if($id)
        {
            session::put('JobID',$id);
        }


$jobid=session::get('JobID');



        $job = DB::table('v_job')->where('JobID',session::get('JobID'))->get();
 

        $employee=DB::table('v_employee')
            ->whereNotIn('EmployeeID', function($query) use ($jobid)
            {
                $query->select('EmployeeID')
                      ->from('job_employee')
                      ->where('JobID',$jobid);
            })
            ->get();

 
        $job_employee = DB::table('v_job_employee')->where('JobID',session::get('JobID'))->get();
        $job_tools = DB::table('v_job_tools')->where('JobID',session::get('JobID'))->get();
        $item = DB::table('item')->get();
 





     $staff=DB::table('v_employee')->get();
        return view('job.job_view', compact('job', 'pagetitle','job_employee' ,'employee','staff','job_tools','item'));
    }


      public function JobEmployeeSave(request $request)
    {
        
        try {
                    DB::beginTransaction();
                     // your alll  queries here -->
        
                    $data = array(
                    
                    'JobID' => $request->JobID, 
                    'EmployeeID' => $request->EmployeeID, 
                    'IsActive' => 'Yes', 

                    );        

                    DB::table('job_employee')->insertGetId($data);

             // queries end here  -->
            DB::commit();
             return redirect('JobView')->with('error','Employee assigned successfully')->with('class','success');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->with('class', 'error');
        }


    }

    
       public function JobEmployeeDelete($id)
    {

  
          try {
                    DB::beginTransaction();
                     // your alll  queries here -->
        
                     $id = DB::table('job_employee')->where('JobDetailID', $id)->delete();

             // queries end here  -->
            DB::commit();
             return redirect('JobView')->with('error','Deleted successfully')->with('class','success');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->with('class', 'error');
        }




    }



    public function JobEmployeeEdit($id)
    {
         
        $pagetitle = 'Job';
        $job = DB::table('job_employee')->where('JobDetailID',$id)->first();
        



        return response()->json(['data' => $job]);
    }

      public function JobEmployeeUpdate(request $request)
    {
        
        try {
                    DB::beginTransaction();
                     // your alll  queries here -->
        
                    $data = array(
                    
                    'JobID' => $request->JobID, 
                    'EmployeeID' => $request->EmployeeID, 
                    'IsActive' => $request->IsActive, 

                    );        




                DB::table('job_employee')->where('JobDetailID' , $request->JobDetailID)->update($data);

 
             // queries end here  -->
            DB::commit();
             return redirect('JobView')->with('error','Updated successfully')->with('class','success');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->with('class', 'error');
        }


    }

   public function JobEdit($id)
    {
         
        $pagetitle = 'Job';
        $job = DB::table('v_job')->where('JobID',$id)->first();
        $party = DB::table('party')->get();

        $branch = DB::table('branch')->get();


        return view('job.job_edit', compact('job', 'pagetitle' ,'party','branch'));
    }


    public  function JobUpdate(Request $request)
    {
           $data = array(
            'JobNo' => $request->JobNo,
            'JobDate' => $request->JobDate,
            'JobDueDate' => $request->JobDueDate,
            'JobDetail' => $request->JobDetail,
            'PartyID' => $request->PartyID,
            'UserID' => session::get('UserID'),
         
        );

        
        
        $id= DB::table('job')->where('JobID' , $request->JobID)->update($data);
        


        return redirect('Job')->with('error', 'Updated Successfully')->with('class', 'success');
    }


        public function JobDelete($id)
    {

         $id = DB::table('job')->where('JobID', $id)->delete();
 



        return redirect('Job')->with('error', 'Deleted Successfully')->with('class', 'success');
    }


    public  function JobToolAssign(request $request)
    {

         
        if(!$request->ItemID)
        {
         return redirect('JobView')->with('error', 'No tool selected')->with('class', 'error');

        }

    
    for($i=0; $i<count($request->ItemID); $i++)
    {
        $data = array(
            'JobID' =>  $request->JobID, 
            'ItemID' =>  $request->ItemID[$i], 
        );


        $id= DB::table('job_tools')->insertGetId($data);
        
        
    }


         return redirect('JobView')->with('error', 'Deleted Successfully')->with('class', 'success');
    }


        public function JobToolDelete($id)
    {

         DB::table('job_tools')->where('JobToolID', $id)->delete();
         return redirect('JobView')->with('error', 'Deleted Successfully')->with('class', 'success');
    }




function JobCompletionReport($jobid)
{

    $pagetitle='Job Completion Report';

    $job = DB::table('v_job')->where('JobID',$jobid)->first();
 

     $pdf = PDF::loadView ('job.jcr',compact('pagetitle','job'));
    $pdf->set_option('isPhpEnabled',true);
    //return $pdf->download('pdfview.pdf');
      $pdf->setpaper('A4', 'landscape');

         return $pdf->stream();

 

}


// end of controller
}
