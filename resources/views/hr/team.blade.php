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
                                    <h4 class="mb-sm-0 font-size-18">Supervisor & Team Tree</h4>

                                    <div class="page-title-right">
                                        <div class="page-title-right">
                                         <!-- button will appear here -->
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
                                        <h4 class="card-title mb-4"></h4>
<div class="">
                                            <ul class="verti-timeline list-unstyled">
                                               
                                              @if(count($employee)>0)  
                                              @foreach ($employee as $key => $value) 
                                                  
                                            <?php  
                                                $team = DB::table('v_employee')->where('SupervisorID',$value->EmployeeID)->get();    
                                                ?>
                                                <li class="event-list">
                                                    <div class="event-timeline-dot">
                                                        <i class="bx bx-right-arrow-circle"></i>
                                                    </div>
                                                    <div class="media">
                                                        <div class="me-3">
                                                            <i class="bx bx-copy-alt h2 text-primary"></i>
                                                        </div>
                                                        <div class="media-body">
                                                            <div>
                                                                <h5><a href="{{URL('/EmployeeEdit/'.$value->EmployeeID)}}" target="_blank">[{{$value->EmployeeID}}] - {{$value->FirstName}} {{$value->MiddleName}} {{$value->LastName}}, {{$value->JobTitleName}}, [{{$value->StaffType}}]</a> </h5>
                                                               
                                                                @if(count($team)>0)
                                                                @foreach($team as $key => $value)
                                                                <p class="text-muted">
                                                                    <a href="{{URL('/EmployeeEdit/'.$value->EmployeeID)}}" target="_blank">[{{$value->EmployeeID}}] - {{$value->FirstName}} {{$value->MiddleName}} {{$value->LastName}}, {{$value->JobTitleName}}, [{{$value->StaffType}}]</a>
                                                                 </p>
                                                                    
                                                                @endforeach
                                                                @endif


                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                 
                                             
                                        @endforeach
                                          @endif      
                                                 
                                               
                                            </ul>
                                        </div>
                                        
                                    </div>
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