<nav class="navbar navbar-inverse" role="navigation p-2">
	<ul class="nav navbar-nav fl-left">
	 	<!--href="{{url('home')}}"-->
		<li><a @if(\Request::is('app/space/12')) href="{{ url('home') }}" @else href="{{ url('app/space/12') }}"  @endif><span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span>  Space</a> </li>
		<!-- <li><a onclick="window.history.go(-1);"><span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span>  Space</a> </li> -->
		
		<li class="dropdown" style="margin-left: -35px;">
			<a class="nav navbar-nav" style="cursor: pointer ">
				<li class="dropdown-toggle" type="button" id="dropdownMenuGrupo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$activeGroup->name}}</font></font></li>
				<i id="iIndicador" class="fa fa-hand-o-left" aria-hidden="true" style="display: none;"></i>
				<ul class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuGrupo">
					<li class="dropdown-header" style="font-size:12px"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ __('msg.GROUPS') }}</font></font>
					</li>
					@if(!empty($userGroup))
						@foreach($userGroup as $ugroup)
						<li><a href="{{url('change-active-group/'.$ugroup->id)}}"><span @if($activeGroup->id==$ugroup->id) class="glyphicon glyphicon-ok" @endif aria-hidden="true"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> {{$ugroup->name}}</font></font></a></li>
						@endforeach
					@endif

					@if(!empty($groupData))
					<li role="separator" class="divider"></li>
					<li><a style="cursor: pointer" data-toggle="modal" data-target="#modalGrupoConectar"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ __('msg.connect to a Group') }}</font></font></a></li>
					@endif
				</ul>
			</a>
		</li>
	</ul>

	<ul class="nav navbar-nav left-sit navbar-right pr-2">
        <li> <a class="translation-links" href="{{ ROUTE('locale', 'en') }}" class="english" ><img style="max-height:18px;" src="{{asset('img/england.png')}}"></a></li>
        <li><a class="translation-links" href="{{ ROUTE('locale', 'pt') }}" class="portuguese" ><img style="max-height:18px; " src="{{asset('img/brazil.png')}}"></a></li>
		<li> <a  data-toggle="modal" data-target="#ReuseRequestConfirm"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </a> </li>
		<li>
			<button class="openbtn" onclick="openNav()"> <i class="fa fa-bars"></i> </button>
		</li>
		<li>
			<a href="{{url('app/space/12')}}"> <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></a>
		</li>
	</ul>

</nav>

<div id="mySidepanel" class="sidepanel">
	<a class="bac-space ml-2" href="{{url('home')}}"><span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span>  Space</a>
	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
	<div class="bg-blue user-panel ">
		<div class="text-center image">
		@php
			$imageurl=asset('/_dados/plataforma/usuarios/0.jpg');
			if(file_exists(public_path().('/_dados/plataforma/usuarios')."/".session('user_id').".jpg")){
				$imageurl=asset('/_dados/plataforma/usuarios/'.session('user_id').'.jpg');
			}
		@endphp
		<img src="{{$imageurl}}" data-toggle="modal" data-target="#modalFoto" class="img-rounded" width="45">
		</div>
		<div class="info">
			<p class="text-center text-white">{{ __('msg.hello') }}</p>
			<p class="text-center text-white">{{request()->user->name}}</p>
		<a href="{{url('/registraion')}}"><p class="text-center text-white">{{ __('msg.Change Registration') }}</p></a>

		</div>
	</div>

	<ul class="sidebar-menu tree pt-140" data-widget="tree">
		<li class="treeview menu-open">
			<a href="{{url('space/new-request')}}"> <i class="fa fa-plus"></i> <span>  {{ __('msg.New Requests') }}</span> </a>
		</li>

		<!--li class="treeview menu-open">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-bars"></i> <span>  {{ __('msg.Requests Created') }}</span> </a>
			<ul class="dropdown-menu">
				<li class="treeview menu-open">
					<a href="{{url('space/approved-request')}}"> <img src="{{asset('img/smiling-green.png')}}" style="width: 20px;"> <span> {{ __('msg.Approved Requests') }}</span> </a>
				</li>

				<li class="treeview menu-open">
					<a href="{{url('space/rejected-request')}}"> <img src="{{asset('img/confused.png')}}" style="width: 20px;"> <span> {{ __('msg.Rejected Requests') }}</span> </a>
				</li>

				<li class="treeview menu-open">
					<a href="{{url('space/repproved-request')}}"><img src="{{asset('img/sad.png')}}" style="width: 20px;"> <span> {{ __('msg.Repproved Requests') }}</span> </a>
				</li>
			</ul>
		</li-->
		<li class="treeview menu-open">
			<a href="{{url('space/search-space-requests')}}"> <i class="fa fa-search"></i> <span> {{ __('msg.Search Requests') }}</span> </a>
		</li>
		<li class="treeview menu-open">
			<a href="{{url('app/space/12')}}"><i class="fa fa-bars"></i> <span> {{ __('msg.Requests Created') }}</span> </a>
		</li>
		<li class="treeview menu-open">
			<a href="{{url('space/approved-request')}}"> <img src="{{asset('img/smiling-green.png')}}" style="width: 20px;"> <span> {{ __('msg.Approved Requests') }}</span> </a>
		</li>

		<li class="treeview menu-open">
			<a href="{{url('space/rejected-request')}}"> <img src="{{asset('img/confused.png')}}" style="width: 20px;"> <span> {{ __('msg.Rejected Requests') }}</span> </a>
		</li>

		<li class="treeview menu-open">
			<a href="{{url('space/repproved-request')}}"><img src="{{asset('img/sad.png')}}" style="width: 20px;"> <span> {{ __('msg.Repproved Requests') }}</span> </a>
		</li>
		

		<li class="treeview menu-open">
			<a data-toggle="modal" data-target="#modalAjuda"> <i class="fa fa-question-circle" aria-hidden="true"></i>
				<span> {{ __('msg.Help and Contact') }}</span> </a>
		</li>
		<li class="treeview menu-open">
			<a data-toggle="modal" data-target="#modalCompartilhar" <i class="fa fa-share"></i> <span> {{ __('msg.Share APP') }}</span> </a>
		</li>
		<li class="treeview menu-open">
			<a href="{{url('/home')}}"> <i class="fa fa-sign-out" aria-hidden="true"></i>
				<span> {{ __('msg.exit') }}</span> </a>
		</li>

	</ul>

</div>
<div class="modal fade" id="modalFoto" tabindex="-1" role="dialog">
	<div class="modal-dialog" style="width:600px">
		<div class="modal-content">
			<form action="" enctype="multipart/form-data" id="ProfilePhotoForm" name="ProfilePhotoForm">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title">{{ __('msg.Change Photo') }}</h4>
				</div>
				<div class="modal-body">
					<input id="txFotoFile" name="txFotoFile" type="file" class="filestyle" data-buttontext="&nbsp;Selecionar&nbsp;" data-buttonname="btn-info" style="width: 570px">
				</div>
				<div class="modal-footer">
					<table width="100%">
						<tbody>
							<tr>
								<td>
									<button type="button" class="btn btn-primary" onclick="PhotoUpload()" style="width: 100px">{{ __('msg.upload') }}</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">{{ __('msg.cancel') }}</button>
								</td>
								<td align="right">
									<a href="{{url('delete-profile-photo')}}" class="btn btn-danger" style="width: 100px">{{ __('msg.Delete Photo') }}</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="modalCompartilhar" tabindex="-1" role="dialog" aria-labelledby="modalCompartilharTitulo" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width:95%; max-width:600px;">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalCompartilharTitulo">{{ __('msg.To share') }}</h5>
			</div>
			<div class="modal-body" style="text-align:center;">
				<a onclick="sharePlay()"><img src="{{asset('platform/images/logo_google_play.png')}}" width="300"></a>
				<br>
				<a onclick="shareSite()"><img src="{{asset('platform/images/logo_site.png')}}" width="300"></a>
				<br>
				<a onclick="shareEmail()"><img src="{{asset('platform/images/logo_email.png')}}" width="300"></a>
				<br>
				<a data-dismiss="modal" class="btn btn-default" style="width:90px; margin:20px;">{{ __('msg.Go Out') }}

				</a>
			</div>
		</div>
	</div>
	<a href="" class="btn btn-default" style="width:90px; margin:20px;">
	</a>
</div>
<div class="modal fade" id="modalPlay" style="z-index:9999">
	<div class="modal-dialog" role="document" style="width:95%; max-width:500px;">
		<div class="modal-content">
			<div class="modal-body" style="text-align:center">
				<div style="font-size:20px;">{{ __('msg.To Share Google Play Store') }}</div>
				<img src="{{asset('platform/images/share_google_play.png')}}" width="300">
				<br>
				<button type="button" class="btn btn-default" data-dismiss="modal" style="width:90px;">{{ __('msg.Go Out') }}</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalSite" style="z-index:9999">
	<div class="modal-dialog" role="document" style="width:95%; max-width:500px;">
		<div class="modal-content">
			<div class="modal-body" style="text-align:center">
				<div style="font-size:20px;">{{ __('msg.To Share Website') }}</div>
				<img src="{{asset('platform/images/share_site.png')}}" width="300">
				<br>
				<button type="button" class="btn btn-default" data-dismiss="modal" style="width:90px;">{{ __('msg.Go Out') }}</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalEmail" style="z-index:9999">
	<div class="modal-dialog" role="document" style="width:95%; max-width:500px;">
		<div class="modal-content">
			<div class="modal-body" style="text-align:left">
				<div style="font-size:20px;">{{ __('msg.To Share Email') }}</div>
				<div class="input-group" style="margin-top:15px; width:100%;">
					<font style="color:#999999">{{ __('msg.Enter Your Email') }}</font>
					<br>
					<input type="text" id="share-by-email" value="" maxlength="255" class="form-control">
				</div>
				<br>
				<button type="button" class="btn btn-success" onclick="ShareLinkOnEmail()" style="width:90px;">{{ __('msg.submit') }}</button>
				<button type="button" class="btn btn-default" data-dismiss="modal" style="width:90px; margin-left:10px;">{{ ('msg.cancel') }}</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalAjuda" tabindex="-1" role="dialog" aria-labelledby="modalAjudaTitulo" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width:95%; max-width:600px;">
		<div class="modal-content">
			<a class="btn btn-default" style="text-align: center;
							display: block;
							line-height: 30px;
							background: #eee;">
				<div class="modal-header">
					<h5 class="modal-title">{{ __('msg.Help & Contact') }}</h5></div>
			</a>
			<div class="modal-body">
				<div style="width:95%; margin:auto; ">
					<a data-toggle="modal" data-target="#modalSuporte" style="text-align: center; display: block; font-size: 20px;">{{ __('msg.Click here and talk to the developer') }}</a>
					<div id="dvSuporte"></div>
					<div style="font-size:18px; font-weight:bold; margin-bottom:5px;  margin-top:15px; text-align: center;"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Tutoriais</div>
				</div>
			<!--<button type="button" class="btn btn-default" data-dismiss="modal" style="width:90px; margin:20px;">{{ __('msg.Go Out') }}</button>-->
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalSuporte" tabindex="-1" role="dialog" aria-labelledby="modalSuporteTitulo" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width:95%; max-width:500px;">
		<div class="modal-content">
			<div class="modal-body">
				<div style="font-size: 20px;" id="modalSuporteTitulo">{{ __('msg.Contact & Support') }}</div>
				<div class="input-group" style="margin-top:15px; width:100%;">
					<font style="color:#999999">{{ __('msg.Subject matter') }}</font>
					<br>
					<select name="txt-support-subject" id="txt-support-subject" class="form-control">
						<option value="Report errors or problems">{{ __('msg.Report errors or problems') }}</option>
						<option value="Send suggestions or criticisms">{{ __('msg.Send suggestions or criticisms') }}</option>
						<option value="Support and questions">{{ __('msg.Support and questions') }}</option>
						<option value="Contato">{{ __('msg.contact') }}</option>
					</select>
				</div>
				<input type="hidden" id="txt-support-module" value="Space">
				<div class="input-group" style="margin-top:5px; width:100%;">
					<font style="color:#999999">{{ __('msg.message') }}</font>
					<textarea name="txt-support-message" id="txt-support-message" rows="5" maxlength="255" class="form-control" style=" resize:vertical;"></textarea>
				</div>
			</div>
			<div class="modal-footer" style="margin-top:10px;">
				<button type="button" class="btn btn-success" onclick="SubmitContactReport()" style="width:90px;">{{ __('msg.submit') }}</button>
				<button type="button" class="btn btn-default" data-dismiss="modal" style="width:90px;">{{ __('msg.cancel') }}</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="ReuseRequestConfirm" role="dialog">
    <div class="modal-dialog modal-sm" style="top:30%">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{ __('msg.Request Option') }}</h4>
        </div>
        <div class="modal-body">
          <p>{{ __('msg.Are you want to reuse request') }}</p>
        </div>
        <div class="modal-footer">
          <a  onclick="OpenRequestModel()" class="btn btn-primary float-left" >{{ __('msg.yes') }}</a>
          <a href="{{url('space/new-request')}}" class="btn btn-default">{{ __('msg.no') }}</a>
        </div>
      </div>

    </div>
  </div>
  <div class="modal fade" id="ModelShowRequest" role="dialog">
    <div class="modal-dialog">
			<div class="modal-content">
			<div class="table-responsive">
			<table id="showRequestInPopup" class="table">
			<thead>
				<tr class="warning">
					<th></th>
					<th>{{ __('msg.date') }}</th>
					<th>{{ __('msg.time') }}</th>
					<th>{{ __('msg.events') }}</th>
					<th>{{ __('msg.space') }}</th>
					<th>{{ __('msg.status') }}</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
		</div>
		</div>
    </div>
  </div>

  <div class="modal fade" id="modalGrupoConectar" tabindex="-1" role="dialog" aria-labelledby="modalGrupoConectarTitulo" aria-hidden="true">
		<div class="modal-dialog" role="document" style="width:95%; max-width:500px;">
			<div class="modal-content">
				<div class="modal-header" style="color:#000000">
					<h4 class="modal-title" id="modalGrupoConectarTitulo">Connect to a group</h4>
					<div>
					Click on one of the banners to request to join a group. Remember that admission depends on the approval of the group administrator.
					</div>
				</div>
				<div class="modal-body">
					<table class="listaGrupos">
						<tbody>
							@foreach($groupData as $group)
							<tr>
								<td style="padding-bottom:10px;" onclick="SendGroupRequest({{$group->group_id}})">
									<div style="position:absolute; color:#ffffff; font-size:20px; margin:10px; text-shadow: 2px 2px 2px #000000;">
										{{$group->name}}
									</div>
									<img style="width:100%;"  id="imGrupo4" src="{{asset('_dados/plataforma/grupos/'.$group->group_id.'/banner.jpg')}}">
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal" style="width:90px;">Cancel</button>
				</div>
			</div>
		</div>
	</div>