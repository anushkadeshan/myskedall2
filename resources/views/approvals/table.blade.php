<div class="table-responsive">
    <table class="table" id="approvals-table">
        <thead>
            <tr>

                <th></th>
                <th>Initial Date</th>
                <th>Initial Time</th>
                <th>Events</th>
                <th>Reason</th>
                <th>Location</th>
                <th>Status</th>
                <th>Change Status</th>
                <th>Is Draft</th>
                <th>Is Priority</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<div class="modal fade" id="rejetReason" style="z-index:9999">
		<div class="modal-dialog" role="document" style="width:95%; max-width:500px;">
			<div class="modal-content">
                <div class="modal-body" style="text-align:left">
                    <form method="post" action="{{url('admin/update-request-reject-reason')}}">
					<div style="font-size:20px;">Give reason to Reject</div>
                    <div style="margin-top:15px; width:100%;">
                        @csrf
                        <textarea name="reason" id="reason" class="form-control" required></textarea>
                        <input type="hidden" name="request_id" id="request_id" value="">
                        <hr>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
					<br>
				</div>
			</div>
		</div>
    </div>

    <div class="modal fade" id="ShareSpaceRequest_pc" style="z-index:9999">
        <div class="modal-dialog" role="document" style="width:95%; max-width:500px;">
            <div class="modal-content">
                <div class="modal-body" style="text-align:left">
                    <div style="font-size:20px;">{{ __('msg.To Share Space Request') }}</div>
                    <div class="form-group" style="margin-top:15px; width:100%;">
                        <font style="color:#999999">{{ __('msg.Enter Your Email') }}</font>

                        <input type="text" id="share-request-email" value="" maxlength="255" class="form-control">
                        <input type="hidden" id="share-request-id" value="">
                    </div>
                    <br>

                    <button type="button" class="btn btn-success" onclick="ShareSpaceRequestEmail()"
                        style="width:90px;">{{ __('msg.submit') }}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        style="width:90px; margin-left:10px;">{{ __('msg.cancel') }}</button>
                    <div class="form-group" style="margin-top:15px; width:100%;">
                        <font style="color:#999999">{{ __('msg.or Share With') }}</font>
                        <br>
                        <br>
                        <a target="_blank" id="whatsapp" href=""
                            class="pr-5"><img src={{asset('/social/whatsapp.svg')}} height="40" alt=""></a>&nbsp&nbsp
                        <a target="_blank" id="telegram"><img

                                src={{asset('/social/telegram.svg')}} height="40" alt=""></a>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ShareSpaceRequest_mobile" style="z-index:9999">
        <div class="modal-dialog" role="document" style="width:95%; max-width:500px;">
            <div class="modal-content">
                <div class="modal-body" style="text-align:left">
                    <div style="font-size:20px;">{{ __('msg.To Share Space Request') }}</div>

                    <div class="form-group" style="margin-top:15px; width:100%;">
                        <font style="color:#999999">{{ __('msg.Share With') }}</font>
                        <br>
                        <br>

                        <a id="whatsappm" data-action="share/whatsapp/share"
                            class="pr-5"><img src={{asset('/social/whatsapp.svg')}} height="40" alt=""></a>&nbsp&nbsp
                        <a target="_blank" id="telegramm" ><img
                                src={{asset('/social/telegram.svg')}} height="40" alt=""></a>
                    </div>
                    <br>

                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        style="width:90px; margin-left:10px;">{{ __('msg.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>
@push('js')
    <script>
        $(document).ready(function(){
            var table = $('#approvals-table').DataTable({
                processing: true,
                serverSide: true,
                "ordering": false,
                'columnDefs': [
                    {
                        "targets": 8, // your case first column
                        "className": "text-center",
                        "width": "8%"
                    },
                ],
                ajax: {
                url: BaseUrl+'/admin/approvalData',
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: function(data){
                        var date = moment(data.initial_date).utc().format('MM/DD/YYYY');
                        return date;
                    }},
                    {data: 'initial_time', name: 'initial_time'},
                    {data: 'events', name: 'events'},
                    {data: 'reason', name: 'reason'},
                    {data: 'location', name: 'location'},
                    {data:function(data){
						if(data.status=='0'){
							return	'<img id="status-icon-'+data.sp_id+'" src="{{asset("img/confused.png")}}" style="width:20px;">';
						}else if(data.status=='1'){
							return	'<img id="status-icon-'+data.sp_id+'" src="{{asset("img/warning.png")}}" style="width:20px;">';
						}
                        else if(data.status=='3'){
							return	'<img id="status-icon-'+data.sp_id+'" src="{{asset("img/sad.png")}}" style="width:20px;">';
						}else{
							return	'<img id="status-icon-'+data.sp_id+'" src="{{asset("img/smiling-green.png")}}" style="width:20px;">';
						}
					    }
				    },
                    {
					"data":function(data){
						var status=data.status;
						var reapproved=data.is_repproved;
						var select =  '<select class="form-control" onchange="isApproveRequest('+data.sp_id+',this.value)">';
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
						if(status=='2'){
							select+='<option value="2" selected >{{ __('msg.approve') }}</option>';
						}else{
							select+='<option value="2">{{ __('msg.approve') }}</option>';
						}
						if(status=='3'){
							select+='<option value="3" selected >{{ __('msg.repprove') }}</option>';
						}else{
							select+='<option value="3" >{{ __('msg.repprove') }}</option>';
						}
						select+='</select>';
						return select;
					    }
				    },
                    {data: function(data) {
                        if(data.is_draft == true){
                            return '<span class="badge badge-success">Yes</span>';
                        }
                        else{
                            return '<span class="badge badge-danger">No</span>';
                        }
                    }},
                    {data: function(data) {
                        if(data.is_priority == true){
                            return '<span class="badge badge-success">Yes</span>';
                        }
                        else{
                            return '<span class="badge badge-danger">No</span>';
                        }
                    }},
                    {data:function(data){
                        var show_url = '{{ route("approvals.show", ":id") }}';
                        show_url = show_url.replace(':id', data.sp_id);

                        var delete_url = '{{ route("approvals.destroy", ":id") }}';
                        delete_url = delete_url.replace(':id', data.sp_id);

                        var edit_url = '{{ route("space.edit", ":id") }}';
                        edit_url = edit_url.replace(':id', data.sp_id);

                        return "<div class='btn-group'>"+
                                "<a href='"+show_url+"' class='btn btn-warning btn-xs'><i class='fa fa-eye'></i></a>"+
                                "<a href='"+edit_url+"' class='btn btn-success btn-xs'><i class='fa fa-edit'></i></a>"+
                                "<button type='submit' class='btn btn-danger btn-xs' onclick='delete_row("+data.sp_id+")'><i class='fa fa-trash'></i></button>"+
                                "<a onclick='ShareSpaceRequest("+data.sp_id+")' class='btn btn-primary btn-xs'><i class='fa fa-share'></i></a>"+
                                "</div>";


                    }}
                ],
            });


        });

        function ShareSpaceRequest(id){
            var url = BaseUrl+ '/space/edit-request/'+id+'&text=Your Space Request ID is '+id+' . You can See your Space request details via above link';
            var whatsapp = BaseUrl+'/space/edit-request/'+id;
            var link = 'https://t.me/share/url?url='+url+'"';
            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                $("#telegramm").attr("href", link);
                $("#whatsappm").attr("href", "whatsapp://send?text=Your Space Request ID is "+id+" . You can See your Space request details via this link. {{ URL::to('/space/edit-request/"+id+"') }}");

                $('#ShareSpaceRequest_mobile').modal('show');
            }
            else{
                 $("#telegram").attr("href", link);
                $("#whatsapp").attr("href", "https://web.whatsapp.com/send?text=Your Space Request ID is "+id+" . You can See your Space request details via this link . "+whatsapp+"");
                $('#ShareSpaceRequest_pc').modal('show');
                $('#share-request-id').attr('value',id);
            }
        }
        function ShareSpaceRequestEmail(){
			var id=$('#share-request-id').val();
			var email=$('#share-request-email').val();
			$.ajax({
				type: 'POST',
				url: BaseUrl+'/api/admin/share-space-request',
				dataType: "json",
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        Accept: 'application/json'
                    },
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

        function isApproveRequest(id,status){
            if(status==1){
                $('#request_id').val(id);
                $('#rejetReason').modal('show');
            }
            else{
                $.ajax({
				type: 'POST',
				url: BaseUrl+'/api/admin/is-approve-space-request',
				dataType: "json",
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        Accept: 'application/json'
                    },
				data:{
					'id':id,
					'status':status
				},
				success: function(response) {
                    console.log(response);
					if(response['status']=='success'){
                        location.reload();
					}else{
						location.reload();
					}
				}
			});
            }

		}
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
        function delete_row(id) {
            var r = confirm("Are you Sure ?");
            if (r == true) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        Accept: 'application/json'
                    },
                    type: 'post',
                    url: BaseUrl+'/approvals/delete/'+id,
                    dataType: "json",
                    data:{
                        'current_url': '{{Request::fullUrl()}}',
                        'id':id
                    },
                    success: function(response) {
                        location.reload();
                        table.ajax.reload(null, false);
                        alert('Successfully Deleted');
                    },

                    error: function (response) {
                        location.reload();
                    }
                })
            }

        }
    </script>
@endpush
