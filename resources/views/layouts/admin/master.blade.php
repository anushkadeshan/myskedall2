<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{asset('images/favicon-16x16.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('images/favicon-16x16.png')}}" type="image/x-icon">
    <title>PlanOz - Plans for your life</title>
    <!-- Google font-->

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
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link href="{{asset('css/datetime-picker.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/clockpicker.min.css')}}">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        [x-cloak] {
            display: none;
        }
    </style>
    @include('layouts.admin.css')
    @yield('style')
    @livewireStyles
  </head>
  <body @if(Route::current()->getName() == 'home') onload="startTime()" @endif>
    @if(Route::current()->getName() == 'home')
      <div class="loader-wrapper">
        <div class="loader-index"><span></span></div>
        <svg>
          <defs></defs>
          <filter id="goo">
            <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
            <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
          </filter>
        </svg>
      </div>
     @endif
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      @include('layouts.admin.header')
      <!-- Page Header Ends  -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        @include('layouts.admin.sidebar')
        <!-- Page Sidebar Ends-->
        <div class="page-body">

          <!-- Container-fluid starts-->
          @yield('content')
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->


      </div>
    </div>
    <!-- latest jquery-->
    @include('layouts.admin.script')
    @livewireScripts
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
    <!-- Plugin used-->
    @stack('js')

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
    <script type="text/javascript">
      if ($(".page-wrapper").hasClass("horizontal-wrapper")) {
            $(".according-menu.other" ).css( "display", "none" );
            $(".sidebar-submenu" ).css( "display", "block" );
      }
    </script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>

  </body>
</html>
