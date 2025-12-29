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
                                    <h4 class="mb-sm-0 font-size-18">Passport Expiry List</h4>

                                    <div class="page-title-right">
                                        <div class="page-title-right">
                                         <!-- button will appear here -->

                                         <a href="{{URL('/Dashboard')}}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i class="mdi mdi-arrow-left me-1"></i>Go Back </a>
                                         
                                    </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->


 @if (session('error'))

<div class="alert alert-{{ Session::get('class') }} p-3"  id="success-alert">
                    
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


                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4"></h4>

                                        <table class="table table-sm align-middle table-nowrap mb-0">
                                        <tbody><tr>
                                        <th class="col-md-1">S.No</th>
                                        <th class="col-md-4">Employee ID</th>
                                        <th class="col-md-1">Visa Expiry</th>
                                        <th class="col-md-1">Designation</th>
                                        <th class="col-md-1">Department</th>
                                        <th class="col-md-1">Detail</th>
                                        </tr>
                                        </tbody>
                                        <tbody>
                                        @foreach ($passport_alert as $key =>$value)
                                         <tr>
                                         <td >{{$key+1}}</td>
                                         <td >{{$value->FirstName}} {{$value->MiddleName}} {{$value->LastName}}</td>
                                         <td >{{dateformatman($value->VisaExpiryDate)}}</td>
                                         <td >{{$value->JobTitleName}}</td>
                                         <td >{{$value->DepartmentName}}</td>
                                         <td ><a    href="{{URL('/EmployeeDetail/'.$value->EmployeeID)}}" target="_blank"   ><i class="mdi mdi-eye-outline align-middle me-1 font-size-20"></i></a> 


                                         <a  href="{{URL('/ComposeEmail/'.$value->EmployeeID)}}" ><i class="bx bx-mail-send align-middle me-1 font-size-20"></i></a>
 

 
                                         

            
                                      

                                     </td>
                                         </tr>
                                         @endforeach   
                                         </tbody>
                                         </table> 
                                        
                                    </div>
                                    <!-- end card body -->


 
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->

                           
                        </div>
                        <!-- end row -->
   
 
  @endsection