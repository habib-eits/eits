@extends('template.tmp')

@section('title', 'HR')
 

@section('content')

 <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Departments</h4>

                                    <div class="page-title-right">
                                        <div class="page-title-right">
                                         <!-- button will appear here -->
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

                                        <form action="{{URL('/DepartmentUpdate')}}" method="post" >

                                         {{csrf_field()}} 
 
                                         <input type="hidden" class="form-control" name="DepartmentID" value="{{$department[0]->DepartmentID}} ">
                                         
                                         <div class="row">
                                           <div class="col-md-4">
                                         <div class="mb-3">
                                         <label for="basicpill-firstname-input">Department Name*</label>
                                         <input type="text" class="form-control" name="DepartmentName" value="{{$department[0]->DepartmentName}} ">
                                         </div>
                                         </div>
                                         

                                        

                                         	<div><button type="submit" class="btn btn-success w-lg float-right">Save</button>
                                         	     
                                         	</div>
                                         	
                                         
                                         </div>
                                         
                                     
                                         
                                         
                                         
                                         
                                         
                                         

                                     </form>

                                        
                                    </div>
                                    <!-- end card body -->
                                </div> 

                               
                            </div>
                            <!-- end col -->

                           
                        </div>
                        <!-- end row -->

                      

                       

                         
                     
                        
                    </div> <!-- container-fluid -->
                </div>


  @endsection