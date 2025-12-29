@extends('template.tmp')
@section('title', 'Lead View')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="content-wrapper">
                    <div class="row" style="height: 81vh; overflow: auto;">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col">
                                            <h3 class="text-info">Lead Details</h3>
                                        </div>
                                        <div class="col d-flex justify-content-end">
                                            <a href="{{ url('leads') }}" class="btn btn-primary btn-rounded w-md">Back</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="card text-center shadow-sm shadow-sm">
                                                <div class="card-header ">
                                                    <strong>Customer/Lead Full Name:</strong>
                                                </div>
                                                <div class="card-body">
                                                    <p>{{ $lead->name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="card text-center shadow-sm">
                                                <div class="card-header">
                                                    <strong>Contact / Email:</strong>
                                                </div>
                                                <div class="card-body">
                                                    <p>{{ $lead->tel }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="card text-center shadow-sm">
                                                <div class="card-header">
                                                    <strong>Other Number:</strong>
                                                </div>
                                                <div class="card-body">
                                                    <p>{{ $lead->other_tel != null ? $lead->other_tel : 'N/A' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- </div> --}}
                                        {{-- <div class="row mt-2"> --}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="card text-center shadow-sm">
                                                <div class="card-header">
                                                    <strong>Bussiness Details:</strong>
                                                </div>
                                                <div class="card-body">
                                                    <p>{{ $lead->business_details != null ? $lead->business_details : 'N/A' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="card text-center shadow-sm">
                                                <div class="card-header">
                                                    <strong>Service:</strong>
                                                </div>
                                                <div class="card-body">
                                                    <p>{{ $lead->service != null ? $lead->service : 'N/A' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="card text-center shadow-sm">
                                                <div class="card-header">
                                                    <strong>Channel:</strong>
                                                </div>
                                                <div class="card-body">
                                                    <p>{{ $lead->channel != null ? $lead->channel : 'N/A' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- </div> --}}
                                        {{-- <div class="row mt-2"> --}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="card text-center shadow-sm">
                                                <div class="card-header">
                                                    <strong>Branch:</strong>
                                                </div>
                                                <div class="card-body">
                                                    <p>{{ isset($lead->branch) ? $lead->branch->name : 'N/A' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="card text-center shadow-sm">
                                                <div class="card-header">
                                                    <strong>Branch Service:</strong>
                                                </div>
                                                <div class="card-body">
                                                    <p>{{ isset($lead->branchService) ? $lead->branchService->name : 'N/A' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="card text-center shadow-sm">
                                                <div class="card-header">
                                                    <strong>Branch Sub Service:</strong>
                                                </div>
                                                <div class="card-body">
                                                    <p>{{ isset($lead->subService) ? $lead->subService->name : 'N/A' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- </div> --}}
                                        {{-- <div class="row mt-2"> --}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="card text-center shadow-sm">
                                                <div class="card-header">
                                                    <strong>Quoted Amount:</strong>
                                                </div>
                                                <div class="card-body">
                                                    <p><span>{{ $lead->currency != null ? $lead->currency : 'AED' }}:
                                                        </span>{{ $lead->amount != null ? $lead->amount : 0 }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="card text-center shadow-sm">
                                                <div class="card-header">
                                                    <strong>Agent:</strong>
                                                </div>
                                                <div class="card-body">
                                                    <p>{{ isset($lead->agent) ? $lead->agent->name : 'N/A' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="card text-center shadow-sm">
                                                <div class="card-header">
                                                    <strong>Campaign:</strong>
                                                </div>
                                                <div class="card-body">
                                                    <p>{{ isset($lead->campaign) ? $lead->campaign->name : 'N/A' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- </div> --}}
                                        {{-- <div class="row mt-2"> --}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="card text-center shadow-sm">
                                                <div class="card-header">
                                                    <strong>Status:</strong>
                                                </div>
                                                <div class="card-body">
                                                    <p>{{ $lead->status != null ? $lead->status : 'N/A' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="card text-center shadow-sm">
                                                <div class="card-header">
                                                    <strong>Qualified Status:</strong>
                                                </div>
                                                <div class="card-body">
                                                    <p>{{ $lead->approved_status != null ? $lead->approved_status : 'N/A' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                
                            </div>
                            @if (count($lead_activities) > 0)
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Lead Activity History</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">

                                        {{-- <p class="card-title-desc">Table cells in <code>&lt;tbody&gt;</code> inherit their alignment from <code>&lt;table&gt;</code> and are aligned to the the top by default. Use the vertical align classes to re-align where needed.</p> --}}

                                        <div class="table-responsive">
                                            <table class="table align-middle mb-0">

                                                <thead>
                                                    <tr>
                                                        <th class="col-md-1 text-left">No</th>
                                                        <th class="col-md-2 text-left">Date</th>
                                                        <th class="col-md-4 text-left">Description</th>
                                                        <th class="col-md-2 text-left">updated at</th>
                                                        <th class="col-md-1 text-center"></th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $i = 1;
                                                    @endphp
                                                    @foreach ($lead_activities as $lead_activity)
                                                        <tr>
                                                            <td scope="row">{{ $i++ }}</td>
                                                            <td>{{ $lead_activity->created_at }}</td>
                                                            <td>{{ $lead_activity->description }}</td>
                                                            <td>{{ $lead_activity->updated_at }}</td>

                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            @else
                                <p class=" text-danger">No data found</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- <script>
                    $(document).ready(function() {
                        // executes when HTML-Document is loaded and DOM is ready
                        console.log("document is ready");


                        $(".card").hover(
                            function() {
                                $(this).addClass('shadow-md').css('cursor', 'pointer');
                            },
                            function() {
                                $(this).removeClass('shadow-md');
                            }
                        );

                        // document ready  
                    });
                </script> -->

            @endsection
