<div role="dialog"  class="modal fade " style="display: none;">
   {{ html()->form('POST', route('postImportAttendee', array('event_id' => $event->id)))->acceptsFiles()->class('ajax')->open() }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3 class="modal-title">
                    <i class="ico-user-plus"></i>
                    @lang("ManageEvent.invite_attendees")</h3>
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
						<!-- Import -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                {{ html()->labelwithhelp('attendees_list', trans("ManageEvent.import_file"), array('class' => 'control-label required'), trans("ManageEvent.attendees_file_requirements")) }}
                                {{ html()->styledfile('attendees_list', 1, array('id' => 'input-attendees_list')) }}
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="checkbox custom-checkbox">
                                        <input type="checkbox" name="email_ticket" id="email_ticket" value="1" />
                                        <label for="email_ticket">&nbsp;&nbsp;@lang("ManageEvent.send_invitation_n_ticket_to_attendees").</label>
                                    </div>
                                </div>
                            </div>
                		</div>
                    </div>
                </div>
            </div> <!-- /end modal body-->
            <div class="modal-footer">
               {{ html()->button(trans("basic.cancel"))->class("btn modal-close btn-danger")->data('dismiss', 'modal') }}
               {{ html()->submit(trans("ManageEvent.create_attendees"))->class("btn btn-success") }}
            </div>
        </div><!-- /end modal content-->
       {{ html()->form()->close() }}
    </div>
</div>
