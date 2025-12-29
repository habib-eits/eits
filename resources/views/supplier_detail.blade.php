@extends('template.tmp')

@section('title', $pagetitle)
 

@section('content')

 <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">


  <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-print-block d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Supplier Detail</h4>
                                       <div class="col d-flex justify-content-end">
                             <a href="{{URL('/Supplier')}}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 w-sm"> Back</a>
                                 
                            </div>    
 
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

 @if (count($errors) > 0)
                                 
                            <div >
                <div class="alert alert-danger p-2 border-1">
                   <p class="font-weight-bold"> There were some problems with your input.</p>
                    <ul>
                        
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>

                        @endforeach
                    </ul>
                </div>
                </div>
 
            @endif

            
<div class="row">

  <div class="col-md-6">
 <form action="{{URL('/SupplierDetailSave')}}" method="post" enctype="multipart/form-data">

    <div class="card shadow-sm">
      <div class="card-body">
        {{csrf_field()}}
<div>
<div >

<h4 class="card-title">Add Supplier</h4>
 
 
 

  <div class="col-md-12 mt-5">
<div class="mb-3">
<label for="basicpill-firstname-input">Document Name <span class="text-danger">*</span></label>
<input type="text" class="form-control" name="DocumentTitle" required="">
</div>
</div>




  <div class="col-md-12 mt-5">
<div class="mb-3">
<label for="basicpill-firstname-input">Attachment <span class="text-danger">*</span></label>
<br>
<input type="file" name="filename" class="from-control">
</div>
</div>

                                    </div>
                                 
                                </div>

                      

      </div>
         <div class="card-footer bg-light bg-soft">
                                       <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Submit</button>


                                       
                                       
                <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                                    </div>
  </div>
                                <!-- card end here -->
  </form>  
    
  </div>



    <div class="col-md-6">
 <form action="{{URL('/SupplierDetailSave')}}" method="post" >

    <div class="card shadow-sm">
      <div class="card-body">
        {{csrf_field()}}
<div>
<div >

<h4 class="card-title">Add Supplier</h4>
 
 
 

  <div class="col-md-12 mt-5">
<div class="mb-0">
<label for="basicpill-firstname-input">Title of input  <span class="text-danger">*</span></label>
<input type="text" class="form-control" name="DocumentTitle" required="">
</div>
</div>



  <div class="col-md-12 mt-5">
<div class="mb-0">
<label for="basicpill-firstname-input">Detail <span class="text-danger">*</span></label>
<input type="text" class="form-control" name="DocumentDetail" required="">
</div>
</div>



 
                                    </div>
                                 
                                </div>

                      

      </div>
         <div class="card-footer bg-light bg-soft">
                                       <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Submit</button>


                                       
                                       
                <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                                    </div>
  </div>
                                <!-- card end here -->
  </form>  
    
  </div>
  
</div>

 <div class="row">
      <div class="col-lg-12">
          
          <div class="card shadow-sm">
              
          <div class="card-body">
            <h4 class="card-title ">Suppliers</h4>
           
            @if(count($supplier_detail)>0)    
            <table class="table table-sm align-middle table-nowrap mb-0">
            <tbody><tr>
            <th width="5%">S.No</th>
             <th width="50%">Title</th>
            <th width="50%">Detail</th>
            <th width="5%">Delete</th>
             </tr>
            </tbody>
            <tbody>
            @foreach ($supplier_detail as $key =>$value)
             <tr>
             <td class="col-md-1">{{$key+1}}</td>
              <td class="col-md-1">{{$value->DocumentTitle}}</td>
             <td class="col-md-1">
              <?php 

              if($value->DocumentDetail)
              {
                echo $value->DocumentDetail;

               
              }
              else
              {
                ?>
<a href="{{ env('APP'). Storage::url('app/public/uploads/'.$value->File) }}" title="" target="_blank">View</a>
                <?php
              }


              ?>
</td>

<td>
 <a href="#" onclick="delete_confirm2('SupplierDetailDelete',{{$value->SupplierDetailID}})"><i class="bx bx-trash  align-middle me-1"></i></a>
</td>
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
</div>
</div>

      
    <!-- END: Content-->
<script type="text/javascript">
$(document).ready(function() {
     $('#student_table').DataTable( );
});
</script>

 
    
  @endsection