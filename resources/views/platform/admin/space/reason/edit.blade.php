@extends('platform/template')
@section('content')
<table width="100%" class="painelNivel">
  <tbody><tr><td>{{ __('msg.Reason Management') }}</td></tr>
  <tr><td style="font-size:2px; padding:0px; background-color:#999999">&nbsp;</td></tr>
</tbody></table>
<div class="row">
	<form action="" method="post">
		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
		<div class="col-md-12">
			<div class="col-md-12">
				<div class="form-group">
					<label>{{ __('msg.reason') }} </label><strong style="color:red">{{$errors->first('reason')}}</strong>
					<input type="text" class="form-control" name="reason" value="@if(old('reason')){{old('reason')}}@elseif(!empty($data->reason)){{$data->reason}}@endif">
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
