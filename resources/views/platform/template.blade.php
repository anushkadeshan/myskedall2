<html class="translated-ltr">

<head>
	<title>PlanOz - Plans for your life</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link href="{{asset('platform/objects/plugins/multiselect/bootstrap-multiselect.css')}}" rel="stylesheet">
    <link href="{{asset('platform/style.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
	<link href="{{asset('css/datetime-picker.css')}}" rel="stylesheet" type="text/css" />
	<script>
		var BaseUrl='{{url("/api/")}}';
    var HomeUrl='{{url("")}}';
		var csrf_token="{{ csrf_token() }}";
	</script>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<style>
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
		@include('platform/layout/top-layout')
        <style type="text/css">
            .input-group-addon {
                font-size: 11px;
                width: 65px;
            }
        </style>
        @include('platform/layout/model')
        @yield('content')
    </div>
    <div id="dvAlerta" class="bordaRedonda" style="z-index: 99999; width: 86%; margin: auto; padding: 0px; position: absolute; background-color: rgb(255, 255, 255); box-shadow: rgb(102, 102, 102) 2px 2px 10px 1px; top: 50%; left: 7%; display: none;">

    </div>
	@include('platform/layout/js')


<!-- Code provided by Google -->
<div style="display:none" id="google_translate_element"></div>
<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
  }
</script>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>
<!-- Flag click handler -->
<script type="text/javascript">
    $('.translation-links').click(function() {
      var lang = $(this).data('lang');
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

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
@if(session('message') && session('type'))
	<script>
		Alert('{{session('message')}}','{{session('type')}}');
	</script>
@endif
</body>
</html>
