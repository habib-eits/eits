@extends('template.tmp')

@section('title', 'Emplyee Section')
 

@section('content')

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

<div class="alert alert-{{ Session::get('class') }} p-3 ">
                    
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


                             <div class="card">
                                  <div class="card-header bg-transparent border-bottom h5  ">
                                        Leave Summary
                                    </div>
                                    <div class="card-body">

                                         @if(count($leavetype)>0)    
                                        <table class="table  table-striped table-sm align-middle table-nowrap mb-0">
                                        <tbody>
                                          <thead>
                                        <th class="col-md-1">S.No</th>
                                        <th class="col-md-2">Leave Type</th>
                                        <th class="col-md-9">Description</th>
                                        <th class="col-md-9">Leave Availed</th>
                                        </thead>
                                        </tbody>
                                        <tbody>
                                        @foreach ($leavetype as $key =>$value)
<?php 

$leave = DB::table('leave')->select(DB::raw('Sum(DaysApproved) as LeaveAvailed'))
            ->where('EmployeeID',session::get('EmployeeID'))
            ->where('LeaveTypeID',$value->LeaveTypeID)
            ->get();

 ?>


                                         <tr>
                                         <td class="col-md-1">{{$key+1}}</td>
                                         <td class="col-md-1">{{$value->LeaveTypeName}}</td>
                                         <td class="col-md-1">{{$value->DaysAllowed}}</td>
                                         <td class="col-md-1 text-center">{{$leave[0]->LeaveAvailed}}</td>
                                         </tr>
                                         @endforeach   
                                         </tbody>
                                         </table>
                                         @else
                                           <p class=" text-danger">No data found</p>
                                         @endif   

 
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                         
                         <!-- employee detail side bar -->
                         @include('template.emp_sidebar')

                           
                        </div>
                        <!-- end row -->

                      

                       

                         
                     
                        
                    </div> <!-- container-fluid -->
                </div>


  @endsection