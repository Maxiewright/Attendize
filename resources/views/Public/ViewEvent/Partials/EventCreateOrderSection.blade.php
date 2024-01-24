<section id='order_form' class="container">
    <div class="row">
        <h1 class="section_head">
            @lang("Public_ViewEvent.order_details")
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            @lang("Public_ViewEvent.below_order_details_header")
        </div>
        <div class="col-md-4 col-md-push-8">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="ico-cart mr5"></i>
                        @lang("Public_ViewEvent.order_summary")
                    </h3>
                </div>

                <div class="panel-body pt0">
                    <table class="table mb0 table-condensed">
                        @foreach($tickets as $ticket)
                        <tr>
                            <td class="pl0">{{{$ticket['ticket']['title']}}} X <b>{{$ticket['qty']}}</b></td>
                            <td style="text-align: right;">
                                @isFree($ticket['full_price'])
                                    @lang("Public_ViewEvent.free")
                                @else
                                {{ money($ticket['full_price'], $event->currency) }}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                @if($order_total > 0)
                <div class="panel-footer">
                    <h5>
                        @lang("Public_ViewEvent.total"): <span style="float: right;"><b>{{ $orderService->getOrderTotalWithBookingFee(true) }}</b></span>
                    </h5>
                    @if($event->organiser->charge_tax)
                    <h5>
                        {{ $event->organiser->tax_name }} ({{ $event->organiser->tax_value }}%):
                        <span style="float: right;"><b>{{ $orderService->getTaxAmount(true) }}</b></span>
                    </h5>
                    <h5>
                        <strong>@lang("Public_ViewEvent.grand_total")</strong>
                        <span style="float: right;"><b>{{  $orderService->getGrandTotal(true) }}</b></span>
                    </h5>
                    @endif
                </div>
                @endif

            </div>
            <div class="help-block">
                {!! @trans("Public_ViewEvent.time", ["time"=>"<span id='countdown'></span>"]) !!}
            </div>
        </div>
        <div class="col-md-8 col-md-pull-4">
            <div class="event_order_form">
                {{ html()->form('POST', route('postValidateOrder', ['event_id' => $event->id]))->class('ajax payment-form')->open() }}

                {{ html()->hidden('event_id', $event->id) }}

                <h3> @lang("Public_ViewEvent.your_information")</h3>

                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            {{ html()->label(trans("Public_ViewEvent.first_name"), "order_first_name") }}
                            {{ html()->text("order_first_name")->required()->class('form-control') }}
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            {{ html()->label(trans("Public_ViewEvent.last_name"), "order_last_name") }}
                            {{ html()->text("order_last_name")->required()->class('form-control') }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ html()->label(trans("Public_ViewEvent.email"), "order_email") }}
                            {{ html()->text("order_email")->required()->class('form-control') }}
                        </div>
                    </div>
                </div>
                <div class="row"><div class="col-md-12">&nbsp;</div></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="custom-checkbox">
                                {{ html()->checkbox('is_business', null, 1)->data('toggle', 'toggle')->id('is_business') }}
                                {{ html()->label(trans("Public_ViewEvent.is_business"), 'is_business')->class('control-label') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row"><div class="col-md-12">&nbsp;</div></div>
                <div class="row hidden" id="business_details">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        {{ html()->label(trans("Public_ViewEvent.business_name"), "business_name") }}
                                        {{ html()->text("business_name")->class('form-control') }}
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        {{ html()->label(trans("Public_ViewEvent.business_tax_number"), "business_tax_number") }}
                                        {{ html()->text("business_tax_number")->class('form-control') }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        {{ html()->label(trans("Public_ViewEvent.business_address_line1"), "business_address_line1") }}
                                        {{ html()->text("business_address_line1")->class('form-control') }}
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        {{ html()->label(trans("Public_ViewEvent.business_address_line2"), "business_address_line2") }}
                                        {{ html()->text("business_address_line2")->class('form-control') }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        {{ html()->label(trans("Public_ViewEvent.business_address_state_province"), "business_address_state") }}
                                        {{ html()->text("business_address_state")->class('form-control') }}
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        {{ html()->label(trans("Public_ViewEvent.business_address_city"), "business_address_city") }}
                                        {{ html()->text("business_address_city")->class('form-control') }}
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        {{ html()->label(trans("Public_ViewEvent.business_address_code"), "business_address_code") }}
                                        {{ html()->text("business_address_code")->class('form-control') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row"><div class="col-md-12">&nbsp;</div></div>
                <div class="p20 pl0">
                    <a href="javascript:void(0);" class="btn btn-primary btn-xs" id="mirror_buyer_info">
                        @lang("Public_ViewEvent.copy_buyer")
                    </a>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="ticket_holders_details" >
                            <h3>@lang("Public_ViewEvent.ticket_holder_information")</h3>
                            <?php
                                $total_attendee_increment = 0;
                            ?>
                            @foreach($tickets as $ticket)
                                @for($i=0; $i<=$ticket['qty']-1; $i++)
                                <div class="panel panel-primary">

                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <b>{{$ticket['ticket']['title']}}</b>: @lang("Public_ViewEvent.ticket_holder_n", ["n"=>$i+1])
                                        </h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    {{ html()->label(trans("Public_ViewEvent.first_name"), "ticket_holder_first_name[{$i}][{$ticket['ticket']['id']}]") }}
                                                    {{ html()->text("ticket_holder_first_name[{$i}][{$ticket['ticket']['id']}]")->required()->class("ticket_holder_first_name.{$i}.{$ticket['ticket']['id']} ticket_holder_first_name form-control") }}
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    {{ html()->label(trans("Public_ViewEvent.last_name"), "ticket_holder_last_name[{$i}][{$ticket['ticket']['id']}]") }}
                                                    {{ html()->text("ticket_holder_last_name[{$i}][{$ticket['ticket']['id']}]")->required()->class("ticket_holder_last_name.{$i}.{$ticket['ticket']['id']} ticket_holder_last_name form-control") }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    {{ html()->label(trans("Public_ViewEvent.email_address"), "ticket_holder_email[{$i}][{$ticket['ticket']['id']}]") }}
                                                    {{ html()->text("ticket_holder_email[{$i}][{$ticket['ticket']['id']}]")->required()->class("ticket_holder_email.{$i}.{$ticket['ticket']['id']} ticket_holder_email form-control") }}
                                                </div>
                                            </div>
                                            @include('Public.ViewEvent.Partials.AttendeeQuestions', ['ticket' => $ticket['ticket'],'attendee_number' => $total_attendee_increment++])

                                        </div>
                                    </div>
                                </div>
                                @endfor
                            @endforeach
                        </div>
                    </div>
                </div>

                @if($event->pre_order_display_message)
                <div class="well well-small">
                    {!! nl2br(e($event->pre_order_display_message)) !!}
                </div>
                @endif

               {{ html()->hidden('is_embedded', $is_embedded) }}
               {{ html()->submit(trans("Public_ViewEvent.checkout_order"))->class('btn btn-lg btn-success card-submit')->style('width:100%;') }}
               {{ html()->form()->close() }}

            </div>
        </div>
    </div>
    <img src="https://cdn.attendize.com/lg.png" />
</section>
@if(session()->get('message'))
    <script>showMessage('{{session()->get('message')}}');</script>
@endif

