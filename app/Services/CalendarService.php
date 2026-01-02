<?php

namespace App\Services;

use App\Models\Followup;

class CalendarService
{
    private const AGENT_COLORS = [
        '#3788d8',
        '#28a745',
        '#dc3545',
        '#ffc107',
        '#17a2b8',
        '#6f42c1',
        '#e83e8c',
        '#fd7e14',
        '#20c997',
        '#6610f2',
        '#0d6efd',
        '#198754',
        '#0dcaf0',
        '#ffc107',
        '#fd7e14'
    ];

    public function getAgentColor(?int $agentId): string
    {
        if (!$agentId) {
            return '#ff9800';
        }

        return self::AGENT_COLORS[($agentId - 1) % count(self::AGENT_COLORS)];
    }

    public function getFollowupEvents(): array
    {
        $query = Followup::with(['lead.branch', 'lead.branchService', 'lead.agent'])
            ->whereNotNull('date');

        $this->applyAgentFilter($query);
        $this->applyDateRangeFilter($query);

        return $query->get()->map(function ($f) {
            $agentId = $f->lead?->agent_id ?? null;

            return [
                'id'             => 'followup_' . $f->id,
                'title'          => $f->remarks ? substr($f->remarks, 0, 50) : 'Follow-up',
                'start'          => $f->date,
                'end'            => $f->date,
                'color'          => $this->getAgentColor($agentId),
                'type'           => 'followup',
                'remarks'        => $f->remarks ?? '',
                'notes'          => $f->notes ?? '',
                'allDay'         => false,

                'customer_name'  => $f->lead?->name ?? 'Unknown',
                'phone'          => $f->lead?->tel ?? 'N/A',
                'branch'         => $f->lead?->branch?->name ?? 'N/A',
                'service'        => $f->lead?->branchService?->name ?? 'N/A',
                'agent_id'       => $agentId,
                'agent_name'     => $f->lead?->agent?->name ?? 'N/A',
            ];
        })->toArray();
    }

    private function applyAgentFilter($query): void
    {
        $agentFilter = request('agent_id');

        if ($agentFilter && $agentFilter != '' && $agentFilter != '-1') {
            $query->whereHas('lead', fn($q) => $q->where('agent_id', $agentFilter));
        } elseif ($agentFilter == '-1') {
            $query->whereHas('lead', fn($q) => $q->whereNull('agent_id'));
        } elseif (session('UserType') === 'Agent') {
            $query->whereHas('lead', fn($q) => $q->where('agent_id', session('UserID')));
        }
    }

    private function applyDateRangeFilter($query): void
    {
        if ($start = request('start')) {
            $query->whereDate('date', '>=', substr($start, 0, 10));
        }
        if ($end = request('end')) {
            $query->whereDate('date', '<=', substr($end, 0, 10));
        }
    }
}
