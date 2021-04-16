@extends('layouts.app')

@section('content')
<div class="container-fluid mt-3">
    <section class="content-header">
        <h1 class="pull-left">{{ __('msg.Reason Management') }}</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('reasons.create') }}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table" id="showReasonlist">
                        <thead>
                            <tr>
                                <th>{{ __('msg.Id') }}</th>
                                <th>{{ __('msg.title') }}</th>
                                <th>{{ __('msg.Edit By') }}</th>
                                <th>{{ __('msg.status') }}</th>
                                <th><span style="margin-left: 40px;">{{ __('msg.edit') }}</span></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
</div>
<div class="modal fade" id="DeleteConfirmModel" role="dialog">
    <div class="modal-dialog modal-sm" style="top:30%">
        <div class="modal-content">
            <div class="modal-header">
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
@push('scripts')
    <script>
        $('#showReasonlist').DataTable( {
			ajax: {
				url:BaseUrl+'/admin/space-reasons',
				type:'POST',
				datatype:'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
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
						var select =  '<select class="form-control" onchange="IsStatusReasonChange('+data.id+',this.value)">';
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
					return '<a style="margin-left:40px;" href="{{url("admin/space-reasons-edit")}}/'+data.id+'"><i class="fa fa-pencil"></i></a>'+
				'<a style="margin-left: 10px;color:red" onclick="DeleteConfirm(`{{url("admin/delete-reason")}}/'+data.id+'`)"><i class="fa fa-trash"></i></a>';
				}}
			]
		});

        function IsStatusReasonChange(id,status){
         
			$.ajax({
				type: 'POST',
				url: BaseUrl+'/api/admin/change-reason-status',
				dataType: "json",
				data:{
					'id':id,
					'status':status
				},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
				success: function(response) {
                    location.reload();
				}
			});
		}

        function DeleteConfirm(url){
			$('#DeleteUrlLink').attr('href',url);
			$('#DeleteConfirmModel').modal('show');
		}
    </script>
@endpush
@endsection

