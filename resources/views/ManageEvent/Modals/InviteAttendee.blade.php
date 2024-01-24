<div role="dialog"  class="modal fade " style="display: none;">
   {{ html()->form('POST', route('postInviteAttendee', array('event_id' => $event->id)))->class('ajax')->open() }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3 class="modal-title">
                    <i class="ico-user"></i>
                    @lang("ManageEvent.invite_attendee")</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                   {{ html()->label(trans("ManageEvent.ticket"), 'ticket_id')->class('control-label required') }}
                                   {{ html()->select('ticket_id', $tickets)->class('form-control') }}
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

                        <div class="form-group">
                            {{ html()->label(trans("Attendee.email_address"), 'email')->class('control-label required') }}

                            {{ html()->text('email', old('email'))->class('form-control') }}
                        </div>

                        <div class="form-group">
                            <div class="checkbox custom-checkbox">
                                <input type="checkbox" name="email_ticket" id="email_ticket" value="1" />
                                <label for="email_ticket">&nbsp;&nbsp;@lang("Attendee.send_invitation_n_ticket_to_attendee")</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- /end modal body-->
            <div class="modal-footer">
               {{ html()->button(trans("basic.cancel"))->class("btn modal-close btn-danger")->data('dismiss', 'modal') }}
               {{ html()->submit(trans("ManageEvent.invite_attendee"))->class("btn btn-success") }}
            </div>
        </div><!-- /end modal content-->
       {{ html()->form()->close() }}
    </div>
</div>
