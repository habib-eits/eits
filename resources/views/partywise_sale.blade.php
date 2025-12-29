@extends('tmp')

@section('title', $pagetitle)
 

@section('content')

<div class="main-content">

 <div class="page-content">
 <div class="container-fluid">
<div class="row">
  <div class="col-12">
  
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

            
  <div class="card shadow-sm mt-5">
      <div class="card-body">
          <!-- enctype="multipart/form-data" -->
          <form  action="PartyWiseSale1"  id="myForm" method="post"> 

            {{csrf_field()}} 

 
    
 
          


            
              <div class="col-md-4">
             <div class="mb-0">
                <label for="basicpill-firstname-input">Party</label>
                 <select name="PartyID" id="" class="select2 form-select" id="select2-basic" required="">
                <option value="0">Select</option>
               <?php foreach ($party as $key => $value): ?>
                  <option value="{{$value->PartyID}}">{{$value->PartyName}}</option>
                  
                <?php endforeach ?>
              </select>
              </div>
               </div>



                      <div class="col-md-4 mt-2">
             <div class="mb-0">
                <label for="basicpill-firstname-input">Branch</label>
                 <select name="BranchID" id="BranchID" class="select2 form-select" id="select2-basic" required="">
                <option value="0">Select</option>
               <?php foreach ($branch as $key => $value): ?>
                  <option value="{{$value->BranchID}}">{{$value->BranchName}}</option>
                  
                <?php endforeach ?>
              </select>
              </div>
               </div>
            
 

             

                <div class="col-md-4"> 
                   <label class="col-form-label" for="email-id">From Date</label>
                 <div class="input-group" id="datepicker21">
  <input type="text" name="StartDate"  autocomplete="off" class="form-control" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-

container="#datepicker21" data-provide="datepicker" data-date-autoclose="true" value="{{date('Y-m-d')}}">
  <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
    </div>
              </div>

                <div class="col-md-4"> 
                   <label class="col-form-label" for="email-id">To Date</label>
               <div class="input-group" id="datepicker22">
  <input type="text" name="EndDate"  autocomplete="off" class="form-control" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-

container="#datepicker22" data-provide="datepicker" data-date-autoclose="true" value="{{date('Y-m-d')}}">
  <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
    </div>
              </div>


              
              
         
      </div>
      <div class="card-footer bg-light">
        <button type="submit" class="btn btn-success w-lg float-right">Submit</button>
        <button type="submit" class="btn btn-success w-lg float-right" id="pdf">PDF</button>
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
        $(document).ready(function() {
            // When the first button is clicked, change the form's action and target to open in the same tab
            $('#online').click(function(event) {
                event.preventDefault(); // Prevent the default form submission
                $('#myForm').attr('action', '{{URL("/PartyWiseSale1")}}'); // Set the action to report1
                $('#myForm').attr('target', '_self'); // Open in the same tab
                $('#myForm').submit(); // Submit the form
            });

            // When the second button is clicked, change the form's action and target to open in a new tab
            $('#pdf').click(function(event) {
                event.preventDefault(); // Prevent the default form submission
                $('#myForm').attr('action', '{{URL("/PartyWiseSale1PDF")}}'); // Set the action to report2
                $('#myForm').attr('target', '_blank'); // Open in a new tab
                $('#myForm').submit(); // Submit the form
            });
        });
    </script>



  @endsection