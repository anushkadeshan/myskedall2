@extends('platform/template')
@section('content')
<table width="100%" class="painelNivel">
  <tbody><tr><td>Events Management</td></tr>
  <tr><td style="font-size:2px; padding:0px; background-color:#999999">&nbsp;</td></tr>
</tbody></table>
<div class="row">
	<form action="" method="post">
		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
		<div class="col-md-12">
			<div class="col-md-12">
				<div class="form-group">
					<label>Events </label><strong style="color:red">{{$errors->first('title')}}</strong>
					<input type="text" class="form-control" name="title" value="@if(old('title')){{old('title')}}@elseif(!empty($data->title)){{$data->title}}@endif">
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label>Group </label><strong style="color:red">{{$errors->first('total_people')}}</strong>
					<select name="group_id" class="form-control">
					@foreach($groupList as $gp)
						<option value="{{$gp->group_id}}" @if(old('group_id')==$gp->group_id){{'selected'}}@elseif(!empty($data->group_id) && $data->group_id==$gp->group_id){{'selected'}}@endif >{{$gp->name}}</option>
					@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-4">
			</div>
			<div class="col-md-4 text-center">
				<input type="submit" style="color:green;font-weight: bold;" value="Submit">
			</div>
			<div class="col-md-4">
			</div>
		</div>
	</form>
</div>
@endsection