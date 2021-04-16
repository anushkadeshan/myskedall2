@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-3"><section class="content-header">
        <h1 class="pull-left">{{__('msg.Reports')}} <span class="badge badge-warning"></span></h1>
        <h1 class="pull-right">
           
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3 mb-4 mb-4">
                        <a href="{{url('admin/reports/locations')}}">
                            <div class="content" style="background-color:paleturquoise; width: 100%;height:100px;display: flex;">
                                <p class="text-center" style="margin: auto; font-size:20px"><strong>
                                    Locations
                                </strong></p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="{{url('admin/reports/items')}}">
                            <div class="content" style="background-color:paleturquoise; width: 100%;height:100px;display: flex;">
                                <p class="text-center" style="margin: auto; font-size:20px"><strong>
                                    Items
                                </strong></p>
                            </div>
                        </a>
                        
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="{{url('admin/reports/functions')}}">
                            <div class="content" style="background-color:paleturquoise; width: 100%;height:100px;display: flex;">
                                <p class="text-center" style="margin: auto; font-size:20px"><strong>
                                    Functions
                                </strong></p>
                            </div>
                        </a>
                        
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="{{url('admin/reports/values')}}">
                            <div class="content" style="background-color:paleturquoise; width: 100%;height:100px;display: flex;">
                                <p class="text-center" style="margin: auto; font-size:20px"><strong>
                                    Values
                                </strong></p>
                            </div>
                        </a>
                        
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="{{url('admin/reports/requests')}}">
                            <div class="content" style="background-color:paleturquoise; width: 100%;height:100px;display: flex;">
                                <p class="text-center" style="margin: auto; font-size:20px"><strong>
                                    Requests
                                </strong></p>
                            </div>
                        </a>
                        
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="{{url('admin/reports/checklist')}}">
                            <div class="content" style="background-color:paleturquoise; width: 100%;height:100px;display: flex;">
                                <p class="text-center" style="margin: auto; font-size:20px"><strong>
                                    CheckList
                                </strong></p>
                            </div>
                        </a>
                        
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="{{url('admin/reports/audit')}}">
                            <div class="content" style="background-color:paleturquoise; width: 100%;height:100px;display: flex;">
                                <p class="text-center" style="margin: auto; font-size:20px"><strong>
                                    Audit
                                </strong></p>
                            </div>
                        </a>
                        
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="{{url('admin/reports/back-log')}}">
                            <div class="content" style="background-color:paleturquoise; width: 100%;height:100px;display: flex;">
                                <p class="text-center" style="margin: auto; font-size:20px"><strong>
                                    Backlog
                                </strong></p>
                            </div>
                        </a>
                        
                    </div>

                </div>
                <a href="{{url('home')}}"><button type="button" class="btn btn-primary"><i class="fa fa-backward"></i> {{__('msg.Back to Admin Panel')}}</button></a>
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div></div>
@endsection