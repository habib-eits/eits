@extends('template.tmp')

@section('title', $pagetitle)


@section('content')





<div class="main-content">

 <div class="page-content">
 <div class="container-fluid">

<script>
       function delete_invoice(id) {


        url = '{{URL::TO('/')}}/InvoiceDelete/'+ id;



            jQuery('#staticBackdrop').modal('show', {backdrop: 'static'});
            document.getElementById('delete_link').setAttribute('href' , url);

    }
</script>


    <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Purchase Order</h4>
                                        <a href="{{URL('/PurchaseOrderCreate')}}"  class="btn btn-primary w-md float-right "><i class="bx bx-plus"></i> Add New</a>



                                </div>
                            </div>
                        </div>



          <div class="row">
  <div class="col-12">


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

 


  <div class="card">

      <div class="card-body">
          <table id="student_table" class="table table-striped table-sm " style="width:100%">
        <thead>
            <tr>
                <th>Invoice#</th>
                <th>Job No</th>

                 <th class="col-md-3">Party</th>
                <th class="col-md-1">Date</th>
                 <th>Total</th>
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
       "pageLength": 50,
        "processing": true,
        "serverSide": true,
        "ajax": "{{ url('ajax_purchaseorder') }}",
        "columns":[
             { "data": "InvoiceNo" },
             { "data": "JobNo" },

            { "data": "SupplierName" },
            { "data": "Date" },
             { "data": "GrandTotal", render: $.fn.dataTable.render.number(',', '.', 2, '') },
             { "data": "action" },

        ],
         "order": [[0, 'desc']],

     });
});

 $(document).ready(function() {
                    $('#student_table thead tr').clone(true).appendTo( '#student_table thead' );
                    $('#student_table thead tr:eq(1) th').each( function (i) {
                        var title = $(this).text();
                        $(this).html( '<input type="text" placeholder="  '+title+'"  class="form-control form-control-sm" />' );


   // hide text field from any column you want too
if (title == 'Action') {
    $(this).hide();
  }





                        $( 'input', this ).on( 'keyup change', function () {
                            if ( table.column(i).search() !== this.value ) {
                                table
                                    .column(i)
                                    .search( this.value )
                                    .draw();
                            }
                        });

                    });
                    var table = $('#student_table').DataTable( {
                        orderCellsTop: true,
                        fixedHeader: true,
                        retrieve: true,
                        paging: false

                    });
                });

</script>

      <!-- BEGIN: Vendor JS-->
    <script src="{{asset('assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->


  @endsection
