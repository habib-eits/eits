@extends('template.tmp')

@section('title', 'Branches')
 

@section('content')

 <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Branches</h4>

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

                                        <form action="{{URL('/BranchUpdate')}}" method="post" enctype="multipart/form-data">

                                        <input type="hidden" name="BranchID" value="{{$branch[0]->BranchID}} ">

                                         {{csrf_field()}} 

                                         <div class="row">
                                           <div class="col-md-4">
                                         <div class="mb-3">
                                         <label for="basicpill-firstname-input">Branch*</label>
                                         <input type="text" class="form-control" name="BranchName" value="{{$branch[0]->BranchName}} ">
                                         </div>
                                         </div>
                                         

                                           <div class="col-md-4">
                                         <div class="mb-3">
                                         <label for="basicpill-firstname-input">Contact*</label>
                                         <input type="text" class="form-control" name="BranchContact" value="{{$branch[0]->BranchContact}} ">
                                         </div>
                                         </div>
                                         
                                         
                                           <div class="col-md-4">
                                         <div class="mb-3">
                                         <label for="basicpill-firstname-input">Email*</label>
                                         <input type="text" class="form-control" name="BranchEmail" value="{{$branch[0]->BranchEmail}} ">
                                         </div>
                                         </div>

                                               <div class="col-md-4">
                                         <div class="mb-3">
                                         <label for="basicpill-firstname-input">Address*</label>
                                         <input type="text" class="form-control" name="BranchAddress" value="{{$branch[0]->BranchAddress}} ">
                                         </div>
                                         </div>

                                         <div class="col-md-4">
                                         	<div class="mb-3"><label for="basicpill-firstname-input" class="pr-5">Branch Logo</label><br><input type="file" name="BranchLogo" id="BranchLogo"></div></div>


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