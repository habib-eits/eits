@extends('tmp')

@section('title', $pagetitle)
 

@section('content')
  <!-- BEGIN: Content-->

    <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid"><div class="row">

                      <div class="row">


 @if (session('error'))

<div class="alert alert-{{ Session::get('class') }} p-3"  id="success-alert">
                    
                  <strong>{{ Session::get('error') }} </strong>
                </div>

@endif

  @if (count($errors) > 0)
                                 
                            <div >
                <div class="alert alert-danger p-1   border-1 bg-danger text-white">
                   <p class="font-weight-bold"> There were some problems with your input.</p>
                    <ul>
                        
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>

                        @endforeach
                    </ul>
                </div>
                </div>

            @endif


  <div class="col-12">
  
  <!-- enctype="multipart/form-data" -->
 <!-- enctype="multipart/form-data" -->
 <form action="{{URL('/ItemUpdate')}}" method="post"> 
<input type="hidden" name="ItemID" value="{{$item[0]->ItemID}}">
 {{csrf_field()}} 
 <div class="card shadow-sm">
    <div class="card-header">
      <h2>Item</h2>
    </div>
      <div class="card-body">
         <div class="col-md-6 col-sm-12">
                

                
                 
                
                
                
          <?php 

                $item_type = DB::table('item_type')->get(); ?>
                 
                
                
                  <div class="mb-3 row">
                  <div class="col-sm-2">
                    <label class="col-form-label fw-bold" for="first-name">Type</label>
                  </div>
                  <div class="col-sm-9">
                    <select name="ItemType" id="ItemType" class="form-select">
                  @foreach($item_type as $value)
                 <option value="{{$value->ItemType}}" {{($value->ItemType== $item[0]->ItemType) ? 'selected=selected':'' }}>{{$value->ItemType}}</option>
                 @endforeach
                      </select>
                  </div>
                </div>
              

                <div class="mb-3 row">
                  <div class="col-sm-2">
                    <label class="col-form-label fw-bold" for="first-name">Name</label>
                  </div>
                  <div class="col-sm-9">
                    
                    <input type="text" id="first-name" class="form-control" name="ItemName"  value="{{$item[0]->ItemName}}" >
                    
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
                 <option value="{{$value->UnitName}}" {{($value->UnitName== $item[0]->UnitName) ? 'selected=selected':'' }}>{{$value->UnitName}}</option>
                 @endforeach
                      </select>
                  </div>
                </div>

              

                  <div class="mb-3 row" id="unitqty">
                  <div class="col-sm-2">
                    <label class="col-form-label fw-bold" for="first-name">Unit Quantity</label>
                  </div>
                  <div class="col-sm-9">
                 <input type="number" id="first-name" class="form-control" name="UnitQty" value="{{$item[0]->UnitQty}}" >
                  </div>
                </div>



                 <div class="mb-3 row">
                  <div class="col-sm-2">
                    <label class="col-form-label fw-bold" for="first-name">Taxable</label>
                  </div>
                  <div class="col-sm-9">
                    <select name="Taxable" id="Taxable" class="form-select">
                        <option value="">Select</option>
                        <option value="No"  {{($item[0]->Taxable== 'No') ? 'selected=selected':'' }}
>No</option>
                        <option value="Yes" {{($item[0]->Taxable== 'Yes') ? 'selected=selected':'' }}>Yes</option>
                  
                      </select>
                  </div>
                </div>

                <div class="mb-1 row">
                  <div class="col-sm-2">
                    <label class="col-form-label fw-bold" for="first-name">Percentage</label>
                  </div>
                  <div class="col-sm-9">
                    <input type="text" id="Percentage"  class="form-control" name="Percentage" value="{{$item[0]->Percentage}}" >
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
                    <input type="text" id="first-name" class="form-control" name="SellingPrice"  value="{{$item[0]->SellingPrice}}">
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
                   <textarea name="CostDescription" id="" class="form-control" cols="43" rows="3">{{$item[0]->CostDescription}}</textarea>
                  </div>
                </div>   
                
                 
                         

        </div>
        <div class="col-md-6"> 

          <div class="mb-3 row">
                  <div class="col-sm-3">
                    <label class="col-form-label  text-danger" for="first-name">Cost Price</label>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" id="first-name" class="form-control" name="CostPrice" value="{{$item[0]->CostPrice}}" >
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
                   <textarea name="SellingDescription" id="" class="form-control" cols="43" rows="3">{{$item[0]->SellingDescription}}</textarea>
                  </div>
                </div>      


              </div>


      </div>
      </div>
      <div class="card-footer">
        
        <div><button type="submit" class="btn btn-success w-lg float-right">Save</button>
             <a href="{{URL('/Item')}}" class="btn btn-secondary w-lg float-right">Cancel</a>
        
        
      </div>
  </div>
  
  </div>
  </form>

<!-- card end here -->




 

  

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
 
  @endsection


