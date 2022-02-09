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
                <!-- Material Field -->
                <div class="form-group col-sm-12 mb-4">
                    <label for="">@lang('msg.material')</label>
                    <input type="text" name="" id="" class="form-control" wire:model.defer="material">
                    @error('material') <span class="text-danger">*{{ $message }}</span> @enderror
                </div>

                <!-- Quantity Field -->
                <div class="form-group col-sm-12 mb-4">
                    <label for="">@lang('msg.Quantity')</label>
                    <input type="number" name="" id="" class="form-control" wire:model.defer="quantity">
                    @error('quantity') <span class="text-danger">*{{ $message }}</span> @enderror
                </div>

                <div class="form-group col-sm-12 mb-4">
                    <label for="">@lang('msg.Group')</label>
                    <select class="form-control" name="group_id" wire:model.defer="group_id" required>
                        <option value="">@lang('msg.Select a Group')</option>
                        @foreach($groups as $group)
                        <option 
                            value="{{$group->id}}">{{$group->name}}</option>
                        @endforeach
                    </select>
                    @error('group_id') <span class="text-danger">*{{ $message }}</span> @enderror
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" data-bs-original-title=""
                    title="">Close</button>
                <button class="btn btn-primary" type="button" data-bs-original-title="" wire:click.prevent="save" title="">Save changes</button>
            </div>
        </div>
    </div>
</div>
</div>
