@extends('tmp')

@section('title', 'Employee')
 

@section('content')


  


 <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                          
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Emplyee Section</h4>

                                    <div class="page-title-right">
                                        <div class="page-title-right">
                                         <!-- button will appear here <-->
                                         <a href="{{URL('/Employee')}}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2 w-md"><i class="mdi mdi-arrow-left pr-3"></i> Go Back</a>
                                         </-->
                                    </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->


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


<form action="{{URL('/EmployeeSave')}}" method="post" enctype="multipart/form-data">
                        <div class="row">
 
 {{csrf_field()}}

                          
                            <div  >
                                 <div class="card shadow-sm" >
                   <div class="card-header bg-transparent border-bottom h5">

                                                                  Personal Information
                                                              </div>
          <div class="card-body">
                                                                <!-- start of personal detail row -->
      <div class="row">
                                                           <div class="col-md-4">
                <div class="mb-3"><label for="basicpill-firstname-input" class="pr-5">Staff Picture</label><br><input type="file" name="UploadSlip" id="UploadSlip" >
                </div>
        </div>       <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Branch <span class="text-danger">*</span></label>
                                                                <select name="BranchID" id="BranchID" class="form-select">
                                                                    <option value="">---Select---</option>
                                                                    @foreach($branch as $value)
                                                                    <option value="{{$value->BranchID}}" {{(old('BranchID')== $value->BranchID) ? 'selected=selected': '' }}>{{$value->BranchName}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                        </div>

 <div class="col-lg-2">  
  <div class="form-group">
   <label class="control-label" for="IsSupervisor">Is Supervisor? <span class="text-danger">*</span>
</label>
  </div>     <div class="form-check form-check-inline pt-1">
  <input class="form-check-input" type="radio" name="IsSupervisor" id="inlineRadio1" value="Yes" {{ old('IsSupervisor') == 'Yes' ? 'checked' : '' }} required="">
  <label class="form-check-label" for="inlineRadio1">Yes</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" required="" name="IsSupervisor" id="inlineRadio2" value="No"   {{ old('IsSupervisor') == 'No' ? 'checked' : '' }}>
  <label class="form-check-label" for="inlineRadio2">No</label>
</div>
 </div>

  <div class="col-lg-2">
 <div class="mb-3">
  <label for="basicpill-firstname-input">Staff Type <span class="text-danger">*</span></label>
  <select name="StaffType" id="StaffType" class="form-select">
     @foreach($staff_type as $value)
     <option value="{{$value->StaffType}}" {{(old('StaffType')== $value->StaffType) ? 'selected=selected': '' }}>{{$value->StaffType}}</option>
       @endforeach
       
</select>
</div>
 </div>
                                        
 

    <div class="col-md-4">
 <div class="mb-3">
    <label for="basicpill-firstname-input">Title </label>
     <select name="Title" id="Title" class="form-select">
    
     @foreach($title as $value)
      <option value="{{$value->Title}}" {{(old('Title')== $value->Title) ? 'selected=selected': '' }}>{{$value->Title}}</option>
     @endforeach
    
 
  </select>
  </div>
   </div>



                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">First Name</label>
                                                                <input type="text" class="form-control" name="FirstName" value="{{old('FirstName')}} ">
                                        </div>


                                      </div>

                                      <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Middle Name</label>
                                                                <input type="text" class="form-control" name="MiddleName" value="{{old('MiddleName')}} ">
                                        </div>


                                      </div>

                                      <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Last Name</label>
                                                                <input type="text" class="form-control" name="LastName" value="{{old('LastName')}} ">
                                        </div>


                                      </div> 
                                        
                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Date of Birth <span class="text-danger">*</span></label>
                                                                 

                                                                   <input name="DateOfBirth" id="input-date1" class="form-control input-mask" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd/mm/yyyy" value="{{old('DateOfBirth')}}" im-insert="false">
                                                            <span class="text-muted">e.g "dd/mm/yyyy"</span>



                                                            </div>

                                      </div> 

                                         <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Gender</label>
                                                                <select name="Gender" id="Gender" class="form-select">
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select>
                                                            </div>
                                        </div>

                                              <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Email <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="Email" value="{{old('Email')}} ">
                                        </div>


                                      </div> 

                                         <div class="col-md-4">
<div class="mb-3">
    <label for="basicpill-firstname-input">Nationality</label>
    <select name="Nationality" id="Nationality" class="form-select select2">
        @foreach($country as $value)
        <option value="{{$value->CountryName}}" {{(old('Nationality')== $value->CountryName) ? 'selected=selected': '' }}>{{$value->CountryName}}</option>
       @endforeach
    </select>
</div>
</div> 

                                            <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Mobile No</label>
                                                                <input type="text" class="form-control" name="MobileNo" value="{{old('MobileNo')}} ">
                                        </div>


                                      </div>   

                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Home Phone</label>
                                                                <input type="text" class="form-control" name="HomePhone" value="{{old('HomePhone')}} ">
                                        </div>


                                      </div> 

                                       <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Full Address</label>
                                                                <input type="text" class="form-control" name="FullAddress" value="{{old('FullAddress')}} ">
                                        </div>


                                      </div> 

                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Education Level</label>
                                                                <select name="EducationLevel" id="EducationLevel" class="form-select">
                                                                    
                                                                     @foreach($educationlevel as $value)
                                                                      <option value="{{$value->EducationLevelName}}" {{(old('EducationLevel')== $value->EducationLevelName) ? 'selected=selected': '' }}>{{$value->EducationLevelName}}</option>
                                                                     @endforeach
                                                                    
                                                                </select>
                                                            </div>
                                        </div>

                                           <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Last Degree</label>
                                                                <input type="text" class="form-control" name="LastDegree" value="{{old('LastDegree')}} ">
                                        </div>


                                      </div>
                                                                </div>
                                                                <!-- end of personal detail row -->
                                                              </div>
                                                          </div>
                                

                                    <div class="card shadow-sm" >
                                       <div class="card-header bg-transparent border-bottom h5">
                                             Marital Detail
                                        </div>
                                      <div class="card-body">
                                    <div class="row">
                                       <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Marital Status</label>
                                                                <select name="MaritalStatus" id="MaritalStatus" class="form-select">
                                                                    <option value="Single">Single</option>
                                                                    <option value="Married">Married</option>
                                                                </select>
                                                            </div>
                                        </div>

                                         <div class="col-md-4 d-none">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">SSN or GID</label>
                                                                <input type="text" class="form-control" name="SSNorGID" value="{{old('SSNorGID')}} ">
                                        </div>


                                      </div> 


                                        <div class="clearfix"></div>

                                         

                                         <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Spouse Name</label>
                                                                <input type="text" class="form-control" name="SpouseName" value="{{old('SpouseName')}} ">
                                        </div>


                                      </div> 

                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Spouse Address</label>
                                                                <input type="text" class="form-control" name="SpouseEmployer" value="{{old('SpouseEmployer')}} ">
                                        </div>


                                      </div> 

                                       <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Spouse Work Phone</label>
                                                                <input type="text" class="form-control" name="SpouseWorkPhone" value="{{old('SpouseWorkPhone')}} ">
                                        </div>


                                      </div>

                                    </div>
                                         </div>
                                   </div>
                                                                                   



                                     <div class="card shadow-sm" >
                                                                     <div class="card-header bg-transparent border-bottom h5">
                                                                           Visa / Passport Section
                                                                       </div>
                                                                       <div class="card-body">
                                                                        <div class="row">
                                                                          
  <div class="col-md-4 ">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Visa Issue Date</label>
                                                                 

                                                                   <input name="VisaIssueDate" id="input-date1" class="form-control input-mask" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd/mm/yyyy" value="{{old('VisaIssueDate')}}" im-insert="false">
                                                            <span class="text-muted">e.g "dd/mm/yyyy"</span>



                                                            </div>

                                      </div>  

                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Visa Expiry Date</label>
                                                                 

                                                               <input name="VisaExpiryDate" id="input-date1" class="form-control input-mask" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd/mm/yyyy" value="{{old('VisaExpiryDate')}}" im-insert="false">
                                                            <span class="text-muted">e.g "dd/mm/yyyy"</span>



                                                            </div>

                                      </div>
  <div class="clearfix"></div>
                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Passport No</label>
                                                                 

                                                                <input name="PassportNo" id="input-date1" class="form-control"  value="{{old('PassportNo')}}"  >
                                                            



                                                            </div>

                                      </div>  

                                       <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Passport Expiry</label>
                                                                 

                                                                  <input name="PassportExpiry" id="input-date1" class="form-control input-mask" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd/mm/yyyy" value="{{old('PassportExpiry')}}" im-insert="false">
                                                            <span class="text-muted">e.g "dd/mm/yyyy"</span>



                                                            </div>

                                      </div>  
  <div class="clearfix"></div>
                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Emirates ID No</label>
                                                                 

                                                                 <input name="EidNo" id="input-date1" class="form-control"  value="{{old('EidNo')}}"  >



                                                            </div>

                                      </div>   

                                      <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Eid Expiry</label>
                                                                 

                                                               <input name="EidExpiry" id="input-date1" class="form-control input-mask" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd/mm/yyyy" value="{{old('EidExpiry')}}" im-insert="false">
                                                            <span class="text-muted">e.g "dd/mm/yyyy"</span>



                                                            </div>

                                      </div> 

                                                                        </div> 
                                                                       </div>
                                                                   </div>
                                                                     



  <div class="card shadow-sm" >
                                  <div class="card-header bg-transparent border-bottom h5">
                                        Next of Kin 
                                    </div>
                                    <div class="card-body">
                                      <div class="row">
                                          <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Next of Kin Name  </label>
                                                                <input type="text" class="form-control" name="NextofKinName" value="{{old('NextofKinName')}} ">
                                        </div>


                                      </div>

                                        <div class="col-md-4">
                                         <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Next of Kin Address </label>
                                                                <input type="text" class="form-control" name="NextofKinAddress" value="{{old('NextofKinAddress')}} ">
                                        </div>


                                      </div>


                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Next of Kin Phone </label>
                                                                <input type="text" class="form-control" name="NextofKinPhone" value="{{old('NextofKinPhone')}} ">
                                        </div>


                                      </div>


                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Next of Kin Relationship </label>
                                                                <input type="text" class="form-control" name="NextofKinRelationship" value="{{old('NextofKinRelationship')}} ">
                                        </div>


                                      </div>

                                      </div>
                                    </div>
                                </div>




  <div class="card shadow-sm" >
                                  <div class="card-header bg-transparent border-bottom h5  ">
                                        Offical Details
                                    </div>
                                    <div class="card-body">
                                      <div class="row">
                                       

                                      <div class="clearfix"></div>


                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Job Title </label>
                                                                <select name="JobTitleID" id="JobTitleID" class="form-select">
                                                                   
                                                                    @foreach($jobtitle as $value)
                                                                     <option value="{{$value->JobTitleID}}" {{(old('JobTitleID')== $value->JobTitleID) ? 'selected=selected': '' }}>{{$value->JobTitleName}}</option>
                                                                    @endforeach
                                                                   
                                                                </select>
                                                            </div>
                                        </div> 
                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Department </label>
                                                                <select name="DepartmentID" id="DepartmentID" class="form-select">
                                                                    
                                                                     @foreach($department as $value)
                                                                      <option value="{{$value->DepartmentID}}" {{(old('DepartmentID')== $value->DepartmentID) ? 'selected=selected': '' }}>{{$value->DepartmentName}}</option>
                                                                     @endforeach
                                                                    
                                                                </select>
                                                            </div>
                                        </div>

                                          <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Supervisor </label>
                                                                <select name="SupervisorID" id="SupervisorID" class="form-select select2">
                                                                    <option value="">---Select---</option>
                                                                     @foreach($supervisor as $value)
                                                                      <option value="{{$value->EmployeeID}}" {{(old('SupervisorID')== $value->EmployeeID) ? 'selected=selected': '' }}>{{$value->FirstName}}</option>
                                                                     @endforeach
                                                                    
                                                                </select>
                                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                            <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Work Location </label>
                                                                <input type="text" class="form-control" name="WorkLocation" value="{{old('WorkLocation')}} ">
                                        </div>


                                      </div>

                                          <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Email Offical</label>
                                                                <input type="text" class="form-control" name="EmailOffical" value="{{old('EmailOffical')}} ">
                                        </div>


                                      </div>

                                          <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Work Phone</label>
                                                                <input type="text" class="form-control" name="WorkPhone" value="{{old('WorkPhone')}} ">
                                        </div>


                                      </div>

                                          <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Date of Joining <span class="text-danger">*</span></label>
                                                                 
        <input name="StartDate" id="input-date1" class="form-control input-mask" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd/mm/yyyy" value="{{old('StartDate')}}" im-insert="false" >
                 <span class="text-muted">e.g "dd/mm/yyyy"</span>
                                        </div>




                                      </div>

                                          <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Salary <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="Salary" value="{{old('Salary')}} " required="">
                                        </div>


                                      </div>

                                         <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Salary Comission (If Any)</label>
                                                                <input type="text" class="form-control" name="ExtraComission" value="{{old('Salary')}} ">
                                        </div>


                                      </div>


                                          <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input">Salary Remarks </label>
                                                                <input type="text" class="form-control" name="SalaryRemarks" value="{{old('SalaryRemarks')}} ">
                                        </div>
                                      </div>




                                      </div>
                                    </div>
                                </div>

                        
                                <!-- end card -->


   <div class="card shadow-sm">
        <div class="card-header bg-transparent border-bottom h5">
              Bank Details 
          </div>
          <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                                  <div class="mb-3">
                                      <label for="basicpill-firstname-input">Bank Name  </label>
                                      <input type="text" class="form-control" name="BankName" value="{{old('BankName')}} ">
              </div>


            </div>

              <div class="col-md-4">
               <div class="mb-3">
                                      <label for="basicpill-firstname-input">IBAN # </label>
                                      <input type="text" class="form-control" name="IBAN" value="{{old('IBAN')}} ">
              </div>


            </div>


              <div class="col-md-4">
                                  <div class="mb-3">
                                      <label for="basicpill-firstname-input">Account Title </label>
                                      <input type="text" class="form-control" name="AccounTitle" value="{{old('AccounTitle')}} ">
              </div>


            </div>


              <div class="col-md-4">
                                  <div class="mb-3">
                                      <label for="basicpill-firstname-input">Salary Type </label>
                                      <select name="SalaryTypeID" class="form-select">


                                         @foreach($salary_type as $value)
                                          <option value="{{$value->SalaryTypeID}}" >{{$value->SalaryType}}</option>
                                         @endforeach
                                        
                                         
                                      </select>
                                     </div>


            </div>

            </div>
                    <div><button type="submit" class="btn btn-success w-md float-right">Save </button>
 <a href="#" onclick="history.back()" class="btn btn-secondary w-md float-right">Cancel</a>                                     </div>
          </div>


  </div>
                          
                                
                            </div>
                            <!-- end col -->

                           
                        </div>
                        <!-- end row -->

                       </form> 

                    

                         
                     
                        
                    </div> <!-- container-fluid -->
                </div>


 
  @endsection

  redirect:



   
    
     
 

 