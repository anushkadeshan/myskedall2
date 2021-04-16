@extends('platform/template')
@section('content')
<table width="100%" class="painelNivel">
  <tbody><tr><td>{{ __('msg.Type of Locations') }}</td></tr>
  <tr><td style="font-size:2px; padding:0px; background-color:#999999">&nbsp;</td></tr>
</tbody></table>
<div class="row">
	<form action="" method="post">
		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
		<div class="col-md-12">
			<div class="col-md-12">
				<div class="form-group">
					<label>{{ __('msg.Location Type') }} </label><strong style="color:red">{{$errors->first('location_type')}}</strong>
					<input type="text" required class="form-control" name="location_type" value="@if(old('location_type')){{old('location_type')}}@elseif(!empty($data->location_type)){{$data->location_type}}@endif">
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
