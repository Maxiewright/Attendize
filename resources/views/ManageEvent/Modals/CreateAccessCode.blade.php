<div role="dialog" class="modal fade" style="display: none;">
    {{ html()->form('POST', route('postCreateEventAccessCode', ['event_id' => $event->id]))->class('ajax')->open() }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3 class="modal-title">
                    <i class="ico-ticket"></i>
                    @lang("AccessCodes.create_access_code")</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ html()->label(trans("AccessCodes.access_code_title"), 'code')->class('control-label required') }}
                            {{ html()->text('code', old('code'))->class('form-control')->placeholder(trans("AccessCodes.access_code_title_placeholder")) }}
                        </div>
                    </div>
                </div>
            </div> <!-- /end modal body-->
            <div class="modal-footer">
                {{ html()->button(trans("basic.cancel"))->class("btn modal-close btn-danger")->data('dismiss', 'modal') }}
                {{ html()->submit(trans("AccessCodes.create_access_code"))->class("btn btn-success") }}
            </div>
        </div><!-- /end modal content-->
        {{ html()->form()->close() }}
    </div>
</div>
