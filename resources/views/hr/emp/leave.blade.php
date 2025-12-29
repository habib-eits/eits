@extends('template.tmp')

@section('title', 'Emplyee Section')
 

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript">

           

         function view_data(id)
    {
 window.open("{{URL('/LeaveDetail')}}/"+id,"_self"); 
//alert(id);
    }  

     function edit_data(id)
    {
 window.open("{{URL('/LeaveEdit')}}/"+id,"_self"); 
//alert(id);
    }

    function del_data(id)
    {

        var txt;
var r = confirm("Do you want to delete");
if (r == true) {
   window.open("{{URL('/LeaveDelete')}}/ "+id,"_self");  
} else {
  txt = "You pressed Cancel!";
}



//alert(id);
    }

        </script>
 <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Employee Detail</h4>

                                    <div class="page-title-right">
                                        <div class="page-title-right">
                                         <!-- button will appear here -->

                                         <a href="{{URL('/Employee')}}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i class="mdi mdi-arrow-left  me-1 pt-5"></i> Go Back</a>
                                         
                                    </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-9">
                                 @if (session('error'))

<div class="alert alert-{{ Session::get('class') }} p-3 " id="success-alert">
                    
                  {{ Session::get('error') }} 
                </div>

@endif

  @if (count($errors) > 0)
                                 
                            <div >
                <div class="alert alert-danger pt-3 pl-0   border-3 bg-danger text-white">
                   <p class="font-weight-bold"> There were some problems with your input.</p>
                    <ul>
                        
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>

                        @endforeach
                    </ul>
                </div>
                </div>

            @endif

           @include('hr.emp.emp_info')



 @if(Session::has('message'))
<p class="alert alert-warning">{{ Session::get('message') }}</p>
@endif
           
          
           

                            

                                 <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Leave List</h4>
                                          

                                   

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->



                                


                        <div class="row">
                            <div class="col-md-12">
                                 <div class="card">
                                     <div class="card-body p-4">
                                         <table id="datatable" class="table   dt-responsive  nowrap w-100 table-sm">
                                            <thead>
                                            <tr>
                                                
                                                <th>Leave Type</th>
                                                <th>From</th>
                                                <th>To</th>
                                                <th>No of Days</th>
                                                <th>Reason</th>
                                                <th>OM</th>
                                                <th>HR</th>
                                                <th>GM</th>
                                                
                                                
                                                <th>Action</th>
                                           
                                                
                                             </tr>
                                            </thead>
        
        
                                            <tbody>
                                             
                                            </tbody>
                                        </table>
                                     </div>
                                 </div>
        
                                <!-- end card -->
                            </div>
                            <!-- end col -->

                           
                        </div>
                        <!-- end row -->



                            </div>
                            <!-- end col -->
                         
                         <!-- employee detail side bar -->
                         @include('template.emp_sidebar')

                           
                        </div>
                        <!-- end row -->

                      

                       

                         
                     
                        
                    </div> <!-- container-fluid -->
                </div>

<script type="text/javascript">
$(document).ready(function() {

     

     $('#datatable').DataTable({
        "processing": true,
        "serverSide": true,
        "pageLength":50,
        "ajax": "{{ url('ajax_leave') }}",
        "columns":[
           
            { "data": "LeaveTypeName" },
            { "data": "FromDate" },
            { "data": "ToDate" },
            { "data": "NoOfDays" },
            { "data": "Reason" },
            { "data": "OMStatus" },
            { "data": "HRStatus" },
            { "data": "GMStatus" },
            
             
            
           
        
            { "data": "action" }
        ]
     
     });
});

$("#success-alert").fadeTo(4000, 500).slideUp(100, function(){
    // $("#success-alert").slideUp(500);
    $("#success-alert").alert('close');
});


</script>
  @endsection