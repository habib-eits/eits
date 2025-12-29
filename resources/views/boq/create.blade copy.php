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

        /* Targeting the Select2 dropdown */
        .select2-container--default .select2-results__options {
            max-height: 200px;
            /* Adjust the max-height as needed */
            overflow-y: auto;
        }

        /* Webkit-based browsers (Chrome, Safari, Edge) */
        .select2-container--default .select2-results__options::-webkit-scrollbar {
            width: 8px;
            /* Adjust width as needed */
        }

        .select2-container--default .select2-results__options::-webkit-scrollbar-track {
            background: #f1f1f1;
            /* Light grey background for the track */
        }

        .select2-container--default .select2-results__options::-webkit-scrollbar-thumb {
            background-color: #888;
            /* Grey color for the thumb */
            border-radius: 10px;
            /* Optional: round the corners of the thumb */
        }

        .select2-container--default .select2-results__options::-webkit-scrollbar-thumb:hover {
            background: #555;
            /* Darker grey on hover */
        }

        /* Firefox */
        .select2-container--default .select2-results__options {
            scrollbar-width: thin;
            /* Makes the scrollbar thinner */
            scrollbar-color: #888 #f1f1f1;
            /* Thumb color and track color */
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
                <h3>BOQ</h3>
                <!-- enctype="multipart/form-data" -->
                <form action="{{ route('boq.store') }}" method="post" class="custom-validation">
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
                                                <?php foreach ($party as $key => $value) : ?>
                                                <option value="{{ $value->PartyID }}">{{ $value->PartyName }}</option>
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
                                   

                                   

                                    <div class="mb-1 row d-none ">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">Inquiry #</label>
                                        </div>

                                        <div class="col-sm-9">
                                            <input type="text" id="first-name" class="form-control" name="InquiryNo">
                                        </div>



                                    </div>

                                    <div class="mb-1 row d-none">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">Equipment/User Plant </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="first-name" class="form-control"
                                                name="EquipmentUser_PlantSite">
                                        </div>
                                    </div>

                                    <div class="mb-1 row d-none">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">VendorReference </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="first-name" class="form-control"
                                                name="VendorReference">
                                        </div>
                                    </div>

                                    <div class="mb-1 row d-none">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">OriginMaterial </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="first-name" class="form-control"
                                                name="OriginMaterial">
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
                                                    <option value="{{ $value->BranchID }}">{{ $value->BranchName }}
                                                    </option>
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
                                                        required="" >
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
                                                        value="{{ date('Y-m-d') }}">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <select name="" id=""></select>
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
                                                <label class="col-form-label" for="password">Reference # </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="ReferenceNo" autocomplete="off"
                                                    value="{{ $referanceNo }}" class="form-control">

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
                                                    class="form-control">

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
                                                    class="form-control">

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
                                                    class="form-control">

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
                                                    class="form-control">

                                            </div>
                                        </div>
                                    </div>




                                    <div class="col-12 d-none" id="paymentdetails">
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

                            <div class='text-center'></div>
                            <div class='row'>
                                <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                                    <table id="BOQ-table">
                                        <thead>
                                            <tr class=" borde-1 border-light " style="height: 40px;">
                                                <th width="1%" align="center"><input id="check_all"
                                                        type="checkbox" /></th>
                                                <th width="10%">ITEM DETAILS </th>

                                                <th class="text-center" width="10%" >Vendor Cost <br> (excl VAT)</th>
                                                <th class="text-center" width="7%">Vendor Cost <br> (incl VAT)</th>
                                                <th class="text-center" width="7%">per unit total <br> (incl VAT)</th>
                                                <th class="text-center" width="7%">margin</th>
                                                <th class="text-center" width="10%">selling price</th>
                                                <th class="text-center" width="15%">quantity</th>
                                                <th class="text-center" width="10%">Total Cost <br> (incl VAT)</th>
                                                <th class="text-center" width="10%">Total Margin </th>
                                                <th class="text-center" width="10%">Item Total</th>
                                                <th></th>
                                            
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="p-3">
                                                <td bordercolor="1" valign="top" align="left"><input class="case"
                                                        type="checkbox" /></td>

                                                <td valign="top">
                                                    <select name="services_id[]" id="services_id_1"
                                                        class="item form-select  form-control-sm select2 "
                                                        style="width: 300px !important;">
                                                        <option value="">select</option>
                                                        @foreach ($services as $key => $value)
                                                            <option value="{{ $value->id }}">
                                                                {{ $value->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="ItemID[]" id="ItemID_1">
                                                    <textarea name="Description[]" id="Description[]" rows="2" class="form-control mt-1 kashif kashif "
                                                        style="width: 300px !important;"></textarea>
                                                </td>
                                                <td valign="top">
                                                    <input type="number" name="unit_net_cost[]" id="unit_net_cost[]" class=" form-control unit-net-cost" step="0.01" value="" autocomplete="off">
                                                </td>
                                                <td valign="top">
                                                    <input type="number" name="vat_per_unit[]" id="vat_per_unit[]" class=" form-control vat-per-unit" step="0.01" readonly>
                                                </td>
                                                <td valign="top">
                                                    <input type="number" name="unit_with_vat[]" id="unit_with_vat[]" class=" form-control unit-with-vat" step="0.01" readonly >
                                                </td>
                                                <td valign="top">
                                                    <input type="number" name="per_unit_profit_margin[]" id="per_unit_profit_margin[]" class=" form-control per-unit-profit-margin" step="0.01" value="" readonly>
                                                </td>

                                                <td valign="top">
                                                    <input type="number" name="per_unit_selling_price[]" id="per_unit_selling_price[]" class=" form-control per-unit-selling-price" step="0.01" value="" autocomplete="off">
                                                </td>
                                              
                                                <td valign="top">
                                                    <div class="d-flex">
                                                        <input type="number" name="quantity[]" id="quantity[]" class="form-control quantity ms-1 me-1" step="0.01" value="1">
                                                        <select class="form-select me-1" name="LS[]" id="LS">
                                                            <option value="NO"><small>LS / NO</small></option>
                                                            <option value="YES"><small>L/S YES</small></option>
                                                        </select>
                                                    </div>
                                                </td>
                                                
                                                <td valign="top">
                                                    <input type="number" name="total_cost_with_vat[]" id="total_cost_with_vat[]" class=" form-control total-cost-with-vat" step="0.01" value="" readonly>
                                                </td>
                                                <td valign="top">
                                                    <input type="number" name="total_profit_margin[]" id="total_profit_margin[]" class=" form-control total-profit-margin" step="0.01" value=""  readonly>
                                                </td>
                                                <td valign="top">
                                                    <input type="number" name="item_total[]" id="item_total[]" class=" form-control item-total" step="0.01" value="" readonly>
                                                </td>
                                                <td class="border">
                                                    <button type="button" class="btn btn-danger delete-row">Delete</button>
                                                </td>

                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-1 mb-2" style="margin-left: 55px;">
                                <div class='col-xs-5 col-sm-3 col-md-3 col-lg-3  '>
                                    <button onclick="appendRowsTotableBOQ()" class="btn btn-success addmore" type="button"><i class="bx bx-list-plus align-middle font-medium-3 me-25"></i> Add More</button>

                                </div>

                                <div class='col-xs-5 col-sm-3 col-md-3 col-lg-3  '>
                                    <div id="result"></div>
                                    <div id="QtyTotal" class="form-control"
                                        style="border: 1px dashed red; width: 112px;">
                                    </div>

                                </div>
                                <br>

                            </div>


                            <div class="row mt-4">

                              
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4">
                                    <!-- <input type="text" class="form-control" id onpaste="return false;"> -->
                                    <div class="form-inline">
                                        <div class="form-group mt-1">
                                            <label> Material Cost &nbsp;</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>

                                                <input type="text" class="form-control" id="material_cost" name="material_cost" placeholder="material Cost" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group mt-1">
                                            <label>Labour Cost: &nbsp;</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">{{ session::get('Currency') }}</span>

                                                <input onchange="summaryCalculation()" type="number" class="form-control" value="0" id="labour_cost" name="labour_cost" placeholder="labour Cost">
                                            </div>
                                        </div>

                                        <div class="form-group mt-1">
                                            <label>Transport Cost &nbsp;</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input onchange="summaryCalculation()" type="number" class="form-control" id="transport_cost" name="transport_cost" placeholder="Transport Cost" >
                                            </div>
                                        </div>

                                        <div class="form-group mt-1">
                                            <label>Material Delivery Cost &nbsp;</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input onchange="summaryCalculation()" type="number" class="form-control" id="material_delivery_cost" name="material_delivery_cost" placeholder="material_delivery_cost" >
                                            </div>
                                        </div>

                                        <div class="form-group mt-1">
                                            <label>Project Cost &nbsp;</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input onchange="summaryCalculation()" type="number" class="form-control" id="project_cost" name="project_cost" placeholder="Project Cost" >
                                            </div>
                                        </div>

                                        
                                        
                                        <div class="form-group mt-1">
                                            <label><b>Grand Total</b> &nbsp;</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input onchange="summaryCalculation()" type="number" class="form-control" id="grand_total" name="grand_total" placeholder="Grand Total" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <!-- <input type="text" class="form-control" id onpaste="return false;"> -->
                                    <div class="form-inline">
                                        <div class="form-group mt-1">
                                            <label> Sub Total &nbsp;</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>

                                                <input type="text" class="form-control" id="subtotal" name="subtotal" placeholder="Item Subtotal" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group mt-1">
                                            <label>Fixed Discount: &nbsp;</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">{{ session::get('Currency') }}</span>

                                                <input onchange="summaryCalculation()" type="number" class="form-control" value="0" id="discount" name="discount" placeholder="Discount">
                                            </div>
                                        </div>
                                        <div class="form-group mt-1">
                                            <label>Total Amount: &nbsp;</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input onchange="summaryCalculation()" type="number" class="form-control" id="total_amount" name="total_amount" placeholder="total_amount" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group mt-1">
                                            <label>VAT 5%: &nbsp;</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input onchange="summaryCalculation()" type="number" class="form-control" id="incl_vat_total_amount" name="incl_vat_total_amount" placeholder="5% VAT on Total Amount" readonly>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group mt-1">
                                            <label><b>Grand Total</b> &nbsp;</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input onchange="summaryCalculation()" type="number" class="form-control" id="grand_total" name="grand_total" placeholder="Grand Total" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- total_margin
                    material_cost
                    labour_cost
                    transport_cost
                    material_delivery_cost --}}




                    <div class="mt-2 text-end">
                        <button type="submit" class="btn btn-success w-md">Save</button>
                        <a href="{{ route('boq.index') }}"class="btn btn-secondary w-md ">Cancel</a>
    
                    </div>

                </form>
                    
    

             

            </div>
            
        </div>
       
    </div>
    
        
   
       

    <script src="{{ asset('assets/js/myapp.js') }}" type="text/javascript"></script>
    
    <script>
         $(document).ready(function() {

            var BranchID = $('#BranchID').val();
            console.log(BranchID);
            if (BranchID != "") {
                $.ajax({
                    url: "{{ URL('/ajax_estimate_vhno') }}",
                    type: "POST",
                    data: {
                        "_token": $("#csrf").val(),
                        BranchID: BranchID,

                    },
                    cache: false,
                    success: function(data) {
                        $('#EstimateNo').val(data.vhno);
                    }
                });
            }

            });
    </script>
    
    
    <script>
        $(document).ready(function () {
            
            // Event listeners to trigger calculation on value or qty change
            $(document).on('input', '.unit-net-cost, .per-unit-selling-price, .quantity', function() {
                var row = $(this).closest('tr');
                
                calculateUnitTax(row);
            });

            $('#BOQ-table').on('click', '.delete-row', function() {
                $(this).closest('tr').remove();

                summaryCalculation();

            });
            


        });

        function calculateUnitTax(row)
        {
           
            var unit_net_cost = parseFloat(row.find('.unit-net-cost').val()) || 0;

            var vat_per_unit = (unit_net_cost *5)/100;
            row.find('.vat-per-unit').val(vat_per_unit.toFixed(2));

            var unit_with_vat = unit_net_cost + vat_per_unit;

            row.find('.unit-with-vat').val(unit_with_vat.toFixed(2));

            var per_unit_selling_price =  parseFloat(row.find('.per-unit-selling-price').val()) || 0;
          
            var per_unit_profit_margin = per_unit_selling_price - unit_with_vat;

            row.find('.per-unit-profit-margin').val(per_unit_profit_margin.toFixed(2));

            var quantity = parseFloat(row.find('.quantity').val()) || 0;

            var total_cost_with_vat = quantity * unit_with_vat;

            row.find('.total-cost-with-vat').val(total_cost_with_vat.toFixed(2));

            var total_profit_margin = quantity * per_unit_profit_margin;

            row.find('.total-profit-margin').val(total_profit_margin.toFixed(2));

            var item_total = quantity * per_unit_selling_price;

            row.find('.item-total').val(item_total.toFixed(2));
            
            summaryCalculation();
    

        }


        function summaryCalculation()
        {

           let material_cost = 0;
           let subtotal = 0;

            // Iterate over each total-cost-with-vat input field
            $('.total-cost-with-vat').each(function() {
                // Add up all the total-cost-with-vat values
                let subtotal = parseFloat($(this).val()) || 0;
                material_cost += subtotal;
            });
            $('#material_cost').val(material_cost.toFixed(2));


            let project_cost = material_cost;
            $('#project_cost').val(project_cost.toFixed(2));

          

            $('.item-total').each(function() {
                // Add up all the total-cost-with-vat values
                let itemTotal = parseFloat($(this).val()) || 0;
                subtotal += itemTotal;
            });
            $('#subtotal').val(subtotal.toFixed(2));

            let discount = $('#discount').val() || 0;

            let total_amount = subtotal - discount;
            $('#total_amount').val(total_amount.toFixed(2));

            let incl_vat_total_amount = (total_amount*5)/100;
            $('#incl_vat_total_amount').val(incl_vat_total_amount.toFixed(2));

            let grand_total = total_amount + incl_vat_total_amount;
            $('#grand_total').val(grand_total.toFixed(2));
            

        }
         

        function appendRowsTotableBOQ(){
            var tableBody = $('#BOQ-table tbody');
           
            var row = `
              <tr class="p-3">
                <td bordercolor="1" valign="top" align="left"><input class="case"
                        type="checkbox" /></td>

                <td valign="top">
                    <select name="services_id[]" id="services_id_1"
                        class="item form-select  form-control-sm select2 "
                        style="width: 300px !important;">
                        <option value="">select</option>
                        @foreach ($services as $key => $value)
                            <option value="{{ $value->id }}">
                                {{ $value->name }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="ItemID[]" id="ItemID_1">
                    <textarea name="Description[]" id="Description[]" rows="2" class="form-control mt-1 kashif kashif "
                        style="width: 300px !important;"></textarea>
                </td>
                <td valign="top">
                    <input type="number" name="unit_net_cost[]" id="unit_net_cost[]" class=" form-control unit-net-cost" step="0.01" value="" autocomplete="off">
                </td>
                <td valign="top">
                    <input type="number" name="vat_per_unit[]" id="vat_per_unit[]" class=" form-control vat-per-unit" step="0.01" readonly>
                </td>
                <td valign="top">
                    <input type="number" name="unit_with_vat[]" id="unit_with_vat[]" class=" form-control unit-with-vat" step="0.01" readonly >
                </td>
                <td valign="top">
                    <input type="number" name="per_unit_profit_margin[]" id="per_unit_profit_margin[]" class=" form-control per-unit-profit-margin" step="0.01" value="" readonly>
                </td>

                <td valign="top">
                    <input type="number" name="per_unit_selling_price[]" id="per_unit_selling_price[]" class=" form-control per-unit-selling-price" step="0.01" value="" autocomplete="off">
                </td>
                
                <td valign="top">
                    <div class="d-flex">
                        <input type="number" name="quantity[]" id="quantity[]" class="form-control quantity ms-1 me-1" step="0.01" value="1">
                        <select class="form-select me-1" name="LS[]" id="LS">
                            <option value="NO"><small>LS / NO</small></option>
                            <option value="YES"><small>L/S YES</small></option>
                        </select>
                    </div>
                </td>
                <td valign="top">
                    <input type="number" name="total_cost_with_vat[]" id="total_cost_with_vat[]" class=" form-control total-cost-with-vat" step="0.01" value="" readonly >
                </td>
                <td valign="top">
                    <input type="number" name="total_profit_margin[]" id="total_profit_margin[]" class=" form-control total-profit-margin" step="0.01" value="" readonly >
                </td>
                <td valign="top">
                    <input type="number" name="item_total[]" id="item_total[]" class=" form-control item-total" step="0.01" value="" readonly>
                </td>
                <td class="border">
                    <button type="button" class="btn btn-danger delete-row">Delete</button>
                </td>

                
            </tr>
            `; 

            tableBody.append(row);
            
        }


    </script>
    

    <!-- END: Content-->

@endsection
