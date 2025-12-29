@extends('template.tmp')

@section('title', 'page title...')
 

@section('content')

 <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Payment Plan</h4>

                                    <div class="page-title-right">
                                        <div class="page-title-right">
                                         <!-- button will appear here --><a href="{{URL('/Estimate')}}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">   Back</a>
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
 

 @if(count($payment_plan)>0)		
<table class="table table-sm align-middle table-nowrap mb-0">
<tbody><tr>
<th scope="col">S.No</th>
<th scope="col">Estimate #</th>
<th scope="col">Percentage</th>
<th scope="col">Amount</th>
<th scope="col">Status</th>
<th scope="col">Job Completion Report</th>
<th scope="col"></th>
</tr>
</tbody>
<tbody>
@foreach ($payment_plan as $key =>$value)
<!--  -->
<form action="{{URL('/EstimatePaymentReceived')}}" method="post" enctype="multipart/form-data"> 
	@csrf

 <tr>
 <td class="col-md-1">{{$key+1}}<input type="hidden" name="PaymentPlanID" value="{{$value->PaymentPlanID}}"></td>
 <td class="col-md-1">{{$value->EstimateNo}} <input type="hidden" name="EstimateMasterID" value="{{$value->EstimateMasterID}}"></td>
 <td class="col-md-1">{{$value->PaymentPercentage}}</td>
 <td class="col-md-1">{{$value->Amount}}</td>
 <td class="col-md-1">{{$value->Status}}</td>
 <td class="col-md-1"><input type="file" name="File" class="form-control-sm" required=""></td>
 <td class="col-md-1">
 @if($value->Status!='Done')
<button type="submit" class="btn btn-success btn-sm ">Submit</button>
 @endif
 @if($value->Status=='Done')
<a href="{{URL('/InvoiceCreateAuto/'.$value->EstimateMasterID.'/'.$value->PaymentNo)}}" title="" class="btn btn-primary btn-sm">Make Invoice</a>
 @endif
 
 </td>

 </tr>

</form>
 @endforeach   
 </tbody>
 </table>
 @else
   <p class=" text-danger">No data found</p>
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