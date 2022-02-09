@extends('layouts.admin.master')
@section('title', 'PlanOz-Users')

@section('css')
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css" integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg==" crossorigin="anonymous" />
    <style>
        .avatar-upload {
            position: relative;
            max-width: 205px;
            margin: 50px auto;
            }
            .avatar-upload .avatar-edit {
            position: absolute;
            right: 12px;
            z-index: 1;
            top: 10px;
            }
            .avatar-upload .avatar-edit input {
            display: none;
            }
            .avatar-upload .avatar-edit input + label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #FFFFFF;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
            }
            .avatar-upload .avatar-edit input + label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
            }
            .avatar-upload .avatar-edit input + label:after {
            content: "\f040";
            font-family: 'FontAwesome';
            color: #757575;
            position: absolute;
            top: 10px;
            left: 0;
            right: 0;
            text-align: center;
            margin: auto;
            }
            .avatar-upload .avatar-preview {
            width: 192px;
            height: 192px;
            position: relative;
            border-radius: 100%;
            border: 6px solid #F8F8F8;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
            }
            .avatar-upload .avatar-preview > div {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            }
    </style>
    @endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Users')}}</li>
<li class="breadcrumb-item active">{{__('msg.profile')}}</li>
@endsection

@section('content')
<div class="container-fluid mt-3 pt-4">
    <div class="container-fluid">
        <div class="edit-profile">
          <div class="row">
            <div class="col-xl-4">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title mb-0">My Profile</h4>
                  <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse" data-bs-original-title="" title=""><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove" data-bs-original-title="" title=""><i class="fe fe-x"></i></a></div>
                </div>
                <div class="card-body">
                    <div class="row mb-2 text-center">
                      <div class="profile-title">
                        <div class="media">                        
                            <div class="avatar-upload mt-0 text-center">
                                <div class="avatar-edit">
                                    <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                                    <label for="imageUpload"></label>
                                </div>
                                <div class="avatar-preview">
                                    @php
                                        $imageurl=asset('/_dados/plataforma/usuarios/0.jpg');
                                        if(file_exists(public_path().('/_dados/plataforma/usuarios')."/".$user->id.".jpg")){
                                            $imageurl=asset('/_dados/plataforma/usuarios/'.$user->id.'.jpg');
                                        }
                                    @endphp
                                    <div id="imagePreview" style="background-image: url('{{$imageurl}}');">
                                    </div>
                                </div>
                            </div>
                          
                        </div>
                      </div>
                      <div class="media-body mt-0">
                        <h5 class="mb-1">{{$user->name}} ({{$user->nickname}})</h5>
                        <p> 
                        @if($user->level)
                            <span class="badge badge-info">{{__('msg.admin')}} </span>
                        @else
                            <span class="badge badge-warning">{{__('msg.user')}} </span>
                        @endif  

                        @if($user->status)
                            <span class="badge badge-success">{{__('msg.Approved')}} </span>
                        @else
                            <span class="badge badge-danger">{{__('msg.Rejected')}} </span>
                        @endif

                        @if($user->have_warning)
                            <span class="badge badge-danger">@lang('msg.Have warning')</span>
                        @else
                            <span class="badge badge-success">@lang('msg.No warning')</span>
                        @endif
                        @if($user->have_group_warning)
                            <span class="badge badge-danger">@lang('msg.Have group warning')</span>
                        @else
                            <span class="badge badge-success">@lang('msg.No group warning')</span>
                        @endif
                        </p>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">@lang('msg.Email')</label>
                      <input class="form-control" placeholder="your-email@domain.com" value="{{$user->email}}" data-bs-original-title="" disabled>
                    </div>
                    <livewire:users.change-password :user="$user" />
                    
                </div>
              </div>
            </div>
            <div class="col-xl-8">
                <livewire:users.edit-profile :user="$user" />
            </div>
          </div>
        </div>
      </div>
</div>
@endsection

@section('script')
<script>
    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        
        var file = input.files[0];
        
        
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
    var formData = new FormData();
        formData.append('files', $('#imageUpload')[0].files[0]);
        $.ajax({
            url: BaseUrl + "/change-profile-photo",
            method: 'POST',
            dataType: "json",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            async: false,
            success: function(response) {
                if(response['status']=='success'){
                    Swal.fire({
                        text: response['message'],
                        icon: response['status'],
                        toast: true,
                        position : 'top-end',
                        showConfirmButton : false,
                        timer: 3000
						});
                }else{
                    Swal.fire({
                        text: response['message'],
                        icon: 'error',
                        toast: true,
                        position : 'top-end',
                        showConfirmButton : false,
                        timer: 3000
                    });
                }
            }
            
        });
});


</script>
@endsection


