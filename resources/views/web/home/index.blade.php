@extends('web/template')
@section('content')
<section class="slider" id="home">
        <div class="container-fluid">
            <div class="row">
                <div id="carouselHacked" class="carousel slide carousel-fade" data-ride="carousel">
                    <div class="header-backup"></div>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item">
                            <img src="img/slide1.jpg" alt="">
                            <div class="carousel-caption">
                                <h1><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.Life Plan')}} </font></font></h1>
                                <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.build your life, transform your thinking')}} </font></font>
                                </p>
                                <!-- <button>conhecer</button> -->
                            </div>
                        </div>
                        <div class="item active">
                            <img src="img/slide2.jpg" alt="">
                            <div class="carousel-caption">
                                <h1><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.Differences')}} </font></font></h1>
                                <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.learn to deal with differences')}} </font></font>
                                </p>
                                <!-- <button>conhecer</button> -->
                            </div>
                        </div>
                        <div class="item">
                            <img src="img/slide3.jpg" alt="">
                            <div class="carousel-caption">
                                <h1><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.Educating Children')}} </font></font></h1>
                                <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.your heritage, your gift')}} </font></font>
                                </p>
                                <!-- <button>conhecer</button> -->
                            </div>
                        </div>
                        <div class="item">
                            <img src="img/slide4.jpg" alt="">
                            <div class="carousel-caption">
                                <h1><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.Business')}} </font></font></h1>
                                <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.build your financial life')}} </font></font>
                                </p>
                                <!-- <button>conhecer</button> -->
                            </div>
                        </div>
                    </div>
                    <!-- Controls -->
                    <a class="left carousel-control" href="#carouselHacked" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.previous')}} </font></font></span>
                    </a>
                    <a class="right carousel-control" href="#carouselHacked" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.next')}} Next</font></font></span>
                    </a>
                </div>
            </div>
        </div>
    </section>
	<form action="{{ route('register') }}" method="POST">
		<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
		<div id="cadastro" class="cadastro hidden-xs">
			<div style="font-size:23px; margin-top:-10px"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__("msg.Join our platform now, it's free!")}} </font></font>
			</div>
			<div class="form-group" style="margin-top: 10px;">
				<label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.Your name')}}*</font></font>
					<strong style="color:red">{{$errors->first('name')}}</strong>
				</label>
				<input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="@lang('msg.name')" maxlength="100">
			</div>
			<div class="form-group" style="margin-top:-10px">
				<label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.Your email')}}*</font></font>
					<strong style="color:red">{{$errors->first('email')}}</strong>
				</label>
				<input type="text" class="form-control" name="email" value="{{old('email')}}" placeholder="@lang('msg.Email')" maxlength="255">
			</div>
			<div class="form-group" style="margin-top:-10px">
				<label ><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.Choose a password')}}*</font></font>
					<strong style="color:red">{{$errors->first('password')}}</strong>
				</label>
				<input type="password" class="form-control" name="password" value="{{old('password')}}" placeholder="@lang('msg.Password')" >
            </div>
            <div class="form-group" style="margin-top:-10px">
				<label ><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.Confirm password')}}*</font></font>
					<strong style="color:red">{{$errors->first('password')}}</strong>
				</label>
				<input type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="@lang('msg.Password Confirm')" >
			</div>
			<div class="form-group" style="margin-top:-10px">
				<label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.Your phone')}}*</font></font>
					<strong style="color:red">{{$errors->first('phone')}}</strong>
				</label>
				<input type="text" class="form-control" maxlength="15" onkeydown="phoneMaskBrazil()" name="phone" value="{{old('phone')}}"  placeholder="@lang('msg.telephone')" maxlength="50">
			</div>
			<button class="btn btn-info" type="submit" style="margin-top:0px; width:100px"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.Register')}} </font></font>
			</button>
			<div id="dvCadastro1" style="font-size:18px; margin-top:10px;"></div>
			<a href="{{url('login')}}" style="margin:auto; margin-top:10px; font-size:17px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__("msg.I'm already registered")}} </font></font></a>
		</div>
	</form>
	
@endsection()

<script>
    function phoneMaskBrazil() {
  var key = window.event.key;
  var element = window.event.target;
  var isAllowed = /\d|Backspace|Tab/;
  if(!isAllowed.test(key)) window.event.preventDefault();
  
  var inputValue = element.value;
  inputValue = inputValue.replace(/\D/g,'');
  inputValue = inputValue.replace(/(^\d{2})(\d)/,'($1) $2');
  inputValue = inputValue.replace(/(\d{4,5})(\d{4}$)/,'$1-$2');
  
  element.value = inputValue;
}
</script>