@extends('template.tmp')

@section('title', $pagetitle)
 

@section('content')

<style>
    div.scroll
{
 height:auto;
 /*height:500px;*/
overflow-x:scroll;
white-space: nowrap;
}
</style>



 <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Payroll</h4>

                                    <div class="page-title-right">
                                        <div class="page-title-right  ">
                                        <h5>   {{ Request::get('MonthName') }}</h5>
                                         <!-- button will appear here -->
                                        <?php 

list($month, $year) = explode('-', Request::get('MonthName'));

 $nmonth = date('m',strtotime($month));
 

 ?>  

                                    </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <form action="{{URL('/SaveSalary')}}" method="post"> {{csrf_field()}} 

                             <input type="hidden" name="BranchID" value="{{request()->get('BranchID')}}">
                             
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body border-success border-top border-3 rounded-top">
                                        

                                      <div class="scroll">
                                          
                                           <table class="table table-sm align-middle table-nowrap mb-0">
                                                <thead>
                                                        <tr class="bg-light ">
                                                    <th scope="col">S.No</th>
                                                    <th scope="col">Employee ID</th>
                                                    <th scope="col">Employee Name</th>
                                                    <th scope="col">Job Title </th>
                                                    <th scope="col">Salary Type</th>
                                                    <th scope="col">Days Present</th>
                                                     <th scope="col">PerDay</th>
                                                    
                                                    <th scope="col">Basic</th>
                                                    <?php for($i=1;$i<=31 ;$i++) { ?>
                                                    <th scope="col">{{$i}}</th>
                                                <?php } ?>
                                                     <th scope="col">Adv Loan</th>
                                                    
                                                    <th scope="col">Leave Ded</th>
                                                    <th scope="col">Total Ded</th>
                                                    
                                                    <th scope="col">Grand Salary</th>
                                                    <th scope="col">Net Salary</th>
                                                     
                                                   </tr>
                                                </thead>
                                                
<?php  $Basic=0;       $HRA=0;      $Transport=0;   $OtherAllowance=0;  $Increment=0;    ?>
                                                   
                                                    @foreach ($employee as $key => $value)
    
                                                <?php 

                                            $no=$key+1;
                                          // $SalaryIn=DB::table('v_union_salary')->where('EmployeeID','=',$value->EmployeeID)->where('MonthName',request()->get('MonthName'))->get();  


$leave = DB::table('leave')->where('EmployeeID',$value->EmployeeID)->get(); 



$salary_summary = DB::table('emp_salary')
// ->select(DB::raw('sum(Amount) as TotalSalary'))
->where('EmployeeID',$value->EmployeeID)
->where('AllowanceListID',$value->AllowanceListID)
->where('Active','Yes')  
->get();

$salary = DB::table('v_emp_salary_structure')
->where('EmployeeID',$value->EmployeeID)
// ->where('Active','Yes')  
->get();          


$loan = DB::table('loan_deduction')
->where(DB::raw('DATE_FORMAT(LoanDeductionDate, "%b-%Y")'), Request::get('MonthName'))
->where('EmployeeID',$value->EmployeeID)
->get();


$total_present = DB::table('attendance')->select(DB::raw('sum(Attendance) as Attendance'))
->where(DB::raw('DATE_FORMAT(Date, "%b-%Y")'), Request::get('MonthName'))
->where('EmployeeID',$value->EmployeeID)
->where('SalaryTypeID',$value->AllowanceListID)

->first();




 

          if(count($salary)>0)
             {      
           
                 
                 
                    $Basic = $salary[0]->Basic;
                  
                    $HRA = $salary[0]->HRA;
                 
                    $Transport = $salary[0]->Transport;
           
                   $OtherAllowance = $salary[0]->OtherAllowance;
      

         }
         
         else
         {
              $Basic=0;       $HRA=0;      $Transport=0;   $OtherAllowance=0;  $Increment=0;   
         }
         
 

        // per day

        $GrandSalary = ($salary_summary[0]->Amount==null) ? 0 : $salary_summary[0]->Amount;
        $leaves = (count($leave)>0) ? count($leave) : 0;
        $NoOfDays=\Carbon\Carbon::now()->month($nmonth)->daysInMonth;

        $perDay =  ($value->AllowanceListID==1) ? round($salary_summary[0]->Amount  / 30) : $salary_summary[0]->Amount ;

        $LeaveDeduction = round($perDay,0) *  count($leave);
        $advance = (count($loan)>0) ? $loan[0]->Amount : 0;

        $total_ded = $LeaveDeduction+$advance;

        $present = ($total_present->Attendance) ? $total_present->Attendance : 0;

        $salary_att = $perDay * $present;
        // echo  $salary_att;

        $net =  $salary_att - $total_ded;
         ?>
                                      
<input type="hidden" name="EmployeeName[]" value="{{$value->FullName}}">
<input type="hidden" name="JobTitleName[]" value="{{$value->JobTitleName}}">
<input type="hidden" name="SalaryTypeID[]" value="{{$value->SalaryTypeID}}">
<input type="hidden" name="StaffType" value=" ">

         <tr>
         <td class="col-md-1">{{$key+1}}     </td>
        <td class="col-md-1"> <input type="hidden" name="EmployeeID[]" value="{{$value->EmployeeID}}">
        <input type="hidden" name="MonthName[]" value="{{request()->get('MonthName')}}">
                {{$value->EmployeeID}} <span class="badge rounded-pill badge-soft-primary font-size-11 me-2 ml-5">   </span></td>
        <td class="col-md-1">{{$value->FullName}} </td>
        <td class="col-md-1">{{$value->JobTitleName}}</td>
        <td class="col-md-1">{{$value->AllowanceTitle}}-{{$value->AllowanceListID}}</td>
        <td ><input type="text" size="2" name="DaysPresent[]" id="DaysPresent_{{$no}}" value="{{($total_present->Attendance) ? $total_present->Attendance : 0}}" class="changesNo"></td>
         <td ><input type="text" size="4" name="PerDay[]" id="PerDay_{{$no}}" value="{{round($perDay,2)}}" class="changesNo"></td>
        <td ><input type="text" size="4" name="BasicSalary[]" id="BasicSalary_{{$no}}" value="{{ $GrandSalary }}" class="changesNo"></td>



  <?php 
$att = 0;
  for($i=1;$i<=31;$i++) { 

$attendance = DB::table('attendance')->where('EmployeeID',$value->EmployeeID)
->where(DB::raw('DATE_FORMAT(Date, "%d-%b-%Y")'), $i.'-'.Request::get('MonthName'))
->where('SalaryTypeID',$value->SalaryTypeID)
->get(); 



if($value->SalaryTypeID==1)
{
$att = (count($attendance)>0) ? $attendance[0]->Attendance:'';
}elseif($value->SalaryTypeID==2)
{
$att = (count($attendance)>0) ? $attendance[0]->OverTime:'';
}elseif($value->SalaryTypeID==3)
{
$att = (count($attendance)>0) ? $attendance[0]->PerHour:'';

}else
{
$att = (count($attendance)>0) ? $attendance[0]->PerDay:'';

}




    ?>
    <th scope="col"><input type="text" name="Att[]" id="Att_{{$no}}_{{$i}}" style="width: 25px;" value="{{$att}}"></th>
     <?php } ?>
         <td ><input type="text" size="4" name="AdvanceLoan[]" id="AdvanceLoan_{{$no}}" value="{{ $advance}}"   class="changesNo AdvanceLoan"></td>
        <td ><input type="text" size="4" name="LeaveDeduction[]" id="LeaveDeduction_{{$no}}" value="{{$LeaveDeduction}}"  class="changesNo LeaveDeduction"></td>
        <td ><input type="text" size="4" name="TotalDeduction[]" id="TotalDeduction_{{$no}}" value="{{ $total_ded}}"  class="changesNo TotalDeduction"></td>
        <td ><input type="text" size="4" name="GrandSalary[]" id="GrandSalary_{{$no}}" value="{{$salary_att}}"  class="changesNo GrandSalary"></td>
        <td ><input type="text" size="4" name="NetSalary[]" id="NetSalary_{{$no}}" value="{{$net}}"  class="changesNo NetSalary"></td>

                                                        <td >




                                                          </td>
                                                     </tr>
                                                    @endforeach
                                                        
                                                
<!-- <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
       
        <td>Total</td>
        <td><input  size="4" type="text" id="TotalAdvanceLoan" ></td>
        <td><input  size="4" type="text" id="TotalLeaveDeduction"></td>
        <td><input  size="4" type="text" id="TotalTotalDeduction"></td>
        <td><input  size="4" type="text" id="TotalGrandSalary"></td>
        
        <td><input  size="4" type="text"  id="TotalNetSalary"></td>
</tr> -->
                                                                                                       
                                                     

                                                   
                                                </tbody>
                                            </table> 
                                      </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->

                           
                        </div>

                        <div><button type="submit" class="btn btn-success w-md float-right">Save Salary</button>
                             <a href="{{URL('/Salary')}}" class="btn btn-secondary w-md float-right">Cancel</a>
                        </div>
                        
</form>
                        <!-- end row -->

                       
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script>


$(document).on('blur ', '.changesNo', function() {

      singlerowcalculation($(this).attr('id'));
 
    });


function singlerowcalculation(idd)
{   
    
       id_arr = idd;
        id = id_arr.split("_");
 
        DaysPresent = $('#DaysPresent_' + id[1]).val();
        // LWPay = $('#LWPay_' + id[1]).val();
        LWPay = 0;
        PerDay = $('#PerDay_' + id[1]).val();
        BasicSalary = $('#BasicSalary_' + id[1]).val();
        HRA = $('#HRA_' + id[1]).val();
        Transport = $('#Transport_' + id[1]).val();
        OtherAllowance = $('#OtherAllowance_' + id[1]).val();
        AdvanceLoan = $('#AdvanceLoan_' + id[1]).val();

        LeaveDeduction = LWPay * PerDay;
        
        GrandSalary = PerDay * DaysPresent;

        $('#GrandSalary_' + id[1]).val(GrandSalary);
         
        
        TotalDeduction = parseFloat(AdvanceLoan)+parseFloat(LeaveDeduction);
        
        $('#LeaveDeduction_'+id[1]).val(LeaveDeduction);

        $('#TotalDeduction_' + id[1]).val(TotalDeduction);
        
$('#NetSalary_' + id[1]).val( parseFloat(GrandSalary) - parseFloat(TotalDeduction)  );



TotalCalculation();

}



function TotalCalculation(){

        TotalAdvanceLoan = 0;
$('.AdvanceLoan').each(function() {
        if ($(this).val() != '') TotalAdvanceLoan += parseFloat($(this).val());
        });

$('#TotalAdvanceLoan').val(TotalAdvanceLoan);


TotalLeaveDeduction = 0;
$('.LeaveDeduction').each(function() {
        if ($(this).val() != '') TotalLeaveDeduction += parseFloat($(this).val());
        });

$('#TotalLeaveDeduction').val(TotalLeaveDeduction);


TotalTotalDeduction = 0;
$('.TotalDeduction').each(function() {
        if ($(this).val() != '') TotalTotalDeduction += parseFloat($(this).val());
        });

$('#TotalTotalDeduction').val(TotalTotalDeduction);

TotalGrandSalary = 0;
$('.GrandSalary').each(function() {
        if ($(this).val() != '') TotalGrandSalary += parseFloat($(this).val());
        });

$('#TotalGrandSalary').val(TotalGrandSalary);

 TotalNetSalary = 0;
$('.NetSalary').each(function() {
        if ($(this).val() != '') TotalNetSalary += parseFloat($(this).val());
        });

$('#TotalNetSalary').val(TotalNetSalary);
}



$( document ).ready(function() {
   TotalCalculation();
});
</script>
                         
                     
                        
                    </div> <!-- container-fluid -->
                </div>

                
 <script>
  $( document ).ready(function() {
  $('body').addClass('sidebar-enable vertical-collpsed')
});
 </script>

  @endsection