<script>
    $(function () {

        $('.payment_gateway_options').hide();
        $('#gateway_{{ $default_payment_gateway_id }}').show();

        $('input[type=radio][name=payment_gateway]').on('change', function (e) {
            $('.payment_gateway_options').hide();
            $('#gateway_' + $(this).val()).fadeIn();
        });

    });
</script>


{{ html()->modelForm($account, 'POST', route('postEditAccountPayment'))->class('ajax ')->open() }}
<div class="form-group">
    {{ html()->label(trans("ManageAccount.default_payment_gateway"), 'payment_gateway_id')->class('control-label
    ') }}<br/>

    @foreach ($payment_gateways as $id => $payment_gateway)
    {{ html()->radio('payment_gateway', $payment_gateway['default'], $payment_gateway['id'])->id('payment_gateway_' . $payment_gateway['id']) }}
    {{ html()->label($payment_gateway['provider_name'], $payment_gateway['provider_name'])->class('control-label
    gateway_selector') }}<br/>
    @endforeach


</div>

@foreach ($payment_gateways as $id => $payment_gateway)

@if(View::exists($payment_gateway['admin_blade_template']))
    @include($payment_gateway['admin_blade_template'])
@endif


@endforeach


<div class="row">
    <div class="col-md-12">
        <div class="panel-footer">
            {{ html()->submit(trans("ManageAccount.save_payment_details_submit"))->class('btn btn-success
            pull-right') }}
        </div>
    </div>
</div>


{{ html()->closeModelForm() }}