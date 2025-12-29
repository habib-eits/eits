<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ 'QUO - '.$estimate[0]->ReferenceNo . ' - '. $party->PartyName  }}</title>
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
            top: -110px;
            left: 0px;
            right: 0px;
            height: auto;
            font-size: 20px !important;
            /*background-color: black;*/
            text-align: center;
            padding-bottom:200px !important;
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

        .table-th {
            border-right: 1px solid black; border-left: 1px solid black; text-align: center; font-size: 11px;
        }
        .table-td{
            border-right: 1px solid black; border-left: 1px solid black; border-bottom: 1px solid black;text-align: center; font-size: 11px; vertical-align: center;     }

        .table-li{
            margin-top:4px;line-height:0.1%; margin-bottom: 4px; margin-left: 0px;list-style-type: none; list-style-position: inside;padding-left: 20px; padding-top: 10px;  vertical-align: center;
        }
        
        
        
     
    </style>


</head>

<body>
       
    <header>      
        <table width="100%" style="border-collapse: collapse" >
            <tr>
                <!-- Left section with logo -->
                <td style="width: 70%; text-align: left; padding-top: 10px;">
                    <img src="{{ asset('assets/images/header1.jpg') }}" width="130%">
                </td>
        
                <!-- Right section with BOQ details -->
                <td style="width: 30%; text-align: right; padding-top: 20px; font-size: 18px; line-height: 1;">
                    <table style="width: 100%;">
                        <tr >
                            <th style="text-align: right;font-size:24px;color: #163263;padding-bottom:10px" colspan="2">Quotation</th>
                        </tr>
                        {{-- <tr>
                            <th style="text-align: left; font-size:14px;color: #325da7;">Estimate No:</th>
                            <td style="text-align: right; font-size:14px;color: #325da7;">{{ $estimate[0]->EstimateNo }}</td>
                        </tr> --}}
                        <tr>
                            <th style="text-align: left;font-size:14px;color: #325da7;">Reference No:</th>
                            <td style="text-align: right;font-size:14px;color: #325da7;">{{ $estimate[0]->ReferenceNo }}</td>
                        </tr>
                        <tr>
                            <th style="text-align: left;font-size:14px;color: #325da7;">Creation Date:</th>
                            <td style="text-align: right;font-size:14px;color: #325da7;">{{ date('d-M-Y', strtotime($estimate[0]->Date)) }}</td>
                        </tr>
                        @if($estimate[0]->ExpiryDate)
                        <tr>
                            <th style="text-align: left;font-size:14px;color: #325da7;">Expiry Date:</th>
                            <td style="text-align: right;font-size:14px;color: #325da7;">{{ date('d-M-Y', strtotime($estimate[0]->ExpiryDate)) }}</td>
                        </tr>
                        @endif
                        
                    </table>
                   
                </td>
            </tr>
        </table>
        <div style="margin-bottom: 30px"></div>
        
      

    </header>

<footer>
        <img src="{{ asset('assets/images/footer1.jpg') }}" width="100%">
</footer>
<br>
<table  width="732px" style="margin-top:30px;" >
    <tr>
        <td width="45%" style="border: 1px solid black;">
            <table width="100%" style="border-collapse: collapse;">
                <tr style="border-bottom: 1px solid black;">
                    <th colspan="2" style="background-color: #c9daf8;text-align: center; font-size: 18px; padding: 10px; back">Service Provider</th>

                </tr>
                <tr>
                    <th style="text-align: left; font-size: 14px; padding: 10px 10px 0px 10px; width: 20%;">Company:</th>
                    <td style="text-align: left; font-size: 14px; padding: 10px 10px 0px 10px; width: 80%;">{{ $company[0]->Name }}</td>
                </tr>
                <tr>
                    <th style="text-align: left; font-size: 14px; padding: 10px 10px 0px 10px; width: 20%;">Address:</th>
                    <td style="text-align: left; font-size: 14px; padding: 10px 10px 0px 10px; width: 80%;">{{ $company[0]->Address }}</td>
                </tr>
                <tr>
                    <th style="text-align: left; font-size: 14px; padding: 10px 10px 0px 10px; width: 20%;">Email:</th>
                    <td style="text-align: left; font-size: 14px; padding: 10px 10px 0px 10px; width: 80%;">{{ $company[0]->Email }}</td>
                </tr>
                <tr>
                    <th style="text-align: left; font-size: 14px; padding: 10px 10px 0px 10px; width: 20%;">Contact:</th>
                    <td style="text-align: left; font-size: 14px; padding: 10px 10px 0px 10px; width: 80%;">{{ $company[0]->Contact }}</td>
                </tr>
                <tr>
                    <th style="text-align: left; font-size: 14px; padding: 10px 10px 0px 10px; width: 20%;">TRN:</th>
                    <td style="text-align: left; font-size: 14px; padding: 10px 10px 10px 10px; width: 80%;">{{ $company[0]->TRN }}</td>
                </tr>
            </table>
        </td>
        <td  width="5%">

        </td>
        <td width="45%" style="border: 1px solid black; ">
            <table width="100%" style="border-collapse: collapse;">
                <tr style="border-bottom: 1px solid black;">
                    <th colspan="2" style="background-color: #c9daf8;text-align: center; font-size: 18px; padding: 10px">Client</th>
                </tr>
                <tr>
                    <th style="text-align: left; font-size: 14px; padding: 10px 10px 0px 10px; width: 20%;">Name: </th>
                    <td style="text-align: left; font-size: 14px; padding: 10px 10px 0px 10px; width: 80%;">{{  $party->PartyName }}</td>
                </tr>
              
                @if($party->Mobile)
                <tr>
                    <th style="text-align: left; font-size: 14px; padding: 10px 10px 0px 10px;width: 20%;">Mobile:</th>
                    <td style="text-align: left; font-size: 14px; padding: 10px 10px 0px 10px;width: 80%;">{{ $party->Mobile}}</td>
                </tr>
                @endif
                @if($party->Phone)
                <tr>
                    <th style="text-align: left; font-size: 14px; padding: 10px 10px 0px 10px;width: 20%;">Phone:</th>
                    <td style="text-align: left; font-size: 14px; padding: 10px 10px 0px 10px;width: 80%;">{{ $party->Phone}}</td>
                </tr>
                @endif
                @if($estimate[0]->state)
                <tr>
                    <th style="text-align: left; font-size: 14px; padding: 10px 10px 0px 10px;width: 20%;">State:</th>
                    <td style="text-align: left; font-size: 14px; padding: 10px 10px 0px 10px;width: 80%;">{{ $estimate[0]->state}}</td>
                </tr>
                @endif
                @if($estimate[0]->location)
                <tr>
                    <th style="text-align: left; font-size: 14px; padding: 10px 10px 0px 10px;width: 20%;">Location:</th>
                    <td style="text-align: left; font-size: 14px; padding: 10px 10px 0px 10px;width: 80%;">{{ $estimate[0]->location}}</td>
                </tr>
                @endif
            </table>
        </td>
    </tr>
</table>




    <footer>
        @if (request()->brancid == 1)
            <img src="{{ asset('assets/images/footer1.jpg') }}" width="100%">
        @else
            <img src="{{ asset('assets/images/footer2.jpg') }}" width="100%">
        @endif


    </footer>


    @php
        $serviceTotal = [];

    @endphp

    @foreach ($services as $service)
        @php

            $estimate_detail = DB::table('v_estimate_detail')
                ->where('EstimateMasterID', request()->id)
                ->where('services_id', $service->id)

                ->get();
            $totalPrice = 0;

        @endphp
        <table id="quotation-table" width="733px" style="border: 1px solid black; border-collapse: collapse;margin-top:20px">
            <thead>
                <tr style="border: 1px solid black; border-collapse: collapse;">
                    <td colspan="4" style="background-color: #c9daf8;text-align:center; padding:10px; border-top:1px solid;border-left:1px solid;border-right:1px solid; margin-top:20px" >
                        <b>{{ strtoupper($service->name) }}</b>
                    </td>
                </tr>
                <tr style="background-color: #f1f1f1; border-bottom: 1px solid;">
                    <th width="5%" class="sno"
                        style="border-right: 1px solid black; border-left: 1px solid black;">S#</th>
                    <th class="product"
                        style=" border-left: 1px solid black; text-align:left; padding-left:10px">
                        Description
                    </th>
                    <th width="10%" class="quantity"
                        style="border-right: 1px solid black; border-left: 0px solid #f1f1f1; text-align: center;">
                    </th>
                    <th width="20%" class="quantity"
                        style="border-right: 1px solid black; border-left: 1px solid black; text-align: center;">Qty
                    </th>
                    {{-- <th width="10%" class="price"
                        style="border-right: 1px solid black; border-left: 1px solid black;text-align: center;">Price
                    </th> --}}
                    {{-- <th width="10%" class="price"
                        style="border-right: 1px solid black; border-left: 1px solid black;text-align: center;">Total
                        Price
                    </th> --}}
                </tr>
            </thead>


            <tbody>

                <?php $no = 0;
                $i = 1; ?>
                @foreach ($estimate_detail as $key => $value)
                    @php

                        $totalPrice = $totalPrice + $value->Total;

                    @endphp

                    <tr valign="top">
                        
                        <td class="table-td" style="vertical-align: center;" >
                            {{ $i++ }}
                        </td>
                       
                        <td class="table-td " style="text-align: left; padding-left:5px;border-right:  0px solid #f1f1f1;" > 
                            {{ $value->Description }}
                        </td>

                        <td class="table-td " style=" border-left:  0px solid #f1f1f1; padding:5px">
                            @if($value->image)
                                <img src="{{ asset('boq-images/'. $value->image) }}" alt="" width="50px" height="35px">
                            @endif

                        </td>
                        <td class="table-td"> 
                            <li class="table-li">@if ($value->LS == 'NO') {{ $value->Qty }} @else  L/S @endif</li>
                        </td>

                        {{-- <td class="table-td"> 
                            
                            <li class="table-li">{{ $value->per_unit_selling_price == 0 ? '-' : number_format($value->per_unit_selling_price, 2) }}</li>
                            
                        </td> --}}
                        {{-- <td class="table-td">
                            <li class="table-li" > {{ number_format($value->item_total, 2) }}</li>
                        </td> --}}
                    </tr>
                @endforeach
                @php
                    $serviceTotal[] = [
                        'name' => strtoupper($service->name),
                        'total_price' => number_format($totalPrice, 2),
                    ];
                @endphp
                <tr style="border-top: 1px solid;background-color: #f1f1f1;">

                    {{-- <td colspan="5" style="text-align: center; border-right:1px solid;"><b>Total</b></td> --}}
                    <td colspan="3" style="text-align: center; border-right:1px solid;"><b>Total</b></td>
                    <td style="text-align: center;"><b>{{ number_format($totalPrice, 2) }}</b></td>

                </tr>
            </tbody>

        </table>
    @endforeach
    <table class="" width="100%" style="float: right; margin-top: 20px;">
       

            @foreach ($serviceTotal as $service)
                <tr class="cart_subtotal">
                    <td class="no-borders"></td>
                    <th class="description"style="font-size:12px"><small>{{ $service['name'] }}</small></th>
                    <td class="price"><span class="totals-price"><span class="amount">
                                {{ $service['total_price'] }}</span></span>
                    </td>
                </tr>
            @endforeach
         
            <div style="margin-top:10px;"></div>
                        <tr class="cart_subtotal">
                            <td class="no-borders"></td>
                            <th  style="border-top:1px solid; padding-top:10px" class="description">Subtotal</th>
                            <td style="border-top:1px solid;padding-top:10px" class="price"><span class="totals-price"><span class="amount">
                                        {{ number_format($estimate[0]->SubTotal, 2) }}</span></span>
                            </td>
                        </tr>
         
               
            @if($estimate[0]->Discount > 0)
                <tr class="order_total">
                    <td class="no-borders"></td>
                    <th class="description">Discount</th>
                    <td class="price"><span class="totals-price"><span
                                class="amount">{{ number_format($estimate[0]->Discount, 2) }}</span></span>
                    </td>
                </tr>
            @endif
            <tr class="order_total">
                <td class="no-borders"></td>
                <th class="description">Total</th>
                <td class="price"><span class="totals-price"><span
                            class="amount">{{ number_format($estimate[0]->Total, 2) }}</span></span>
                </td>
          

            <tr class="order_total">
                <td class="no-borders"></td>
                <th class="description">Tax <span
                        style="font-size: 10px;">({{ substr($estimate[0]->TaxType, 3, 10) }})</span>
                </th>
                <td class="price"><span class="totals-price"><span
                            class="amount">{{ number_format($estimate[0]->Tax, 2) }}</span></span>
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
                <td class="price"><span class="totals-price"><span
                            class="amount">{{ number_format($estimate[0]->GrandTotal, 2) }}</span></span>
                </td>
            </tr>

      
    </table>


    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <p style="page-break-after: always;">&nbsp;</p>
    <div class="customer-notes">
        {!! $estimate[0]->CustomerNotes !!}
    </div>
    <div class="customer-notes">
        {!! $estimate[0]->DescriptionNotes !!}

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
