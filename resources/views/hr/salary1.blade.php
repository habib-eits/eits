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
                                         <!-- button will appear here -->
                                    </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->


 @if (session('error'))

<div class="alert alert-{{ Session::get('class') }} p-3">
                    
                  {{ Session::get('error') }} 
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
                                        <!-- <h4 class="card-title mb-4"></h4> -->
                                        <form action="{{URL('/Salary2')}}" method="post"> {{csrf_field()}} 

                                          
                                            
                                        <div class="row">
                                                    <div class="col-md-6">
                                             <div class="mb-3">
                                                <label for="basicpill-firstname-input">Branch*</label>
                                                 <select name="BranchID" id="BranchID" class="form-select">
                                                <option value="">Select</option>
                                               @foreach($branch as $value)
                                               <option value="{{$value->BranchID}}" {{(old('BranchID')== $value->BranchID) ? 'selected=selected': '' }}>{{$value->BranchName}}</option>
                                              @endforeach
                                             
                                              </select>
                                              </div>
                                               </div>
                                            
                                            
                                                 <div class="col-md-6">
                                             <div class="mb-3">
                                                <label for="basicpill-firstname-input">Month*</label>
                                                 <select name="MonthName" id="MonthName" class="form-select">
                                                <option value="">Select</option>
                                             
                                              @foreach($monthname as $value)
                                               <option value="{{$value->MonthName}}" {{(old('MonthName')== $value->MonthName) ? 'selected=selected': '' }}>{{$value->MonthName}}</option>
                                              @endforeach
                                             
                                              </select>
                                              </div>
                                               </div>
                                            

                                                 


                                               <div><button type="submit" class="btn btn-success w-lg float-right">Save / Update</button>
                                                    <a href="{{URL('/')}}" class="btn btn-secondary w-lg float-right">Cancel</a>
                                               </div>
                                               
                                            
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