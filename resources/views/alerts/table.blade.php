<div class="table-responsive">

    <table class="table table-striped table-hover table-light " id="alerts-table">
        <thead>
            <tr>
                <td>#</td>
                <th>Date</th>
                <th>Requestor</th>
                <th>Event Name</th>
                <th>Group</th>
                <th>Routine</th>
                <th>Url</th>
                <th>Action Taken</th>
                <th>Updated at</th>
                <th>Updated By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <th>
                    <select data-column="1" name="date" id="date" class="form-control filter-select">
                        <option value="">Date</option>
                        @foreach($dates as $key => $date)
                            <option value="{{date('Y-m-d', strtotime($date))}}">{{date('d/m/Y', strtotime($date))}}</option>
                        @endforeach
                    </select>
                </th>
                <th>
                    <select data-column="2" name="date" id="date" class="form-control filter-select">
                        <option value="">Requestor</option>
                        @foreach($requesters as $requester)
                            <option value="{{$requester->id}}">{{$requester->name}}</option>
                        @endforeach
                    </select>
                    
                </th>
                <th>
                    <select data-column="3" name="date" id="date" class="form-control filter-select">
                        <option value="">Event Name</option>
                        @foreach($events as $key => $event)
                            <option value="{{$event}}">{{$event}}</option>
                        @endforeach
                    </select>
                    
                </th>
                <th></th>
                <th>
                    <select data-column="5" name="routine" id="routine" class="form-control filter-select">
                        <option value="">Routine</option>
                        @foreach($routines as $key => $routine)
                            <option value="{{$routine}}">{{$routine}}</option>
                        @endforeach
                    </select>
                </th>
                <th>
                    
                    
                </th>
                <th>
                    <select data-column="7" name="routine" id="routine" class="form-control filter-select">
                        <option value="">Action Taken</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</div>

<div class="modal fade" id="requestor" style="z-index:9999">
		<div class="modal-dialog" role="document" style="width:95%; max-width:500px;">
			<div class="modal-content">
				<div class="modal-body" style="text-align:left">
					<div style="font-size:20px;">Requestor Details</div>
					<div style="margin-top:15px; width:100%;">
						<li style="color:#999999">Name : <span id="requestorName"></span></li>
						<li style="color:#999999">Email : <span id="requestorEmail"></span></li>
						<li style="color:#999999">Phone : <span id="requestorPhone"></span></li>
					</div>
					<br>
				</div>
			</div>
		</div>
    </div>
@push('scripts')
<script>
    function requestorModel(id){
        var url = '{{url("/")}}';
        $.ajax({
            url: BaseUrl+'/api/user-data/'+id,
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

$(document).ready(function(){
    var table = $('#alerts-table').DataTable({
        processing: true,
        serverSide: true,
        "ordering": false,
        ajax: {
           url: BaseUrl+'/admin/alertData',
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: function(data){
                var date = moment(data.date).utc().format('MM/DD/YYYY');
                return date;
            }},
            {data: 'user_name', name: 'user_name'},
            {data: 'event_name', name: 'event_name'},
            {data: 'group_name', name: 'group_name'},
            {data: 'routine', name: 'routine'},
            
            {data: function(data) {
                var newurl = BaseUrl+'/'+data.url;
                return '<a target="_blank" href="'+newurl+'">'+newurl+'</a>';
            }},
            {data: function(data) {
                if(data.action == true){
                    return '<span class="badge badge-success">Yes</span>';
                }
                else{
                    return '<span class="badge badge-danger">No</span>';
                }
            }},
            {data: function(data){
                var updated_at = data.updated_at;
                if(!updated_at==''){
                    return moment(data.updated_at).utc().format('MM/DD/YYYY');
                }
                else{
                    return '';
                }
            }},
            {data: 'updated_by', name: 'updated_by'},
            {"data":function(data){
                var show_url = '{{ route("alerts.show", ":id") }}';
                show_url = show_url.replace(':id', data.sp_id);

                var delete_url = '{{ route("alerts.destroy", ":id") }}';
                delete_url = delete_url.replace(':id', data.sp_id);

                var edit_url = '{{ route("alerts.edit", ":id") }}';
                edit_url = edit_url.replace(':id', data.sp_id);

                return "<div class='btn-group'>"+
                        "<a href='"+show_url+"' class='btn btn-warning btn-xs'><i class='fa fa-eye'></i></a>"+
                        "<a href='"+edit_url+"' class='btn btn-success btn-xs'><i class='fa fa-edit'></i></a>"+
                        "<button type='submit' class='btn btn-danger btn-xs' onclick='delete_row("+data.sp_id+")'><i class='fa fa-trash'></i></button>"+
                        "</div>";
                        
                        
            }}
        ],
    });

    $('.filter-select').change(function(){
        table.column($(this).data('column'))
        .search($(this).val())
        .draw();
    });

    
});
    
function delete_row(id) {
    var r = confirm("Are you Sure ?");
    if (r == true) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                Accept: 'application/json'
            },
            type: 'post',
            url: BaseUrl+'/alert/delete/'+id,
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