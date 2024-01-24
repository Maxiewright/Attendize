<div role="dialog"  class="modal fade " style="display: none;">
    {{ html()->form('POST', route('postMessageAttendees', array('event_id' => $event->id)))->class('reset ajax closeModalAfter')->open() }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3 class="modal-title">
                    <i class="ico-envelope"></i>
                    @lang("ManageEvent.message_attendees_title")</h3>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#new_message" data-toggle="tab">@lang("Message.new_message")</a></li>
                    <li><a href="#sent_messages" data-toggle="tab">@lang("Message.sent_messages")</a></li>
                </ul>

                <div class="tab-content panel">
                    <div class="tab-pane active" id="new_message">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ html()->label(trans("Message.subject"), 'subject')->class('control-label required') }}
                                    {{ html()->text('subject', old('subject'))->class('form-control') }}
                                </div>

                                <div class="form-group">
                                    {{ html()->label(trans("Message.content"), 'message')->class('control-label required') }}
                                    {{ html()->textarea('message', old('message'))->class('form-control')->rows('5') }}
                                </div>
                                <div class="form-group">
                                    {{ html()->label(trans("Message.send_to"), 'recipients')->class('control-label required') }}
                                    {{ html()->select('recipients', ['all' => trans("Message.all_event_attendees")] + [trans("Message.attendees_with_ticket_type") => $tickets])->class('form-control') }}
                                </div>

                                <div class="form-group hide">
                                    {{ html()->label(trans("Message.schedule_send_time"), 'sent_time')->class('control-label required') }}
                                    {{ html()->text('sent_time', old('sent_time'))->class('form-control') }}
                                    <div class="help-block">
                                        @lang("Message.leave_blank_to_send_immediately")
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="sent_messages">

                        @if(count($event->messages) > 0)
                            <div class="table-layout">
                                <!-- content -->
                                <div class="col-lg-12 valign-top panel panel-default">
                                    <div class="nm">
                                        <table class="table table-hover table-email">
                                            <thead>
                                            <tr>
                                                <td style="width: 100px;">
                                                    <h5>
                                                        <b>@lang("Message.date")</b>
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5>
                                                        <b>@lang("Message.message")</b>
                                                    </h5>
                                                </td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($event->messages as $message)
                                                <tr>
                                                    <td class="meta">
                                                        @if($message->sent_at!=null) <?php /* Can occur when there was mailing error*/ ?>
                                                            <p class="date">{{$message->sent_at->format(config("attendize.default_datetime_format"))}}</p>
                                                        @else
                                                            <p class="date">@lang("Message.unsent")</p>
                                                        @endif
                                                    </td>
                                                    <td class="message">
                                                        <h5 class="sender">@lang("Message.to"): <b>{{$message->recipients_label}}</b></h5>
                                                        <h5 class="heading"><a href="javascript:void();">{{$message->subject}}</a></h5>

                                                        <p class="text">{{nl2br($message->message)}}</p>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--/ email list -->
                                </div>
                                <!--/ content -->
                            </div>
                        @else
                            <div class="alert alert-info">
                                @lang("Message.no_messages_for_event")
                            </div>
                        @endif
                    </div>
                </div>
            </div> <!-- /end modal body-->
            <div class="modal-footer">
                {{ html()->button(trans("basic.cancel"))->class("btn modal-close btn-danger")->data('dismiss', 'modal') }}
                {{ html()->submit(trans("ManageEvent.send_message"))->class("btn btn-success") }}
            </div>
        </div><!-- /end modal content-->
        {{ html()->form()->close() }}
    </div>
</div>
