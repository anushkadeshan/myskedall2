@extends('platform/template')
@section('content')
<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script>
        function mudarPainel(id) {
            for (var i = 1; i <= 4; i++) {
                $('#tab' + i).css('display', 'none');
                $('#td' + i).css('background-color', '#333333');
                $('#td' + i + 'Aux').css('background-color', '#999999');
            }
            $('#tab' + id).css('display', 'block');
            $('#td' + id).css('background-color', '#666666');
            $('#td' + id + 'Aux').css('background-color', '#5bc0de');
            gravarCookie('planoz_tab', id);
			sessionStorage.setItem('hometab', id);
        }

        function mudarTabMenu(eventName) {
            if ($('#tab1').is(":visible")) {
                if (eventName == 'swiperight') {}
                if (eventName == 'swipeleft') {
                    mudarPainel(2);
                }
            } else if ($('#tab2').is(":visible")) {
                if (eventName == 'swiperight') {
                    mudarPainel(1);
                }
                if (eventName == 'swipeleft') {
                    mudarPainel(3);
                }
            } else if ($('#tab3').is(":visible")) {
                if (eventName == 'swiperight') {
                    mudarPainel(2);
                }
                if (eventName == 'swipeleft') {
                    mudarPainel(4);
                }
            } else if ($('#tab4').is(":visible")) {
                if (eventName == 'swiperight') {
                    mudarPainel(4);
                }
                if (eventName == 'swipeleft') {}
            }
        }
		var hometab = sessionStorage.getItem("hometab");
		$(document).ready(function(){
			console.log(hometab);

			if(hometab==null){
				mudarPainel(1);
			}
			else{
				if(hometab == 4){
					sessionStorage.removeItem('hometab');
					window.location.href = "{{url('approvals')}}";
				}
				else{
					mudarPainel(hometab);
				}
				
			}

		});

		</script>
	<div id="dvPainel">
		<table width="100%" class="painelNivel">
			<tbody>
				<tr>
					<td id="td1" width="25%" onclick="beep(); mudarPainel(1)" style="background-color: rgb(102, 102, 102);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ __('msg.applications') }}</font></font>
					</td>
					<td id="td2" width="25%" onclick="beep(); mudarPainel(2)" style="background-color: rgb(51, 51, 51);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ __('msg.communication') }}</font></font>
					</td>
					<td id="td3" width="25%" onclick="beep(); mudarPainel(3)" style="background-color: rgb(51, 51, 51);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ __('msg.contact') }}</font></font>
					</td>
					@hasanyrole('Super Admin|Local Admin|Module Admin')
					<td  onclick="UrlRedirect('{{url('approvals')}}')" id="td4" width="25%" onclick="beep(); mudarPainel(4)" style="background-color: rgb(51, 51, 51);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ __('msg.admin') }}</font></font>
					</td>
					@endhasanyrole
				</tr>
				<tr style="height:2px;">
					<td id="td1Aux" style="height: 2px; font-size: 2px; padding: 0px; background-color: rgb(91, 192, 222);">&nbsp;</td>
					<td id="td2Aux" style="height:2px; font-size:2px; padding:0px; background-color:#999999">&nbsp;</td>
					<td id="td3Aux" style="height:2px; font-size:2px; padding:0px; background-color:#999999">&nbsp;</td>
				</tr>
			</tbody>
        </table>
		
		<div id="tab1" style="display: block;">
			<table width="100%" class="lista">
				<tbody>
					@foreach($data as $row)
					<tr>
						<td width="120" style="padding:10px;">
							<a href="{{url('app/'.$row->redirect_link.'/'.$row->app_id)}}"><div style="position:relative;"> <img src="{{asset($row->image)}}" width="100%"> </div></a>
						</td>
						<td  style="padding-right:5px">
							<a href="{{url('app/'.$row->redirect_link.'/'.$row->app_id)}}">
								<div class="appTitulo"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$row->title}}</font></font>
								</div>
								<div class="appDescricao"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$row->description}}</font></font>
								</div>
							</a>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<hr style="padding:0px; margin:0px;">
						</td>
					</tr>
					@endforeach

				</tbody>
			</table>
			@can('Activate Apps')
				<div style="width:100%; text-align:center; padding:25px;"><a href="{{url('apps')}}"><img src="{{asset('platform/images/add.png')}}" width="50" style="cursor:pointer;"></a></div>
			@endcan
		</div>
		<div id="tab2" style="display:none">
			<table width="100%" class="lista">
				<tbody>
					<tr>
						<td width="120" style="padding:10px;"> <img src="{{asset('platform/images/fundo_calendario.jpg')}}" width="100%"> </td>
						<td  style="padding-right:5px">
							<div class="appTitulo"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.calender')  }}</font></font>
							</div>
							<div class="appDescricao"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ __('msg.Stay on top of our activities and events') }}</font></font>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<hr style="padding:0px; margin:0px;">
						</td>
					</tr>
					<tr>
						<td width="120" style="padding:10px;"> <img src="{{asset('platform/images/fundo_midias.jpg')}}" width="100%"> </td>
						<td style="padding-right:5px">
							<div class="appTitulo"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ __('msg.videos') }}</font></font>
							</div>
							<div class="appDescricao"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ __('msg.See our videos produced especially for you') }}</font></font>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<hr style="padding:0px; margin:0px;">
						</td>
					</tr>
					<tr>
						<td width="120" style="padding:10px;"> <img src="{{asset('platform/images/fundo_downloads.jpg')}}" width="100%"> </td>
						<td style="padding-right:5px">
							<div class="appTitulo">{{ __('msg.downloads') }}</div>
							<div class="appDescricao"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ __('msg.Get exclusive materials that can help you') }}</font></font>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<hr style="padding:0px; margin:0px;">
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div id="tab3" style="display:none">
		   <div style="width:100%; padding:15px; padding-bottom:25px;">
			   <div style="width:100%; font-size:20px; color:#333333;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">PlanOz</font></font></div>
               <div style="width:100%; font-size:14px; color:#666666; padding-top:5px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ __('msg.we_are_1') }} </font>
                    <font style="vertical-align: inherit;">{{ __('msg.we_are_2') }}</font></font></div>
			   <div style="width:100%; font-size:15px; font-weight:bold; color:#666666; padding-top:10px;"><i class="fa fa-map-marker" aria-hidden="true"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> {{ __('msg.address') }}: Av. Martin Luther King, 2255, Jd Umuarama, Osasco, SP</font></font></div>
			   <div style="width:100%; font-size:15px; color:#666666; padding-top:10px;"><i class="fa fa-clock-o" aria-hidden="true"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> {{ __('msg.hours') }}</font></font></div>
			   <div style="width:100%; font-size:15px; color:#666666; padding-top:10px;"><i class="fa fa-phone" aria-hidden="true"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> {{ __('msg.phone') }}: 11 99241-1485</font></font></div>
			   <div style="width:100%; font-size:15px; color:#666666; padding-top:0px;"><i class="fa fa-facebook-square" aria-hidden="true"></i> Facebook: </div>
			   <div style="width:100%; font-size:15px; color:#666666; padding-top:0px;"><i class="fa fa-globe" aria-hidden="true"></i> {{ __('msg.site') }}: http://www.prak.com.br</div>
			</div>
			<iframe src="" width="100%" height="600" frameborder="0" style="border:0" allowfullscreen=""></iframe>
		</div>
		@hasanyrole('Super Admin|Local Admin|Module Admin')
		<div id="tab4" style="display:none">
			<table width="100%" class="lista">
				<tbody>
                    <tr onclick="UrlRedirect('{{url('group-requests')}}')">
                        <td width="120" style="padding:10px;"> <img src="{{asset('platform/images/user2.png')}}"
                                width="50"> </td>
                        <td style="padding-right:5px">
                            <div class="appTitulo">{{ __('msg.group Requests') }}</div>
                            <div class="appDescricao">{{ __('msg.Accept or reject group requests from system users') }}</div>
                        </td>
                    </tr>
                    @hasanyrole('Super Admin')
                    <tr onclick="UrlRedirect('{{url('groups')}}')">
                        <td width="120" style="padding:10px;"> <img src="{{asset('platform/images/group.png')}}"
                                width="50"> </td>
                        <td style="padding-right:5px">
                            <div class="appTitulo">{{ __('msg.Organizations / Groups Management') }} </div>
                            <div class="appDescricao">{{ __('msg.Find,Add,Change or Delete organization/ Group') }}</div>
                        </td>
					</tr>
					 <tr onclick="UrlRedirect('{{url('languages/pt/translations?filter=&language=pt&group=msg')}}')">
                        <td width="120" style="padding:10px;"> <img src="{{asset('platform/images/language.png')}}"
                                width="50"> </td>
                        <td style="padding-right:5px">
                            <div class="appTitulo">{{ __('msg.Language Management') }} </div>
                            <div class="appDescricao">{{ __('msg.Add/Edit Terms in English and Portuguese') }}</div>
                        </td>
                    </tr>
                    @endhasanyrole
					<tr onclick="UrlRedirect('{{url('admin/space-requests')}}')">
						<td width="120"  style="padding:10px;"> <img src="{{asset('platform/images/user2.png')}}" width="50"> </td>
						<td  style="padding-right:5px">
							<div class="appTitulo">{{ __('msg.Request Management') }}</div>
							<div class="appDescricao">{{ __('msg.Accept or reject requests from system user') }}s</div>
						</td>
					</tr>
					
					<tr onclick="UrlRedirect('{{url('approvals')}}')">
						<td width="120"  style="padding:10px;"> <img src="{{asset('platform/images/user2.png')}}" width="50"> </td>
						<td  style="padding-right:5px">
							<div class="appTitulo">	{{ __('msg.Approval Management') }}</div>
							<div class="appDescricao">{{ __('msg.Accept or reject requests from system user') }}</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<hr style="padding:0px; margin:0px;">
						</td>
					</tr>

					<tr>
						<td colspan="2">
							<hr style="padding:0px; margin:0px;">
						</td>
					</tr>
					<tr onclick="UrlRedirect('{{url('admin/reason-management')}}')">
						<td width="120"  style="padding:10px;"> <img src="{{asset('platform/images/config.png')}}" width="50"> </td>
						<td  style="padding-right:5px">
							<div class="appTitulo">	{{ __('msg.Reason Management') }}</div>
							<div class="appDescricao">{{ __('msg.Adding, Modifying, Active, Block & Delete Reason') }}</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<hr style="padding:0px; margin:0px;">
						</td>
					</tr>
					<tr onclick="UrlRedirect('{{url('admin/external-location')}}')">
						<td width="120"  style="padding:10px;"> <img src="{{asset('platform/images/config.png')}}" width="50"> </td>
						<td  style="padding-right:5px">
							<div class="appTitulo">	{{ __('msg.Type of Locations') }}</div>
							<div class="appDescricao">{{ __('msg.Adding, Modifying & Delete External Location') }}</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<hr style="padding:0px; margin:0px;">
						</td>
					</tr>
					<tr onclick="UrlRedirect('{{url('materials')}}')">
						<td width="120"  style="padding:10px;"> <img src="{{asset('platform/images/config.png')}}" width="50"> </td>
						<td  style="padding-right:5px">
							<div class="appTitulo">	{{ __('msg.Manage Materials') }}</div>
							<div class="appDescricao">{{ __('msg.Adding, Modifying & Delete Materials can be assigned for locations') }}</div>
						</td>
					</tr>
					<tr onclick="UrlRedirect('{{url('functions')}}')">
						<td width="120"  style="padding:10px;"> <img src="{{asset('platform/images/config.png')}}" width="50"> </td>
						<td  style="padding-right:5px">
							<div class="appTitulo">	{{ __('msg.Manage Functions') }}</div>
							<div class="appDescricao">{{ __('msg.Adding, Modifying & Delete Functions/Personals/Services can be assigned for locations') }}</div>
						</td>
					</tr>
					<tr onclick="UrlRedirect('{{url('admin/location-management')}}')">
						<td width="120"  style="padding:10px;"> <img src="{{asset('platform/images/config.png')}}" width="50"> </td>
						<td  style="padding-right:5px">
							<div class="appTitulo">	{{ __('msg.Location Management') }}</div>
							<div class="appDescricao">{{ __('msg.Adding, Modifying & Delete Location') }}</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<hr style="padding:0px; margin:0px;">
						</td>
					</tr>
					<tr onclick="UrlRedirect('{{url('alerts')}}')">
						<td width="120"  style="padding:10px;"> <img src="{{asset('platform/images/config.png')}}" width="50"> </td>
						<td  style="padding-right:5px">
							<div class="appTitulo">	{{ __('msg.Alerts Management') }}</div>
							<div class="appDescricao">{{ __('msg.Showing User Alerts') }}</div>
						</td>
					</tr>
					<tr onclick="UrlRedirect('{{url('admin/reports')}}')">
						<td width="120"  style="padding:10px;"> <img src="{{asset('platform/images/config.png')}}" width="50"> </td>
						<td  style="padding-right:5px">
							<div class="appTitulo">	{{ __('msg.Reports') }}</div>
							<div class="appDescricao">{{ __('msg.Space Reports') }}</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<hr style="padding:0px; margin:0px;">
						</td>
					</tr>
					<tr onclick="UrlRedirect('{{url('users')}}')">
						<td width="120"  style="padding:10px;"> <img src="{{asset('platform/images/user.png')}}" width="50"> </td>
						<td  style="padding-right:5px">
							<div class="appTitulo">	{{ __('msg.User Management') }}</div>
							<div class="appDescricao">{{ __('msg.Finding, adding and changing system users') }}</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<hr style="padding:0px; margin:0px;">
						</td>
                    </tr>
                    <tr onclick="UrlRedirect('{{url('admin/supports')}}')">
                        <td width="120" style="padding:10px;"> <img src="{{asset('platform/images/support.png')}}"
                                width="50"> </td>
                        <td style="padding-right:5px">
                            <div class="appTitulo"> {{ __('msg.Support Management') }}</div>
                            <div class="appDescricao">{{ __('msg.Support Management') }}</div>
                        </td>
                    </tr>
					<!--tr>
						<td width="120"  style="padding:10px;"> <img src="{{asset('platform/images/personalizacao.png')}}" width="50"> </td>
						<td  style="padding-right:5px">
							<div class="appTitulo">{{ __('msg.Application Customization') }}</div>
							<div class="appDescricao">{{ __('msg.System customization, contact, banner, address, etc.') }}</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<hr style="padding:0px; margin:0px;">
						</td>
					</tr>
					<tr>
						<td width="120" style="padding:10px;"> <img src="{{asset('platform/images/config.png')}}" width="50"> </td>
						<td  style="padding-right:5px">
							<div class="appTitulo">	{{ __('msg.Media Management') }}</div>
							<div class="appDescricao">{{ __('msg.Include, change or delete media stored on Youtube') }}</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<hr style="padding:0px; margin:0px;">
						</td>
					</tr>
					<tr>
						<td width="120"  style="padding:10px;"> <img src="{{asset('platform/images/config.png')}}" width="50"> </td>
						<td  style="padding-right:5px">
							<div class="appTitulo">	{{ __('msg.Calendar Management') }}</div>
							<div class="appDescricao">{{ __('Include, change or delete calendar') }}</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<hr style="padding:0px; margin:0px;">
						</td>
					</tr>-->
				</tbody>
			</table>
		</div>
		@endhasanyrole
	</div>
@endsection
