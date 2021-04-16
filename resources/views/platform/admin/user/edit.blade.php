@extends('platform/template')
@section('content')
<div class="row" style="margin:5">
<form action="{{ROUTE('update.user')}}" method="POST">
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" name="name" class="form-control" id="" value="{{$editUser->name}}">
        </div>
        <div class="form-group">
            <label for="">Nick Name</label>
            <input type="text" name="nickname" class="form-control" id="" value="{{$editUser->nickname}}">
        </div>
        <div class="form-group">
            <label for="">Sex</label>
            <select class="form-control" name="sex" id="">
                <option @if($editUser->sex=='male') selected @endif value="male">Male</option>
                <option @if($editUser->sex=='female') selected @endif value="female">Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Birth Date</label>
            <input type="date" name="birth" class="form-control" id="" value="{{$editUser->birth}}">
        </div>
        <div class="form-group">
            <label for="">Phone</label>
            <input type="text" name="phone" class="form-control" id="" value="{{$editUser->phone}}">
        </div>
        <div class="form-group">
            <label for="">Address</label>
            <input type="text" name="address" class="form-control" id="" value="{{$editUser->address}}">
        </div>
        <div class="form-group">
            <label for="">Zip Code</label>
            <input type="text" name="zipcode" class="form-control" id="" value="{{$editUser->zipcode}}">
        </div>
        <div class="form-group">
            <label for="">Neighborhood</label>
            <input type="text" name="neighborhood" class="form-control" id="" value="{{$editUser->neighborhood}}">
        </div>
        <div class="form-group">
            <label for="">City</label>
            <input type="text" name="city" class="form-control" id="" value="{{$editUser->city}}">
        </div>
        <div class="form-group">
            <label for="">Uf</label>
            <input type="text" name="uf" class="form-control" id="" value="{{$editUser->uf}}">
        </div>
        <div class="form-group">
            <label for="">Profession</label>
            <input type="text" name="profession" class="form-control" id="" value="{{$editUser->profession}}">
        </div>
        <div class="form-group">
            <label for="">RG</label>
            <input type="text" name="rg" class="form-control" id="" value="{{$editUser->rg}}">
        </div>
        <div class="form-group">
            <label for="">CPF</label>
            <input type="text" name="cpf" class="form-control" id="" value="{{$editUser->cpf}}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Have Warning</label>
            <select class="form-control" name="have_warning" id="">
                <option @if($editUser->have_warning==1) selected @endif value="1">Yes</option>
                <option @if($editUser->have_warning==0) selected @endif value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Have Group Warning</label>
            <select class="form-control" name="have_group_warning" id="">
                <option @if($editUser->have_group_warning==1) selected @endif value="1">Yes</option>
                <option @if($editUser->have_group_warning==0) selected @endif value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">App Messages</label>
            <select class="form-control" name="app_messages" id="">
                <option @if($editUser->app_messages==1) selected @endif value="1">Yes</option>
                <option @if($editUser->app_messages==0) selected @endif value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">App Finances</label>
            <select class="form-control" name="app_finances" id="">
                <option @if($editUser->app_finances==1) selected @endif value="1">Yes</option>
                <option @if($editUser->app_finances==0) selected @endif value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">App Approvals</label>
            <select class="form-control" name="app_approvals" id="">
                <option @if($editUser->app_approvals==1) selected @endif value="1">Yes</option>
                <option @if($editUser->app_approvals==0) selected @endif value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">App Tasks</label>
            <select class="form-control" name="app_tasks" id="">
                <option @if($editUser->app_tasks==1) selected @endif value="1">Yes</option>
                <option @if($editUser->app_tasks==0) selected @endif value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">App Statistics</label>
            <select class="form-control" name="app_statistics" id="">
                <option @if($editUser->app_statistics==1) selected @endif value="1">Yes</option>
                <option @if($editUser->app_statistics==0) selected @endif value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">App Researches</label>
            <select class="form-control" name="app_researches" id="">
                <option @if($editUser->app_researches==1) selected @endif value="1">Yes</option>
                <option @if($editUser->app_researches==0) selected @endif value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">App Degination</label>
            <select class="form-control" name="app_degination" id="">
                <option @if($editUser->app_degination==1) selected @endif value="1">Yes</option>
                <option @if($editUser->app_degination==0) selected @endif value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">App Devontial</label>
            <select class="form-control" name="app_devontial" id="">
                <option @if($editUser->app_devontial==1) selected @endif value="1">Yes</option>
                <option @if($editUser->app_devontial==0) selected @endif value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">App Finances</label>
            <select class="form-control" name="app_finances" id="">
                <option @if($editUser->app_finances==1) selected @endif value="1">Yes</option>
                <option @if($editUser->app_finances==0) selected @endif value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">App Tip</label>
            <select class="form-control" name="app_tip" id="">
                <option @if($editUser->app_tip==1) selected @endif value="1">Yes</option>
                <option @if($editUser->app_tip==0) selected @endif value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">App Bible</label>
            <select class="form-control" name="app_bible" id="">
                <option @if($editUser->app_bible==1) selected @endif value="1">Yes</option>
                <option @if($editUser->app_bible==0) selected @endif value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">App El Church</label>
            <select class="form-control" name="app_el_church" id="">
                <option @if($editUser->app_el_church==1) selected @endif value="1">Yes</option>
                <option @if($editUser->app_el_church==0) selected @endif value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">App Space</label>
            <select class="form-control" name="app_space" id="">
                <option @if($editUser->app_space==1) selected @endif value="1">Yes</option>
                <option @if($editUser->app_space==0) selected @endif value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            {{ csrf_field() }}
            <input type="hidden" name="user_id" value="{{$editUser->user_id}}">
            <input type="submit" value="Update User" class="btn-btn-primary">
        </div>
    </div>
</form>
</div>
@endsection