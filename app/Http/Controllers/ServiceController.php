<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Branch;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index()
    {
        try {
            $branches = Branch::all();
            $data = Service::with('branch')->get();
            return view('services.index', compact('data', 'branches'));
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
    public function store(Request $request)
    {
        try {
            // dd($request->all());
            DB::beginTransaction();
            $request->validate([
                // 'name' => 'required|max:255|unique:services,name',
                'name' => 'required|max:255',
                'branch_id' => 'required'
            ]);
            Service::create($request->except('_token'));
            DB::commit();
            return back()->withSuccess('Service Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withError($e->getMessage());
        }
    }
    public function edit($id)
    {
        try {
            $data = Service::findOrFail($id);
            return response()->json(['data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    public function update(Request $request)
    {
        try {
            // dd($request->all());
            DB::beginTransaction();
            $request->validate([
                // 'name' => 'required|max:255|unique:services,name',
                'name' => 'required|max:255',
                'branch_id' => 'required'
            ]);
            Service::findOrFail($request->service_id)->update($request->except('_token', 'service_id'));
            DB::commit();
            return back()->withSuccess('Service Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withError($e->getMessage());
        }
    }
    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $data = Service::with('subService')->findOrFail($id);
            $data->subService()->delete();
            $data->delete();
            DB::commit();
            return back()->withSuccess('Service Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withError($e->getMessage());
        }
    }


    public function servicesStatusReport(){

        $services = Service::all();
      
        return view('services.statusReport', compact("services"));
    }



    public function servicesStatusReport1(Request $request){

        $service_id = $request->input('service_id');

        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');


        // Fetch services and lead counts based on service_id
        if ($service_id != null) {
            $services = Service::where('id', $service_id)->get();

            $query = DB::table('leads')
                ->where('service_id', $service_id)
                ->select('service_id', 'status', DB::raw('COUNT(*) as count'))
                ->groupBy('service_id', 'status');
        } else {
            $services = Service::all();

            $query = DB::table('leads')
                ->select('service_id', 'status', DB::raw('COUNT(*) as count'))
                ->groupBy('service_id', 'status');
        }

        // Apply date range to the lead counts query if dates exist
        if (isset($startDate) && isset($endDate)) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        // Execute the query to get lead counts
        $leadCounts = $query->get();


        $serviceLeads = [];

        foreach ($leadCounts as $leadCount) {
            $serviceLeads[$leadCount->service_id][$leadCount->status] = $leadCount->count;
        }


        return view('services.statusReport1', compact('services','serviceLeads','startDate','endDate'));


        
    }

  
}
