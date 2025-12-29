@extends('template.tmp')

@section('title', 'Manage Letters')
 

@section('content')

 <div class="main-content">

 <div class="page-content">
<div class="container-fluid">

 <!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
 <h4 class="mb-sm-0 font-size-18">Manage Letter Templates</h4>

 <div class="page-title-right">
<div class="page-title-right">

</div>
</div>
</div>
</div>
<div>
 <!-- end page title -->

 @if (session('error'))

 <div class="alert alert-{{ Session::get('class') }} p-3">
                    
                   {{ Session::get('error') }}  
                </div>

@endif


<div class="row">
 <div class="col-12">
 

    <form action="{{URL('/letter_update')}}" method="post">
        {{csrf_field()}}
<div class="card">
<div class="card-body">

<h4 class="card-title">Letter Templates</h4>
<p class="card-title-desc"> </p>

 <div class="mb-3 row">
<label for="example-text-input" class="col-md-2 col-form-label">project</label>
<div class="col-md-10">
 
</div>
 </div>


 
<div class="mb-3 row">
<label for="example-email-input" class="col-md-2 col-form-label">Title</label>
<div class="col-md-10">
<input class="form-control" type="text"  name="title"  value="{{$letter[0]->Title}}" id="example-email-input" required>
<input class="form-control" type="hidden"  name="letter_id"  value="{{$letter[0]->LetterID}}" id="example-email-input" required>
</div>
</div>


<div class="mb-3 row">
<label for="example-email-input" class="col-md-2 col-form-label"> </label>
<div class="col-md-10">
 <div class="card border border-light">
                                    <div class="card-header bg-transparent border-bottom">
                                          <strong>Use following Wildcards in letter</strong>

                                      </div>
                                      <div class="card-body">
                                          <div class="row mb-3">
    <div class="col-sm-2" id="myText" onclick="copyText()"> Full Name</div>
    <div class="col-sm-2" id="myText" onclick="copyText()"> ^FullName^</div>
    <div class="col-sm-2" id="myText" onclick="copyText()"> First Name</div>
    <div class="col-sm-2" id="myText" onclick="copyText()"> ^FirstName^</div>
    <div class="col-sm-2" id="myText" onclick="copyText()"> Passport</div>
    <div class="col-sm-2" id="myText" onclick="copyText()"> ^Passport^</div>
    
  </div>
   <div class="row mb-3">
    <div class="col-sm-2" id="myText" onclick="copyText()"> Location</div>
    <div class="col-sm-2" id="myText" onclick="copyText()"> ^Location^</div>
    <div class="col-sm-2" id="myText" onclick="copyText()"> Nationality</div>
    <div class="col-sm-2" id="myText" onclick="copyText()"> ^Nationality^</div>
    <div class="col-sm-2" id="myText" onclick="copyText()"> Designation</div>
    <div class="col-sm-2" id="myText" onclick="copyText()"> ^Designation^</div>
    
  </div>
   <div class="row mb-3">
    <div class="col-sm-2" id="myText" onclick="copyText()"> Joing Date</div>
    <div class="col-sm-2" id="myText" onclick="copyText()"> ^JoingDate^</div>
    <div class="col-sm-2" id="myText" onclick="copyText()"> Salary</div>
    <div class="col-sm-2" id="myText" onclick="copyText()"> ^Salary^</div>
    <div class="col-sm-2" id="myText" onclick="copyText()"> </div>
    <div class="col-sm-2" id="myText" onclick="copyText()"> </div>
    
  </div>
 
   
                                      </div>
                                  </div>
</div>
</div>

<div class="mb-3 row">
<label for="example-email-input" class="col-md-2 col-form-label">Content</label>
<div class="col-md-10">
 <textarea id="basic-example" name="content">
 
{{$letter[0]->Content}}
 
   
 
 

  
 

  
 
</textarea>
 
  <script src="{{URL('/assets/js/tinymce.min.js')}}"></script>
      <script id="rendered-js" >
tinymce.init({
  selector: 'textarea',
  height: 500,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code help wordcount'
  ],
  mobile: { 
    theme: 'mobile' 
  },
  toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tiny.cloud/css/codepen.min.css'
  ],
});
//# sourceURL=pen.js
    </script>
</div>
</div>
 
 
 
                                      
    <input type="submit" class="btn btn-primary w-md" value="Update">
    <a href="{{URL('/Letter')}}" class="btn btn-secondary w-md">Cancel</a>                                   
                                   
    
                                      
                                        

                                       

                                    </div>
                                </div>

                            </form>
                            </div> <!-- end col -->
                        </div>
                      
                     
 
                         
                     
                        
                    </div> <!-- container-fluid -->
                </div>


    
</div>
<script>
  function copyText(){
    var url = "http://www.myurl.com/viewReport.php?id=";
    var text = "^"+document.getElementById("myText").innerHTML+"^";
    var textCopy = "^"+document.getElementById("myText")+"^";
    textCopy.value = url + text;    
    document.execCommand("copy");
    }


</script>
  @endsection