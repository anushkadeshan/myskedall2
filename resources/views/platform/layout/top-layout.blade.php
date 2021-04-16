
    </style>
	<div id="dvMenu" style="width:100%; ">
		<table width="100%" class="painel">
			<tbody>
				<tr>
					<td>
						<div>
							<div class="banner">
								<img id="imBanner" src="{{asset('_dados/plataforma/grupos/'.$activeGroup->id.'/banner.jpg')}}">
								<img id="imLogo" class="sombraImagem" style="position:absolute; width:30%; left:50%; top:50%;" src="{{asset('_dados/plataforma/grupos/'.$activeGroup->id.'/logo.png')}}">
                            </div>
							<div class="quadroMenu" style="position:absolute;" >
                            </div>
							@php
								session(['back_link' =>  url()->previous() ]);
							@endphp
							{{--
                            @if (!\Request::is('home'))
                            <div class="displayMenu" style="position:absolute; text-align:left; padding-left:2px; padding-top:3px; padding-bottom:3px; width:11%; z-index:998;background-color:black;top:5px">
                                @if(Request::url() === session('back_link'))
									<a href="{{url('/home')}}" style="cursor: pointer "><span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span>
									    Space
									</a>
								@else
									<a href="{{url(session('back_link'))}}" style="cursor: pointer "><span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span>
									    Space
									</a>
                                @endif
								
                            </div>
							@endif
							--}}
							@if (!\Request::is('home'))
                            <div class="displayMenu" style="position:absolute; text-align:left; padding-left:2px; padding-top:3px; padding-bottom:3px; width:11%; z-index:998;background-color:black;top:5px">
                                @if(Request::url() === session('back_link'))
									<a href="{{url('/home')}}" style="cursor: pointer "><span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span>
									    Space
									</a>
								@else
									<a href="{{url('/home')}}" style="cursor: pointer "><span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span>
									    Space
									</a>
                                @endif
								
                            </div>
							@endif
                            <div class="displayMenu"
                              @if(!\Request::is('home'))
                                style="position:absolute; text-align:left; padding-left: 105px ; padding-top:2px;
                                width:80%; z-index:997;"
                              @else
                                style="position:absolute; text-align:left; padding-left: 2px ; padding-top:2px;
                                width:80%; z-index:997;"
                              @endif >
								<div class="dropdown" style="cursor: pointer ">
									<a class="dropdown-toggle" type="button" id="dropdownMenuGrupo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$activeGroup->name}}</font></font></a>
									<i id="iIndicador" class="fa fa-hand-o-left" aria-hidden="true" style="display: none;"></i>
									<ul class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuGrupo">
										<li class="dropdown-header" style="font-size:12px"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ __('msg.GROUPS') }}</font></font>
										</li>
                                        @if(!empty($userGroup))
											@foreach($userGroup as $ugroup)
											<li><a href="{{url('change-active-group/'.$ugroup->id)}}"><span @if($activeGroup->id==$ugroup->id) class="glyphicon glyphicon-ok" @endif aria-hidden="true"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">&nbsp;{{$ugroup->name}}</font></font></a></li>
											@endforeach
                                        @endif

										@if(!empty($groupData))
										<li role="separator" class="divider"></li>
										<li><a data-toggle="modal" data-target="#modalGrupoConectar"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ __('msg.connect to a Group') }}</font></font></a></li>
										@endif
									</ul>
								</div>
							</div>
							<div class="displayMenu" style="position:absolute; text-align:right; padding-right:10px; padding-top:2px; z-index:996;">
                                <a class="translation-links" href="{{ ROUTE('locale', 'en') }}" class="english" ><img style="max-height:18px;  position: relative; top:-3px; margin-right: 3px;margin-top:3px" src="{{asset('img/england.png')}}"></a>
								<a class="translation-links" href="{{ ROUTE('locale', 'pt') }}" class="portuguese" ><img style="max-height:18px; position: relative; top:-3px; margin-right: 10px;margin-top:3px" src="{{asset('img/brazil.png')}}"></a>
                               <!-- <a class="translation-links" href="javascript:void(0)" class="english" data-lang="English"><img style="max-height:18px;  position: relative; top:-3px; margin-right: 3px;margin-top:3px" src="{{asset('img/england.png')}}"></a>
								<a class="translation-links" href="javascript:void(0)" class="portuguese" data-lang="Portuguese"><img style="max-height:18px; position: relative; top:-3px; margin-right: 10px;margin-top:3px" src="{{asset('img/brazil.png')}}"></a> -->
								<div style="float: right"><i class="fa fa-bars" onclick="beep(); mudarMenuLateral()" style="cursor: pointer;"></i></div>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>

	<div id="idMenuLateral" class="menuLateral" style="overflow-y:auto;">
		<div class="menuLateralUser">
			<div style="height:30px;">&nbsp;</div>
			<table>
				<tbody>
					<tr>
						<td style="padding-top:5px;">
							@php
								$imageurl=asset('/_dados/plataforma/usuarios/0.jpg');
								if(file_exists(public_path().('/_dados/plataforma/usuarios')."/".session('user_id').".jpg")){
									$imageurl=asset('/_dados/plataforma/usuarios/'.session('user_id').'.jpg');
								}
							@endphp
							<a data-toggle="modal" data-target="#modalFoto"><img src="{{$imageurl}}" class="img-rounded" width="45"></a>
						</td>
					</tr>
					<tr>
						<td style="padding-top:10px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ __('msg.hello') }}</font></font>
						</td>
					</tr>
					<tr>
						<td style="padding-top:2px; font-size:16px"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$user->name}}</font></font>
						</td>
					</tr>
					<tr>
						<td style="padding-top:5px;"><a data-toggle="modal" data-target="#modalSenha" style="font-size:12px; color:#cccccc; "><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ __('msg.change Password') }}</font></font></a></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="menuLateralOption"><a data-toggle="modal" data-target="#modalUsuarioEdit"><i class="fa fa-user-circle" aria-hidden="true"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ __('msg.my Registration') }}</font></font></a></div>
		<hr>
		<div class="menuLateralOption"><a data-toggle="modal" data-target="#modalGrupoConectar"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ __('msg.connect to a Group') }}</font></font></a></div>
		<hr>
		<div><a data-toggle="modal" data-target="#modalAjuda"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ __('msg.help & Contact') }}</font></font></a></div>
		<div><a data-toggle="modal" data-target="#modalCompartilhar"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ __('msg.share App') }}</font></font></a></div>
		<hr>
		<div class="menuLateralOption">
			<a class="dropdown-item" href="{{ route('logout') }}"
				onclick="event.preventDefault();
								document.getElementById('logout-form').submit();">
				<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ __('msg.logout') }}</font>
			</a>
			<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
				@csrf
			</form>
			
		</div>
	</div>
