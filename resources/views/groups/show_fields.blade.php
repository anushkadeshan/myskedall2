<div class="row">
    <div class="col-md-6">
        <!-- Idmoderador Field -->
        <div class="form-group  mb-4">
            {!! Form::label('idModerador', trans("msg.Idmoderador:") ,['class'=> 'font-weight-bold'])  !!}
            <p class="text-muted">{{ $group->idModerador }}</p>
        </div>

        <!-- Name Field -->
        <div class="form-group mb-4">
            {!! Form::label('name', trans("msg.name :"),['class'=> 'font-weight-bold'])  !!}
            <p class="text-muted">{{ $group->name }}</p>
        </div>

        <!-- Description Field -->
        <div class="form-group mb-4">
            {!! Form::label('description',  trans("msg.Description :"),['class'=> 'font-weight-bold'])  !!}
            <p class="text-muted">{{ $group->description }}</p>
        </div>

        <!-- Address Field -->
        <div class="form-group mb-4">
            {!! Form::label('address', trans('msg.Address:'),['class'=> 'font-weight-bold'])  !!}
            <p class="text-muted">{{ $group->address }}</p>
        </div>

        <!-- Schedules Field -->
        <div class="form-group mb-4">
            {!! Form::label('schedules', trans('msg.Schedules :'),['class'=> 'font-weight-bold'])  !!}
            <p class="text-muted">{{ $group->schedules }}</p>
        </div>

        <!-- Phone Field -->
        <div class="form-group mb-4">
            {!! Form::label('phone', trans('msg.phone:'),['class'=> 'font-weight-bold'])  !!}
            <p class="text-muted">{{ $group->phone }}</p>
        </div>
        <!-- Facebook Field -->
        <div class="form-group mb-4">
            {!! Form::label('facebook', trans('msg.facebook:'),['class'=> 'font-weight-bold'])  !!}
            <p class="text-muted">{{ $group->facebook }}</p>
        </div>

        <!-- Site Field -->
        <div class="form-group mb-4">
            {!! Form::label('site', trans('msg.site :'), ['class'=> 'font-weight-bold'])  !!}
            <p class="text-muted">{{ $group->site }}</p>
        </div>

        <!-- Mapa Field -->
        <div class="form-group mb-4">
            {!! Form::label('mapa', trans('msg.mapa :'), ['class'=> 'font-weight-bold'])  !!}
            <p class="text-muted">{{ $group->mapa }}</p>
        </div>
    </div>
    <div class="col-md-6">
        <!-- Url El Church Field -->
        <div class="form-group mb-4">
            {!! Form::label('url_el_church', trans('msg.url_el_church :'),['class'=> 'font-weight-bold'])  !!}
            <p class="text-muted">{{ $group->url_el_church }}</p>
        </div>

        <!-- App Store Field -->
        <div class="form-group mb-4">
            {!! Form::label('app_store', trans('msg.app_store :'),['class'=> 'font-weight-bold'])  !!}
            <p class="text-muted">{{ $group->app_store }}</p>
        </div>

        <!-- Url Shop Field -->
        <div class="form-group mb-4">
            {!! Form::label('url_shop', trans('msg.url_shop :'),['class'=> 'font-weight-bold'])  !!}
            <p class="text-muted">{{ $group->url_shop }}</p>
        </div>

        <!-- Label Media Field -->
        <div class="form-group mb-4">
            {!! Form::label('label_media',  trans('msg.label_media :'),['class'=> 'font-weight-bold'])  !!}
            <p class="text-muted">{{ $group->label_media }}</p>
        </div>

        <!-- Description Media Field -->
        <div class="form-group mb-4">
            {!! Form::label('description_media', trans('msg.description_media :'),['class'=> 'font-weight-bold'])  !!}
            <p class="text-muted">{{ $group->description_media }}</p>
        </div>

        <!-- Label Calendar Field -->
        <div class="form-group mb-4">
            {!! Form::label('label_calendar', trans('msg.label_calendar :'), ['class'=> 'font-weight-bold'])  !!}
            <p class="text-muted">{{ $group->label_calendar }}</p>
        </div>

        <!-- Description Calendar Field -->
        <div class="form-group mb-4">
            {!! Form::label('description_calendar', trans('msg.description_calendar :'),['class'=> 'font-weight-bold'])  !!}
            <p class="text-muted">{{ $group->description_calendar }}</p>
        </div>

        <!-- Label Download Field -->
        <div class="form-group mb-4">
            {!! Form::label('label_download', trans('msg.label_download :'),['class'=> 'font-weight-bold'])  !!}
            <p class="text-muted">{{ $group->label_download }}</p>
        </div>

        <!-- Description Download Field -->
        <div class="form-group mb-4">
            {!! Form::label('description_download', trans('msg.description_download :') ,['class'=> 'font-weight-bold'])  !!}
            <p class="text-muted">{{ $group->description_download }}</p>
        </div>

        <!-- Label Application Field -->
        <div class="form-group mb-4">
            {!! Form::label('label_application', trans('msg.label_application :'),['class'=> 'font-weight-bold'])  !!}
            <p class="text-muted">{{ $group->label_application }}</p>
        </div>

        <!-- Label Comunication Field -->
        <div class="form-group mb-4">
            {!! Form::label('label_comunication',  trans('msg.label_comunication :'),['class'=> 'font-weight-bold'])  !!}
            <p class="text-muted">{{ $group->label_comunication }}</p>
        </div>

        <!-- Contact Us Field -->
        <div class="form-group mb-4">
            {!! Form::label('contact_us', trans('msg.contact_us :'),['class'=> 'font-weight-bold'])  !!}
            <p class="text-muted">{{ $group->contact_us }}</p>
        </div>
    </div>
</div>


