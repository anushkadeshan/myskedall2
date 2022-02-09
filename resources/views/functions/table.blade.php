<div class="table-responsive">
    <table class="table" id="functions-table">
        <thead>
            <tr>
                <th>@lang('msg.Professional')</th>
                <th>@lang('msg.Quantity')</th>
                <th>@lang('msg.Allocated')</th>
                <th>@lang('msg.Available')</th>
                <th>@lang('msg.Group')</th>
                <th colspan="3">@lang('msg.Action')</th>
            </tr>
        </thead>
        <tbody>
        @foreach($functions as $function)
            <tr>
                <td>{{ $function->professional }}</td>
                <td>{{ $function->quantity }}</td>
                <td>{{ $function->allocated }}</td>
                <td>{{ $function->quantity - $function->allocated }}</td>
                <td>{{ $function->group->name }}</td>
                <td>
                    {!! Form::open(['route' => ['functions.destroy', $function->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('functions.show', [$function->id]) }}" class='btn btn-warning btn-xs'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('functions.edit', [$function->id]) }}" class='btn btn-success btn-xs'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
