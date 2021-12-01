<div class="table-responsive">
    <table class="table" id="roles-table">
        <thead>
            <tr>
                <th>{{__('msg.name')}} </th>
                <th>{{__('msg.Guard Name')}} </th>
                <th colspan="3">{{__('msg.Action')}} </th>
            </tr>
        </thead>
        <tbody>
        @foreach($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
            <td>{{ $role->guard_name }}</td>
                <td>
                    {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>


                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
