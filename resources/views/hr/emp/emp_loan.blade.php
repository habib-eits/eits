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
                                        Loan / Installments
                                    </div>
                                    <div class="card-body">

                                         @if(count($loan)>0)    
                                        <table class="table table-sm align-middle table-nowrap mb-0">
                                        <tbody><tr>
                                        <th scope="col">S.No</th>
                                        <th scope="col">Loan</th>
                                        <th scope="col">Remarks</th>
                                        <th scope="col">Delete</th>
                                        </tr>
                                        </tbody>
                                        <tbody>
                                        @foreach ($loan as $key =>$value)
                                         <tr class="bg-light">
                                         <td class="col-md-1">{{$key+1}}</td>
                                         <td class="col-md-1">{{$value->Amount}}</td>
                                         <td class="col-md-1">{{$value->Remarks}}</td>
                                         <td class="col-md-1"><a href="{{URL('/LoanDelete')}}/{{$value->LoanID}}">Delete</a></td>

                                          

                                         </tr>
                                         <tr>
                                           <td colspan="3"> <?php 

                                         $loan_deduction=DB::table('loan_deduction')->where('LoanID',$value->LoanID)->get();

                                          ?>


                                          @if(count($loan_deduction)>0)    
                                         <table class="table table-sm align-middle table-nowrap mb-0">
                                         <tbody><tr>
                                         <th scope="col">S.No</th>
                                         <th scope="col">Amount</th>
                                         <th scope="col">Date</th>
                                         <th scope="col">Delete</th>
                                         </tr>
                                         </tbody>
                                         <tbody>
                                         @foreach ($loan_deduction as $key =>$value)
                                          <tr>
                                          <td class="col-md-1">{{$key+1}}</td>
                                          <td class="col-md-1">{{$value->Amount}}</td>
                                          <td class="col-md-1">{{$value->LoanDeductionDate}}</td>
                                          <td class="col-md-1"><a href="{{URL('/LoanInstallmentDelete')}}/{{$value->LoanDeductionID}}">Delete</a></td>
                                          </tr>
                                          @endforeach   
                                          </tbody>
                                          </table>
                                          @else
                                            <p class=" text-danger">No data found</p>
                                          @endif </td>


                                            
                                           
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



                          
                            <div class="card">
                                                            <div class="card-header bg-transparent border-bottom">
                                                                  <h5>Make Loan</h5>
                                                              </div>
                                                              <div class="card-body">
                                                                <!-- enctype="multipart/form-data" -->
                                                                <form action="{{URL('/LoanSave')}}" method="post"> 
                                                                {{csrf_field()}} 

                                                              
                                                                  <div class="row">
                                                                      <div class="col-md-4"> 
                                                                      <label for="basicpill-firstname-input">Request Date </label>
                                                                     <div class="input-group" id="datepicker2">
                                                                   <input autocomplete="off"  type="text" class="form-control" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" data-date-container="#datepicker2" data-provide="datepicker" data-date-autoclose="true" name="RequestDate" required="">
                                                                   <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                                     </div>
                                                                   </div> 



                                                                     <div class="col-md-4">
                                                                   <div class="mb-3">
                                                                   <label for="basicpill-firstname-input">Loan*</label>
                                                                   <input type="text" class="form-control" name="Amount"  id="Amount"   required="">
                                                                   </div>
                                                                   </div>   
<div class="col-md-4"> 
                                                                      <label for="basicpill-firstname-input">Start Date </label>
                                                                       <div class="input-group" id="datepicker2">

                                                                     <input  autocomplete="off" type="text" name="StartDate" class="form-control" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" data-date-container="#datepicker2" data-provide="datepicker" data-date-autoclose="true"  required="">
                                                                     <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                                       </div>
                                                                     </div>
                                                                   <div class="col-md-4">
                                                                   <div class="mb-3">
                                                                   <label for="basicpill-firstname-input">No of Installments </label>
                                                                   <input type="text" class="form-control" name="NoOfInstallment" id="NoOfInstallment"  required="">
                                                                   </div>
                                                                   </div>



                                                                    <div class="col-md-4">
                                                                   <div class="mb-3">
                                                                   <label for="basicpill-firstname-input">Installment Per Month </label>
                                                                   <input type="text" class="form-control" name="Installment" id="Installment"  readonly="" required="" >
                                                                   </div>
                                                                   </div>

                                                        <div class="col-md-12">
                                                        <div class="mb-3">
                                                        <label for="verticalnav-address-input">Remarks</label>
                                                        <textarea id="verticalnav-address-input" class="form-control" rows="3" name="Remarks" required=""></textarea>
                                                        </div>
                                                        </div>

                                                                     

                                                                  </div>

                                                                   
                                                                   
                                                              
                                                              <div><button type="submit" class="btn btn-success w-md float-right">Save</button>
                                                                   
                                                              </div>
                                                              




                                                              </form>
                                                              </div>
                                                          </div>
                          
                                
                            </div>
                            <!-- end col -->
                         
                         <!-- employee detail side bar -->
                         @include('template.emp_sidebar')

                           
                        </div>
                        <!-- end row -->

                      

                       

                         
                     
                        
                    </div> <!-- container-fluid -->
                </div>
 
<script>
  $(document).ready(function(){
    $('#NoOfInstallment').keyup(calculate);
    
});
function calculate(e)
{
   

  if($('#Amount').val()>0 && $('#NoOfInstallment').val() >0)
  {

    $('#Installment').val($('#Amount').val() / $('#NoOfInstallment').val());
  }
  else
  {
   $('#Installment').val(0); 
  }
}
</script>

  @endsection