<div class="table-responsive">
    <table align="center" class="busca" style="width:96%; max-width:700px;">
    <tr>
        <td colspan="4">
            <form autocomplete="off">
                <div class="panel panel-default container-fluid">
                    <div class="input-group">
                        <input type="text" name="search-group-requests" id="search-group-requests" value=""
                            maxlength="100" class="form-control"  placeholder="{{ __('msg.search a User') }}">
                        <button type="button" name="btBuscar" id="btBuscar" onClick='fetch_group_data()'
                            class="btn btn-default"
                            style="height:35px; "><i class="fa fas-search"></i><span class="hidden-xs">
                                {{ __('msg.search') }}</span></button>
                    </div>
                </div>
            </form>
        </td>
    </tr>
</table>
<table class="table" style="width:96%" id="groupRequests">
    <div class="alert alert-danger" id="alert" role="alert" style="display: none">
        {{ __('msg.No records Found !') }}
    </div>
    <div class="alert alert-success" id="success-alert" role="alert" style="display: none">
        {{ __('msg.Request Accepted !') }}
    </div>
    <div class="alert alert-success" id="success-alert2" role="alert" style="display: none">
        {{ __('msg.Request Deleted !') }}
    </div>
    <tbody>

    </tbody>

</table>
</div>
@push('scripts')
<script>
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

    
</script>    
@endpush