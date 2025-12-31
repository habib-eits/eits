@extends('template.tmp')
@section('title', 'Lead Create')
@section('content')


<div class="main-content">

 <div class="page-content">
 <div class="container-fluid">



    <div class="content-wrapper">
        <div class="row" style="height: 81vh; overflow: auto;">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3 >Add Lead Details</h3>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <a href="{{ url('leads') }}" class="btn btn-primary btn-rounded ">Back</a>
                            </div>
                        </div>
                    </div>





                    <div class="card-body">
                        <small class="text-primary"><em>Input fields marked with * are the required fields</em></small>
                        <hr>
                        <form action="{{ url('storelead') }}" method="post">
                            @csrf
                            <div class="row">
                               
                                    
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <label><b>Customer</b> </label>
                                    <select name="partyid" id="PartyID" class="form-select select2 mt-5"
                                        required="" style="width:100%;">
                                        <option value="">Select</option>
                                        <?php foreach ($parties as $key => $value) : ?>
                                        <option value="{{ $value->PartyID }}">{{ $value->PartyName.'-'.$value->Phone }}</option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                               
                                {{-- <div class="col-lg-4 col-md-6 col-sm-12">
                                    <label for="name"><strong>Customer/Lead Full Name: </strong></label>
                                    <input required type="text" name="name" id="name"  class="form-control"
                                        value="{{ old('name') }}">
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <label for="tel"><strong>Contact / Email: *</strong></label>
                                    <input type="tel" name="tel" id="tel" required class="form-control"
                                        value="{{ old('tel') }}">
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <label for="tel"><strong>Alternate Number:</strong></label>
                                    <input type="tel" name="other_tel" id="tel" class="form-control"
                                        value="{{ old('other_tel') }}">
                                </div> --}}
                                {{-- </div> --}}
                                {{-- <div class="row mt-2"> --}}
                                <div class="col-lg-4 col-md-6 col-sm-12 d-none">
                                    <label for="business_details"><strong>Business Details:</strong></label>
                                    <input type="text" name="business_details" id="business_details" class="form-control"
                                        value="{{ old('business_details') }}">
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 d-none">
                                    <label for="service"><strong>Service:</strong></label>
                                    <input type="text" name="service" id="service" class="form-control"
                                        value="{{ old('service') }}">
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <label for="channel"><strong>Channel:</strong></label>
                                    <select name="channel" id="channel" class="form-select select2">
                                        

                                         @foreach($channel as $value)
                                          <option value="{{$value->ChannelName}}" >{{$value->ChannelName}}</option>
                                         @endforeach
                                        
                                        
                                    </select>
                                </div>
                                {{-- </div> --}}
                                {{-- <div class="row mt-2"> --}}
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <label for="branch_id"><strong>Branch:</strong></label>
                                    <select name="branch_id" id="branch_id" class="form-select">
                                        @foreach ($branches as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('branch_id') == $item->id ? 'selected' : '' }}> {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <label for="branch_service"><strong>Branch Service:</strong></label>
                                    <select name="service_id" id="service_id" class="form-select select2">
                                        <option value="">--Select One--</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}"
                                                {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                                {{ $service->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 d-none" id="subServiceCol">
                                    <label for="branch_sub_service"><strong>Branch Sub Service:</strong></label>
                                    <select name="sub_service_id" id="sub_service_id" class="form-control">
                                        <option value="">--Select One--</option>
                                        @foreach ($subServices as $subservice)
                                            <option value="{{ $subservice->id }}"
                                                {{ old('sub_service_id') == $subservice->id ? 'selected' : '' }}>
                                                {{ $subservice->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- </div> --}}
                                {{-- <div class="row mt-2"> --}}
                                <div class="col-lg-4 col-md-6 col-sm-12 d-none">
                                    <label for="currency"><strong>Currency:</strong></label>
                                    <select name="currency" id="currency" class="form-select select2">
                                        {{-- <option value="" selected>--Select Currency--</option> --}}
                                        <option value="AED" {{ old('currency') == 'AED' ? 'selected' : '' }}>AED
                                        </option>
                                        <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>USD
                                        </option>
                                        {{-- @foreach ($branches as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('currency') == $item->id ? 'selected' : '' }}> {{ $item->name }}
                                            </option>
                                        @endforeach --}}
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 d-none">
                                    <label for="amount"><strong>Quoted Amount:</strong></label>
                                    <input type="number" step="0.001" name="amount" id="amount" class="form-control"
                                        value="{{ old('amount') }}">
                                </div>
                                <!--<div class="col-lg-4 col-md-6 col-sm-12">-->
                                <!--    <label for="agent_id"><strong>Agent:</strong></label>-->
                                <!--    <select name="agent_id" id="agent_id" class="form-select select2">-->
                                <!--        <option value="">--Select Agent--</option>-->
                                <!--        @foreach ($agents as $agent)-->
                                <!--            <option value="{{ $agent->id }}"-->
                                <!--                {{ old('agent_id') == $agent->id ? 'selected' : '' }}>{{ $agent->name }}-->
                                <!--            </option>-->
                                <!--        @endforeach-->
                                <!--    </select>-->
                                <!--</div>-->
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <label for="agent_id"><strong>Agent:</strong></label>
                                    <select name="agent_id" id="agent_id" class="form-select select2">
                                        <option value="">--Select Agent--</option>
                                        @foreach ($agents as $agent)
                                            <option value="{{ $agent->id }}"
                                                {{ (old('agent_id') == $agent->id || (count($agents) === 1 && old('agent_id') === null)) ? 'selected' : '' }}>
                                                {{ $agent->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- </div> --}}
                                {{-- <div class="row mt-2"> --}}
                                <div class="col-md-4 col-sm-12 d-none">
                                    <label for="lead_status"><strong>Campaign:</strong></label>
                                    <select name="campaign_id" id="campaign_id" class="form-select select2">
                                        <option value="">--Select Campaign--</option>
                                        @foreach ($campaigns as $campaign)
                                            <option
                                                value="{{ $campaign->id }}"{{ old('campaign_id') == $campaign->id ? 'selected' : '' }}>
                                                {{ $campaign->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Modal -->
     <div class="modal fade exampleModal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Add new customer</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                 </button>
             </div>
             <form method="post">
                 <input type="hidden" name="_token" value="SF5krfPegrIS3icD2CjPx78GxfBtaQjeKBoyQ3U2">
                 <div class="modal-body">

                     <div class="row">
                         <div class="col-12">
                             <label for=""><strong>Customer : *</strong></label>
                             <input type="text" class="form-control" id="PartyName" name="PartyName" required>
                             <span class="error-message" id="name-error">Name is required.</span>
                         </div>

                         <div class="col-12 mt-2">
                             <label for=""><strong>Mobile No: *</strong></label>
                             <input type="text" class="form-control" id="Phone" name="Phone" required="">
                             <span class="error-message" id="email-error">Phone Number is required.</span>

                         </div>
                     </div>
                 </div>

                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                     <button type="button" id="submitButton" class="btn btn-primary">Save</button>
                 </div>
             </form>
         </div>
     </div>
 </div>

  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('#branch_id').change(function() {
                const selectedBranchID = $(this).val();
                if (selectedBranchID != '') {
                     // alert(selectedBranchID);
                    $.ajax({
                        url: 'ajaxGetAgents/' + selectedBranchID,
                        type: 'GET',
                        success: function(response) {
                            if (response.data.length > 0) {
                                const agents = response.data;
                                $('#agent_id').empty();
                                $('#agent_id').append(
                                    '<option value="">--Select Agent--</option>');
                                agents.forEach(agent => {
                                    $('#agent_id').append(
                                        '<option value="' + agent.id + '">' + agent
                                        .name + '</option>'
                                    );
                                    console.log(agent.name);
                                });
                                // Handle the successful response here
                                // console.log(response.data.name);
                            } else {
                                $('#agent_id').empty(); // Clear existing options
                                $('#agent_id').append(
                                    '<option value="">--No Agents--</option>');
                            }

                        },
                        error: function(xhr, status, error) {
                            // Handle errors here
                            alert(xhr.responseText);
                            console.error(xhr.responseText);
                        }
                    });
                    $.ajax({
                        url: 'ajaxGetServices/' + selectedBranchID,
                        type: 'GET',
                        success: function(response) {
                            if (response.data.length > 0) {
                                const services = response.data;
                                $('#service_id').empty();
                                $('#service_id').append(
                                    '<option value="">--Select Service--</option>');
                                services.forEach(service => {
                                    $('#service_id').append(
                                        '<option value="' + service.id + '">' +
                                        service
                                        .name + '</option>'
                                    );
                                    console.log(service.name);
                                });
                                // Handle the successful response here
                                console.log(response.data.name);
                            } else {
                                $('#service_id').empty(); // Clear existing options
                                $('#service_id').append(
                                    '<option value="">--No Service--</option>');
                            }

                        },
                        error: function(xhr, status, error) {
                            // Handle errors here
                            alert(xhr.responseText);
                            console.error(xhr.responseText);
                        }
                    })
                } else {
                    $.ajax({
                        url: 'ajaxGetAgents',
                        type: 'GET',
                        success: function(response) {
                            if (response.data.length > 0) {
                                const agents = response.data;
                                $('#agent_id').empty();
                                $('#agent_id').append(
                                    '<option value="">--Select Agent--</option>');
                                agents.forEach(agent => {
                                    $('#agent_id').append(
                                        '<option value="' + agent.id + '">' + agent
                                        .name + '</option>'
                                    );
                                    console.log(agent.name);
                                });
                                // Handle the successful response here
                                console.log(response.data.name);
                            } else {
                                $('#agent_id').empty(); // Clear existing options
                                $('#agent_id').append(
                                    '<option value="">--No Agents--</option>');
                            }

                        },
                        error: function(xhr, status, error) {
                            // Handle errors here
                            alert(xhr.responseText);
                            console.error(xhr.responseText);
                        }
                    });
                    $.ajax({
                        url: 'ajaxGetServices',
                        type: 'GET',
                        success: function(response) {
                            if (response.data.length > 0) {
                                const services = response.data;
                                $('#service_id').empty();
                                $('#service_id').append(
                                    '<option value="">--Select Service--</option>');
                                services.forEach(service => {
                                    $('#service_id').append(
                                        '<option value="' + service.id + '">' +
                                        service
                                        .name + '</option>'
                                    );
                                    console.log(service.name);
                                });
                                // Handle the successful response here
                                console.log(response.data.name);
                            } else {
                                $('#service_id').empty(); // Clear existing options
                                $('#service_id').append(
                                    '<option value="">--No Service--</option>');
                            }

                        },
                        error: function(xhr, status, error) {
                            // Handle errors here
                            alert(xhr.responseText);
                            console.error(xhr.responseText);
                        }
                    })
                }

            });
            $('#service_id').change(function() {
                const selectedServiceID = $(this).val();
                if (selectedServiceID != '') {
                    // alert(selectedBranchID);
                    $('#subServiceCol').removeClass('d-none');
                    $.ajax({
                        url: 'ajaxGetSubservices/' + selectedServiceID,
                        type: 'GET',
                        success: function(response) {
                            if (response.data.length > 0) {
                                const subServices = response.data;
                                $('#sub_service_id').empty();
                                $('#sub_service_id').append(
                                    '<option value="">--Select Sub Service--</option>');
                                subServices.forEach(subService => {
                                    $('#sub_service_id').append(
                                        '<option value="' + subService.id + '">' +
                                        subService
                                        .name + '</option>'
                                    );
                                    console.log(subService.name);
                                });
                                // Handle the successful response here
                                // console.log(response.data.name);
                            } else {
                                $('#sub_service_id').empty(); // Clear existing options
                                $('#sub_service_id').append(
                                    '<option value="">--No Sub Services--</option>');
                            }

                        },
                        error: function(xhr, status, error) {
                            // Handle errors here
                            alert(xhr.responseText);
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    $('#sub_service_id').empty();
                    $('#subServiceCol').addClass('d-none');

                }

            });
        })
    </script>
        <script>
            $(document).ready(function() {
                $('#submitButton').click(function() {
                    var isValid = true;
    
                    // Validate the name field
                    var PartyName = $('#PartyName').val().trim();
                    if (PartyName === '') {
                        $('#name').addClass('error');
                        $('#name-error').show();
                        isValid = false;
                    } else {
                        $('#name').removeClass('error');
                        $('#name-error').hide();
                    }
    
                    // Validate the email field
                    var Phone = $('#Phone').val().trim();
                    if (Phone === '') {
                        $('#email').addClass('error');
                        $('#email-error').show();
                        isValid = false;
                    } else {
                        $('#email').removeClass('error');
                        $('#email-error').hide();
                    }
    
    
    
    
                    // If the form is valid, make the AJAX request
                    if (isValid) {
    
                        // alert('vvv');
                        $.ajax({
                            url: '{{ URL('/ajax_party_save') }}', // Replace with your server endpoint
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}', // Laravel's CSRF token
                                PartyName: PartyName,
                                Phone: Phone,
                            },
                            success: function(response) {
                                // Handle the response from the server
    
    
                                // alert('Form submitted successfully!');
    
    
    
    
                                console.log(response.PartyID);
                                console.log(response.PartyName);
                                console.log(response.Phone);
    
    
                                $("#PartyID").append('<option value=' + response.PartyID +
                                    ' selected >' + response.PartyID + '-' + response
                                    .PartyName + '-' + response.Phone + '</option>');
    
                                $('#exampleModal').modal('hide');
    
                                checkSelection();
    
                            },
    
    
    
    
    
    
                            error: function(xhr, status, error) {
                                // Handle any errors
                                alert('An error occurred: ' + error);
                            }
                        });
                    }
                });
    
    
    
                $(document).on('keyup', '#PartyName', function() {
    
                    var isValid = true;
    
                    // Validate the name field
                    var nameValue = $('#PartyName').val().trim();
                    if (nameValue === '') {
                        $('#name').addClass('error');
                        $('#name-error').show();
                        isValid = false;
                    } else {
                        $('#name').removeClass('error');
                        $('#name-error').hide();
                    }
    
    
    
                });
    
    
    
                $(document).on('keyup', '#Phone', function() {
    
                    var isValid = true;
    
                    // Validate the email field
                    var emailValue = $('#Phone').val().trim();
    
                    if (emailValue === '') {
                        $('#email').addClass('error');
                        $('#email-error').show();
                        isValid = false;
                    } else {
                        $('#email').removeClass('error');
                        $('#email-error').hide();
                    }
    
    
                });
    
    
    
            });
        </script>
    <script>
         $(document).ready(function() {



            $('#PartyID').select2({
                allowClear: true,
                placeholder: 'Search...',
                language: {
                    noResults: function() {
                        // console.log('no record ounf');
                        return `<button style="width: 100%" type="button"
            class="btn btn-primary" 
            onClick='task()'>+ Add New Customer</button>
            </li>`;
                    }
                },

                escapeMarkup: function(markup) {
                    return markup;
                }
            });
            });

            
        function task() {
            // alert("Hello world! ");


            $('#PartyID').select2('close');

            $('input[name="PartyName"]').focus();
            $('#exampleModal').modal('show');

        }
    </script>
    <script>
        $(document).ready(function() {
            // Initialize select2
            $('#searchField').select2();

            // Event listener for input on select2 search field
            $(document).on('input', '.select2-search__field', function() {
                // Get the value from the select2 search field
                var searchValue = $(this).val();

                // Assign the value to the new text field
                $('#Phone').val(searchValue);
            });
        });
    </script>
@endsection
