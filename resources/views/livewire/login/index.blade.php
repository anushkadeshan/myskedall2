<div>
     <!-- login page start-->
     <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div>
                        <div></div>
                        <div class="login-main">
                            @if (session()->has('register.success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <strong>{{__('msg.congragulations')}} !</strong> {{session('register.success')}}
                            </div>
                            @endif
                            <form class="theme-form" action="{{ route('login') }}" method="POST">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                <span class="text-right" style="float:right">

                                    <a class="translation-links" href="{{ ROUTE('locale', 'en') }}" class="english" ><img style="max-height:18px;  position: relative; top:-3px; margin-right: 3px;margin-top:3px" src="{{asset('img/england.png')}}"></a>
                                    <a class="translation-links" href="{{ ROUTE('locale', 'pt') }}" class="portuguese" ><img style="max-height:18px; position: relative; top:-3px; margin-right: 10px;margin-top:3px" src="{{asset('img/brazil.png')}}"></a>
                                </span>
                                <h4>{{__('msg.Sign in to account')}}
                                </h4>
                                <div class="form-group">
                                    <label class="col-form-label">{{__('msg.Your email')}}</label>
                                    <input class="form-control" type="email" value="{{old('email')}}" name="email" required="" placeholder="Test@gmail.com">
                                    @if ($errors->first('email'))
                                        <span style="color:red">{{$errors->first('email')}}</span>
                                    @elseif (Session::has('email_error'))
                                        <span style="color:red">{!! session('email_error') !!}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">{{__('msg.Your password')}} </label>
                                    <div class="form-input position-relative">
                                        <input class="form-control" type="password" name="password" required=""
                                            placeholder="*********">
                                    </div>
                                    @if ($errors->first('password'))
                                        <span style="color:red">{{$errors->first('password')}}</span>
                                    @elseif (Session::has('password_error'))
                                        <span style="color:red">{!! session('password_error') !!}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-0">
                                    <div class="checkbox p-0">
                                        <input id="checkbox1" type="checkbox">
                                        <label class="text-muted" for="checkbox1">{{__('msg.Remember password')}}</label>
                                    </div><a class="link" href="{{ROUTE('password.reset')}}">{{__('msg.I forgot my password')}}</a>
                                    <div class="text-end mt-3">
                                        <button class="btn btn-primary btn-block w-100" type="submit">{{__('msg.Log in')}}</button>
                                    </div>
                                </div>
                                </form>
                                <h6 class="text-muted mt-4 or">{{__('msg.Or Sign in with')}}</h6>
                                <div class="social mt-4">
                                    <div class="btn-showcase">
                                        <a class="btn btn-light"
                                            href="http://space.test/auth/google" target="_blank"><i
                                                class="txt-linkedin" data-feather="cloud-rain"></i> Google </a>
                                </div>
                                <p class="mt-4 mb-0 text-center">{{__('msg.I am not registered')}}<a class="ms-2"
                                        href="{{url('/')}}">{{__('msg.Create Account')}}</a></p>
                                        <div style="width:100%; margin-top:25px; font-size:13px; text-align:center; "><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.Read the')}} </font></font><a style="color:#5bc0de;" onclick="exibirPolitica()"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.privacy policy of')}} </font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> {{__('msg.this application')}}</font></font>
                                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
</div>
