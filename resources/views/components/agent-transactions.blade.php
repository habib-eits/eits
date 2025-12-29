<div class="col-xl-4">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Agents Lead's Summary</h4>

            <ul class="nav nav-pills bg-light rounded" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#transactions-all-tab" role="tab" aria-selected="false" tabindex="-1">All</a>
                </li>
                @foreach ($agents as $agent)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#transactions-{{ $agent->id }}-tab" role="tab" aria-selected="false" tabindex="-1">{{ $agent->name }}</a>
                    </li>
                @endforeach
               
            </ul>

            <div class="tab-content mt-4">
                <div class="tab-pane active show" id="transactions-all-tab" role="tabpanel">
                    <div class="table-responsive" data-simplebar="init" style="max-height: 330px;">
                        <div class="simplebar-wrapper" style="margin: 0px;">
                            <div class="simplebar-height-auto-observer-wrapper">
                                <div class="simplebar-height-auto-observer"></div>
                            </div>
                            <div class="simplebar-mask">
                                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                    <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden;">
                                        <div class="simplebar-content" style="padding: 0px;">
                                            <table class="table align-middle table-nowrap">
                                                <tbody>
                                                    <tr>
                                                        <td><div><h5 class="font-size-14 mb-0">Today's Booking</h5></div></td>
                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">{{ DB::table('bookings')->where(DB::raw('DATE_FORMAT(start, "%Y-%m-%d")'), date('Y-m-d'))->count() }}</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><div><h5 class="font-size-14 mb-0">Total Leads</h5></div></td>
                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">{{ DB::table('leads')->count() }}</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><div><h5 class="font-size-14 mb-0">Pending leads</h5></div></td>
                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">{{ DB::table('leads')->where('status','Pending')->count() }}</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><div><h5 class="font-size-14 mb-0">Leads Won</h5></div></td>
                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">{{ DB::table('leads') ->where('approved_status','Closed Won')->count() }}</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><div><h5 class="font-size-14 mb-0">Leads lost</h5></div></td>
                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">{{ DB::table('leads') ->where('approved_status','Closed Lost')->count() }}</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><div><h5 class="font-size-14 mb-0">Unassigned Leads</h5></div></td>
                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">{{DB::table('leads')
                                                                    ->whereNull('agent_id')
                                                                    ->count(); }}</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><div><h5 class="font-size-14 mb-0">Rejected Leads</h5></div></td>
                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">{{ DB::table('leads')->where('status','Rejected')->count() }}</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                        </div>
                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                        </div>
                        <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                            <div class="simplebar-scrollbar" style="height: 0px; transform: translate3d(0px, 0px, 0px); display: none;"></div>
                        </div>
                    </div>
                </div>
                @foreach ($agents as $agent)
                    <div class="tab-pane" id="transactions-{{ $agent->id }}-tab" role="tabpanel">
                        <div class="table-responsive" data-simplebar="init" style="max-height: 330px;">
                            <div class="simplebar-wrapper" style="margin: 0px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden;">
                                            <div class="simplebar-content" style="padding: 0px;">
                                                <table class="table align-middle table-nowrap">
                                                    <tbody>
                                                        <tr>
                                                        <td><div><h5 class="font-size-14 mb-0">Today's Booking</h5></div></td>
                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">{{ DB::table('bookings')->where(DB::raw('DATE_FORMAT(start, "%Y-%m-%d")'), date('Y-m-d'))->count() }}</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><div><h5 class="font-size-14 mb-0">Total Leads</h5></div></td>
                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">{{ DB::table('leads')->where('agent_id',$agent->id)->count() }}</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><div><h5 class="font-size-14 mb-0">Pending leads</h5></div></td>
                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">{{ DB::table('leads')->where('agent_id',$agent->id)->where('status','Pending')->count() }}</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><div><h5 class="font-size-14 mb-0">Leads Won</h5></div></td>
                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">{{ DB::table('leads')->where('agent_id',$agent->id) ->where('approved_status','Closed Won')->count() }}</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><div><h5 class="font-size-14 mb-0">Leads lost</h5></div></td>
                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">{{ DB::table('leads')->where('agent_id',$agent->id) ->where('approved_status','Closed Lost')->count() }}</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><div><h5 class="font-size-14 mb-0">Rejected Leads</h5></div></td>
                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">{{ DB::table('leads')->where('agent_id',$agent->id)->where('status','Rejected')->count() }}</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $today = date('y-m-d');
                                                    @endphp             
                                                    <tr>
                                                        <td><div><h5 class="font-size-14 mb-0">Leads Created Today</h5></div></td>
                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">{{ DB::table('leads')->whereDate('created_at', $today)->where('agent_id',$agent->id)->count() }}</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><div><h5 class="font-size-14 mb-0">Leads Updated Today</h5></div></td>
                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">
                                                                    {{ DB::table('leads')
                                                                    ->whereDate('updated_at', $today)
                                                                     ->whereDate('updated_at', '!=', 'created_at')
                                                                    ->where('agent_id',$agent->id)
                                                                    ->count() }}</h5>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    @php
                                                        // Create a DateTime object for the current date and time
                                                        $currentDate = new DateTime();

                                                        // Subtract 4 days from the current date
                                                        $currentDate->modify('-4 days');

                                                        // Get the date 4 days ago in the desired format
                                                        $fourDaysAgo = $currentDate->format('Y-m-d');
                                                    @endphp 

                                                        <tr>
                                                            <td><div><h5 class="font-size-14 mb-0">Inactive Leads in Last 4 days</div></td>
                                                            <td>
                                                                <div class="text-end">
                                                                    <h5 class="font-size-14 mb-0">
                                                                        {{ DB::table('leads') ->where('status','Pending')
                                                                        ->where('agent_id',$agent->id)
                                                                        ->where('updated_at', '<', $fourDaysAgo)   
                                                                        ->count() }}</h5>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                <div class="simplebar-scrollbar" style="height: 0px; transform: translate3d(0px, 0px, 0px); display: none;"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


{{-- @foreach ($agents as $agent)
<div class="tab-pane" id="transactions-{{ $agent->id }}-tab" role="tabpanel">
    <div class="table-responsive" data-simplebar="init" style="max-height: 330px;">
        <div class="simplebar-wrapper" style="margin: 0px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden;">
                        <div class="simplebar-content" style="padding: 0px;">
                            <table class="table align-middle table-nowrap">
                                <tbody>
                                    <tr>
                                        <td><div><h5 class="font-size-14 mb-0">Today's Booking</h5></div></td>
                                        <td>
                                            <div class="text-end">
                                                <h5 class="font-size-14 mb-0">{{ $agent->bookings_count }}</h5>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><div><h5 class="font-size-14 mb-0">Total Leads</h5></div></td>
                                        <td>
                                            <div class="text-end">
                                                <h5 class="font-size-14 mb-0">{{ $agent->leads_count }}</h5>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><div><h5 class="font-size-14 mb-0">Pending leads</h5></div></td>
                                        <td>
                                            <div class="text-end">
                                                <h5 class="font-size-14 mb-0">{{ $agent->pending_leads_count }}</h5>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><div><h5 class="font-size-14 mb-0">Leads Won</h5></div></td>
                                        <td>
                                            <div class="text-end">
                                                <h5 class="font-size-14 mb-0">{{ $agent->leads_won_count }}</h5>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><div><h5 class="font-size-14 mb-0">Leads lost</h5></div></td>
                                        <td>
                                            <div class="text-end">
                                                <h5 class="font-size-14 mb-0">{{ $agent->leads_lost_count }}</h5>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><div><h5 class="font-size-14 mb-0">Rejected Leads</h5></div></td>
                                        <td>
                                            <div class="text-end">
                                                <h5 class="font-size-14 mb-0">{{ $agent->rejected_leads_count }}</h5>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
        </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="height: 0px; transform: translate3d(0px, 0px, 0px); display: none;"></div>
        </div>
    </div>
</div>
@endforeach --}}
