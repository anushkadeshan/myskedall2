	@php 
		$user = Auth::user();
	@endphp
	<div class="modal fade" id="modalUsuarioEdit" tabindex="-1" role="dialog" aria-labelledby="modalUsuarioEditTitulo" aria-hidden="true">
		<div class="modal-dialog" role="document" style="width:95%; max-width:600px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalUsuarioEditTitulo"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Change</font></font></h5></div>
				<div class="modal-body">
					<input type="hidden" id="txUsuarioTipoEdit" value="">
					<input type="hidden" id="txUsuarioEditOrigem" value="">
					<input type="hidden" id="txUsuarioEditCodigo" value="">
					<div>
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#tabUsuariosEditGeral" aria-controls="tabUsuariosEditGeral" role="tab" data-toggle="tab"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">General</font></font></a></li>
							<li role="presentation"><a href="#tabUsuariosEditEndereco" aria-controls="tabUsuariosEditEndereco" role="tab" data-toggle="tab"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Address</font></font></a></li>
							<li role="presentation" style="display:none;"><a href="#tabUsuariosEditLogin" aria-controls="tabUsuariosEditLogin" role="tab" data-toggle="tab"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Login</font></font></a></li>
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="tabUsuariosEditGeral">
								<div>
									<div class="input-group" style="margin-top:10px;">
										<span class="input-group-addon"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Name</font></font></span>
										<input type="text" name="txUsuarioEditNome" id="txUsuarioEditNome" value="" maxlength="255" class="form-control">
									</div>
									<div class="input-group">
										<span class="input-group-addon"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nickname</font></font></span>
										<input type="text" name="txUsuarioEditApelido" id="txUsuarioEditApelido" value="" maxlength="50" class="form-control">
									</div>
									<div class="input-group">
										<span class="input-group-addon"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Phone</font></font></span>
										<input type="text" name="txUsuarioEditFone" id="txUsuarioEditFone" value="" maxlength="30" class="form-control">
									</div>
									<div class="input-group">
										<span class="input-group-addon" style="padding: 0px"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Profession</font></font></span>
										<input type="text" name="txUsuarioEditProfissao" id="txUsuarioEditProfissao" value="" maxlength="100" class="form-control" autocomplete="off" style="width:85%;">
										<button name="bttxUsuarioEditProfissao" id="bttxUsuarioEditProfissao" class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" style="height:35px; margin-right:-40px;"><span class="caret"></span></button>
										<ul class="dropdown-menu dropdown-menu-right" role="menu">
											<li role="presentation">
												<a role="menuitem" tabindex="-1" onclick="$(&quot;#txUsuarioEditProfissao&quot;).val(&quot;&quot;);"></a>
											</li>
											<li role="presentation">
												<a role="menuitem" tabindex="-1" onclick="$(&quot;#txUsuarioEditProfissao&quot;).val(&quot;&quot;);"></a>
											</li>
											<li role="presentation"><a role="menuitem" tabindex="-1" onclick="$(&quot;#txUsuarioEditProfissao&quot;).val(&quot;Administrador&quot;);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Administrator</font></font></a></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" onclick="$(&quot;#txUsuarioEditProfissao&quot;).val(&quot;Advogado&quot;);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Lawyer</font></font></a></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" onclick="$(&quot;#txUsuarioEditProfissao&quot;).val(&quot;Arquiteto&quot;);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Architect</font></font></a></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" onclick="$(&quot;#txUsuarioEditProfissao&quot;).val(&quot;Caixa&quot;);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Cashier</font></font></a></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" onclick="$(&quot;#txUsuarioEditProfissao&quot;).val(&quot;Costureira&quot;);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Seamstress</font></font></a></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" onclick="$(&quot;#txUsuarioEditProfissao&quot;).val(&quot;Designer grafico&quot;);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Graphic designer</font></font></a></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" onclick="$(&quot;#txUsuarioEditProfissao&quot;).val(&quot;Empreiteiro de obras civil&quot;);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Civil works contractor</font></font></a></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" onclick="$(&quot;#txUsuarioEditProfissao&quot;).val(&quot;Empresário&quot;);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Businessman</font></font></a></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" onclick="$(&quot;#txUsuarioEditProfissao&quot;).val(&quot;Engenheiro e programador de softwares&quot;);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Software engineer and programmer</font></font></a></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" onclick="$(&quot;#txUsuarioEditProfissao&quot;).val(&quot;Manicure&quot;);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Manicure</font></font></a></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" onclick="$(&quot;#txUsuarioEditProfissao&quot;).val(&quot;Motorista&quot;);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Driver</font></font></a></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" onclick="$(&quot;#txUsuarioEditProfissao&quot;).val(&quot;Não faço nada&quot;);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">I do not do anything</font></font></a></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" onclick="$(&quot;#txUsuarioEditProfissao&quot;).val(&quot;Pedagoga&quot;);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Pedagogue</font></font></a></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" onclick="$(&quot;#txUsuarioEditProfissao&quot;).val(&quot;Promotor de Vendas&quot;);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Sales promoter</font></font></a></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" onclick="$(&quot;#txUsuarioEditProfissao&quot;).val(&quot;Psicóloga e Coach&quot;);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Psychologist and Coach</font></font></a></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" onclick="$(&quot;#txUsuarioEditProfissao&quot;).val(&quot;Secretária&quot;);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Secretary</font></font></a></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" onclick="$(&quot;#txUsuarioEditProfissao&quot;).val(&quot;Securitário&quot;);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Insurance</font></font></a></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" onclick="$(&quot;#txUsuarioEditProfissao&quot;).val(&quot;Supervisor Operacional&quot;);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Operational supervisor</font></font></a></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" onclick="$(&quot;#txUsuarioEditProfissao&quot;).val(&quot;técnico eletrônico&quot;);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">electronic technician</font></font></a></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" onclick="$(&quot;#txUsuarioEditProfissao&quot;).val(&quot;Telemarketing&quot;);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Telemarketing</font></font></a></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" onclick="$(&quot;#txUsuarioEditProfissao&quot;).val(&quot;Vendedor&quot;);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Salesman</font></font></a></li>
										</ul>
									</div>
									<div class="input-group">
										<span class="input-group-addon"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">RG</font></font></span>
										<input type="text" name="txUsuarioEditRg" id="txUsuarioEditRg" value="" maxlength="30" class="form-control">
									</div>
									<div class="input-group">
										<span class="input-group-addon"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CPF</font></font></span>
										<input type="text" name="txUsuarioEditCpf" id="txUsuarioEditCpf" value="" maxlength="30" class="form-control">
									</div>
								</div>
							</div>

							<div role="tabpanel" class="tab-pane" id="tabUsuariosEditEndereco">
								<div class="input-group" style="margin-top:10;">
									<span class="input-group-addon" style="padding:0px"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Zip code</font></font></span>
									<input type="text" name="txUsuarioEditCep" id="txUsuarioEditCep" value="" maxlength="10" class="form-control" style="width:95px;">
									<button name="btCep" id="btCep" class="btn btn-default btn-sm" type="button" style="margin-left:5px; color:#333333" onclick="beep(); buscaCEP()"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> <span class="hidden-xs"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">search</font></font></span></button>
									<input name="txCepWait" id="txCepWait" type="text" disabled="" class="hidden-xs" style="width:80; border-collapse:collapse; border:hidden; background-color:#ffffff; margin-left:5; margin-top:5; font-size:10">

								</div>
								<div class="input-group" style="margin-top:5;">
									<span class="input-group-addon" style="padding:0px"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Address</font></font></span>
									<input type="text" name="txUsuarioEditEndereco" id="txUsuarioEditEndereco" value="" maxlength="255" class="form-control">
								</div>
								<div class="input-group">
									<span class="input-group-addon"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Neighborhood</font></font></span>
									<input type="text" name="txUsuarioEditBairro" id="txUsuarioEditBairro" value="" maxlength="100" class="form-control">
								</div>
								<div class="input-group">
									<span class="input-group-addon"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">City</font></font></span>
									<input type="text" name="txUsuarioEditCidade" id="txUsuarioEditCidade" value="" maxlength="100" class="form-control">
								</div>
								<div class="input-group">
									<span class="input-group-addon"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">UF</font></font></span>
									<input type="text" name="txUsuarioEditUf" id="txUsuarioEditUf" value="" maxlength="2" class="form-control" style="width:50px;">
								</div>
							</div>

							<div role="tabpanel" class="tab-pane" id="tabUsuariosEditLogin" style="display:none;">
								<div class="input-group" style="margin-top:15px;">
									<span class="input-group-addon"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Email</font></font></span>
									<input type="email" name="txUsuarioEditEmail" id="txUsuarioEditEmail" value="" maxlength="255" class="form-control">
								</div>
								<div class="input-group" style="margin-top:15; display:none;">
									<span class="input-group-addon"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Level</font></font></span>
									<select name="txUsuarioEditNivel" id="txUsuarioEditNivel" class="form-control">
										<option value="0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Common user</font></font>
										</option>
										<option value="1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Administrator</font></font>
										</option>
									</select>
								</div>
								<div class="input-group" style="margin-top:5; display:none;">
									<span class="input-group-addon"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Access</font></font></span>
									<select id="txUsuarioEditAcessos" multiple="multiple" style="font-size: 5px; display: none;">
										<option value="S"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Secretary</font></font>
										</option>
										<option value="G"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">manager</font></font>
										</option>
										<option value="D"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">distributor</font></font>
										</option>
									</select>
									<div class="btn-group">
										<button type="button" class="multiselect dropdown-toggle btn btn-default" data-toggle="dropdown" title="None selected"><span class="multiselect-selected-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">None selected</font></font></span> <b class="caret"></b></button>
										<ul class="multiselect-container dropdown-menu">
											<li>
												<a tabindex="0">
													<label class="checkbox">
														<input type="checkbox" value="S"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Secretary</font></font>
													</label>
												</a>
											</li>
											<li>
												<a tabindex="0">
													<label class="checkbox">
														<input type="checkbox" value="G"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> manager</font></font>
													</label>
												</a>
											</li>
											<li>
												<a tabindex="0">
													<label class="checkbox">
														<input type="checkbox" value="D"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> distributor</font></font>
													</label>
												</a>
											</li>
										</ul>
									</div>
									<div class="btn-group">
										<button type="button" class="multiselect dropdown-toggle btn btn-default" data-toggle="dropdown" title="None selected"><span class="multiselect-selected-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">None selected</font></font></span> <b class="caret"></b></button>
										<ul class="multiselect-container dropdown-menu">
											<li>
												<a tabindex="0">
													<label class="checkbox">
														<input type="checkbox" value="S"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Secretary</font></font>
													</label>
												</a>
											</li>
											<li>
												<a tabindex="0">
													<label class="checkbox">
														<input type="checkbox" value="G"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> manager</font></font>
													</label>
												</a>
											</li>
											<li>
												<a tabindex="0">
													<label class="checkbox">
														<input type="checkbox" value="D"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> distributor</font></font>
													</label>
												</a>
											</li>
										</ul>
									</div>
								</div>

								<div class="input-group" style="margin-top:15; display:none;">
									<span class="input-group-addon">Status</span>
									<select name="txUsuarioEditStatus" id="txUsuarioEditStatus" class="form-control">
										<option value="0">Validar</option>
										<option value="1">Ativo</option>
										<option value="2">Inativo</option>
									</select>
								</div>
								<div class="input-group" style="margin-top:15px;; display:none;">
									<span class="input-group-addon">Grupo Atual</span>
									<select name="txUsuarioEditGrupo" id="txUsuarioEditGrupo" class="form-control">
										<option value="4">Comunidade Cristã de Adamantina</option>
										<option value="3">Edificando em Cristo</option>
										<option value="2">EdificandoOz</option>
										<option value="1" selected="">PlanOz</option>
									</select>
								</div>
								<div class="input-group" style="margin-top:5px;; display:none;">
									<span class="input-group-addon">Grupos Permitidos</span>
									<select id="txUsuarioEditGrupoOutros" multiple="multiple" style="font-size: 15px; display: none;">
										<option value="4">Comunidade Cristã de Adamantina</option>
										<option value="3">Edificando em Cristo</option>
										<option value="2">EdificandoOz</option>
										<option value="1">PlanOz</option>
									</select>
									<div class="btn-group">
										<button type="button" class="multiselect dropdown-toggle btn btn-default" data-toggle="dropdown" title="None selected"><span class="multiselect-selected-text">None selected</span> <b class="caret"></b></button>
										<ul class="multiselect-container dropdown-menu">
											<li>
												<a tabindex="0">
													<label class="checkbox">
														<input type="checkbox" value="4"> Comunidade Cristã de Adamantina</label>
												</a>
											</li>
											<li>
												<a tabindex="0">
													<label class="checkbox">
														<input type="checkbox" value="3"> Edificando em Cristo</label>
												</a>
											</li>
											<li>
												<a tabindex="0">
													<label class="checkbox">
														<input type="checkbox" value="2"> EdificandoOz</label>
												</a>
											</li>
											<li>
												<a tabindex="0">
													<label class="checkbox">
														<input type="checkbox" value="1"> PlanOz</label>
												</a>
											</li>
										</ul>
									</div>
									<div class="btn-group">
										<button type="button" class="multiselect dropdown-toggle btn btn-default" data-toggle="dropdown" title="None selected"><span class="multiselect-selected-text">None selected</span> <b class="caret"></b></button>
										<ul class="multiselect-container dropdown-menu">
											<li>
												<a tabindex="0">
													<label class="checkbox">
														<input type="checkbox" value="4"> Comunidade Cristã de Adamantina</label>
												</a>
											</li>
											<li>
												<a tabindex="0">
													<label class="checkbox">
														<input type="checkbox" value="3"> Edificando em Cristo</label>
												</a>
											</li>
											<li>
												<a tabindex="0">
													<label class="checkbox">
														<input type="checkbox" value="2"> EdificandoOz</label>
												</a>
											</li>
											<li>
												<a tabindex="0">
													<label class="checkbox">
														<input type="checkbox" value="1"> PlanOz</label>
												</a>
											</li>
										</ul>
									</div>
								</div>

								<div class="input-group" style="margin-top:15px; width:200px;">
									<span class="input-group-addon" style="width:80px">Último Login</span>
									<input type="text" name="txUsuarioEditDataLogin" id="txUsuarioEditDataLogin" value="" maxlength="10" class="form-control" disabled="">
								</div>
							</div>

						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" id="btEditUsuario" onclick="beep(); gravarUsuario()" style="width:90px;">Gravar</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" style="width:90px;">Cancelar</button>
				</div>
			</div>
		</div>
	</div>
	<style type="text/css">
		.input-group-addon {
			font-size: 11px;
			width: 65px;
		}
	</style>
	<div class="modal fade" id="modalSenha" tabindex="-1" role="dialog" aria-labelledby="modalSenhaTitulo" aria-hidden="true">
		<div class="modal-dialog" role="document" style="width:95%; max-width:500px;">
			<div class="modal-content">
				<div class="modal-header" style="color:#000000">
					<h5 class="modal-title" id="modalSenhaTitulo">Change password</h5>
				</div>
				<div class="modal-body">
					<div class="input-group">
						<input type="text" value="{{$user->email}}" class="form-control" disabled="">
					</div>
					<div class="input-group">
						<span class="input-group-addon" style="width:90px; padding:0px;">Current Password</span>
						<input type="password" id="current-password" class="form-control">
					</div>
					<div class="input-group">
						<span class="input-group-addon" style="width:90px; padding:0px;">New Password</span>
						<input type="password" id="new-password" class="form-control">
					</div>
					<div class="input-group">
						<span class="input-group-addon" style="width:90px; padding:0px;">Confirm Password</span>
						<input type="password" id="confirm-password"  class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" onclick="ChangePassword()" style="width:90px;">Submit</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" style="width:90px;">Cancel</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modalFoto" tabindex="-1" role="dialog">
		<div class="modal-dialog" style="width:600px">
			<div class="modal-content">
				<form action="" enctype="multipart/form-data" id="ProfilePhotoForm" name="ProfilePhotoForm">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
						<h4 class="modal-title">Change Photo</h4>
					</div>
					<div class="modal-body">
						<input id="txFotoFile" name="txFotoFile" type="file" class="filestyle" data-buttontext="&nbsp;Selecionar&nbsp;" data-buttonname="btn-info" style="width: 570px">
					</div>
					<div class="modal-footer">
						<table width="100%">
							<tbody>
								<tr>
									<td>
										<button type="button" class="btn btn-primary" onclick="PhotoUpload()" style="width: 100px">Upload</button>
										<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
									</td>
									<td align="right">
										<a href="{{url('delete-profile-photo')}}" class="btn btn-danger" style="width: 100px">Delete Photo</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</form>
			</div>
		</div>
	</div>
	<style type="text/css">
		.input-group-addon {
			font-size: 11px;
			width: 65px;
		}

		.modal-backdrop {
  			z-index: -1;
		}
	</style>
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
								<td style="padding-bottom:10px;" onclick="SendGroupRequest({{$group->id}})">
									<div style="position:absolute; color:#ffffff; font-size:20px; margin:10px; text-shadow: 2px 2px 2px #000000;">
										{{$group->name}}
									</div>
									<img style="width:100%;"  id="imGrupo4" src="{{asset('_dados/plataforma/grupos/'.$group->id.'/banner.jpg')}}">
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
	<div class="modal fade" id="modalCompartilhar" tabindex="-1" role="dialog" aria-labelledby="modalCompartilharTitulo" aria-hidden="true">
		<div class="modal-dialog" role="document" style="width:95%; max-width:600px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalCompartilharTitulo">To share</h5>
				</div>
				<div class="modal-body" style="text-align:center;">
					<a onclick="sharePlay()"><img src="{{asset('platform/images/logo_google_play.png')}}" width="300"></a>
					<br>
					<a onclick="shareSite()"><img src="{{asset('platform/images/logo_site.png')}}" width="300"></a>
					<br>
					<a onclick="shareEmail()"><img src="{{asset('platform/images/logo_email.png')}}" width="300"></a>
					<br>
					<a data-dismiss="modal" class="btn btn-default" style="width:90px; margin:20px;">Share

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
					<div style="font-size:20px;">To Share Google Play Store</div>
					<img src="{{asset('platform/images/share_google_play.png')}}" width="300">
					<br>
					<button type="button" class="btn btn-default" data-dismiss="modal" style="width:90px;">Go out</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modalSite" style="z-index:9999">
		<div class="modal-dialog" role="document" style="width:95%; max-width:500px;">
			<div class="modal-content">
				<div class="modal-body" style="text-align:center">
					<div style="font-size:20px;">To Share Website</div>
					<img src="{{asset('platform/images/share_site.png')}}" width="300">
					<br>
					<button type="button" class="btn btn-default" data-dismiss="modal" style="width:90px;">Go out</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalEmail" style="z-index:9999">
		<div class="modal-dialog" role="document" style="width:95%; max-width:500px;">
			<div class="modal-content">
				<div class="modal-body" style="text-align:left">
					<div style="font-size:20px;">To Share Email</div>
					<div class="input-group" style="margin-top:15px; width:100%;">
						<font style="color:#999999">Enter Your Email</font>
						<br>
						<input type="text" id="share-by-email" value="" maxlength="255" class="form-control">
					</div>
					<br>
					<button type="button" class="btn btn-success" onclick="ShareLinkOnEmail()" style="width:90px;">Submit</button>
					<button type="button" class="btn btn-default" data-dismiss="modal" style="width:90px; margin-left:10px;">Cancel</button>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="modalAjuda" tabindex="-1" role="dialog" aria-labelledby="modalAjudaTitulo" aria-hidden="true">
		<div class="modal-dialog" role="document" style="width:95%; max-width:600px;">
			<div class="modal-content">
				<a class="btn btn-default my-help" style="">
					<div class="modal-header">
						<h5 class="modal-title">{{__('msg.Help and Contact')}}</h5></div>
				</a>
				<div class="modal-body">
					<div style="width:95%; margin:auto; ">
						<a data-toggle="modal" data-target="#modalSuporte" style="text-align: center; display: block; font-size: 20px;">{{__('msg.Click here and talk to the developer')}}</a>
						<div id="dvSuporte"></div>
						<div style="font-size:18px; font-weight:bold; margin-bottom:5px;  margin-top:15px; text-align: center;"><i class="fa fa-graduation-cap" aria-hidden="true"></i> {{__('msg.Tutoriais')}}</div>
					</div>
				<!--<button type="button" class="btn btn-default" data-dismiss="modal" style="width:90px; margin:20px;">Go out</button>-->
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalSuporte" tabindex="-1" role="dialog" aria-labelledby="modalSuporteTitulo" aria-hidden="true">
		<div class="modal-dialog" role="document" style="width:95%; max-width:500px;">
			<div class="modal-content">
				<div class="modal-body">
					<div style="font-size: 20px;" id="modalSuporteTitulo">{{__('msg.Contact & Support')}}</div>
					<div class="input-group" style="margin-top:15px; width:100%;">
						<font style="color:#999999">{{__('Subject matter')}}</font>
						<br>
						<select name="txt-support-subject" id="txt-support-subject" class="form-control">
							<option value="Report errors or problems">{{__('msg.Report errors or problems')}}</option>
							<option value="Send suggestions or criticisms">{{__('msg.Send suggestions or criticisms')}}</option>
							<option value="Support and questions">{{__('msg.Support and questions')}}</option>
							<option value="Contato">{{__('msg.contact')}}</option>
						</select>
					</div>
					<input type="hidden" id="txt-support-module" value="Platform">
					<div class="input-group" style="margin-top:5px; width:100%;">
						<font style="color:#999999">{{__('msg.message')}}</font>
						<textarea name="txt-support-message" id="txt-support-message" rows="5" maxlength="255" class="form-control" style=" resize:vertical;"></textarea>
					</div>
				</div>
				<div class="modal-footer" style="margin-top:10px;">
					<button type="button" class="btn btn-success" onclick="SubmitContactReport()" style="width:90px;">{{__('msg.submit')}}</button>
					<button type="button" class="btn btn-default" data-dismiss="modal" style="width:90px;">{{__('msg.cancel')}}</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modalSobre" tabindex="-1" role="dialog" aria-labelledby="modalSobreTitulo" aria-hidden="true">
		<div class="modal-dialog" role="document" style="width:95%; max-width:600px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalSobreTitulo">Sobre</h5></div>
				<div class="modal-body">

					<table width="95%" align="center" style="margin-top:3px; font-size: 20px;">
						<tbody>
							<tr>
								<td style="font-weight:bold;">PlanOz</td>
							</tr>
						</tbody>
					</table>

					<table width="95%" align="center" style="margin-top:10px;">
						<tbody>
							<tr>
								<td colspan="3" style="font-weight:bold;">Aplicativo Android</td>
							</tr>
							<tr>
								<td width="55">versão</td>
								<td width="5">:</td>
								<td>
									<div id="dvVersao"></div>
								</td>
							</tr>
							<tr>
								<td>grupo</td>
								<td>:</td>
								<td>1</td>
							</tr>
						</tbody>
					</table>
					<table width="95%" align="center" style="margin-top:10px;">
						<tbody>
							<tr>
								<td style="font-weight:bold;">Desenvolvedores</td>
							</tr>
							<tr>
								<td>www.prak.com.br</td>
							</tr>
							<tr>
								<td>www.liondas.com.br</td>
							</tr>
						</tbody>
					</table>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" style="width:90px;">Sair</button>
				</div>
			</div>
		</div>
	</div>
  <div class="modal fade" id="DeleteConfirmModel" role="dialog">
    <div class="modal-dialog modal-sm" style="top:30%">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete Confirmation</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure. You want to delete this item</p>
        </div>
        <div class="modal-footer">
          <a id="DeleteUrlLink" href="#" class="btn btn-primary float-left" >Confirm</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  <div class="modal fade" id="ModalUnreadAlert" role="dialog">
    <div class="modal-dialog modal-sm" style="top:30%">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{ __('msg.space Alert') }}</h4>
        </div>
        <div class="modal-body">
          <p>{{ __('msg.some Alerts are found') }}</p>
        </div>
        <div class="modal-footer">
          <a href="{{url('alerts')}}" class="btn btn-primary float-left" >{{ __('msg.show') }}</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('msg.close') }}</button>
        </div>
      </div>

    </div>
  </div>
  <div class="modal fade" id="ShareSpaceRequest" style="z-index:9999">
		<div class="modal-dialog" role="document" style="width:95%; max-width:500px;">
			<div class="modal-content">
				<div class="modal-body" style="text-align:left">
					<div style="font-size:20px;">To Share Space Request Email</div>
					<div class="input-group" style="margin-top:15px; width:100%;">
						<font style="color:#999999">Enter Your Email</font>
						<br>
						<input type="text" id="share-request-email" value="" maxlength="255" class="form-control">
						<input type="hidden" id="share-request-id" value="" >
					</div>
					<br>
					<button type="button" class="btn btn-success" onclick="ShareSpaceRequestEmail()" style="width:90px;">Submit</button>
					<button type="button" class="btn btn-default" data-dismiss="modal" style="width:90px; margin-left:10px;">Cancel</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="requestor" style="z-index:9999">
		<div class="modal-dialog" role="document" style="width:95%; max-width:500px;">
			<div class="modal-content">
				<div class="modal-body" style="text-align:left">
					<div style="font-size:20px;">Requestor Details</div>
					<div class="input-group" style="margin-top:15px; width:100%;">
						<font style="color:#999999">Name : <span id="requestorName"></span></font>
						<br><font style="color:#999999">Email : <span id="requestorEmail"></span></font>
						<br><font style="color:#999999">Phone : <span id="requestorPhone"></span></font>
					</div>
					<br>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="markAsBlock" style="z-index:9999">
		<div class="modal-dialog" role="document" style="width:95%; max-width:500px;">
			<div class="modal-content">
				<form action="{{url('admin/mark-as-block')}}" method="POST">
					{{ csrf_field() }}
					<div class="modal-body" style="text-align:left">
						<div style="font-size:20px;">Reason for Mark as Unblock</div>
						<div class="input-group" style="margin-top:15px; width:100%;">
							<textarea class="form-control" name="flag_reason" id="" ></textarea>
							<input type="hidden" name="id" id="location_id1">
						</div>
						<input type="submit"  class="btn-btn-primary" value="Submit">
						<br>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="markAsUnblock" style="z-index:9999">
		<div class="modal-dialog" role="document" style="width:95%; max-width:500px;">
			<div class="modal-content">
			<form action="{{url('admin/mark-as-unblock')}}" method="POST">
				{{ csrf_field() }}
				<div class="modal-body" style="text-align:left">
					<div style="font-size:20px;">Reason for Mark as Unblock</div>
					<div class="form-group" style="margin-top:15px; width:100%;">
						<textarea class="form-control" name="flag_reason" id="" ></textarea>
						<input type="hidden" name="id" id="location_id2">
					</div>
					<input type="submit"  class="btn-btn-primary" value="Submit">
					<br>
				</div>
				</form>
			</div>
		</div>
	</div>
	
<style>
.modal-title {

    margin: 0;
    line-height: 1.42857143;
    font-weight: bold;

}
.my-help{text-align: center;
display: block;

line-height: 30px;

background:
#eee;}
</style>
