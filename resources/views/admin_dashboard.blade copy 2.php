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




                        <div class="col-sm-4">
                            <div class="card" data-status="Pending">
                                <div class="card-body border-primary border-top border-3 rounded-top shadow-sm">
                                    <div class="d-flex align-items-center mb-3">
                                        <h5 class="font-size-14 mb-0">Rejected Leads</h5>
                                    </div>
                                    <div class="text-muted mt-0">
                                        <h4 class="text-center"><a href="javascript:void(0);">{{ ($leads_reject == null) ? '0' : number_format($leads_reject) }}</a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>




                    </div>
                    <!-- end row -->
                </div>


                {{-- <x-agent-transactions :agents="$agents" /> --}}
            </div>






   





        </div>
        <!-- end row -->
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="leadsModal" tabindex="-1" aria-labelledby="leadsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="leadsModalLabel">Leads</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="leadsList"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</div>
</div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
<!-- Modal -->
<div class="modal fade" id="leadsModal" tabindex="-1" aria-labelledby="leadsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="leadsModalLabel">Leads</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="leadsList"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</div>
<script>
    var fetchLeadsUrl = "{{ route('fetch-leads') }}";
</script>

<script>
    $(document).ready(function() {
    $('.card').on('click', function() {
        var status = $(this).data('status');
        fetchLeads(status);
    });

    function fetchLeads(status) {
        $.ajax({
            url: fetchLeadsUrl,
            method: 'GET',
            data: { status: status },
            success: function(response) {
                var leadsHtml = '<ul class="list-group">';
                if(response.leads.length > 0) {
                    response.leads.forEach(function(lead) {
                        leadsHtml += '<li class="list-group-item">' + lead.name + '</li>';
                    });
                } else {
                    leadsHtml += '<li class="list-group-item">No leads found.</li>';
                }
                leadsHtml += '</ul>';
                $('#leadsList').html(leadsHtml);
                $('#leadsModalLabel').text(capitalizeFirstLetter(status) + ' Leads');
                $('#leadsModal').modal('show');
            },
            error: function(xhr) {
                console.error('Error fetching leads:', xhr.responseText);
            }
        });
    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
});

</script>




@endsection