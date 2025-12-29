@extends('template.tmp')

@section('title', $pagetitle)
 

@section('content')



<div class="main-content">

 <div class="page-content">
 <div class="container-fluid">
  <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-print-block d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Salesman Excel Data Export</h4>
                                         
 
                                </div>
                            </div>
                        </div>
 @if (session('error'))

 <div class="alert alert-{{ Session::get('class') }} p-1" id="success-alert">
                    
                   {{ Session::get('error') }}  
                </div>

@endif

 @if (count($errors) > 0)
                                 
                            <div >
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

            
            
  <div class="card">
      <div class="card-body">
         
         @if(count($city)>0)    
        <table class="table table-sm table-striped align-middle table-nowrap mb-0">
        <thead>
          
        <th scope="col">S.No</th>
        <th scope="col">Salesman</th>
        <th scope="col">Export</th>
        </thead>
        
        <tbody>
        @foreach ($city as $key =>$value)
         <tr>
         <td class="col-md-1">{{$key+1}}</td>
         <td class="col-md-6">{{$value->City}}</td>
         <td class="col-md-1"><a href="{{URL('/SalesmanExport/'.$value->City)}}" class="btn btn-success btn-sm" id="btnFetch"> Download Excel File</a></td>
         </tr>
         @endforeach   
         </tbody>
         </table>
         @else
           <p class=" text-danger">No data found</p>
         @endif   

      </div>
  </div>
  
  </div>
</div>

        </div>
      </div>
    </div>
    <!-- END: Content-->

<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
 <script>


$(document).ready(function() {

$("#btnFetch").click(function() {

// add spinner to button

// $(this).html('<i class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i> loading...' );

// $(this).html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="sr-only">Loading...</span>' );

$(this).html(' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Generating ...' );

// disable button

// $(this).prop("disabled", true);



});

});

</script>
  @endsection