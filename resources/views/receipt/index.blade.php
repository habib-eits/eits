@extends('template.tmp')
{{-- @section('title', $pagetitle) --}}

@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                
                <h4>Payment Received</h4>
                <div class="card shadow-sm">
                    <div class="card-body">   
                        <table id="" class="table table-sm table-hover table-responsive w-100">
                            <thead>
                                <tr>
                                    <th scope="">Date</th>
                                    <th scope="">Invoice No</th>
                                    <th scope="">Reference No</th>
                                    <th scope="">PaymentMode</th>
                                    <th scope="">Description</th>
                                    <th scope="">Amount Received</th>
                                    <th scope=""></th>
                                    <th scope=""></th>
                                
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($receipts as $receipt)
                                <tr>
                                    <td class="">{{  $receipt->date }}</td>
                                    <td class="">{{  $receipt->InvoiceNo }}</td>
                                    <td class="">{{  $receipt->ReferenceNo }}</td>
                                    <td class="">{{  $receipt->PaymentMode }}</td>
                                    <td class="">{{  $receipt->Description }}</td>
                                    <td class="">{{  $receipt->Paid }}</td>
                                    <td class="">

                                       <a href="{{ route('subReceiptPDF',$receipt->id ) }}"
                                        class="dropdown-item"><i class="mdi mdi-eye-outline font-size-16 text-secondary me-1"></i>
                                        View Receipt</a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="receiptEdit({{ $receipt->id }})" class="dropdown-item">
                                            <i class="bx bx-pencil font-size-16 text-secondary me-1"></i> Edit
                                        </a>
                                    </td>
                                    {{-- <td>
                                        <a href="javascript:void(0)" onclick="receiptEdit($receipt->id )" class="dropdown-item">
                                            <i class="bx bx-pencil font-size-16 text-secondary me-1"></i> Edit
                                        </a>
                                    </td> --}}
                            
                                </tr>
                                @empty
                                    <td colspan="5" style="text-align: center">No Payment Received</td>

                                @endforelse

                                
                              
                            </tbody>
                           
                           
                        </table>
                    </div>     
                </div>     
                

             

            </div>
        </div>
    </div>


 <!-- Edit Receipt -->
 <div class="modal fade" id="edit-receipt">
    <div class="modal-dialog custom-modal-two">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>Edit Receipt</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <form id="receipt-update" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <!-- For PUT method -->
                            <input type="hidden" name="id" id="id"> <!-- Hidden field to store the receipt ID -->
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" name="date" id="date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Reference No</label>
                                <input type="text" name="ReferenceNo" id="ReferenceNo" class="form-control" >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description </label>
                                <input type="text" name="Description" id="Description" class="form-control" >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Paid </label>
                                <input type="text" name="Paid" id="Paid" class="form-control" required>
                            </div>
                           

                            
                            <div class="modal-footer-btn">
                                <button type="button" class="btn btn-cancel btn-dark me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-submit btn-success">Update Receipt</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Receipt -->

<script>
    
   
       
    function receiptEdit(id) {
       
            $.get("{{ route('editReceipt', ':id') }}".replace(':id', id), function(response) {
                $('#id').val(response.id);
                $('#date').val(response.date);
                $('#ReferenceNo').val(response.ReferenceNo);
                $('#Description').val(response.Description);
                $('#Paid').val(response.Paid);
                $('#edit-receipt').modal('show');
            }).fail(function(xhr) {
                alert('Error fetching receipt details: ' + xhr.responseText);
            });
        }
   
        $('#receipt-update').submit(function(e) {
                e.preventDefault();
                let editFormData = new FormData(this);
                let receiptID = $('#id').val(); // Get the ID of the receipt being edited
                $.ajax({
                    type: 'POST',
                    url: "{{ route('updateReceipt', ':id') }}".replace(':id', receiptID), // Using route name
                    data: editFormData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#edit-receipt').modal('hide');
                        location.reload();
                    },
                    error: function(response) {
                        // alert('Error adding data: ' + response.responseJSON.message);
                        alert(response.responseJSON.status,response.responseJSON.message);
                    }
                });
            });
</script>

@endsection
