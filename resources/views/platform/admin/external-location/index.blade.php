@extends('platform/template')
@section('content')
	<table width="100%" class="painelNivel">
      <tbody><tr><td>{{ __('msg.type of Location') }}</td></tr>
      <tr><td style="font-size:2px; padding:0px; background-color:#999999">&nbsp;</td></tr>
    </tbody></table>
	<div>
		<a href="{{url('admin/edit-external-location')}}" class="btn btn-primary"><i class="fa fa-plus"></i> {{ __('msg.Add New') }}</a>
	</div>
	<table id="showExternalLocationList" class="table table-responsive">
		<thead>
			<th>{{ __('msg.Id') }}</th>
			<th>{{ __('msg.title') }}</th>
			<th>{{ __('msg.edit') }}</th>
		</thead>
		<tbody>

		</tbody>
	</table>
@endsection
