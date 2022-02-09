<div class="mb-2">
    <div class="row">
        <div class="col-md-3">
            <label for="">@lang('msg.Due Date')</label>
            <input type="date" placeholder="Due Date" wire:model="d_start_date" name="" id="" class="form-control">
            <input type="date" placeholder="Due Date" wire:model="d_end_date" name="" id="" class="form-control">
        </div>
        <div class="col-md-3">
            <label for="">@lang('msg.status')</label>
            <select name="" wire:model="status" class="form-control" id="">
                <option value="">{{__('msg.All')}}</option>
                <option value="3">{{__('msg.Consulting')}}</option>
                <option value="4">{{__('msg.Return')}}</option>
                <option value="2">{{__('msg.Repproved')}}</option>
                <option value="1">{{__('msg.Approved')}}</option>
                <option value="0">{{__('msg.Pending')}}</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for=""></label>
            <button type="button" wire:click="filter" id="end_date" class="btn btn-success mt-8">
                @lang('msg.Filter')
            </button>
        </div>
    </div>
    <livewire:apps.approvals.requests-table  key="{{now()}}" />
</div>
