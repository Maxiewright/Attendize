<div role="dialog"  class="modal fade " style="display: none;">
    {{ html()->modelForm($ticket, 'POST', route('postEditTicket', ['ticket_id' => $ticket->id, 'event_id' => $event->id]))->class('ajax')->open() }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3 class="modal-title">
                    <i class="ico-ticket"></i>
                    @lang("ManageEvent.edit_ticket", ["title"=>$ticket->title])</h3>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {{ html()->label(trans("ManageEvent.ticket_title"), 'title')->class('control-label required') }}
                    {{ html()->text('title')->class('form-control')->placeholder('E.g: General Admission') }}
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ html()->label(trans("ManageEvent.ticket_price"), 'price')->class('control-label required') }}
                            {{ html()->text('price')->class('form-control')->placeholder(trans("ManageEvent.price_placeholder")) }}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ html()->label(trans("ManageEvent.quantity_available"), 'quantity_available')->class(' control-label') }}
                            {{ html()->text('quantity_available')->class('form-control')->placeholder(trans("ManageEvent.quantity_available_placeholder")) }}
                        </div>
                    </div>
                </div>

                <div class="form-group more-options">
                    {{ html()->label(trans("ManageEvent.ticket_description"), 'description')->class('control-label') }}
                    {{ html()->text('description')->class('form-control') }}
                </div>

                <div class="row more-options">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ html()->label(trans("ManageEvent.start_sale_on"), 'start_sale_date')->class(' control-label') }}

                            {{ html()->text('start_sale_date', $ticket->getFormattedDate('start_sale_date'))->class('form-control start hasDatepicker')->data('field', 'datetime')->data('startend', 'start')->data('startendelem', '.end')->isReadonly('') }}
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ html()->label(trans("ManageEvent.end_sale_on"), 'end_sale_date')->class(' control-label ') }}
                            {{ html()->text('end_sale_date', $ticket->getFormattedDate('end_sale_date'))->class('form-control end hasDatepicker')->data('field', 'datetime')->data('startend', 'end')->data('startendelem', '.start')->isReadonly('') }}
                        </div>
                    </div>
                </div>

                <div class="row more-options">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ html()->label(trans("ManageEvent.minimum_tickets_per_order"), 'min_per_person')->class(' control-label') }}
                           {{ html()->select('min_per_person', options_range(1, 100))->class('form-control') }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ html()->label(trans("ManageEvent.maximum_tickets_per_order"), 'max_per_person')->class(' control-label') }}
                           {{ html()->select('max_per_person', options_range(1, 100))->class('form-control') }}
                        </div>
                    </div>
                </div>
                <div class="row more-options">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="custom-checkbox">
                                {{ html()->checkbox('is_hidden', null)->id('is_hidden') }}
                                {{ html()->label(trans("ManageEvent.hide_this_ticket"), 'is_hidden')->class(' control-label') }}
                            </div>
                        </div>
                    </div>
                    @if ($ticket->is_hidden)
                        <div class="col-md-12">
                            <h4>{{ __('AccessCodes.select_access_code') }}</h4>
                            @if($ticket->event->access_codes->count())
                                <?php
                                $isSelected = false;
                                $selectedAccessCodes = $ticket->event_access_codes()->get()->map(function($accessCode) {
                                    return $accessCode->pivot->event_access_code_id;
                                })->toArray();
                                ?>
                                @foreach($ticket->event->access_codes as $access_code)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="custom-checkbox mb5">
                                                {{ html()->checkbox('ticket_access_codes[]', in_array($access_code->id, $selectedAccessCodes), $access_code->id)->id('ticket_access_code_' . $access_code->id)->data('toggle', 'toggle') }}
                                                {{ html()->label($access_code->code, 'ticket_access_code_' . $access_code->id) }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-info">
                                    @lang("AccessCodes.no_access_codes_yet")
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
                <a href="javascript:void(0);" class="show-more-options">
                    @lang("ManageEvent.more_options")
                </a>
            </div> <!-- /end modal body-->
            <div class="modal-footer">
                {{ html()->button(trans("basic.cancel"))->class("btn modal-close btn-danger")->data('dismiss', 'modal') }}
                {{ html()->submit(trans("ManageEvent.save_ticket"))->class("btn btn-success") }}
            </div>
        </div><!-- /end modal content-->
       {{ html()->closeModelForm() }}
    </div>
</div>
