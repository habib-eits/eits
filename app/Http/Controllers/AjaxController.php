<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Booking;
use App\Models\Service;
use App\Models\SubService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AjaxController extends Controller
{
    public function ajaxGetAgents($id = null)
    {
        try {
            if ($id != null) {
                $agents = User::where('role', '!=', 'Admin')
                    ->where('branch_id', $id)
                    ->get();
            } else {
                $agents = User::where('role', '!=', 'Admin')
                    ->get();
            }
            return response()->json(['data' => $agents]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
    public function ajaxGetServices($id = null)
    {
        try {
            if ($id != null) {
                $services = Service::where('branch_id', $id)
                    ->get();
            } else {
                $services = Service::all();
            }
            return response()->json(['data' => $services]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
    public function ajaxGetSubservices($id = null)
    {
        try {
            if ($id != null) {
                $subServices = SubService::where('service_id', $id)
                    ->get();
            } else {
                $subServices = SubService::all();
            }
            return response()->json(['data' => $subServices]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }


    // public function ajaxGetLeads()
    // {
    //     try {
             
    //     $leads = DB::table('leads')->whereNull('agent_id')->get();


    //     if ($leads->isEmpty()) {
    //         return response()->json(['status' => 'empty' , 'total' =>0]);
    //     } else {
    //         return response()->json(['status' => 'not empty','total' => count($leads),'data' =>$leads]);
    //     }      
            


    //     } catch (\Exception $e) {
    //         return response()->json(['message' => $e->getMessage()]);
    //     }
    // }
    public function ajaxGetTodayPendingBookings()
    {
       
        try {
            
            $today = Carbon::today();
            $bookings = DB::table('v_booking')-> whereDate('start', $today)
            ->where('end',null)
            ->when(Session::get('UserType')=='Agent', function ($query){
                $query->where('users_id', Session::get('UserID'));
            })  
            ->get();
           
          
        if ($bookings->isEmpty()) {
            return response()->json(['status' => 'empty' , 'total' => 0]);
        } else {
            return response()->json(['status' => 'not empty','total' => count($bookings),'data' =>$bookings]);
        }      
            


        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }


   public function ajaxGetPendingBookings()
    {
        try {
             
            $bookings = DB::table('v_booking')-> where('end',null)
            ->when(Session::get('UserType')=='Agent', function ($query){
                $query->where('users_id', Session::get('UserID'));
            })  
            ->get();



        if ($bookings->isEmpty()) {
            return response()->json(['status' => 'empty' , 'total' =>0]);
        } else {
            return response()->json(['status' => 'not empty','total' => count($bookings),'data' =>$bookings]);
        }      
            


        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }





}
