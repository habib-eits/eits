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
                                    <h4 class="mb-sm-0 font-size-18">Pending Leaves</h4>

                                    <div class="page-title-right">
                                        <div class="page-title-right">
                                         <!-- button will appear here --><a href="{{URL('/Dashboard')}}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i class="mdi mdi-arrow-left me-1"></i>Go Back </a>
                                    </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
  @if(count($leave_alert)>0)
 


                                        <table class="table table-sm align-middle table-nowrap mb-0">
                                        <tbody><tr>
                                        <th class="col-md-1">S.No</th>
                                        <th class="col-md-2">Employee</th>
                                        <th class="col-md-1">From</th>
                                        <th class="col-md-1">To</th>
                                        <th class="col-md-1">No of Days</th>
                                        <th class="col-md-1">Reason</th>
                                        <th class="col-md-1">Designation</th>
                                        <th class="col-md-1">Department</th>
                                        <th class="col-md-1">Action</th>
                                        </tr>
                                        </tbody>
                                        <tbody>

                                        @foreach ($leave_alert as $key =>$value)
                                         <tr>
                                         <td >{{$key+1}}</td>
                                         <td >{{$value->FirstName}} {{$value->MiddleName}} {{$value->LastName}}</td>
                                         <td >{{dateformatman($value->FromDate)}}</td>
                                         <td >{{dateformatman($value->ToDate)}}</td>
                                         <td >{{$value->NoOfDays}}</td>
                                         <td >{{$value->Reason}}</td>
                                         <td >{{$value->JobTitleName}}</td>
                                         <td >{{$value->DepartmentName}}</td>
                                         <td ><a target="_blank" href="{{URL('/LeaveEdit/'.$value->LeaveID)}}">Detail</a></td>
                                         </tr>
                                         @endforeach   
                                         </tbody>
                                         </table> 
@else
   <p class=" text-danger">No data found</p>
 @endif                                 </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->

                           
                        </div>
                        <!-- end row -->

                      

                       

                         
                     
                        
                    </div> <!-- container-fluid -->
                </div>


  @endsection