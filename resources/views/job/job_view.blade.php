@extends('template.tmp')

@section('title', 'Job View')
 

@section('content')
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

<?php 

$job_employee1 = DB::table('job_employee')->where('IsActive','Yes')->get();
$bill = DB::table('invoice_master')->where('JobID',session::get('JobID'))->sum('GrandTotal');
$expense = DB::table('expense_master')->where('JobID',session::get('JobID'))->sum('GrantTotal');
$tools = DB::table('job_tools')->where('JobID',session::get('JobID'))->count();
 
 ?>
 <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Job View</h4>

                                   

                                <div class="col d-flex justify-content-end">
                                     <a href="{{URL('/Job')}}" class="btn btn-success btn-rounded  "><i class="mdi mdi-arrow-left me-1"></i> Go Back</a>                     
                                 <button type="button" id="importButton" class="btn btn-primary mr-2 btn-rounded mx-2" data-bs-toggle="modal"
                                    data-bs-target=".exampleModal"><i class="mdi mdi-account-plus me-1"></i>
                                    Assign Staff
                                </button>
                                 
                            </div> 

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
<div class="row">
          <!-- start of card -->
       <div class="col-md-3">
                        <div class="card mini-stats-wid">
                             <div class="card-body border-secondary border-top border-3 rounded-top shadow-sm">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Staff Assigned</p>
                                <h4 class="mb-0">{{count($job_employee1)}}</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="mdi mdi-account-supervisor font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         <!-- end of card -->  


         <!-- start of card -->
      <div class="col-md-3">
                        <div class="card mini-stats-wid">
                             <div class="card-body border-secondary border-top border-3 rounded-top shadow-sm">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Purchases</p>
                                <h4 class="mb-0">{{$bill}}</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="mdi mdi-basket-fill font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         <!-- end of card  -->


         <!-- start of card -->
            <div class="col-md-3">
                        <div class="card mini-stats-wid">
                             <div class="card-body border-secondary border-top border-3 rounded-top shadow-sm">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Expenses</p>
                                <h4 class="mb-0">{{$expense}}</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="bx bx-copy-alt font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         <!-- end of card  -->



         <!-- start of card -->
     <div class="col-md-3">
                        <div class="card mini-stats-wid">
                             <div class="card-body border-secondary border-top border-3 rounded-top shadow-sm">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium" data-bs-toggle="modal"
                                    data-bs-target=".toolsModal">Tolls Assigned <i class="bx bx-plus"></i></p>
                                <h4 class="mb-0"><a href="#" title="" data-bs-toggle="modal"
                                    data-bs-target=".toolsModal">{{$tools}}</a></h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="mdi mdi-tools font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         <!-- end of card  -->


</div>
                        <div class="row">
                            <div class="col-md-12">
                                

 
                                <div class="card shadow-sm">
                                    <div class="card-body p-3">
                                        
 @if(count($job)>0)		
<table class="table table-sm  table-hover align-middle  mb-0">
 
@foreach ($job as $key =>$value)
 <tr>
 <td width="250" class="fw-bolder ">Job No</td>
 <td>{{$value->JobNo}}</td>
 </tr>
 <tr>
 	<td class="fw-bolder ">Job Date</td>		
 	<td>{{dateformatman($value->JobDate)}}</td>		
 </tr> 

 <tr>
  <td class="fw-bolder ">Due Date</td>    
  <td class="text-danger">{{dateformatman($value->JobDueDate)}}</td>   
 </tr>

  <tr>
 	<td class="fw-bolder  align-top">Job Detail</td>		
 	<td>{!!$value->JobDetail!!}</td>		
 </tr>

  <tr>
 	<td class="fw-bolder ">Job Created For</td>		
 	<td>{{$value->PartyName}}</td>		
 </tr>
 @endforeach   
 </tbody>
 </table>
 @else
   <p class=" text-danger">No data found</p>
 @endif   
                                        
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->

                




                               
                     </div>


   <!-- Modal -->
        <div class="modal fade exampleModal" id="exampleModal"   role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Assign Staff to Job</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            
                        </button>
                    </div>
                    <form action="{{ route('jobstaff.store') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            
                            <input type="hidden" name="JobID" value="{{session::get('JobID')}}" required="">
                                 
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <label for=""><strong>Staff: <span class="text-danger">*</span></strong></label>
                                            {{-- <br> --}}
                                            <div >
                                                <select name="EmployeeID" id="EmployeeID"
                                                    class="form-select select2 " required style="width: 100% !important;">
                                                    <option value="">--Select--</option>
                                                     
                                                      @foreach($employee as $value)
                                                       <option value="{{$value->EmployeeID}}">{{$value->FirstName}}</option>
                                                      @endforeach
                                                     
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                               
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



   <!-- Modal Edit -->
        <div class="modal fade exampleModaledit" id="exampleModaledit"   role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            
                        </button>
                    </div>
                    <form action="{{ route('jobstaff.update') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            
                            <input type="hidden" name="JobID" value="{{session::get('JobID')}}" required="">
                            <input type="hidden" name="JobDetailID" id="JobDetailID" required="">
                                 
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <label for=""><strong>Staff: <span class="text-danger">*</span></strong></label>
                                            {{-- <br> --}}
                                            <div >
                                                <select name="EmployeeID" id="EmployeeIDEdit"
                                                    class="form-select select2" required style="width: 100% !important;">
                                                    <option value="">--Select--</option>
                                                     
                                                      @foreach($staff as $value)
                                                       <option value="{{$value->EmployeeID}}">{{$value->FirstName}}</option>
                                                      @endforeach
                                                     
                                                </select>
                                            </div>
                                        </div>

                                             <div class="col-12 mt-3">
                                            <label for=""><strong>Is Active: <span class="text-danger">*</span></strong></label>
                                            {{-- <br> --}}
                                            <div >
                                                <select name="IsActive" id="IsActive"
                                                    class="form-select" required style="width: 100% !important;">
                                                    <option value="">--Select--</option>
                                                     <option value="Yes">Yes</option>}
                                                     <option value="No">No</option>}
                                                     option
                                                     
                                                     
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                               
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>




<!-- Tools Model -->
        <div class="modal fade toolsModal" id="toolsModal"   role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
         <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Assigned Tools</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            
                        </button>
                    </div>
                 
                          <div class="modal-body" style="overflow-y: auto !important;">
                            
                                 <form action="{{ route('jobtool.assign') }}" method="post">
                        @csrf
                        <input type="hidden" name="JobID" value="{{session::get('JobID')}}">
                           
                             @if(count($item)>0)        
                            <table class="table table-sm align-middle table-nowrap mb-0">
                            <tbody><tr>
                            <th width="5"></th>
                            <th width="50">Tools Name</th>
                            <th width="50">Description</th>
                             </tr>
                            </tbody>
                            <tbody>
                            @foreach ($item as $key =>$value)
                             <tr>
                             <td ><input type="checkbox" name="ItemID[]" value="{{$value->ItemID}}"></td>
                             <td >{{$value->ItemName}}</td>
                             <td >{{$value->ItemDescription}}</td>
                        
                             </tr>
                             @endforeach   
                             </tbody>
                             </table>
                             @else
                               <p class=" text-danger">No data found</p>
                             @endif   


                            <div class="mt-3">
                            <button type="submit" class="btn btn-success">Assigned</button>
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                             
                                 
                               
                               
                        </div>
                    
                                 
                          

                         </div>     
                       
                    </form>
                </div>
            </div>
 

 


<div class="card">
     <div class="card-header bg-transparent p-3">
        <h5>Tools Assigned</h5>
    </div>
    <div class="card-body shadow-sm">
        
          @if(count($job_tools)>0)        
                            <table class="table table-sm table-hover align-middle mb-0">
                            <thead>
                                <tr>
                            <th width="5%">#</th>
                            <th width="50%">Tools Name</th>
                            <th width="45%">Description</th>
                            <th width="5">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($job_tools as $key =>$value)
                             <tr>
                             <td >{{$key+1}}</td>
                             <td >{{$value->ItemName}}</td>
                             <td >{{$value->ItemDescription}}</td>
                             <td ><a href="#"
            onclick="delete_confirm2(`JobToolDelete`,'{{ $value->JobToolID }}')">
            <i class="mdi mdi-trash-can text-danger font-size-16 align-middle me-1 text-secondary"></i>
        </a></i></a></td>
                             </tr>
                             @endforeach   
                             </tbody>
                             </table>
                             @else
                               <p class=" text-danger">No data found</p>
                             @endif 

    </div>
</div>


<div class="card shadow-sm">
    <div class="card-header bg-transparent p-3">
        <h5>Assigned Staff</h5>
    </div>
    <div class="card-body">
        
 <table class="table table-hover align-middle table-sm">
    <thead >
        <tr class="font-size-14">
            <th>#</th>
            <th>Full Name</th>
            <th>Designation</th>
            <th>Is Active</th>
            <th>Action</th>
        </tr>
    </thead>
<tbody>
   
    
@if(!$job_employee->isEmpty())
     @foreach($job_employee as $value)
       
          <tr>
        <td width="10%">
            <div class="avatar-xs">
                <span class="avatar-title rounded-circle bg-primary text-white font-size-16">
                    {{substr($value->FirstName,0,1)}}{{substr($value->LastName,0,1)}}
                </span>
            </div>
        </td>
        <td width="45%"><h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark"> {{$value->FullName}}</a></h5></td>
        <td width="30%">
            <div>
                <span class="badge bg-primary bg-soft text-primary font-size-11"> {{$value->JobTitleName}}</span>
            </div>
        </td>

          <td width="20%">
            <div>
                <span class="badge {{($value->IsActive=='Yes') ? 'bg-success' : 'bg-danger'}}   text-white  font-size-11"> {{$value->IsActive}}</span>
            </div>
        </td>
        <td width="5%">     
                                     
    

         <a href="javascript:;" onclick="jobstaff_edit({{ $value->JobDetailID }})">
                        <i class="mdi mdi-pencil font-size-18 align-middle text-secondary"></i>
                    </a>


                                        <a href="#"
            onclick="delete_confirm_n(`JobEmployeeDelete`,'{{ $value->JobDetailID }}')">
            <i class="mdi mdi-trash-can text-danger font-size-18 align-middle me-1 text-secondary"></i>
        </a></td>
    </tr>


     @endforeach
     @else

     <tr>
         <td colspan="4" class="text-center text-danger ">No data found</td>
     </tr>
   @endif

</tbody>
</table>

    </div>
</div>

                           
                        </div>
                        <!-- end row -->

                    

   <div>
                       
                   </div>                

                         
    
                     
                        
                    </div> <!-- container-fluid -->
                </div>
                </div>
                       </div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#service-table').DataTable({
                columnDefs: [{
                        orderable: false,
                        targets: [0,3]
                    } // Disable ordering for the first column (checkbox)
                ]
            });
        });
    </script>
    <script>
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

           function jobstaff_edit(id) {
            
           
             $.ajax({
                url: '{{URL("/JobEmployeeEdit")}}' + '/' + id,
                type: 'GET',
                success: function(response) {
                    console.log(response.data);
                    if (response.data) {
                        $('#JobDetailID').val(response.data.JobDetailID);
                        $('#EmployeeIDEdit').val(response.data.EmployeeID);
                        $('#EmployeeIDEdit').trigger('change');
                        $('#IsActive').val(response.data.IsActive);
                        $('#IsActive').trigger('change');
            
                        $("#exampleModaledit").modal("show");

                       
                    } else {
                        alert(response.error);
                    }

                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    alert(xhr.responseText);
                    console.error(xhr.responseText);
                }
            })
        };
    
    </script>

 




  @endsection