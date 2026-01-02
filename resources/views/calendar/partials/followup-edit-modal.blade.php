<div class="modal fade" id="followupModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title text-white">
                    <i class="bi bi-calendar-check me-2 text-white"></i> Edit Follow-up
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- Top Info -->
            <div class="bg-light border-bottom px-4 py-3">
                <div class="small text-muted">
                    <div class="mb-2">
                        <strong>Customer:</strong>
                        <span id="f_customer_name" class="text-dark fw-bold ms-2">-</span>
                    </div>
                    <div class="mb-2">
                        <strong>Phone:</strong>
                        <span id="f_phone" class="text-dark fw-bold ms-2">-</span>
                    </div>
                    <div class="mb-2">
                        <strong>Branch:</strong>
                        <span id="f_branch" class="text-dark ms-2">-</span>
                    </div>
                    <div class="mb-2">
                        <strong>Service:</strong>
                        <span id="f_service" class="text-dark ms-2">-</span>
                    </div>
                    <div class="mb-0">
                        <strong>Agent:</strong>
                        <span id="f_agent" class="text-dark ms-2">-</span>
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

        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
            },
            events: function(start, end, timezone, callback) {
                $.ajax({
                    url: "{{ url('/ajax_followup') }}",
                    type: 'GET',
                    data: {
                        start: start.format('YYYY-MM-DD'),
                        end: end.format('YYYY-MM-DD'),
                        agent_id: $('#agent_filter').val() || ''
                    },
                    success: function(events) {
                        callback(events);
                    }
                });
            },
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

                // Fill top info panel
                $('#f_customer_name').text(event.customer_name);
                $('#f_phone').text(event.phone);
                $('#f_branch').text(event.branch);
                $('#f_service').text(event.service);
                $('#f_agent').text(event.agent_name);

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
                notes: $('#f_notes').val()
            };

            $.ajax({
                url: '/followup/update/' + id,
                type: 'POST',
                data: data,
                success: function(res) {
                    toastr.success(res.message);
                    $('#followupModal').modal('hide');

                    // Reload calendar to get updated data
                    $('#calendar').fullCalendar('refetchEvents');
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

        // Reload calendar when agent filter changes
        $('#agent_filter').on('change', function() {
            $('#calendar').fullCalendar('refetchEvents');
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
