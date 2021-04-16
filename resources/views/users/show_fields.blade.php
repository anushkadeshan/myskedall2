<div class="row">
    <div class="col-md-6">
        <!-- Name Field -->
        <div class="form-group">
            {!! Form::label('name', trans('msg.name :'),['class'=> 'font-weight-bold']) !!}
            <p class="text-muted">{{ $user->name }}</p>
        </div>

        <!-- Nickname Field -->
        <div class="form-group">
            {!! Form::label('nickname', trans('msg.nickname:'),['class'=> 'font-weight-bold']) !!}
            <p class="text-muted">{{ $user->nickname }}</p>
        </div>

        <!-- Email Field -->
        <div class="form-group">
            {!! Form::label('email', trans('msg.email:'),['class'=> 'font-weight-bold']) !!}
            <p class="text-muted">{{ $user->email }}</p>
        </div>

        <!-- Sex Field -->
        <div class="form-group">
            {!! Form::label('sex', trans('msg.sex:'),['class'=> 'font-weight-bold']) !!}
            <p class="text-muted">{{ $user->sex }}</p>
        </div>

        <!-- Birth Field -->
        <div class="form-group">
            {!! Form::label('birth', trans('msg.birth:'),['class'=> 'font-weight-bold']) !!}
            <p class="text-muted">{{ $user->birth }}</p>
        </div>

        <!-- Phone Field -->
        <div class="form-group">
            {!! Form::label('phone',  trans('msg.phone:'),['class'=> 'font-weight-bold']) !!}
            <p class="text-muted">{{ $user->phone }}</p>
        </div>

        <!-- Address Field -->
        <div class="form-group">
            {!! Form::label('address',  trans('msg.address:'),['class'=> 'font-weight-bold']) !!}
            <p class="text-muted">{{ $user->address }}</p>
        </div>
        <!-- Zipcode Field -->
        <div class="form-group">
            {!! Form::label('zipcode', trans('msg.zipcode:'),['class'=> 'font-weight-bold']) !!}
            <p class="text-muted">{{ $user->zipcode }}</p>
        </div>

        <!-- Neighborhood Field -->
        <div class="form-group">
            {!! Form::label('neighborhood', trans('msg.neighborhood:'),['class'=> 'font-weight-bold']) !!}
            <p class="text-muted">{{ $user->neighborhood }}</p>
        </div>

        <!-- City Field -->
        <div class="form-group">
            {!! Form::label('city', trans('msg.city:'),['class'=> 'font-weight-bold']) !!}
            <p class="text-muted">{{ $user->city }}</p>
        </div>
    </div>
    <div class="col-md-6">
        

        <!-- Uf Field -->
        <div class="form-group">
            {!! Form::label('uf', trans('msg.uf:'),['class'=> 'font-weight-bold']) !!}
            <p class="text-muted">{{ $user->uf }}</p>
        </div>

        <!-- Profession Field -->
        <div class="form-group">
            {!! Form::label('profession', trans('msg.profession:'),['class'=> 'font-weight-bold']) !!}
            <p class="text-muted">{{ $user->profession }}</p>
        </div>

        <!-- Rg Field -->
        <div class="form-group">
            {!! Form::label('rg', trans('msg.rg:'),['class'=> 'font-weight-bold']) !!}
            <p class="text-muted">{{ $user->rg }}</p>
        </div>

        <!-- Cpf Field -->
        <div class="form-group">
            {!! Form::label('cpf', trans('msg.cpf:'),['class'=> 'font-weight-bold']) !!}
            <p class="text-muted">{{ $user->cpf }}</p>
        </div>

        <!-- Level Field -->
        <div class="form-group">
            {!! Form::label('level', trans('msg.level:'),['class'=> 'font-weight-bold']) !!}
                @if($user->level)
                    <span class="badge badge-info">{{__('msg.admin')}} </span>
                @else
                    <span class="badge badge-warning">{{__('msg.user')}} </span>
                @endif  
        </div>

        <!-- Status Field -->
        <div class="form-group">
            {!! Form::label('status', trans('msg.status:'),['class'=> 'font-weight-bold']) !!}
                @if($user->status)
                    <span class="badge badge-success">{{__('msg.Aproved')}} </span>
                @else
                    <span class="badge badge-danger">{{__('msg.Rejected')}} </span>
                @endif
        </div>

        <!-- Have Warning Field -->
        <div class="form-group">
            {!! Form::label('have_warning', trans('msg.have_warning:'),['class'=> 'font-weight-bold']) !!}
                @if($user->have_warning)
                    <span class="badge badge-danger">Yes</span>
                @else
                    <span class="badge badge-success">No</span>
                @endif
        </div>

        <!-- Have Group Warning Field -->
        <div class="form-group">
            {!! Form::label('have_group_warning', trans('msg.have_group_warning:'),['class'=> 'font-weight-bold']) !!}
                @if($user->have_group_warning)
                    <span class="badge badge-danger">Yes</span>
                @else
                    <span class="badge badge-success">No</span>
                @endif
        </div>

        <!-- Created At Ip Field -->
        <div class="form-group">
            {!! Form::label('created_at_ip', trans('msg.created_at_ip:'),['class'=> 'font-weight-bold']) !!}
            <p class="text-muted">{{ $user->created_at_ip }}</p>
        </div>

        <!-- Last Logging Ip Field -->
        <div class="form-group">
            {!! Form::label('last_logging_ip', trans('msg.last_logging_ip:'),['class'=> 'font-weight-bold']) !!}
            <p class="text-muted">{{ $user->last_logging_ip }}</p>
        </div>

        <!-- Inclusion Date Field -->
        <div class="form-group">
            {!! Form::label('inclusion_date', trans('msg.inclusion_date:'),['class'=> 'font-weight-bold']) !!}
            <p class="text-muted">{{ $user->inclusion_date }}</p>
        </div>

        <!-- Last Logging At Field -->
        <div class="form-group">
            {!! Form::label('last_logging_at', trans('msg.last_logging_at:'),['class'=> 'font-weight-bold']) !!}
            <p class="text-muted">{{ $user->last_logging_at }}</p>
        </div>
        
    </div>
    
</div>



