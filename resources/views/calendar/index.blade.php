 @extends('template.tmp')
 @section('title', $pagetitle)
 @section('content')

     <meta name="csrf-token" content="{{ csrf_token() }}" />

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
     <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

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

                 @if (isset($agents) && count($agents) > 0 && session('UserType') == 'Admin')
                     <div class="row mb-3">
                         <div class="col-md-3">
                             <label for="agent_filter"><strong>Filter by Agent</strong></label>
                             <select name="agent_filter" id="agent_filter" class="form-control select2">
                                 <option value="">All Agents</option>
                                 @foreach ($agents as $agent)
                                     <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>

                     <!-- Agent Color Legend -->
                     <div class="col-md-9 mt-4 mb-3">
                         <strong>Agent Colors:</strong>
                         <div class="d-flex flex-wrap gap-3 mt-2">
                             @foreach ($agents as $agent)
                                 <div class="d-flex align-items-center">
                                     <div class="rounded me-2"
                                         style="width: 20px; height: 20px; background-color: {{ $agentColors[$agent->id] }};">
                                     </div>
                                     <small>{{ $agent->name }}</small>
                                 </div>
                             @endforeach
                         </div>
                     </div>
                 @endif

                 <div id="calendar"></div>

             </div>
         </div>
     </div>

     @include('calendar.partials.followup-edit-modal')

 @endsection
