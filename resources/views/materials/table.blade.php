<div class="table-responsive">
    <table class="table" id="materials-table">
        <thead>
            <tr>
                <th>Material</th>
                <th>Quantity</th>
                <th>Allocated</th>
                <th>Available</th>
                <th>Group</th>

                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($materials as $material)
            <tr>
                <td>{{ $material->material }}</td>
                <td>{{ $material->quantity }}</td>
                <td>{{ $material->allocated }}</td>
                <td>{{ $material->quantity - $material->allocated }}</td>
                <td>{{ $material->group->name }}</td>
                <td>
                    {!! Form::open(['route' => ['materials.destroy', $material->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('materials.show', [$material->id]) }}" class='btn btn-warning btn-xs'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('materials.edit', [$material->id]) }}" class='btn btn-success btn-xs'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
