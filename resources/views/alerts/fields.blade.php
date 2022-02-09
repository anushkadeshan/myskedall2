<div class="row mt-4">
    <!-- User Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('user_id', __('msg.Requestor')) !!}
        {!! Form::text('user_id', $alert->user->name, ['class' => 'form-control', 'disabled']) !!}
    </div>
   
    <!-- Event Name Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('event_name', __('msg.Event Name')) !!}
        {!! Form::text('event_name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255, 'disabled']) !!}
    </div>
    
    <!-- Group Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('group_id', __('msg.Group Name')) !!}
        {!! Form::text('group_id', $alert->group->name, ['class' => 'form-control', 'disabled']) !!}
    </div>
    
    <!-- Routine Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('routine', __('msg.routine')) !!}
        {!! Form::text('routine', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255, 'disabled']) !!}
    </div>
    
    <!-- Is Read Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('is_read',__('msg.Action Taken ?')) !!}
        <select name="is_read" id="" class="form-control" onchange="changeAction(this,{{$alert->id}})">
            <option value="">Select Option</option>
            <option value="1" @if($alert->is_read==1) selected @endif>Action Taken</option>
            <option value="0" @if($alert->is_read==0) selected @endif>Action Not Taken</option>
        </select>
    </div>
    
    <!-- Url Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('url', __('msg.Url:')) !!}
        <br>
        <a target="_blank" href="{{url($alert->url)}}">{{url($alert->url)}}</a>
    </div>
    
    <!-- Updated By Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('updated_by', __('msg.Updated By:')) !!}
        <br>
        <p>{{ !empty($alert->updated_by) ? $alert->updated_by :'' }}</p>
    </div>

    <!-- Updated By Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('updated_at', __('msg.Updated At:')) !!}
        <br>
        <p>{{$alert->updated_at}}</p>
    </div>
</div>

<script>
    var url = '{{url('/')}}'
    function changeAction(a,id) {
    var value = (a.value || a.options[a.selectedIndex].value);  //crossbrowser solution =)
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: url+'/admin/change/action',
        dataType: "json",
        data:{
            'value':value,
            'alert_id':id
        },
        success: function(response) {
            window.location.replace(url+'/alerts');
        }
    });
}
</script>