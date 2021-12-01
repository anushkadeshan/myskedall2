@extends('layouts.admin.master')
@section('title', 'PlanOz-Reason Management')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Reports')}}</li>
<li class="breadcrumb-item active"> {{__('msg.Reason Management')}}</li>
@endsection
@section('content')
<div class="container-fluid mt-3">

    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="card">
            <section class="card-header">
                <h1 class="pull-left">{{ __('msg.Reason Management') }}</h1>
                <h1 class="pull-right">
                   <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('reasons.create') }}">Add New</a>
                </h1>
            </section>
            <div class="card-body">
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
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
@endsection

@push('js')
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
