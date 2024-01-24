<div role="dialog"  class="modal fade" style="display: none;">
   {{ html()->modelForm($attendee, 'POST', route('postEditAttendee', array('event_id' => $event->id, 'attendee_id' => $attendee->id)))->class('ajax')->open() }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">
                    <i class="ico-edit"></i>
                    {{ @trans("ManageEvent.edit_attendee_title", ["attendee"=> $attendee->full_name]) }}
                    </h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                   {{ html()->label(trans("ManageEvent.ticket"), 'ticket_id')->class('control-label required') }}
                                   {{ html()->select('ticket_id', $tickets, $attendee->ticket_id)->class('form-control') }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ html()->label(trans("Attendee.first_name"), 'first_name')->class('control-label required') }}
                                    {{ html()->text('first_name', old('first_name'))->class('form-control') }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ html()->label(trans("Attendee.last_name"), 'last_name')->class('control-label') }}
                                    {{ html()->text('last_name', old('last_name'))->class('form-control') }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ html()->label(trans("Attendee.email"), 'email')->class('control-label required') }}

                                    {{ html()->text('email', old('email'))->class('form-control') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- /end modal body-->
            <div class="modal-footer">
               {{ html()->hidden('attendee_id', $attendee->id) }}
               {{ html()->button(trans("basic.cancel"))->class("btn modal-close btn-danger")->data('dismiss', 'modal') }}
               {{ html()->submit(trans("ManageEvent.edit_attendee"))->class("btn btn-success") }}
            </div>
        </div><!-- /end modal content-->
       {{ html()->closeModelForm() }}
    </div>
</div>
