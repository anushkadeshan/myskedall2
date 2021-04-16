<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:',['class'=> 'font-weight-bold']) !!}
    <p class="text-muted">{{ $role->name }}</p>
</div>

<!-- Guard Name Field -->
<div class="form-group">
    {!! Form::label('guard_name', 'Guard Name:',['class'=> 'font-weight-bold']) !!}
    <p class="text-muted">{{ $role->guard_name }}</p>
</div>

