<!-- User Id Field -->
<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('created At', 'Date :') !!}
        <p class="text-muted">{{ date('Y-M-d - H:i:s', strtotime($alert->created_at)) }}</p>
    </div>

    <div class="form-group">
        {!! Form::label('user_id', 'Requester :') !!}
        <p class="text-muted">{{ $alert->user->name }}</p>
    </div>
    
    <!-- Event Name Field -->
    <div class="form-group">
        {!! Form::label('event_name', 'Event Name:') !!}
        <p class="text-muted">{{ $alert->event_name }}</p>
    </div>
    
    <!-- Group Id Field -->
    <div class="form-group">
        {!! Form::label('group_id', 'Group Id:') !!}
        <p class="text-muted">{{ $alert->group->name }}</p>
    </div>
    <!-- Routine Field -->
    <div class="form-group">
        {!! Form::label('routine', 'Routine:') !!}
        <p class="text-muted">{{ $alert->routine }}</p>
    </div>
</div>
<div class="col-md-6">
    <!-- Is Read Field -->
    <div class="form-group">
        {!! Form::label('is_read', 'Is Read:') !!}
        <p class="text-muted">
            @if($alert->is_read==1)
                <span class="badge badge-success">Action Took</span>
            @else
                <span class="badge badge-danger">Not taken an action</span>
            @endif
        </p>
    </div>
    
    <!-- Url Field -->
    <div class="form-group">
        {!! Form::label('url', 'Url:') !!}
        <a href="{{ url($alert->url) }}"><p class="text-primary">{{ url($alert->url) }}</p></a>
    </div>
    
    <!-- Deleted By Field -->
    <div class="form-group">
        {!! Form::label('deleted_by', 'Deleted By:') !!}
        <p class="text-muted">{{ !empty($alert->updated_by) ? $alert->updated_by :'' }}</p>
    </div>
</div>

