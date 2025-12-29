@extends('template.tmp')

@section('title', $pagetitle)
 

@section('content')
<div class="main-content">

                <div class="page-content">
                    <div class="container-fluid"><div class="row">
  <div class="col-12">
  
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
   <script type="text/javascript">
       function delete_confirm2(url,id) {        


        url = '{{URL::TO('/')}}/'+url+'/'+ id;
        
    
       
            jQuery('#staticBackdrop').modal('show', {backdrop: 'static'});
            document.getElementById('delete_link').setAttribute('href' , url);
         
    } 
 
  </script>
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
  
 
  
 <!-- enctype="multipart/form-data" -->
 <form action="{{URL('/ItemSave')}}" method="post"> 
 {{csrf_field()}} 
 <div class="card shadow-sm">
    <div class="card-header bg-secondary bg-soft rounded-top ">
      <h3>ITEM</h3>
    </div>
      <div class="card-body">
         <div class="col-md-6 col-sm-12">
                

                
                 
                
                
                
                    <div class="mb-3 row">
                  <div class="col-sm-2">
                    <label class="col-form-label fw-bold" for="first-name">Type</label>
                  </div>
                  <div class="col-sm-9">
                    <select name="ItemType" id="ItemType" class="form-select">
                  @foreach($item_type as $value)
                 <option value="{{$value->ItemType}}">{{$value->ItemType}}</option>
                 @endforeach
                      </select>
                  </div>
                </div>

              

                <div class="mb-3 row">
                  <div class="col-sm-2">
                    <label class="col-form-label fw-bold" for="first-name">Name</label>
                  </div>
                  <div class="col-sm-9">
                    <input type="text" id="first-name" class="form-control" name="ItemName" placeholder="Item Name">
                  </div>
                </div>

                <div class="mb-3 row" id="unit">
                  <div class="col-sm-2">
                    <label class="col-form-label fw-bold" for="first-name">Unit</label>
                  </div>
                  <div class="col-sm-9">
                    <select name="UnitName" id="UnitName" class="form-select">
                       <option value="0">Select</option>
                 @foreach($unit as $value)
                 <option value="{{$value->UnitName}}">{{$value->UnitName}}</option>
                 @endforeach
                      </select>
                  </div>
                </div>


               <div class="mb-3 row" id="unitqty">
                  <div class="col-sm-2">
                    <label class="col-form-label fw-bold" for="first-name">Unit Quantity</label>
                  </div>
                  <div class="col-sm-9">
                 <input type="number" id="first-name" class="form-control" name="UnitQty" value="" >
                  </div>
                </div>


             




                 <div class="mb-3 row">
                  <div class="col-sm-2">
                    <label class="col-form-label fw-bold" for="first-name">Taxable</label>
                  </div>
                  <div class="col-sm-9">
                    <select name="Taxable" id="Taxable" class="form-select">
                        <option value="">Select</option>
                        <option value="No" selected="">No</option>
                        <option value="Yes">Yes</option>
                  
                      </select>
                  </div>
                </div>

                <div class="mb-1 row">
                  <div class="col-sm-2">
                    <label class="col-form-label fw-bold" for="first-name">Percentage</label>
                  </div>
                  <div class="col-sm-9">
                    <input type="text" id="Percentage" disabled="" class="form-control" name="Percentage" value="0">
                  </div>
                </div>

             
           
             
             

              
                


              </div>

      <div class="row mt-5">
        
        <div class="col-md-6">
          
           <div class="mb-3 row">
                  <div class="col-sm-3">
                    <label class="col-form-label  text-danger" for="first-name">Selling Price</label>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" id="first-name" class="form-control" name="SellingPrice" value="" >
                  </div>
                </div>


     <div class="mb-3 row">
                  <div class="col-sm-3">
                    <label class="col-form-label  " for="first-name">Account</label>
                  </div>
                  <div class="col-sm-6">
                    <select name="CostChartofAccountID"  class="select2 form-select">
                       @foreach($chartofaccount as $value)
                        <option value="{{$value->ChartOfAccountID}}" >{{$value->ChartOfAccountID}}-{{$value->ChartOfAccountName}}</option>
                       @endforeach
                    </select>
                  </div>
                </div>
                 
              <div class="mb-3 row">
                  <div class="col-sm-3">
                    <label class="col-form-label  " for="first-name">Remarks</label>
                  </div>
                  <div class="col-sm-6">
                   <textarea name="CostDescription" id="" class="form-control" cols="43" rows="3"></textarea>
                  </div>
                </div>   
                
                 
                         

        </div>
        <div class="col-md-6"> 

          <div class="mb-3 row">
                  <div class="col-sm-3">
                    <label class="col-form-label  text-danger" for="first-name">Cost Price</label>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" id="first-name" class="form-control" name="CostPrice" value="" >
                  </div>
                </div>

            <div class="mb-3 row">
                  <div class="col-sm-3">
                    <label class="col-form-label " for="first-name">Account</label>
                  </div>
                  <div class="col-sm-6">
                    <select name="SellingChartofAccountID"  class="form-select select2">
                       @foreach($chartofaccount as $value)
                        <option value="{{$value->ChartOfAccountID}}" >{{$value->ChartOfAccountID}}-{{$value->ChartOfAccountName}}</option>
                       @endforeach
                    </select>
                  </div>
                </div>      

 
        <div class="mb-3 row">
                  <div class="col-sm-3">
                    <label class="col-form-label " for="first-name">Remarks</label>
                  </div>
                  <div class="col-sm-6">
                   <textarea name="SellingDescription" id="" class="form-control" cols="43" rows="3"></textarea>
                  </div>
                </div>      


              </div>


      </div>
      </div>
      <div class="card-footer">
        
        <div><button type="submit" class="btn btn-success w-lg float-right">Save</button>
             <a href="{{URL('/')}}" class="btn btn-secondary w-lg float-right">Cancel</a>
        
        
      </div>
  </div>
  
  </div>
  </form>

<!-- card end here -->



<div class="card shadow-sm">
    <div class="card-body">
  @if(count($item)>0)    
  <div class="table-responsive">
        <table class="table table-striped  table-sm  m-0" id="student_table" data-page-length="25">
<thead><tr>
<th scope="col">S.No</th>
 <th scope="col">Name</th>
<th scope="col">Description</th>
<th scope="col">Unit</th>
<th scope="col">Unit Qty</th>
<th scope="col">Price</th>
<th scope="col">Taxable</th>
<th scope="col">Tax %</th>
<th scope="col">Action</th>
</tr>
</thead>
<tbody>
@foreach ($item as $key =>$value)
 <tr>
 <td class="col-md-">{{$key+1}}</td>
  <td class="col-md-7">{{$value->ItemName}}</td>
 <td class="col-md-2">{{$value->ItemDescription}}</td>
 <td class="col-md-2">{{$value->UnitName}}</td>
 <td class="col-md-2">{{$value->UnitQty}}</td>
 <td class="col-md-2">{{$value->SellingPrice}}</td>
 <td class="col-md-1">{{$value->Taxable}}</td>
 <td class="col-md-1">{{$value->Percentage}}</td>
 <td class="col-md-2"><a href="{{URL('/ItemEdit/'.$value->ItemID)}}"><i class=" text-dark bx bx-pencil align-middle me-1"></i></a> <a href="#" onclick="delete_confirm2('ItemDelete',{{$value->ItemID}})"><i class="bx bx-trash text-dark  align-middle me-1"></i></a>  </td>
 </tr>
 @endforeach   
 </tbody>
 </table>
</div>
 @else
   <p class=" text-danger">No data found</p>
 @endif 
    </div>
</div>




<div class="card shadow-sm">
  <div class="card-header bg-secondary bg-soft">Import Bulk Data</div>
    <div class="card-body">
      <form method="post" enctype="multipart/form-data" action="{{ url('/ItemImport') }}">
    {{ csrf_field() }}
    <div class="form-group">
     <table class="table">
      <tr>
       <td width="40%" align="right"><label>Select File for Upload</label></td>
       <td width="30">
         <input type="file" name="file1" class="form-control" required>
       </td>
       <td width="30%" align="left">
        <input type="submit" name="upload" class="btn btn-primary" value="Upload">
       </td>
      </tr>
      <tr>
       <td width="40%" align="right"></td>
       <td width="30"><span class="text-muted">.xls, .xslx</span></td>
       <td width="30%" align="left"></td>
      </tr>
     </table>
    </div>
   </form>
    </div>
</div>

  

</div>

        </div>
      </div>
    </div>
    <!-- END: Content-->


         <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


<script>
  $(document).on('change ','#Taxable',function(){
  if($('#Taxable').val()=='Yes')
  {
     $("#Percentage").prop("disabled", false);
     $("#Percentage").focus();
     $("#Percentage").attr("placeholder", "5").placeholder();

  }
  else
  {
    $("#Percentage").prop("disabled", true);
    $("#Percentage").removeAttr("placeholder");
  }

  

});


 

 

</script>






<script>


$( document ).ready(function() {
    if($('#ItemType').val()=='Service')
  {
    
    $("#unit").addClass("d-none");
    $("#unitqty").addClass("d-none");


  }
  else
  {
      $("#unit").removeClass("d-none");
      $("#unitqty").removeClass("d-none");
  }
});


  $(document).on('change ','#ItemType',function(){
  if($('#ItemType').val()=='Service')
  {
    
    $("#unit").addClass("d-none");
    $("#unitqty").addClass("d-none");


  }
  else
  {
      $("#unit").removeClass("d-none");
      $("#unitqty").removeClass("d-none");
  }

  

});


 

 

</script>

 




</script>
<script type="text/javascript">
$(document).ready(function() {
     $('#student_table').DataTable( );
});
</script>

    <!-- my own model -->
 <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
           <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Confirmation</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
         <div class="modal-body">
         <p class="text-center">Are you sure to delete this information ?</p>
         <p class="text-center">
            
            
 
<a href="#" class="btn btn-danger " id="delete_link">Delete</a>
                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">Cancel</button>
                    
         </p>
         </div>
              
         </div>
    </div>
 </div>
<!-- end of my own model -->

<!-- <script>
  window.onbeforeunload = function() {
  return 'Your changes will be lost!';
};
</script> -->

 

 
 
  @endsection


