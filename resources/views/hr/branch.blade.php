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

                    <div>
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

                            <form action="{{URL('/BranchSave')}}" method="post" enctype="multipart/form-data">

                                {{csrf_field()}}

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="basicpill-firstname-input">Branch*</label>
                                            <input type="text" class="form-control" name="BranchName"
                                                value="{{old('BranchName')}} ">
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="basicpill-firstname-input">Contact*</label>
                                            <input type="text" class="form-control" name="BranchContact"
                                                value="{{old('BranchContact')}} ">
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="basicpill-firstname-input">Email*</label>
                                            <input type="text" class="form-control" name="BranchEmail"
                                                value="{{old('BranchEmail')}} ">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="basicpill-firstname-input">Address*</label>
                                            <input type="text" class="form-control" name="BranchAddress"
                                                value="{{old('BranchAddress')}} ">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3"><label for="basicpill-firstname-input" class="pr-5">Branch
                                                Logo</label><br><input type="file" name="BranchLogo" id="BranchLogo">
                                        </div>
                                    </div>


                                    <div><button type="submit" class="btn btn-success w-lg float-right">Save</button>

                                    </div>


                                </div>









                            </form>


                        </div>
                        <!-- end card body -->
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">List of Branches</h4>


                            @if(count($branch) >0)
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap mb-0">
                                    <tbody>
                                        <tr>
                                            <th scope="col">Logo</th>
                                            <th scope="col">Branch Name</th>
                                            <th scope="col">Contact</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </tbody>
                                    <tbody>

                                        @foreach($branch as $value)
                                        <tr>

                                            <td style="width: 100px;"><img src="{{URL('/uploads/'.$value->BranchLogo)}}"
                                                    alt="" class="avatar-md h-auto d-block rounded"></td>
                                            <td>
                                                <h5 class="font-size-13 text-truncate mb-1"><a href="#"
                                                        class="text-dark">{{$value->BranchName}} </a></h5>
                                                <p class="text-muted mb-0"><i
                                                        class="mdi mdi-email-outline align-middle me-1"></i>{{$value->BranchEmail}}
                                                </p>
                                                <p class="text-muted mb-0"><i
                                                        class="bx bxs-map align-middle me-1"></i>{{$value->BranchAddress}}
                                                </p>
                                            </td>
                                            <td><i class="bx bx-phone align-middle me-1"></i> {{$value->BranchContact}}
                                            </td>
                                            <td><a href="{{URL('/BranchEdit/'.$value->BranchID)}}"><i
                                                        class="bx bx-pencil align-middle me-1"></i></a> <a
                                                    href="{{URL('/BranchDelete/'.$value->BranchID)}}"><i
                                                        class="bx bx-trash  align-middle me-1"></i></a></td>
                                            <td>

                                            </td>
                                        </tr>
                                        @endforeach




                                    </tbody>
                                </table>


                            </div>
                            @endif

                            @if(count($branch) ==0)
                            <p class="text-danger h6">No record to display</p>

                            @endif
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