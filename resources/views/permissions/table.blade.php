<div class="table-responsive">
    <table class="table" id="permissions-table">
        <thead>
            <tr>
                <th>#</th>
                <th>{{__('msg.name')}}</th>
                <th>{{__('msg.Guard Name')}} </th>
                <th>{{__('msg.Assign Roles')}} </th>
                <th colspan="3">{{__('msg.Action')}} </th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
        @foreach($permissions as $permission)
            <tr>
                <td>{{$no++}}</td>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->guard_name }}</td>
                <td>
                <form action="{{url('give-permission-to-role')}}" method="POST">
                    <div class="ui form">
                        <div class="inline field" style="float:left;width:400px">
                            @csrf
                            <input type="hidden" name="permission_id" value="{{$permission->id}}">
                            <select name="roles[]" multiple="" class="label ui selection fluid dropdown">
                            <option value="">All</option>
                            @foreach($roles as $role)
                                <option @if($role->hasPermissionTo($permission->id)) selected @endif value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                            </select>

                        </div>
                        <div style="float:left; margin-left:5px">
                        <button type="submit" class="btn btn-success">{{__('msg.update')}} </button>
                        </div>
                    </div>
                </form>
                </td>
                <td>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $permissions->withQueryString()->links() }}
</div>
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/semantic.min.js"></script>
    <script>

    $('.label.ui.dropdown')
        .dropdown();
    $('.no.label.ui.dropdown')
    .dropdown({
    useLabels: false
    });

    $('.ui.button').on('click', function () {
    $('.ui.dropdown')
        .dropdown('restore defaults')
    })

    </script>
@endpush
