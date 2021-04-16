@extends('platform/template')
@section('content')
	<table width="100%" class="painelNivel">
      <tbody>
          <tr>
              <td>{{ __('msg.Support Management') }}</td>
              
          </tr>
      <tr><td style="font-size:2px; padding:0px; background-color:#999999">&nbsp;</td></tr>
	</tbody></table>
		
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
@endsection
