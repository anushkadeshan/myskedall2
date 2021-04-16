   
    
    <div class="col-md-6">
        @if($approval->status==1)
            <div class="alert alert-danger">
                <h4><i class="fa fa-ban"></i> Rejected !</h4>
                Space Request is Rejected. {{$approval->reject_reason}}
            </div>
        @elseif($approval->status==0)
            <div class="alert alert-primary">
                <h4><i class="fa fa-info"></i> Pending !</h4>
                Space Request is Pending.
            </div>
        @elseif($approval->status==2 && $approval->is_repproved==1)
            <div class="alert alert-warning">
                <h4><i class="fa fa-warning"></i> Reproved !</h4>
                Space Request is Reproved.
            </div>
        @elseif($approval->status==2 && $approval->is_repproved==0)
            <div class="alert alert-success">
                <h4><i class="fa fa-check"></i> Approved !</h4>
                Space Request is Approved.
            </div>
        @endif
        <!-- User Id Field -->
        <div class="form-group">
            {!! Html::decode(Form::label('user_id', '<strong>Location Requestor :</strong>')) !!}
            <p class="text-muted">{{ $approval->user->name }}</p>
        </div>

        <!-- Events Field -->
        <div class="form-group">
            {!! Html::decode(Form::label('user_id', '<strong>Events:</strong>')) !!}
            <p class="text-muted">{{ $approval->events }}</p>
        </div>

        <!-- Reason Field -->
        <div class="form-group">
            {!! Html::decode(Form::label('user_id', '<strong>Reason:</strong>')) !!}
            <p class="text-muted">{{ $approval->reason }}</p>
        </div>

        <!-- Space Manager Field -->
        <div class="form-group">
            {!! Html::decode(Form::label('user_id', '<strong>Space Manager:</strong>')) !!}
            <p class="text-muted">{{ $approval->space_manager }}</p>
        </div>

        <!-- Total People Field -->
        <div class="form-group">
            {!! Html::decode(Form::label('user_id', '<strong>Total People:</strong>')) !!}
            <p class="text-muted">{{ $approval->total_people }}</p>
        </div>

        <!-- Location Field -->
        <div class="form-group">
            {!! Html::decode(Form::label('user_id', '<strong>Location:</strong>')) !!}
            <p class="text-muted">{{ $approval->space_location->name }}</p>
        </div>

        <!-- Price Field -->
        <div class="form-group">
            {!! Html::decode(Form::label('user_id', '<strong>Price:</strong>')) !!}
            <p class="text-muted">{{ $approval->price }}</p>
        </div>
    </div>

    <div class="col-md-6">
        
        @if($approval->is_draft==1)
            <div class="alert alert-warning">
                 This is a draft
            </div>
        @endif

        <!-- Initial Date Field -->
        <div class="form-group">
            {!! Html::decode(Form::label('user_id', '<strong>Initial Date:</strong>')) !!}
            <p class="text-muted">{{ date_format($approval->initial_date,"Y/m/d")  }}</p>
        </div>

        <!-- Initial Time Field -->
        <div class="form-group">
            {!! Html::decode(Form::label('user_id', '<strong>Initial Time:</strong>')) !!}
            <p class="text-muted">{{ $approval->initial_time }}</p>
        </div>

        <!-- Final Date Field -->
        <div class="form-group">
            {!! Html::decode(Form::label('user_id', '<strong>Final Date:</strong>')) !!}
            <p class="text-muted">{{ date_format($approval->final_date,"Y/m/d") }}</p>
        </div>

        <!-- Final Time Field -->
        <div class="form-group">
            {!! Html::decode(Form::label('user_id', '<strong>Final Time:</strong>')) !!}
            <p class="text-muted">{{ $approval->final_time }}</p>
        </div>


        <!-- Group Id Field -->
        <div class="form-group">
            {!! Html::decode(Form::label('user_id', '<strong>Group Name:</strong>')) !!}
            <p class="text-muted">{{ $approval->group->name }}</p>
        </div>

    </div>




