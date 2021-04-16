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
                        <a type="button" class="btn btn-warning" href="{{ route('roles.show', [$role->id]) }}" class='btn btn-default btn-xs'><i class="fa fa-eye"></i></a>
                        <a type="button" class="btn btn-success" href="{{ route('roles.edit', [$role->id]) }}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
