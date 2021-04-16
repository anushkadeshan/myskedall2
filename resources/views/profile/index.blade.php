@extends('platform/template')
@section('content')
<div class="row">
	<form action="" method="post">
		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
		<div class="col-md-12">
			<div class="col-md-6">
				<div class="form-group">
					<label>Events </label><strong style="color:red">{{$errors->first('events')}}</strong>
					<input type="text" class="form-control" name="events" value="{{old('events')}}">
					
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>No. of people </label><strong style="color:red">{{$errors->first('total_people')}}</strong>
					<input type="text" class="form-control" name="total_people" value="{{old('total_people')}}">
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-6">
				<div class="form-group">
					<label>Reason </label><strong style="color:red">{{$errors->first('reason')}}</strong>
					<input type="text" class="form-control" name="reason" value="{{old('reason')}}">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Price </label><strong style="color:red">{{$errors->first('price')}}</strong>
					<input type="text" class="form-control" name="price" value="{{old('price')}}">
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-6">
				<div class="form-group">
					<label>Initial Date </label><strong style="color:red">{{$errors->first('initial_date')}}</strong>
					<input type="text" id="datepicker1" autocomplete="off" class="form-control" name="initial_date" value="{{old('total_people')}}">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Initial Time </label><strong style="color:red">{{$errors->first('initial_time')}}</strong>
					<input type="text" placeholder="24 Hours" autocomplete="off" class="form-control" name="initial_time" value="{{old('initial_time')}}">
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-6">
				<div class="form-group">
					<label>Final Date </label><strong style="color:red">{{$errors->first('final_date')}}</strong>
					<input type="text" id="datepicker2" autocomplete="off" class="form-control" name="final_date" value="{{old('final_date')}}">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Final Time </label><strong style="color:red">{{$errors->first('final_time')}}</strong>
					<input type="text" placeholder="24 Hours" autocomplete="off" class="form-control" name="final_time" value="{{old('final_time')}}">
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-12">
				<div class="form-group">
					<label>Location </label><strong style="color:red">{{$errors->first('location')}}</strong>
					<textarea class="form-control" name="location">{{old('location')}}</textarea>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-4">
			</div>
			<div class="col-md-4 text-center">
				<input type="submit" style="color:green;font-weight: bold;" value="Request SPACE">
			</div>
			<div class="col-md-4">
			</div>
		</div>
	</form>
</div>
@endsection