<div class="row mt-4">
    <!-- User Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('user_id', 'Requestor:') !!}
        {!! Form::text('user_id', $alert->user->name, ['class' => 'form-control', 'disabled']) !!}
    </div>
   
    <!-- Event Name Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('event_name', 'Event Name:') !!}
        {!! Form::text('event_name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255, 'disabled']) !!}
    </div>
    
    <!-- Group Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('group_id', 'Group Name:') !!}
        {!! Form::text('group_id', $alert->group->name, ['class' => 'form-control', 'disabled']) !!}
    </div>
    
    <!-- Routine Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('routine', 'Routine:') !!}
        {!! Form::text('routine', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255, 'disabled']) !!}
    </div>
    
    <!-- Is Read Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('is_read', 'Action Taken ? :') !!}
        <select name="is_read" id="" class="form-control" onchange="changeAction(this,{{$alert->id}})">
            <option value="">Select Option</option>
            <option value="1" @if($alert->is_read==1) selected @endif>Action Taken</option>
            <option value="0" @if($alert->is_read==0) selected @endif>Action Not Taken</option>
        </select>
    </div>
    
    <!-- Url Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('url', 'Url:') !!}
        <br>
        <a target="_blank" href="{{url($alert->url)}}">{{url($alert->url)}}</a>
    </div>
    
    <!-- Updated By Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('updated_by', 'Updated By:') !!}
        <br>
        <p>{{ !empty($alert->updated_by) ? $alert->updated_by :'' }}</p>
    </div>

    <!-- Updated By Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('updated_at', 'Updated At:') !!}
        <br>
        <p>{{$alert->updated_at}}</p>
    </div>
</div>
@push('scripts')
    <script>
        function changeAction(a,id) {
        var value = (a.value || a.options[a.selectedIndex].value);  //crossbrowser solution =)
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: BaseUrl+'/admin/change/action',
            dataType: "json",
            data:{
                'value':value,
                'alert_id':id
            },
            success: function(response) {
                window.location.replace(BaseUrl+'/alerts');
            }
        });
    }
    </script>
@endpush