@extends('tmp')

@section('title', '')


@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">

                        @if (session('error'))
                            <div class="alert alert-{{ Session::get('class') }} p-1" id="success-alert">

                                {{ Session::get('error') }}
                            </div>
                        @endif

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


                        <div class="card shadow-sm">
                            <div class="card-body">
                                <!-- enctype="multipart/form-data" -->
                                <form action="{{ URL('/servicesStatusReport1') }}" method="post" name="form1"
                                    id="form1">
                                    @csrf


                                    <div class="col-md-4">
                                        <label for="basicpill-firstname-input">Services</label>
                                        <div class="mb-1">
                                            <select name="service_id" id="" class="select2 form-select"
                                                id="select2-basic">
                                                <option value="">Select</option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-form-label">From Date</label>
                                        <div class="input-group">
                                            <input type="date" name="startDate" autocomplete="off" class="form-control" value="{{ date('Y-m-01') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-form-label">To Date</label>
                                        <div class="input-group">
                                            <input type="date" name="endDate" autocomplete="off" class="form-control" value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>





                            </div>
                            <div class="card-footer bg-light">
                                <button type="submit" class="btn btn-success w-lg float-right">Submit</button>
                                <a href="{{ URL('/') }}" class="btn btn-secondary w-lg float-right">Cancel</a>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- END: Content-->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script>
        $('#pdf').click(function() {

            $('#form1').attr('action', '{{ URL('/BalanceSheet1PDF') }}');
            $('#form1').attr('target', '_blank');
            $('#form1').submit();

        });


        $('#online').click(function() {

            $('#form1').attr('action', '{{ URL('/BalanceSheet1') }}');


        });
    </script>



@endsection
