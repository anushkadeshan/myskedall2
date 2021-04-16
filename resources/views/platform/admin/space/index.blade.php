@extends('platform/template')
@section('content')
	<table width="100%" class="painelNivel">
      <tbody><tr><td>{{ __('msg.request Management') }}</td></tr>
      <tr><td style="font-size:2px; padding:0px; background-color:#999999">&nbsp;</td></tr>
    </tbody></table>
	<table id="showRequests" class="table table-responsive">
		<thead>
			<th>{{ __('msg.date') }}</th>
			<th>{{ __('msg.time') }}</th>
			<th>{{ __('msg.events') }}</th>
			<th>{{ __('msg.space') }}</th>
			<th>{{ __('msg.status') }}</th>
			<th>{{ __('msg.Action') }}</th>
			<th>{{ __('msg.edit') }}</th>
		</thead>
		<tbody>

		</tbody>
	</table>
@endsection
