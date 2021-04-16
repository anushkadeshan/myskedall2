@extends('platform/template')
@section('content')
<table width="100%" class="painelNivel">
  <tbody><tr><td>{{ __('msg.Support Management') }}</td></tr>
  <tr><td style="font-size:2px; padding:0px; background-color:#999999">&nbsp;</td></tr>
</tbody></table>
<div class="row">
	<form action="" method="post">
		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
		<div class="col-md-12">
			<div class="col-md-12">
				<div class="form-group">
					<label>{{ __('msg.status') }} </label><strong style="color:red">{{$errors->first('status')}}</strong>
                    <select class="form-control" name="status" id="">
                        <option @if($data->status==0) selected @endif value="0">Pending</option>
                        <option @if($data->status==1) selected @endif value="1">Work in Progress</option>
                        <option @if($data->status==2) selected @endif value="2">Cancle</option>
                        <option @if($data->status==3) selected @endif value="3">Finished</option>
                    </select>
				</div>
            </div>
        </div>
		<div class="col-md-12">
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{ __('msg.solution') }} </label><strong style="color:red">{{$errors->first('solution')}}</strong>
                    <textarea class="form-control" name="solution">@if(old('solution')){{old('solution')}}@elseif(!empty($data->solution)){{$data->solution}}@endif</textarea>
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
