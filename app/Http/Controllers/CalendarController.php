<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Followup;
use App\Services\CalendarService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\FollowupUpdateRequest;

class CalendarController extends Controller
{
    protected $calendarService;

    public function __construct(CalendarService $calendarService)
    {
        $this->calendarService = $calendarService;
    }

    public function index()
    {
        $pagetitle = 'Calendar';
        $agents = DB::table('user')
            ->where('UserType', 'Agent')
            ->orderBy('name')
            ->get();

        $agentColors = $agents->mapWithKeys(function ($agent) {
            return [$agent->id => $this->calendarService->getAgentColor($agent->id)];
        })->toArray();

        return view('calendar.index', compact('pagetitle', 'agents', 'agentColors'));
    }

    public function ajax_followup()
    {
        $events = $this->calendarService->getFollowupEvents();

        return response()->json($events);
    }

    public function updateFollowup(FollowupUpdateRequest $request, $id)
    {
        $followup = Followup::findOrFail($id);

        // Update only date, remarks, and notes (no status)
        $followup->update([
            'date' => $request->date,
            'remarks' => $request->remarks,
            'notes' => $request->notes,
        ]);

        return response()->json([
            'message' => 'Follow-up updated successfully!'
        ]);
    }
}
