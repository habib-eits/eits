@extends('template.tmp')
{{-- @section('title', $pagetitle) --}}

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
                {{-- <h3>Receipt</h3> --}}
                <!-- enctype="multipart/form-data" -->
                <form name="payment_form" action="{{ route('invoice.update', $invoice->InvoiceMasterID) }}" method="post" class="custom-validation">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">

                    <div class="row">
                        <div class="col-md-6">
                            <h4>Add Payment</h4>
                            <div class="card shadow-sm">
                                <div class="card-body">   
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" >Reference No #</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" autocomplete="off"  name="ReferenceNo" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" > Creation Date</label>
                                            </div>
                                            @php
                                                $today = today();
                                            @endphp
                                            <div class="col-sm-9">
                                                <div class="input-group" id="datepicker21">
                                                    <input type="date" name="Date" autocomplete="off"
                                                        class="form-control" value={{  $today }}>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label " >Party </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" autocomplete="off"  class="form-control" value="{{ $party->PartyName }}" readonly>
                                            </div>
                                        </div>
                                    </div>  
                                   
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label " >Received Amount </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="number" autocomplete="off"  class="form-control" name="received_amount" value="0" id="received_amount" required="">
                                                <span class="d-none text-danger" id="error"></span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label " >Payment Mode</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select name="PaymentMode"  class="form-select select2 " style="width:100%;">
                                                @foreach ( $paymentModes as $paymentMode)
                                                    <option value="{{ $paymentMode->PaymentMode }}"> {{ $paymentMode->PaymentMode }}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label " >Description Amount </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" name="Description" id="" cols="30"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    
                                   
                                </div> 
                            </div>
                            <div class="mt-2"><button id="payment_submit" 
                                class="btn btn-success w-md float-right" >Save</button>
                                <a href="{{ URL('/Invoice') }}"
                                class="btn btn-secondary w-md float-right">Cancel</a>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>Invoice Detail</h4>

                            <div class="card shadow-sm">
                                <div class="card-body">   
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label text-danger" >Invoice #</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" autocomplete="off"  class="form-control" value="{{ $invoice->InvoiceNo }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" > Creation Date</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="input-group" id="datepicker21">
                                                    <input type="text" name="Date" autocomplete="off"
                                                        class="form-control" placeholder="yyyy-mm-dd"
                                                        data-date-format="yyyy-mm-dd" data-date-container="#datepicker21"
                                                        data-provide="datepicker" data-date-autoclose="true"
                                                        value="{{ $invoice->Date }}" readonly>
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label " >Party </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" autocomplete="off"  class="form-control" value="{{ $party->PartyName }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label " >Sub Total </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" autocomplete="off"  class="form-control" value="{{ $invoice->SubTotal }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label " >Discount </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" autocomplete="off"  class="form-control" value="{{ $invoice->DiscountAmount }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label " >Total </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" autocomplete="off"  class="form-control" value="{{ $invoice->Total }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label " >Tax <small> ({{ $invoice->TaxType }})</small> </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" autocomplete="off"  class="form-control" value="{{ $invoice->Tax }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label " >Grand Total </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" autocomplete="off"  class="form-control" value="{{ $invoice->GrandTotal }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label " >Paid </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="number" autocomplete="off"  class="form-control"  value="{{ $invoice->Paid }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label " >Balance </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="number" autocomplete="off"  class="form-control" id="balance_amount" value="{{ $invoice->Balance }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    
                                   
                                </div> 
                            </div>
                        
                        </div>
                    </div>
                </form>
                <h4>Payment Received</h4>
                <div class="card shadow-sm">
                    <div class="card-body">   
                        <table class="table table-sm align-middle table-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Reference No</th>
                                    <th scope="col">PaymentMode</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Amount Received</th>
                                    <th></th>
                                
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($receipts as $receipt)
                                <tr>
                                    <td class="col-md-1">{{  $receipt->date }}</td>
                                    <td class="col-md-1">{{  $receipt->ReferenceNo }}</td>
                                    <td class="col-md-1">{{  $receipt->PaymentMode }}</td>
                                    <td class="col-md-1">{{  $receipt->Description }}</td>
                                    <td class="col-md-1">{{  $receipt->Paid }}</td>
                                    <td class="col-md-1">
                                        <a href="javascript:void(0)" onclick="receiptEdit({{ $receipt->id }})" class="dropdown-item">
                                            <i class="bx bx-pencil font-size-16 text-secondary me-1"></i> Edit
                                        </a>
                                    </td>
                            
                                </tr>
                                @empty
                                    <td colspan="6" style="text-align: center">No Payment Received</td>

                                @endforelse

                                
                              
                            </tbody>
                            <tbody>
                            </tbody>
                           
                        </table>
                    </div>     
                </div>     
                

             

            </div>
        </div>
    </div>



 <!-- Edit Receipt -->
 <div class="modal fade" id="edit-receipt">
    <div class="modal-dialog custom-modal-two">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>Edit Receipt</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <form id="receipt-update" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <!-- For PUT method -->
                            <input type="hidden" name="id" id="id"> <!-- Hidden field to store the receipt ID -->
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" name="date" id="date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Reference No</label>
                                <input type="text" name="ReferenceNo" id="ReferenceNo" class="form-control" >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description </label>
                                <input type="text" name="Description" id="Description" class="form-control" >
                            </div>

                            
                            <div class="mb-3">
                                <label class="form-label">Paid </label>
                                <input type="hidden" id="old_paid"  class="form-control">
                                <input type="number" name="Paid" id="Paid" class="form-control" required step="0.01">
                            </div>


                           

                            
                            <div class="modal-footer-btn">
                                <button type="button" class="btn btn-cancel btn-dark me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-submit btn-success">Update Receipt</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Receipt -->


<script>

    $('#payment_submit').click(function (e) { 
        e.preventDefault(); // Prevent form submission
        var balance = parseFloat($("#balance_amount").val()) || 0;
        var received_amount = parseFloat($("#received_amount").val()) || 0;


        if(received_amount < 1)
        {
            // alert('Received Amount cannot be Zero');
            
            $('#received_amount').focus();
            $('#error').text('Received Amount cannot be Zero');
            $('#received_amount').css({'border':'1px Solid red'});
            $('#error').removeClass('d-none');
            
        }
        else{
            
            
            if(received_amount > balance) {
                e.preventDefault(); // Prevent form submission

                $('#received_amount').focus();
                $('#error').text('Received Amount cannot be greater than balance');
                $('#received_amount').css({'border':'1px Solid red'});
                $('#error').removeClass('d-none');
               

            } else {
                // Allow the form to be submitted
                $(this).closest('form').submit();
            }
        }

        
    });

    $('#received_amount').keyup(function (e) { 
        e.preventDefault();
        $('#error').addClass('d-none');
        $('#received_amount').css({'border':''});
        
        $('#error').text('');

        
    });





</script>

<script>
    
   
       
    function receiptEdit(id) {
       
            $.get("{{ route('editReceipt', ':id') }}".replace(':id', id), function(response) {
                $('#id').val(response.id);
                $('#date').val(response.date);
                $('#ReferenceNo').val(response.ReferenceNo);
                $('#Description').val(response.Description);
                $('#Paid').val(response.Paid);
                $('#old_paid').val(response.Paid);
                $('#edit-receipt').modal('show');
            }).fail(function(xhr) {
                alert('Error fetching receipt details: ' + xhr.responseText);
            });
        }
   
        $('#receipt-update').submit(function(e) {
                e.preventDefault();



            let old_paid = parseFloat($("#old_paid").val()) || 0;

            let new_paid = parseFloat($("#Paid").val()) || 0;

            let old_balance = parseFloat($("#balance_amount").val()) || 0;

            let new_balance = (old_paid + old_balance) - new_paid;

            console.log("old_paid",old_paid)
            console.log("new_paid",new_paid)
            console.log("old_balance",old_balance)
            console.log("new_balance",new_balance)

            if(new_balance < 0)
            {
                e.preventDefault();
                alert("Paid Cannot Be Greater Then Balacne")
            }
            else{
                let editFormData = new FormData(this);
                let receiptID = $('#id').val(); // Get the ID of the receipt being edited
                $.ajax({
                    type: 'POST',
                    url: "{{ route('updateReceipt', ':id') }}".replace(':id', receiptID), // Using route name
                    data: editFormData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        $('#edit-receipt').modal('hide');
                        location.reload();
                    },
                    error: function(response) {
                        // alert('Error adding data: ' + response.responseJSON.message);
                        alert(response.responseJSON.status,response.responseJSON.message);
                    }
                });
            }
            

                
        });
</script>



@endsection
