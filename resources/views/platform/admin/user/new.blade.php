@extends('platform/template')
@section('content')
<div class="row" style="margin:5">
<form action="{{ROUTE('add.user')}}" method="POST">
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email" class="form-control" id="">
        </div>
        <div class="form-group">
            <label for="">Password</label>
            <input type="password" name="password" class="form-control" id="">
        </div>
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" name="name" class="form-control" id="">
        </div>
        <div class="form-group">
            <label for="">Nick Name</label>
            <input type="text" name="nickname" class="form-control" id="">
        </div>
        <div class="form-group">
            <label for="">Sex</label>
            <select class="form-control" name="sex" id="">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Birth Date</label>
            <input type="date" name="birth" class="form-control" id="">
        </div>
        <div class="form-group">
            <label for="">Phone</label>
            <input type="text" name="phone" class="form-control" id="">
        </div>
        <div class="form-group">
            <label for="">Address</label>
            <input type="text" name="address" class="form-control" id="">
        </div>
        <div class="form-group">
            <label for="">Zip Code</label>
            <input type="text" name="zipcode" class="form-control" id="">
        </div>
        <div class="form-group">
            <label for="">Neighborhood</label>
            <input type="text" name="neighborhood" class="form-control" id="">
        </div>
        <div class="form-group">
            <label for="">City</label>
            <input type="text" name="city" class="form-control" id="">
        </div>
        <div class="form-group">
            <label for="">Uf</label>
            <input type="text" name="uf" class="form-control" id="">
        </div>
        <div class="form-group">
            <label for="">Profession</label>
            <input type="text" name="profession" class="form-control" id="">
        </div>
        <div class="form-group">
            <label for="">RG</label>
            <input type="text" name="rg" class="form-control" id="">
        </div>
        <div class="form-group">
            <label for="">CPF</label>
            <input type="text" name="cpf" class="form-control" id="">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Have Warning</label>
            <select class="form-control" name="have_warning" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Have Group Warning</label>
            <select class="form-control" name="have_group_warning" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">App Messages</label>
            <select class="form-control" name="app_messages" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">App Finances</label>
            <select class="form-control" name="app_finances" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">App Approvals</label>
            <select class="form-control" name="app_approvals" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">App Tasks</label>
            <select class="form-control" name="app_tasks" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">App Statistics</label>
            <select class="form-control" name="app_statistics" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">App Researches</label>
            <select class="form-control" name="app_researches" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">App Degination</label>
            <select class="form-control" name="app_degination" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">App Devontial</label>
            <select class="form-control" name="app_devontial" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">App Finances</label>
            <select class="form-control" name="app_finances" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">App Tip</label>
            <select class="form-control" name="app_tip" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">App Bible</label>
            <select class="form-control" name="app_bible" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">App El Church</label>
            <select class="form-control" name="app_el_church" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">App Space</label>
            <select class="form-control" name="app_space" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            {{ csrf_field() }}
            <input type="submit" value="Create User" class="btn-btn-success">
        </div>
    </div>
</form>
</div>
@endsection