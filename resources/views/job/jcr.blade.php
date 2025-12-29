<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{$pagetitle}}</title>
    <style type="text/css">


            @page {
                margin-top: 100px;
                margin-bottom: 100px;
                margin-left: 0.4cm;
                margin-right: 0.4cm;
            }

            body,td,th {
  font-size: 8pt;
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
                 background-color: black;
                text-align: center;
             border-bottom: 1px solid black;

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

<body  >
  <header >

            @if(request()->brancid==1)
            <img src="{{asset('assets/images/header1.jpg')}}" width="100%" >
            @else
            <img src="{{asset('assets/images/header2.jpg')}}" width="100%" >

            @endif

            
         
        </header>
   
 
  
    <footer> 
          @if(request()->brancid==1)
            <img src="{{asset('assets/images/footer1.jpg')}}" width="100%" >
            @else
            <img src="{{asset('assets/images/footer2.jpg')}}" width="100%" >

            @endif


        </footer>


     
     


  


 
</style>


<?php
// Define two dates as DateTime objects
$date1 = new DateTime($job->JobDate);
$date2 = new DateTime($job->JobDueDate);
$interval = $date1->diff($date2);


$staff = DB::table('v_job_employee_stats')->first();


?>

<table width="800" border="1" style="border-collapse:collapse; margin-top: 50px;">
  <tr>
    <th width="500" colspan="5" rowspan="3" scope="col">JOB COMPLETION REPORT</th>
    <th width="50" ><div align="left">JCR No.</div></th>
    <th width="12" colspan="4" scope="col"><div align="left">{{$job->JobNo}}</div></th>
    <th width="12" colspan="3" scope="col"><div align="left">JCR Date</div></th>
    <th width="50" scope="col"><div align="left">{{$job->JobDate}}</div></th>
  </tr>
  <tr>
    <td width="50"><div align="left"><strong>Client</strong></div></td>
    <td width="50" colspan="4"><div align="left">{{$job->PartyName}}</div></td>
    <td width="50" colspan="3"><div align="left"><strong>Client's No</strong></div></td>
    <td width="50"><div align="left">600102</div></td>
  </tr>
  <tr>
    <td width="12%"><div align="left"><strong>Client's Ref. No</strong></div></td>
    <td width="12%" colspan="4"><div align="left">RA/RAE/3219006662</div></td>
    <td width="12%" colspan="3"><div align="left"><strong>Our Ref. No.</strong></div></td>
    <td width="12%"><div align="left">CME-70609</div></td>
  </tr>
  <tr >
    <td rowspan="3" style="vertical-align: middle; text-align: center;" width="20">S#</td>
    <td colspan="2" style="vertical-align: middle; text-align: center;" width="150"><strong>DATE</strong></td>
    <td rowspan="3" style="vertical-align: middle; text-align: center;" width="170"><strong>JOB DESCRIPTION</strong> </td>
    <td rowspan="3" style="vertical-align: middle; text-align: center;" width="150"><strong>DETAILS OF EXECUTED JOB</strong> </td>
    <td rowspan="3" style="vertical-align: middle; text-align: center;"><strong>DURATION</strong></td>
    <td colspan="7" style="text-align: center; font-weight: bold;"><strong>MANPOWER</strong> </td>
    <td rowspan="2" style="vertical-align: middle; text-align: center;"><strong>STATUS</strong></td>
  </tr>
  <tr style="height:90px;">
    <td width="45" rowspan="2" style="vertical-align: middle; text-align: center;"><strong>FROM</strong></td>
    <td width="45" rowspan="2" style="vertical-align: middle; text-align: center;"><strong>TO</strong></td>
    <td rowspan="2" width="30" >  <img src="{{asset('assets/images/eng.jpg')}}" alt="" width="35%"></td>
    <td rowspan="2" ><img src="{{asset('assets/images/supervisor.jpg')}}" alt="" width="35%">  </td>
    <td rowspan="2" ><img src="{{asset('assets/images/foreman.jpg')}}" alt="" width="35%">  </td>
    <td rowspan="2" ><img src="{{asset('assets/images/fitter.jpg')}}" alt="" width="35%">  </td>
    <td rowspan="2" ><img src="{{asset('assets/images/fabricator.jpg')}}" alt="" width="35%">  </td>
    <td rowspan="2" ><img src="{{asset('assets/images/welder.jpg')}}" alt="" width="35%">  </td>
    <td rowspan="2" ><img src="{{asset('assets/images/helper.jpg')}}" alt="" width="35%">  </td>
   </tr>
  <tr style="vertical-align: middle;">
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>1</td>
    <td>{{dateformatman($job->JobDate)}}</td>
    <td>{{dateformatman($job->JobDueDate)}}</td>
    <td>{!!$job->JobDetail!!}</td>
    <td>&nbsp;</td>
    <td style="text-align: center" >{{$interval->d}} days</td>
    <td >-</td>
    <td style="text-align: center">{{($staff->Supervisor) ? $staff->Supervisor : ''}}</td>

    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td ></td>
    <td style="text-align: center">-</td>
    <td style="text-align: center">{{($staff->Fitter) ? $staff->Fitter : ''}}</td>
    <td >&nbsp;</td>
  </tr>
 <tr >
    <td height="65" colspan="5" rowspan="2" >Remarks:</td>
    <td colspan="5" style="font-weight: bolder; text-align: center">CEMCON Technical Services LLC</td>
    <td colspan="4" style="font-weight: bolder; text-align: center">Client's Representative</td>
  </tr>
  <tr>
    <td colspan="5" style="text-align: center">Name / Signature / Stamp</td>
    <td colspan="4" style=" text-align: center">Name / Signature / Stamp</td>
  </tr>
</table>


  

            


 

 
                    

 
 


  
 

</body>

</html>


         