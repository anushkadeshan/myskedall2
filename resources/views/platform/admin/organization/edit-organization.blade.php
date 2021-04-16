@extends('platform/template')
@section('content')
<table width="100%" class="painelNivel">
  <tbody><tr><td>{{ __('msg.Organization Management') }}</td></tr>
  <tr><td style="font-size:2px; padding:0px; background-color:#999999">&nbsp;</td></tr>
</tbody></table>
<div class="row">
	<form action="" method="post">
		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
		<div class="col-md-12">
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.name') }} </label><strong style="color:red">{{$errors->first('name')}}</strong>
					<input type="text" class="form-control" name="name" value="@if(old('name')){{old('name')}}@elseif(!empty($data->name)){{$data->name}}@endif">
                </div>
                <div class="form-group">
                    <label>{{ __('msg.description') }} </label><strong style="color:red">{{$errors->first('description')}}</strong>
                    <input type="text" class="form-control" name="description"
                        value="@if(old('description')){{old('description')}}@elseif(!empty($data->description)){{$data->description}}@endif">
                </div>
                <div class="form-group">
                    <label>{{ __('msg.address') }} </label><strong style="color:red">{{$errors->first('address')}}</strong>
                    <input type="text" class="form-control" name="address"
                        value="@if(old('address')){{old('address')}}@elseif(!empty($data->address)){{$data->address}}@endif">
                </div>
                <div class="form-group">
                    <label>{{ __('msg.schedules') }} </label><strong style="color:red">{{$errors->first('schedules')}}</strong>
                    <input type="text" class="form-control" name="schedules"
                        value="@if(old('schedules')){{old('schedules')}}@elseif(!empty($data->schedules)){{$data->schedules}}@endif">
                </div>
                <div class="form-group">
                    <label>{{ __('msg.phone') }} </label><strong style="color:red">{{$errors->first('phone')}}</strong>
                    <input type="text" class="form-control" name="phone"
                        value="@if(old('phone')){{old('phone')}}@elseif(!empty($data->phone)){{$data->phone}}@endif">
                </div>
                <div class="form-group">
                    <label>{{ __('msg.facebook') }} </label><strong style="color:red">{{$errors->first('facebook')}}</strong>
                    <input type="text" class="form-control" name="facebook"
                        value="@if(old('facebook')){{old('facebook')}}@elseif(!empty($data->facebook)){{$data->facebook}}@endif">
                </div>
                <div class="form-group">
                    <label>{{ __('msg.webSite') }} </label><strong style="color:red">{{$errors->first('site')}}</strong>
                    <input type="text" class="form-control" name="site"
                        value="@if(old('site')){{old('site')}}@elseif(!empty($data->site)){{$data->site}}@endif">
                </div>
                <div class="form-group">
                    <label>{{ __('msg.location') }} </label><strong style="color:red">{{$errors->first('mapa')}}</strong>
                    <input type="text" class="form-control" name="mapa"
                        value="@if(old('mapa')){{old('mapa')}}@elseif(!empty($data->mapa)){{$data->mapa}}@endif">
                </div>
                <div class="form-group">
                    <label>{{ __('msg.URL El Church') }} </label><strong style="color:red">{{$errors->first('url_el_church')}}</strong>
                    <input type="text" class="form-control" name="url_el_church"
                        value="@if(old('url_el_church')){{old('url_el_church')}}@elseif(!empty($data->url_el_church)){{$data->url_el_church}}@endif">
                </div>
                <div class="form-group">
                    <label>{{ __('msg.App Store') }} </label><strong style="color:red">{{$errors->first('app_store')}}</strong>
                    <select name="app_store" class="form-control">
                        <option value="0" @if(old('app_store')==0){{'selected'}}@elseif(!empty($data->app_store) &&
                            $data->app_store==0){{'selected'}}@endif >No</option>
                        <option value="1" @if(old('app_store')==1){{'selected'}}@elseif(!empty($data->app_store) &&
                            $data->app_store==1){{'selected'}}@endif >Yes</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>{{ __('msg.URL Shop') }} </label><strong style="color:red">{{$errors->first('url_shop')}}</strong>
                    <input type="text" class="form-control" name="url_shop"
                        value="@if(old('url_shop')){{old('url_shop')}}@elseif(!empty($data->url_shop)){{$data->url_shop}}@endif">
                </div>
			</div>

			<div class="col-md-6">

                <div class="form-group">
                    <label>{{ __('msg.label') }} {{ __('msg.media') }} </label><strong style="color:red">{{$errors->first('label_media')}}</strong>
                    <input type="text" class="form-control" name="label_media"
                        value="@if(old('label_media')){{old('label_media')}}@elseif(!empty($data->label_media)){{$data->label_media}}@endif">
                </div>
                <div class="form-group">
                    <label>{{ __('msg.description') }} {{ __('msg.media') }} </label><strong style="color:red">{{$errors->first('description_media')}}</strong>
                    <input type="text" class="form-control" name="description_media"
                        value="@if(old('description_media')){{old('description_media')}}@elseif(!empty($data->description_media)){{$data->description_media}}@endif">
                </div>
                <div class="form-group">
                    <label>{{ __('msg.label') }} {{ __('msg.calendar') }} </label><strong
                        style="color:red">{{$errors->first('label_calendar')}}</strong>
                    <input type="text" class="form-control" name="label_calendar"
                        value="@if(old('label_calendar')){{old('label_calendar')}}@elseif(!empty($data->label_calendar)){{$data->label_calendar}}@endif">
                </div>
                <div class="form-group">
                    <label>{{ __('msg.description') }} {{ __('msg.calendar') }} </label><strong
                        style="color:red">{{$errors->first('description_calendar')}}</strong>
                    <input type="text" class="form-control" name="description_calendar"
                        value="@if(old('description_calendar')){{old('description_calendar')}}@elseif(!empty($data->description_calendar)){{$data->description_calendar}}@endif">
                </div>
                <div class="form-group">
                    <label>{{ __('msg.label') }} {{ __('msg.download') }} </label><strong
                        style="color:red">{{$errors->first('label_download')}}</strong>
                    <input type="text" class="form-control" name="label_download"
                        value="@if(old('label_download')){{old('label_download')}}@elseif(!empty($data->label_download)){{$data->label_download}}@endif">
                </div>
                <div class="form-group">
                    <label>{{ __('msg.description') }} {{ __('msg.download') }} </label><strong
                        style="color:red">{{$errors->first('description_download')}}</strong>
                    <input type="text" class="form-control" name="description_download"
                        value="@if(old('description_download')){{old('description_download')}}@elseif(!empty($data->description_download)){{$data->description_download}}@endif">
                </div>
                <div class="form-group">
                    <label>{{ __('msg.label') }} {{ __('msg.application') }} </label><strong
                        style="color:red">{{$errors->first('label_application')}}</strong>
                    <input type="text" class="form-control" name="label_application"
                        value="@if(old('label_application')){{old('label_application')}}@elseif(!empty($data->label_application)){{$data->label_application}}@endif">
                </div>
                <div class="form-group">
                    <label>{{ __('msg.label') }} {{ __('msg.communication') }} </label><strong
                        style="color:red">{{$errors->first('label_comunication')}}</strong>
                    <input type="text" class="form-control" name="label_comunication"
                        value="@if(old('label_comunication')){{old('label_comunication')}}@elseif(!empty($data->label_comunication)){{$data->label_comunication}}@endif">
                </div>
                <div class="form-group">
                    <label>{{ __('msg.Contact Us') }} </label><strong
                        style="color:red">{{$errors->first('contact_us')}}</strong>
                    <input type="text" class="form-control" name="contact_us"
                        value="@if(old('contact_us')){{old('contact_us')}}@elseif(!empty($data->contact_us)){{$data->contact_us}}@endif">
                </div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-4">
			</div>
			<div class="col-md-4 text-center">
				<input type="submit" style="color:green;font-weight: bold;" value="{{ __('msg.submit') }}">
			</div>
			<div class="col-md-4">
			</div>
		</div>
	</form>
</div>
@endsection
