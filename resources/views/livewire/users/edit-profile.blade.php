<div>
    <form class="card">
        <div class="card-header">
          <h4 class="card-title mb-0">Edit Profile</h4>
          <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse" data-bs-original-title="" title=""><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove" data-bs-original-title="" title=""><i class="fe fe-x"></i></a></div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <!-- Name Field -->
                    <div class="form-group mb-4">
                        {!! Form::label('name', trans('msg.name :'),['class'=> 'font-weight-bold']) !!}
                        <input type="text" wire:model="name" class="form-control">
                    </div>
            
                    <!-- Nickname Field -->
                    <div class="form-group mb-4">
                        {!! Form::label('nickname', trans('msg.nickname:'),['class'=> 'font-weight-bold']) !!}
                        <input type="text" wire:model="nickname" class="form-control">
                    </div>
             
                  
                    <!-- Sex Field -->
                    <div class="form-group mb-4">
                        {!! Form::label('sex', trans('msg.sex:'),['class'=> 'font-weight-bold']) !!}
                        <input type="text" wire:model="sex" class="form-control">
                       
                    </div>
            
                    <!-- Birth Field -->
                    <div class="form-group mb-4">
                        {!! Form::label('birth', trans('msg.birth:'),['class'=> 'font-weight-bold']) !!}
                        <input type="text" wire:model="birth" class="form-control">
                    </div>
            
                    <!-- Phone Field -->
                    <div class="form-group mb-4">
                        {!! Form::label('phone',  trans('msg.phone:'),['class'=> 'font-weight-bold']) !!}
                        <input type="text" wire:model="phone" class="form-control">
                    </div>
            
                    <!-- Address Field -->
                    <div class="form-group mb-4">
                        {!! Form::label('address',  trans('msg.address:'),['class'=> 'font-weight-bold']) !!}
                        <input type="text" wire:model="address" class="form-control">
                    </div>
                    <!-- Zipcode Field -->
                    <div class="form-group mb-4">
                        {!! Form::label('zipcode', trans('msg.zipcode:'),['class'=> 'font-weight-bold']) !!}
                        <input type="text" wire:model="zipcode" class="form-control">
                    </div>
            
                    <!-- Neighborhood Field -->
                    <div class="form-group mb-4">
                        {!! Form::label('neighborhood', trans('msg.neighborhood:'),['class'=> 'font-weight-bold']) !!}
                        <input type="text" wire:model="neighborhood" class="form-control">
                    </div>
            
                    <!-- City Field -->
                    <div class="form-group mb-4">
                        {!! Form::label('city', trans('msg.city:'),['class'=> 'font-weight-bold']) !!}
                        <input type="text" wire:model="city" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    
            
                    <!-- Uf Field -->
                    <div class="form-group mb-4">
                        {!! Form::label('uf', trans('msg.uf:'),['class'=> 'font-weight-bold']) !!}
                        <input type="text" wire:model="uf" class="form-control">
                    </div>
            
                    <!-- Profession Field -->
                    <div class="form-group mb-4">
                        {!! Form::label('profession', trans('msg.profession:'),['class'=> 'font-weight-bold']) !!}
                        <input type="text" wire:model="profession" class="form-control">
                    </div>
            
                    <!-- Rg Field -->
                    <div class="form-group mb-4">
                        {!! Form::label('rg', trans('msg.rg:'),['class'=> 'font-weight-bold']) !!}
                        <input type="text" wire:model="rg" class="form-control">
                    </div>
            
                    <!-- Cpf Field -->
                    <div class="form-group mb-4">
                        {!! Form::label('cpf', trans('msg.cpf:'),['class'=> 'font-weight-bold']) !!}
                        <input type="text" wire:model="cpf" class="form-control">
                    </div>
    
                    <!-- Created At Ip Field -->
                    <div class="form-group mb-4">
                        {!! Form::label('created_at_ip', trans('msg.created_at_ip:'),['class'=> 'font-weight-bold']) !!}
                        <input type="text" wire:model="created_at_ip" class="form-control" disabled>
                    </div>
            
                    <!-- Last Logging Ip Field -->
                    <div class="form-group mb-4">
                        {!! Form::label('last_logging_ip', trans('msg.last_logging_ip:'),['class'=> 'font-weight-bold']) !!}
                        <input type="text" wire:model="last_logging_ip" class="form-control" disabled>
                    </div>
            
                    <!-- Inclusion Date Field -->
                    <div class="form-group mb-4">
                        {!! Form::label('inclusion_date', trans('msg.inclusion_date:'),['class'=> 'font-weight-bold']) !!}
                        <input type="text" wire:model="inclusion_date" class="form-control" disabled>
                    </div>
            
                    <!-- Last Logging At Field -->
                    <div class="form-group mb-4">
                        {!! Form::label('last_logging_at', trans('msg.last_logging_at:'),['class'=> 'font-weight-bold']) !!}
                        <input type="text" wire:model="last_logging_at" class="form-control" disabled>
                    </div>
                    
                </div>
                
            </div>
        </div>
        <div class="card-footer text-end">
          <button class="btn btn-primary" type="submit" data-bs-original-title="" title="" wire:click.prevent="save">Update Profile</button>
        </div>
      </form>
    
    
</div>
