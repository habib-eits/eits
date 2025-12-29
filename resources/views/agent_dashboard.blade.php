@extends('template.tmp')

@section('title', $pagetitle)


@section('content')

<style id="compiled-css" type="text/css">
    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 360px;
        max-width: 800px;
        margin: 1em auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #ebebeb;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }

    /* EOS */
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                        <div class="page-title-right ">
                            <strong
                                class="text-danger">{{session::get('UserID')}}-{{session::get('UserType')}}-{{session::get('Email')}}</strong>

                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->



            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
            <script>
                @if(Session::has('error'))
   toastr.options =
   {
     "closeButton" : false,
     "progressBar" : true
   }
         Command: toastr["{{session('class')}}"]("{{session('error')}}")
   @endif
            </script>



            @if(session::get('Type')=='Admin')
            <div class="row">

                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body border-secondary border-top border-3 rounded-top shadow-sm">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar-xs me-3">
                                            <span
                                                class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                <i class="mdi mdi-passport"></i>
                                            </span>
                                        </div>
                                        <h5 class="font-size-14 mb-0">Daily Sale</h5>
                                    </div>
                                    <div class="text-muted mt-4">
                                        <h4 class="text-center"><a href="#">{{($sale[0]->Total==null) ? '0' :
                                                number_format($sale[0]->Total) }} </a> </h4>
                                        <div class="d-flex">
                                            <span class="ms-2 text-truncate mt-3"> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>

                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body border-secondary border-top border-3 rounded-top  shadow-sm">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar-xs me-3">
                                            <span
                                                class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                <i class="mdi mdi-passport"></i>
                                            </span>
                                        </div>
                                        <h5 class="font-size-14 mb-0">Monthly Expense</h5>
                                    </div>
                                    <div class="text-muted mt-4">
                                        <h4 class="text-center"><a href="#">{{($expense[0]->Balance ==null) ? '0' :
                                                number_format($expense[0]->Balance)}} </a> </h4>
                                        <div class="d-flex">
                                            <span class="ms-2 text-truncate mt-3"> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body border-secondary border-top border-3 rounded-top  shadow-sm">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar-xs me-3">
                                            <span
                                                class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                <i class="mdi mdi-calendar-cursor font-size-30 "></i>
                                            </span>
                                        </div>
                                        <h5 class="font-size-14 mb-0">Monhtly Income </h5>
                                    </div>
                                    <div class="text-muted mt-4">
                                        <h4 class="text-center"><a href="#">{{($revenue[0]->Balance ==null) ? '0' :
                                                number_format($revenue[0]->Balance)}}


                                            </a> </h4>

                                        <div class="d-flex">
                                            <span class="ms-2 text-truncate mt-3"> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body border-secondary border-top border-3 rounded-top  shadow-sm">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar-xs me-3">
                                            <span
                                                class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                <i class="mdi mdi-fingerprint"></i>
                                            </span>
                                        </div>
                                        <h5 class="font-size-14 mb-0">Last Year P&L </h5>
                                    </div>
                                    <div class="text-muted mt-4">
                                        <h4 class="text-center"><a href="#">{{number_format($profit_loss)}}</a> </h4>

                                        <div class="d-flex">
                                            <span class="ms-2 text-truncate mt-3"> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body border-secondary border-top border-3 rounded-top  shadow-sm">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar-xs me-3">
                                            <span
                                                class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                <i class="mdi mdi-fingerprint"></i>
                                            </span>
                                        </div>
                                        <h5 class="font-size-14 mb-0">Booking Payments </h5>
                                    </div>
                                    <div class="text-muted mt-4">
                                        <h4 class="text-center"><a
                                                href="{{URL('/BookingPayment')}}">{{number_format($booking_payment)}}</a>
                                        </h4>

                                        <div class="d-flex">
                                            <span class="ms-2 text-truncate mt-3"> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>








                    </div>
                    <!-- end row -->
                </div>
            </div>


            @endif
            <div class="row">

                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body border-success border-top border-3 rounded-top shadow-sm">
                                    <div class="d-flex align-items-center mb-3">

                                        <h5 class="font-size-14 mb-0">Today's Booking</h5>
                                    </div>
                                    <div class="text-muted mt-0">
                                        <h4 class="text-center"><a href="{{URL('/Booking')}}">{{($total_booking==null) ?
                                                '0' : number_format($total_booking) }} </a> </h4>

                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body border-info border-top border-3 rounded-top  shadow-sm">
                                    <div class="d-flex align-items-center mb-3">

                                        <h5 class="font-size-14 mb-0">Total Leads</h5>
                                    </div>
                                    <div class="text-muted mt-0">
                                        <h4 class="text-center"><a href="{{URL('/leads')}}">{{($total_leads==null) ? '0'
                                                : number_format($total_leads) }} </a> </h4>

                                    </div>
                                </div>
                            </div>
                        </div>
                    

                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body border-danger border-top border-3 rounded-top  shadow-sm">
                                    <div class="d-flex align-items-center mb-3">

                                        <h5 class="font-size-14 mb-0">Leads Closed </h5>
                                    </div>
                                    <div class="text-muted mt-0">
                                        <h4 class="text-center"><a href="{{URL('/leads')}}">{{($leads_won==null) ? '0' :
                                                number_format($leads_won) }}


                                            </a> </h4>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body border-warning border-top border-3 rounded-top  shadow-sm">
                                    <div class="d-flex align-items-center mb-3">

                                        <h5 class="font-size-14 mb-0">Leads Lost's </h5>
                                    </div>
                                    <div class="text-muted mt-0">
                                        <h4 class="text-center"><a href="{{URL('/leads')}}">{{($leads_lost==null) ? '0'
                                                : number_format($leads_lost) }}</a> </h4>


                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body border-secondary border-top border-3 rounded-top  shadow-sm">
                                    <div class="d-flex align-items-center mb-3">

                                        <h5 class="font-size-14 mb-0">Unassigned Leads </h5>
                                    </div>
                                    <div class="text-muted mt-0">
                                        <h4 class="text-center"><a href="{{URL('/leads')}}">{{($leads_new==null) ? '0' :
                                                number_format($leads_new) }}</a> </h4>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body border-primary border-top border-3 rounded-top  shadow-sm">
                                    <div class="d-flex align-items-center mb-3">

                                        <h5 class="font-size-14 mb-0">Rejected Leads </h5>
                                    </div>
                                    <div class="text-muted mt-0">
                                        <h4 class="text-center"><a href="{{URL('/leads')}}">{{($leads_reject==null) ?
                                                '0' : number_format($leads_reject) }}</a> </h4>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body border-primary border-top border-3 rounded-top  shadow-sm">
                                    <div class="d-flex align-items-center mb-3">

                                        <h5 class="font-size-14 mb-0">Pending Leads</h5>
                                    </div>
                                    <div class="text-muted mt-0">
                                        <h4 class="text-center"><a href="{{URL('/leads')}}">{{($leads_pending==null) ?
                                                '0' : number_format($leads_pending) }}</a> </h4>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body border-primary border-top border-3 rounded-top  shadow-sm">
                                    <div class="d-flex align-items-center mb-3">

                                        <h5 class="font-size-14 mb-0">Leads Created Today </h5>
                                    </div>
                                    <div class="text-muted mt-0">
                                        <h4 class="text-center"><a href="{{URL('/leads')}}">{{($leads_pending==null) ?
                                                '0' : number_format($leads_created_today) }}</a> </h4>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body border-primary border-top border-3 rounded-top  shadow-sm">
                                    <div class="d-flex align-items-center mb-3">

                                        <h5 class="font-size-14 mb-0">Leads Updated Today </h5>
                                    </div>
                                    <div class="text-muted mt-0">
                                        <h4 class="text-center"><a href="{{URL('/leads')}}">{{($leads_pending==null) ?
                                                '0' : number_format($leads_updated_today) }}</a> </h4>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body border-primary border-top border-3 rounded-top  shadow-sm">
                                    <div class="d-flex align-items-center mb-3">

                                        <h5 class="font-size-14 mb-0">Leads Not Updated </h5>
                                        <span> in Last 4 days</span>
                                    </div>
                                    <div class="text-muted mt-0">
                                        <h4 class="text-center"><a href="{{URL('/leads')}}">{{($leadsNotUpdatedIn4Days==null) ?
                                                '0' : number_format($leadsNotUpdatedIn4Days) }}</a> </h4>


                                    </div>
                                </div>
                            </div>
                        </div>








                    </div>
                    <!-- end row -->
                </div>
            </div>
            

          







                    <script src="https://code.highcharts.com/highcharts.js"></script>
                    <script src="https://code.highcharts.com/modules/series-label.js"></script>
                    <script src="https://code.highcharts.com/modules/exporting.js"></script>
                    <script src="https://code.highcharts.com/modules/export-data.js"></script>
                    <script src="https://code.highcharts.com/modules/accessibility.js"></script>



    




                </div>
                <!-- end row -->
            </div>
        </div>



    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->


</div>





@endsection