@extends('template.tmp')
@section('title', $pagetitle)

@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-sm-0 font-size-18">All Quotations</h3>

                            <div class="page-title-right ">

                                {{-- <div class="btn-group  shadow-sm dropstart">
                 <a href="{{URL('/EstimateCreate')}}" class="btn btn-primary"> + New </a>
                
              </div> --}}
                            </div>



                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="filterRow">
                        <form id="filter-form">
                            <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label">Start Date</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><span class="bx bx-calendar" ></span> </div>
                                                    <input type="date" name="start_date" id="start_date" class="form-control" value="">
                                                </div>
                                            
                                            </div> 
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label">End Date</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><span class="bx bx-calendar" ></span> </div>
                                                    <input type="date" name="end_date" id="end_date" class="form-control" value="">
                                                </div>
                                            
                                            </div> 
                                        </div>

                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label">Status</label>
                                                <select name="status" id="status" class="select2 form-control" style="width:100%">                                                
                                                    <option  value="">Choose...</option>
                                                    <option value="Invoice Created">Invoice Created</option>
                                                    <option value="Pending">Pending</option>
                                                    <option value="Revised">Revised</option>
                                                </select>
                                            </div>                                        
                                        </div>
                                        
                                        <div class="col-md-3 text-center">
                                            <button type="button" class="btn btn-danger  mt-4" id="filter-btn">
                                                <i class="mdi mdi-filter"></i> Filter
                                            </button>
                                            <button type="button" class="btn btn-primary  mt-4" id="reset-filter-btn">
                                                <i class="fas fa-sync-alt"></i> Reset
                                            </button>
                                        </div>  
                                    </div>
                                   </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">

                        @if (session('error'))
                            <div class="alert alert-{{ Session::get('class') }} p-1" id="success-alert">

                                {{ Session::get('error') }}
                            </div>
                        @endif
                        @if (count($errors) > 0)

                            <div>
                                <div class="alert alert-danger pt-3 pl-0   border-3">
                                    <p class="font-weight-bold"> There were some problems with your input.</p>
                                    <ul>

                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                        @endif

                        <div class="card">

                            <div class="card-body">
                                <table id="student_table" class="table table-striped table-sm " style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Estimate#</th>
                                            <th>Reference</th>
                                            <th>CUSTOMER NAME</th>
                                            <th>Status</th>
                                            <th>Amount</th>
                                            <th>Cost</th>
                                            <th>Margin</th>
                                            <th>Margin%</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
    <script type="text/javascript">
    var table ='';
        $(document).ready(function() {
           table=  $('#student_table').DataTable({
                processing: true,
                serverSide: true,
                 pageLength: 50, // Default to showing 50 entries
                lengthMenu: [
                    [10, 25, 50, 100, -1], // -1 means "All"
                    [10, 25, 50, 100, "All"]
                ],
                dom: '<"dt-top-row"lBf>rt<"bottom"ip><"clear">', // Place lengthMenu (l), filter (f), and buttons (B) in one row
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i> Export to Excel',
                    className: 'btn btn-success btn-sm text-center'
                },
               
            ],
                ajax: {
                    url: "{{ url('ajax_estimate') }}",
                    data: function (d) {
                        d.start_date = $('#start_date').val();
                        d.end_date = $('#end_date').val();
                        d.status = $('#status').val();
                       
                    }

                },
                columns: [{
                        data: "EstimateDate"
                    },
                    {
                        data: "EstimateNo"
                    },
                    {
                        data: "ReferenceNo"
                    },
                    {
                        data: "PartyName"
                    },
                    {
                        data: "Status",
                        render: function(data, type, row) {
                            if (data == "Pending")
                                return '<span class="badge bg-danger font-size-11">' + data +
                                    '</span>';
                            else
                                return '<span class="badge bg-success font-size-11">' + data +
                                    '</span>';
                        }
                    },


                    {
                        data: "GrandTotal"
                    },
                    {
                        data: "project_cost"
                    },
                    {
                        data: "total_margin"
                    },
                    {
                        data: "margin_percentage"
                    },


                    {
                        data: "action"
                    },
                ],
                order: [
                    [0, 'desc']
                ],
            });
        });


        $('#filter-btn').on('click', function(){
                table.draw();
            });
            $('#reset-filter-btn').on('click', function(){
                $('#start_date').val('');
                $('#end_date').val('');
                $('#status').val('').trigger('change');
                table.draw();
            });
            $('#start_date').on('change', function() {
                let startDate = $(this).val();
                
                // Set the end date to the start date if it's empty or less than the start date
                let endDate = $('#end_date').val();
                if (!endDate || endDate < startDate) {
                    $('#end_date').val(startDate);
                }
                
                // Set the min attribute of the end date to the start date
                $('#end_date').attr('min', startDate);
            });
    </script>
    <script>
        function confirmRedirect(url) {
            if (confirm('Are you sure you want to create a revision for this estimate?')) {
                window.location.href = url;
            }
        }
    </script>
    <script>
        function delete_estimate(id) {
            url = '{{ URL::TO('/') }}/EstimateDelete/' + id;
            jQuery('#staticBackdrop').modal('show', {
                backdrop: 'static'
            });
            document.getElementById('delete_link').setAttribute('href', url);

        }
    </script>

@endsection
