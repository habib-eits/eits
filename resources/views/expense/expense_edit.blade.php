@extends('tmp')
@section('title', $pagetitle)

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- <script src="{{asset('assets/invoice/js/jquery-1.11.2.min.js')}}"></script>
<script src="{{asset('assets/invoice/js/jquery-ui.min.js')}}"></script>
<script src="js/ajax.js"></script> -->
<!-- 
<script src="{{asset('assets/invoice/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/invoice/js/bootstrap-datepicker.js')}}"></script>  -->


<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">

<!-- multipe image upload  -->
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link href="multiple/dist/imageuploadify.min.css" rel="stylesheet">

<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->

            <!-- enctype="multipart/form-data" -->
            <form action="{{URL('/ExpenseUpdate')}}" method="post">

<input type="hidden" name="ExpenseMasterID" value="{{$expense_master[0]->ExpenseMasterID}}">
                <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">


                <div class="card shadow-sm">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="password">Supplier </label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select name="SupplierID" id="SupplierID" class="form-select select2 mt-5"  required="">
                                            <option value="">Select</option>
                                            <?php foreach ($supplier as $key => $value) : ?>
                                                <option value="{{$value->SupplierID}}" {{($value->SupplierID== $expense_master[0]->SupplierID) ? 'selected=selected':'' }}>{{$value->SupplierName}}</option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>

                                      <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">Job No </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="JobID" id="JobID" class="form-select select2 mt-5"
                                                required="">
                                                <option value="">Select</option>
                                                <?php foreach ($job as $key => $value) : ?>
                                                <option value="{{ $value->JobID }}" {{($value->JobID== $expense_master[0]->JobID) ? 'selected=selected':'' }}>{{ $value->JobNo }}</option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>



                                <div class="mb-1 d-none row " id="WalkinCustomer">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-danger" for="password">or Walkin Customer </label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="WalkinCustomerName" value="" placeholder="Walkin cusomter" id="1WalkinCustomerName">

                                    </div>
                                </div>
                              
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="password">Paid Through </label>
                                    </div>
                                    <div class="col-sm-9">
                                         <select name="ChartOfAccountID_From" id="ChartOfAccountID_From" class="form-select form-control-sm select2   " style="width: 100% !important;">
                                                    <option value="">select</option>
                                                    @foreach ($chartofaccount as $key => $value)
                                                    <option value="{{$value->ChartOfAccountID }}" {{($value->ChartOfAccountID== $expense_master[0]->ChartOfAccountID) ? 'selected=selected':'' }}>{{$value->ChartOfAccountID}}-{{$value->ChartOfAccountName}}</option>
                                                    @endforeach
                                                </select>

                                    </div>
                                </div>
                                  <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-danger" for="password">Ref #  </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" name="ReferenceNo" autocomplete="off" class="form-control" value="{{$expense_master[0]->ReferenceNo}}">

                                        </div>
                                    </div>
                                </div>
                      


                            </div>
                            <div class="col-md-6">

                        

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-danger" for="password">Expense # </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div id="invoict_type"> <input type="text" name="ExpenseNo" autocomplete="off" class="form-control" value="{{$expense_master[0]->ExpenseNo}}" readonly=""></div>


                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="email-id">Date</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group" id="datepicker21">
                                                <input type="text" name="Date" autocomplete="off" class="form-control" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-container="#datepicker21" data-provide="datepicker" data-date-autoclose="true" value="{{$expense_master[0]->Date}}">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              
                              
                              
                             
                            </div>
                        </div>




                        <hr class="invoice-spacing">

                        <div class='text-center'>

                        </div>
                        <div class='row'>
                            <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                                <table>
                                    <thead>
                                        <tr class="bg-light borde-1 border-light " style="height: 40px;">
                                            <th width="2%" class="text-center"><input id="check_all" type="checkbox" /></th>
                                            <th width="1%">EXPENSE ACCOUNT </th>
                                            <th width="10%">NOTES </th>

                                            
                                            <th width="4%" class="d-none">RATE</th>
                                            <th width="4%">Tax</th>
                                            <th width="4%">Tax Val</th>

                                            <th width="4%">AMOUNT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   @foreach($expense_detail as $key=> $value1)
                                   <?php $no = $key + 1; ?>
                                        <tr class="p-3">
                                            <td class="p-1 bg-light borde-1 border-light text-center"><input class="case" type="checkbox" /></td>

                                            <td>

                                                <select name="ItemID0[]" id="ItemID0_{{$no}}" class="item form-select form-control-sm select2   changesNoo " onchange="km(this.value,<?php echo $no; ?>);" style="width: 300px !important;">
                                                    <option value="">select</option>
                                                    @foreach ($chartofaccount as $key => $value)

                                                    <option value="{{$value->ChartOfAccountID }}" {{($value->ChartOfAccountID== $value1->ChartOfAccountID) ? 'selected=selected':'' }}>{{$value->ChartOfAccountID}}-{{$value->ChartOfAccountName}}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="ChartOfAccountID[]" id="ItemID_{{$no}}" value="{{$value1->ChartOfAccountID}}">
                                            </td>


                                            <td>
                                                <input type="text" name="Description[]" id="Description_{{$no}}" class=" form-control " value="{{$value1->Notes}}">
                                            </td>
                                            <td class="d-none">
                                                <input type="number" name="Qty[]" id="Qty_{{$no}}" class=" form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" step="0.01" value="1">
                                            </td>

                                            <td class="d-none">
                                                <input type="number" name="Price[]" id="Price_{{$no}}" class=" form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" step="0.01" value="1">
                                            </td>

                                            <td>
                                                <select name="Tax[]" id="TaxID_{{$no}}" class="form-select changesNo tax exclusive_cal" required="">
                                                    <?php foreach ($tax as $key => $valueX1) : ?>
                                                        <option value="{{$valueX1->TaxPer}}" {{($valueX1->TaxPer== $value1->TaxPer) ? 'selected=selected':'' }}>{{$valueX1->Description}}</option>
                                                    <?php endforeach ?>
                                                </select>
                                            </td>
                                            <td>
                                                 <input type="number" name="TaxVal[]" id="TaxVal_{{$no}}" class=" form-control totalLinePrice2 tax" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" step="0.01" value="{{$value1->Tax}}">
                                            </td>

                                            <td>
                                                <input type="number" name="ItemTotal[]" id="ItemTotal_{{$no}}" class=" form-control totalLinePrice " autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" step="0.01" value="{{$value1->Amount}}">
                                            </td>
                                        </tr>
@endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-1 mb-2" style="margin-left: 29px;">
                            <div class='col-xs-5 col-sm-3 col-md-3 col-lg-3  '>
                                <button class="btn btn-danger delete" type="button"><i class="bx bx-trash align-middle font-medium-3 me-25"></i>Delete</button>
                                <button class="btn btn-success addmore" type="button"><i class="bx bx-list-plus align-middle font-medium-3 me-25"></i> Add More</button>

                            </div>

                            <div class='col-xs-5 col-sm-3 col-md-3 col-lg-3  '>
                                <div id="result"></div>

                            </div>
                            <br>

                        </div>


                        <div class="row mt-4">

                            <div class="col-lg-8 col-12  ">
                               

                              <iframe src="{{URL('/Attachment')}}" width="100%" height="100%" border="0" scrolling="yes" style="overflow: hidden;"></iframe>

                                <div class="mt-2"><button type="submit" class="btn btn-success w-md float-right">Save</button>
                                    <a href="{{URL('/Expense')}}" class="btn btn-secondary w-md float-right">Cancel</a>

                                </div>







                            </div>


                            <div class="col-lg-4 col-12 ">
                                <!-- <input type="text" class="form-control" id="TotalTaxAmount" name="TaxTotal" placeholder="TaxTotal" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"> -->
                                <form class="form-inline">
                                    <div class="form-group mt-1">
                                        <label>Grand Total Tax: &nbsp;</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">{{session::get('Currency')}}</span>

                                            <input type="text" class="form-control" id="grandtotaltax" name="grandtotaltax" placeholder="Subtotal" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" value="{{$expense_master[0]->Tax}}">
                                        </div>
                                    </div>
                                    <div class="form-group mt-1 d-none">
                                        <label>Sub Total1: &nbsp;</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">{{session::get('Currency')}}</span>

                                            <input type="text" class="form-control" id="subTotal" name="SubTotal" placeholder="Subtotal" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                                        </div>
                                    </div>
                                    <div class="form-group mt-1 d-none" >
                                        <label>Discount: &nbsp;</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">%</span>

                                            <input type="text" class="form-control" value="0" id="discountper" name="DiscountPer" placeholder="Tax" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" value="0">

                                            <span class="input-group-text bg-light">{{session::get('Currency')}}</span>

                                            <input type="text" name="DiscountAmount" class="form-control" id="discountAmount" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" value="0">
                                        </div>
                                    </div>



                                    <div class="form-group mt-1 d-none">

                                        <label>Total: &nbsp;</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">{{session::get('Currency')}}</span>
                                            <input type="number" name="Total" class="form-control" step="0.01" id="totalafterdisc" readonly placeholder="Total" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                                        </div>
                                    </div>
                                    <div class="form-group mt-1 d-none">
                                        <label>Tax: &nbsp;</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">%</span>

                                            <input type="text" class="form-control" id="taxpercentage" name="Taxpercentage" placeholder="tax %" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" value="0">

                                            <span class="input-group-text bg-light">{{session::get('Currency')}}</span>

                                            <input type="text" name="TaxpercentageAmount" class="form-control" id="taxpercentageAmount" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" value="0">
                                        </div>
                                    </div>

                                    <div class="form-group mt-1 d-none">

                                        <label>Shipping: &nbsp;</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">{{session::get('Currency')}}</span>
                                            <input type="number" name="Shipping" class="form-control" step="0.01" id="shipping" placeholder="Grand Total" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" value="0">
                                        </div>
                                    </div>

                                    <div class="form-group mt-1">

                                        <label>Grand Total: &nbsp;</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">{{session::get('Currency')}}</span>
                                            <input type="number" name="Grandtotal" class="form-control" step="0.01" id="grandtotal" placeholder="Grand Total" readonly onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" value="{{$expense_master[0]->GrantTotal}}">
                                        </div>
                                    </div>



                                    <div class="form-group mt-1 d-none">
                                        <label>Amount Paid: &nbsp;</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">{{session::get('Currency')}}</span>
                                            <input type="number" class="form-control" id="amountPaid" name="amountPaid" placeholder="Amount Paid" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" step="0.01" value="0">
                                        </div>
                                    </div>

                                    <div class="form-group mt-1 d-none">

                                        <label>Amount Due: &nbsp;</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">{{session::get('Currency')}}</span>
                                            <input type="number" class="form-control amountDue" name="amountDue" id="amountDue" placeholder="Amount Due" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" step="0.01">
                                        </div>
                                    </div>

                            </div>
                        </div>
                        <div>



                        </div>





            </form>

            <!--  <div class='row'>
          <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
            <div class="well text-center">
          <h2>Back TO Tutorial: <a href="#"> Invoice System </a> </h2>
        </div>
          </div>
        </div>   -->



        </div>
    </div>
</div>




<script>
    $('input[name=tax_action]').change(function(e) {
        $('.exclusive_cal').val(e.target.value)
    })


    /**
     * Site : http:www.smarttutorials.net
     * @author muni
     */

    var i = $('table tr').length;
    $(".addmore").on('click', function() {
        html = '<tr class="  border-1 border-light">';
        html += '<td class="p-1 text-center"><input class="case" type="checkbox"/></td>';
        html += '<td><select name="ItemID0[]" id="ItemID0_' + i + '"  style="width: 300px !important;" class="form-select select2 changesNoo" onchange="km(this.value,' + i + ');" > <option value="">select</option>}@foreach ($chartofaccount as $key => $value) <option value="{{$value->ChartOfAccountID }}|{{$value->ChartOfAccountName}}">{{$value->ChartOfAccountName}}</option>@endforeach</select><input type="hidden" name="ChartOfAccountID[]" id="ItemID_' + i + '"></td>';



        html += '  <td><input type="text" name="Description[]" id="Description_' + i + '" class=" form-control " ></td>';
        html += '<td class="d-none";><input type="text" name="Qty[]" id="Qty_' + i + '" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" value="1"></td>';

        html += '<td class="d-none"><input type="text" name="Price[]" id="Price_' + i + '" class="form-control changesNo " autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" value="1"></td>';

        html += '<td><select name="Tax[]" id="TaxID_' + i + '" class="form-select changesNo exclusive_cal"><?php foreach ($tax as $key => $valueX1) : ?><option value="{{$valueX1->TaxPer}}">{{$valueX1->Description}}</option><?php endforeach ?></select></td>';


        html += '<td><input type="number" name="TaxVal[]" id="TaxVal_' + i + '" class=" form-control totalLinePrice2 tax "autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" step="0.01"></td>';




        html += '<td><input type="text" name="ItemTotal[]" id="ItemTotal_' + i + '" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';

        html += '</tr>';
        $('table').append(html);
        $('.select2', 'table').select2();
        i++;


 

    });





    //to check all checkboxes
    $(document).on('change', '#check_all', function() {
        $('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
    });

  


    function km(v, id) {



        // alert(v+id);

        id_arr = 'ItemID0_' + id;
        id = id_arr.split("_");

        val = $('#ItemID0_' + id[1]).val().split("|");


        // alert($('#ItemID0_'+id[1]).val());
        $('#ItemID_' + id[1]).val(val[0]);



        // alert('val done');






        calculateTotal();

        if (isNaN($('#discountAmount').val())) {
            $('#discountAmount').val(0);
        }

        calculatediscount();
        calculateTotal();



    }








 


    //deletes the selected table rows
    $(".delete").on('click', function() {
        $('.case:checkbox:checked').parents("tr").remove();
        $('#check_all').prop("checked", false);
        calculateTotal();
    });




    


    //price change
    $(document).on('change keyup blur ', '.changesNo', function() {

        id_arr = $(this).attr('id');
        id = id_arr.split("_");

        Qty = $('#Qty_' + id[1]).val();

        TaxPer = $('#TaxID_' + id[1]).val();

        Price = $('#Price_' + id[1]).val();

        TotalPrice = parseFloat(Qty) * parseFloat(Price);

        TotalTaxPer = (parseFloat(TaxPer) / 100) * parseFloat(TotalPrice);







        ItemTotal = parseFloat(TotalPrice) + parseFloat(TotalTaxPer);



        // $('#ItemTotal_' + id[1]).val(ItemTotal);
        // $('#TaxVal_' + id[1]).val(parseFloat(TotalTaxPer));



// 
        // console.log('new line');
        // console.log('qty=');

        // console.log(Qty);

        // console.log('price');


        // console.log(Price);


        // console.log('---');



        // console.log('----total price');
        // console.log(TotalPrice);

        // console.log('taxper');


        // console.log(TaxPer);

        // console.log('--taxamount-');
        // console.log(TaxAmount);
        // console.log('discount');
        // console.log(discount);
        // console.log('total price');
        // console.log(TotalPrice);

        // console.log('grand item total');
        // console.log(ItemTotal);












        // $('#ItemTotal_'+id[1]).val(  (parseFloat(json["SellingPrice"])*parseFloat( $('#Qty_'+id[1]).val() ) + parseFloat($('#TaxAmount_'+id[1]).val() )  - (parseFloat($('#discount_'+id[1]).val()) )    ).toFixed(2)   );





        calculatediscount();
        calculateTotal();
    });

    //////////

    $(document).on(' blur', '.totalLinePrice', function() {



        id_arr = $(this).attr('id');
        id = id_arr.split("_");



        total = $('#ItemTotal_' + id[1]).val();

taxper =  $('#TaxID_' + id[1]).val();
 

       tax =( total *taxper )/ 100;
 
        $('#TaxVal_' + id[1]).val(tax);



  taxtotal = 0;
        $('.tax').each(function() {
            if ($(this).val() != '') taxtotal += parseFloat($(this).val());
        });


 

$('#grandtotaltax').val(taxtotal);

 gtotal = 0;
        $('.totalLinePrice').each(function() {
            if ($(this).val() != '') gtotal += parseFloat($(this).val());
        });
 

 $('#grandtotal').val(gtotal);
  calculateTotal();
        // Profit = (parseFloat(total)-parseFloat(Fare)).toFixed(2) ;

        // Tax = ;

        // Service = (parseFloat(Proft)-parseFloat(Tax)).toFixed(2) ;

        // alert(Profit+Tax+Service);

        // $('#quantity'+id[1]).val( Tax );
        // $('#Service_'+id[1]).val( Service );



    });

    $(document).on('change', '.changesNoo', function() {



        id_arr = $(this).attr('id');
        id = id_arr.split("_");

        val = $('#ItemID0_' + id[1]).val().split("|");


        // alert($('#ItemID0_'+id[1]).val());
        $('#ItemID_' + id[1]).val(val[0]);


        calculatediscount();

    });

    ////////////////////////////////////////////

    function calculatediscount() {
        subTotal = 0;
        $('.totalLinePrice').each(function() {
            if ($(this).val() != '') subTotal += parseFloat($(this).val());
        });
        subTotal = parseFloat($('#subTotal').val());


        discountper = $('#discountper').val();
        // totalafterdisc = $('#totalAftertax').val();
        // console.log('testing'.totalAftertax);
        if (discountper != '' && typeof(discountper) != "undefined") {
            discountamount = parseFloat(subTotal) * (parseFloat(discountper) / 100);

            $('#discountAmount').val(parseFloat(discountamount.toFixed(2)));
            total = subTotal - discountamount;
            $('#totalafterdisc').val(total.toFixed(2));
            // $('#grandtotal').val(total.toFixed(2));

        } else {
            $('#discountper').val(0);
            // alert('dd');
            $('#DiscountAmount').val(0);
            total = subTotal;
            $('#totalafterdisc').val(total.toFixed(2));

        }

    }


    $(document).on('blur', '#discountAmount', function() {


        calculatediscountper();

    });

    function calculatediscountper() {
        subTotal = 0;

        $('.totalLinePrice').each(function() {
            if ($(this).val() != '') subTotal += parseFloat($(this).val());
        });
        subTotal = parseFloat($('#subTotal').val());


        discountAmount = $('#discountAmount').val();
        // totalafterdisc = $('#totalAftertax').val();
        // console.log('testing'.totalAftertax);
        if (discountAmount != '' && typeof(discountAmount) != "undefined") {
            discountper = (parseFloat(discountAmount) / parseFloat(subTotal)) * 100;

            $('#discountper').val(parseFloat(discountper.toFixed(2)));
            total = subTotal - discountAmount;
            $('#totalafterdisc').val(total.toFixed(2));
            // $('#grandtotal').val(total.toFixed(2));

        } else {
            $('#discountper').val(0);
            // alert('dd');
            $('#discountper').val(0);
            total = subTotal;
            $('#totalafterdisc').val(total.toFixed(2));

        }

    }

    //////////////////

    // discount percentage
    $(document).on('change keyup blur onmouseover onclick', '#discountper', function() {
        calculatediscount();


        calculateTotal();

    });
    $(document).on('change keyup blur   onclick', '#taxpercentage', function() {
        calculateTotal();
    });


    $(document).on('change keyup blur   onclick', '#shipping', function() {
        calculateTotal();
    });



    //total price calculation 
    function calculateTotal() {

        // grand_tax = 0;
        grand_tax = 0;
        subTotal = 0;
        total = 0;
        total2 = 0;
        sumtax = 0;
        gt = 0;
        grandtotaltax = 0;
        var pretotal = 0;

        $('.totalLinePrice').each(function() {
            if ($(this).val() != '') subTotal += parseFloat($(this).val());
        });
        $('.totalLinePrice2').each(function() {
            if ($(this).val() != '') grandtotaltax += parseFloat($(this).val());
        });

        $('#grandtotaltax').val(grandtotaltax.toFixed(2));
        console.log(grandtotaltax);
        discountper = $('#discountper').val();

        if (discountper != '' && typeof(discountper) != "undefined") {

        }

        $('#subTotal').val(subTotal.toFixed(2));
        pretotal = $('#totalafterdisc').val();
        discountAmount = $('#discountAmount').val();
        tax = $('#tax').val();
        grand_tax = $('#taxpercentage').val();

        if (grand_tax != '' && typeof(grand_tax) != "undefined") {
            gt = subTotal * (parseFloat(grand_tax) / 100);

            $('#taxpercentageAmount').val(gt.toFixed(2));
            total2 = subTotal + gt - discountAmount;
        } else {
            $('#taxpercentage').val(0);
            total2 = subTotal - pretotal;
        }


        shipping = parseFloat($('#shipping').val());

        shipping_grand = shipping + total2;
       $('#grandtotal').val(shipping_grand)
        }

    </script>
@endsection