@extends('template.tmp')
@section('title', $pagetitle)
@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <script>
                    @if (session('success'))
                        toastr.success("{{ session('success') }}");
                    @endif
                    @if (session('error'))
                        toastr.error("{{ session('error') }}");
                    @endif
                </script>

                <div id="calendar"></div>
            </div>
        </div>
    </div>

    @include('calendar.partials.followup-edit-modal')

@endsection
