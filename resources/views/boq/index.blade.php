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
            <h4 class="mb-sm-0 font-size-18">All BOQS</h4>
            <div class="page-title-right ">
              
              {{-- <div class="btn-group  shadow-sm dropstart">
                 <a href="{{ route('boq.create')}}" class="btn btn-primary"> + New </a>
                
              </div> --}}
            </div>
            
            
            
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-12">
          
          @if (session('error'))
          <div class="alert alert-{{ Session::get('class') }} p-1" id="success-alert">
            
            {{ Session::get('error') }}
          </div>
          @endif
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
          
          <div class="card" style="height: 600px">
            
            <div class="card-body">
              <table id="student_table" class="table table-striped table-sm " style="width:100%">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Estimate#</th>
                    <th>Reference</th>
                    <th>State</th>
                    <th>CUSTOMER NAME</th>
                    <th>Status</th>
                    <th>Amount</th>
                     
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
"ajax": "{{ url('ajax_boq') }}",
"columns":[
{ "data": "EstimateDate" },
{ "data": "EstimateNo" },
{ "data": "ReferenceNo" },
{ 
  "data": "state", 
  render: function(data, type, row){
    return (data!= null) ? data : 'N/A'

  }

},
{ "data": "PartyName", },
{ 
  "data": "Status",
  'render': function(data,type,row){
    if(data == 'Pending')
      return '<span class="badge bg-danger font-size-11"> '+ data +'</span>';
    else
      return '<span class="badge bg-success font-size-11"> '+ data +'</span>';
  }

  
 },

{ "data": "GrandTotal" },


{ "data": "action" },
],
"order": [[0, 'desc']],
});
});
</script>

<script>
  function confirmRedirect(url) {
      if (confirm('Are you sure you want to create a revision for this BOQ?')) {
          window.location.href = url;
      }
  }
  </script>
  <script>
    function delete_estimate(id) {
      alert("noting");
        // url = '{{URL::TO('/')}}/EstimateDelete/'+ id;
        //  jQuery('#staticBackdrop').modal('show', {backdrop: 'static'});
        //  document.getElementById('delete_link').setAttribute('href' , url);

 }
</script> 

<script>
  $(document).ready(function() {
            $('#student_table thead tr').clone(true).appendTo('#student_table thead');
            $('#student_table thead tr:eq(1) th').each(function(i) {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="  ' + title +
                    '"  class="form-control form-control-sm" />');


                // hide text field from any column you want too
                if (title == 'Action') {
                    $(this).hide();
                }





                $('input', this).on('keyup change', function() {
                    if (table.column(i).search() !== this.value) {
                        table
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });

            });
            var table = $('#student_table').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                retrieve: true,
                paging: false

            });
        });
</script>
@endsection