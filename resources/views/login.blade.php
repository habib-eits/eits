<!DOCTYPE html>
<html lang="en" class="h-100">


 <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="robots" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="W3crm:Customer Relationship Management Admin Bootstrap 5 Template">
	<meta property="og:title" content="W3crm:Customer Relationship Management Admin Bootstrap 5 Template">
	<meta property="og:description" content="W3crm:Customer Relationship Management Admin Bootstrap 5 Template">
	<meta property="og:image" content="../../w3crm.dexignzone.com/xhtml/social-image.png">
	<meta name="format-detection" content="telephone=no">
	
	<!-- PAGE TITLE HERE -->
	<title>Accounting Management Software</title>
	
	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="images/favicon.png">
	<link href="{{asset('assets/css/bootstrap-select.min.css')}}" rel="stylesheet">
   <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

</head>



<body class="vh-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row h-100">
				<div class="col-lg-6 col-md-12 col-sm-12 mx-auto align-self-center">
					<div class="login-form">
						<div class="text-center">
							<h3 class="title">Sign In</h3>
							<p>Sign in to your account to start using Accounting Books</p>
						</div>


 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
 <script>
@if(Session::has('error'))
  toastr.options =
  {
    "closeButton" : false,
    "progressBar" : true
  }
        Command: toastr["warning"]("{{session('error')}}")
  @endif
</script>

   @if (session('error'))

 <div class="alert alert-danger p-3" id="success-alert">
                    

                   {{ Session::get('error') }}  
                   
                </div>

@endif

						<form action="{{URL('/UserVerify')}}" method="post">

							{{csrf_field()}}


							<div class="mb-4">
								<label class="mb-1 text-dark">Email</label>
								<input type="email"  name="username" class="form-control form-control" value="{{old('username')}}">
							</div>
							<div class="mb-4 position-relative">
								<label class="mb-1 text-dark">Password</label>
								<input type="password" name="password" id="dz-password" class="form-control" value="{{old('password')}}">
								<span class="show-pass eye">
								
									<i class="fa fa-eye-slash"></i>
									<i class="fa fa-eye"></i>
								
								</span>
							</div>
							<div class="form-row d-flex justify-content-between mt-4 mb-2">
								<div class="mb-4">
									<div class="form-check custom-checkbox mb-3">
										<input type="checkbox" class="form-check-input" id="customCheckBox1" >
										<label class="form-check-label" for="customCheckBox1">Remember my preference</label>
									</div>
								</div>
								<div class="mb-4">
									<a href="page-forgot-password.html" class="btn-link text-primary">Forgot Password?</a>----
								</div>
							</div>
							<div class="text-center mb-4">
								<button type="submit" class="btn btn-primary btn-block">Sign In</button>
							</div>
							<h6 class="login-title"><span>Or continue with</span></h6>
							
							<div class="mb-3">
								<ul class="d-flex align-self-center justify-content-center">
									<li><a target="_blank" href="https://www.facebook.com/" class="fab fa-facebook-f btn-facebook"></a></li>
									<li><a target="_blank" href="https://www.google.com/" class="fab fa-google-plus-g btn-google-plus mx-2"></a></li>
									<li><a target="_blank" href="https://www.linkedin.com/" class="fab fa-linkedin-in btn-linkedin me-2"></a></li>
									<li><a target="_blank" href="https://twitter.com/" class="fab fa-twitter btn-twitter"></a></li>
								</ul>
							</div>
							<p class="text-center"><p> &copy; Copyright {{date('Y')}} {{$company[0]->Name}}. All rights reserved. </p>
							</p>
						</form>

						        



					</div>
				</div>
                <div class="col-xl-6 col-lg-6">
					<div class="pages-left h-100">
						<div class="login-content">
							<a href="index.html"><img src="images/logo-full.png" class="mb-3 logo-dark" alt=""></a>
							<a href="index.html"><img src="images/logi-white.png" class="mb-3 logo-light" alt=""></a>
							
							<p>"Unlock the potential of precision with our accountancy book software "</p>
						</div>
						<div class="login-media text-center">
							<img src="{{asset('assets/images/login.png')}}" alt="">
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>

<!--**********************************
	Scripts
***********************************-->
<!-- Required vendors -->
 <script src="{{asset('assets/js/global.min.js')}}"></script>
   <script src="{{asset('assets/js/custom.js')}}"></script>

 
 <script src="{{asset('assets/js/custom.js')}}"></script>
<script src="{{asset('assets/js/deznav-init.js')}}"></script>
<script src="{{asset('assets/js/demo.js')}}"></script>

<script src="{{asset('assets/js/styleSwitcher.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<script >
	
	$(document).on('onclick', '.eye', function() {
            alert('dd');
        });

</script>
 
</body>

</html>