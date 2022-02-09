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
                    <label for="">@lang('msg.Professional')</label>
                    <input type="text" name="" class="form-control" id="" wire:model.defer="professional">
                </div>
                
                <!-- Quantity Field -->
                <div class="form-group col-sm-12 mb-4">
                    <label for="">@lang('msg.Quantity')</label>
                    <input type="text" name="" class="form-control" id="" wire:model.defer="quantity">
                </div>
                <div class="form-group col-sm-12">
                    <label for="">@lang('msg.Group')</label>
                    <select class="form-control mb-4" name="group_id" id="" required wire:model.defer="group_id">
                        <option value="">@lang('msg.Select a Group')</option>
                        @foreach($groups as $group)
                            <option value="{{$group->id}}">{{$group->name}}</option>
                        @endforeach
                    </select>
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
