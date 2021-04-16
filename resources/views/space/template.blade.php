<html class="translated-ltr">

<head>
    <title>PlanOz - Plans for your life</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link href="{{asset('platform/objects/plugins/multiselect/bootstrap-multiselect.css')}}" rel="stylesheet">
    <link href="{{asset('platform/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/datetime-picker.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
        <script>
        var BaseUrl = '{{url("/api/")}}';
        var HomeUrl='{{url("/")}}';
        var csrf_token = "{{ csrf_token() }}";
    </script>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        .p-2 {
            padding: 20px;
        }

        .pr-2 {
            padding-right: 20px;
        }

        .box1 {
            background: #d70101;
            margin-top: 5px;
            width: 40px;
            height: 40px;
            text-align: center;
            vertical-align: middle;
            display: block;
            line-height: 40px;
            color: #fff;
        }

        .boxg {
            background-color: #00d788;
            width: 40px;
            margin-top: 5px;
            height: 40px;
            text-align: center;
            vertical-align: middle;
            display: block;
            line-height: 40px;
            color: #fff;
        }

        .boxy {
            background-color: #fec00e;
            width: 40px;
            margin-top: 5px;
            height: 40px;
            text-align: center;
            vertical-align: middle;
            display: block;
            line-height: 40px;
            color: #fff;
        }

        .sidepanel {
            width: 0;
            position: fixed;
            z-index: 1;
            height: 100vh;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidepanel a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 14px;
            color: #818181;
            display: block;
            transition: 0.3s;
            z-index: 9999;
        }

        .sidepanel a:hover {
            color: #f1f1f1;
        }

        .sidepanel .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
        }

        .openbtn {
            font-size: 20px;
            cursor: pointer;
            background-color: #111;
            color: white;
            padding: 10px 15px;
            border: none;
        }

        .openbtn:hover {
            background-color: #444;
        }

        .bg-blue {
            background: #34495c;
            position: absolute;
            width: 100%;
            top: 0;
            padding-top: 60px;
        }

        .pt-140 {
            padding-top: 140px;
        }

        .sidebar-menu > li {
            position: relative;
            margin: 0;
            padding: 0;
        }

        .sidebar-menu > li > a {
            padding: 12px 5px 12px 15px;
            display: block;
        }

        .skin-blue .sidebar-menu > li.active > a,
        .skin-blue .sidebar-menu > li.menu-open > a {
            color: #fff;
        }

        .skin-blue .sidebar-menu > li.menu-open > a {
            color: #fff;
            font-size: 14px;
        }

        .sidebar-menu li {
            list-style: none;
        }

        .text-white {
            color: #fff;
        }

        .sidebar-menu a {
            color: #fff;
        }

        .sidebar-menu {
            padding-left: 10px;
        }

        @media all and (max-width:900px) and (min-width:320px) {
            .left-sit {
                display: inline-flex;
                float: right;
            }
            .fl-left {
                float: left !important;
            }
            .i-pos i {
                display: none;
            }
        }

        .my-cs {
            position: relative;
            left: -25px;
            top: 2px;
        }

        .ml-10 {
            margin-left: 20px;
        }

        .bac-space {
            z-index: 9999999999;
            position: absolute;
            top: 18px;
            left: -25px;
            color: #fff;
        }

        .m-5 {
            margin: 20px;
        }

        .openbtn {
            background: none;
        }

        .dropdown-menu {
            position: relative;
            top: 100%;
            left: 0;
            z-index: 1000;
            display: none;
            float: none;
            min-width: 160px;
            padding: 5px 0;
            margin: 2px 0 0;
            font-size: 14px;
            text-align: left;
            list-style: none;
            border: 1px solid rgba(0, 0, 0, .15);
            background: none;
        }

        .dropdown-menu li a {
            color: #fff;
        }
		iframe{
			display:none;
		}
		body{
			top:0px !important;
		}
    </style>
</head>

<body>

    <div class="workspace sombra">
		@include('space/layout/toplayout')
        @yield('content')

    </div>
    <div id="dvAlerta" class="bordaRedonda" style="z-index: 99999; width: 86%; margin: auto; padding: 0px; position: absolute; background-color: rgb(255, 255, 255); box-shadow: rgb(102, 102, 102) 2px 2px 10px 1px; top: 50%; left: 7%; display: none;">

    </div>
    @include('space/layout/js')
	<!-- Code provided by Google -->
	<div style="display:none" id="google_translate_element"></div>
	<script type="text/javascript">
	  function googleTranslateElementInit() {
		var lang = new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
	  }
	</script>
	<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>

	<!-- Flag click handler -->
	<script type="text/javascript">
		$('.change-language').click(function() {
		  //var lang = $(this).data('lang');
		  var lang = $(".goog-te-menu-value span:first").text();
		  if(lang=="Portuguese"){
			lang="English";
		  }else{
			lang="Portuguese";
		  }
		  $(this).attr('data-lang',lang);
		  var $frame = $('.goog-te-menu-frame:first');
		  if (!$frame.size()) {
			alert("Error: Could not find Google translate frame.");
			return false;
		  }
		  $frame.contents().find('.goog-te-menu2-item span.text:contains('+lang+')').get(0).click();
		  $frame.contents().find('.goog-te-menu2-item span.text:contains('+lang+')').get(0).click();
		  return false;
		});
	</script>
    <script>
        function openNav() {
            document.getElementById("mySidepanel").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
        }
    </script>
	@if(session('message') && session('type'))
		<script>
			Alert('{{session('message')}}','{{session('type')}}');
		</script>
	@endif
</body>

</html>
