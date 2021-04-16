@extends('platform/template')
@section('content')
	<table width="100%" class="painelNivel">
      <tbody><tr><td>Organization Management</td></tr>
      <tr><td style="font-size:2px; padding:0px; background-color:#999999">&nbsp;</td></tr>
    </tbody></table>
	<div>
		<a class="btn btn-primary" href="{{url('admin/edit-organization')}}"><i class="fa fa-plus"></i> Add New</a>
	</div>
	<table id="event-list" class="table table-responsive">
		<thead>
			<th>#Id</th>
			<th>Title</th>
			<th>Group</th>
			<th>Edit By</th>
			<th>Status</th>
			<th>Action</th>
		</thead>
		<tbody>
			
		</tbody>
	</table>
@endsection