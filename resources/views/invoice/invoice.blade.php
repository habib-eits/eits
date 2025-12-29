@extends('template.tmp')

@section('title', $pagetitle)


@section('content')





    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <script>
                    function delete_invoice(id) {


                        url = '{{ URL::TO('/') }}/InvoiceDelete/' + id;



                        jQuery('#staticBackdrop').modal('show', {
                            backdrop: 'static'
                        });
                        document.getElementById('delete_link').setAttribute('href', url);

                    }
                </script>


                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Invoice</h4>
                            {{-- <a href="{{URL('/SalesInvoiceCreate')}}"  class="btn btn-primary w-md float-right "><i class="bx bx-plus"></i> Add New</a> --}}



                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div id="filterRow">
                        <form id="filter-form">
                            <div class="row">
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label class="form-label">Start Date</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><span class="bx bx-calendar" ></span> </div>
                                                    <input type="date" name="start_date" id="start_date" class="form-control" value="">
                                                </div>
                                            
                                            </div> 
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label class="form-label">End Date</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><span class="bx bx-calendar" ></span> </div>
                                                    <input type="date" name="end_date" id="end_date" class="form-control" value="">
                                                </div>
                                            
                                            </div> 
                                        </div>

                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label class="form-label">Status</label>
                                                <select name="status" id="status" class="select2 form-control" style="width:100%">                                                
                                                    <option  value="">Choose...</option>
                                                    <option value="Paid">Paid</option>
                                                    <option value="Pending">Pending</option>
                                                </select>
                                            </div>                                        
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label class="form-label">User</label>
                                                <select name="user_id" id="user_id" class="select2 form-control" style="width:100%">                                                
                                                    <option  value="">Choose...</option>
                                                   @foreach ($users as $user )
                                                       <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                   @endforeach
                                                </select>
                                            </div>                                        
                                        </div>
                                        
                                        <div class="col-md-2 text-center">
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

                        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
                        <script>
                            @if (Session::has('error'))
                                toastr.options = {
                                    "closeButton": false,
                                    "progressBar": true
                                }
                                Command: toastr["{{ session('class') }}"]("{{ session('error') }}")
                            @endif
                        </script>

                        <div class="card">

                            <div class="card-body">
                                <table id="student_table" class="table table-striped table-sm " style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1" >Invoice#</th>

                                            <th class="col-md-1"  class="col-md-3">Sales Person</th>
                                            <th class="col-md-1"  class="col-md-3">Party</th>
                                            <th class="col-md-1"  class="col-md-1">Date</th>
                                            <th class="col-md-1" >Total</th>
                                            <th class="col-md-1" >Paid</th>
                                            <th class="col-md-1" >Balance</th>
                                            <th class="col-md-1" >Cost</th>
                                            <th class="col-md-1" >Margin</th>
                                            <th class="col-md-1" >Profit % </th>
                                            <th class="col-md-1" >Status</th>
                                            <th class="col-md-3" >Action</th>
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
             table = $('#student_table').DataTable({
               
                "processing": true,
                "serverSide": true,
                "pageLength": 50,
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
                    url: "{{ url('ajax_invoice') }}",
                    data: function (d) {
                        d.start_date = $('#start_date').val();
                        d.end_date = $('#end_date').val();
                        d.status = $('#status').val();
                        d.user_id = $('#user_id').val();
                       
                    }

                },
                "columns": [
                    {
                        "data": "InvoiceNo"
                    },
                    {
                        "data": "agentName"
                    },

                    {
                        "data": "PartyName"
                    },
                    {
                        "data": "Date"
                    },
                    {
                        "data": "GrandTotal",
                        render: $.fn.dataTable.render.number(',', '.', 2, '')
                    },
                    {
                        "data": "Paid",
                        render: $.fn.dataTable.render.number(',', '.', 2, '')
                    },
                    {
                        "data": "Balance",
                        render: $.fn.dataTable.render.number(',', '.', 2, '')
                    },
                    {
                        "data": "project_cost",
                        render: $.fn.dataTable.render.number(',', '.', 2, '')
                    },
                    {
                        "data": "total_margin",
                        render: $.fn.dataTable.render.number(',', '.', 2, '')
                    },
                    {
                        "data": "margin_percent",
                        render: $.fn.dataTable.render.number(',', '.', 2, '')
                    },
                    {
                        "data": "Status",
                        "render": function(data, type, row) {
                            if (data === 'Paid') {
                                return '<span style="color: green; font-weight: bold;">' + data + '</span>';
                            } else {
                                return '<span style="color: red; font-weight: bold;">' + data + '</span>'; // for other statuses, return as is
                            }
                        }
                    },
                    {
                        "data": "action"
                    },

                ],
                "order": [
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

        $(document).ready(function() {
            $('#student_table thead tr').clone(true).appendTo('#student_table thead');
            $('#student_table thead tr:eq(1) th').each(function(i) {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="  ' + title +
                    '"  class="form-control form-control-sm" />');


                // hide text field from any column you want too
                if (title == 'Action') {
                    $(this).hide();
                }





                $('input', this).on('keyup change', function() {
                    if (table.column(i).search() !== this.value) {
                        table
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });

            });
            var table = $('#student_table').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                retrieve: true,
                paging: false

            });
        });
    </script>

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->


@endsection
