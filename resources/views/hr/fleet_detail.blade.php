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

                   <h4>Fleet Detail</h4>       
      
<div class="row">
    <div class="card">
         <div class="card-body"></div>
      
         <!-- enctype="multipart/form-data" -->
        <form action="{{URL('/FleetDetailSave')}}" method="post">


         {{csrf_field()}} 


      <div class="row">
 

 
         <div class="col-md-3">
      <div class="mb-3">
         <label for="basicpill-firstname-input">Vehicle*</label>
          <select name="FleetMasterID" id="FleetMasterID" class="form-select">
 
          @foreach($fleet_master as $value)
           <option value="{{$value->FleetMasterID}}" >{{$value->VehicleModel}}</option>
          @endforeach
         
      
       </select>
       </div>
        </div>

           
        
           


           
                 
                   <div class="col-md-2">
                            <div class="mb-3">
                              <label for="basicpill-firstname-input">Registration Start Date</label>
                                  <input name="RegistrationStartDate" id="input-date1" class="form-control input-mask" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd/mm/yyyy" value="{{old('RegistrationStartDate')}}" im-insert="false">
                                  <span class="text-muted">e.g "dd/mm/yyyy"</span>
                         </div>
                     </div> 
                       


                   <div class="col-md-2">
                            <div class="mb-3">
                              <label for="basicpill-firstname-input">Registration End  Date</label>
                                  <input name="RegistrationEndDate" id="input-date1" class="form-control input-mask" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd/mm/yyyy" value="{{old('RegistrationEndDate')}}" im-insert="false">
                                  <span class="text-muted">e.g "dd/mm/yyyy"</span>
                         </div>
                     </div> 
                       
           
   <div class="col-md-2">
                            <div class="mb-3">
                              <label for="basicpill-firstname-input">Insurance Start Date</label>
                                  <input name="InsuranceStartDate" id="input-date1" class="form-control input-mask" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd/mm/yyyy" value="{{old('InsuranceStartDate')}}" im-insert="false">
                                  <span class="text-muted">e.g "dd/mm/yyyy"</span>
                         </div>
                     </div> 


                       <div class="col-md-2">
                            <div class="mb-3">
                              <label for="basicpill-firstname-input">Insurance End Date</label>
                                  <input name="InsuranceEndDate" id="input-date1" class="form-control input-mask" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd/mm/yyyy" value="{{old('InsuranceEndDate')}}" im-insert="false">
                                  <span class="text-muted">e.g "dd/mm/yyyy"</span>
                         </div>
                     </div> 
 
 

  <div class="col-md-3">
<div class="mb-3">
<label for="basicpill-firstname-input">Insurance Company Name*</label>
<input type="text" class="form-control" name="InsuranceCompanyName" value="{{old('InsuranceCompanyName')}} ">
</div>
</div>


<div class="col-md-2">
<div class="mb-3">
<label for="basicpill-firstname-input">Last Reading</label>
<input type="text" class="form-control" name="LastReading" value="{{old('LastReading')}} ">
</div>
</div>


         <div class="col-md-2">
                            <div class="mb-3">
                              <label for="basicpill-firstname-input">Oil Change Date</label>
                                  <input name="OilChangeDate" id="input-date1" class="form-control input-mask" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd/mm/yyyy" value="{{old('OilChangeDate')}}" im-insert="false">
                                  <span class="text-muted">e.g "dd/mm/yyyy"</span>
                         </div>
                     </div> 


  

                             <div class="col-md-2">
                            <div class="mb-3">
                              <label for="basicpill-firstname-input">Oil Due Date</label>
                                  <input name="OilDueDate" id="input-date1" class="form-control input-mask" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd/mm/yyyy" value="{{old('OilDueDate')}}" im-insert="false">
                                  <span class="text-muted">e.g "dd/mm/yyyy"</span>
                         </div>
                     </div> 






 


      </div>
         
        

         <div><button type="submit" class="btn btn-success btn-sm float-right">Save / Update</button>
              <a href="{{URL('/')}}" class="btn btn-secondary  btn-sm float-right">Cancel</a>
         </div>
          
         


        </form>              
                 

    </div>
</div>
     

         <div class="card">
        <div class="card-body">
            
            <h5>Vehicles</h5>

             @if(count($fleet_detail)>0)        
            <table class="table table-sm align-middle table-nowrap mb-0">
            <tbody><tr>
            <th scope="col">S.No</th>
            <th scope="col">Reg Start Date</th>
            <th scope="col">Reg End Date</th>
            <th scope="col">Insurance By</th>
            <th scope="col">Insurance Start Date</th>
            <th scope="col">Insurance End Date</th>
            <th scope="col">Oil Reading</th>
            <th scope="col">Oil Change Date</th>
            <th scope="col">Oil Due Date</th>
            <th scope="col">Delete</th>
            
           
            </tr>
            </tbody>
            <tbody>
            @foreach ($fleet_detail as $key =>$value)
             <tr>
             <td class="col-md-1">{{$key+1}}</td>
             <td class="col-md-2">{{dateformatman($value->RegistrationStartDate)}}</td>
             <td class="col-md-2">{{dateformatman($value->RegistrationEndDate)}}</td>
             <td class="col-md-2">{{dateformatman($value->InsuranceStartDate)}}</td>
             <td class="col-md-2">{{dateformatman($value->InsuranceEndDate)}}</td>
             <td class="col-md-2">{{$value->InsuranceCompanyName}}</td>
             <td class="col-md-2">{{$value->LastReading}}</td>
             <td class="col-md-2">{{dateformatman($value->OilChangeDate)}}</td>
             <td class="col-md-2">{{dateformatman($value->OilDueDate)}}</td>
             
             
         
              <td class="col-md-1"><a href="{{URL('/FleetDetailDelete/'.$value->FleetDetailID)}}">Delete</a></td>
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