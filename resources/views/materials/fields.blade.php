<!-- Material Field -->
<div class="form-group col-sm-6">
    {!! Form::label('material', 'Material:') !!}
    {!! Form::text('material', null, ['class' => 'form-control','maxlength' => 200,'maxlength' => 200]) !!}
</div>

<!-- Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantity', 'Quantity:') !!}
    {!! Form::number('quantity', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('group_id', 'Group:') !!}
    @php
        $groups = DB::table('groups')->select('name','id')->get();
    @endphp
    <select class="form-control" name="group_id" id="" required>
        <option value="">Select a Group</option>
        @foreach($groups as $group)
            <option @if(isset($material) && $material->group_id==$group->id) selected @endif value="{{$group->id}}">{{$group->name}}</option>
        @endforeach
    </select>
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('materials.index') }}" class="btn btn-default">Cancel</a>
</div>
