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
                                    <h4 class="mb-sm-0 font-size-18"> Salary Detail</h4>

                                    <div class="page-title-right ">
                                        <div class="page-title-right text-danger">
                                         <!-- button will appear here -->[{{session::get('MonthName')}}]  <a href="{{URL('/SalaryPrint/'.session::get('MonthName').'/'.session::get('BranchID'))}}" target="_blank" class="shadow-sm btn btn-success btn-rounded w-sm"><i class="mdi mdi-printer me-2"></i>Print</a>

                                         
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
                                        <h4 class="card-title mb-4"> </h4>

                                        <table   class="table table-sm table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline" role="grid" aria-describedby="datatable_info" style="width: 1247px;">
                                            <thead>
                                            <tr>
                                            	  <tr class="bg-light ">
                                                    <th scope="col">S.No</th>
                                                    <th scope="col">Employee ID</th>
                                                    <th scope="col">Employee Name</th>
                                                    <th scope="col">Job Title </th>
                                                     <th scope="col">Days Present</th>
                                                   
                                                    <th scope="col">PerDay</th>
                                                    
                                                    <th scope="col">Basic</th>
                                                    < 
                                                    <th scope="col">Adv Loan</th>
                                                    
                                                    <th scope="col">Leave Ded</th>
                                                    <th scope="col">Total Ded</th>
                                                    
                                                    <th scope="col">Grand Salary</th>
                                                    <th scope="col">Net Salary</th>
                                                     
                                                   


 
                                            </tr>
                                             </thead>
        
        
                                            <tbody>
                                            
                                             
                                            <tr>
                                            	<?php foreach ($salary as $key => $value): ?>
                                            		
                                            	
                                                <td> {{$key+1}} </td>
                                                <td> {{$value->EmployeeID}} </td>
                                                <td> {{$value->EmployeeName}} </td>
                                                 <td> {{$value->JobTitle}} </td>
                                                  <td> {{$value->DaysPresent}} </td>
                                                
                                                 <td> {{$value->PerDay}} </td>
                                                 <td> {{$value->BasicSalary}} </td>
                                                
                                                 <td> {{$value->AdvanceLoan}} </td>
                                                 <td> {{$value->LeaveDeduction}} </td>
                                                 <td> {{$value->TotalDeduction}} </td>
                                                 <td> {{$value->GrandSalary}} </td>
                                                 <td> {{$value->NetSalary}} </td>
                                                 

                                                 
                                          
                                                 
                                            </tr> 

                                            <?php endforeach ?>
                                             

                                           
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

                      

                       

                         
                     
                        
                    </div> <!-- container-fluid -->
                </div>


  @endsection