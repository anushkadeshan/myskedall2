@extends('platform/template')
@section('content')
	<table width="100%" class="painelNivel">
      <tbody><tr><td>{{ __('msg.alerts') }}</td></tr>
      <tr><td style="font-size:2px; padding:0px; background-color:#999999">&nbsp;</td></tr>
    </tbody></table>
	<table width="100%" id="showAlertList" class="table table-responsive">
		<thead>
			<th>{{ __('msg.date') }}</th>
			<th>{{ __('msg.Event Name') }}</th>
			<th>{{ __('msg.Group') }}</th>
			<th>{{ __('msg.routine') }}</th>
			<th>{{ __('msg.requester') }}</th>
			<th>{{ __('msg.status') }}</th>
		</thead>
		<tbody>

		</tbody>
	</table>
@endsection
