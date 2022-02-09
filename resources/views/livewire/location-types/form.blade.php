<div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenter"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('msg.Add New')</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                    data-bs-original-title="" title=""></button>
            </div>
           
            <div class="modal-body">
                <div class="form-group col-sm-12 mb-4">
                    <label for="">{{ __('msg.Location Type') }}</label>
                    <input type="text" name="" class="form-control" id="" wire:model.defer="location_type">
                </div>
            
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" data-bs-original-title=""
                    title="">@lang('msg.close')</button>
                <button class="btn btn-primary" type="button" data-bs-original-title="" wire:click.prevent="save" title="">@lang('msg.Save changes')</button>
            </div>
        </div>
    </div>
</div>
</div>
