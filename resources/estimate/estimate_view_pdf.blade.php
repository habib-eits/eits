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
       

        body,
        td,
        th {
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

        /* ol,
        ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        li,
        ul {
            margin-bottom: 0.75em;
        } */

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

<body>
    <header>

        @if(request()->brancid==1)
        <img src="{{asset('assets/images/header1.jpg')}}" width="100%">
        @else
        <img src="{{asset('assets/images/header2.jpg')}}" width="100%">

        @endif



    </header>



    <footer>
        @if(request()->brancid==1)
        <img src="{{asset('assets/images/footer1.jpg')}}" width="100%">
        @else
        <img src="{{asset('assets/images/footer2.jpg')}}" width="100%">

        @endif


    </footer>


    <table class="head container">
        <tr>
            <td colspan="2" class="header">
                <div align="center">
                    <h2><u>QUOTATION</u></h2>
                    <h4><u>TRN#100463436400003</u></h4>
                </div>
            </td>
        </tr>
        <br><br>
    </table>
    <table class="order-data-addresses">
        <tr>
            <td valign="bottom" width="70%">
                <strong>Customer/Party Name:</strong><br>
                <span> {{ $estimate[0]->PartyName }}
                    {{ $estimate[0]->WalkinCustomerName == 1 ? ' -' . $estimate[0]->WalkinCustomerName : ''
                    }}</span><br> {{ ($estimate[0]->TRN!=null) ? 'TRN: '.$estimate[0]->TRN : '' }}<br> {{
                ($estimate[0]->Address!=null) ? 'Address: '.$estimate[0]->Address : '' }}<br /><br /><br />
                <!--    @if ($estimate[0]->PartyID != 1)
                    Contact: {{ $estimate[0]->Phone }}<br />
                    Email: {{ $estimate[0]->Email }}<br />
                    TRN: {{ $estimate[0]->TRN }}<br />
                @endif -->
                <!--   <table align="right" border="1" >
                    <tr class="order-number">
                        <th  width="110" style="background-color: #e9e9e9;"><span>Inquiry Date</span></th>
                        <td width="85">
                            <div align="right">{{ dateformatman($estimate[0]->InquiryDate) }}</div>
                        </td>
                    </tr>
                    <tr class="order-date" >
                        <th style="background-color: #e9e9e9;"><span>Inquiry No</span></th>
                        <td>
                            <div align="right">{{  $estimate[0]->InquiryNo }}</div>
                        </td>
                    </tr>
                    
                    <tr class="payment-method">
                        <th style="background-color: #e9e9e9;"><span>Ref No </span></th>
                        <td>
                            <div align="right">{{ $estimate[0]->ReferenceNo }}</div>
                        </td>
                    </tr>
                </table> -->
                

            </td>
            <td width="30%">
                <table align="right" border="1">
                    <tr class="order-number">
                        <th width="85" style="background-color: #e9e9e9;"><span>Quotation # </span></th>
                        <td width="120">
                            <div align="right">{{ $estimate[0]->EstimateNo }}</div>
                        </td>
                    </tr>
                    <tr class="order-date">
                        <th style="background-color: #e9e9e9;"><span>Date:</span></th>
                        <td>
                            <div align="right">{{ dateformatman($estimate[0]->Date) }}</div>
                        </td>
                    </tr>
                    <tr class="payment-method">
                        <th style="background-color: #e9e9e9;"><span>Expiry Date :</span></th>
                        <td>
                            <div align="right">{{ dateformatman($estimate[0]->ExpiryDate) }}</div>
                        </td>
                    </tr>


                </table>

                <br><br>
            </td>
        </tr>
        {{-- <tr>
            <td colspan="2">
                <div> Our supplies and services are subject to the exclusive application of our general terms and
                    condition of Delivery, Payment and contract supply are as per General Terms and Conditions. <br><br>

                </div>
            </td>
        </tr> --}}

        {{-- <tr>
            <td colspan="2" valign="bottom" class="billing-address address"
                style="border: 1px solid black; padding-left: 5px;"> --}}


        {{-- <tr>
            <td colspan="2" style="padding-top: 15px; line-height: 25px;">
                {!!$estimate[0]->CoveringLetter!!}
                <br><br><br>
            </td>
        </tr> --}}
        {{-- </td> --}}
        {{-- </tr> --}}
    </table>

    @php
        $serviceTotal = [];
     
    @endphp

    @foreach($services as $service)   

    
    @php
      

        $estimate_detail = DB::table('v_estimate_detail')
        ->where('EstimateMasterID',request()->id)
        ->where('services_id',$service->id)

        ->get();
         $totalPrice = 0;
        
    @endphp


<div style="background-color: #c9daf8;text-align:center; padding:10px; border-top:1px solid;border-left:1px solid;border-right:1px solid; margin-top:20px"><b>{{ strtoupper($service->name) }}</b> </div>

    <table width="100%" style=" border: 1px solid black; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f1f1f1; border-bottom: 1px solid;">
                <th width="5%" class="sno" style="border-right: 1px solid black; border-left: 1px solid black;">S#</th>
                <th class="product" style="border-right: 1px solid black; border-left: 1px solid black; text-align:left; padding-left:10px">Description
                </th>
                <th width="20%" class="quantity"
                    style="border-right: 1px solid black; border-left: 1px solid black; text-align: center;">Qty</th>
                <th width="10%" class="price"
                    style="border-right: 1px solid black; border-left: 1px solid black;text-align: center;">Price
                    {{-- <br>(AED)</th> --}}
                    </th>
                <th width="10%" class="price"
                    style="border-right: 1px solid black; border-left: 1px solid black;text-align: center;">Total Price
                    </th>
            </tr>
        </thead>
        
           
        <tbody>
        
            <?php      $no=0; $i=1; ?>
            @foreach ($estimate_detail as $key => $value)

            @php
                
                $totalPrice = $totalPrice + $value->Total;
                

            @endphp

                <tr valign="top" >
                    <td height="13px"  style="text-align:center;border-right: 1px solid black; border-left: 1px solid black;">{{ $i++}}</td>
                    <td   style="border-right: 1px solid black; border-left: 1px solid black;"> 
                     @if($value->ItemName=='Heading')

                     @php
                        echo "<Br>";
                             $lines = explode("\n", $value->Description);

                            // Remove empty lines (optional)
                            $lines = array_filter(array_map('trim', $lines));
                        @endphp
                        

                        @foreach ($lines as $key => $line)
                        @if($key==0)
                           <u> <strong> <li  style="line-height:0.1%; margin-bottom: 0px; margin-left: 0px;list-style-type: none; font-size: 15pt;">{{ $line }}</li></strong></u>
                        @else

                           <strong> <li  style="line-height:0.1%; margin-bottom: 0px; margin-left: 0px; margin-left: 15px;">{{ $line }}</li></strong>
                           @endif
                        @endforeach
                 
              

                     @else
                         

                        <li  style=" margin-top:8px;line-height:0.1%; margin-bottom: 8px; margin-left: 0px;list-style-type: none; list-style-position: inside;padding-left: 20px; padding-top: 10px;">{{ $value->Description }}</li>

                        @endif                        

                    </td>
                    
                     <td  >
                         

                        <li  style=" margin-top:8px;line-height:0.1%; margin-bottom: 8px; margin-left: 0px;list-style-type: none; list-style-position: inside;padding-left: 20px; padding-top: 10px;">{{$value->Qty}}</li>



                        

                    </td>
                     <td  style="border-right: 1px solid black; border-left: 1px solid black; text-align: center">
                     
                         <li  style=" margin-top:8px;line-height:0.1%; margin-bottom: 8px; margin-left: 0px;list-style-type: none; list-style-position: inside;padding-left: 20px; padding-top: 10px;">{{ number_format($value->Rate, 0) }}</li>
                    
                     </td>
                     <td  style="line-height:0.1%;border-right: 1px solid black; border-left: 1px solid black;text-align: center;">
                         
                         <li  style=" margin-top:8px;line-height:0.1%; margin-bottom: 8px; margin-left: 0px;list-style-type: none; list-style-position: inside;padding-left: 20px; padding-top: 10px;">{{ number_format($value->Total, 0) }}</li>
                     
                </td>
                 </tr>
            @endforeach
            @php
              $serviceTotal[] = [
                'name' => strtoupper($service->name),
                'total_price' => number_format($totalPrice,2)
            ];
            @endphp
            <tr style="border-top: 1px solid;background-color: #f1f1f1;" >
               
                <td colspan="4" style="text-align: center; border-right:1px solid;"><b>Total</b></td>
                <td style="text-align: center;" ><b>{{number_format($totalPrice,2)}}</b></td>
              
            </tr>
        </tbody>
  
    </table>
    @endforeach
    <table class="noborder" width="35%" style="float: right; margin-top: 20px;">
        <tfoot>
           
            @foreach($serviceTotal as $service)
                <tr class="cart_subtotal">
                    <td class="no-borders"></td>
                    <th class="description"><small>{{ $service['name'] }}</small></th>
                    <td class="price"><span class="totals-price"><span class="amount">
                        {{ number_format($service['total_price'], 2) }}</span></span>
                    </td>
                </tr>
                
            @endforeach
           <br>
            <tr class="cart_subtotal">
                <td class="no-borders"></td>
                <th  style="border-top:1px solid; "  class="description">Subtotal</th>
                <td  style="border-top:1px solid; "class="price"><span class="totals-price"><span class="amount">
                            {{ number_format($estimate[0]->SubTotal, 2) }}</span></span>
                </td>
            </tr>
            <tr class="order_total">
                <td class="no-borders"></td>
                <th class="description">Dis {{ $estimate[0]->DiscountPer }}%</th>
                <td class="price"><span class="totals-price"><span class="amount">{{
                            number_format($estimate[0]->Discount, 2) }}</span></span>
                </td>
            </tr>
            <tr class="order_total">
                <td class="no-borders"></td>
                <th class="description">Total</th>
                <td class="price"><span class="totals-price"><span class="amount">{{ number_format($estimate[0]->Total,
                            2) }}</span></span>
                </td>
            </tr>
            <!--    <tr class="order_total">
                                <td class="no-borders"></td>
                                <th class="description">Tax @ {{ $estimate[0]->TaxPer }} %</th>
                                <td class="price"><span class="totals-price"><span
                                            class="amount">{{ number_format($estimate[0]->Tax, 2) }}</span></span></td>
                            </tr> -->
            <!--    <tr class="order_total">
                                <td class="no-borders"></td>
                                <th class="description">Shipping</th>
                                <td class="price"><span class="totals-price"><span
                                            class="amount">{{ number_format($estimate[0]->Shipping, 2) }}</span></span>
                                </td>
                            </tr> -->

            <tr class="order_total">
                <td class="no-borders"></td>
                <th class="description">Tax <span style="font-size: 10px;">({{ substr($estimate[0]->TaxType, 3, 10)
                        }})</span>
                </th>
                <td class="price"><span class="totals-price"><span class="amount">{{ number_format($estimate[0]->Tax, 2)
                            }}</span></span>
                </td>
            </tr>


            <!--       <tr class="order_total d-none">
                                <td class="no-borders"></td>
                                <th class="description">Shipping</th>
                                <td class="price"><span class="totals-price"><span
                                            class="amount">{{ number_format($estimate[0]->Shipping, 2) }}</span></span>
                                </td>
                            </tr> -->


            <tr class="order_total">
                <td class="no-borders"></td>
                <th class="description">Grand Total</th>
                <td class="price"><span class="totals-price"><span class="amount">{{
                            number_format($estimate[0]->GrandTotal, 2) }}</span></span>
                </td>
            </tr>

        </tfoot>
    </table>


    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <p style="page-break-after: always;">&nbsp;</p>
    <div class="customer-notes">
        {!!  $estimate[0]->CustomerNotes !!}
    </div>
    <div class="customer-notes">
        {!! $estimate[0]->DescriptionNotes; !!}
       
    </div>
    <div class="customer-notes">
        {!! $estimate[0]->CoveringLetter !!}
       
    </div>

    {{-- <img src="{{URL('/documents/'.$company[0]->Signature)}}" alt="" width="150" style="margin-top: 10%;"> --}}

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