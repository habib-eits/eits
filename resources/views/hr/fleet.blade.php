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
                                    <h4 class="mb-sm-0 font-size-18">Fleet Management</h4>

                                    <div class="page-title-right">
                                        <div class="page-title-right">
                                         <!-- button will appear here -->ss
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
        <form action="{{URL('/FleetSave')}}" method="post">


         {{csrf_field()}} 


      <div class="row">
          
               <div class="col-md-3">
         <div class="mb-3">
         <label for="basicpill-firstname-input">Vehicle Model*</label>
         <input type="text" class="form-control form-control-sm" name="VehicleModel" value="{{old('VehicleModel')}} " >
         </div>
         </div>


      <div class="col-md-3">
         <div class="mb-3">
         <label for="basicpill-firstname-input">Owner Name*</label>
         <input type="text" class="form-control form-control-sm" name="OwnerName" value="{{old('OwnerName')}} "  >
         </div>
         </div>



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

                      

    <div class="card">
        <div class="card-body">
            
            <h5>Vehicles</h5>

             @if(count($fleet_master)>0)        
            <table class="table table-sm align-middle table-nowrap mb-0">
            <tbody><tr>
            <th scope="col">S.No</th>
            <th scope="col">Vehicle Model</th>
            <th scope="col">Owner Name</th>
            <th scope="col"></th>
            <th scope="col"></th>
           
            </tr>
            </tbody>
            <tbody>
            @foreach ($fleet_master as $key =>$value)
             <tr>
             <td class="col-md-1">{{$key+1}}</td>
             <td class="col-md-2">{{$value->VehicleModel}}</td>
             <td class="col-md-10">{{$value->OwnerName}}</td>
             <td class="col-md-1"><a href="{{URL('/FleetDetail/'.$value->FleetMasterID)}}">More Detail</a></td>
             <td class="col-md-1"><a href="{{URL('/FleetEdit/'.$value->FleetMasterID)}}">Edit</a></td>
             <td class="col-md-1"><a href="{{URL('/FleetDelete/'.$value->FleetMasterID)}}">Delete</a></td>
             </tr>
             @endforeach   
             </tbody>
             </table>
             @else
               <p class=" text-danger">No data found</p>
             @endif   


        </div>
    </div>                   

                 
      
        
                    </div> <!-- container-fluid -->
                </div>


  @endsection