@extends('template.tmp')
@section('title', 'Service Index')
@section('content')



    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">





                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-print-block d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Booking</h4>
                            <div class="col d-flex justify-content-end">


                                {{-- <a href="{{ URL('/BookingCreate/0') }}"
                                    class="btn btn-danger btn-rounded waves-effect waves-light mb-2 me-2"><i
                                        class="bx bx-plus me-1"></i> Add New</a> --}}

                            </div>

                        </div>
                    </div>
                </div>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
                <script>
                    @if (Session::has('error'))
                        toastr.options = {
                            "closeButton": false,
                            "progressBar": true
                        }
                        Command: toastr["{{ session('class') }}"]("{{ session('error') }}")
                    @endif
                </script>



                @if (count($errors) > 0)

                    <div>
                        <div class="alert alert-danger p-1   border-3">
                            <p class="font-weight-bold"> There were some problems with your input.</p>
                            <ul>

                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                @endif


                <div  id="filterRow" class="row card card-body">
                    <form action="{{  URL('Booking') }}" method="GET">
                        <div class="row">
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <label for=""><strong>Booking Date</strong></label>
                                <select name="filter_creation_date" id=""
                                    class="form-control select2 rounded">
                                    <option value="">
                                        {{ isset($request) && $request->filter_creation_date ?
                                        '--Cancel--' : '--Select One--' }}
                                    </option>
                                    <option value="Today" {{ isset($request) && $request->
                                        filter_creation_date == 'Today' ? 'selected' : '' }}>
                                        Today
                                    </option>
                                    <option value="Yesterday" {{ isset($request) && $request->
                                        filter_creation_date == 'Yesterday' ? 'selected' : '' }}>
                                        Yesterday
                                    </option>
                                    <option value="3" {{ isset($request) && $request->
                                        filter_creation_date == '3' ? 'selected' : '' }}>
                                        Last 3 Days
                                    </option>
                                    <option value="week" {{ isset($request) && $request->
                                        filter_creation_date == 'week' ? 'selected' : '' }}>
                                        This Week
                                    </option>
                                    <option value="month" {{ isset($request) && $request->
                                        filter_creation_date == 'month' ? 'selected' : '' }}>
                                        This Month
                                    </option>
                                    <option value="last_month" {{ isset($request) && $request->
                                        filter_creation_date == 'last_month' ? 'selected' : '' }}>
                                        Last Month
                                    </option>
                                    <option value="quarter" {{ isset($request) && $request->
                                        filter_creation_date == 'quarter' ? 'selected' : '' }}>
                                        This Quarter
                                    </option>
                                    <option value="year" {{ isset($request) && $request->
                                        filter_creation_date == 'year' ? 'selected' : '' }}>
                                        This Year
                                    </option>
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <label for=""><strong>Closing Date</strong></label>
                                <div class="input-group">
                                    <select name="filter_last_updated" id="filter_last_updated"
                                        class="form-control select2 rounded">
                                        <option value="">
                                            {{ isset($request) && $request->filter_last_updated ?
                                            '--Cancel--' : '--Select One--' }}
                                        </option>
                                        <option value="Today" {{ isset($request) && $request->
                                            filter_last_updated == 'Today' ? 'selected' : '' }}>
                                            Today
                                        </option>
                                        <option value="Yesterday" {{ isset($request) && $request->
                                            filter_last_updated == 'Yesterday' ? 'selected' : '' }}>
                                            Yesterday
                                        </option>
                                        <option value="3" {{ isset($request) && $request->
                                            filter_last_updated == '3' ? 'selected' : '' }}>
                                            Last 3 Days
                                        </option>
                                        <option value="week" {{ isset($request) && $request->
                                            filter_last_updated == 'week' ? 'selected' : '' }}>
                                            This Week
                                        </option>
                                        <option value="month" {{ isset($request) && $request->
                                            filter_last_updated == 'month' ? 'selected' : '' }}>
                                            This Month
                                        </option>
                                        <option value="last_month" {{ isset($request) && $request->
                                            filter_creation_date == 'last_month' ? 'selected' : '' }}>
                                            Last Month
                                        </option>
                                        <option value="quarter" {{ isset($request) && $request->
                                            filter_last_updated == 'quarter' ? 'selected' : '' }}>
                                            This Quarter
                                        </option>
                                        <option value="year" {{ isset($request) && $request->
                                            filter_last_updated == 'year' ? 'selected' : '' }}>
                                            This Year
                                        </option>
                                    </select>
    
                                </div>
                            </div>
                            @if(Session::get('UserType')=='Admin')
                                <div class="col-lg-2 col-md-4 col-sm-6">
                                    <label for=""><strong>Agent</strong></label>
                                    <select name="filter_agent_id" id=""
                                        class="form-control select2 rounded">
                                        <option value="">
                                            {{ isset($request) && $request->filter_agent_id ?
                                            '--Cancel--' : '--Select One--' }}
                                        </option>
                                        <option value="-1" {{ isset($request) && $request->
                                            filter_agent_id == -1 ? 'selected' : '' }}>
                                            No Agent</option>
                                        @foreach ($agents as $item)
                                        <option value="{{ $item->id }}" {{ isset($request) && $request->
                                            filter_agent_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <div class="col-lg-2 col-md-4 col-sm-6 mt-4">
                                <div class="col d-flex justify-content-end">
                                    <button class="btn btn-success mr-2 mx-2">Apply</button>
                                    <a class="btn btn-info" href="{{ url('Booking') }}">Reset</a>
                                </div>
                            </div>
                        </div>
                       
                    </form>
                </div>    
               
                <div class="card">

                    <div class="card-body">
                        <div class="col-12">
                            <table id="service-table" class="table table-sm table-hover w-100">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="10%">Title</th>
                                        <th width="10%">Client</th>
                                        <th width="10%">Agent</th>
                                        <th width="10%">Booking Date</th>
                                        <th width="10%">Close Date</th>

                                        <th width="5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($booking as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->PartyName }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->start }}</td>
                                            <td>{{ $item->end }}</td>
                                            <td>
                                                <a href="{{ URL('/BookingEdit/' . $item->id) }}">
                                                    <i class="mdi mdi-pencil  align-middle text-secondary"></i>
                                                </a>
                                                <a href="#"
                                                    onclick="delete_confirm_n(`BookingDelete`,'{{ $item->id }}')">
                                                    <i class="mdi mdi-trash-can  align-middle me-1 text-secondary"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#service-table').DataTable({
                columnDefs: [{
                        orderable: false,
                        targets: [0, 3]
                    } // Disable ordering for the first column (checkbox)
                ]
            });
        });
    </script>
    <script>
        function delete_confirm_n(url, id) {
            // alert(url);
            // alert(id);
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    url = "{{ URL::TO('/') }}/" + url + '/' + id;
                    window.location.href = url;
                }
            });

        };
    </script>
@endsection
