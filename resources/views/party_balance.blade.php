@extends('tmp')

@section('title', $pagetitle)
 

@section('content')

 
 <div class="main-content">

<div class="page-content">
<div class="container-fluid">

            
  <div class="card shadow-sm">
      <div class="card-body">
          <!-- enctype="multipart/form-data" -->
          <form action="{{URL('/PartyBalance1')}}" method="post" name="form1" id="form1"> {{csrf_field()}} 

 
        

          


            
              <div class="col-md-4">
             <div class="mb-1">
                <label for="basicpill-firstname-input">Parties</label>
                 <select name="PartyID" id="" class="select2 form-select" id="select2-basic"  >
                <option value="">All Parties</option>
               <?php foreach ($party as $key => $value): ?>
                  <option value="{{$value->PartyID}}">{{$value->PartyName}}</option>
                  
                <?php endforeach ?>
              </select>
              </div>
               </div>
            
 
  <div class="col-md-4">
             <div class="mb-0">
                <label for="basicpill-firstname-input"></label>
                 <select name="ReportType" id="" class="  form-select" id="select2-basic">
                <option value="D">Debitor Customer</option>
                <option value="C">Creditor Customer</option>
               
              </select>
              </div>
               </div>
             


                    <div class="col-md-4"> 
                   <label class="col-form-label" for="email-id">Start Date</label>
                 <div class="input-group" id="datepicker21">
  <input type="text" name="StartDate"  autocomplete="off" class="form-control" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-container="#datepicker21" data-provide="datepicker" data-date-autoclose="true" value="{{date('Y-m-d')}}">
  <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
    </div>
              </div>

                <div class="col-md-4 "> 
                   <label class="col-form-label" for="email-id">End Date</label>
               <div class="input-group" id="datepicker22">
  <input type="text" name="EndDate"  autocomplete="off" class="form-control" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-container="#datepicker22" data-provide="datepicker" data-date-autoclose="true" value="{{date('Y-m-d')}}">
  <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
    </div>
              </div>


           
     
                
       
         
      </div>
      <div class="card-footer bg-light">
         <button type="submit" class="btn btn-success w-lg float-right" id="online">Submit</button>
         <button type="submit" class="btn btn-success w-lg float-right" id="areawise">Areawise</button>
         <button type="submit" class="btn btn-success w-lg float-right" id="itemwise">Itemwise Sale</button>
        <button type="submit" class="btn btn-success w-lg float-right" id="pdf">PDF</button>
        <button type="submit" class="btn btn-success w-lg float-right" id="excel">Excel</button>
                   <a href="{{URL('/')}}" class="btn btn-secondary w-lg float-right">Cancel</a>
      </div>
  </div>
   </form>
  </div>
</div>

        </div>
      </div>
    </div>
    <!-- END: Content-->
 
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script>
  $('#pdf').click(function(){
     
   $('#form1').attr('action', '{{URL("/PartyBalance1PDF")}}');
   $('#form1').attr('target', '_blank');
   

});


  $('#online').click(function(){
     
   $('#form1').attr('action', '{{URL("/PartyBalance1")}}');
 
   $('#form1').removeAttr('target');

});


 $('#itemwise').click(function(){
     
   $('#form1').attr('action', '{{URL("/PartySaleItemWise")}}');
 
   $('#form1').removeAttr('target');

});


 $('#areawise').click(function(){
     
   $('#form1').attr('action', '{{URL("/PartyBalanceAreawise2PDF")}}');
 
   $('#form1').removeAttr('target');

});


 $('#excel').click(function(){
     
   $('#form1').attr('action', '{{URL("/Excel")}}');
 
   $('#form1').removeAttr('target');

});


</script>


  @endsection