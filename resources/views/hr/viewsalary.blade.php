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
                                    <h4 class="mb-sm-0 font-size-18">Salary Section</h4>

                                    <div class="page-title-right">
                                        <div class="page-title-right">
                                         <!-- button will appear here -->ss
                                    </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-12">
                                 @if (session('error'))

<div class="alert alert-{{ Session::get('class') }} p-3">
                    
                  <strong>{{ Session::get('error') }} </strong>
                </div>

@endif

  @if (count($errors) > 0)
                                 
                            <div >
                <div class="alert alert-danger pt-3 pl-0   border-3 bg-danger text-white">
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
                                        <h4 class="card-title mb-4"></h4>
 

<form action="{{URL('/SearchSalary')}}" method="post"> {{csrf_field()}} 
    <div class="col-md-4">
 <div class="mb-3">
    <label for="basicpill-firstname-input">Branch*</label>
     <select name="BranchID" id="BranchID" class="form-select" required="">
    <option value="">Select</option>
 <?php foreach ($branch as $key => $value): ?>
 	<option value="{{$value->BranchID}}">{{$value->BranchName}}</option>
 <?php endforeach ?>
  </select>
  </div>
   </div>  

   <div class="col-md-4">
 <div class="mb-3">
    <label for="basicpill-firstname-input">Month*</label>
     <select name="MonthName" id="MonthName" class="form-select" required="">
    <option value="">Select</option>
 <?php foreach ($monthname as $key => $value): ?>
    <option value="{{$value->MonthName}}">{{$value->MonthName}}</option>
 <?php endforeach ?>
  </select>
  </div>
   </div>

<div>
	<button type="submit" class="btn btn-success w-lg float-right">Search</button>
     
</div>

</form>


                                        
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->

                           
                        </div>
                        <!-- end row -->

                      

                       

                         
                     
                        
                    </div> <!-- container-fluid -->
                </div>


  @endsection