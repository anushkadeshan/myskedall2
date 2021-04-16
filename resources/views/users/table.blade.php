<div class="table-responsive">
    <table class="table" id="users-table">
        <thead>
            <tr>
                <th>#</th>
                <th>{{__('msg.name')}}</th>
                <th class="d-none d-lg-table-cell">{{__('msg.Level')}} </th>
                <th class="d-none d-lg-table-cell">{{__('msg.Status')}} </th>
                <th class="d-none d-lg-table-cell">{{__('msg.Have Warning')}} </th>
                <th class="d-none d-lg-table-cell">{{__('msg.Have Group Warning')}} </th>
                @role('Super Admin')
                <th>{{__('msg.Role')}}</th>
                @endrole
                <th>{{__('msg.Groups')}} </th>
                <th colspan="3">{{__('msg.Action')}} </th>
            </tr>
        </thead>
        <tbody>
        @php
            $no = 1;
        @endphp
        @foreach($users as $user)
            <tr>
            <td>{{$no++}}</td>
            <td>{{ $user->name }}</td>
            <td class="d-none d-lg-table-cell">
                @if($user->hasAnyRole(['Super Admin','Local Admin','Module Admin']))
                    <span class="badge badge-info">Admin</span>
                @endif
                @if($user->hasRole('User'))
                    <span class="badge badge-warning">User</span>
                @endif
            </td>
            <td class="d-none d-lg-table-cell">
                @if($user->status)
                    <span class="badge badge-success">Aproved</span>
                @else
                    <span class="badge badge-danger">Rejected</span>
                @endif
            </td>
            <td class="d-none d-lg-table-cell">
                @if($user->have_warning)
                    <span class="badge badge-danger">Yes</span>
                @else
                    <span class="badge badge-success">No</span>
                @endif
            </td>
            <td class="d-none d-lg-table-cell">
                @if($user->have_group_warning)
                    <span class="badge badge-danger">Yes</span>
                @else
                    <span class="badge badge-success">No</span>
                @endif
            </td>
            @role('Super Admin')
                <td>
                <div class="form-group">
                    <select class="form-control" @if($user->id==1) disabled @endif name="role" id="role" onchange="role(this,{{$user->id}})">
                        <option value="">Select a Role</option>
                        @foreach($roles as $role)
                            <option @if($user->hasRole($role->name)==$role->name) selected @endif value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
            </td>
            @endrole
                
                <td>
                    @foreach($user->groups as $group)
                    @if($group->pivot->approved==true)
                    <span class="badge badge-success">{{$group->name}}</span>  
                    @else
                    <span class="badge badge-danger">{{$group->name}}</span> 
                    @endif
                      
                    @endforeach
                </td>
                <td>
                    {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a type="button" class="btn btn-primary" onclick="openModalApps({{$user->id}})" ><i class="fa fa-list"></i></a>
                        <a type="button" class="btn btn-warning" href="{{ route('users.show', [$user->id]) }}" class='btn btn-default btn-xs'><i class="fa fa-eye"></i></a>
                        <a type="button" class="btn btn-success" href="{{ route('users.edit', [$user->id]) }}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            <div class="modal fade" id="ModalApps{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form action="{{url('assign-apps-to-user')}}" method="POST">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Assign Apps to {{$user->name}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @php
                                    $group_ids = [];
                                @endphp
                                @foreach($user->groups as $group)
                                    @php
                                       $group_ids[]= $group->pivot->group_id;
                                    @endphp
                                @endforeach
                                @php
                                    $apps = \DB::table('group_apps')
                                            ->join('apps','apps.id','=','group_apps.app_id')
                                            ->whereIn('group_id',$group_ids)
                                            ->where('active',true)
                                            ->groupBy('group_apps.app_id')
                                            ->get();
                                @endphp
                                @csrf
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                @if($apps->count() == 0)
                                    No Apps Found for User's Groups
                                @endif
                                @foreach ($apps as $app)
                                <div class="icheck-primary icheck-inline">                         
                                    <input @foreach($user->apps as $user_app) @if($user_app->pivot->app_id==$app->id)checked @endif @endforeach type="checkbox" id="chb{{$app->id}}{{$user->id}}" name="apps[]" value="{{$app->id}}" />
                                    <label for="chb{{$app->id}}{{$user->id}}">{{$app->title_en}}</label>
                                </div>
                                @endforeach
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                @csrf
                                @if($apps->count() > 0)
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
    {{ $users->withQueryString()->links() }}
</div>
@push('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.css" integrity="sha512-J5tsMaZISEmI+Ly68nBDiQyNW6vzBoUlNHGsH8T3DzHTn2h9swZqiMeGm/4WMDxAphi5LMZMNA30LvxaEPiPkg==" crossorigin="anonymous" />
<script>
    function role(a,id) {
        var value = (a.value || a.options[a.selectedIndex].value);  //crossbrowser solution =)
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: BaseUrl+'/change/role',
            dataType: "json",
            data:{
                'role':value,
                'user':id
            },
            success: function(response) {
                location.reload();
            }
        });
    }
    
    function openModalApps(user_id) {
        $('#ModalApps'+user_id).modal('show');
    }
</script>
@endpush