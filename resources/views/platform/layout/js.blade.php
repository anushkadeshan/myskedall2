	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.css" integrity="sha512-J5tsMaZISEmI+Ly68nBDiQyNW6vzBoUlNHGsH8T3DzHTn2h9swZqiMeGm/4WMDxAphi5LMZMNA30LvxaEPiPkg==" crossorigin="anonymous" />
	
	<script src="{{asset('platform/objects/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('platform/objects/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('platform/objects/plugins/multiselect/bootstrap-multiselect.js')}}"></script>
    <script src="{{asset('platform/funcoes.js')}}"></script>
    <script src="{{asset('js/moment.js')}}"></script>
	<script src="{{asset('js/datetime-picker.js')}}" type="text/javascript"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

	<script>

		function sharePlay() {
			$('#modalPlay').modal();
		}

		function shareSite() {
			$('#modalSite').modal();
		}

		function shareEmail() {
			$('#modalEmail').modal();
			setTimeout(function() {
				$('#txShareEmail').select();
			}, 500);
		}

		function sobre() {
			var info = '';
			try {
				info = Android.appInfo();
			} catch (e) {}
			var res = info.split(";");
			$('#dvVersao').html(res[0]);
			$('#modalSobre').modal();
		}
    </script>
	<script src="{{asset('platform/objects/plugins/mobile/jquery.mobile-events.min.js')}}"></script>
	<script>
		var sWait = '<i class="fa fa-refresh fa-spin"></i>&nbsp;&nbsp;processando...';
		$(window).on('swiperight', function(e, touch) {
				exibirMenuLateral('swiperight', touch);
			})
			.on('swipeleft', function(e, touch) {
				exibirMenuLateral('swipeleft', touch);
			})
			.on('tap', function(e, touch) {
				exibirMenuLateral('tap', touch);
			});

		var mnLateral = false;

		function exibirMenuLateral(eventName, touch, forcar = false) { //console.log(touch);
			var x = 0;
			var y = 0;
			if (!forcar) {
				try {
					x = touch.startEvnt.offset.x;
				} catch (e) {}
			}
			if (!forcar) {
				try {
					y = touch.startEvnt.offset.y;
				} catch (e) {}
			}
			if (eventName == 'swiperight' && x <= 100) {
				mnLateral = true;
				$('#idMenuLateral').addClass('menuLateralHover');
			}
			if (eventName == 'swipeleft' && x <= 200) {
				mnLateral = false;
				$('#idMenuLateral').removeClass('menuLateralHover');
			}
			if (eventName == 'swipeleft' && x <= 200) {
				mnLateral = false;
				$('#idMenuLateral').removeClass('menuLateralHover');
			}
			if (y < 280 && x > 50 && (eventName == 'swiperight' || eventName == 'swipeleft')) {
				if ('home.php' == 'home.php') {
					//mudarTabMenu(eventName);
				}
			}
		}

		function mudarMenuLateral() {
			if (mnLateral) {
				exibirMenuLateral('swipeleft', 0, true);
			} else {
				exibirMenuLateral('swiperight', 0, true);
			}
		}

		var flagSair = false;
		function androidVoltar() {
			var modal = '';
			$.each($('.modal'), function() {
				if ($(this).is(':visible')) {
					modal = this.id;
				}
			});
			if (modal != '') {
				$('#' + modal).modal('hide');
			} else {
				var page = location.href.split("/").slice(-1)
				if (flagSair) {
					try {
						Android.finalizaApp();
					} catch (e) {}
				} else {
					flagSair = true;
					try {
						Android.showToast('Clique novamente para sair');
					} catch (e) {}
					setTimeout(function() {
						flagSair = false;
					}, 3000);
				}
			}
		}

	</script>
	<script>
		function UrlRedirect(url){
			window.location.href=url;
		}
		$('#datepicker').datepicker({
			uiLibrary: 'bootstrap4',
			format: 'yyyy-mm-dd'
		});
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		function Alert(message, type="") {
			if (type == 'success') {
				$('#dvAlerta').html('<div class="alert alert-success" role="alert" style="margin:0px; padding:10px;"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ' + message + '</div>');
			} else if (type == 'warning') {
				$('#dvAlerta').html('<div class="alert alert-warning" role="alert" style="margin:0px; padding:10px;"><i class="fa fa-exclamation" aria-hidden="true"></i>&nbsp;&nbsp;' + message + '</div>');
			} else if (type == 'wait') {
				$('#dvAlerta').html('<table width="100%" align="center"><tr><td style="padding:10px; color:#333333;"><i class="fa fa-refresh fa-spin"></i>&nbsp;&nbsp;' + message + '</td></tr></table>');
			} else {
				$('#dvAlerta').html('<div class="alert alert-danger" role="alert" style="margin:0px; padding:10px;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> ' + message + '</div>');
			}
			$('#dvAlerta').show();
			setTimeout(function() {
				$('#dvAlerta').hide();
			}, 3000);
		}

		@if(!empty($spaceAlert) && $spaceAlert>0 && $user->level==1 && !session('isAlertRead')==1)

			$('#ModalUnreadAlert').modal('show');
			@php
			session(['isAlertRead' => 1])
			@endphp

		@endif
		function SendGroupRequest(groupId){
			$.ajax({
				type: 'GET',
				url: BaseUrl+'/send-group-request/'+groupId,
				success: function(response) {
					if(response['status']=='success'){
						Alert(response['message'], 'success');
						setTimeout(function() {
							location.reload();
						}, 2000);
					}else{
						Alert(response['message'], 'danger');
					}
				}
			});
		}
		function ChangePassword(){
			var old_password=$('#current-password').val();
			var new_password=$('#new-password').val();
			var confirm_password=$('#confirm-password').val();
			var form={
					old_password:old_password,
					new_password:new_password,
					confirm_password:confirm_password
				}
			if(new_password==confirm_password){
				$.ajax({
					type: 'POST',
					url: BaseUrl+'/change-password',
					data:form,
					success: function(response) {
						console.log(response);
						if(response['status']=='success'){
							Alert(response['message'], 'success');
							setTimeout(function() {
								location.reload();
							}, 2000);
						}else{
							Alert(response['message'], 'danger');
						}
					}
				});
			}else{
				Alert('New Password And Confirm Password Not Match', 'danger');
			}
		}
		function PhotoUpload(){
			var file = $('#txFotoFile')[0].files;
			if(file.length>0){
				var formData = new FormData();
				formData.append('files', $('#txFotoFile')[0].files[0]);
				$.ajax({
					url: BaseUrl + "/change-profile-photo",
					method: 'POST',
					dataType: "json",
					data: formData,
					contentType: false,
					processData: false,
					cache: false,
					async: false,
					success: function(response) {
						if(response['status']=='success'){
							Alert(response['message'], 'success');
							setTimeout(function() {
								location.reload();
							}, 2000);
						}else{
							Alert(response['message'], 'danger');
						}
					}
				});
			} else {
				Alert('The Image field is Required', 'danger');
			}
		}
		function ShareLinkOnEmail(){
			var email = $('#share-by-email').val();
			if(email!=""){
				$.ajax({
					type: 'POST',
					url: BaseUrl+'/to-share-email',
					dataType: "json",
					data:{
						email:email,
					},
					success: function(response) {
						if(response['status']=='success'){
							Alert(response['message'], 'success');
							setTimeout(function() {
								location.reload();
							}, 2000);
						}else{
							Alert(response['message'], 'danger');
						}
					}
				});
			}else {
				Alert('The Email field is Required', 'danger');
			}
		}
		function SubmitContactReport(){
			var subject = $('#txt-support-subject').val();
			var message = $('#txt-support-message').val();
			var module = $('#txt-support-module').val();
			if(message!=""){
				$.ajax({
					type: 'POST',
					url: BaseUrl+'/help-contact-report',
					dataType: "json",
					data:{
						'subject':subject,
						'module':module,
						'message':message
					},
					success: function(response) {
						if(response['status']=='success'){
							Alert(response['message'], 'success');
							setTimeout(function() {
								location.reload();
							}, 2000);
						}else{
							Alert(response['message'], 'danger');
						}
					}
				});
			}else{
				Alert('Message Field Required', 'danger');
			}
		}
		function DeleteConfirm(url){
			$('#DeleteUrlLink').attr('href',url);
			$('#DeleteConfirmModel').modal('show');
		}
	</script>
	<script>
	@if(!empty($page) && $page=='AdminSpaceRequest')
		
		var address = '{{$address}}';
		$('#showRequests').DataTable( {
			ajax: {
				url:BaseUrl+'/admin/space-requests',
				type:'POST',
				datatype:'json',
				data: {
					address : address,
				},
            },
            "oLanguage": {
            	"sSearch": "{{ __('msg.search') }}"
            },
			"language": {
				"paginate": {
					"previous": "{{__('msg.previous')}}",
					"next": "{{__('msg.next')}}",
					
				},
				"info": "{{__('msg.Showing _START_ to _END_ of _TOTAL_ entries')}}",
			},
			"pageLength":7,
			"pagingType": "simple",
			"lengthChange": false,
			"ordering": false,
            "serverSide": true,

            "columns": [
				{ "data": "initial_date",'render':function(initial_date){
						return	moment(initial_date).format('DD-MMMM-YYYY')
					}
				},
				{ "data":function(data){
						return	moment(data.initial_date+' '+data.initial_time).format('h:m A');
					} },
				{ "data": "events" },
				{ "data": "space" },
				{ "data":function(data){
						if(data.status=='0' || data.status=='1'){
							return	'<img id="status-icon-'+data.id+'" src="{{asset("img/confused.png")}}" style="width:20px;">';
						}else if(data.status=='2' && data.is_repproved=='1'){
							return	'<img id="status-icon-'+data.id+'" src="{{asset("img/sad.png")}}" style="width:20px;">';
						}else{
							return	'<img id="status-icon-'+data.id+'" src="{{asset("img/smiling-green.png")}}" style="width:20px;">';
						}
					}
				},{
					"data":function(data){
						var status=data.status;
						var reapproved=data.is_repproved;
						var select =  '<select onchange="isApproveRequest('+data.id+',this.value)">';
						if(status=='0'){
							select+='<option value="0" selected >{{ __('msg.pending') }}</option>';
						}else{
							select+='<option value="0" >{{ __('msg.pending') }}</option>';
						}
						if(status=='1'){
							select+='<option value="1" selected>{{ __('msg.reject') }}</option>';
						}else{
							select+='<option value="1">{{ __('msg.reject') }}</option>';
						}
						if(status=='2' && reapproved=='0'){
							select+='<option value="2" selected >{{ __('msg.approve') }}</option>';
						}else{
							select+='<option value="2">{{ __('msg.approve') }}</option>';
						}
						if(status=='2' && reapproved=='1'){
							select+='<option value="2" selected >{{ __('msg.repprove') }}</option>';
						}else{
							select+='<option value="2" >{{ __('msg.repprove') }}</option>';
						}
						select+='</select>';
						return select;
					}
				},{
					"data":function(data){
						return '<a href="{{url("admin/edit-space-request")}}/'+data.id+'"><i class="fa fa-pencil"></i></a>'+
						'<a onclick="ShareSpaceRequest('+data.id+')" style="margin-left:5px;"><i class="fa fa-share-alt"></i></a>';
					}
				}
			]
		});
		function isApproveRequest(id,status){
			$.ajax({
				type: 'POST',
				url: BaseUrl+'/admin/is-approve-space-request',
				dataType: "json",
				data:{
					'id':id,
					'status':status
				},
				success: function(response) {
					if(response['status']=='success'){
						var status = response['data']['status'];
						var is_repproved = response['data']['is_repproved'];
						if(status=='0' || status=='1'){
							$('#status-icon-'+id).attr('src','{{asset("img/confused.png")}}');
						}else if(status=='2'&& is_repproved=='0'){
							$('#status-icon-'+id).attr('src','{{asset("img/smiling-green.png")}}');
						}else{
							$('#status-icon-'+id).attr('src','{{asset("img/sad.png")}}');
						}
						Alert(response['message'], 'success');
					}else{
						Alert(response['message'], 'danger');
					}
				}
			});
		}
		function ShareSpaceRequest(id){
			$('#ShareSpaceRequest').modal('show');
			$('#share-request-id').attr('value',id);
		}
		function ShareSpaceRequestEmail(){
			var id=$('#share-request-id').val();
			var email=$('#share-request-email').val();
			$.ajax({
				type: 'POST',
				url: BaseUrl+'/admin/share-space-request',
				dataType: "json",
				data:{
					'id':id,
					'email':email
				},
				success: function(response) {
					if(response['status']=='success'){
						Alert(response['message'], 'success');
						setTimeout(function() {
							location.reload();
						});
					}else{
						Alert(response['message'], 'danger');
					}
				}
			});
		}
	@endif

	@if(!empty($page) && $page=="AdminAlertList")
		$('#showAlertList').DataTable({

			ajax: {
				url:BaseUrl+'/admin/alert-management',
				type:'POST',
				datatype:'json'
			},
			
            "oLanguage": {
            "sSearch": "{{ __('msg.search') }}: "
            },
			"language": {
				"paginate": {
					"previous": "{{__('msg.previous')}}",
					"next": "{{__('msg.next')}}",
					
				},
				"info": "{{__('msg.Showing _START_ to _END_ of _TOTAL_ entries')}}",
			},
			"pageLength":7,
			"pagingType": "simple",
			"lengthChange": false,
			"ordering": false,
			"serverSide": true,
            "columns": [
				{"data":function(data){
                    var date = moment(data.created_at).format('L');
					return date;

				}},
				{"data":"event_name"},
				{"data":"group_name"},
				{"data":"routine"},
				{"data":function(data){
                    return '<a onclick="requestorModel('+data.user+')" href="javascript:void(0)" >'+data.requester+'</a>';
						requestorModel(data.user);
                }},
				{"data":function(data){
					if(data.is_read==0){

                        return '<a class="badge badge-secondary" style="background-color:orange" onClick="markAlertAsSuccess('+data.id+')">Pending</a>';

					}else{
						return '<a class=badge badge-success" style="background-color:green">Success</a>';
					}
				}}
			]
        });

		function requestorModel(id){
			 var url = '{{url("/")}}';
			$.ajax({
				url: BaseUrl+'/user-data/'+id,
				dataType: "json",
				success: function(response) {
					$('#requestorName').html(response.data.name);
					$('#requestorEmail').html(response.data.email);
					$('#requestorPhone').html(response.data.phone);
				$('#requestor').modal('show');
					


				}
				//alert(BaseUrl);

			});

		}

        function markAlertAsSuccess(id){
            var SITE_URL = '{{ url('/') }}';
            $.ajax({
				type: 'POST',
				url: BaseUrl+'/admin/mark-alert-success',
				dataType: "json",
				data:{
					'id':id,
                },

                success: function(response) {

                    var base_url = window.location.origin;
                    var url = SITE_URL+'/'+response.url;

                    window.location = url;
				}

			});
        }
	@endif
	@if(!empty($page) && $page=="AdminOrganizationManagement")
		$('#event-list').DataTable( {
			ajax: {
				url:BaseUrl+'/admin/organization-list',
				type:'POST',
				datatype:'json'
			},
			"oLanguage": {
            	"sSearch": "{{ __('msg.search') }}: "
            },
			"language": {
				"paginate": {
					"previous": "{{__('msg.previous')}}",
					"next": "{{__('msg.next')}}",
					
				},
				"info": "{{__('msg.Showing _START_ to _END_ of _TOTAL_ entries')}}",
			},
			"pageLength":7,
			"pagingType": "simple",
			"lengthChange": false,
			"ordering": false,
			"serverSide": true,
            "columns": [
				{"data":"id"},
				{"data":"title"},
				{"data":"name"},
				{"data":function(data){
					return	data.username+"<br>"+moment(data.updated_at).format('DD-MMMM-YYYY h:m A')
				}},
				{"data":function(data){
						var status=data.status;
						var select =  '<select onchange="IsStatusOrganization('+data.id+',this.value)">';
						if(status=='1'){
							select+='<option value="1" selected>Active</option>';
						}else{
							select+='<option value="1">Active</option>';
						}
						if(status=='0'){
							select+='<option value="0" selected>Block</option>';
						}else{
							select+='<option value="0">Block</option>';
						}
						select +='</select>';
						return select;
					}
				},
				{"data":function(data){
					return '<a href="{{url("admin/edit-organization")}}/'+data.id+'"><i class="fa fa-pencil"></i></a>'+
					'<a style="margin-left:5px;color:red" onclick="DeleteConfirm(`{{url("admin/delete-organization")}}/'+data.id+'`)"><i class="fa fa-trash"></i></a>';
				}}
			]
		});
		function IsStatusOrganization(id,status){
			$.ajax({
				type: 'POST',
				url: BaseUrl+'/admin/change-organization-status',
				dataType: "json",
				data:{
					'id':id,
					'status':status
				},
				success: function(response) {
					if(response['status']=='success'){
						Alert(response['message'], 'success');
					}else{
						Alert(response['message'], 'danger');
					}
				}
			});
		}
	@endif
	@if(!empty($page) && $page=='AdminReasonRequest')
		$('#showReasonlist').DataTable( {
			ajax: {
				url:BaseUrl+'/admin/reason-management',
				type:'POST',
				datatype:'json'
            },
            "oLanguage": {
            	"sSearch": "{{ __('msg.search') }}: "
            },
			"language": {
				"paginate": {
					"previous": "{{__('msg.previous')}}",
					"next": "{{__('msg.next')}}",
					
				},
				"info": "{{__('msg.Showing _START_ to _END_ of _TOTAL_ entries')}}",
			},
			"pageLength":7,
			"pagingType": "simple",
			"lengthChange": false,
			"ordering": false,
			"serverSide": true,
            "columns": [
				{"data":"id"},
				{"data":"reason"},
				{"data":function(data){
					return	data.name+"<br>"+moment(data.updated_at).format('DD-MMMM-YYYY h:m A')
				}},
				{"data":function(data){
						var status=data.status;
						var select =  '<select onchange="IsStatusReasonChange('+data.id+',this.value)">';
						if(status=='1'){
							select+='<option value="1" selected>{{ __('msg.active') }}</option>';
						}else{
							select+='<option value="1">{{ __('msg.active') }}</option>';
						}
						if(status=='0'){
							select+='<option value="0" selected>{{ __('msg.block') }}</option>';
						}else{
							select+='<option value="0">{{ __('msg.block') }}</option>';
						}
						select +='</select>';
						return select;
					}
				},
				{"data":function(data){
					return '<a href="{{url("admin/edit-reason")}}/'+data.id+'"><i class="fa fa-pencil"></i></a>'+
				'<a style="margin-left: 10px;color:red" onclick="DeleteConfirm(`{{url("admin/delete-reason")}}/'+data.id+'`)"><i class="fa fa-trash"></i></a>';
				}}
			]
		});
		function IsStatusReasonChange(id,status){
			$.ajax({
				type: 'POST',
				url: BaseUrl+'/admin/change-reason-status',
				dataType: "json",
				data:{
					'id':id,
					'status':status
				},
				success: function(response) {
					if(response['status']=='success'){
						Alert(response['message'], 'success');
					}else{
						Alert(response['message'], 'danger');
					}
				}
			});
		}
	@endif
	@if(!empty($page) && $page=='LocationManagement')
		
		

		$('#showLocationlist').DataTable( {
			ajax: {
				url:BaseUrl+'/admin/location-management',
				type:'POST',
				datatype:'json'
            },
            "oLanguage": {
            	"sSearch": "{{ __('msg.search') }}: "
            },
			"language": {
				"paginate": {
					"previous": "{{__('msg.previous')}}",
					"next": "{{__('msg.next')}}",
					
				},
				"info": "{{__('msg.Showing _START_ to _END_ of _TOTAL_ entries')}}",
			},
			"pageLength":7,
			"pagingType": "simple",
			"lengthChange": false,
			"ordering": false,
			"serverSide": true,
            "columns": [
                {"data":"id"},
                {"data":"name"},
                {"data":"address"},
                {"data":"quantity"},	
				{"data":function(data){
					@can('Change Location Status')
					if(data.status==1){
						var checkid = "someCheckboxId"+data.id;
						$('#someCheckboxId'+data.id).prop('checked', true);
					}
					return '<div class="icheck-primary"><input onclick="status(this,'+data.id+')" type="checkbox" id="someCheckboxId'+data.id+'"/><label for="someCheckboxId'+data.id+'"></label></div>';
					@else
						if(data.status==1){
							return '<span style="float: right;font-size:12px" class="label label-success">Approved</span>'
						}
						else{
							return '<span style="float: right;font-size:12px" class="label label-danger">Not Approved</span>'
						}
					@endcan
				}},
				@can('Block Location')
				{"data":function(data){
					if(data.is_flag==0){
						return ' <a onclick="markAsBlock('+data.id+')"><i style="color:green" class="fa fa-flag"></i></a>';
					}else{
						return'<a onclick="markAsUnblock('+data.id+')"><i style="color:red" class="fa fa-flag"></i></a>';
					}
				}},
				@endcan
				{"data":function(data){
					@hasrole('Module Admin')
						
					if(data.status==0){
						return '<a id="view" href="{{url("admin/view-location")}}/'+data.id+'"><i class="fa fa-eye"> </i></>' +
						       '<a id="edit" href="{{url("admin/edit-location")}}/'+data.id+'"> &nbsp<i class="fa fa-pencil"></i></>';
					}
					else{
						return '<a id="view" href="{{url("admin/view-location")}}/'+data.id+'"> <i class="fa fa-eye"> </i></>';
					}
					@endhasrole
					@hasanyrole('Local Admin|Super Admin')
						return '<a id="edit" href="{{url("admin/edit-location")}}/'+data.id+'"><i class="fa fa-pencil"></i></>'+
							   '<a id="view" href="{{url("admin/view-location")}}/'+data.id+'"><i class="fa fa-eye"></i></>'+
							   '<a style="margin-left: 10px;" id="delete" onclick="DeleteConfirm(`{{url("admin/delete-location")}}/'+data.id+'`)"><i class="fa fa-trash"></i></a>';
					@endhasanyrole
										

				}}
			]
		});

		function status(a,id) {
            var value   = a.checked; //crossbrowser solution =)
            $.ajax({
				type: 'POST',
				url: BaseUrl+'/admin/change-location-status',
				dataType: "json",
				data:{
					'value':value,
					'id':id
				},
				success: function(response) {
					if(response['status']=='success'){
						Swal.fire({
							text: response['message'],
							icon: 'success',
							toast: true,
							position : 'top-end',
            				showConfirmButton : false,
							timer: 3000
							});
					}else{
						Swal.fire({
							text: response['message'],
							icon: 'error',
							toast: true,
							position : 'top-end',
            				showConfirmButton : false,
							timer: 3000
						});
					}
				}
			});
    	}
		function markAsBlock(id){
			
			$('#markAsBlock').modal('show');
			$('#location_id1').attr('value',id);


		}

		function markAsUnblock(id){
			$('#markAsUnblock').modal('show');
			$('#location_id2').attr('value',id);
		}


		$('#showLocationlist tbody').on('click', 'tr td:eq(1)', function () {
			var table = $('#showLocationlist').DataTable();
			var data = table.row( this ).data();
		} );

	
	@endif
    @if(!empty($page) && $page=='ExternalLocation')
		$('#showExternalLocationList').DataTable( {
			ajax: {
				url:BaseUrl+'/admin/external-location',
				type:'POST',
				datatype:'json'
            },
            "oLanguage": {
            	"sSearch": "{{ __('msg.search') }}: "
            },
			"language": {
				"paginate": {
					"previous": "{{__('msg.previous')}}",
					"next": "{{__('msg.next')}}",
					
				},
				"info": "{{__('msg.Showing _START_ to _END_ of _TOTAL_ entries')}}",
			},
			"pageLength":7,
			"pagingType": "simple",
			"lengthChange": false,
			"ordering": false,
			"serverSide": true,
            "columns": [
				{"data":"id"},
				{"data":"location_type"},
				{"data":function(data){
					return '<a href="{{url("admin/edit-external-location")}}/'+data.id+'"><i class="fa fa-pencil"></i></a>'+
				'<a style="margin-left: 10px;" onclick="DeleteConfirm(`{{url("admin/delete-external-location")}}/'+data.id+'`)"><i class="fa fa-trash"></i></a>';
				}}
			]
		});
    @endif

    @if(!empty($page) && $page=='AdminSupportList')
		$('#showAdminSupportList').DataTable( {
			ajax: {
				url:BaseUrl+'/admin/supports',
				type:'POST',
				datatype:'json'
            },
            "oLanguage": {
            	"sSearch": "{{ __('msg.search') }}: "
            },
			"language": {
				"paginate": {
					"previous": "{{__('msg.previous')}}",
					"next": "{{__('msg.next')}}",
					
				},
				"info": "{{__('msg.Showing _START_ to _END_ of _TOTAL_ entries')}}",
			},
			"pageLength":7,
			"pagingType": "simple",
			"lengthChange": false,
			"ordering": false,
            "serverSide": true,

            "columns": [
				{"data":"id"},
				{"data":"name"},
				{"data":"category"},
				{"data":"module"},
				{"data":"message"},
					@hasanyrole('Super Admin|Local Admin')
						
							{"data":function(data){
								var status = "";
								if(data.status=="0"){
									status = "Pending";
								}
								if(data.status=="1"){
									status = "WIP";
								}
								if(data.status=="2"){
									status = "Cancled";
								}
								if(data.status=="3"){
									status = "Finished";
								}
								return status;
							}},
							{"data":"solution"},
							{"data":"date_of_solution"},
							{"data":function(data){
								return '<a href="{{url("admin/edit-support")}}/'+data.id+'"><i class="fa fa-pencil"></i></a>'+
							'<a style="margin-left: 10px;" onclick="DeleteConfirm(`{{url("admin/delete-support")}}/'+data.id+'`)"><i class="fa fa-trash"></i></a>';
							}}
						
					@endhasanyrole
			]
        });

    @endif

    @if(!empty($page) && $page=='GroupRequests')

    $(document).ready(function(){
        fetch_group_data();
        function fetch_group_data(query = ''){
            $('#alert').hide();
            $.ajax({
            type : 'get',
            _token:"{{ csrf_token() }}",
            url : '{{route('group-requests')}}',
            data:{query:query},
                success:function(data){
                    $('#groupRequests tbody').html(data);
                    if(data.length==0){
                        $('#alert').show();
                    }

                }
            });
        }

        $(document).on('keyup', '#search-group-requests', function(){
            var query = $(this).val();
            fetch_group_data(query);
        });
    });

    function fetch_group_data(query = ''){
        $('#alert').hide();
        $.ajax({
        type : 'get',
        _token:"{{ csrf_token() }}",
        url : '{{route('group-requests')}}',
        data:{query:query},
            success:function(data){
                $('#alert').hide();
                $('#groupRequests tbody').html(data);
                $('#search-group-requests').val('');
                if(data.length==0){
                    $('#alert').show();
                }

            }
        });
    }

    function accept(id){
        //var id = $(this).data("id");
        var url = "{{route("accept-group-request", "id")}}";
        url = url.replace('id', id);
        $.ajax({
        type : 'get',
        url : url,
            success:function(){
                $('#alert').hide();
                $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                $("#success-alert").slideUp(500);
                });
                fetch_group_data();
            }
        });
    }

    function reject(id){
        //var id = $(this).data("id");
        var url = "{{route("reject-group-request", "id")}}";
        url = url.replace('id', id);
        $.ajax({
        type : 'get',
        url : url,
            success:function(){
                $('#alert').hide();
                $("#success-alert2").fadeTo(2000, 500).slideUp(500, function() {
                $("#success-alert2").slideUp(500);
                });
                fetch_group_data();
            }
        });
    }
    @endif
    @if(!empty($page) && $page=='AdminOrganizationList')
		$('#group-list').DataTable( {
			ajax: {
				url:BaseUrl+'/admin/group-list',
				type:'POST',
				datatype:'json'
            },

			"pageLength":7,
			"pagingType": "simple",
			"lengthChange": false,
			"ordering": false,
            "serverSide": true,
            "oLanguage": {
            	"sSearch": "{{ __('msg.search') }}: "
            },
			"language": {
				"paginate": {
					"previous": "{{__('msg.previous')}}",
					"next": "{{__('msg.next')}}",
					
				},
				"info": "{{__('msg.Showing _START_ to _END_ of _TOTAL_ entries')}}",
			},
            "columns": [
				{"data":"group_id"},
				{"data":"name"},
				{"data":"address"},
				{"data":"phone"},
				{"data":function(data){
					return '<a href="{{url("admin/edit-group")}}/'+data.group_id+'"><i class="fa fa-pencil"></i></a>'+
				'<a style="margin-left: 10px;" onclick="DeleteConfirm(`{{url("admin/delete-group")}}/'+data.group_id+'`)"><i class="fa fa-trash"></i></a>';
				}}
			]
        });

    @endif
	</script>
