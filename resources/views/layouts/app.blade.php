<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PlanOz - Plans for your life</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 4.1.1 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/css/coreui.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@icon/coreui-icons-free@1.0.1-alpha.1/coreui-icons-free.css">

     <!-- PRO version // if you have PRO version licence than remove comment and use it. -->
    {{--<link rel="stylesheet" href="https://unpkg.com/@coreui/icons@1.0.0/css/brand.min.css">--}}
    {{--<link rel="stylesheet" href="https://unpkg.com/@coreui/icons@1.0.0/css/flag.min.css">--}}
     <!-- PRO version -->

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.3.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/semantic.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link href="{{asset('css/datetime-picker.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/clockpicker.min.css')}}">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <style>
        .bootstrap-select .bs-ok-default::after {
            width: 0.3em;
            height: 0.6em;
            border-width: 0 0.1em 0.1em 0;
            transform: rotate(45deg) translateY(0.5rem);
        }

        .btn.dropdown-toggle:focus {
            outline: none !important;
        }

    </style>
    <style>
        [x-cloak] {
            display: none;
        }

        [type="checkbox"] {
            box-sizing: border-box;
            padding: 0;
        }

        .form-checkbox,
        .form-radio {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
            display: inline-block;
            vertical-align: middle;
            background-origin: border-box;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            flex-shrink: 0;
            color: currentColor;
            background-color: #fff;
            border-color: #e2e8f0;
            border-width: 1px;
            height: 1.4em;
            width: 1.4em;
        }

        .form-checkbox {
            border-radius: 0.25rem;
        }

        .form-radio {
            border-radius: 50%;
        }

        .form-checkbox:checked {
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M5.707 7.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4a1 1 0 0 0-1.414-1.414L7 8.586 5.707 7.293z'/%3e%3c/svg%3e");
            border-color: transparent;
            background-color: currentColor;
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat;
        }

        .form-radio:checked {
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3ccircle cx='8' cy='8' r='3'/%3e%3c/svg%3e");
            border-color: transparent;
            background-color: currentColor;
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat;
        }

        .line {
            background: repeating-linear-gradient(to bottom,
                    #eee,
                    #eee 1px,
                    #fff 1px,
                    #fff 8%);
        }

        .tick {
            background: repeating-linear-gradient(to right,
                    #eee,
                    #eee 1px,
                    #fff 1px,
                    #fff 5%);
        }
    </style>
@stack('styles')
<livewire:styles>

</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand d-none d-sm-block d-md-block" style="padding-top: 15px; padding-left: 15px" href="{{url('/home')}}">
       PlanOz
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a style="margin-left:30px;padding-top: 15px; padding-left: 15px" class="navbar-brand d-none d-sm-block d-md-block"  href="#">{{ __('msg.User and Group Management') }}</a>
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown" style="margin-right: 10px">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{$activeGroup->name}}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                @if(!empty($userGroup))
                    @foreach($userGroup as $ugroup)
                    <a class="dropdown-item" href="{{url('change-active-group/'.$ugroup->id)}}"><i @if($activeGroup->id==$ugroup->id) class="fa fa-check" @endif aria-hidden="true"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> {{$ugroup->name}}</font></font></a>
                    @endforeach
                @endif
                <div class="dropdown-divider"></div>
                @if(!empty($groupData))
                <a class="dropdown-item" data-toggle="modal" data-target="#modalGrupoConectar">{{ __('msg.connect to a Group') }}</a>
                @endif
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" style="margin-right: 10px"  href="#" role="button"
               aria-haspopup="true" aria-expanded="false">
               Hi {{ Auth::user()->name }}
            </a>
        </li>
        <li class="nav-item">
            <a class="translation-links" href="{{ ROUTE('locale', 'en') }}" class="english" ><img style="max-height:18px;  position: relative; top:-3px; margin-right: 3px;margin-top:3px" src="{{asset('img/england.png')}}"></a>
			<a class="translation-links" href="{{ ROUTE('locale', 'pt') }}" class="portuguese" ><img style="max-height:18px; position: relative; top:-3px; margin-right: 10px;margin-top:3px" src="{{asset('img/brazil.png')}}"></a>
        </li>
        <li class="nav-item dropdown">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
        <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fa fa-th-large"></i>
        </a>
      </li>
    </ul>
</header>
<div class="modal fade" id="modalGrupoConectar" tabindex="-1" role="dialog" aria-labelledby="modalGrupoConectarTitulo" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:95%; max-width:500px;">
        <div class="modal-content">
            <div class="modal-header" style="color:#000000">
                <h4 class="modal-title" id="modalGrupoConectarTitulo" style="clear:both">{{__('msg.Connect to a group')}}
                    <br>
                    <br>
                <font style="font-weight: normal">
                {{__('msg.Click on one of the banners to request to join a group. Remember that admission depends on the approval of the group administrator.')}}</font>
                </h4>

            </div>
            <div class="modal-body">
                <table class="listaGrupos">
                    <tbody>
                        @foreach($groupData as $group)
                        <tr>
                            <td style="padding-bottom:10px;" onclick="SendGroupRequest({{$group->id}})">
                                <div style="position:absolute; color:#ffffff; font-size:20px; margin:10px; text-shadow: 2px 2px 2px #000000;">
                                    {{$group->name}}
                                </div>
                                <img style="width:100%;"  id="imGrupo4" src="{{asset('_dados/plataforma/grupos/'.$group->id.'/banner.jpg')}}">
                            </td>
                        </tr>
                        @endforeach
                        @if(count($groupData)==0)
                            {{__('msg.Sorry! There are no more groups')}}
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" style="width:90px;">{{__('msg.cancel')}}</button>
            </div>
        </div>
    </div>
</div>
<div class="app-body">
    @include('layouts.sidebar')
    <main class="main">
        @yield('content')
    </main>
</div>
<footer class="app-footer">

</footer>
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
</body>
<!-- jQuery 3.1.1 -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
<script src="{{asset('js/datetime-picker.js')}}" type="text/javascript"></script>
<script src="{{asset('js/clockpicker.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
<script>
    function app() {
        return {
            step: 1,
        }
    }
</script>
<script>
    var BaseUrl = '{{url("/")}}';
    var ApiUrl = '{{url('/api')}}';

    function SendGroupRequest(groupId){
        $.ajax({
            type: 'GET',
            url: ApiUrl+'/send-group-request/'+groupId,
            success: function(response) {
                location.reload();
            }
        });
    }
</script>
@if(session('message') && session('type'))
	<script>
		Alert('{{session('message')}}','{{session('type')}}');
	</script>
@endif
@stack('scripts')
<livewire:scripts>
</html>
