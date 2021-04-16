<html lang="en" class="translated-ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PlanOz - Plans for your life</title>
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link href="{{asset('platform/objects/plugins/multiselect/bootstrap-multiselect.css')}}" rel="stylesheet">
    <link href="{{asset('platform/style.css')}}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" charset="UTF-8" href="https://translate.googleapis.com/translate_static/css/translateelement.css">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
</head>

<body style="background-image:none !important;">
    <div width="100%" style="margin:10px;">
        <img id="imLogo" src="" alt="" class="img-responsive" style="max-height:40px; margin:auto">
    </div>
    <!-- SLIDES --------------------------------------------------------------------------------------------------- -->

        <div class="row" style="color:#000000">
            <div id="cadastro" class="cadastro" style="z-index: 500">
                @if (session()->has('register.success')) 
                    <div class="alert alert-success alert-dismissible" role="alert">
                    <strong>{{__('msg.congragulations')}} !</strong> {{session('register.success')}}
                    </div>
                @endif
                
                <div class="cadTitulo" style="font-size:25px; margin-top:-10px;">{{__('msg.Login')}}  <span style="float: right">
                <a class="translation-links" href="{{ ROUTE('locale', 'en') }}" class="english" ><img style="max-height:18px;  position: relative; top:-3px; margin-right: 3px;margin-top:3px" src="{{asset('img/england.png')}}"></a>
				<a class="translation-links" href="{{ ROUTE('locale', 'pt') }}" class="portuguese" ><img style="max-height:18px; position: relative; top:-3px; margin-right: 10px;margin-top:3px" src="{{asset('img/brazil.png')}}"></a>
                </span></div>
                <form action="{{ route('login') }}" method="POST">
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <div class="form-group cadPrimeiroCampo">
                    <label style="font font-weight:normal; font-size: 12px"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.Your email')}} </font></font>
						@if ($errors->first('email'))
							<span style="color:red">{{$errors->first('email')}}</span>
						@elseif (Session::has('email_error'))
							<span style="color:red">{!! session('email_error') !!}</span>
						@endif
					</label>
                    <input type="text" name="email" value="{{old('email')}}" class="form-control"  placeholder={{__('Email')}}>
                </div>
                <div class="form-group" style="margin-top: -10px;">
                    <label  style="font font-weight:normal; font-size: 12px"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.Your password')}} </font></font>
						@if ($errors->first('password'))
							<span style="color:red">{{$errors->first('password')}}</span>
						@elseif (Session::has('password_error'))
							<span style="color:red">{!! session('password_error') !!}</span>
						@endif
					</label>
                    <input type="password" name="password" class="form-control" placeholder={{__('Password')}}>
                </div>
                <div style="z-index: 9999">    
                    {{--               
                    <table>
                        <tbody>
                            <tr style="cursor:pointer;">
                                <td width="20">
                                    <span id="checkeeeNot" style="display: block;" class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                    <span id="checkeee" style="display:none" class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                </td>
                                <td  style="padding-top:1px;color:white"><font onclick="abc()" style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.Remember password')}} </font></font>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    --}}
                    <div>
                        <table width="100%" style="font-size:13px; margin-top:15px;">
                            <tbody>
                                <tr>
                                <td><a style="color:#5bc0de;" href="{{url('/')}}"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.I am not registered')}} </font></font></a></td>
                                <td align="right"><a style="color:#5bc0de;" href="{{ROUTE('password.reset')}}"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.I forgot my password')}} </font></font></a></td>
                                </tr>
                            </tbody>
                        </table>
                        <button class="btn btn-info" type="submit" ><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.Log in')}} </font></font>
                        </button>
                        <div style="width:100%; margin-top:25px; font-size:13px; text-align:center; "><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.Read the')}} </font></font><a style="color:#5bc0de;" onclick="exibirPolitica()"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.privacy policy of')}} </font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> {{__('msg.this application')}}</font></font>
                        </div>
                    </div>
                </div>
                
                </form>
                 
            </div>
            
        </div>
    

 
<script src="{{asset('js/jquery-2.1.1.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>

<script>
    function exibirPolitica(){
        $('#UserAgreement').modal('show');
    }
    function abc() {
        if($('#checkeee').css('display') == 'block')
        {
            document.getElementById("checkeee").style.display = "none";
            document.getElementById("checkeeeNot").style.display = "block";
        }
        else{
            document.getElementById("checkeee").style.display = "block";
            document.getElementById("checkeeeNot").style.display = "none";
        }
        
    }
</script>
</body>

</html>