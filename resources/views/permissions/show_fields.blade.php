<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:',['class'=> 'font-weight-bold']) !!}
    <p class="text-muted">{{ $permission->name }}</p>
</div>

<!-- Guard Name Field -->
<div class="form-group">
    {!! Form::label('guard_name', 'Guard Name:',['class'=> 'font-weight-bold']) !!}
    <p class="text-muted">{{ $permission->guard_name }}</p>
</div>

