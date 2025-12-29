@extends('template.tmp')
@section('title', 'Leads')
@section('content')





<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            @if (session('error'))

            <div class="alert alert-{{ Session::get('class') }} p-1" id="success-alert">

                {{ Session::get('error') }}
            </div>

            @endif

            @if (count($errors) > 0)

            <div>
                <div class="alert alert-danger p-1   border-3">
                    <p class="font-weight-bold"> There were some problems with your input.</p>
                    <ul>

                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>

                        @endforeach
                    </ul>
                </div>
            </div>

            @endif


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
            
             <div class="content-wrapper">

                


                <div class="row">
                    <div class="col-md-4">
                        <h3>Lead List</h3>
                    </div>
                    <div class="col-md-8">
                        
                        <div class="col d-flex justify-content-end">
                             <a href="{{ route('lead.create') }}" id="createButton"
                            class="ml-3 btn btn-primary text-end mb-2">Add New</a>
                            
                            <button type="button" id="importButton" class="btn btn-secondary mr-2 mx-2 text-end mb-2"
                                data-bs-toggle="modal" data-bs-target=".exampleModal">
                                Import
                            </button> 
                            
                            
                            
                        </div>
                              
                       
                    </div>
                   
                        
                </div>
                        
                        
                        
                        <div class="row">
                                        
                                       
                            @if(session::get('Type')!='Agent')
                            <div class="col d-flex justify-content-end">
                                <button type="button" class="btn btn-info mx-2 d-none" id="reassignButton"
                                    data-bs-toggle="modal" data-bs-target=".exampleModalReassign">
                                    Reassign ( <span class="countIDS"></span> )
                                </button>
                                <button type="button" class="btn btn-warning mr-2 d-none"
                                    id="newReassignButton" data-bs-toggle="modal"
                                    data-bs-target=".exampleModalReassignNew">
                                    Reassign as New Lead ( <span class="countIDS"></span> )
                                </button>
                                <button type="button" id="bulkDeleteButton"
                                    class="btn btn-danger mx-2 d-none"><i class="mdi mdi-trash-can"></i>(
                                    <span class="countIDS"></span> )</button>
                                <button type="button" class="btn btn-secondary d-none"
                                    id="cancelCheckAllButton">X</button>
                               
        
                            </div>
                            @endif
                        </div>
    
                    </div>
                </div>
                
                <div  id="filterRow" class="row card card-body">
                   
                        <div class="row mt-2">
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <label for=""><strong>Status</strong></label>
                                <select id="filter_status"  name="filter_status" class="form-control select2 rounded">
                                    <option value="">
                                        {{ old('filter_status', isset($request) && $request->filter_status ? '--Cancel--' : '--Select One--') }}
                                    </option>
                                    @foreach ($statuses as $status)
                                    <option value="{{ $status->name }}" {{ old('filter_status', isset($request) && $request->filter_status) == $status->name ? 'selected' : '' }}>
                                        {{ $status->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <label for=""><strong>Campaign</strong></label>
                                <select name="filter_campaign_id" id="filter_campaign_id" class="form-control select2 rounded">
                                    <option value="">
                                        {{ old('filter_campaign_id', isset($request) && $request->filter_campaign_id ? '--Cancel--' : '--Select One--') }}
                                    </option>
                                    <option value="-1" {{ old('filter_campaign_id', isset($request) && $request->filter_campaign_id) == -1 ? 'selected' : '' }}>
                                        No Campaign
                                    </option>
                                    @foreach ($campaigns as $campaign)
                                    <option value="{{ $campaign->id }}" {{ old('filter_campaign_id', isset($request) && $request->filter_campaign_id) == $campaign->id ? 'selected' : '' }}>
                                        {{ $campaign->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <label for=""><strong>Agent</strong></label>
                                <select name="filter_agent_id" id="filter_agent_id" class="form-control select2 rounded">
                                    <option value="">
                                        {{ old('filter_agent_id', isset($request) && $request->filter_agent_id ? '--Cancel--' : '--Select One--') }}
                                    </option>
                                    <option value="-1" {{ old('filter_agent_id', isset($request) && $request->filter_agent_id) == -1 ? 'selected' : '' }}>
                                        No Agent
                                    </option>
                                    @foreach ($agents as $item)
                                    <option value="{{ $item->id }}" {{ old('filter_agent_id', isset($request) && $request->filter_agent_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <label for=""><strong>Qualified Status</strong></label>
                                <select name="filter_Q_status" id="filter_Q_status" class="form-control select2 rounded">
                                    <option value="">
                                        {{ old('filter_Q_status', isset($request) && $request->filter_Q_status ? '--Cancel--' : '--Select One--') }}
                                    </option>
                                    @foreach ($Q_statuses as $q_status)
                                    <option value="{{ $q_status->name }}" {{ old('filter_Q_status', isset($request) && $request->filter_Q_status) == $q_status->name ? 'selected' : '' }}>
                                        {{ $q_status->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            

                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <label for=""><strong>Last Updated</strong></label>
                                <div class="input-group">
                                    <select name="filter_last_updated" id="filter_last_updated" class="form-control select2 rounded">
                                        <option value="">
                                            {{ old('filter_last_updated', isset($request) && $request->filter_last_updated ? '--Cancel--' : '--Select One--') }}
                                        </option>
                                        <option value="Today" {{ old('filter_last_updated', isset($request) && $request->filter_last_updated) == 'Today' ? 'selected' : '' }}>
                                            Today
                                        </option>
                                        <option value="Yesterday" {{ old('filter_last_updated', isset($request) && $request->filter_last_updated) == 'Yesterday' ? 'selected' : '' }}>
                                            Yesterday
                                        </option>
                                        <option value="3" {{ old('filter_last_updated', isset($request) && $request->filter_last_updated) == '3' ? 'selected' : '' }}>
                                            Last 3 Days
                                        </option>
                                        <option value="week" {{ old('filter_last_updated', isset($request) && $request->filter_last_updated) == 'week' ? 'selected' : '' }}>
                                            This Week
                                        </option>
                                        <option value="month" {{ old('filter_last_updated', isset($request) && $request->filter_last_updated) == 'month' ? 'selected' : '' }}>
                                            This Month
                                        </option>
                                        <option value="last_month" {{ old('filter_last_updated', isset($request) && $request->filter_last_updated) == 'last_month' ? 'selected' : '' }}>
                                            Last Month
                                        </option>
                                        <option value="quarter" {{ old('filter_last_updated', isset($request) && $request->filter_last_updated) == 'quarter' ? 'selected' : '' }}>
                                            This Quarter
                                        </option>
                                        <option value="year" {{ old('filter_last_updated', isset($request) && $request->filter_last_updated) == 'year' ? 'selected' : '' }}>
                                            This Year
                                        </option>
                                    </select>
                                </div>
                            </div>
                            

                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <label for=""><strong>Creation Date</strong></label>
                                <select name="filter_creation_date" id="filter_creation_date"
                                    class="form-control select2 rounded">
                                    <option value="">
                                        {{ old('filter_creation_date', isset($request) && $request->filter_creation_date ? '--Cancel--' : '--Select One--') }}
                                    </option>
                                    <option value="Today" {{ old('filter_creation_date', isset($request) && $request->filter_creation_date) == 'Today' ? 'selected' : '' }}>
                                        Today
                                    </option>
                                    <option value="Yesterday" {{ old('filter_creation_date', isset($request) && $request->filter_creation_date) == 'Yesterday' ? 'selected' : '' }}>
                                        Yesterday
                                    </option>
                                    <option value="3" {{ old('filter_creation_date', isset($request) && $request->filter_creation_date) == '3' ? 'selected' : '' }}>
                                        Last 3 Days
                                    </option>
                                    <option value="week" {{ old('filter_creation_date', isset($request) && $request->filter_creation_date) == 'week' ? 'selected' : '' }}>
                                        This Week
                                    </option>
                                    <option value="month" {{ old('filter_creation_date', isset($request) && $request->filter_creation_date) == 'month' ? 'selected' : '' }}>
                                        This Month
                                    </option>
                                    <option value="last_month" {{ old('filter_creation_date', isset($request) && $request->filter_creation_date) == 'last_month' ? 'selected' : '' }}>
                                        Last Month
                                    </option>
                                    <option value="quarter" {{ old('filter_creation_date', isset($request) && $request->filter_creation_date) == 'quarter' ? 'selected' : '' }}>
                                        This Quarter
                                    </option>
                                    <option value="year" {{ old('filter_creation_date', isset($request) && $request->filter_creation_date) == 'year' ? 'selected' : '' }}>
                                        This Year
                                    </option>
                                </select>
                            </div>
                            

                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <label for=""><strong>Created at From</strong></label>
                                <input type="date" id="filter_min_created_at" name="filter_min_created_at"
                                    value="{{ old('filter_min_created_at', $request->filter_min_created_at ?? '') }}"
                                    class="form-control">
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <label for=""><strong>Created at To</strong></label>
                                <input type="date" id="filter_max_created_at" name="filter_max_created_at"
                                    value="{{ old('filter_max_created_at', $request->filter_max_created_at ?? '') }}"
                                    class="form-control">
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <label for=""><strong>Updated at From</strong></label>
                                <input type="date" id="filter_min_updated_at" name="filter_min_updated_at"
                                    value="{{ old('filter_min_updated_at', $request->filter_min_updated_at ?? '') }}"
                                    class="form-control">
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <label for=""><strong>Updated at To</strong></label>
                                <input type="date" id="filter_max_updated_at" name="filter_max_updated_at"
                                    value="{{ old('filter_max_updated_at', $request->filter_max_updated_at ?? '') }}"
                                    class="form-control">
                            </div>
                            <div class="col-md-4 d-flex flex-wrap gap-2">
                                <button type="button" class="btn btn-danger w-md mt-4" id="filter-button">
                                    <i class="mdi mdi-filter"></i> Filter
                                </button>
                                <button type="button" class="btn btn-primary w-md mt-4" id="reset-dates-button">
                                    <i class="fas fa-sync-alt"></i> Reset
                                </button>
                            </div>  
                        </div>
                        
                       
                  
                </div>
                

            </div>  
             <hr>  

                
           




            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table id="lead-table" class="table table-sm table-hover table-responsive w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Contact Number</th>
                                        <th>Campaign</th>
                                        <th>Agent</th>
                                        <th>Status</th>
                                        <th>Qualified Status</th>
                                        <th>Created on</th>
                                        <th>Last Updated</th>
                                        <th>Service</th>
                                        <th>BOQ</th>
                                        <th>Margin</th>
                                        <th>Total Amount</th>
                                       
                                        <th>Action</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade exampleModal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Leads</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <form action="{{ route('lead.import') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <span>Click <a
                                    href="{{ route('downloadFile', ['file' => 'Lead Sample CSV.csv']) }}">here</a>
                                to download the sample CSV file.</span>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Upload File *</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="file" name="file" required
                                                accept=".csv">
                                            <label class="custom-file-label" for="file">Choose file</label>
                                        </div>
                                    </div>
                                    <small class="ml-2 text-danger" id="selected_file">No File Selected</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- @role('Admin') --}}

<!-- Modal -->
<div class="modal fade exampleModalReassign" id="exampleModalReassign" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalReassignLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalReassignLabel">Reassign Leads</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label for=""><strong>Select Agent</strong></label>
                        <select name="agent_id" id="reassignAgentId" class="form-control">
                            <option value="">--Select Agent--</option>
                            @foreach ($agents as $agent)
                            <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                            @endforeach
                        </select>
                        <div class="p-2">
                            <small class="text-info"><em>Selected Leads will be reassigned. Previous agent will
                                    not have access to these leads anymore</em></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="reassignSubmitButton" class="btn btn-success">Reassign</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade exampleModalReassignNew" id="exampleModalReassignNew" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalReassignNewLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalReassignNewLabel">Reassign Leads as New</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label for=""><strong>Select Agent</strong></label>
                        <select name="agent_id" id="reassignNewAgentId" class="form-control">
                            <option value="">--Select Agent--</option>
                            @foreach ($agents as $agent)
                            <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                            @endforeach
                        </select>
                        <div class="p-2">
                            <small class="text-info"><em>Selected Leads will be reassigned and changed to new
                                    Leads. All the notes and folow ups will be deleted and Previous agent will
                                    not have access to these leads anymore. </em></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="reassignNewSubmitButton" class="btn btn-success">Reassign</button>
            </div>
        </div>
    </div>
</div>
{{--
<!-- @endrole --> --}}
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>


<script>
        $(document).ready(function() {

            // Initialize DataTable with filter parameters
            var table = $('#lead-table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ url('ajax_leads') }}",
                "data": function (d) {
                    d.filter_status = $('#filter_status').val();
                    d.filter_campaign_id = $('#filter_campaign_id').val();
                    d.filter_agent_id = $('#filter_agent_id').val();
                    d.filter_agent_id = $('#filter_agent_id').val();
                    d.filter_Q_status = $('#filter_Q_status').val();
                    d.filter_last_updated = $('#filter_last_updated').val();
                    d.filter_creation_date = $('#filter_creation_date').val();
                    d.filter_min_created_at = $('#filter_min_created_at').val();
                    d.filter_max_created_at = $('#filter_max_created_at').val();
                    d.filter_min_updated_at = $('#filter_min_updated_at').val();
                    d.filter_max_updated_at = $('#filter_max_updated_at').val();
                }
                
            },
            "columns": [
            
                { "data": "id" },
                { "data": "name" },
                { "data": "tel" },
                { "data": "campaign" },
                { "data": "agent_name" },
                { "data": "status" },
                { "data": "approved_status" },
                { "data": "created_at" },
                { "data": "updated_at" },
                { "data": "service_name" },
                { "data": "BOQ_number" },
                { "data": "total_margin" },
                { "data": "grand_total" },
                { "data": "boq_col", "orderable": false },
                { "data": "actions", "orderable": false },
            
            
            ],
            "order": [[0, 'desc']],
        });

      
        // Handle filter button click
        $('#filter-button').on('click', function() {
            table.draw();
        });


        $('#reset-dates-button').click(function() {
            // Clear select inputs and trigger change if necessary
            $('#filter_status').val('').trigger('change');
            $('#filter_campaign_id').val('').trigger('change');
            $('#filter_agent_id').val('').trigger('change');
            $('#filter_Q_status').val('').trigger('change');
            
            // Clear date inputs
            $('#filter_last_updated').val('');
            $('#filter_min_created_at').val('');
            $('#filter_creation_date').val('');
            $('#filter_max_created_at').val('');
            $('#filter_min_updated_at').val('');
            $('#filter_max_updated_at').val('');

        // Redraw the table
        table.draw();
        });



    });

      

    

</script>
<script>
    var checked_ids = [];
        var checked_ids_count = 0;
        $('#checkAll').click(function() {
            checked_ids = [];
            const checkAllVal = $('#checkAll:checked').val();

            if (checkAllVal == 'on') {
                $(document).find('.dt-select').prop('checked', true);
                $(document).find('.dt-select:checked').each(function() {
                    let ID = parseInt($(this).val());
                    checked_ids.push(ID);
                });
            } else {
                $(document).find('.dt-select').prop('checked', false);
                checked_ids = [];
            }
            checked_ids_count = checked_ids.length;
            // alert(checked_ids_count);
            console.log(checked_ids);
            if (checked_ids_count > 0) {
                $('.countIDS').text(checked_ids_count);
                $('#reassignButton').removeClass('d-none');
                $('#newReassignButton').removeClass('d-none');
                $('#bulkDeleteButton').removeClass('d-none');
                $('#cancelCheckAllButton').removeClass('d-none');
                $('#importButton').addClass('d-none');
                $('#createButton').addClass('d-none');
                $('#filterRow').addClass('d-none');


            } else {
                $('.countIDS').text('');
                $('#reassignButton').addClass('d-none');
                $('#newReassignButton').addClass('d-none');
                $('#bulkDeleteButton').addClass('d-none');
                $('#cancelCheckAllButton').addClass('d-none');
                $('#importButton').removeClass('d-none');
                $('#createButton').removeClass('d-none');
                $('#filterRow').removeClass('d-none');


            }
        });

        function checkValue(id) {
            // alert(id);
            var checkbox = $('.dt-select[value="' + id + '"]');
            var index = checked_ids.indexOf(id);
            if (index !== -1) {
                checked_ids.splice(index, 1); // Remove the element at the found index
                checkbox.prop('checked', false);
            } else {
                checked_ids.push(id);
                checkbox.prop('checked', true);
            }
            $('#checkAll').prop('checked', false);
            console.log(checked_ids);
            checked_ids_count = checked_ids.length;
            // alert(checked_ids_count);
            if (checked_ids_count > 0) {
                $('.countIDS').text(checked_ids_count);
                $('#reassignButton').removeClass('d-none');
                $('#newReassignButton').removeClass('d-none');
                $('#bulkDeleteButton').removeClass('d-none');
                $('#cancelCheckAllButton').removeClass('d-none');
                $('#importButton').addClass('d-none');
                $('#createButton').addClass('d-none');
                $('#filterRow').addClass('d-none');



            } else {
                $('.countIDS').text('');
                $('#reassignButton').addClass('d-none');
                $('#newReassignButton').addClass('d-none');
                $('#bulkDeleteButton').addClass('d-none');
                $('#cancelCheckAllButton').addClass('d-none');
                $('#importButton').removeClass('d-none');
                $('#createButton').removeClass('d-none');
                $('#filterRow').removeClass('d-none');


            }
        };

        function delete_confirm_n(url, id) {
            // alert(url);
            // alert(id);
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    url = "{{ URL::TO('/') }}/" + url + '/' + id;
                    window.location.href = url;
                }
            });

        };
        $('#cancelCheckAllButton').click(function() {
            $('#checkAll').prop('checked', false);
            $(document).find('.dt-select').prop('checked', false);
            checked_ids = [];
            $('.countIDS').text('');
            $('#reassignButton').addClass('d-none');
            $('#newReassignButton').addClass('d-none');
            $('#bulkDeleteButton').addClass('d-none');
            $('#cancelCheckAllButton').addClass('d-none');
            $('#importButton').removeClass('d-none');
            $('#createButton').removeClass('d-none');
            $('#filterRow').removeClass('d-none');

        });
        $('#bulkDeleteButton').click(function() {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // alert('done');
                    $.ajax({
                        url: "{{ url('bulkDeleteLeads') }}",
                        type: 'POST',
                        data: {
                            ids: checked_ids,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    // position: "top-end",
                                    icon: "success",
                                    title: response.success,
                                    showConfirmButton: false,
                                    timer: 1500,
                                    timerProgressBar: true,
                                }).then((result) => {
                                    // Check if the modal was closed (timer completed)
                                    if (result.dismiss) {
                                        // Reload the page after the timer ends
                                        location.reload();
                                    }
                                });
                            } else {
                                Swal.fire({
                                    // position: "top-end",
                                    icon: "error",
                                    title: response.error,
                                    showConfirmButton: true,
                                    // timer: 1500,
                                    // timerProgressBar: true,
                                })
                            }
                        },
                        error: function(xhr, status, error) {
                            alert(xhr.responseText);
                            console.error(xhr.responseText);
                        }
                    })
                }
            });
        });
        $('#reassignSubmitButton').click(function() {
            let selectedAgent = $("#reassignAgentId").val();
            if (selectedAgent == '') {
                // alert('Please Select An Agent');
                // $('#exampleModalReassign').modal('show');
            } else {
                $('#exampleModalReassign').modal('hide');
                $.ajax({
                    url: "{{ url('bulkReassignLeads') }}",
                    type: 'POST',
                    data: {
                        ids: checked_ids,
                        agent_id: selectedAgent,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                // position: "top-end",
                                icon: "success",
                                title: response.success,
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true,
                            }).then((result) => {
                                // Check if the modal was closed (timer completed)
                                if (result.dismiss) {
                                    // Reload the page after the timer ends
                                    location.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                // position: "top-end",
                                icon: "error",
                                title: response.error,
                                showConfirmButton: true,
                                // timer: 1500,
                                // timerProgressBar: true,
                            })
                        }

                    },
                    error: function(xhr, status, error) {
                        // Handle errors here
                        alert(xhr.responseText);
                        console.error(xhr.responseText);
                    }
                })
            }
        });
        $('#reassignNewSubmitButton').click(function() {
            let selectedAgent = $("#reassignNewAgentId").val();
            if (selectedAgent == '') {
                alert('Please Select An Agent');
                // $('#exampleModalReassign').modal('show');
            } else {
                $('#exampleModalReassign').modal('hide');
                $.ajax({
                    url: "{{ url('bulkReassignNewLeads') }}",
                    type: 'POST',
                    data: {
                        ids: checked_ids,
                        agent_id: selectedAgent,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                // position: "top-end",
                                icon: "success",
                                title: response.success,
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true,
                            }).then((result) => {
                                // Check if the modal was closed (timer completed)
                                if (result.dismiss) {
                                    // Reload the page after the timer ends
                                    location.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                // position: "top-end",
                                icon: "error",
                                title: response.error,
                                showConfirmButton: true,
                                // timer: 1500,
                                // timerProgressBar: true,
                            })
                        }

                    },
                    error: function(xhr, status, error) {
                        // Handle errors here
                        alert(xhr.responseText);
                        console.error(xhr.responseText);
                    }
                })
            }
        });
</script>

<!--     <script>
$(document).ready(function(){
    // Refresh the page after 5 minutes (300,000 milliseconds)
    setTimeout(function(){
        location.reload();
    }, 10000); // 5 minutes in milliseconds
});
</script> -->



@endsection