@extends('platform/template')
@section('content')
	<table width="100%" class="painelNivel">
      <tbody><tr><td>{{ __('msg.Organization Management') }}</td></tr>
      <tr><td style="font-size:2px; padding:0px; background-color:#999999">&nbsp;</td></tr>
    </tbody></table>
	<div>
		<a class="btn btn-primary" href="{{url('admin/edit-group')}}"><i class="fa fa-plus"></i> {{__('msg.Add New')}}</a>
    </div>

	<table id="group-list" width="100%" class="table table-responsive">
		<thead>
			<th>{{ __('msg.Id') }}</th>
			<th>{{ __('msg.Group') }}</th>
			<th>{{ __('msg.Address') }}</th>
			<th>{{ __('msg.Phone') }}</th>
			<th>{{ __('msg.Action') }}</th>
		</thead>
		<tbody>

		</tbody>
	</table>
@endsection
