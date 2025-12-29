 
@extends('template.tmp')

@section('title', $pagetitle)
 

@section('content')



<div class="main-content">

 <div class="page-content">
 <div class="container-fluid">
  <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-print-block d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Sale Invoice</h4>
                                        
 
                                </div>
                            </div>
                        </div>
 

            
            
  <div class="card">
      <div class="card-body">
    
 <table class="head container">
        <tr>
            <td colspan="2" class="header">
                <div align="center">
                    <h2><u>TAX INVOICE</u></h2>
                    
                </div>
            </td>
        </tr>
    </table>






    <table width="100%" class="table " >
        <tr>
            <td valign="bottom" width="50%">
                 <div style="width: 200px;"> <strong>{{ $invoice_master[0]->PartyName }}</strong> <br>
                         {{ $invoice_master[0]->Address }}<br><br>
                        </div>
  <table align="left" border="0" >
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
                <table align="right"  class="table table-bordered table-sm">
                    <tr class="order-number">
                        <th width="85" style="background-color: #e9e9e9;"><span>Invoice # </span></th>
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
                 
                  
                        <tr class="payment-method">
                        <th style="background-color: #e9e9e9;"><span>Contact: </span></th>
                        <td>
                            <div align="right">Qaiser Shahzad</div>
                        </td>
                    </tr>   
                     <tr class="payment-method">
                        <th style="background-color: #e9e9e9;"><span>Email: </span></th>
                        <td>
                            <div align="right">qaiser@cme.ae</div>
                        </td>
                    </tr>
                </table>

        <br><br>
            </td>
        </tr>
      
    </table>


  <table  width="100%" style=" border: 1px solid black; border-collapse: collapse;"  >
        <thead >
            <tr style="background-color: #e9e9e9; border-bottom: 1px solid;">
                <th width="5%" class="sno" style="border-right: 1px solid black; border-left: 1px solid black;">S#</th>
                <th  class="product"  style="border-right: 1px solid black; border-left: 1px solid black;">Description</th>
                <th width="20%" class="quantity"  style="border-right: 1px solid black; border-left: 1px solid black; text-align: center;">Qty</th>
                <th width="10%" class="price"  style="border-right: 1px solid black; border-left: 1px solid black;text-align: center;">Unit Price <br>(AED)</th>
                 <th width="10%" class="price"  style="border-right: 1px solid black; border-left: 1px solid black;text-align: center;">Total Price <br> (AED)</th>
            </tr>
        </thead>
        <tbody>

            


<?php      $no=0; ?>
            @foreach ($invoice_detail as $key => $value)

            <?php if($value->ItemName=='Heading')

            $no=$no+1;

            ?>

                <tr valign="top" >
                    <td height="13px"  style="border-right: 1px solid black; border-left: 1px solid black;"></td>
                    <td   style="border-right: 1px solid black; border-left: 1px solid black; padding-top: 25px; padding-bottom: 25px;"> 
                     @if($value->ItemName=='Heading')

                     @php
                        echo "<Br>";
                             $lines = explode("\n", $value->Description);

                            // Remove empty lines (optional)
                            $lines = array_filter(array_map('trim', $lines));
                        @endphp
                        

                        @foreach ($lines as $line)
                           <u> <strong> <li  style="line-height:0.1%; margin-bottom: 0px; margin-left: 0px;list-style-type: none; ">{{ $line }}</li></strong></u>
                        @endforeach
                 
               <div style="padding-top: 25px;">
                 ----
               </div>

                     @else
                         

                        <li  style="line-height:0.1%; margin-bottom: 0px; margin-left: 0px;list-style-type: afar; list-style-position: inside;padding-left: 20px;">{{ $value->ItemName }}</li>

                        @endif                        

                    </td>
                    
                     <td  style="border-right: 1px solid black; border-left: 1px solid black; text-align: center; line-height:0.1%; padding-top: 25px; padding-bottom: 25px;" >@if($value->ItemName!='Heading') 

                        {{   ($value->LS == 'NO') ? number_format($value->Qty, 0)  : 'L/S' }}

                        @endif

                    </td>
                     <td  style="line-height:0.1%;border-right: 1px solid black; border-left: 1px solid black; text-align: center; padding-top: 25px; padding-bottom: 25px;">
                    @if($value->ItemName!='Heading')
                        {{  number_format($value->Rate)}}
                    @endif </td>
                     <td  style="line-height:0.1%;border-right: 1px solid black; border-left: 1px solid black;text-align: center; padding-top: 25px; padding-bottom: 25px;">@if($value->ItemName!='Heading')
                        {{  number_format($value->Total)}}
                    @endif</td>
                 </tr>


            @endforeach


    
        </tbody>
        <tfoot>
            <tr class="no-borders" style="height:30px" >
                <td colspan="5" style="border: 1px solid black;">
                     <div style="padding-top: 10px;"><strong>In words </strong>:
                        <em>{{ ucwords(convert_number_to_words($invoice_master[0]->GrandTotal)) }} only/-</em></div>


                   
                    
                </td>
                
            </tr>
        </tfoot>
    </table>

     <table width="100%">
         
         
         <tbody>
             <tr>
                 <td width="50%">  <div class="customer-notes"><strong><u><h2>GENERAL TERM & CONDITIONS:</h2></u></strong><br><br>
                       <?php echo $invoice_master[0]->CustomerNotes; ?>
                    </div></td>
                 <td> <table  class="table table-sm" width="100%" style="float: right; margin-top: 20px;">
                        <tfoot>
                            <tr class="cart_subtotal">
                                <td class="no-borders"></td>
                                <th class="description">Subtotal</th>
                                <td class="price"><span class="totals-price"><span class="amount">
                                            {{ number_format($invoice_master[0]->SubTotal, 2) }}</span></span>
                                </td>
                            </tr>
                            <tr class="order_total">
                                <td class="no-borders"></td>
                                <th class="description">Dis {{ $invoice_master[0]->DiscountPer }}%</th>
                                <td class="price"><span class="totals-price"><span
                                            class="amount">{{ number_format($invoice_master[0]->DiscountAmount, 2) }}</span></span>
                                </td>
                            </tr>
                            <tr class="order_total">
                                <td class="no-borders"></td>
                                <th class="description">Total</th>
                                <td class="price"><span class="totals-price"><span
                                            class="amount">{{ number_format($invoice_master[0]->Total, 2) }}</span></span>
                                </td>
                            </tr>
                         <!--    <tr class="order_total">
                                <td class="no-borders"></td>
                                <th class="description">Tax @ {{ $invoice_master[0]->TaxPer }} %</th>
                                <td class="price"><span class="totals-price"><span
                                            class="amount">{{ number_format($invoice_master[0]->Tax, 2) }}</span></span></td>
                            </tr> -->
                         <!--    <tr class="order_total">
                                <td class="no-borders"></td>
                                <th class="description">Shipping</th>
                                <td class="price"><span class="totals-price"><span
                                            class="amount">{{ number_format($invoice_master[0]->Shipping, 2) }}</span></span>
                                </td>
                            </tr> -->

                              <tr class="order_total">
                                <td class="no-borders"></td>
                                <th class="description">Tax <span
                                        style="font-size: 10px;">({{ substr($invoice_master[0]->TaxType, 3, 10) }})</span>
                                </th>
                                <td class="price"><span class="totals-price"><span
                                            class="amount">{{ number_format($invoice_master[0]->Tax, 2) }}</span></span>
                                </td>
                            </tr>


                          <!--       <tr class="order_total d-none">
                                <td class="no-borders"></td>
                                <th class="description">Shipping</th>
                                <td class="price"><span class="totals-price"><span
                                            class="amount">{{ number_format($invoice_master[0]->Shipping, 2) }}</span></span>
                                </td>
                            </tr> -->


                            <tr class="order_total">
                                <td class="no-borders"></td>
                                <th class="description">Grand Total</th>
                                <td class="price"><span class="totals-price"><span
                                            class="amount">{{ number_format($invoice_master[0]->GrandTotal, 2) }}</span></span>
                                </td>
                            </tr>

                        </tfoot>
                    </table></td>
             </tr>
         </tbody>
     </table>
  
  </div> 
</div>

        </div>
      </div>
    </div>
    <!-- END: Content-->
 
  @endsection