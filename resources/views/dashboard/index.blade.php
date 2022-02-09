@extends('layouts.admin.master')
@section('title', 'MySkedall - Dashboard')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Approvals')}}</li>
<li class="breadcrumb-item active">{{__('msg.Levels')}}</li>
@endsection

@section('content')
<div style="padding: 20px;">
    <div class="file-content">
        <div class="card">
            <div class="card-body file-manager">
                <ul class="files">
                    @foreach($data as $row)
                    <a href="{{url('app/'.$row->redirect_link.'/'.$row->app_id)}}">
                        <li class="file-box m-1">
                            <div class="file-top"> 
                                <img src="{{asset($row->image)}}" width="50%">
                            </div>
                            <div class="file-bottom">
                                <h6 class="text-center">{{$row->title}}</h6>
                                <p class="mb-1">{{$row->description}}</p>
                            </div>
                        </li>
                    </a>
                    @endforeach
                    @can('Activate Apps')
                    <a href="{{url('apps')}}">
                        <li class="file-box m-1">
                            <div class="file-top"> 
                                <i class="fas fa-plus-circle txt-danger"></i>
                            </div>
                            <div class="file-bottom">
                                <h6 class="text-center">Add New</h6>
                                <p class="mb-1 text-center">@lang('msg.Request to join an another app')</p>
                            </div>
                        </li>
                    </a>
                    @endcan
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection