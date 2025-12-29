@extends('template.tmp')
@section('title', 'Lead View')
@section('content')
   <div class="main-content">

 <div class="page-content">
 <div class="container-fluid">

    <div class="content-wrapper">
        <div class="row" style="height: 81vh; overflow: auto;">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="text-info">Lead Details</h3>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <a href="{{ url('leads') }}" class="btn btn-primary btn-rounded w-md">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card text-center shadow-sm shadow-sm">
                                    <div class="card-header ">
                                        <strong>Customer/Lead Full Name:</strong>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $lead->name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card text-center shadow-sm">
                                    <div class="card-header">
                                        <strong>Contact / Email:</strong>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $lead->tel }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card text-center shadow-sm">
                                    <div class="card-header">
                                        <strong>Other Number:</strong>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $lead->other_tel != null ? $lead->other_tel : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        {{-- </div> --}}
                        {{-- <div class="row mt-2"> --}}
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card text-center shadow-sm">
                                    <div class="card-header">
                                        <strong>Bussiness Details:</strong>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $lead->business_details != null ? $lead->business_details : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card text-center shadow-sm">
                                    <div class="card-header">
                                        <strong>Service:</strong>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $lead->service != null ? $lead->service : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card text-center shadow-sm">
                                    <div class="card-header">
                                        <strong>Channel:</strong>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $lead->channel != null ? $lead->channel : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        {{-- </div> --}}
                        {{-- <div class="row mt-2"> --}}
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card text-center shadow-sm">
                                    <div class="card-header">
                                        <strong>Branch:</strong>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ isset($lead->branch) ? $lead->branch->name : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card text-center shadow-sm">
                                    <div class="card-header">
                                        <strong>Branch Service:</strong>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ isset($lead->branchService) ? $lead->branchService->name : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card text-center shadow-sm">
                                    <div class="card-header">
                                        <strong>Branch Sub Service:</strong>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ isset($lead->subService) ? $lead->subService->name : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        {{-- </div> --}}
                        {{-- <div class="row mt-2"> --}}
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card text-center shadow-sm">
                                    <div class="card-header">
                                        <strong>Quoted Amount:</strong>
                                    </div>
                                    <div class="card-body">
                                        <p><span>{{ $lead->currency != null ? $lead->currency : 'AED' }}:
                                            </span>{{ $lead->amount != null ? $lead->amount : 0 }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card text-center shadow-sm">
                                    <div class="card-header">
                                        <strong>Agent:</strong>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ isset($lead->agent) ? $lead->agent->name : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card text-center shadow-sm">
                                    <div class="card-header">
                                        <strong>Campaign:</strong>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ isset($lead->campaign) ? $lead->campaign->name : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            {{-- </div> --}}
                            {{-- <div class="row mt-2"> --}}
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card text-center shadow-sm">
                                    <div class="card-header">
                                        <strong>Status:</strong>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $lead->status != null ? $lead->status : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card text-center shadow-sm">
                                    <div class="card-header">
                                        <strong>Qualified Status:</strong>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $lead->approved_status != null ? $lead->approved_status : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                            <hr>

  <div class="row mt-2">
                                <div class="col-12 text-center ">
                                    <strong>Notes/Remarks</strong>
                                </div>
                            </div>



                            
 @if(count($lead->leadDetails)>0)        
<table class="table table-sm align-middle table-nowrap mb-0">
<tbody><tr>
<th scope="col">S.No</th>
<th scope="col">Added By</th>
<th scope="col">Date Added</th>
<th scope="col">Follow Up Date</th>
<th scope="col">Status From</th>
<th scope="col">Status To</th>
<th scope="col">Note/Remarks</th>
</tr>
</tbody>
<tbody>
@foreach ($lead->leadDetails as $key =>$leadDetail)
 <tr>
 <td class="col-md-1">{{$key+1}}</td>
 <td class="col-md-1">{{ $leadDetail->date != null ? dmY($leadDetail->date) : 'N/A' }}</td>
 <td class="col-md-1">{{ $leadDetail->follow_up_date != null ? dmY($leadDetail->follow_up_date) : 'N/A' }}</td>
 <td class="col-md-1">{{ $leadDetail->status_from != null ? $leadDetail->status_from : 'N/A' }}</td>
 <td class="col-md-1">{{ $leadDetail->status_from != null ? $leadDetail->status_from : 'N/A' }}</td>
 <td class="col-md-1">{{ $leadDetail->status_to != null ? $leadDetail->status_to : 'N/A' }}</td>
 <td class="col-md-1">{{ $leadDetail->notes }}</td>
 </tr>
 @endforeach   
 </tbody>
 </table>
 @else
   <p class=" text-danger">No data found</p>
 @endif   


                          
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- <script>
    $(document).ready(function() {
 // executes when HTML-Document is loaded and DOM is ready
console.log("document is ready");
  

  $( ".card" ).hover(
  function() {
    $(this).addClass('shadow-md').css('cursor', 'pointer'); 
  }, function() {
    $(this).removeClass('shadow-md');
  }
);
  
// document ready  
});
</script> -->

@endsection
