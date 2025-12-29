<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{$pagetitle}}</title>
    <style type="text/css">


            @page {
                margin-top: 100px;
                margin-bottom: 100px;
                margin-left: 0.8cm;
                margin-right: 0.8cm;
            }

            body,td,th {
  font-size: 11pt;
  font-family: Arial, Helvetica, sans-serif;
}



        

        h1,
        h2,
        h3,
        h4 {
            font-weight: bold;
            margin: 0;
        }

        h1 {
            font-size: 16pt;
            margin: 5mm 0;
        }

        h2 {
            font-size: 14pt;
        }

        h3,
        h4 {
            font-size: 9pt;
        }

        ol,
        ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        li,
        ul {
            margin-bottom: 0.75em;
        }

        p {
            margin: 0;
            padding: 0;
        }

        p+p {
            margin-top: 1.25em;
        }

        a {
            border-bottom: 1px solid;
            text-decoration: none;
        }

        /* Basic Table Styling */
        table {
            border-collapse: collapse;
            border-spacing: 0;
            /*page-break-inside: always;*/
            border: 0;
            margin: 0;
            padding: 0;
        }

        th,
        td {
            vertical-align: top;
            text-align: left;
        }

        table.container {
            width: 100%;
            border: 0;
        }

        tr.no-borders,
        td.no-borders {
            border: 0 !important;
            border-top: 0 !important;
            border-bottom: 0 !important;
            padding: 0 !important;
            width: auto;
        }

        /* Header */
        table.head {
            margin-bottom: 2mm;
        }

        td.header img {
            max-height: 3cm;
            width: auto;
        }

        td.header {
            font-size: 16pt;
            font-weight: 700;
        }

        td.shop-info {
            width: 40%;
        }

        .document-type-label {
            text-transform: uppercase;
        }

        table.order-data-addresses {
            width: 100%;
            margin-bottom: 0.5mm;
        }

        td.order-data {
            width: 30%;
        }

        .invoice .shipping-address {
            width: 30%;
        }

        .packing-slip .billing-address {
            width: 30%;
        }

        td.order-data table th {
            font-weight: normal;
            padding-right: 2mm;
        }

        table.order-details {
            width: 100%;
            margin-bottom: 8mm;
        }

        .quantity,
        .price {
            width: 10%;
        }

        .product {
            width: 40%;
        }

        .sno {
            width: 3%;
        }

        .order-details tr {
           /* page-break-inside: always;
            page-break-after: auto;*/
        }

        .order-details td,
        .order-details th {
            border-bottom: 1px #ccc solid;
            border-top: 1px #ccc solid;
            padding: 0.375em;
        }

        .order-details th {
            font-weight: bold;
            text-align: left;
        }

        .order-details thead th {
            color: black;
            background-color: #b8b8b8;
            border-color: #b8b8b8;

        }

        .order-details tr.bundled-item td.product {
            padding-left: 5mm;
        }

        .order-details tr.product-bundle td,
        .order-details tr.bundled-item td {
            border: 0;
        }

        dl {
            margin: 4px 0;
        }

        dt,
        dd,
        dd p {
            display: inline;
            font-size: 7pt;
            line-height: 7pt;
        }

        dd {
            margin-left: 5px;
        }

        dd:after {
            content: "\A";
            white-space: pre;
        }

        .customer-notes {
            margin-top: 5mm;
        }

        table.totals {
            width: 100%;
            margin-top: 5mm;
        }

        table.totals th,
        table.totals td {
            border: 0;
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }

        table.totals th.description,
        table.totals td.price {
            width: 50%;
        }

        table.totals tr:last-child td,
        table.totals tr:last-child th {
            border-top: 2px solid #000;
            border-bottom: 2px solid #000;
            font-weight: bold;
        }

        table.totals tr.payment_method {
            display: none;
        }

       

  
            header {
                position: fixed;
                top: -105px;
                left: 0px;
                right: 0px;
                height: auto;
                font-size: 20px !important;
                 text-align: center;
 
            }

            footer {
                position: fixed; 
                bottom: -100px; 
                left: 0px; 
                right: 0px;
                height: auto; 
                font-size: 11px !important;
                
                border-top: 1px solid black;
                
                text-align: center;
                padding-top: 0px;

            }



        

 
    </style>
 

</head>
<body onload="window.print();">

     <header >

            @if(request()->BranchID==1)
            <img src="{{asset('assets/images/header1.jpg')}}" width="100%" >
            @else
            <img src="{{asset('assets/images/header2.jpg')}}" width="100%" >

            @endif

            
         
        </header>
   
 
  
    <footer> 
          @if(request()->BranchID==1)
            <img src="{{asset('assets/images/footer1.jpg')}}" width="100%" >
            @else
            <img src="{{asset('assets/images/footer2.jpg')}}" width="100%" >

            @endif


        </footer>



  <div class="main-content">

                <div class="page-content">
                    <div class="container">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                  

                                    <div class="page-title-right "><div class="page-title-right text-danger"><div align="center">
                                        <br>
                                        <br>
                                        <br>
                    <table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
                                           
                                              <tr>
                                                <td colspan="2">&nbsp;</td>
                                              </tr>
                                              <tr>
                                                <td colspan="2"><div align="center">                                                  <span class="mb-sm-0 font-size-18 style1">Salary Detail</span></div></td>
                                              </tr>
                                              <tr>
                                                <td>Salary for the [{{session::get('MonthName')}}] </td>
                                                <td><div align="right">Branch Name: {{$branch[0]->BranchName}} <br> Print Date: {{date('d-m-Y G:i:s')}}</div></td>
                                              </tr>
                                            </table>
                                          </div>
                                        </div>
                                  </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-md-12">
  
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4"> </h4>


<div class="row">
                                         
                                        </div>
                                      
                                        <table   style="border-collapse: collapse; width: 100%" border="1">
                                            <thead>
                                             
                                                <tr style="background-color: #eee;">
                                                    <th scope="col">S.No</th>
                                                     <th scope="col">Employee</th>
                                                    <th scope="col">Job Title </th>
                                                     <th scope="col">Days Present</th>
                                                    
                                                    <th scope="col">PerDay</th>
                                                    
                                                     <th scope="col">Basic</th>
                                                     <th scope="col">Adv Loan</th>
                                                    
                                                    <th scope="col">Leave Ded</th>
                                                    <th scope="col">Total Ded</th>
                                                    
                                                    <th scope="col">Grand Salary</th>
                                                    <th scope="col">Net Salary</th>
                                                     
                                                   </tr>


                                             

                                          
                                             </thead>
        
        
                                            <tbody>

<?php 

$BasicSalary=0;
$HRA=0;
$Transport=0;
$OtherAllowance=0;
$AdvanceLoan=0;
$LeaveDeduction=0;
$GrandSalary=0;
$NetSalary=0;
$TotalDeduction=0;

 ?>

                                            
                                             
                                              <?php foreach ($salary as $key => $value): ?>

<?php 

$BasicSalary=$BasicSalary+$value->BasicSalary;
$HRA=$HRA+$value->HRA;
$Transport=$Transport+$value->Transport;
$OtherAllowance=$OtherAllowance+$value->OtherAllowance;
$AdvanceLoan=$AdvanceLoan+$value->AdvanceLoan;
$LeaveDeduction=$LeaveDeduction+$value->LeaveDeduction;
$TotalDeduction=$TotalDeduction+$value->TotalDeduction;
$GrandSalary=$GrandSalary+$value->GrandSalary;
$NetSalary=$NetSalary+$value->NetSalary;



 ?>


                                            <tr>
                                                
                                              
                                                <td> {{$key+1}} </td>
                                                 <td> {{$value->EmployeeName}} </td>
                                                 <td> {{$value->JobTitle}} </td>
                                                  <td  style="text-align: center;"> {{$value->DaysPresent}} </td>
                                                 
                                                 <td style="text-align: center;"> {{number_format($value->PerDay)}} </td>
                                                 <td style="text-align: center;"> {{number_format($value->BasicSalary)}} </td>
                                                  <td style="text-align: center;"> {{number_format($value->AdvanceLoan)}} </td>
                                                 <td style="text-align: center;"> {{number_format($value->LeaveDeduction)}} </td>
                                                 <td style="text-align: center;"> {{number_format($value->GrandSalary)}} </td>
                                                 <td style="text-align: center;"> {{number_format($value->NetSalary)}} </td>
                                                 <td style="text-align: center;"> {{number_format($value->NetSalary)}} </td>

                                                 
                                                
                                                 
                                            </tr>
                                            <?php endforeach ?>

                                             <tr class="bg-light ">
                                                    <td colspan="2" style="text-align: center;"><strong>Grand Total  </strong></td>
                                                
                                                    
                                                    <th style="text-align: center;">{{number_format($BasicSalary)}}</th>
                                                    <th style="text-align: center;">{{number_format($HRA)}}</th>
                                                    <th style="text-align: center;">{{number_format($Transport)}}</th>
                                                    <th style="text-align: center;">{{number_format($OtherAllowance)}}</th>
                                                    <th style="text-align: center;">{{number_format($AdvanceLoan)}}</th>
                                                    
                                                    <th style="text-align: center;">{{number_format($LeaveDeduction)}}</th>
                                                    <th style="text-align: center;">{{number_format($TotalDeduction)}}</th>
                                                    
                                                    <th style="text-align: center;">{{number_format($GrandSalary)}}</th>
                                                    <th style="text-align: center;">{{number_format($NetSalary)}}</th>
                                                     
                                                   </tr>

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

</body>
</html>