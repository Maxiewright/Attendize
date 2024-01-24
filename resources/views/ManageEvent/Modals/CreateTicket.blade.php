<div role="dialog"  class="modal fade" style="display: none;">
   {{ html()->form('POST', route('postCreateTicket', array('event_id' => $event->id)))->class('ajax')->open() }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3 class="modal-title">
                    <i class="ico-ticket"></i>
                    @lang("ManageEvent.create_ticket")</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ html()->label(trans("ManageEvent.ticket_title"), 'title')->class('control-label required') }}
                            {{ html()->text('title', old('title'))->class('form-control')->placeholder(trans("ManageEvent.ticket_title_placeholder")) }}
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ html()->label(trans("ManageEvent.ticket_price"), 'price')->class('control-label required') }}
                                    {{ html()->text('price', old('price'))->class('form-control')->placeholder(trans("ManageEvent.price_placeholder")) }}


                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ html()->label(trans("ManageEvent.quantity_available"), 'quantity_available')->class(' control-label') }}
                                    {{ html()->text('quantity_available', old('quantity_available'))->class('form-control')->placeholder(trans("ManageEvent.quantity_available_placeholder")) }}
                                </div>
                            </div>

                        </div>

                        <div class="form-group more-options">
                            {{ html()->label(trans("ManageEvent.ticket_description"), 'description')->class('control-label') }}
                            {{ html()->text('description', old('description'))->class('form-control') }}
                        </div>

                        <div class="row more-options">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ html()->label(trans("ManageEvent.start_sale_on"), 'start_sale_date')->class(' control-label') }}
                                    {{ html()->text('start_sale_date', old('start_sale_date'))->class('form-control start hasDatepicker ')->data('field', 'datetime')->data('startend', 'start')->data('startendelem', '.end')->isReadonly('') }}
                                </div>
                            </div>

                            <div class="col-sm-6 ">
                                <div class="form-group">
                                    {{ html()->label(trans("ManageEvent.end_sale_on"), 'end_sale_date')->class(' control-label ') }}
                                    {{ html()->text('end_sale_date', old('end_sale_date'))->class('form-control end hasDatepicker ')->data('field', 'datetime')->data('startend', 'end')->data('startendelem', '.start')->isReadonly('') }}
                                </div>
                            </div>
                        </div>

                        <div class="row more-options">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ html()->label(trans("ManageEvent.minimum_tickets_per_order"), 'min_per_person')->class(' control-label') }}
                                    {{ html()->select('min_per_person', options_range(1, 100), 1)->class('form-control') }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ html()->label(trans("ManageEvent.maximum_tickets_per_order"), 'max_per_person')->class(' control-label') }}
                                    {{ html()->select('max_per_person', options_range(1, 100), 30)->class('form-control') }}
                                </div>
                            </div>
                        </div>
                        <div class="row more-options">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="custom-checkbox">
                                        {{ html()->checkbox('is_hidden', false, 1)->id('is_hidden') }}
                                        {{ html()->label(trans("ManageEvent.hide_this_ticket"), 'is_hidden')->class(' control-label') }}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <a href="javascript:void(0);" class="show-more-options">
                            @lang("ManageEvent.more_options")
                        </a>
                    </div>

                </div>

            </div> <!-- /end modal body-->
            <div class="modal-footer">
               {{ html()->button(trans("basic.cancel"))->class("btn modal-close btn-danger")->data('dismiss', 'modal') }}
               {{ html()->submit(trans("ManageEvent.create_ticket"))->class("btn btn-success") }}
            </div>
        </div><!-- /end modal content-->
       {{ html()->form()->close() }}
    </div>
</div>
