<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Events Field -->
<div class="form-group col-sm-6">
    {!! Form::label('events', 'Events:') !!}
    {!! Form::text('events', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Reason Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('reason', 'Reason:') !!}
    {!! Form::textarea('reason', null, ['class' => 'form-control']) !!}
</div>

<!-- Space Manager Field -->
<div class="form-group col-sm-6">
    {!! Form::label('space_manager', 'Space Manager:') !!}
    {!! Form::text('space_manager', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Total People Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_people', 'Total People:') !!}
    {!! Form::number('total_people', null, ['class' => 'form-control']) !!}
</div>

<!-- Location Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('location', 'Location:') !!}
    {!! Form::textarea('location', null, ['class' => 'form-control']) !!}
</div>

<!-- Location Requester Field -->
<div class="form-group col-sm-6">
    {!! Form::label('location_requester', 'Location Requester:') !!}
    {!! Form::text('location_requester', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Initial Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('initial_date', 'Initial Date:') !!}
    {!! Form::text('initial_date', null, ['class' => 'form-control','id'=>'initial_date']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#initial_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Initial Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('initial_time', 'Initial Time:') !!}
    {!! Form::text('initial_time', null, ['class' => 'form-control']) !!}
</div>

<!-- Final Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('final_date', 'Final Date:') !!}
    {!! Form::text('final_date', null, ['class' => 'form-control','id'=>'final_date']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#final_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Final Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('final_time', 'Final Time:') !!}
    {!! Form::text('final_time', null, ['class' => 'form-control']) !!}
</div>

<!-- Space Field -->
<div class="form-group col-sm-6">
    {!! Form::label('space', 'Space:') !!}
    {!! Form::text('space', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Group Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('group_id', 'Group Id:') !!}
    {!! Form::number('group_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('status', 0) !!}
        {!! Form::checkbox('status', '1', null) !!}
    </label>
</div>


<!-- Is Draft Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_draft', 'Is Draft:') !!}
    {!! Form::number('is_draft', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Repproved Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_repproved', 'Is Repproved:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('is_repproved', 0) !!}
        {!! Form::checkbox('is_repproved', '1', null) !!}
    </label>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('approvals.index') }}" class="btn btn-default">Cancel</a>
</div>
