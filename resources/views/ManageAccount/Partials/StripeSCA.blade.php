<section class="payment_gateway_options" id="gateway_{{$payment_gateway['id']}}">
    <h4>@lang("ManageAccount.stripe_settings")</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ html()->label(trans("ManageAccount.stripe_secret_key"), 'stripe_sca[apiKey]')->class('control-label ') }}
                {{ html()->text('stripe_sca[apiKey]', $account->getGatewayConfigVal($payment_gateway['id'], 'apiKey'))->class('form-control') }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ html()->label(trans("ManageAccount.stripe_publishable_key"), 'publishableKey')->class('control-label ') }}
                {{ html()->text('stripe_sca[publishableKey]', $account->getGatewayConfigVal($payment_gateway['id'], 'publishableKey'))->class('form-control') }}
            </div>
        </div>
    </div>
</section>
