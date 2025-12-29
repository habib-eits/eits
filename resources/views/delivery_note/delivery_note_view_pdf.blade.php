<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Estimate</title>
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
                 /*background-color: black;*/
                text-align: center;
             /*border-bottom: 1px solid black;*/

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


    <table class="head container">
        <tr>
            <td colspan="2" class="header">
                <div align="center">
                    <h2><u>DELIVERY NOTE</u></h2> 
                    
                </div>
            </td>
        </tr>
    </table>
    <table class="order-data-addresses">
        <tr>
            <td valign="bottom" width="70%">
                 <div style="width: 200px;"> <strong>{{ $invoice_master[0]->PartyName }}</strong> <br>
                         {{ $invoice_master[0]->Address }}<br><br>
                        </div>
  <table align="right" border="1" >
                    <tr class="order-number">
                        <th  width="110" style="background-color: #e9e9e9;"><span>Job No</span></th>
                        <td width="85">
                            <div align="right">{{ $invoice_master[0]->JobNo }}</div>
                        </td>
                    </tr>
                 
                  
                    <tr class="payment-method">
                        <th style="background-color: #e9e9e9;"><span>Reference No </span></th>
                        <td>
                            <div align="right">{{ $invoice_master[0]->ReferenceNo }}</div>
                        </td>
                    </tr>
                </table>
                <br />
                
            </td>
            <td  width="30%">

<br><br>
<br>
                <table align="right" border="1">
                    <tr class="order-number">
                        <th width="85" style="background-color: #e9e9e9;"><span>Delivery # </span></th>
                        <td width="120" >
                            <div align="right">{{ $invoice_master[0]->InvoiceNo }}</div>
                        </td>
                    </tr>
                    <tr class="order-date">
                        <th style="background-color: #e9e9e9;"><span>Date:</span></th>
                        <td>
                            <div align="right">{{ dateformatman($invoice_master[0]->Date) }}</div>
                        </td>
                    </tr>
                 
                  
                
                </table>

        <br><br>
            </td>
        </tr>
      
    </table>


<!-- <br>
Dear Madam / Dear Sir,<br>
We are pleased to place order on you for the following materials subject to terms & conditions specified here.
<br>
<br> -->
  



    <table  width="100%" style=" border: 1px solid black; border-collapse: collapse;"  >
        <thead >
            <tr style="background-color: #e9e9e9; border-bottom: 1px solid;">
                <th width="5%" class="sno" style="border-right: 1px solid black; border-left: 1px solid black;">S#</th>
                <th  width="80%"  style="border-right: 1px solid black; border-left: 1px solid black;">Description</th>
             
                 <th width="10%" class="price"  style="border-right: 1px solid black; border-left: 1px solid black;text-align: center;">Qty </th>
            </tr>
        </thead>
        <tbody>

            


 
            @foreach ($invoice_detail as $key => $value)

           

            ?>

                <tr valign="top" >
                    <td height="13px"  style="border-right: 1px solid black; border-left: 1px solid black;">{{++$key}}</td>
                    <td   style="border-right: 1px solid black; border-left: 1px solid black;"> 
                     
                 
               

                    
                         

                       {{ $value->ItemName }}

                                             

                    </td>
                    
                   
                     <td  style="border-right: 1px solid black; border-left: 1px solid black;text-align: center; "> {{   $value->Qty }}</td>
                 </tr>


            @endforeach


    
        </tbody>
      
    </table>

    <br> 
    <br> 
    <br>
    <h2>Drivers Detail's </h2>
    <br>
    <br>
<table width="100%">
    
    <tbody>
        <tr>
            <td width="50%" height="20" >Driver Name : </td>
            <td width="50%" height="20" >{{$invoice_master[0]->DriverName}}</td>
        

             <td width="50%"  height="20">Signature : </td>
            <td width="50%"  height="20" >................................</td>
       
       </tr>

       
            <td width="50%"  height="20" >Driver Contact : </td>
            <td width="50%" height="20" >{{$invoice_master[0]->DriverContact}}</td>
           
       

        
             <td width="50%"  height="20"  >Vehicle No : </td>
            <td width="50%"  height="20" >{{$invoice_master[0]->VehicleNumber}}</td>
       
    </tbody>
</table>
 
           <br><br><br><br><br><br>       
        
      <table width="100%" >
                       
                       <tbody>
                           <tr>
                               <td style="text-align: center;" width="50%">...................................................</td>
                               <td style="text-align: center;" width="50%">...................................................</td>
                           </tr>

                            <tr>
                               <td style="text-align: center;" width="50%">Prepared By</td>
                               <td style="text-align: center;" width="50%">Received By: Signature & Company Stamp</td>
                           </tr>
                       </tbody>
                   </table>             


 <!-- logo and digital signature  -->
 
<!--      <img src="{{URL('/documents/'.$company[0]->Logo)}}" alt="" width="150">
<br>
<br>
  <strong>CEMCON Mechanical Engineering LLC</strong><br>
 <br>
  Ajman Industrial Area 2.<br>
  Telephone: +971 65224700<br>
  Cell: +971 509559135<br>
  Email: bdm@cme.ae, Web: www.cme.ae<br>
  <br>
   -->
 
    <script type="text/php"> 
    
    if (isset($pdf)) { 
     //Shows number center-bottom of A4 page with $x,$y values
        $x = 520;  //X-axis i.e. vertical position 
        $y = 775; //Y-axis horizontal position
        $text = "Page {PAGE_NUM} of {PAGE_COUNT}";  //format of display message
        $font =  $fontMetrics->get_font("helvetica", "normal");
        $size = 9;
        $color = array(0,0,0);
        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;   //  default
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
    }
    
    </script> 

</body>

</html>


         