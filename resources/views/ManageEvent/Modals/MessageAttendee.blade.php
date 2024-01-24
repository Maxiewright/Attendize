<div role="dialog" class="modal fade" style="display: none;">
    {{ html()->form('POST', route('postMessageAttendee', array('attendee_id' => $attendee->id)))->class('ajax
    reset closeModalAfter')->open() }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">
                    <i class="ico-envelope"></i>
                    @lang("ManageEvent.message_attendee_title", ["attendee"=>$attendee->full_name])
                </h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ html()->label(trans("Message.subject"), 'subject')->class('control-label
                            required') }}
                            {{ html()->text('subject', old('subject'))->class('form-control') }}
                        </div>

                        <div class="form-group">
                            {{ html()->label(trans("Message.content"), 'message')->class('control-label
                            required') }}

                            {{ html()->textarea('message', old('message'))->class('form-control')->rows('5') }}
                        </div>

                        <div class="form-group">
                            <div class="custom-checkbox">
                                <input type="checkbox" name="send_copy" id="send_copy" value="1">
                                <label for="send_copy">&nbsp;&nbsp;{{ @trans("Message.send_a_copy_to",
                                    ["organiser"=>$attendee->event->organiser->email]) }}</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="help-block">
                    {{ @trans("Message.before_send_message", ["organiser"=>$attendee->event->organiser->email]) }}
                </div>
            </div> <!-- /end modal body-->
            <div class="modal-footer">
                {{ html()->button(trans("basic.cancel"))->class("btn modal-close btn-danger")->data('dismiss', 'modal') }}
                {{ html()->submit(trans("Message.send_message"))->class("btn btn-success") }}
            </div>
        </div><!-- /end modal content-->
        {{ html()->form()->close() }}
    </div>
</div>
