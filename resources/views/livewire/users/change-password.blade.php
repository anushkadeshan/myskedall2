<div>
    <div class="mb-3">
        <label class="form-label">@lang('msg.Current Password')</label>
        <input class="form-control" type="password" wire:model="current_password" value="" data-bs-original-title="" title="">
        @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror  
    </div>

      <div class="mb-3">
          <label class="form-label">@lang('msg.New Password')</label>
          <input class="form-control" type="password" wire:model="password" value="" data-bs-original-title="" title="">
        @error('password') <span class="text-danger">{{ $message }}</span> @enderror  
            
        </div>
      <div class="mb-3">
          <label class="form-label">@lang('msg.Confirm New Password')</label>
          <input class="form-control" type="password" wire:model="password_confirmation" value="" data-bs-original-title="" title="">
        @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror  

    </div>
    <div class="form-footer">
        <button class="btn btn-primary btn-block" data-bs-original-title="" wire:click="save()" title="">Save</button>
      </div>
</div>
