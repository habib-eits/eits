<?php

namespace App\Http\Controllers;

use Session;
use Carbon\Carbon;
use App\Models\Lead;
use App\Models\User;
use App\Models\Followup;
use Illuminate\Http\Request;
use Illuminate\Support\Arr; 
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class FollowupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::all();

        try{
            if ($request->ajax()) {

                $query = Followup::orderBy('id', 'desc')
                ->orderBy('date', 'desc');

                if ($request->user_id) {
                    $query->where('user_id', $request->user_id );
                }
    
                if ($request->start_date && $request->end_date) {
                    $query->whereBetween('date', [$request->start_date, $request->end_date]);
                }


                $data = $query->get();
    
                return Datatables::of($data)
                    ->addIndexColumn()
                    // Status toggle column
                    ->addColumn('party_name', function($row){
                        return $row->lead->name ?? 'N/A';
                    })
                    ->addColumn('user_name', function($row){
                        return $row->user->name ?? 'N/A';
                    })
                     ->addColumn('created_at', function($row){
                        $date = date('Y-m-d', strtotime($row->created_at));
                        return $date ?? 'N/A';
                    })

                    ->addColumn('action', function ($row) {
                        $btn = '
                            <div class="d-flex align-items-center col-actions">
                                <div class="dropdown">
                                    <a class="action-set show" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="javascript:void(0)" onclick="editFollowup(' . $row->id . ')" class="dropdown-item">
                                                <i class="bx bx-pencil font-size-16 text-secondary me-1"></i> Edit
                                            </a>
                                        </li>
                                        
                                       
                                       
                                    </ul>
                                </div>
                            </div>';
    
                   
                    return $btn;
                   
                    })
                    
                //     <li>
                //     <a href="javascript:void(0)" onclick="deleteFollwup(' . $row->id . ')" class="dropdown-item">
                //         <i class="bx bx-trash font-size-16 text-danger me-1"></i> Delete
                //     </a>
                // </li>
    
                    ->rawColumns(['action']) // Mark these columns as raw HTML
                    ->make(true);
            }
    
            return view('followups.index', compact('users'));

        }catch (\Exception $e){

            return back()->with('flash-danger', $e->getMessage());
        }
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
           
            DB::beginTransaction();
              // Manually set the timestamps
              $createdAt = Carbon::now();
              $updatedAt = Carbon::now();
           
            $data = [
                'lead_id' => $request->lead_id,
                'user_id' => session::get('UserID'),
                'date' => $request->date,
                'notes' => $request->notes,
                'remarks' => $request->remarks,
                // 'status' => $request->status,
               
                'created_at' => $createdAt,
                'updated_at' => NULL
            ];
            DB::table('followups')->insert($data);
           
            DB::commit();

            return back()->withSuccess('Note Added successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            // dd($e->getMessage());
            return back()->withSuccess($e->getMessage());
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
        try {
            $data = Followup::findOrFail($id);
            return response()->json($data);

        } catch (\Exception $e) {
            // Return a JSON response with an error message
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 500);
        }
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
        
        // Validate the request data
        
        try {
           
            DB::beginTransaction();
              // Manually set the timestamps
              $createdAt = Carbon::now();
              $updatedAt = Carbon::now();
            
            $followup = Followup::find($id);

            $data = [
                'user_id' => session::get('UserID'),
                'date' => $request->date,
                'notes' => $request->notes,
                'remarks' => $request->remarks,
                // 'status' => $request->status,
               
                'updated_at' => $updatedAt
            ];
                $followup->update($data); 
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Data Update successfully.',
                ],200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
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
        //
    }
}
