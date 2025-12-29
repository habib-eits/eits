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
                                    <h4 class="mb-sm-0 font-size-18">Update Vehicle Data</h4>

                                    <div class="page-title-right">
                                        <div class="page-title-right">
                                         <!-- button will appear here -->
                                    </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

 @if (session('error'))

<div class="alert alert-{{ Session::get('class') }} p-3"  id="success-alert">
                    
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

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        

        <!-- enctype="multipart/form-data" -->
        <form action="{{URL('/FleetUpdate')}}" method="post">


         {{csrf_field()}} 


      <div class="row">
          
               <div class="col-md-3">
         <div class="mb-3">
         <label for="basicpill-firstname-input">Vehicle Model*</label>
         <input type="text" class="form-control form-control-sm" name="VehicleModel" value="{{$fleet[0]->VehicleModel}} " >
         </div>
         </div>


      <div class="col-md-3">
         <div class="mb-3">
         <label for="basicpill-firstname-input">Owner Name*</label>
         <input type="text" class="form-control form-control-sm" name="OwnerName" value="{{$fleet[0]->OwnerName}} "  >
         </div>
         </div>
<input type="hidden" name="FleetMasterID" value="{{$fleet[0]->FleetMasterID}}">


      </div>
         
        

         <div><button type="submit" class="btn btn-success btn-sm float-right">Save / Update</button>
              <a href="{{URL('/')}}" class="btn btn-secondary  btn-sm float-right">Cancel</a>
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