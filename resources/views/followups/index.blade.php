@extends('template.tmp')
@section('title', 'Followups')

@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-sm-0 font-size-18">All Followups</h3>

                            {{-- <div class="page-title-right d-flex">

                                <div class="page-btn">
                                    <a href="#" class="btn btn-added btn-primary" data-bs-toggle="modal" data-bs-target="#add-followup"><i class="me-2"></i>Add New Followup</a>
                                </div>  
                            </div> --}}



                        </div>
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
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="filterRow">
                                           <div class="row">
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Date From</label>
                                                        <div class="input-group">
                                                            <div class="input-group-text"><span class="bx bx-calendar" ></span> </div>
                                                            <input type="date" name="start_date" id="start_date" class="form-control" value="">
                                                        </div>
                                                    
                                                    </div> 
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Date To</label>
                                                        <div class="input-group">
                                                            <div class="input-group-text"><span class="bx bx-calendar" ></span> </div>
                                                            <input type="date" name="end_date" id="end_date" class="form-control" value="">
                                                        </div>
                                                    
                                                    </div> 
                                                </div>
        
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">User</label>
                                                        <select name="user_id" id="user_id" class="select2 form-control" >                                                
                                                            <option value="">Choose...</option>
                                                            @foreach ($users as $user)
                                                                <option value="{{$user->id}}">{{ $user->name }}</option>
                                                            @endforeach
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
                                        </div>
                                    </div>
                                </div>
                            </div>              
                        </div>
                        <div class="card">

                            <div class="card-body">
                                <table id="table" class="table table-striped table-sm " style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th>Client</th>
                                            <th>User</th>
                                            <th>Notes</th>
                                            <th>Remarks</th>
                                            <th>created at</th>
                                         
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

        <!-- Add Followup -->
            <div class="modal fade" id="add-followup">
                <div class="modal-dialog custom-modal-two">
                    <div class="modal-content">
                        <div class="page-wrapper-new p-0">
                            <div class="content">
                                <div class="modal-header border-0 custom-modal-header">
                                    <div class="page-title">
                                        <h4>Create Followup</h4>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        
                                    </button>
                                </div>
                                <div class="modal-body custom-modal-body">
                                    <form id="followup-store" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Image</label>
                                            <input type="file" name="image" id="image" class="form-control">
                                        </div> 
                                        <div class="mb-3 ">
                                            <label class="col-form-label">Status</label>
                                            <select name="is_active" id="is_active" class="form-select form-control" style="width:100%">
                                                <option selected value="1" >Active</option>
                                                <option value="0">Inactive</option>
                                               
                                            </select>
                                        </div>
            
                                    
                                        <div class="modal-footer-btn">
                                            <button type="button" class="btn btn-cancel me-2 btn-dark" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" id="submit-followup-store" class="btn btn-submit btn-primary">Create Followup</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- /Add Followup -->

         <!-- Edit Followup -->
            <div class="modal fade" id="edit-followup">
                <div class="modal-dialog custom-modal-two">
                    <div class="modal-content">
                        <div class="page-wrapper-new p-0">
                            <div class="content">
                                <div class="modal-header border-0 custom-modal-header">
                                    <div class="page-title">
                                        <h4>Edit Followup</h4>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        
                                    </button>
                                </div>
                                <div class="modal-body custom-modal-body">
                                    <form id="followup-update" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT') <!-- For PUT method -->
                                        <input type="hidden" name="id" id="followup"> <!-- Hidden field to store the followup ID -->
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="date" name="date" id="edit_date" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Remarks</label>
                                            <input type="text" name="remarks" id="edit_remarks" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Notes</label>
                                            <input type="text" name="notes" id="edit_notes" class="form-control">
                                        </div>
                                        
                                        

            
                                      
                                        <div class="modal-footer-btn">
                                            <button type="button" class="btn btn-cancel me-2 btn-dark" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" id="submit-followup-update" class="btn btn-submit btn-primary">Update Followup</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- /Edit Followup -->

     <!-- Delete Followup -->
        <div class="modal fade" id="delete-followup">
            <div class="modal-dialog custom-modal-two">
                <div class="modal-content">
                    <div class="page-wrapper-new p-0">
                        <div class="content">
                            <div class="modal-header border-0 custom-modal-header">
                                <div class="page-title">
                                    <h4>Delete Followup</h4>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    
                                </button>
                            </div>
                            
                                <div class="modal-body custom-modal-body pt-3 pb-0">
                                    <p class="text-center">Are you sure you want to delete this followup?</p>
                                </div>
                                <div class="modal-footer-btn p-3 mt-2">
                                    <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-submit shadow-sm btn-danger" id="submit-followup-destroy">Delete</button>
                                </div>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
    <!-- /Delete Followup -->


 


    <!-- END: Content-->

    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script>
        // Create an instance of Notyf
        let notyf = new Notyf({
            duration: 3000,
            position: {
                x: 'right',
                y: 'top',
            },
        });
    </script>


    <script>

        $(document).ready(function() {
            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('followups.index') }}",
                    data: function (d) {
                        d.start_date = $('#start_date').val();
                        d.end_date = $('#end_date').val();
                        d.user_id = $('#user_id').val();
                    }
                },
                columns: [
                    { data: 'id' },
                    { data: 'date' },
                    { data: 'party_name' },
                    { data: 'user_name' },
                    { data: 'notes' },
                    { data: 'remarks' },
                    { data: 'created_at' },
                   
                    { data: 'action', orderable: false, searchable: false },
                ],
                order: [[0, 'desc']],
            });
            $('#filter-btn').on('click', function(){
                table.draw();
            });
            $('#reset-filter-btn').on('click', function(){
                $('#start_date').val('');
                $('#end_date').val('');
                $('#user_id').val('').trigger('change');
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
            
          
            $('#followup-store').on('submit', function(e) {
                e.preventDefault();
                var submit_btn = $('#submit-followup-store');
                let createformData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('followups.store') }}",
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    cache: false,
                    data: createformData,
                    enctype: "multipart/form-data",
                    beforeSend: function() {
                        submit_btn.prop('disabled', true);
                        submit_btn.html('Processing');
                    },
                    success: function(response) {
                        
                        submit_btn.prop('disabled', false).html('Create Followup');  

                        if(response.success == true){
                            $('#add-followup').modal('hide'); 
                            $('#followup-store')[0].reset();  // Reset all form data
                            table.ajax.reload();
                        
                            notyf.success({
                                message: response.message, 
                                duration: 3000
                            });
                        }else{
                            notyf.error({
                                message: response.message,
                                duration: 5000
                            });
                        }   
                    },
                    error: function(e) {
                        submit_btn.prop('disabled', false).html('Create Followup');
                    
                        notyf.error({
                            message: e.responseJSON.message,
                            duration: 5000
                        });
                    }
                });
            });
            
            $('#followup-update').on('submit', function(e) {
                e.preventDefault();
                var submit_btn = $('#submit-followup-update');
                let followup = $('#followup').val(); // Get the ID of the followup being edited

                let editFormData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('followups.update', ':id') }}".replace(':id', followup), // Using route name
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    cache: false,
                    data: editFormData,
                    enctype: "multipart/form-data",
                    beforeSend: function() {
                        submit_btn.prop('disabled', true);
                        submit_btn.html('Processing');
                    },
                    success: function(response) {
                        
                        submit_btn.prop('disabled', false).html('Update Followup');  

                        if(response.success == true){
                            $('#edit-followup').modal('hide'); 
                            $('#followup-update')[0].reset();  // Reset all form data
                            table.ajax.reload();
                        
                            notyf.success({
                                message: response.message, 
                                duration: 3000
                            });
                        }else{
                            notyf.error({
                                message: response.message,
                                duration: 5000
                            });
                        }   
                    },
                    error: function(e) {
                        submit_btn.prop('disabled', false).html('Update Followup');
                    
                        notyf.error({
                            message: e.responseJSON.message,
                            duration: 5000
                        });
                    }
                });
            });


            $('#submit-followup-destroy').click(function() {
                let followup = $(this).data('id');
                var submit_btn = $('#submit-followup-destroy');

                $.ajax({
                    type: 'DELETE',
                    url: "{{ route('followups.destroy', ':id') }}".replace(':id', followup), // Using route name
                    data: {
                        _token: "{{ csrf_token() }}" // Add CSRF token
                    },
                    beforeSend: function() {
                            submit_btn.prop('disabled', true);
                            submit_btn.html('Processing');
                        },
                    success: function(response) {
                        
                        submit_btn.prop('disabled', false).html('Delete Followup');  

                        if(response.success == true){
                            $('#delete-followup').modal('hide'); 
                            table.ajax.reload();
                        
                            notyf.success({
                                message: response.message, 
                                duration: 3000
                            });
                        }else{
                            notyf.error({
                                message: response.message,
                                duration: 5000
                            });
                        }   
                    },
                    error: function(e) {
                        submit_btn.prop('disabled', false).html('Delete Followup');
                    
                        notyf.error({
                            message: e.responseJSON.message,
                            duration: 5000
                        });
                    }
                });
            });

        });

        // Handle the delete button click
       

        function editFollowup(id) {
            $.get("{{ route('followups.edit', ':id') }}".replace(':id', id), function(response) {
                $('#followup').val(response.id);
                $('#edit_date').val(response.date);
                $('#edit_notes').val(response.notes);
                $('#edit_remarks').val(response.remarks);
                $('#edit_is_active').val(response.is_active).trigger('change');              


                $('#edit-followup').modal('show');
            }).fail(function(xhr) {
                alert('Error fetching followup details: ' + xhr.responseText);
            });
        }

        function deleteBrand(id) {
            $('#submit-followup-destroy').data('id', id);
            $('#delete-followup').modal('show');
        }

    </script>

    <script>
        $(document).ready(function() {
            $('#table thead tr').clone(true).appendTo('#table thead');
            $('#table thead tr:eq(1) th').each(function(i) {
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
            var table = $('#table').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                retrieve: true,
                paging: false

            });
        });
    </script>
@endsection

{{-- 
Followups

followup

editFollowup
deleteBrand
followup
Followup 
--}}