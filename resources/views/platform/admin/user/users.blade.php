@extends('platform/template')
@section('content')
	<table width="100%" class="painelNivel">
      <tbody><tr><td>User Management</td></tr>
      <tr><td style="font-size:2px; padding:0px; background-color:#999999">&nbsp;</td></tr>
    </tbody></table>
	<div>
		<a class="btn btn-primary" href="{{url('admin/new-user')}}"><i class="fa fa-plus"></i> Add New</a>
		<a class="btn btn-primary" href="{{url('admin/new-user')}}"><i class="fa fa-plus"></i> Admin Types</a>
	</div>
	<table class="table table-responsive">
		<thead>
			<th>{{ __('msg.Id') }}</th>
			<th>{{ __('msg.name') }}</th>
			<th>{{ __('msg.Email') }}</th>
			@if(session('SuperAdmin')==1)
            <th>{{ __('msg.Group') }}</th>
			<th>{{ __('msg.Is Admin') }} ?</th>
            <th>{{ __('msg.Type of Admin') }}</th>
            @endif
			<th>{{ __('msg.status') }}</th>
			<th>{{ __('msg.Action') }}</th>
		</thead>
		<tbody>
			@foreach($users as $user)
                <tr>
                <td>{{$user->user_id}}</td>
                <td>{{$user->user_name}}</td>
				<td>{{$user->email}}</td>
				@if(session('SuperAdmin')==1)
				<td>
					<select name="group_id" id="group" onchange="group(this,{{$user->user_id}})">
						@foreach($allgroups as $group)
							<option @if($group->group_id==$user->group_id) selected @endif value="{{$group->group_id}}">{{$group->name}}</option>
						@endforeach
					</select>
				</td>
                
                <td>
                    <select name="level" id="level" onchange="level(this,{{$user->user_id}})">
                        <option value="0" @if($user->level==0) selected @endif>No</option>
                        <option value="1" @if($user->level==1) selected @endif>Yes</option>
                    </select>
                </td>
                <td>
                    <select name="admin" id="admin" onchange="admin(this,{{$user->user_id}})">
                        <option value="distributor_level" @if($user->distributor_level==1) selected @endif>Super Admin</option>
                        <option value="manager_level" @if($user->manager_level==1) selected @endif>Local Admin</option>
                        <option value="secretary_level" @if($user->secretary_level==1) selected @endif>Module Admin</option>
                    </select>
                </td>
                @endif
                <td>
                    
                    <select name="status" id="status" onchange="status(this,{{$user->user_id}})">
                        <option value="0" @if($user->status==0) selected @endif>Validate</option>
                        <option value="1" @if($user->status==1) selected @endif>Active</option>
                        <option value="2" @if($user->status==2) selected @endif>Inactive</option>
                    </select>
                </td>
                <td align="center">
					<a href="{{ROUTE('edit.user',$user->user_id)}}"><i class="fa fa-edit"></i></a>
                </td>
                </tr>
            @endforeach
		</tbody>
    </table>
    <script>
		function group(a,id) {
            var value = (a.value || a.options[a.selectedIndex].value);  //crossbrowser solution =)
            $.ajax({
				type: 'POST',
				url: BaseUrl+'/admin/change-user-group',
				dataType: "json",
				data:{
					'value':value,
					'id':id
				},
				success: function(response) {
					if(response['status']=='success'){
						Alert(response['message'], 'success');
					}else{
						Alert(response['message'], 'danger');
					}
				}
			});
    	}
        function level(a,id) {
            var value = (a.value || a.options[a.selectedIndex].value);  //crossbrowser solution =)
            $.ajax({
				type: 'POST',
				url: BaseUrl+'/admin/change-user-level',
				dataType: "json",
				data:{
					'value':value,
					'id':id
				},
				success: function(response) {
					if(response['status']=='success'){
						Alert(response['message'], 'success');
					}else{
						Alert(response['message'], 'danger');
					}
				}
			});
    }

    function admin(a,id) {
            var value = (a.value || a.options[a.selectedIndex].value);  //crossbrowser solution =)
            $.ajax({
				type: 'POST',
				url: BaseUrl+'/admin/change-user-admin',
				dataType: "json",
				data:{
					'value':value,
					'id':id
				},
				success: function(response) {
					if(response['status']=='success'){
						Alert(response['message'], 'success');
					}else{
						Alert(response['message'], 'danger');
					}
				}
			});
    }

    function status(a,id) {
            var value = (a.value || a.options[a.selectedIndex].value);  //crossbrowser solution =)
            $.ajax({
				type: 'POST',
				url: BaseUrl+'/admin/change-user-status',
				dataType: "json",
				data:{
					'value':value,
					'id':id
				},
				success: function(response) {
					if(response['status']=='success'){
						Alert(response['message'], 'success');
					}else{
						Alert(response['message'], 'danger');
					}
				}
			});
    }
    </script>
@endsection