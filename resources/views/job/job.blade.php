@extends('template.tmp')
@section('title', $pagetitle)

@section('content')

<div class="main-content">
  <div class="page-content">
    <div class="container-fluid">
      <!-- start page title -->
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">All Jobs</h4>
            <div class="page-title-right ">
              
              <div class="btn-group  shadow-sm dropstart">
                 <a href="{{URL('/JobCreate')}}" class="btn btn-primary"> + New </a>
                
              </div>
            </div>
            
            
             <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
             <script>
            @if(Session::has('error'))
              toastr.options =
              {
                "closeButton" : false,
                "progressBar" : true
              }
                    Command: toastr["{{session('class')}}"]("{{session('error')}}")
              @endif
            </script>

          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          
          
     
          @if (count($errors) > 0)
          
          <div >
            <div class="alert alert-danger pt-3 pl-0   border-3">
              <p class="font-weight-bold"> There were some problems with your input.</p>
              <ul>
                
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          </div>
          
          @endif
          
          <div class="card">
            
            <div class="card-body">
              <table id="student_table" class="table table-striped table-sm " style="width:100%">
                <thead>
                  <tr>
                    <th>Job#</th>
                    <th>Date</th>
                     <th width="550">Client</th>
                     <th>Created By</th>
                    
                     
                    <th>Action</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END: Content-->
<script type="text/javascript">
$(document).ready(function() {
$('#student_table').DataTable({
"processing": true,
"serverSide": true,
"ajax": "{{ url('ajax_job') }}",
"columns":[
{ "data": "JobNo" },
{ "data": "JobDate" },
 { "data": "PartyName" },
 { "data": "FullName" },




{ "data": "action" },
],
"order": [[0, 'desc']],
});
});
</script>

@endsection