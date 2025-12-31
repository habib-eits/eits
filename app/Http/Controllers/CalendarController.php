<?php

namespace App\Http\Controllers;

use App\Http\Requests\FollowupUpdateRequest;
use App\Models\Followup;

class CalendarController extends Controller
{
    public function index()
    {
        $pagetitle = 'Calendar';
        return view('calendar.index', compact('pagetitle'));
    }


    public function ajax_followup()
    {
        $query = Followup::with(['lead.branch', 'lead.branchService'])
            ->whereNotNull('date');

        if ($start = request('start')) {
            $query->whereDate('date', '>=', substr($start, 0, 10));
        }
        if ($end = request('end')) {
            $query->whereDate('date', '<=', substr($end, 0, 10));
        }

        return response()->json(
            $query->get()->map(fn($f) => [
                'id'           => 'followup_' . $f->id,
                'title'        => $f->remarks ? substr($f->remarks, 0, 50) : 'Follow-up',
                'start'        => $f->date,
                'end'          => $f->date,
                'color'        => $f->status === 'Done' ? '#28a745' : '#ff9800',
                'type'         => 'followup',
                'remarks'      => $f->remarks ?? '',
                'notes'        => $f->notes ?? '',
                'status'       => $f->status ?? 'Pending',

                // Lead Info for Modal
                'customer_name' => $f->lead?->name ?? 'Unknown',
                'phone'          => $f->lead?->tel ?? 'N/A',
                'branch'       => $f->lead?->branch?->name ?? 'N/A',
                'service'      => $f->lead?->branchService?->name ?? 'N/A',
                'allDay'       => false,
            ])
        );
    }

    public function updateFollowup(FollowupUpdateRequest $request, $id)
    {
        $followup = Followup::findOrFail($id);

        $followup->update($request->validated());

        return response()->json([
            'message' => 'Follow-up updated successfully!'
        ]);
    }
}
