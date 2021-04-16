@extends('platform/template')
@section('content')
	<table width="100%" class="painelNivel">
      <tbody><tr><td>User Data</td></tr>
      <tr><td style="font-size:2px; padding:0px; background-color:#999999">&nbsp;</td></tr>
    </tbody></table>
	<table width="100%" class="table table-responsive">
		<thead>
			<th>Name</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Address</th>
		</thead>
		<tbody>
            <tr>
                <td>{{ $data->name }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->phone }}</td>
                <td>{{ $data->address }}</td>
            </tr>
		</tbody>
	</table>
@endsection
