
@extends('layouts.admin.master')
@section('title', 'Create Levels')

@section('css')
<style>
    .card-counter {
        box-shadow: 2px 2px 10px #DADADA;
        margin: 5px;
        padding: 20px 10px;
        background-color: #fff;
        height: 100px;
        border-radius: 5px;
        transition: .3s linear all;
    }

    .card-counter:hover {
        box-shadow: 4px 4px 20px #DADADA;
        transition: .3s linear all;
    }

    .card-counter.primary {
        background-color: #007bff;
        color: #FFF;
    }

    .card-counter.danger {
        background-color: #ef5350;
        color: #FFF;
    }

    .card-counter.success {
        background-color: #66bb6a;
        color: #FFF;
    }

    .card-counter.warning {
        background-color: #ffdc47;
        color: #FFF;
    }

    .card-counter.purple {
        background-color: #ac62e8;
        color: #FFF;
    }

    .card-counter.pink {
        background-color: #ff45b5;
        color: #FFF;
    }

    .primary {
        background-color: #007bff;
        color: #FFF;
        box-shadow: 2px 2px 10px #DADADA;
        margin: 5px;
        padding: 20px 10px;
        border-radius: 5px;
        transition: .3s linear all;
    }

    .danger {
        background-color: #ef5350;
        color: #FFF;
        box-shadow: 2px 2px 10px #DADADA;
        margin: 5px;
        padding: 20px 10px;
        border-radius: 5px;
        transition: .3s linear all;
    }

    .success {
        background-color: #66bb6a;
        color: #FFF;
        box-shadow: 2px 2px 10px #DADADA;
        margin: 5px;
        padding: 20px 10px;
        border-radius: 5px;
        transition: .3s linear all;
    }

    .warning {
        background-color: #ffdc47;
        color: #FFF;
        box-shadow: 2px 2px 10px #DADADA;
        margin: 5px;
        padding: 20px 10px;
        border-radius: 5px;
        transition: .3s linear all;
    }

    .purple {
        background-color: #ac62e8;
        color: #FFF;
        box-shadow: 2px 2px 10px #DADADA;
        margin: 5px;
        padding: 20px 10px;
        border-radius: 5px;
        transition: .3s linear all;
    }

    .pink {
        background-color: #ff45b5;
        color: #FFF;
        box-shadow: 2px 2px 10px #DADADA;
        margin: 5px;
        padding: 20px 10px;
        border-radius: 5px;
        transition: .3s linear all;
    }

    .card-counter i {
        font-size: 3em;
        opacity: 0.4;
    }

    .card-counter .count-numbers {
        position: absolute;
        right: 35px;
        top: 20px;
        font-size: 32px;
        display: block;
    }

    .card-counter .count-name {
        position: absolute;
        right: 35px;
        top: 65px;
        font-style: italic;
        text-transform: capitalize;
        opacity: 0.5;
        display: block;
        font-size: 16px;
    }
</style>
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Approvals')}}</li>
<li class="breadcrumb-item active">{{__('msg.Home')}} </li>

@endsection

@section('content')
<div class="profile-nav onhover-dropdown p-10 me-0 pull-right ">
    <div class="media profile-media">
      <div class="media-body">
        <span class="pl-10"><i class="icon-menu"></i></span>
      </div>
    </div>
    <ul class="profile-dropdown onhover-show-div p-10 " style="width: 150px; background-color:balck;  ">
      <li class="my-2">
          <a href="{{route('create.support')}}"><i class="fa fa-question-circle"></i><span> {{ __('msg.Help') }}</span></a>
        </li>
        <li>
            <a href="" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="fa fa-share-alt-square"></i></i><span> {{ __('msg.Share') }}</span></a>
        </li>

    </ul>
  </div>

  <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenter"  role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">@lang('msg.Share')</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
        </div>
        <div class="modal-body">
            <center>
                <div class="row">
                    <div class="col-md-4">
                    <a href=""><img src="{{asset('/images/play.png')}}" alt=""></a>
                    </div>
                    <div class="col-md-4">
                        <a href=""><img src="{{asset('/images/web.jpg')}}" alt=""></a>
                    </div>
                    <div class="col-md-4">
                        <a href=""><img src="{{asset('/images/mail.jpg')}}" alt=""></a>
                    </div>
                </div>
            </center>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" data-bs-original-title="" title="">Close</button>
        </div>
      </div>
    </div>
  </div>
<livewire:apps.approvals.home />
@endsection

@section('script')

@endsection
