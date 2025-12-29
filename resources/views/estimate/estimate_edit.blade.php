@extends('template.tmp')
@section('title', $pagetitle)

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <script src="{{ asset('assets/invoice/js/jquery-1.11.2.min.js') }}"></script>
        <script src="{{ asset('assets/invoice/js/jquery-ui.min.js') }}"></script>
        <script src="js/ajax.js"></script> -->
    <!--
        <script src="{{ asset('assets/invoice/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/invoice/js/bootstrap-datepicker.js') }}"></script>  -->


    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="{{ asset('assets/libs/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-validation.init.js') }}"></script>


    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">

    <!-- multipe image upload  -->
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link href="multiple/dist/imageuploadify.min.css" rel="stylesheet">

    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.tiny.cloud/1/u4kftdlqbljatz0bbmxi8h2z0m4vlo40fgky3rv2rb2aqsg3/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            // selector: 'textarea#CustomerNotes,textarea#DescriptionNotes',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
            toolbar: 'bold italic | bullist numlist indent outdent',
            branding: false,
            menubar: false,
            selector: "textarea.editme",
        });
    </script>
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
            /*border-radius: 0rem !important; */
            -webkit-transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;

        }


        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            vertical-align: top !important;
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
            /*border-radius: 0rem !important; */
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

        .select2-container--default .select2-results__option[aria-selected=true] {
            /*background-color: #f8f9fa;*/
            /*color: #343a40*/
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
                <!-- start page title -->
                <h3>QUOTATION</h3>
                <!-- enctype="multipart/form-data" -->
                <form action="{{ URL('/EstimateUpdate') }}" method="post" class="custom-validation">


                    <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                    <input type="hidden" name="EstimateMasterID" value="{{ request()->id }}">

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
                                                <?php foreach ($party as $key => $value) : ?>
                                                <option value="{{ $value->PartyID }}"
                                                    {{ $value->PartyID == $estimate_master[0]->PartyID ? 'selected=selected' : '' }}>
                                                    {{ $value->PartyName }}</option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-1 row " id="WalkinCustomer">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-danger" for="password">Walkin Customer
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="WalkinCustomerName"
                                                value="" placeholder="Walkin cusomter" id="1WalkinCustomerName">

                                        </div>
                                    </div>
                                    <div class="mb-1 row d-none">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">Salesperson </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="UserID" id="UserID" class="form-select select2"
                                                style="width:100%;>
                                            <option value="">Select
                                                </option>
                                                <?php foreach ($user as $key => $value) : ?>
                                                <option value="{{ $value->id }}"
                                                    {{ $value->id == $estimate_master[0]->UserID ? 'selected=selected' : '' }}>
                                                    {{ $value->name }}</option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-1 row d-none">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">Subject </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="first-name" class="form-control" name="Subject"
                                                value=""
                                                placeholder="Let your customer know what this invoice is for">

                                        </div>
                                    </div>
                                    <div class="mb-1 row d-none">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">Tax</label>
                                        </div>

                                        <div class="col-sm-9">
                                            <select name="UserI D" id="seletedVal" class="form-select select2"
                                                onchange="GetSelectedTextValue(this.value)" style="width: 100%;">
                                                <?php foreach ($tax as $key => $valueX1) : ?>
                                                <option value="{{ $valueX1->TaxPer }}">{{ $valueX1->Description }}
                                                </option>
                                                <?php endforeach ?>

                                            </select>
                                        </div>



                                    </div>


                                    <div class="mb-1 row d-none">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">Inquiry Date </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="date" id="first-name" class="form-control" name="InquiryDate"
                                                value="{{ $estimate_master[0]->InquiryDate }}"
                                                placeholder="Let your customer know what this invoice is for">
                                        </div>
                                    </div>

                                    <div class="mb-1 row d-none">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">Inquiry #</label>
                                        </div>

                                        <div class="col-sm-9">
                                            <input type="text" id="first-name" class="form-control" name="InquiryNo"
                                                value="{{ $estimate_master[0]->InquiryNo }}">
                                        </div>



                                    </div>

                                    <div class="mb-1 row d-none">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">Equipment/User Plant </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="first-name" class="form-control"
                                                name="EquipmentUser_PlantSite"
                                                value="{{ $estimate_master[0]->EquipmentUser_PlantSite }}">
                                        </div>
                                    </div>

                                    <div class="mb-1 row d-none">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">VendorReference </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="first-name" class="form-control"
                                                name="VendorReference"
                                                value="{{ $estimate_master[0]->VendorReference }}">
                                        </div>
                                    </div>

                                    <div class="mb-1 row d-none">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">OriginMaterial </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="first-name" class="form-control"
                                                name="OriginMaterial" value="{{ $estimate_master[0]->OriginMaterial }}">
                                        </div>
                                    </div>











                                    <div class="mb-1 row ">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">Item Rates Are </label>
                                        </div>

                                        <div class="col-sm-9">
                                            <select name="TaxType" id="TaxType" class="form-select">
                                               
                                                <option value="TaxInclusive"
                                                    {{ $estimate_master[0]->TaxType == 'TaxInclusive' ? 'selected=selected' : '' }}>
                                                    Tax Inclusive</option>
                                                <option value="TaxExclusive"
                                                    {{ $estimate_master[0]->TaxType == 'TaxExclusive' ? 'selected=selected' : '' }}>
                                                    Tax Exclusive</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label text-danger" for="password">Branch </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select name="BranchID" id="BranchID" class="form-select">
                                                    <?php foreach ($branch as $key => $value) : ?>
                                                    <option value="{{ $value->BranchID }}"
                                                        {{ $value->BranchID == $estimate_master[0]->BranchID ? 'selected=selected' : '' }}>
                                                        {{ $value->BranchName }}</option>
                                                    <?php endforeach ?>
                                                </select>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label text-danger" for="password">Quotation #
                                                </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <div id="invoict_type"> <input type="text" name="EstimateNo"
                                                        autocomplete="off" id="EstimateNo" class="form-control"
                                                        required="" value="{{ $estimate_master[0]->EstimateNo }}">
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="email-id"> Quotation Date</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="input-group" id="datepicker21">
                                                    <input type="text" name="Date" autocomplete="off"
                                                        class="form-control" placeholder="yyyy-mm-dd"
                                                        data-date-format="yyyy-mm-dd" data-date-container="#datepicker21"
                                                        data-provide="datepicker" data-date-autoclose="true"
                                                        value="{{ $estimate_master[0]->Date }}">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
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
                                                    <input type="text" name="ExpiryDate" autocomplete="off"
                                                        class="form-control" placeholder="yyyy-mm-dd"
                                                        data-date-format="yyyy-mm-dd" data-date-container="#datepicker22"
                                                        data-provide="datepicker" data-date-autoclose="true"
                                                        value="{{ $estimate_master[0]->ExpiryDate }}">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="password">Reference # </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="ReferenceNo" autocomplete="off"
                                                    class="form-control" value="{{ $estimate_master[0]->ReferenceNo }}">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 d-none">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="password">Country </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="Country" autocomplete="off"
                                                    class="form-control" value="{{ $estimate_master[0]->Country }}">

                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12 d-none">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="password">Equipment </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="Equipment" autocomplete="off"
                                                    class="form-control" value="{{ $estimate_master[0]->Equipment }}">

                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12 d-none">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="password">Type </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="Type" autocomplete="off"
                                                    class="form-control" value="{{ $estimate_master[0]->Type }}">

                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12 d-none">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="password">Sectional Assembly Group
                                                </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="SectionalAssemblyGroup" autocomplete="off"
                                                    class="form-control"
                                                    value="{{ $estimate_master[0]->SectionalAssemblyGroup }}">

                                            </div>
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

                            <div class='text-center'>

                            </div>
                            <div class='row'>
                                <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                                    <table>
                                        <thead>
                                            <tr class=" borde-1 border-light " style="height: 40px;">
                                                <th width="1%" align="center"><input id="check_all"
                                                        type="checkbox" /></th>
                                                <th width="1%">ITEM DETAILS </th>

                                                <th width="4%" class="d-none">UNIT</th>
                                                <th width="4%" class="d-none">UNIT/Qty</th>
                                                <th width="4%">QUANTITY</th>
                                                <th width="4%">RATE</th>
                                                <th width="8%" class="d-none">DISCOUNT</th>
                                                <th width="4%">Value for Tax</th>
                                                <th width="4%">Tax</th>
                                                <th width="4%">Tax Val</th>

                                                <th width="4%">AMOUNT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 0;
                                            @endphp

                                            <!-- start of loop -->
                                            @foreach ($estimate_detail as $key => $value1)
                                                @php

                                                    $no = $no + $key;

                                                @endphp
                                                <!-- start of loop -->

                                                <tr class="p-3">
                                                    <td bordercolor="1" valign="top" align="left"><input
                                                            class="case" type="checkbox" /></td>

                                                    <td valign="top">
                                                        <select name="services_id[]" id="services_id_{{ $no }}"
                                                            class="item form-select  form-control-sm select2 "
                                                            style="width: 300px !important; margin-bottom: 5px;">
                                                            <option value="">select</option>
                                                            @foreach ($services as $key => $value)
                                                                <option @if ($value->id == $value1->services_id) selected @endif
                                                                    value="{{ $value->id }}">
                                                                    {{ $value->name }}</option>
                                                            @endforeach
                                                        </select>




                                                        <input type="hidden" name="ItemID[]"
                                                            id="ItemID_{{ $no }}"
                                                            value="{{ $value1->ItemID }}">

                                                        <textarea name="Description[]" id="Description[]" rows="2" class="form-control mt-1 kashif"
                                                            style="width: 300px !important;">{{ $value1->Description }}</textarea>
                                                    </td>



                                                    <td valign="top" class="d-none">
                                                        <input type="number" name="UnitQty[]"
                                                            id="UnitQty_{{ $no }}"
                                                            class=" form-control changesNo  " autocomplete="off"
                                                            onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                            onpaste="return false;" step="0.01"
                                                            value="{{ $value1->UnitQty }}">
                                                    </td>


                                                    <td valign="top">
                                                        <input type="number" name="Qty[]"
                                                            id="Qty_{{ $no }}"
                                                            class=" form-control changesNo QtyTotal" autocomplete="off"
                                                            onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                            onpaste="return false;" step="0.01"
                                                            value="{{ $value1->Qty }}"> <select
                                                            class="form-select mt-1 d-none" name="LS[]"
                                                            id="LS_{{ $no }}">
                                                            <option value="YES"
                                                                {{ $value1->LS == 'YES' ? 'selected=selected' : '' }}> L/S
                                                                YES</option>
                                                            <option value="NO"
                                                                {{ $value1->LS == 'NO' ? 'selected=selected' : '' }}>LS /
                                                                NO
                                                            </option>
                                                        </select>
                                                    </td>

                                                    <td valign="top">
                                                        <input type="number" name="Price[]"
                                                            id="Price_{{ $no }}"
                                                            class=" form-control changesNo" autocomplete="off"
                                                            onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                            onpaste="return false;" step="0.01"
                                                            value="{{ $value1->Rate }}">
                                                    </td>
                                                    <td valign="top" class="d-none">


                                                        <div class="input-group" class="d-none">
                                                            <input type="text" name="Discount[]"
                                                                id="Discount_{{ $no }}"
                                                                class=" form-control changesNo" autocomplete="off"
                                                                onkeypress="return IsNumeric(event);"
                                                                ondrop="return false;" onpaste="return false;"
                                                                step="0.01" value="0">
                                                            <span>
                                                                <!-- <div class="col-sm-3">
                                                <label class="col-form-label" for="password">Salesperson </label>
                                            </div> -->
                                                                <div class="col-sm-9 input-group">
                                                                    <select name="DiscountType[]"
                                                                        id="DiscountType_{{ $no }}"
                                                                        class="form-select  changesNo bg-light">

                                                                        <option value="1">%</option>
                                                                        <option value="2">
                                                                            {{ session::get('Currency') }}</option>

                                                                    </select>
                                                                    <input type="hidden" name="DiscountAmountItem[]"
                                                                        id="DiscountAmount_{{ $no }}"
                                                                        value="0">
                                                                </div>
                                                            </span>

                                                        </div>


                                                    </td>
                                                    <td valign="top">
                                                        <input type="number" name="Gross[]"
                                                            id="Gross_{{ $no }}"
                                                            class=" form-control changesNo" autocomplete="off"
                                                            onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                            onpaste="return false;" step="0.01"
                                                            value="{{ $value1->Gross }}">
                                                    </td>
                                                    <td valign="top">
                                                        <select name="Tax[]" id="TaxID_{{ $no }}"
                                                            required=""
                                                            class="form-select  changesNo tax exclusive_cal bg-light">
                                                            <?php foreach ($tax as $key => $valueX1) : ?>
                                                            <option value="{{ $valueX1->TaxPer }}"
                                                                {{ $valueX1->TaxPer == $value1->TaxPer ? 'selected=selected' : '' }}>
                                                                {{ $valueX1->Description }}</option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </td>
                                                    <td valign="top">
                                                        <input type="number" name="TaxVal[]"
                                                            id="TaxVal_{{ $no }}"
                                                            class=" form-control totalLinePrice2" autocomplete="off"
                                                            onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                            onpaste="return false;" step="0.01"
                                                            value="{{ $value1->Tax }}">
                                                    </td>

                                                    <td valign="top">
                                                        <input type="number" name="ItemTotal[]"
                                                            id="ItemTotal_{{ $no }}"
                                                            class=" form-control totalLinePrice " autocomplete="off"
                                                            onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                            onpaste="return false;" step="0.01"
                                                            value="{{ $value1->Total }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <!-- end of loop  -->

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-1 mb-2" style="margin-left: 21px;">
                                <div class='col-xs-5 col-sm-3 col-md-3 col-lg-3  '>
                                    <button class="btn btn-danger delete" type="button"><i
                                            class="bx bx-trash align-middle font-medium-3 me-25"></i>Delete</button>
                                    <button class="btn btn-success addmore" type="button"><i
                                            class="bx bx-list-plus align-middle font-medium-3 me-25"></i> Add More</button>

                                </div>

                                <div class='col-xs-5 col-sm-3 col-md-3 col-lg-3  '>
                                    <div id="result"></div>
                                    <div id="QtyTotal" class="form-control"
                                        style="border: 1px dashed red; width: 112px;"></div>

                                </div>
                                <br>

                            </div>


                            <div class="row mt-4">

                                <div class="col-lg-8 col-12  ">
                                    


                                    <textarea class="form-control editme" rows='5' name="CustomerNotes" id="note" placeholder="">{!! $estimate_master[0]->CustomerNotes !!}</textarea>





                                    

                                    <script src="{{ URL('/assets/js/tinymce.min.js') }}"></script>
                                    <script id="rendered-js">
                                        tinymce.init({
                                            selector: "textarea:not(.kashif)", // Select all textarea exluding the mceNoEditor class
                                            height: 600,
                                            menubar: false,
                                            plugins: [
                                                'advlist autolink lists link image charmap print preview anchor textcolor',
                                                'searchreplace visualblocks code fullscreen',
                                                'insertdatetime media table contextmenu paste code help wordcount'
                                            ],
                                            mobile: {
                                                theme: 'mobile'
                                            },
                                            toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
                                            content_css: [
                                                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                                                '//www.tiny.cloud/css/codepen.min.css'
                                            ],
                                        });
                                        //# sourceURL=pen.js
                                    </script>

                                    <div class="mt-2"><button type="submit"
                                            class="btn btn-success w-md float-right">Save</button>
                                        <a href="{{ URL('/Estimate') }}"
                                            class="btn btn-secondary w-md float-right">Cancel</a>

                                    </div>







                                </div>


                                <div class="col-lg-4 col-12 ">
                                    <!-- <input type="text" class="form-control" id="TotalTaxAmount" name="TaxTotal" placeholder="TaxTotal" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"> -->
                                    <form class="form-inline">
                                        <div class="form-group mt-1">
                                            <label>Grand Total Tax: &nbsp;</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>

                                                <input type="text" class="form-control" id="grandtotaltax"
                                                    name="grandtotaltax" placeholder="Subtotal"
                                                    onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                    onpaste="return false;" value="{{ $estimate_master[0]->Tax }}">
                                            </div>
                                        </div>
                                        <div class="form-group mt-1">
                                            <label>Sub Total1: &nbsp;</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>

                                                <input type="text" class="form-control" id="subTotal"
                                                    name="SubTotal" placeholder="Subtotal"
                                                    onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                    onpaste="return false;" value="{{ $estimate_master[0]->SubTotal }}">
                                            </div>
                                        </div>
                                        <div class="form-group mt-1">
                                            <label>Discount: &nbsp;</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">%</span>

                                                <input type="text" class="form-control" value="0"
                                                    id="discountper" name="DiscountPer" placeholder="Tax"
                                                    onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                    onpaste="return false;"
                                                    value="{{ $estimate_master[0]->DiscountPer }}">

                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>

                                                <input type="text" name="DiscountAmount" class="form-control"
                                                    id="discountAmount" onkeypress="return IsNumeric(event);"
                                                    ondrop="return false;" onpaste="return false;"
                                                    value="{{ $estimate_master[0]->Discount }}">
                                            </div>
                                        </div>



                                        <div class="form-group mt-1">

                                            <label>Total: &nbsp;</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input type="number" name="Total" id="Total" class="form-control"
                                                    step="0.01" id="totalafterdisc" placeholder="Total"
                                                    onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                    onpaste="return false;" value="{{ $estimate_master[0]->Total }}">
                                            </div>
                                        </div>


                                        <div class="form-group mt-1 d-none ">

                                            <label>Shipping: &nbsp;</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input type="number" name="Shipping" class="form-control"
                                                    step="0.01" id="shipping" placeholder="Grand Total"
                                                    onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                    onpaste="return false;" value="0">
                                            </div>
                                        </div>

                                        <div class="form-group mt-1">

                                            <label>Grand Total: &nbsp;</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input type="number" name="Grandtotal" id="Grandtotal"
                                                    class="form-control" step="0.01" id="grandtotal"
                                                    placeholder="Grand Total" onkeypress="return IsNumeric(event);"
                                                    ondrop="return false;" onpaste="return false;"
                                                    value="{{ $estimate_master[0]->GrandTotal }}">
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

                                        <div class="form-group mt-1">

                                            <!--                                         <label>Payment Plan: &nbsp;</label>
                                                
                                                   <table id="paymentTable">
                <thead>
                    <tr>
                        <th>Payment Percentage</th>
                        <th> </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($payment_plan as $value) --}}
                    <tr>
                        <td><input type="text" class="paymentPercentage" name="PaymentPercentage[]" /></td>
                        <td><input type="hidden" class="amount" id="amount" /></td>
                        <td><button class="deleteRowBtn btn btn-danger btn-sm" type="button" > <i class="bx bx-trash align-middle font-medium-3 me-25"></i>Delete</button></td>
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
                <tfoot>
                    <tr>
                        <td><strong>Total Percentage:</strong> <span id="totalPercentage">0</span>%</td>
                        <td></td>
                        <td><button class="btn btn-success btn-sm" type="button" id="addRowBtn"><i class="bx bx-list-plus align-middle font-medium-3 me-25"></i> Add </button></td>
                    </tr>
                </tfoot>
            </table> -->



                                            <script>
                                                $(document).ready(function() {
                                                    function calculateTotalPercentage() {
                                                        let total = 0;
                                                        $(".paymentPercentage").each(function() {
                                                            let val = parseFloat($(this).val());
                                                            if (!isNaN(val)) {
                                                                total += val;
                                                            }
                                                        });
                                                        if (total > 100) {
                                                            alert("Total percentage cannot exceed 100%");
                                                            return false;
                                                        }
                                                        $("#totalPercentage").text(total.toFixed(2));
                                                        return true;
                                                    }

                                                    $("#addRowBtn").click(function() {
                                                        var newRow = `<tr>
                                                            <td><input type="text" class="paymentPercentage" name="PaymentPercentage[]"/></td>
                                                            <td><input type="hidden" class="amount" /></td>
                                                            <td><button class="deleteRowBtn btn btn-danger btn-sm"><i class="bx bx-trash align-middle font-medium-3 me-25"></i> Delete</button></td>
                                                        </tr>`;
                                                        $("#paymentTable tbody").append(newRow);
                                                    });

                                                    $(document).on("click", ".deleteRowBtn", function() {
                                                        $(this).closest("tr").remove();
                                                        calculateTotalPercentage();
                                                    });

                                                    $(document).on("input", ".paymentPercentage", function() {


                                                        $('#Total').val(505);

                                                        if (!calculateTotalPercentage()) {


                                                            $(this).val('');
                                                            calculateTotalPercentage();
                                                        }
                                                    });
                                                });
                                            </script>

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

            html = '<tr class= borde-1 border-light">';
            html += '<td valign="top" class="text-left"><input class="case" type="checkbox"/></td>';
            html += `
                    <td>
                        <select name="services_id[]" id="services_id_${i}" 
                                class="item form-select form-control-sm select2"  
                                style="width: 300px !important; margin-bottom: 5px;">
                            <option value="">select</option>
                            @foreach ($services as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="ItemID[]" id="ItemID_${i}">
                        <textarea name="Description[]" id="Description[]" 
                                rows="2" class="form-control mt-1 kashif" 
                                style="width: 300px !important;">
                        </textarea>
                    </td>`;


            html += ' <td valign="top" class="d-none"><select name="UnitName[]" id="UnitName_' + i +
                '" class="form-select">                                          @foreach ($unit as $value)     <option value="{{ $value->UnitName }}">{{ $value->UnitName }}</option>                                              @endforeach                                          </select></td>                                             ';

            html += '<td valign="top" class="d-none"> <input type="number" name="UnitQty[]" id="UnitQty_' + i +
                '" class=" form-control changesNo " autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" step="0.01" value="">                                            </td>';


            html += '<td valign="top"><input type="text" name="Qty[]" id="Qty_' + i +
                '" class="form-control changesNo QtyTotal" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" value="1"> <select  class="form-select mt-1 d-none" name="LS[]" id="LS_' +
                i +
                '"><option value="NO">LS / NO</option><option value="YES"> L/S YES</option>            </select></td>';

            html += '<td valign="top"><input type="text" name="Price[]" id="Price_' + i +
                '" class="form-control changesNo " autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
            html +=
                '<td valign="top" class="d-none"><div class="input-group"><input type="text" name="Discount[]" id="Discount_' +
                i +
                '" class=" form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" step="0.01" value="0"><span ><div class="col-sm-9 input-group"><select name="DiscountType[]" id="DiscountType_' +
                i +
                '" class="form-select  changesNo bg-light"  ><option  value="1">%</option><option  value="2">{{ session::get('Currency') }}</option></select><input type="hidden" name="DiscountAmountItem[]" value="0" id="DiscountAmount_' +
                i + '"></div></span></div></td>';

            html += '<td  valign="top"> <input type="number" name="Gross[]" id="Gross_' + i +
                '" class=" form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" step="0.01">  </td>';

            html += '<td  valign="top"><select name="Tax[]" id="TaxID_' + i +
                '" class="form-control changesNo exclusive_cal bg-light"><?php foreach ($tax as $key => $valueX1) : ?><option value="{{ $valueX1->TaxPer }}">{{ $valueX1->Description }}</option><?php endforeach ?></select></td>';


            html += '<td  valign="top"><input type="number" name="TaxVal[]" id="TaxVal_' + i +
                '" class=" form-control totalLinePrice2 "autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" step="0.01" value="0"></td>';




            html += '<td  valign="top"><input type="text" name="ItemTotal[]" id="ItemTotal_' + i +
                '" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';

            html += '</tr>';
            i++;
            $('table').append(html);
            $('.select2', 'table').select2();




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

            var data = <?php echo $item; ?>;
            // console.log(data);

            // console.log( "readaay!" );

            var data = <?php echo $item; ?> // this is dynamic data in json_encode(); from controller

            // console.log($('#ItemID_' + id[1]).val());


            var item_idd = $('#ItemID_' + id[1]).val();
            // console.log(item_idd);
            var index = -1;
            var val = parseInt(item_idd);
            var json = data.find(function(item, i) {
                if (item.ItemID === val) {
                    index = i + 1;
                    return i + 1;
                }
            });





            $('#Price_' + id[1]).val(json["SellingPrice"]);
            $('#TaxID_' + id[1]).val(json["Percentage"]);


            var Qty = $('#Qty_' + id[1]).val();
            var Price = $('#Price_' + id[1]).val();

            var UnitName = json["UnitName"];
            var UnitQty = json["UnitQty"];


            if (UnitName == 'pcs') {
                UnitQty = 1;

            }



            $('#UnitName_' + id[1]).val(json["UnitName"]).change();
            $('#UnitQty_' + id[1]).val(json["UnitQty"]).change();


            var QtyRate = parseFloat(Price) * parseFloat(UnitQty);





            var DiscountType = $('#DiscountType_' + id[1]).val();



            var Discount = $('#Discount_' + id[1]).val();




            if (DiscountType == 1) {


                var DiscountCalculated = (parseFloat(QtyRate) * parseFloat(Discount) / 100);
            } else {
                var DiscountCalculated = parseFloat(Discount) * parseFloat(Qty);
            }

            $('#DiscountAmount_' + id[1]).val(DiscountCalculated);


            var Gross = parseFloat(QtyRate) - parseFloat(DiscountCalculated);

            $('#Gross_' + id[1]).val(Gross);


            var TaxID = $('#TaxID_' + id[1]).val();

            var TaxCalculation = ((parseFloat(Gross) * parseFloat(TaxID)) / 100).toFixed(2);

            $('#TaxVal_' + id[1]).val(TaxCalculation);


            var ItemTotal = parseFloat(Gross) - parseFloat(TaxCalculation);

            $('#ItemTotal_' + id[1]).val(ItemTotal);



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







        //deletes the selected table rows
        $(".delete").on('click', function() {
            $('.case:checkbox:checked').parents("tr").remove();
            $('#check_all').prop("checked", false);
            calculatediscount();
            calculateTotal();
            TaxIncExc();
        });


        //Calculate qty
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


        //price change
        $(document).on('change keyup blur ', '.changesNo', function() {



            singlerowcalculation($(this).attr('id'));





            calculatediscount();
            calculateTotal();
            TaxIncExc();
        });

        //////////

        function singlerowcalculation(idd) {
            TaxIncExc();
            id_arr = idd;
            id = id_arr.split("_");

            Qty = $('#Qty_' + id[1]).val();

            TaxPer = $('#TaxID_' + id[1]).val();

            Price = $('#Price_' + id[1]).val();
            UnitQty = 1;




            var Qty = $('#Qty_' + id[1]).val();
            var Price = $('#Price_' + id[1]).val();
            var QtyRate = parseFloat(Price) * parseFloat(UnitQty * Qty);







            var DiscountType = $('#DiscountType_' + id[1]).val();



            var Discount = $('#Discount_' + id[1]).val();




            if (DiscountType == 1) {


                var DiscountCalculated = (parseFloat(QtyRate) * parseFloat(Discount) / 100);
            } else {
                var DiscountCalculated = parseFloat(Discount) * parseFloat(Qty);
            }

            $('#DiscountAmount_' + id[1]).val(DiscountCalculated);


            var Gross = parseFloat(QtyRate) - parseFloat(DiscountCalculated);

            $('#Gross_' + id[1]).val(Gross);


            var TaxID = $('#TaxID_' + id[1]).val();

            var TaxCalculation = (parseFloat(Gross) * parseFloat(TaxID)) / 100;

            $('#TaxVal_' + id[1]).val(TaxCalculation);


            $('#ItemTotal_' + id[1]).val(Gross - TaxCalculation);

            var grandtotaltax = 0;

            $('.totalLinePrice2').each(function() {
                if ($(this).val() != '') grandtotaltax += parseFloat($(this).val());
            });

            $('#grandtotaltax').val(parseFloat(grandtotaltax));


            TaxIncExc();




        }

        // 

        function TaxIncExc() {
            var TaxType = $('#TaxType').val();
            // var subTotal = $('#subTotal').val();
            var DiscountAmount = $('#discountAmount').val();
            var grandtotaltax = 0;

            var shipping = $('#shipping').val();



            var table_lenght = $('table tr').length - 1;


            var Qty = 0
            var Price = 0;
            var TaxVal = 0;
            var Gross = 0;
            for (let i = 1; i <= table_lenght; i++) {

                Qty = $('#Qty_' + i).val();
                Price = $('#Price_' + i).val();
                TaxVal = $('#TaxVal_' + i).val();
                Gross = $('#Gross_' + i).val();

                $('#ItemTotal_' + i).val(parseFloat(Gross));

            }



            $('.totalLinePrice2').each(function() {
                if ($(this).val() != '') grandtotaltax += parseFloat($(this).val());
            });

            subTotal = 0;
            $('.totalLinePrice').each(function() {
                if ($(this).val() != '') subTotal += parseFloat($(this).val());
            });



            if (TaxType == 'TaxInclusive') {

                subTotal1 = parseFloat(subTotal) - parseFloat(grandtotaltax);
                $('#subTotal').val(subTotal1);

                var Total = parseFloat(subTotal1) - parseFloat(DiscountAmount).toFixed(2);

                $('#Total').val(parseFloat(Total));
                $('#Grandtotal').val(parseFloat(Total) + parseFloat(grandtotaltax));

            } else {

                $('#subTotal').val(parseFloat(subTotal));

                var Total = parseFloat(subTotal) - parseFloat(DiscountAmount).toFixed(2);
                var Grandtotal = ((parseFloat(Total) + parseFloat(grandtotaltax))).toFixed(2);


                $('#Total').val(Total);
                $('#Grandtotal').val(Grandtotal);

            }


            $('#Grandtotal').val(parseFloat($('#Grandtotal').val()) + parseFloat(shipping));





        }


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
                // alert('dd');
                $('#DiscountAmount').val(0);


                total = subTotal - discountamount;
                $('#Total').val(total.toFixed(2));
                $('#Grandtotal').val(total.toFixed(2) + parseFloat($('#grandtotaltax').val()));


            }

            calculateTotal();
        }


        $(document).on('blur', '#discountAmount', function() {


            // calculatediscountper();


        });

        function calculatediscountper() {

            subTotal = parseFloat($('#subTotal').val());


            discountAmount = $('#discountAmount').val();
            // totalafterdisc = $('#totalAftertax').val();
            // console.log('testing'.totalAftertax);
            if (discountAmount != '' && typeof(discountAmount) != "undefined") {
                discountper = (parseFloat(discountAmount) / parseFloat(subTotal)) * 100;

                $('#discountper').val(parseFloat(discountper.toFixed(2)));

                total = subTotal - discountAmount;
                $('#Total').val(total.toFixed(2));

                // $('#grandtotal').val(total.toFixed(2));

            } else {
                $('#discountper').val(0);
                // alert('dd');
                // $('#discountper').val(0);
                total = subTotal;
                $('#Total').val(total.toFixed(2));

            }

            $('#Grandtotal').val(total + parseFloat($('#grandtotaltax').val()));

        }

        //////////////////

        // discount percentage
        $(document).on(' blur ', '#discountper', function() {
            calculatediscount();


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


            subTotal = $('#subTotal').val();
            grandtotaltax = $('#grandtotaltax').val();
            discountAmount = $('#discountAmount').val();
            shipping = $('#shipping').val();
            Total = parseFloat(subTotal) - parseFloat(discountAmount);


            Grandtotal = parseFloat(Total) + parseFloat(grandtotaltax) + parseFloat(shipping);

            $('#Total').val(Total);
            $('#Grandtotal').val(Grandtotal);



        }




        $(document).on('change keyup blur', '#amountPaid', function() {
            calculateAmountDue();
        });

        //due amount calculation
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


        //It restrict the non-numbers
        var specialKeys = new Array();
        specialKeys.push(8, 46); //Backspace
        function IsNumeric(e) {
            var keyCode = e.which ? e.which : e.keyCode;
            // console.log(keyCode);
            var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
            return ret;
        }

        //datepicker
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
        //<![CDATA[


        $(function() {
            $('#WalkinCustomer').hide();
            $('#PartyID').change(function() {

                if (this.options[this.selectedIndex].value == '1') {
                    // alert('dd');

                    $('#WalkinCustomer').show();
                    $('#1WalkinCustomerName').focus();

                } else {
                    $('#WalkinCustomer').hide();
                    $('#1WalkinCustomerName').val(0);
                }
            });
        });


        //]]>
    </script>
    <script type="text/javascript">
        //<![CDATA[


        $(function() {
            $('#paymentdetails').hide();
            $('#PaymentMode').change(function() {

                if (this.options[this.selectedIndex].value == 'Cheque') {
                    // alert('dd');

                    $('#paymentdetails').show();
                    $('#PaymentDetails').focus();

                } else {
                    $('#paymentdetails').hide();
                    $('#PaymentDetails').val('');
                }
            });
        });


        //]]>
    </script>
    <!-- ajax trigger -->
    <script>
        function ajax_balance(SupplierID) {

            // alert($("#csrf").val());

            $('#result').prepend('')
            $('#result').prepend(
                '<img id="theImg" src="{{ asset('
                                        assets / images / ajax.gif ') }}" />')

            var SupplierID = SupplierID;

            // alert(SupplierID);
            if (SupplierID != "") {
                /*  $("#butsave").attr("disabled", "disabled"); */
                // alert(SupplierID);
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
        $("#BranchID").change(function() {


            var BranchID = $('#BranchID').val();

            console.log(BranchID);
            if (BranchID != "") {
                /*  $("#butsave").attr("disabled", "disabled"); */
                // alert('next stage if else');
                // console.log(InvoiceType);

                $.ajax({

                    url: "{{ URL('/ajax_estimate_vhno') }}",
                    type: "POST",
                    data: {
                        // _token: p3WhH7hWcpfbcxtNskY1ZrCROfa3dpKp3MfEJwXu,
                        "_token": $("#csrf").val(),
                        BranchID: BranchID,

                    },
                    cache: false,

                    success: function(data) {

                        // alert(data.vhno);
                        $('#EstimateNo').val(data.vhno);



                    }
                });
            }


        });
    </script>


    <script>
        $(document).ready(function() {

            var BranchID = $('#BranchID').val();

            console.log(BranchID);
            if (BranchID != "") {
                /*  $("#butsave").attr("disabled", "disabled"); */
                // alert('next stage if else');
                // console.log(InvoiceType);

                $.ajax({

                    url: "{{ URL('/ajax_estimate_vhno') }}",
                    type: "POST",
                    data: {
                        // _token: p3WhH7hWcpfbcxtNskY1ZrCROfa3dpKp3MfEJwXu,
                        "_token": $("#csrf").val(),
                        BranchID: BranchID,

                    },
                    cache: false,

                    success: function(data) {

                        // alert(data.vhno);
                        // $('#EstimateNo').val(data.vhno);



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





    <script type="text/javascript">
        function GetSelectedTextValue(seletedVal) {
            gTotalVal = $('#grandtotal').val();
            if (gTotalVal) {


                var txt;
                if (confirm("Are you sure you want to update tax of complete invoice!")) {
                    txt = "You pressed OK!";

                    var TaxValue = seletedVal.value;

                    var table_lenght = $('table tr').length;
                    let discountamount = 0;


                    var grandsum = 0
                    var taxsum = 0;
                    for (let i = 1; i < table_lenght; i++) {
                        Qty = $('#Qty_' + i).val();
                        Price = $('#Price_' + i).val();


                        $('#TaxID_' + i).val(TaxValue);
                        disPerLine = parseFloat(Price) * (TaxValue / 100);
                        $('#TaxVal_' + i).val(parseFloat(disPerLine));

                        grandsum += (Qty * Price) + disPerLine;
                        taxsum += disPerLine;

                        $('#ItemTotal_' + i).val((Qty * Price) + disPerLine);

                    }
                    $('#grandtotaltax').val(parseFloat(taxsum));
                    // assigning subtotal value
                    $('#subTotal').val(parseFloat(grandsum));


                    // fetching discount percentage
                    var discountper = $('#discountper').val();
                    // calculating discount amount
                    discountamount = parseFloat(grandsum) * (parseFloat(discountper) / 100);
                    $('#discountAmount').val(parseFloat(discountamount));
                    //amount after discount
                    $('#totalafterdisc').val(parseFloat(grandsum) - parseFloat(discountamount));

                    // fetching percentage of tax
                    var taxper = $('#taxpercentage').val();
                    // calculating percentage amount
                    taxamount = parseFloat(grandsum) * (parseFloat(taxper) / 100);
                    $('#taxpercentageAmount').val(parseFloat(taxamount));

                    //calculating shiping cost
                    var shipping = $('#shipping').val();



                    var grandtotal = (parseFloat(grandsum) + parseFloat(taxamount) + parseFloat(shipping)) - parseFloat(
                        discountamount);
                    // Calculating grandtotal
                    $('#grandtotal').val(grandtotal);
                    // alert(discountamount);
                } else {
                    $('#seletedVal').val('select');
                }

            } else {
                return alert("Please create invoice first");
            }

            calculatediscount();
            calculateTotal();


        }
    </script>


    <script>
        $(document).ready(function() {
            $('body').addClass('sidebar-enable vertical-collpsed')

        });
    </script>

    <script src="{{ asset('assets/js/myapp.js') }}" type="text/javascript"></script>

    <!-- END: Content-->

@endsection
