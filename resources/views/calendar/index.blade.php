@extends('template.tmp')
@section('title', $pagetitle)

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- CSS --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

{{-- JS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


<!-- Edit Follow-up Modal -->
<div class="modal fade" id="followupModal" tabindex="-1" aria-labelledby="followupModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-">
    <form id="followupForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="followupModalLabel">Edit Follow-up</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3 d-flex justify-content-between">
                <div class="me-3 flex-fill">
                <label class="form-label fw-bold">Party</label>
                    <input type="text" readonly class="form-control-plaintext" id="party_name" value="">
                </div>
                <div class="me-3 flex-fill">
                <label class="form-label fw-bold">Agent</label>
                    <input type="text" readonly class="form-control-plaintext" id="agent_name" value="">
                </div>
                <div class="me-3 flex-fill">
                <label class="form-label fw-bold">Contact</label>
                    <input type="text" readonly class="form-control-plaintext" id="contact" value="">
                </div>
                <div class="me-3 flex-fill">
                <label class="form-label fw-bold">Service</label>
                    <input type="text" readonly class="form-control-plaintext" id="service_name" value="">
                </div>
            </div>

            <input type="hidden" id="followup_id" name="id">

            <div class="mb-3 row">
                <label for="notes" class="col-sm-3 col-form-label fw-bold">Notes</label>
                <div class="col-sm-9">
                <textarea id="notes" name="notes" class="form-control" rows="3"></textarea>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="remarks" class="col-sm-3 col-form-label fw-bold">Remarks</label>
                <div class="col-sm-9">
                <textarea id="remarks" name="remarks" class="form-control" rows="2"></textarea>
                </div>
            </div>

            <div class="mb-3 row align-items-center">
                <label class="col-sm-3 col-form-label fw-bold">Status</label>
                <div class="col-sm-9">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="status_pending" value="pending">
                    <label class="form-check-label" for="status_pending">Pending</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="status_done" value="done">
                    <label class="form-check-label" for="status_done">Done</label>
                </div>
                </div>
            </div>

            <div class="mb-3 row align-items-center">
                <label for="date" class="col-sm-3 col-form-label fw-bold">Date</label>
                <div class="col-sm-9">
                <input type="date" id="date" name="date" class="form-control">
                </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update Follow-up</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div id="calendar"></div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $('#calendar').fullCalendar({
      header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay,listWeek'
      },
      events: "{{ url('/ajax_followups') }}",
      timezone: 'local',
      selectable: true,
      editable: false,
      allDaySlot: true,

      eventClick: function (event) {
          $.ajax({
              url: "{{ route('followup-show') }}",
              method: 'GET',
              data: { id: event.id },
              success: function(response) {

                $('#followup_id').val(response.id);
                $('#notes').val(response.notes);
                $('#remarks').val(response.remarks);
                $('#date').val(moment(response.date).format('YYYY-MM-DD'));

                if (response.status) {
                    $('input[name="status"][value="' + response.status + '"]').prop('checked', true);
                } else {
                    $('#status_pending').prop('checked', true);
                }

                $('#party_name').val(response.lead?.party?.PartyName ?? 'N/A');
                $('#agent_name').val(response.lead?.agent?.name ?? 'N/A');
                $('#service_name').val(response.lead?.branch_service?.name ?? 'N/A');
                $('#contact').val(response.lead?.tel ?? 'N/A');

                  $('#followupModal').modal('show');
              }
          });
      }
  });

  $('#followupForm').on('submit', function (e) {
      e.preventDefault();

    let formData = {
        id: $('#followup_id').val(),
        notes: $('#notes').val(),
        remarks: $('#remarks').val(),
        date: $('#date').val(),
        status: $('input[name="status"]:checked').val()
    };

    $.ajax({
      url: "{{ route('followup.update') }}",
      method: "POST",
      data: formData,
      success: function (res) {
          if (res.success) {
              toastr.success(res.message);
              $('#followupModal').modal('hide');
              $('#calendar').fullCalendar('refetchEvents');
          }
      },
      error: function (xhr) {
          toastr.error('Update failed');
          console.log(xhr.responseText);
      }
    });
  });
});
</script>
@endsection
