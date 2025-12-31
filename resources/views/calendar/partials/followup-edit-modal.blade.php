<div class="modal fade" id="followupModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title text-white">
                    <i class="bi bi-calendar-check me-2 text-white"></i> Edit Follow-up
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- Top Info -->
            <div class="bg-light border-bottom p-3">
                <div class="row small text-muted">
                    <div class="col-md-4">
                        <strong>Customer:</strong> <span id="f_customer_name" class="text-dark fw-bold">-</span>
                    </div>
                    <div class="col-md-3">
                        <strong>Phone:</strong> <span id="f_phone" class="text-dark fw-bold">-</span>
                    </div>
                    <div class="col-md-3">
                        <strong>Branch:</strong> <span id="f_branch" class="text-dark">-</span>
                    </div>
                    <div class="col-md-2">
                        <strong>Service:</strong> <span id="f_service" class="text-dark">-</span>
                    </div>
                </div>
            </div>

            <form id="followupForm">
                <div class="modal-body pt-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Date</label>
                        <input type="date" class="form-control" id="f_date" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Remarks</label>
                        <textarea class="form-control" id="f_remarks" rows="3" placeholder="What was discussed?"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Notes</label>
                        <textarea class="form-control" id="f_notes" rows="3" placeholder="Internal notes..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <select class="form-select" id="f_status">
                            <option value="Pending">Pending</option>
                            <option value="Done">Done</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save me-1"></i> Save Changes
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                </div>
                <input type="hidden" id="current_followup_id">
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
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
            events: "{{ url('/ajax_followup') }}",
            timezone: 'local',
            minTime: '06:00:00',
            maxTime: '22:00:00',
            height: 'auto',
            eventClick: function(event) {
                const id = event.id.replace('followup_', '');

                const formattedDate = moment(event.start).format('YYYY-MM-DD');

                $('#current_followup_id').val(id);
                $('#f_date').val(formattedDate);
                $('#f_remarks').val(event.remarks || '');
                $('#f_notes').val(event.notes || '');
                $('#f_status').val(event.status || 'Pending');

                // Fill top info panel
                $('#f_customer_name').text(event.customer_name);
                $('#f_phone').text(event.phone);
                $('#f_branch').text(event.branch);
                $('#f_service').text(event.service);

                $('#followupModal').modal('show');
            }
        });

        // Submit Form
        $('#followupForm').on('submit', function(e) {
            e.preventDefault();

            const id = $('#current_followup_id').val();
            const data = {
                date: $('#f_date').val(), // YYYY-MM-DD directly
                remarks: $('#f_remarks').val(),
                notes: $('#f_notes').val(),
                status: $('#f_status').val()
            };

            $.ajax({
                url: '/followup/update/' + id,
                type: 'POST',
                data: data,
                success: function(res) {
                    toastr.success(res.message);
                    $('#followupModal').modal('hide');

                    // Update event
                    const calEvent = $('#calendar').fullCalendar('clientEvents',
                        'followup_' + id)[0];
                    if (calEvent) {
                        const newDate = data.date +
                            ' 00:00:00'; // Convert YYYY-MM-DD → YYYY-MM-DD 00:00:00
                        calEvent.start = newDate;
                        calEvent.end = newDate;
                        calEvent.start = newDate;
                        calEvent.end = newDate;
                        calEvent.title = data.remarks ? data.remarks.substring(0, 50) :
                            'Follow-up';
                        calEvent.color = data.status === 'Done' ? '#28a745' : '#ff9800';
                        calEvent.remarks = data.remarks;
                        calEvent.notes = data.notes;
                        calEvent.status = data.status;

                        $('#calendar').fullCalendar('updateEvent', calEvent);
                    }
                },
                error: function(xhr) {
                    let msg = 'Failed to update';
                    if (xhr.responseJSON?.errors) {
                        msg += ': ' + Object.values(xhr.responseJSON.errors).flat().join(
                            ', ');
                    }
                    toastr.error(msg);
                }
            });
        });
    });
</script>

<style>
    .fc-event {
        font-size: 13px;
        padding: 4px 8px;
        border-radius: 8px;
        border: none;
        font-weight: 500;
    }

    .fc-day-grid-event {
        margin: 3px 0;
    }

    .fc-title {
        white-space: normal;
    }
</style>
