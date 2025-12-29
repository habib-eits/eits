@extends('template.tmp')

@section('title', 'HR')
 

@section('content')
 
 <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Job Title</h4>

                                    <div class="page-title-right">
                                        <div class="page-title-right">
                                         <!-- button will appear here -->

                                         <a href="{{URL('/Attendance')}}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i class="mdi mdi-arrow-left me-1"></i> Go Back</a>
                                         
                                    </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-12">
                                 @if (session('error'))

<div class="alert alert-{{ Session::get('class') }} p-3">
                    
                  <strong>{{ Session::get('error') }} </strong>
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
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4"></h4>

    <form action="{{URL('/AttendanceSave')}}" method="post">

     {{csrf_field()}} 


       <div class="col-md-4">
     <div class="mb-3">
     <label for="basicpill-firstname-input">Date*</label>
     <input type="date" class="form-control form-control-sm" name="Date" value="{{date('Y-m-d')}}" id="Date" style="width: 130px;">
     </div>
     </div>
     
                             
                             

           <table class="table table-sm table-striped">
               <thead>
                   <tr>
                       <th width="75">S#</th>
                       <th width="150">Employee</th>
                       <th width="150">Designation</th>
                       <th width="150">Salary Type</th>
                       <th width="150">Project</th>
                       <th width="75">Attendance</th>
                       <th width="75">OT</th>
                       <th width="75">Per Hour</th>
                       <th width="75">Per Day</th>
                   </tr>
               </thead>
               <tbody>
                @foreach($employee  as $value)


                   <tr>
                       <td> {{$value->EmployeeID}} <input type="hidden" name="EmployeeID[]" value="{{$value->EmployeeID}}"> <input type="hidden" name="SalaryTypeID[]" value="{{$value->SalaryTypeID}}"></td>
                       <td> {{$value->FullName}} {{$value->SalaryTypeID}}  </td>
                       <td> {{$value->JobTitleName}} </td>
                       <td> {{$value->AllowanceTitle}} </td>
                       <td> <select name="JobID[]" style="width: 150px;" >
                            

                             @foreach($job as $value1)
                              <option value="{{$value1->JobID}}" >{{$value1->JobNo}}</option>
                             @endforeach
                            
                           
                        
                           
                       </select> </td>


                          <td  >     <select name="Attendance[]"  style="width: 65px;">
                           <option value="1">P</option>
                           <option value="0">A</option>
                           <option value="0.5">Half</option>
                           
                       </select> </td>
                       <td class=""> <input type="number" style="width: 65px;" name="OT[]"  pattern="[0-9]*" inputmode="decimal">  </td>
                       <td> <input type="number" style="width: 65px;" name="PerHour[]"  pattern="[0-9]*" inputmode="decimal">  </td>
                       <td> <input type="number" style="width: 65px;" name="PerDay[]"  pattern="[0-9]*" inputmode="decimal">  </td>
                   </tr>
                   @endforeach
               </tbody>
           </table>
                             

                            

                             	<div><button type="submit" class="btn btn-success w-sm float-right">Save</button>
                             	     
                             	</div>
                             	
                             
                             </div>
                             
                         
                             
                             
                             
                             
                             
                             

                         </form>

                                        
                                    </div>
                                    <!-- end card body -->
                                </div> 

                        
                            </div>
                            <!-- end col -->

                           
                        </div>
                        <!-- end row -->

                      

                       

                         
                     
                        
                    </div> <!-- container-fluid -->
                </div>

 <script>
    // Get today's date
    var today = new Date();

    // Disable dates before today
    var inputDate = document.getElementById("Date");
    inputDate.min = today.toISOString().split('T')[0];
</script>

  @endsection