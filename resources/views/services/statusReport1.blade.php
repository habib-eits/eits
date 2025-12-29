@extends('template.tmp')

@section('title', '')


@section('content')



    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->

               

           
                <div class="card">
                    <div class="card-body">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                           
                            <tr>
                                <td colspan="2">
                                    <div align="center"><strong>Service Report Status Wise</strong></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="90%">From: {{ date('d-m-Y', strtotime($startDate)) }}</td>
                                <td width="90%">To: {{date('d-m-Y', strtotime($endDate))  }}</td>
                            </tr>
                        </table>
                        <table class="table table-bordered table-sm">
                            <thead class="bg-light">
                                <tr>
                                    <td width="5%" bgcolor="#CCCCCC">
                                        <div align="center"><strong>Services</strong></div>
                                    </td>    
                                    <td width="5%" bgcolor="#CCCCCC">
                                        <div align="center"><strong>Pending</strong></div>
                                    </td>    
                                    <td width="5%" bgcolor="#CCCCCC">
                                        <div align="center"><strong>Rejected</strong></div>
                                    </td>    
                                    <td width="5%" bgcolor="#CCCCCC">
                                        <div align="center"><strong>Disqualified</strong></div>
                                    </td>    
                                    <td width="5%" bgcolor="#CCCCCC">
                                        <div align="center"><strong>Qualified</strong></div>
                                    </td>    
                                    <td width="5%" bgcolor="#CCCCCC">
                                        <div align="center"><strong>No Response</strong></div>
                                    </td>    
                                    <td width="5%" bgcolor="#CCCCCC">
                                        <div align="center"><strong>Total</strong></div>
                                    </td>    
                                </tr>
                            </thead>

                            @php
                                // Initialize grand total counters
                               
                                    $Pending = 0;
                                    $Rejected = 0;
                                    $Disqualified = 0;
                                    $Qualified = 0;
                                    $NoResponse = 0;
                                    $Total = 0;

                                    $url = '';
                               
                            @endphp    

                            @foreach ($services as $service)

                                @php
                                    // Accumulate the grand totals
                                    $Pending += $serviceLeads[$service->id]['Pending'] ?? 0;
                                    $Rejected += $serviceLeads[$service->id]['Rejected'] ?? 0;
                                    $Disqualified += $serviceLeads[$service->id]['Disqualified'] ?? 0;
                                    $Qualified += $serviceLeads[$service->id]['Qualified'] ?? 0;
                                    $NoResponse += $serviceLeads[$service->id]['No Response'] ?? 0;
                                @endphp

                                @php
                                    $url = 'leads?filter_min_created_at='.$startDate.'&filter_max_created_at='.$endDate.'&filter_service_id='.$service->id;
                                @endphp
                            @if(  array_sum($serviceLeads[$service->id] ?? []) > 0 )    
                                <tr>
                                    <td class="text-start">
                                    <a target="_blank" href="{{ URL($url) }}">{{ $service->name }}</a>
                                    </td>
                                    <td class="text-center">
                                        <a target="_blank" href="{{ URL($url.'&filter_status=Pending') }}">{{ $serviceLeads[$service->id]['Pending'] ?? '-' }}</a>
                                    </td>
                                    <td class="text-center">
                                    <a target="_blank" href="{{ URL($url.'&filter_status=Rejected') }}"> {{ $serviceLeads[$service->id]['Rejected'] ?? '-' }}</a>
                                    </td>
                                    <td class="text-center">
                                        <a target="_blank" href="{{ URL($url.'&filter_status=Disqualified') }}">{{ $serviceLeads[$service->id]['Disqualified'] ?? '-' }}</a>
                                    </td>
                                    <td class="text-center">
                                    <a target="_blank" href="{{ URL($url.'&filter_status=Qualified') }}"> {{ $serviceLeads[$service->id]['Qualified'] ?? '-' }}</a>
                                    </td>
                                    <td class="text-center">
                                    <a target="_blank" href="{{ URL($url.'&filter_status=No+Response') }}"> {{ $serviceLeads[$service->id]['No Response'] ?? '-' }}</a>
                                    </td>
                                    <td class="text-center">
                                        <a target="_blank" href="{{ URL($url) }}">{{ array_sum($serviceLeads[$service->id] ?? []) }}</a>
                                    </td>
                                </tr>
                            @endif    

                           
                        @endforeach
                            @php
                                $url2 = 'leads?filter_min_created_at='.$startDate.'&filter_max_created_at='.$endDate;
                                @endphp
                                <!-- Grand Total Row -->
                            <tr>
                                <td class="text-center fw-bold">Grand Total</td>
                                <td class="text-center fw-bold"> <a href="{{ URL($url2.'&filter_status=Pending') }}">{{ $Pending }}</a> </td>
                                <td class="text-center fw-bold"><a href="{{ URL($url2.'&filter_status=Rejected') }}">{{ $Rejected }}</a></td>
                                <td class="text-center fw-bold"><a href="{{ URL($url2.'&filter_status=Disqualified') }}">{{ $Disqualified }}</a></td>
                                <td class="text-center fw-bold"><a href="{{ URL($url2.'&filter_status=Qualified') }}">{{ $Qualified }}</a></td>
                                <td class="text-center fw-bold"><a href="{{ URL($url2.'&filter_status=No+Response') }}">{{ $NoResponse }}</a></td>
                                <td class="text-center fw-bold"><a href="{{ URL($url2)}}">{{ $Pending+ $Rejected + $Disqualified + $Qualified + $NoResponse }}</a></td>
                            </tr>
                                                        
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>
    </div>
    </div>
    <!-- END: Content-->

@endsection
