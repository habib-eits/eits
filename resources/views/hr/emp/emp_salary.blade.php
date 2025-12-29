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
                                  <div class="card-header bg-transparent border-bottom">
                                        Allowances
                                    </div>
                                    <div class="card-body">
                                      <!-- enctype="multipart/form-data" -->
<form action="{{URL('/EmpAllowanceSave')}}" method="post" class="outer-repeater"> {{csrf_field()}} 



<div class="row">
    
  
 
     <div class="col-md-4">
  <div class="mb-3">
     <label for="basicpill-firstname-input">Allowance*</label>
      <select name="AllowanceListID" id="AllowanceListID" class="form-select form-select-sm">
     <?php foreach ($allowance as $key => $value): ?>
         <option value="{{$value->AllowanceListID}}">{{$value->AllowanceTitle}}</option>
     <?php endforeach ?>
  </div>
   </select>
   </div>
    </div>
 
 
   <div class="col-md-2">
 <div class="mb-3">
 <label for="basicpill-firstname-input">Amount*</label>
 <input type="text" class="form-control form-control-sm"    name="Amount" value="{{old('Amount')}} ">
 </div>
 </div>
 
 
 
 


    <div class="col-md-2">
 <div class="mb-3">
    <label for="basicpill-firstname-input">Active*</label>
     <select name="Active" id="Active" class="form-select form-select-sm">
    <option value="Yes">Yes</option>
    <option value="No">No</option>
 
  </select>
  </div>
   </div>




</div>
 <div><button type="submit" class="btn btn-success w-sm float-right">Save</button>
     
</div>
<hr>

 @if(count($emp_salary)>0)        
<table class="table table-sm align-middle table-nowrap mb-0">
<tbody><tr class="bg-light">
<th scope="col">S.No</th>
<th scope="col">Allowance Title</th>
<th scope="col">Amount</th>
<th scope="col">Active</th>
<th scope="col">Delete</th>
</tr>
</tbody>
<tbody>
@foreach ($emp_salary as $key =>$value)
 <tr>
 <td class="col-md-1">{{$key+1}}</td>
 <td class="col-md-1">{{$value->AllowanceTitle}}</td>
 <td class="col-md-1">{{number_format($value->Amount,2)}}</td>
 <td class="col-md-1">{{$value->Active}}</td>
 <td class="col-md-1"><a href="{{URL('/EmpAllowanceDelete/').'/'.$value->EmployeeAllowanceID}}">Delete</a></td>
 </tr>
 @endforeach   
 </tbody>
 </table>
 @else
   <p class=" text-danger">No data found</p>
 @endif   







</form>
                                    </div>
                                </div>
           


                             <div class="card">
                                  <div class="card-header bg-transparent border-bottom h5  ">
                                        Salary Detail
                                    </div>
                                    <div class="card-body">
 @if(count($salary)>0) 
                                         <table class="table table-sm align-middle table-nowrap mb-0">
                                     <tbody><tr class="table-light">
                                     <th scope="col">S.No</th>
                                     <th scope="col">Month</th>
                                    <th scope="col">Basic</th>
                                    <th scope="col">HRA</th>
                                    <th scope="col">Transport</th>
                                    <th scope="col">Other Allowance</th>
                                    <th scope="col">Loan</th>
                                    <th scope="col">Leave Deduction</th>
                                    <th scope="col">Grand Salary</th>
                                    <th scope="col">Net Salary</th>
                                                                             
                                      </tr>
                                     </tbody>
                                     <tbody>
                                    @foreach ($salary as $key =>$value)
                                                                            
                                    <tr>
                                    <td class="col-md-1">{{$key+1}}</td>
                                     <td class="col-md-1"><a href="{{URL('/SalarySlip/'.$value->SalaryID)}}" target="_blank">{{$value->MonthName}}</a></td>
                                    <td class="col-md-1">{{number_format($value->BasicSalary)}}</td>
                                    <td class="col-md-1">{{number_format($value->HRA)}}</td>
                                    <td class="col-md-1">{{number_format($value->Transport)}}</td>
                                    <td class="col-md-1">{{number_format($value->OtherAllowance)}}</td>
                                    <td class="col-md-1">{{number_format($value->AdvanceLoan)}}</td>
                                    <td class="col-md-1">{{number_format($value->LeaveDeduction)}}</td>
                                    <td class="col-md-1">{{number_format($value->GrandSalary)}}</td>
                                    <td class="col-md-1">{{number_format($value->NetSalary)}} </td>
                                    
                                    
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