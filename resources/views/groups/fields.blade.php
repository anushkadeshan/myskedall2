<div class="row">
    <div class="col-md-6">
            <!-- Idmoderador Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('idModerador', trans("msg.Idmoderador:")) !!}
            {!! Form::number('idModerador', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Name Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('name', trans("msg.name :")) !!}
            {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 100,'maxlength' => 100]) !!}
        </div>

        <!-- Description Field -->
        <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('description', trans("msg.Description :")) !!}
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Address Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('address', trans('msg.Address:')) !!}
            {!! Form::text('address', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
        </div>

        <!-- Schedules Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('schedules', trans('msg.Schedules :') ) !!}
            {!! Form::text('schedules', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
        </div>

        <!-- Phone Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('phone', trans('msg.phone:')) !!}
            {!! Form::text('phone', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
        </div>

        <!-- Facebook Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('facebook', trans('msg.facebook:')) !!}
            {!! Form::text('facebook', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
        </div>

        <!-- Site Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('site', trans('msg.site :')) !!}
            {!! Form::text('site', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
        </div>

        <!-- Mapa Field -->
        <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('mapa', trans('msg.mapa :')) !!}
            {!! Form::textarea('mapa', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Url El Church Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('url_el_church', trans('msg.url_el_church :')) !!}
            {!! Form::text('url_el_church', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
        </div>
    </div>

    <div class="col-md-6">
            <!-- App Store Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('app_store', trans('msg.app_store :')) !!}
            <label class="checkbox-inline">
                {!! Form::hidden('app_store', 0) !!}
                {!! Form::checkbox('app_store', '1', null) !!}
            </label>
        </div>


        <!-- Url Shop Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('url_shop', trans('msg.url_shop :')) !!}
            {!! Form::text('url_shop', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
        </div>

        <!-- Label Media Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('label_media', trans('msg.label_media :')) !!}
            {!! Form::text('label_media', null, ['class' => 'form-control','maxlength' => 40,'maxlength' => 40]) !!}
        </div>

        <!-- Description Media Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('description_media', trans('msg.description_media :')) !!}
            {!! Form::text('description_media', null, ['class' => 'form-control','maxlength' => 150,'maxlength' => 150]) !!}
        </div>

        <!-- Label Calendar Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('label_calendar', trans('msg.label_calendar :')) !!}
            {!! Form::text('label_calendar', null, ['class' => 'form-control','maxlength' => 40,'maxlength' => 40]) !!}
        </div>

        <!-- Description Calendar Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('description_calendar', trans('msg.description_calendar :')) !!}
            {!! Form::text('description_calendar', null, ['class' => 'form-control','maxlength' => 150,'maxlength' => 150]) !!}
        </div>

        <!-- Label Download Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('label_download', trans('msg.label_download :')) !!}
            {!! Form::text('label_download', null, ['class' => 'form-control','maxlength' => 40,'maxlength' => 40]) !!}
        </div>

        <!-- Description Download Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('description_download', trans('msg.description_download :')) !!}
            {!! Form::text('description_download', null, ['class' => 'form-control','maxlength' => 150,'maxlength' => 150]) !!}
        </div>

        <!-- Label Application Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('label_application', trans('msg.label_application :')) !!}
            {!! Form::text('label_application', null, ['class' => 'form-control','maxlength' => 40,'maxlength' => 40]) !!}
        </div>

        <!-- Label Comunication Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('label_comunication', trans('msg.label_comunication :')) !!}
            {!! Form::text('label_comunication', null, ['class' => 'form-control','maxlength' => 40,'maxlength' => 40]) !!}
        </div>

        <!-- Contact Us Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('contact_us', trans('msg.contact_us :')) !!}
            {!! Form::text('contact_us', null, ['class' => 'form-control','maxlength' => 40,'maxlength' => 40]) !!}
        </div>

        <!-- Submit Field -->
        <div class="form-group col-sm-12">
            {!! Form::submit(trans('msg.Save'), ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('groups.index') }}" class="btn btn-default"> {{__('msg.cancel')}} </a>
        </div>
    </div>


</div>
