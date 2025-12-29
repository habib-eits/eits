@extends('template.tmp')
@section('title', $pagetitle)

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">

    <!-- multipe image upload  -->
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link href="multiple/dist/imageuploadify.min.css" rel="stylesheet">

    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <style>
        .form-control {
            display: block;
            width: 100%;
            padding: 0.47rem 0.75rem;
            font-size: .8125rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0rem !important;
            -webkit-transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;

        }

        .form-select {
            display: block;
            width: 100%;
            padding: 0.47rem 1.75rem 0.47rem 0.75rem;
            font-size: .8125rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e);
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0rem !important;
        }

        .select2-container .select2-selection--single {
            background-color: #fff;
            border: 1px solid #ced4da;
            height: 38px
        }

        .select2-container .select2-selection--single:focus {
            outline: 0
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            line-height: 36px;
            padding-left: .75rem;
            color: #495057
        }

        .select2-container .select2-selection--single .select2-selection__arrow {
            height: 34px;
            width: 34px;
            right: 3px
        }

        .select2-container .select2-selection--single .select2-selection__arrow b {
            border-color: #adb5bd transparent transparent transparent;
            border-width: 6px 6px 0 6px
        }

        .select2-container .select2-selection--single .select2-selection__placeholder {
            color: #495057
        }

        .select2-container--open .select2-selection--single .select2-selection__arrow b {
            border-color: transparent transparent #adb5bd transparent !important;
            border-width: 0 6px 6px 6px !important
        }

        .select2-container--default .select2-search--dropdown {
            /*padding: 10px;*/
            background-color: #fff
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid #ced4da;
            background-color: #fff;
            color: #74788d;
            outline: 0
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #556ee6
        }

        .select2-container--default .select2-results__option[aria-selected=true]:hover {
            background-color: #556ee6;
            color: #fff
        }

        .select2-results__option {
            padding: 6px 12px
        }

        .select2-container[dir=rtl] .select2-selection--single .select2-selection__rendered {
            padding-left: .75rem
        }

        .select2-dropdown {
            border: 1px solid rgba(0, 0, 0, .15);
            background-color: #fff;
            -webkit-box-shadow: 0 .75rem 1.5rem rgba(18, 38, 63, .03);
            box-shadow: 0 .75rem 1.5rem rgba(18, 38, 63, .03)
        }

        .select2-search input {
            border: 1px solid #f6f6f6
        }

        .select2-container .select2-selection--multiple {
            min-height: 38px;
            background-color: #fff;
            border: 1px solid #ced4da !important
        }

        .select2-container .select2-selection--multiple .select2-selection__rendered {
            padding: 2px .75rem
        }

        .select2-container .select2-selection--multiple .select2-search__field {
            border: 0;
            color: #495057
        }

        .select2-container .select2-selection--multiple .select2-search__field::-webkit-input-placeholder {
            color: #495057
        }

        .select2-container .select2-selection--multiple .select2-search__field::-moz-placeholder {
            color: #495057
        }

        .select2-container .select2-selection--multiple .select2-search__field:-ms-input-placeholder {
            color: #495057
        }

        .select2-container .select2-selection--multiple .select2-search__field::-ms-input-placeholder {
            color: #495057
        }

        .select2-container .select2-selection--multiple .select2-search__field::placeholder {
            color: #495057
        }

        .select2-container .select2-selection--multiple .select2-selection__choice {
            background-color: #eff2f7;
            border: 1px solid #f6f6f6;
            border-radius: 1px;
            padding: 0 7px
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #ced4da
        }

        .select2-container--default .select2-results__group {
            font-weight: 600
        }

        .select2-result-repository__avatar {
            float: left;
            width: 60px;
            margin-right: 10px
        }

        .select2-result-repository__avatar img {
            width: 100%;
            height: auto;
            border-radius: 2px
        }

        .select2-result-repository__statistics {
            margin-top: 7px
        }

        .select2-result-repository__forks,
        .select2-result-repository__stargazers,
        .select2-result-repository__watchers {
            display: inline-block;
            font-size: 11px;
            margin-right: 1em;
            color: #adb5bd
        }

        .select2-result-repository__forks .fa,
        .select2-result-repository__stargazers .fa,
        .select2-result-repository__watchers .fa {
            margin-right: 4px
        }

        .select2-result-repository__forks .fa.fa-flash::before,
        .select2-result-repository__stargazers .fa.fa-flash::before,
        .select2-result-repository__watchers .fa.fa-flash::before {
            content: "\f0e7";
            font-family: 'Font Awesome 5 Free'
        }

        .select2-results__option--highlighted .select2-result-repository__forks,
        .select2-results__option--highlighted .select2-result-repository__stargazers,
        .select2-results__option--highlighted .select2-result-repository__watchers {
            color: rgba(255, 255, 255, .8)
        }

        .select2-result-repository__meta {
            overflow: hidden
        }
    </style>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <form action="{{ URL('/SaleInvoiceSave') }}" method="post">
                    <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">Customer </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="PartyID" id="PartyID" class="form-select select2 mt-5"
                                                required="" style="width:100%;">
                                                <option value="">Select</option>
                                                @foreach ($party as $key => $value)
                                                    <option value="{{ $value->PartyID }}"
                                                        {{ $challanData->PartyID == $value->PartyID ? 'selected' : '' }}>
                                                        {{ $value->PartyName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 row d-none" id="WalkinCustomer">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-danger" for="password">Walkin Customer
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="WalkinCustomerName"
                                                value="" placeholder="Walkin cusomter" id="1WalkinCustomerName">
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">Salesperson </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="UserID" id="UserID" class="form-select select2"
                                                style="width:100%;">
                                                <option value="">Select
                                                </option>
                                                @foreach ($user as $key => $value)
                                                    <option value="{{ $value->UserID }}"
                                                        {{ $challanData->UserID == $value->UserID ? 'selected' : '' }}>
                                                        {{ $value->FullName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">Subject </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="first-name" class="form-control" name="Subject"
                                                value=""
                                                placeholder="Let your customer know what this invoice is for">
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">Tax</label>
                                        </div>

                                        <div class="col-sm-9">
                                            <select name="UserI D" id="seletedVal" class="form-select"
                                                onchange="GetSelectedTextValue(this)" style="width: 100%;">
                                                @foreach ($tax as $key => $valueX1)
                                                    <option value="{{ $valueX1->TaxPer }}" {{ $challanData->TaxPer == $valueX1->TaxPer ? 'selected' : '' }}>{{ $valueX1->Description }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">Item Rates Are </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="TaxType" id="TaxType" class="form-select">
                                                <option value="TaxInclusive">Tax Inclusive</option>
                                                <option value="TaxExclusive" selected>Tax Exclusive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="email-id">Date</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="input-group" id="datepicker21">
                                                    <input type="text" name="Date" autocomplete="off"
                                                        class="form-control" placeholder="yyyy-mm-dd"
                                                        data-date-format="yyyy-mm-dd" data-date-container="#datepicker21"
                                                        data-provide="datepicker" data-date-autoclose="true"
                                                        value="{{ date('Y-m-d') }}">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-12" id="">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label text-danger" for="password">Job Number
                                                </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="JobNo" class="form-control"
                                                    value="{{ $challanData->JobNo }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label text-danger" for="password">Invoice Type
                                                </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select name="InvoiceType" id="InvoiceType" class="form-select">
                                                    @foreach ($invoice_type as $key => $value)
                                                        <option value="{{ $value->InvoiceType }}"
                                                            {{ $value->InvoiceType == 'Invoice' ? 'selected' : '' }}>
                                                            {{ $value->InvoiceType }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label text-danger" for="password">Invoice #
                                                </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <div id="invoict_type"> <input type="text" name="InvoiceNo"
                                                        autocomplete="off" class="form-control"
                                                        value="TAX-{{ $vhno[0]->VHNO }}"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label text-danger" for="contact-info">Due
                                                    Date</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="input-group" id="datepicker22">
                                                    <input type="text" name="DueDate" autocomplete="off"
                                                        class="form-control" placeholder="yyyy-mm-dd"
                                                        data-date-format="yyyy-mm-dd" data-date-container="#datepicker22"
                                                        data-provide="datepicker" data-date-autoclose="true"
                                                        value="{{ date('Y-m-d') }}">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label text-danger" for="password">Ref # (L.P.O)
                                                </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="ReferenceNo" autocomplete="off"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-danger" for="password">Payment Mode </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="PaymentMode" id="PaymentMode" class="form-select select2"
                                                style="width:100%;">
                                                @foreach ($payment_mode as $value)
                                                    <option value="{{ $value->PaymentMode }}">{{ $value->PaymentMode }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12" id="paymentdetails">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label text-danger" for="password">Cheque Details
                                                </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="PaymentDetails" class="form-control ">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                var i = $('table tr').length;
                            </script>
                            <hr class="invoice-spacing">
                            <div class='row'>
                                <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                                    <table>
                                        <thead>
                                            <tr class=" borde-1 border-light " style="height: 40px;">
                                                <th width="1%" class="text-left"><input id="check_all"
                                                        type="checkbox" /></th>
                                                <th width="1%">ITEM DETAILS </th>
                                                <th width="2%">DESCRIPTION</th>
                                                <th width="1%">QUANTITY</th>
                                                <th width="2%">RATE</th>
                                                <th width="2%" class="d-none">DISCOUNT</th>
                                                <th width="2%" class="d-none">Value for Tax</th>
                                                <th width="2%" class="d-none">Tax</th>
                                                <th width="2%" class="d-none">Tax Val</th>
                                                <th width="2%">AMOUNT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($challandetailsData as $key => $value1)
                                                <?php $no = $key + 1; ?>
                                                <tr class="p-3">
                                                    <td bordercolor="1" class="p-1    text-left" valign="top"><input
                                                            class="case" type="checkbox" />-
                                                        <script>
                                                            document.write(i + 1);
                                                        </script>
                                                    </td>
                                                    <td valign="top">
                                                        <select name="ItemID0[]" id="ItemID0_{{ $no }}"
                                                            class="item form-select  form-control-sm select2 changesNoo "
                                                            onchange="km(this.value,1);" style="width: 300px !important;">
                                                            <option value="">select</option>
                                                            @foreach ($items as $key => $value)
                                                                <option value="{{ $value->ItemID }}"
                                                                    {{ $value->ItemID == $value1->ItemID ? 'selected' : '' }}>
                                                                    {{ $value->ItemCode }}-{{ $value->ItemName }}</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" name="ItemID[]" id="ItemID_{{ $no }}" value="{{ $value1->ItemID }}">
                                                    </td>
                                                    <td valign="top">
                                                        <textarea name="Description[]" id="Description[]" rows="2" class="form-control"
                                                            style="width: 300px !important;">{{ $value1->Description }}</textarea>
                                                    </td>
                                                    <td valign="top">
                                                        <input type="number" name="Qty[]" id="Qty_{{ $no }}"
                                                            class=" form-control changesNo QtyTotal" autocomplete="off"
                                                            onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                            onpaste="return false;" step="0.01"
                                                            value="{{ $value1->Qty }}">
                                                    </td>
                                                    <td valign="top">
                                                        <input type="number" name="Price[]" id="Price_{{ $no }}"
                                                            class=" form-control changesNo" autocomplete="off"
                                                            onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                            onpaste="return false;" step="0.01"
                                                            value="{{ $value1->Rate }}">
                                                    </td>
                                                    <td valign="top" class="d-none">
                                                        <div class="input-group">
                                                            <input readonly type="text" name="Discount[]"
                                                                id="Discount_{{ $no }}" class=" form-control changesNo"
                                                                autocomplete="off" onkeypress="return IsNumeric(event);"
                                                                ondrop="return false;" onpaste="return false;"
                                                                step="0.01"
                                                                value="{{ $value1->Discount != null ? $value1->Discount : 0 }}">
                                                            <span>
                                                                <div class="col-sm-9 input-group">
                                                                    <select name="DiscountType[]" id="DiscountType_{{ $no }}"
                                                                        class="form-select  changesNo bg-light">

                                                                        <option value="1">%</option>
                                                                        <option value="2">
                                                                            {{ session::get('Currency') }}</option>

                                                                    </select>
                                                                    <input type="hidden" name="DiscountAmountItem[]"
                                                                        id="DiscountAmount_{{ $no }}" value="0">
                                                                </div>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td valign="top" class="d-none">
                                                        <input readonly type="number" name="Gross[]" id="Gross_{{ $no }}"
                                                            class=" form-control changesNo" autocomplete="off"
                                                            onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                            onpaste="return false;" step="0.01"
                                                            value="{{ $value1->Rate - $value1->Discount }}">
                                                    </td>
                                                    <td valign="top" class="d-none">
                                                        <select name="Tax[]" id="TaxID_{{ $no }}" required=""
                                                            class="form-select  changesNo tax exclusive_cal bg-light">
                                                            <?php foreach ($tax as $key => $valueX1) : ?>
                                                            <option value="{{ $valueX1->TaxPer }}">
                                                                {{ $valueX1->Description }}</option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </td>
                                                    <td valign="top" class="d-none">
                                                        <input readonly type="number" name="TaxVal[]" id="TaxVal_{{ $no }}"
                                                            class=" form-control totalLinePrice2" autocomplete="off"
                                                            onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                            onpaste="return false;" step="0.01"
                                                            value="{{ $value1->TaxAmount != null ? $value1->TaxAmount : 0 }}">
                                                    </td>
                                                    <td valign="top">
                                                        <input readonly type="number" name="ItemTotal[]"
                                                            id="ItemTotal_{{ $no }}" class=" form-control totalLinePrice "
                                                            autocomplete="off" onkeypress="return IsNumeric(event);"
                                                            ondrop="return false;" onpaste="return false;" step="0.01"
                                                            value="{{ $value1->Total }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-1 mb-2" style="margin-left: 55px;">
                                <div class='col-xs-5 col-sm-3 col-md-3 col-lg-3  '>
                                    {{-- <button class="btn btn-danger delete" type="button"><i
                                            class="bx bx-trash align-middle font-medium-3 me-25"></i>Delete</button>
                                    <button class="btn btn-success addmore" type="button"><i
                                            class="bx bx-list-plus align-middle font-medium-3 me-25"></i> Add More</button> --}}

                                </div>
                                <div class='col-xs-5 col-sm-3 col-md-3 col-lg-3  d-none'>
                                    <div id="result"></div>
                                    <div id="QtyTotal" class="form-control"
                                        style="border: 1px dashed red; width: 112px;"></div>

                                </div>
                                <br>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-8 col-12  ">
                                    <h6>Customer Notes: </h6>
                                    <textarea class="form-control" rows='5' name="CustomerNotes" id="note" placeholder="">Thanks for your business.</textarea>
                                    <label for="" class="mt-2">Description</label>
                                    <textarea class="form-control" rows='5' name="DescriptionNotes" id="note"
                                        placeholder="Description notes if any."></textarea>
                                    <br>
                                    <iframe src="{{ URL('/Attachment') }}" width="100%" height="40%" border="0"
                                        scrolling="yes" style="overflow: hidden;"></iframe>
                                    <div class="mt-2"><button type="submit" class="btn btn-success w-md float-right"
                                            onclick="if (confirm('Are you sure you want to save thie page?')) return true; else return false;">Save</button>
                                        <a href="{{ URL('/DeliveryChallan') }}"
                                            class="btn btn-secondary w-md float-right">Cancel</a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 ">
                                    <form class="form-inline">
                                        <div class="form-group mt-1">
                                            <label>Sub Total: &nbsp;</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>

                                                <input readonly type="text" class="form-control" id="subTotal"
                                                    name="SubTotal" placeholder="Subtotal"
                                                    onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                    onpaste="return false;" value="{{ $challanData->SubTotal }}">
                                            </div>
                                        </div>
                                        <div class="form-group mt-1">
                                            <label>Discount: &nbsp;</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">%</span>
                                                <input type="text" class="form-control" id="discountper"
                                                    name="DiscountPer" placeholder="Tax"
                                                    onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                    onpaste="return false;" value="{{ $challanData->DiscountPer }}">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input type="text" name="DiscountAmount" class="form-control"
                                                    id="discountAmount" onkeypress="return IsNumeric(event);"
                                                    ondrop="return false;" onpaste="return false;"
                                                    value="{{ $challanData->DiscountAmount }}">
                                            </div>
                                        </div>
                                        <div class="form-group mt-1">
                                            <label>Total: &nbsp;</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input readonly type="number" name="Total" id="Total"
                                                    class="form-control" step="0.01" id="totalafterdisc"
                                                    placeholder="Total" onkeypress="return IsNumeric(event);"
                                                    ondrop="return false;" onpaste="return false;"
                                                    value="{{ $challanData->Total }}">
                                            </div>
                                        </div>
                                        <div class="form-group mt-1">
                                            <label>Grand Total Tax: &nbsp;</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input readonly type="text" class="form-control" id="grandtotaltax"
                                                    name="grandtotaltax" placeholder="Subtotal"
                                                    onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                    onpaste="return false;" value="{{ $challanData->Tax }}">
                                            </div>
                                        </div>
                                        <div class="form-group mt-1 d-none">
                                            <label>Shipping: &nbsp;</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input readonly type="number" name="Shipping" class="form-control"
                                                    step="0.01" id="shipping" placeholder="Grand Total"
                                                    onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                    onpaste="return false;" value="{{ $challanData->Shipping }}">
                                            </div>
                                        </div>
                                        <div class="form-group mt-1">
                                            <label>Grand Total: &nbsp;</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input readonly type="number" name="Grandtotal" id="Grandtotal"
                                                    class="form-control" step="0.01" id="grandtotal"
                                                    placeholder="Grand Total" onkeypress="return IsNumeric(event);"
                                                    ondrop="return false;" onpaste="return false;"
                                                    value="{{ $challanData->GrandTotal }}">
                                            </div>
                                        </div>
                                        <div class="form-group mt-1 d-none">
                                            <label>Amount Paid: &nbsp;</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input type="number" class="form-control" id="amountPaid"
                                                    name="amountPaid" placeholder="Amount Paid"
                                                    onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                    onpaste="return false;" step="0.01" value="0">
                                            </div>
                                        </div>
                                        <div class="form-group mt-1 d-none">
                                            <label>Amount Due: &nbsp;</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input type="number" class="form-control amountDue" name="amountDue"
                                                    id="amountDue" placeholder="Amount Due"
                                                    onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                    onpaste="return false;" step="0.01">
                                            </div>
                                        </div>
                                </div>
                            </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        var i = $('table tr').length;
        $(".addmore").on('click', function() {
            html = '<tr class= borde-1 border-light">';
            html += '<td valign="top" class="p-1 text-left"><input class="case" type="checkbox"/>- ' + i + '</td>';
            html += '<td><select name="ItemID0[]" id="ItemID0_' + i +
                '"  style="width: 300px !important;" class="form-select select2  changesNoo" onchange="km(this.value,' +
                i +
                ');" > <option value="">select</option>}@foreach ($items as $key => $value) <option value="{{ $value->ItemID }}|{{ $value->Percentage }}">{{ $value->ItemCode }}-{{ $value->ItemName }}-{{ $value->Percentage }}</option>@endforeach</select><input type="hidden" name="ItemID[]" id="ItemID_' +
                i +
                '"></td>';
            html +=
                '<td valign="top"><textarea name="Description[]" id="Description[]" rows="2" class="form-control" style="width: 300px !important;"></textarea></td>'
            html += '<td valign="top"><input type="text" name="Qty[]" id="Qty_' + i +
                '" class="form-control changesNo QtyTotal" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" value="1"></td>';
            html += '<td valign="top"><input type="text" name="Price[]" id="Price_' + i +
                '" class="form-control changesNo " autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
            html +=
                '<td valign="top" class="d-none"><div class="input-group"><input type="text" name="Discount[]" id="Discount_' +
                i +
                '" class=" form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" step="0.01" value="0"><span ><div class="col-sm-9 input-group"><select name="DiscountType[]" id="DiscountType_' +
                i +
                '" class="form-select  changesNo bg-light"  ><option  value="1">%</option><option  value="2">{{ session::get('Currency') }}</option></select><input type="hidden" name="DiscountAmountItem[]" value="0" id="DiscountAmount_' +
                i + '"></div></span></div></td>';
            html += '<td  valign="top" class="d-none"> <input type="number" name="Gross[]" id="Gross_' + i +
                '" class=" form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" step="0.01">  </td>';
            html += '<td  valign="top" class="d-none"><select name="Tax[]" id="TaxID_' + i +
                '" class="form-control changesNo exclusive_cal bg-light"><?php foreach ($tax as $key => $valueX1) : ?><option value="{{ $valueX1->TaxPer }}">{{ $valueX1->Description }}</option><?php endforeach ?></select></td>';
            html += '<td  valign="top" class="d-none"><input type="number" name="TaxVal[]" id="TaxVal_' + i +
                '" class=" form-control totalLinePrice2 "autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" step="0.01" value="0"></td>';
            html += '<td  valign="top"><input type="text" name="ItemTotal[]" id="ItemTotal_' + i +
                '" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
            html += '</tr>';
            i++;
            $('table').append(html);
            $('.select2', 'table').select2();
        });
        $(document).on('change', '#check_all', function() {
            $('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
        });

        function km(v, id) {
            id_arr = 'ItemID0_' + id;
            id = id_arr.split("_");
            val = $('#ItemID0_' + id[1]).val().split("|");
            $('#ItemID_' + id[1]).val(val[0]);
            var data = <?php echo $item; ?> // this is dynamic data in json_encode(); from controller
            var item_idd = $('#ItemID_' + id[1]).val();
            var index = -1;
            var val = parseInt(item_idd);
            var json = data.find(function(item, i) {
                if (item.ItemID === val) {
                    index = i + 1;
                    return i + 1;
                }
            });
            $('#Price_' + id[1]).val(json["SellingPrice"]);
            // $('#TaxID_' + id[1]).val(json["Percentage"]);
            var Qty = $('#Qty_' + id[1]).val();
            var Price = $('#Price_' + id[1]).val();
            var QtyRate = parseFloat(Price) * parseFloat(Qty);
            var DiscountType = $('#DiscountType_' + id[1]).val();
            var Discount = $('#Discount_' + id[1]).val();
            if (DiscountType == 1) {
                var DiscountCalculated = (parseFloat(QtyRate) * parseFloat(Discount) / 100).toFixed(2);
            } else {
                var DiscountCalculated = parseFloat(Discount);
            }
            $('#DiscountAmount_' + id[1]).val(DiscountCalculated);
            var Gross = parseFloat(QtyRate) - parseFloat(DiscountCalculated);
            $('#Gross_' + id[1]).val(Gross);
            var TaxID = $('#TaxID_' + id[1]).val();
            var TaxCalculation = ((parseFloat(Gross) * parseFloat(TaxID)) / 100).toFixed(2);
            $('#TaxVal_' + id[1]).val(TaxCalculation);
            var ItemTotal = parseFloat(Gross) - parseFloat(TaxCalculation);
            $('#ItemTotal_' + id[1]).val(parseFloat(ItemTotal).toFixed(2));
            var grandtotaltax = 0;
            $('.totalLinePrice2').each(function() {
                if ($(this).val() != '') grandtotaltax += parseFloat($(this).val());
            });
            $('#grandtotaltax').val((parseFloat(grandtotaltax)).toFixed(2));
            TaxIncExc();
            calculateTotal();
            if (isNaN($('#discountAmount').val())) {
                $('#discountAmount').val(0);
            }
            calculatediscount();
            calculateTotal();
            TaxIncExc();
        }
        $(".delete").on('click', function() {
            $('.case:checkbox:checked').parents("tr").remove();
            $('#check_all').prop("checked", false);
            calculatediscount();
            calculateTotal();
            TaxIncExc();
        });
        $(document).on('change keyup blur ', '.QtyTotal', function() {
            CalculateQtyTotal();
        });

        function CalculateQtyTotal() {
            QtyTotal = 0;
            $('.QtyTotal').each(function() {
                if ($(this).val() != '') QtyTotal += parseFloat($(this).val());
            });
            $('#QtyTotal').text(QtyTotal);
        }
        $(document).on('change keyup blur ', '.changesNo', function() {
            singlerowcalculation($(this).attr('id'));
            calculatediscount();
            calculateTotal();
            TaxIncExc();
        });

        function singlerowcalculation(idd) {
            TaxIncExc();
            id_arr = idd;
            id = id_arr.split("_");
            Qty = $('#Qty_' + id[1]).val();
            TaxPer = $('#TaxID_' + id[1]).val();
            Price = $('#Price_' + id[1]).val();
            var Qty = $('#Qty_' + id[1]).val();
            var Price = $('#Price_' + id[1]).val();
            var QtyRate = parseFloat(Price) * parseFloat(Qty);
            var DiscountType = $('#DiscountType_' + id[1]).val();
            var Discount = $('#Discount_' + id[1]).val();
            if (DiscountType == 1) {
                var DiscountCalculated = (parseFloat(QtyRate) * parseFloat(Discount) / 100);
            } else {
                var DiscountCalculated = parseFloat(Discount);
            }
            $('#DiscountAmount_' + id[1]).val(DiscountCalculated);
            var Gross = parseFloat(QtyRate) - parseFloat(DiscountCalculated);
            $('#Gross_' + id[1]).val(Gross);
            // var TaxID = $('#TaxID_' + id[1]).val();
            // var TaxCalculation = ((parseFloat(Gross) * parseFloat(TaxID)) / 100).toFixed(2);
            // $('#TaxVal_' + id[1]).val(TaxCalculation);
            $('#ItemTotal_' + id[1]).val(Gross.toFixed(2));
            var grandtotaltax = 0;
            $('.totalLinePrice2').each(function() {
                if ($(this).val() != '') grandtotaltax += parseFloat($(this).val());
            });
            $('#grandtotaltax').val(parseFloat(grandtotaltax).toFixed(2));
            TaxIncExc();
        }

        function TaxIncExc() {
            var TaxType = $('#TaxType').val();
            var DiscountAmount = $('#discountAmount').val();
            var grandtotaltax = 0;
            var table_lenght = $('table tr').length - 1;
            var Qty = 0
            var Price = 0;
            var TaxVal = 0;
            var Gross = 0;
            for (let i = 1; i <= table_lenght; i++) {
                Qty = $('#Qty_' + i).val();
                Price = $('#Price_' + i).val();
                // TaxVal = $('#TaxVal_' + i).val();
                // Gross = $('#Gross_' + i).val();
                $('#ItemTotal_' + i).val((parseFloat(Qty) * parseFloat(Price)).toFixed(2));
            }
            // $('.totalLinePrice2').each(function() {
            //     if ($(this).val() != '') grandtotaltax += parseFloat($(this).val());
            // });
            subTotal = 0;
            $('.totalLinePrice').each(function() {
                if ($(this).val() != '') subTotal += parseFloat($(this).val());
            });
            subTotal1 = (parseFloat(subTotal)).toFixed(2);
            $('#subTotal').val(parseFloat(subTotal1).toFixed(2));
            var Total = parseFloat(subTotal1) - parseFloat(DiscountAmount);
            $('#Total').val(parseFloat(Total).toFixed(2));
            TaxVal = $('#seletedVal').val();
            grandtotaltax = Total * (parseFloat(TaxVal) / 100);
            if (TaxType == 'TaxInclusive') {
                $('#Grandtotal').val(Total.toFixed(2));
            } else {
                $('#Grandtotal').val((parseFloat(Total) + parseFloat(grandtotaltax)).toFixed(2));
            }
        }
        $(document).on('change', '.changesNoo', function() {
            id_arr = $(this).attr('id');
            id = id_arr.split("_");
            val = $('#ItemID0_' + id[1]).val().split("|");
            $('#ItemID_' + id[1]).val(val[0]);
            calculatediscount();
        });

        function calculatediscount() {
            subTotal = parseFloat($('#subTotal').val());
            discountper = $('#discountper').val();
            if (discountper != '' && typeof(discountper) != "undefined") {
                discountamount = parseFloat(subTotal) * (parseFloat(discountper) / 100);
                $('#discountAmount').val(parseFloat(discountamount.toFixed(2)));
                total = subTotal - discountamount;
                $('#Total').val(total.toFixed(2));
                $('#Grandtotal').val(total.toFixed(2) + parseFloat($('#grandtotaltax').val()));
            } else {
                $('#discountper').val(0);
                $('#DiscountAmount').val(0);
                total = subTotal - discountamount;
                $('#Total').val(total.toFixed(2));
                $('#Grandtotal').val(total.toFixed(2) + parseFloat($('#grandtotaltax').val()));
            }
            calculateTotal();
        }
        $(document).on('blur', '#discountAmount', function() {
            calculatediscountper();
        });

        function calculatediscountper() {
            subTotal = parseFloat($('#subTotal').val());
            discountAmount = $('#discountAmount').val();
            if (discountAmount != '' && typeof(discountAmount) != "undefined") {
                discountper = (parseFloat(discountAmount) / parseFloat(subTotal)) * 100;
                $('#discountper').val(parseFloat(discountper.toFixed(2)));
                total = subTotal - discountAmount;
                $('#Total').val(total.toFixed(2));
            } else {
                $('#discountper').val(0);
                total = subTotal;
                $('#Total').val(total.toFixed(2));
            }
            $('#Grandtotal').val(total + parseFloat($('#grandtotaltax').val()));
        }
        $(document).on(' blur ', '#discountper', function() {
            calculatediscount();
        });
        $(document).on('change keyup blur   onclick', '#taxpercentage', function() {
            calculateTotal();
        });
        $(document).on('change keyup blur   onclick', '#shipping', function() {
            calculateTotal();
        });

        function calculateTotal() {
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
            // $('.totalLinePrice2').each(function() {
            //     if ($(this).val() != '') grandtotaltax += parseFloat($(this).val());
            // });
            // $('#grandtotaltax').val(grandtotaltax.toFixed(2));
            // console.log(grandtotaltax);
            discountper = $('#discountper').val();
            if (discountper != '' && typeof(discountper) != "undefined") {}
            $('#subTotal').val(subTotal.toFixed(2));
            pretotal = $('#Total').val();
            discountAmount = $('#discountAmount').val();
            tax = $('#seletedVal').val();
            grand_tax = $('#taxpercentage').val();
            // if (grand_tax != '' && typeof(grand_tax) != "undefined") {
            gt = parseFloat(pretotal) * (parseFloat(tax) / 100);
            $('#taxpercentageAmount').val(gt.toFixed(2));
            $('#grandtotaltax').val(gt.toFixed(2));
            total2 = parseFloat(subTotal) + parseFloat(gt) - parseFloat(discountAmount);
            // } else {
            //     $('#taxpercentage').val(0);
            //     total2 = subTotal - pretotal;
            // }
            shipping = parseFloat($('#shipping').val());
            shipping_grand = parseFloat(shipping) + parseFloat(total2);
            $('#Grandtotal').val(parseFloat(shipping_grand).toFixed(2));
            TaxIncExc();
        }
        $(document).on('change keyup blur', '#amountPaid', function() {
            calculateAmountDue();
        });

        function calculateAmountDue() {
            amountPaid = $('#amountPaid').val();
            total = $('#grandtotal').val();
            if (amountPaid != '' && typeof(amountPaid) != "undefined") {
                amountDue = parseFloat(total) - parseFloat(amountPaid);
                $('.amountDue').val(amountDue.toFixed(2));
            } else {
                total = parseFloat(total).toFixed(2);
                $('.amountDue').val(total);
            }
        }
        var specialKeys = new Array();
        specialKeys.push(8, 46); //Backspace
        function IsNumeric(e) {
            var keyCode = e.which ? e.which : e.keyCode;
            var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
            return ret;
        }
        $(function() {
            $.fn.datepicker.defaults.format = "dd-mm-yyyy";
            $('#invoiceDate').datepicker({
                startDate: '-3d',
                autoclose: true,
                clearBtn: true,
                todayHighlight: true
            });
        });
    </script>
    <script src="{{ asset('assets/js/jquery-3.6.0.js') }}" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(function() {
            $('#WalkinCustomer').hide();
            $('#PartyID').change(function() {
                if (this.options[this.selectedIndex].value == '1') {
                    $('#WalkinCustomer').show();
                    $('#1WalkinCustomerName').focus();
                } else {
                    $('#WalkinCustomer').hide();
                    $('#1WalkinCustomerName').val(0);
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $('#paymentdetails').hide();
            $('#PaymentMode').change(function() {
                if (this.options[this.selectedIndex].value == 'Cheque') {
                    $('#paymentdetails').show();
                    $('#PaymentDetails').focus();
                } else {
                    $('#paymentdetails').hide();
                    $('#PaymentDetails').val('');
                }
            });
        });
    </script>
    <script>
        function ajax_balance(SupplierID) {
            $('#result').prepend('')
            $('#result').prepend(
                '<img id="theImg" src="{{ asset('assets/images/ajax.gif') }}" />'
            )
            var SupplierID = SupplierID;
            if (SupplierID != "") {
                $.ajax({
                    url: "{{ URL('/Ajax_Balance') }}",
                    type: "POST",
                    data: {
                        _token: $("#csrf").val(),
                        SupplierID: SupplierID,

                    },
                    cache: false,
                    success: function(data) {
                        $('#result').html(data);
                    }
                });
            } else {
                alert('Please Select Branch');
            }
        }
    </script>
    <script>
        $(function() {
            var InvoiceType = $('#InvoiceType').val();
            if (InvoiceType != "") {
                $.ajax({
                    url: "{{ URL('/ajax_invoice_vhno') }}",
                    type: "POST",
                    data: {
                        // _token: p3WhH7hWcpfbcxtNskY1ZrCROfa3dpKp3MfEJwXu,
                        "_token": $("#csrf").val(),
                        InvoiceType: InvoiceType,
                    },
                    cache: false,
                    success: function(data) {
                        $('#invoict_type').html(data);
                    }
                });
            }
        });
    </script>
    <script>
        $("#TaxType").change(function() {
            TaxIncExc();
        });
    </script>
    <script>
        $("#InvoiceType").change(function() {
            var InvoiceType = $('#InvoiceType').val();
            if (InvoiceType != "") {
                $.ajax({
                    url: "{{ URL('/ajax_invoice_vhno') }}",
                    type: "POST",
                    data: {
                        // _token: p3WhH7hWcpfbcxtNskY1ZrCROfa3dpKp3MfEJwXu,
                        "_token": $("#csrf").val(),
                        InvoiceType: InvoiceType,
                    },
                    cache: false,
                    success: function(data) {
                        $('#invoict_type').html(data);
                    }
                });
            }
        });
    </script>
    <script type="text/javascript">
        function GetSelectedTextValue(seletedVal) {
            gTotalVal = $('#Grandtotal').val();
            // alert(gTotalVal);
            if (gTotalVal > 0) {
                var txt;
                if (confirm("Are you sure you want to update tax of complete invoice!")) {
                    txt = "You pressed OK!";
                    var TaxValue = seletedVal.value;
                    // alert(TaxValue);
                    var table_lenght = $('table tr').length;
                    // alert(table_lenght);
                    let discountamount = 0;
                    var grandsum = 0
                    var taxsum = 0;
                    for (let i = 1; i < table_lenght; i++) {
                        Qty = $('#Qty_' + i).val();
                        // alert('QTY ' + Qty);
                        Price = $('#Price_' + i).val();
                        // alert('Price ' + Price);

                        // $('#TaxID_' + i).val(TaxValue);
                        // disPerLine = parseFloat(Price) * (TaxValue / 100);
                        // $('#TaxVal_' + i).val(parseFloat(disPerLine));
                        grandsum += Qty * Price;
                        // taxsum += disPerLine;
                        $('#ItemTotal_' + i).val(Qty * Price);

                    }
                    // alert('grandSum ' + grandsum);
                    $('#subTotal').val(parseFloat(grandsum));
                    var discountper = $('#discountper').val();
                    discountamount = parseFloat(grandsum) * (parseFloat(discountper) / 100);
                    $('#discountAmount').val((discountamount.toFixed(2)));
                    $('#Total').val((parseFloat(grandsum) - parseFloat(discountamount)).toFixed(2));
                    var taxper = TaxValue;
                    taxamount = (parseFloat(grandsum) - parseFloat(discountamount)) * (parseFloat(taxper) / 100);
                    $('#grandtotaltax').val(parseFloat(taxamount.toFixed(2)));
                    $('#taxpercentageAmount').val(parseFloat(taxamount.toFixed(2)));
                    var shipping = $('#shipping').val();
                    var grandtotal = (parseFloat(grandsum) + parseFloat(taxamount) + parseFloat(shipping)) - parseFloat(
                        discountamount);
                    $('#Grandtotal').val(grandtotal.toFixed(2));
                    calculateTotal();
                } else {
                    seletedVal.value == 0 ? seletedVal.value = 5 : seletedVal.value = 0
                    return false;
                }
            } else {
                seletedVal.value = 0;
                return alert("Please create invoice first");
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $('body').addClass('sidebar-enable vertical-collpsed')
        });
    </script>
    <script src="{{ asset('assets/js/myapp.js') }}" type="text/javascript"></script>

@endsection
