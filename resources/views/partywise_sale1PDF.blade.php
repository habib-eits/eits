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


   <?php 

$party = DB::table('party')->where('PartyID',request()->PartyID)->first();

 
    ?>  
     

<p>To {{$party->PartyName}}<br>
{{$party->Address}}</p>
 

  
  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin: 35px 0px 35px 0px;">
    
    <tr>
      <td colspan="2"><div align="center"><strong><u>Statement of Account</u> </strong></div></td>
    </tr>
     <tr>
    <td width="50%"> </td>
    <td width="50%" style="text-align: right;">Dated : {{date('d-m-Y')}}<Br>From {{request()->StartDate}} To {{request()->EndDate}}</td>
  </tr>
  </table>

  <table width="100%" border="1" cellspacing="0" cellpadding="3" style="border-collapse:collapse;"  style="margin: 35px 0px 35px 0px;">
    <thead style="display: table-header-group;">
    <tr>
     <td width="5%" bgcolor="#CCCCCC"><div align="center"><strong>S#</strong></div></td>
      <td width="30%" bgcolor="#CCCCCC"><div align="center"><strong>PARTICULAR#</strong></div></td>
      <td width="20%" bgcolor="#CCCCCC"><div align="center"><strong>LPO</strong></div></td>
      <td width="20%" bgcolor="#CCCCCC"><div align="center"><strong>DEBIT</strong></div></td>
      <td width="20%" bgcolor="#CCCCCC"><div align="center"><strong> VAT 5%</strong></div></td>
      <td width="20%" bgcolor="#CCCCCC"><div align="center"><strong>BALANCE </strong></div></td>
     </tr>
  </thead>
  <?php 

$DiscountAmount=0;
$Tax=0;
$Shipping=0;
$GrandTotal=0;

 ?>
   @foreach ($party_wise as $key => $value)
     <?php 

$DiscountAmount  =  $DiscountAmount + $value->DiscountAmount;
$Tax  = $Tax+ $value->Tax;
$Shipping  = $Shipping +  $value->Shipping ;
$GrandTotal  = $GrandTotal+ $value->GrandTotal;

 ?> 
    
    <tr>
      <td><div align="center">{{$key+1}}.</div></td>
       <td><div align="center">{{$value->InvoiceNo}}</div></td>
       <td><div align="center">{{$value->PONo}}</div></td>
       <td><div align="center">{{number_format($value->Tax,2)}}</div></td>
      <td><div align="center">{{number_format($value->Shipping,2)}}</div></td>
      <td><div align="center">{{number_format($value->GrandTotal,2)}}</div></td>
    </tr>
@endforeach
 <tr>
     
       <td colspan="5"><div align="center"><STRONG>TOTAL</STRONG></div></td>
       <td><div align="center"><strong>{{number_format($GrandTotal,2)}}</strong></div></td>
        
    </tr>
  </table>
  <p style="font-weight: bolder;">In words: AED . {{convert_number_to_words($GrandTotal)}} only</p>

 
  
<br>
<br>
<br>
            


 

 
                    

 
 
 
     @if(request()->BranchID==1)
     <strong>Qaiser Shahzad’</strong><br>
            <img src="{{asset('assets/images/logo-1.jpg')}}" >
 
<br>
  <strong>CEMCON Middle East LLC </strong><br>
 
  Dubai, United Arab Emirates.<br>
  Telephone: +971 43303554<br>
  Cell: +971 52 7272 172<br>
  Email: info@cme.ae, Web: www.cme.ae<br>
  <br>
            @else
            <strong>Qaiser Shahzad’</strong><br>
            <img src="{{asset('assets/images/logo-2.jpg')}}" >
 
<br>
  <strong>CEMCON Mechanical Engineering LLC </strong><br>
 
  Ajman Industrial Area 2.<Br>
United Arab Emirates 
.<br>
  Telephone: +971 6 5224700<br>
  Cell: +971 52 727 2172<br>
  Email: info@cme.ae, Web: www.cme.ae<br>
  <br>

            @endif

  
 

</body>

</html>


         