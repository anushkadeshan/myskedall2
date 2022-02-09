@extends('layouts.admin.master')
@section('title', 'PlanOz-Type of Location')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.location')}}</li>
<li class="breadcrumb-item active"> {{__('msg.Location Management')}}</li>
@endsection
@section('content')
	<div class="card mt-4">
		<h3 class="card-header">{{ __('msg.Support Management') }}</h3>
		<div class="card-body">
			<table id="showAdminSupportList" class="table table-responsive">
				<thead>
					<th>{{ __('msg.Id') }}</th>
					<th>{{ __('msg.Request Name') }}</th>
					<th>{{ __('msg.category') }}</th>
					<th>{{ __('msg.module') }}</th>
					<th>{{ __('msg.message') }}</th>
					@hasanyrole('Super Admin|Local Admin')
						<th>{{ __('msg.status') }}</th>
						<th>{{ __('msg.solution') }}</th>
						<th>{{ __('msg.Date of Solution') }}</th>
						<th>{{ __('msg.Action') }}</th>
					@endif
				</thead>
				<tbody>
		
				</tbody>
			</table>
		</div>
	</div>
	
@endsection
