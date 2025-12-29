<!doctype html>
<html lang="en">

    
 <head>
        
        <meta charset="utf-8" />
        <title>Accountancy Software</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta content="Extensive Book Accountancy Software" name="description" />
    <meta content="Extensive Books, UAE" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- owl.carousel css -->
        <link rel="stylesheet" href="{{asset('assets/libs/owl.carousel/assets/owl.carousel.min.css')}}">

        <link rel="stylesheet" href="{{asset('assets/libs/owl.carousel/assets/owl.theme.default.min.css')}}">

        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body class="auth-body-bg">
        
        <div>
            <div class="container-fluid p-0">
                <div class="row g-0">
                    
                    <div class="col-md-8">
                        <div class="auth-full-bg pt-lg-5 p-4" style="background-color: white !important;">
                            <div class="w-100">
                                <div class="bg-overlay"></div>
                                <div class="d-flex h-100 flex-column">
 
                                    <div class="p-4 mt-auto">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-7">
                                                <div class="text-center">
                                                    
                                                    
                                                    <img src="{{asset('assets/svg/graphic1.svg')}}" alt="" width="120%;">
                                                    <!-- <img src="{{asset('assets/svg/banner.svg')}}" alt="" width="120%;"> -->
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-md-4 " >
                        <div class="auth-full-page-content p-md-5 p-4">
                            <div class="w-100">

                                <div class="d-flex flex-column h-100">
                                    <div class="mb-4 mb-md-5">
                                        <!-- display error -->
   @if (session('error'))

 <div class="alert alert-danger p-3" id="success-alert">
                    

                   {{ Session::get('error') }}  
                   
                </div>

@endif

  @if (count($errors) > 0)
                                 
                            <div class="card-body ">
                <div class="alert alert-warning pt-3 pl-0">
                    There were some problems with your input.
                    <ul>
                        
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                </div>
 
            @endif
                                    </div>
                                    <div class="my-auto">
                                        
                                        <div>
                                            <h3 class="text-black">Login To Your Account</h3>
                                            <p class="text-muted">Enter your details to login.</p>
                                        </div>
            
                                        <div class="mt-4">
                                           <form class="form-horizontal" action="{{URL('/UserVerify')}}" method="post">
                                        {{csrf_field()}}
                                        <div class="mb-3">
                                            <label for="username" class="form-label">EMAIL ADDRESS</label>
                                            <input type="text" name="username" class="form-control" id="username" placeholder="Enter username" value="{{old('username')}}">
                                        </div>
                
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input name="password" type="password" class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon" value="{{old('password')}}">
                                                <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            </div>
                                        </div>

                                      
                                        
                                        <div class="mt-4 d-grid">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit">LOGIN</button>
                                        </div>
            
                                         

                                        <div class="mt-4 text-center">
                                            <a href="#" class=" text-muted "><i class="mdi mdi-lock  me-1 text-muted"></i> Forgot your password?</a>
                                        </div>
                                    </form>
                                            
                                        </div>
                                    </div>
 
                                    <div class="mt-5 mt-md-5 text-center">

                                                                     <p> &copy; Copyright {{date('Y')}} {{$company[0]->Name}}. All rights reserved. </p>

                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container-fluid -->
        </div>

        <!-- JAVASCRIPT -->
        <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

        <!-- owl.carousel js -->
        <script src="{{asset('assets/libs/owl.carousel/owl.carousel.min.js')}}"></script>

        <!-- auth-2-carousel init -->
        <script src="{{asset('assets/js/pages/auth-2-carousel.init.js')}}"></script>
        
        <!-- App js -->
        <script src="{{asset('assets/js/app.js')}}"></script>

    </body>

 </html>
