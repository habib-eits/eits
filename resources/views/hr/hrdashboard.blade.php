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
                                    <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                                    <div class="page-title-right ">
                                        <strong class="text-danger">{{session::get('Email')}}</strong>
                                         
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->



 @if (session('error'))

<div class="alert alert-{{ Session::get('class') }} p-3" id="success-alert">
                    
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

                        <div class="row ">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="media">
                                                    <div class="me-3">
                                                        <img src="assets/images/users/avatar-1.jpg" alt="" class="avatar-md rounded-circle img-thumbnail">
                                                    </div>
                                                    <div class="media-body align-self-center">
                                                        <div class="text-muted">
                                                            <p class="mb-2">Welcome to  HRM System</p>
                                                            <h5 class="mb-1">HR</h5>
                                                            <p class="mb-0">HR Manager</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                
                                        <!--     <div class="col-lg-8 align-self-center">
                                                <div class="text-lg-center mt-4 mt-lg-0">
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <div>
                                                                <p class="text-muted text-truncate mb-2">Total Employee</p>
                                                                <h5 class="mb-0">48</h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <div>
                                                                <p class="text-muted text-truncate mb-2">Agents</p>
                                                                <h5 class="mb-0">40</h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <div>
                                                                <p class="text-muted text-truncate mb-2">Closer</p>
                                                                <h5 class="mb-0">18</h5>
                                                                
                                                            </div>
                                                        </div>
                                                         <div class="col-2">
                                                            <div>
                                                                <p class="text-muted text-truncate mb-2">Floor Manager</p>
                                                                <h5 class="mb-0">18</h5>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                
                                          <!--   <div class="col-lg-2 d-none d-lg-block">
                                                <div class="clearfix mt-4 mt-lg-0">
                                                    <div class="dropdown float-end">
                                                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="bx bxs-cog align-middle me-1"></i> Setting
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#">Action</a>
                                                            <a class="dropdown-item" href="#">Another action</a>
                                                            <a class="dropdown-item" href="#">Something else</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                        <!-- end row -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">

                            <div class="col-xl-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="card">
                                            <div class="card-body border-secondary border-top border-3 rounded-top">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="avatar-xs me-3">
                                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                            <i class="mdi mdi-passport"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-14 mb-0">Visa Expiry</h5>
                                                </div>
                                                <div class="text-muted mt-4">
                                                    <h4 class="text-center"><a href="{{URL('/VisaAlert')}}">{{@$visaexpiry[0]->Total}}</a> </h4>
                                                    <div class="d-flex">
                                                         <span class="ms-2 text-truncate mt-3"> </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="card">
                                            <div class="card-body border-secondary border-top border-3 rounded-top">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="avatar-xs me-3">
                                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                           <i class="mdi mdi-passport"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-14 mb-0">Passport Expiry</h5>
                                                </div>
                                                <div class="text-muted mt-4">
                                                    <h4 class="text-center"><a href="{{URL('/PassportAlert')}}" >{{@$passportexpiry[0]->Total}}</a> </h4>
                                                    <div class="d-flex">
                                                         <span class="ms-2 text-truncate mt-3"> </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="card">
                                            <div class="card-body border-secondary border-top border-3 rounded-top">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="avatar-xs me-3">
                                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                            <i class="mdi mdi-calendar-cursor font-size-30 "></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-14 mb-0">Leaves </h5>
                                                </div>
                                                <div class="text-muted mt-4">
                                                    <h4 class="text-center"><a href="{{URL('/LeaveAlert')}}">{{count($leave_alert)}}</a> </h4>
                                                    
                                                    <div class="d-flex">
                                                         <span class="ms-2 text-truncate mt-3"> </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="card">
                                            <div class="card-body border-secondary border-top border-3 rounded-top">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="avatar-xs me-3">
                                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                            <i class="mdi mdi-fingerprint"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-14 mb-0">Attendance </h5>
                                                </div>
                                                <div class="text-muted mt-4">
                                                    <h4 class="text-center"><a href="{{URL('/AttendanceAlert')}}">9</a> </h4>
                                                    
                                                    <div class="d-flex">
                                                         <span class="ms-2 text-truncate mt-3"> </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Pending Leaves</h4>

                                    <div class="page-title-right"></div>

                                </div>
                            </div>
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
                            </div>
                        </div>
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
            </div>
  @endsection