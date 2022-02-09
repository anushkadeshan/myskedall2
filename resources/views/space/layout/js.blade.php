	<script src="{{asset('platform/objects/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('platform/objects/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('platform/objects/plugins/multiselect/bootstrap-multiselect.js')}}"></script>
    <script src="{{asset('platform/funcoes.js')}}"></script>
	<script src="{{asset('js/datetime-picker.js')}}" type="text/javascript"></script>
	<script src="{{asset('js/moment.js')}}"></script>
	<script src="{{asset('js/clockpicker.min.js')}}"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-pageLoadMore/1.0.0/js/dataTables.pageLoadMore.min.js"></script>
	<link rel="stylesheet" href="{{asset('css/clockpicker.min.css')}}">

	<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$('#datepicker1').datepicker({
			uiLibrary: 'bootstrap4',
			format: 'yyyy-mm-dd'
		});
		$('#datepicker2').datepicker({
			uiLibrary: 'bootstrap4',
			format: 'yyyy-mm-dd'
		});
		$('#timepicker1').timepicker({
			uiLibrary: 'bootstrap4',
			format: 'HH:mm'
		});
		$('#timepicker2').timepicker({
			uiLibrary: 'bootstrap4',
			format: 'HH:mm'
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
		function OpenReuseRequestModel(url){
			$("#edit-space-request-attr").attr("href",url);
			$('#ModelSpaceRequest').modal('show');
		}
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

		function getLocationAjax(id=""){
			$.ajax({
				url: BaseUrl + "/get-request-location",
				method: 'POST',
				dataType: "json",
				data:{'id':id},
				success: function(response) {
					if(response['status']=='success'){
						$('#select-space-location').html('');
						$('#select-space-location').html(response['data']);
					}else{
						$('#select-space-location').html('');
						$('#select-space-location').html('<option value="">Select Location</option>');
						Alert(response['message'], 'danger');
					}
				}
			});
		}
		@if(!empty(old('locationjson')) || !empty($locationjson))
			var locationJson=JSON.parse($('#locationjson').val());
			getLocationAjax(locationJson.id);
		@else
			getLocationAjax();
		@endif

		@if(session('space_alert'))
			$('#ModelId12').modal('show');
        @endif

        @if(session('sapce_success')=='yes')
			$('#successModel').modal('show');
		@endif

		function SaveRequestPriority(){
			var alert_message="{{session('message')}}";
			var space_message="{{session('space_alert')}}";
			var manager="{{session('manager')}}";
            var request_data="{{session('space_data')}}";
			var url = "{{url('app/space/12')}}"
			space_message=space_message.replace(/&quot;/g,'"');
            request_data=request_data.replace(/&quot;/g,'"');
            //console.log(request_data);
			$.ajax({
				url: BaseUrl + "/SaveRequestPriority",
				method: 'POST',
				data: {'alert_message':alert_message,'description':space_message,'manager':manager,'request_data':request_data},
				success: function(response) {
					if(response['status']=='success'){
						$('#ModelId12').modal('hide');
						Alert(response['message'], 'warning');
						setTimeout(function(){
							window.location = url;
						},2500);
						//window.reload();
					}else{
						Alert(response['message'], 'danger');
					}
				}
			});
		}
		function CheckRuleClick(){
			var check = $('#fill-click-value').val();
			if(check==""){
				$('#UserAgreement').modal('show');
			}

			//$('#fill-click-value').val('checked');
			//$('#rules-of-use').attr('class','btn btn-success form-control');
		}

		function acceptAgreement(){
			$('#fill-click-value').val('checked');
			$('#rules-of-use').attr('class','btn btn-success form-control');
			$('#UserAgreement').modal('hide');

		}
		function RequestSpace(){
			var check = $('#fill-click-value').val();

			$('#SubmitConfirmModel').modal('show');

		}
		$(document).ready(function(){
			var location_id = '{{session('location_id')}}';
			$.ajax({
				url: BaseUrl + "/get-location",
				method: 'GET',
				data: {'locationid':location_id,},
				success: function(response) {
					//console.log(response);
					var photo = response.location['photos'].split(',');
					$("#location_img").attr('src',"{{asset('_dados/plataforma/location/images')}}/"+photo[0]);
					$('#location_title').html(response.location['name']);
					$('#location_address').html(response.location['address']);
					$('#location_contact').html(response.location['contact']);
					$('#location_telephone').html(response.location['telephone']);
					$('#location_people').html(response.location['total_people']);
					$('#location_size').html(response.location['size']);
					$('#location_price').html(response.location['price']);
					$('#location_area_type').html(response.location['area_type']);
					$('#location_air').html(response.location['air_conditioner']);
					$('#location_parking').html(response.location['parking']);
                    $("#location_card").css("display", "block");
					$("#seemore").attr('href',"{{url('/admin/view-location/')}}/"+response.location['id']);
				}
			});
			 
		});
		function CheckPriceByLocation(){
			document.getElementById("rules").innerHTML = "";
			var locationid = $('#space-location').val();
            var price=$('#exact-price').val();

			$.ajax({
				url: BaseUrl + "/get-price-by-location",
				method: 'POST',
				data: {'locationid':locationid,'price':price},
				success: function(response) {
					$.each(response.rules,function(key,value){
							var abc = value.rules_documents;
						    var url = HomeUrl+'/_dados/plataforma/location/rules/'+abc;
						   //$("#rules").html("");
							var element='<div class="elem">'+
								' <span>Rule Name : '+value.rule_name+'</span> |'+
								' <span><a target="_blank" href="'+url+'">View Document</a></span></div> ';
							$('#rules').append(element); //append it to anywhere in DOM using selector
						});
					console.log(response.location['photos'].split(','));
					var photo = response.location['photos'].split(',');

					
					//console.log(photo[0]);
					$("#location_img").attr('src',"{{asset('_dados/plataforma/location/images')}}/"+photo[0]);

					$('#location_title').html(response.location['name']);
					$('#location_address').html(response.location['address']);
					$('#location_contact').html(response.location['contact']);
					$('#location_telephone').html(response.location['telephone']);
					$('#location_people').html(response.location['total_people']);
					$('#location_size').html(response.location['size']);
					$('#location_price').html(response.location['price']);
					$('#location_area_type').html(response.location['area_type']);
					$('#location_air').html(response.location['air_conditioner']);
					$('#location_parking').html(response.location['parking']);
                    $("#location_card").css("display", "block");
					$("#seemore").attr('href',"{{url('/admin/view-location/')}}/"+response.location['id']);
					if(response['status']=='success'){
						//Alert('Exact Price of selected location is '+response['price'], 'warning');
						var array={'id':locationid,'text':$('#space-location :selected').text()}
                        $('#locationjson').val(JSON.stringify(array));
                        $('#space_manager').val(response['manager']);


                        //console.log("CheckPriceByLocation -> response['manager']", response['manager']);

						//$('#exact-price').val(response['price']);
					}else{
                        //Alert(response['message'], 'danger');
                        $('#space_manager').val(response['manager']);
                        //console.log("CheckPriceByLocation -> response['manager']", response['manager']);

					}
				}
			});
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
		/* var typingTimer;
		var doneTypingInterval = 1000;
		$('#searchkey').on('keyup', function () {
		  clearTimeout(typingTimer);
			$('#pageoffset').val(0);
			$('#show-space-requests-table').html('');
			typingTimer = setTimeout(ShowRequests,doneTypingInterval);
		}); */
		/* function ShowRequests(){
			var run=1;
			var offset=$('#pageoffset').val();
			var search=$('#searchkey').val();
			if(search!="" && search.length<3){
				run=0;
			}
			if(run){
				$.ajax({
					type: 'POST',
					url: BaseUrl+'/show-space-requests',
					data:{
						_token:csrf_token,
						keyword:search,
						offset:offset,
						routename:$('#route-name').val()
					},
					success: function(response) {
						//$('#show-space-requests-table').html('');
						var offsetvalue=parseInt(offset)+1;
						$('#pageoffset').val(offsetvalue);
						$('#show-space-requests-table').append(response);
					}
				});
			}
		} */
		/* //on keydown, clear the countdown
		$('#searchkey').on('keydown', function () {
		  clearTimeout(typingTimer);
		});
		ShowRequests(); */
		@if(!empty($routename))
		var search=true;
		@else
			var search=true;
		@endif
		var routename = $('#route-name').val();
		console.log(routename);
		$('#showSpaceRequests').DataTable( {
			ajax: {
				url:BaseUrl+'/show-space-requests?routename='+routename,
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
			"columnDefs": [ {
				"targets": 5,
				"orderable": false
				} ],
			"pageLength":7,
			"pagingType": "simple",
			"searching": search,
			"info": true,
			"lengthChange": false,
			"processing": true,
			"ordering": true,
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
					if(data.is_draft==1){
						return	'<img id="status-icon-'+data.id+'" src="{{asset("img/draft.png")}}" style="width:20px;">';
					}
					else{
						if(data.status=='0' || data.status=='1'){
							return	'<img id="status-icon-'+data.id+'" src="{{asset("img/confused.png")}}" style="width:20px;">';
						}else if(data.status=='2' && data.is_repproved=='1'){
							return	'<img id="status-icon-'+data.id+'" src="{{asset("img/sad.png")}}" style="width:20px;">';
						}else{
							return	'<img id="status-icon-'+data.id+'" src="{{asset("img/smiling-green.png")}}" style="width:20px;">';
						}
					}
					}, "orderable": false
				},{
					"data":function(data){
						return '<i onclick="RedirectUrl(`{{url("space/edit-request")}}/'+data.id+'`)" class="fa fa-pencil"></i>';
					}
				}
			]
		});

		function OpenRequestModel(){
			$('#ReuseRequestConfirm').modal('hide');
			$('#ModelShowRequest').modal('show');

			$('#showRequestInPopup').DataTable( {
				destroy: true,
				ajax: {
					url:BaseUrl+'/show-space-requests?routename=',
					type:'POST',
					datatype:'json'
				},"oLanguage": {
					"sSearch": "{{ __('msg.search') }}: "
				},
				"language": {
					"paginate": {
						"previous": "{{__('msg.previous')}}",
						"next": "{{__('msg.next')}}",

					},
					"info": "{{__('msg.Showing _START_ to _END_ of _TOTAL_ entries')}}",
				},
				"pageLength":10,
				"pagingType": "simple",
				"searching": false,
				"info": false,
				"lengthChange": false,
				"processing": true,
				"ordering": true,
				"serverSide": true,
				"columns": [ {
						"data":function(data){
							return '<input onclick="RedirectUrl(`{{url("space/new-request?reuse_id=")}}'+data.id+'`)" type="radio">';
						}, "orderable": false
					},
					{ "data": "initial_date",'render':function(initial_date){
							return	moment(initial_date).format('DD-MMMM-YYYY')
						}, "orderable": false
					},
					{ "data":function(data){
							return	moment(data.initial_date+' '+data.initial_time).format('h:m A');
						}, "orderable": false },
					{ "data": "events", "orderable": false },
					{ "data": "space", "orderable": false },
					{ "data":function(data){
							if(data.status=='0' || data.status=='1'){
								return	'<img id="status-icon-'+data.id+'" src="{{asset("img/confused.png")}}" style="width:20px;">';
							}else if(data.status=='2' && data.is_repproved=='1'){
								return	'<img id="status-icon-'+data.id+'" src="{{asset("img/sad.png")}}" style="width:20px;">';
							}else{
								return	'<img id="status-icon-'+data.id+'" src="{{asset("img/smiling-green.png")}}" style="width:20px;">';
							}
						}, "orderable": false
					}
				]
			});
		}
		function RedirectUrl(url){
			window.location.href=url;
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
                        console.log("ShareSpaceRequestEmail -> response", response);

					}
				}
			});
        }

        function ShareSpaceRequest(id){
            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                $('#ShareSpaceRequest_mobile').modal('show');
            }
            else{
                $('#ShareSpaceRequest_pc').modal('show');
                $('#share-request-id').attr('value',id);
            }
        }

        function SaveAsDraft(){
            var form = $('#request_form');
   				$.ajax({
   					type: 'POST',
            		url: BaseUrl + '/SaveRequestAsDraft',
            		data: form.serialize(),
            		success:function(data){
            			if($.isEmptyObject(data.error)){
			                //toastr.success('Successfull Addred information ! ', 'Congratulations', {timeOut: 5000});
			               // $("#institute")[0].reset();
            			}
			            else{
                            console.error(data.error);

			            }
            		},
            		error:function(data, jqXHR){
            			console.log(jqXHR);
            		}

   				});
        }
		var routename = $('#route-name').val();
		$('#seachSpaceRequests').DataTable( {
			ajax: {
				url:BaseUrl+'/show-space-requests?routename='+routename,
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
			"columnDefs": [{
				"targets": 5,
				"orderable": false
			}],
			"pageLength":7,
			"pagingType": "simple",
			"searching": search,
			"info": false,
			"lengthChange": false,
			"processing": true,
			"ordering": true,
			"serverSide": true,
			"search": {
				"addClass": 'form-control input-lg col-xs-12'
			},
			"language": {
				"search": "_INPUT_", // Removes the 'Search' field label
				"searchPlaceholder": "{{ __('msg.search') }}" // Placeholder for the search box
			},
			"fnDrawCallback":function(){
			$("input[type='search']").attr("id", "searchBox");
			$('#seachSpaceRequests').css('cssText', "margin-top: 0px !important;");
			$("select[name='seachSpaceRequests_length'], #searchBox").removeClass("input-sm");
			$('#searchBox').css("width", "400px").focus();
			$('#searchBox').css("height", "40px").focus();
			$('#searchBox').css("margin-left", "50px").focus();
			$('#searchBox').css("margin-right", "280px").focus();
			$('#searchBox').css("text-align", "center").focus();

			},

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
						if(data.is_draft=='1'){
							return	'Draft';
						}
						else{
							if(data.status=='0' || data.status=='1'){
								return	'<img id="status-icon-'+data.id+'" src="{{asset("img/confused.png")}}" style="width:20px;">';
							}else if(data.status=='2' && data.is_repproved=='1'){
								return	'<img id="status-icon-'+data.id+'" src="{{asset("img/sad.png")}}" style="width:20px;">';
							}
							else{
								return	'<img id="status-icon-'+data.id+'" src="{{asset("img/smiling-green.png")}}" style="width:20px;">';
							}
						}

					}, "orderable": false
				},{
					"data":function(data){
						return '<i onclick="RedirectUrl(`{{url("space/view-request")}}/'+data.id+'`)" class="fa fa-eye"></i>';
					}
				}
			]
		});

	$('.clockpicker').clockpicker()
	.find('input').change(function(){
		// TODO: time changed
		console.log(this.value);
	});
	$('#demo-input').clockpicker({
		autoclose: true
	});

	</script>
