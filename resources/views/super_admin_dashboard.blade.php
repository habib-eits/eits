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


          


           
            <div class="row">

                <div class="col-xl-8">
                    <div class="row">
                        {{-- <div class="col-sm-4">
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


                        </div> --}}

                        <div class="col-sm-4">
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
                    

                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body border-danger border-top border-3 rounded-top  shadow-sm">
                                    <div class="d-flex align-items-center mb-3">

                                        <h5 class="font-size-14 mb-0">Won Leads </h5>
                                    </div>
                                    <div class="text-muted mt-0">
                                        <h4 class="text-center"><a href="{{URL('/leads')}}">{{($leads_won==null) ? '0' :
                                                number_format($leads_won) }}


                                            </a> </h4>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body border-warning border-top border-3 rounded-top  shadow-sm">
                                    <div class="d-flex align-items-center mb-3">

                                        <h5 class="font-size-14 mb-0">Lost Leads </h5>
                                    </div>
                                    <div class="text-muted mt-0">
                                        <h4 class="text-center"><a href="{{URL('/leads')}}">{{($leads_lost==null) ? '0'
                                                : number_format($leads_lost) }}</a> </h4>


                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body border-secondary border-top border-3 rounded-top  shadow-sm">
                                    <div class="d-flex align-items-center mb-3">

                                        <h5 class="font-size-14 mb-0">Unassigned Leads </h5>
                                    </div>
                                    <div class="text-muted mt-0">
                                        <h4 class="text-center"><a href="{{URL('/leads')}}">{{($leads_not_assigned==null) ? '0' :
                                                number_format($leads_not_assigned) }}</a> </h4>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body border-primary border-top border-3 rounded-top  shadow-sm">
                                    <div class="d-flex align-items-center mb-3">

                                        <h5 class="font-size-14 mb-0">Rejected Leads</h5>
                                    </div>
                                    <div class="text-muted mt-0">
                                        <h4 class="text-center"><a href="{{URL('/leads')}}">{{($leads_reject==null) ?
                                                '0' : number_format($leads_reject) }}</a> </h4>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
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

                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body border-primary border-top border-3 rounded-top  shadow-sm">
                                    <div class="d-flex align-items-center mb-3">

                                        <h5 class="font-size-14 mb-0">Inactive Leads <small>in Last 4 days</small></h5>
                                       
                                    </div>
                                    <div class="text-muted mt-0">
                                        <h4 class="text-center"><a href="{{URL('/leads')}}">{{($leadsNotUpdatedIn4Days==null) ?
                                                '0' : number_format($leadsNotUpdatedIn4Days) }}</a> </h4>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
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
                        <div class="col-sm-4">
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









                    </div>
                    <!-- end row -->
                </div>


                <x-agent-transactions :agents="$agents" />
            </div>
            
           

           
            <div class="row d-none">

                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body border-secondary border-top border-3 rounded-top shadow-sm">

                                    <div class="text-muted mt-4">
                                        <div id="container"></div>
                                        <div class="d-flex">
                                            <span class="ms-2 text-truncate mt-3"> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body border-secondary border-top border-3 rounded-top shadow-sm">

                                    <div class="text-muted mt-4">
                                        <div id="container2"></div>
                                        <div class="d-flex">
                                            <span class="ms-2 text-truncate mt-3"> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body border-secondary border-top border-3 rounded-top shadow-sm">

                                    <div class="text-muted mt-4">
                                        <div id="container4"></div>
                                        <div class="d-flex">
                                            <span class="ms-2 text-truncate mt-3"> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                   







                    <script src="https://code.highcharts.com/highcharts.js"></script>
                    <script src="https://code.highcharts.com/modules/series-label.js"></script>
                    <script src="https://code.highcharts.com/modules/exporting.js"></script>
                    <script src="https://code.highcharts.com/modules/export-data.js"></script>
                    <script src="https://code.highcharts.com/modules/accessibility.js"></script>


    <script>
        Highcharts.chart('container2', {
        chart: {
        type: 'column'
        },
        title: {
        text: 'Monthly Income & Expense'
        },

        xAxis: {
        categories: [


        @foreach($cash1 as $value)



        '{{$value->MonthName}}',

        @endforeach




        ],
        crosshair: true
        },
        yAxis: {
        min: 0,
        title: {
        text: 'Amount'
        }
        },

        plotOptions: {
        column: {
        pointPadding: 0.2,
        borderWidth: 0
        }
        },
        series: [  

        {
        name: 'Income',
        data: [

        @foreach($cash1 as $value)



        {{$value->Rev}},

        @endforeach

        ]

        }, {
        name: 'Expense',
        data: [

        @foreach($cash1 as $value)



        {{$value->Exp}},

        @endforeach

        ]

        }],
        credits: {
        enabled: false
        },
        });
    </script>
    



                    <script type="text/javascript">
                        //<![CDATA[


Highcharts.chart('container', {

   title: {
        text: 'Cash Flow'
    },
   

    yAxis: {
        title: {
            text: 'Amount'
        }
    },

  xAxis: {
        categories: [
           @foreach($v_cashflow as $value)
           '{{$value->MonthName}}',
           @endforeach
        ],
        // crosshair: true
    },

    

    

    series: [{
        // name: 'CashFlow',
        showInLegend: false,     
        name: ' ',
        data: [@foreach($v_cashflow as $value)
           {{$value->Balance}},
           @endforeach]
    } ],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    },
    credits: {
    enabled: false
  },

});


  //]]>
                    </script>


                    <script>
                        // Create the chart
Highcharts.chart('container3', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Browser market shares. January, 2018'
    },
    

    accessibility: {
        announceNewData: {
            enabled: true
        },
        point: {
            valueSuffix: '%'
        }
    },

    plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '{point.name}: {point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    },

    series: [
        {
            name: "Browsers",
            colorByPoint: true,
            data: [1,1,1]
              

 




                   
               
               
                
            // ]
        }
    ],
     
});


                    </script>




                    <script>
                        // Create the chart
Highcharts.chart('container4', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Cash Summary'
    },
   
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Amount'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}'
            }
        }
    },

    

    series: [
        {
            name: "",
            colorByPoint: true,
            data: [




 @foreach($cash as $value)

{
    name:"{{$value->ChartOfAccountName}}",
                     y: {{($value->Balance)}},
},
 @endforeach





                
                
            ]
        }
    ],
    drilldown: {
        breadcrumbs: {
            position: {
                align: 'right'
            }
        },
        series: [
            {
                name: "Chrome",
                id: "Chrome",
                data: [
                    [
                        "v65.0",
                        0.1
                    ],
                    [
                        "v64.0",
                        1.3
                    ],
                    [
                        "v63.0",
                        53.02
                    ],
                    [
                        "v62.0",
                        1.4
                    ],
                    [
                        "v61.0",
                        0.88
                    ],
                    [
                        "v60.0",
                        0.56
                    ],
                    [
                        "v59.0",
                        0.45
                    ],
                    [
                        "v58.0",
                        0.49
                    ],
                    [
                        "v57.0",
                        0.32
                    ],
                    [
                        "v56.0",
                        0.29
                    ],
                    [
                        "v55.0",
                        0.79
                    ],
                    [
                        "v54.0",
                        0.18
                    ],
                    [
                        "v51.0",
                        0.13
                    ],
                    [
                        "v49.0",
                        2.16
                    ],
                    [
                        "v48.0",
                        0.13
                    ],
                    [
                        "v47.0",
                        0.11
                    ],
                    [
                        "v43.0",
                        0.17
                    ],
                    [
                        "v29.0",
                        0.26
                    ]
                ]
            },
            {
                name: "Firefox",
                id: "Firefox",
                data: [
                    [
                        "v58.0",
                        1.02
                    ],
                    [
                        "v57.0",
                        7.36
                    ],
                    [
                        "v56.0",
                        0.35
                    ],
                    [
                        "v55.0",
                        0.11
                    ],
                    [
                        "v54.0",
                        0.1
                    ],
                    [
                        "v52.0",
                        0.95
                    ],
                    [
                        "v51.0",
                        0.15
                    ],
                    [
                        "v50.0",
                        0.1
                    ],
                    [
                        "v48.0",
                        0.31
                    ],
                    [
                        "v47.0",
                        0.12
                    ]
                ]
            },
            {
                name: "Internet Explorer",
                id: "Internet Explorer",
                data: [
                    [
                        "v11.0",
                        6.2
                    ],
                    [
                        "v10.0",
                        0.29
                    ],
                    [
                        "v9.0",
                        0.27
                    ],
                    [
                        "v8.0",
                        0.47
                    ]
                ]
            },
            {
                name: "Safari",
                id: "Safari",
                data: [
                    [
                        "v11.0",
                        3.39
                    ],
                    [
                        "v10.1",
                        0.96
                    ],
                    [
                        "v10.0",
                        0.36
                    ],
                    [
                        "v9.1",
                        0.54
                    ],
                    [
                        "v9.0",
                        0.13
                    ],
                    [
                        "v5.1",
                        0.2
                    ]
                ]
            },
            
              
        ]
    }
});
       
                    </script>


                </div>
                <!-- end row -->
            </div>
        </div>



    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->


</div>





@endsection