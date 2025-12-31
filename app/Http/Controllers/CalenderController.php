<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Followup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalenderController extends Controller
{
    public function index()
    {
        $pagetitle = 'Booking';
        return view('calendar.index', compact('pagetitle'));
    }

    
    public function ajax_followups()
    {
        $followups = Followup::all();
        $events = [];

        foreach ($followups as $followup) {

            $start = Carbon::parse($followup->date);
            $end   = Carbon::parse($followup->date)->addDay(); // REQUIRED for allDay

            $events[] = [
                'id'     => $followup->id,
                'title'  => $followup->notes ?? 'Follow-up',
                'start'  => $start->toDateString(),
                'end'    => $end->toDateString(),
                'allDay' => true,
                'color'  => $followup->status === 'done' ? 'green' : 'orange',
                'client' => $followup->remarks ?? '',
            ];
        }

        return response()->json($events);
    }

    public function show(Request $request)
    {
        
        $followup = Followup::with([
            'lead.party',
            'lead.agent',
            'lead.branchService',
            ])->find($request->id);
        // dd($followup->toArray());
        return response()->json($followup);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id'      => 'required|exists:followups,id',
            'notes'   => 'nullable|string',
            'remarks' => 'nullable|string',
            'status'  => 'required|string',
            'date'    => 'required|date',
        ]);

        $followup = Followup::findOrFail($request->id);

        $followup->update([
            'notes'   => $request->notes,
            'remarks' => $request->remarks,
            'status'  => $request->status,
            'date'    => $request->date,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Follow-up updated successfully'
        ]);
    }

}
