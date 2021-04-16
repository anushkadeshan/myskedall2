<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('plataforma/objetos/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('plataforma/objetos/plugins/awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('plataforma/objetos/plugins/datetimepicker/jquery.datetimepicker.css')}}" rel="stylesheet">
    <link href="{{asset('plataforma/objetos/plugins/clockpicker/bootstrap-clockpicker.min.css')}}" rel="stylesheet">
	<link href="{{asset('mensagens.css')}}" rel="stylesheet">
    <title>Mensagens</title>
    <style>
       /* width */
        ::-webkit-scrollbar {
        width: 6px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
        background: #f1f1f1; 
        }
        
        /* Handle */
        ::-webkit-scrollbar-thumb {
        background: #888; 
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
        background: #555; 
        }
    </style>
</head>
<body>
    <div class="menuUsuario" style="position:fixed; top:0px; left:0px; width:100%; background-color:#34495c; z-index:999">
    <table width="100%">
        <tr>
        <td width="40" align="center"><a href="javascript:irPara('{{url('home')}}')" class="linkBranco"><i class="fa fa-chevron-circle-left"></i></a></td>
        <td style="font-size:18px; white-space: nowrap; overflow: hidden;"><a href="javascript:irPara({{url('/home')}})" class="linkBranco">Mensagens</a></td>  
        <td width="40" align="center"><a id="lnkNovoEvento" href="javascript:beep(); buscarUsuario('chat');" style="color: #ffffff"><i class="fa fa-user-plus"></i></a></td>
        <td width="40" align="center">
            <img src="{{url('_dados/plataforma/usuarios/')}}/{{ Auth::user()->id}}.jpg" class="img-rounded" width="30 ">
        </td>
        </tr>
    </table>
    </div>
    <div class="modal fade" id="modalBusca" tabindex="-1" role="dialog" aria-labelledby="modalBuscaTitulo" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:95%; max-width:400px;">
        <div class="modal-content">
        <div class="modal-header"><h5 class="modal-title" id="modalBuscaTitulo">Buscar Usuario</h5></div>
        <div class="modal-body">
            <input type="hidden" id="txBuscaOrigem" value="">
            <div class="input-group" style="margin-top:5;">
            <input name="txBuscaChave" id="txBuscaChave" type="text" value="" maxlength="100" style="width:80%;" class="form-control" placeholder="nome" >
            <button type="button" class="btn btn-default" onClick="beep(); buscarUsuarioInterno()"><span style="color:#999999;" class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
            </div>
            <div id='dvBuscaUsuario' style="height:300; overflow-y:auto; margin-top:10px;"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal" style="width:90px;">Cancelar</button>
        </div>
        </div>
    </div>
    </div>
    @yield('content')
</body>
<script src='{{asset('plataforma/objetos/jquery/jquery.min.js')}}'></script>
<script src='{{asset('plataforma/objetos/bootstrap/js/bootstrap.min.js')}}'></script>
<script src='{{asset('plataforma/objetos/plugins/datetimepicker/jquery.datetimepicker.js')}}'></script>
<script src="{{asset('plataforma/objetos/plugins/clockpicker/bootstrap-clockpicker.min.js')}}"></script>
<script src='{{asset('funcoes.js')}}'></script>
<script>
    function buscarUsuario(origem='')
    {
    txBuscaOrigem.value = origem;  
    $('#modalBusca').modal();
    setTimeout(function(){$('#txBuscaChave').select();}, 500);
    }

    function buscaAutomatica(){if(txBuscaChave.value.length>=2){buscarUsuarioInterno();}}

    function buscarUsuarioInterno()
        {
        $('#dvBuscaUsuario').html(sWait);  
        $.ajax({
        type: 'POST',
        url: 'usuarios_busca.php?acao=BUSCAR',
        data: {chave:txBuscaChave.value},
        error: function(){alerta('Ocorreu um erro no Ajaz jQuery','danger');},
        success: function(msg){$('#dvBuscaUsuario').html(msg);}
        });
        }

    $(document).ready(function(){
        fetch_user_data();
        function fetch_user_data(query = ''){
            $('#alert').hide();
            $.ajax({
            type : 'get',
            _token:"{{ csrf_token() }}",
            url : '{{route('user-search-chat')}}',
            data:{query:query},
                success:function(data){
                    $('#dvBuscaUsuario').html(data);
                    if(data.length==0){
                        $('#alert').show();
                    }

                }
            });
        }

        $(document).on('keyup', '#txBuscaChave', function(){
            var query = $(this).val();
            fetch_user_data(query);
        });

        
    });

    function fetch_user_data(query = ''){
        $('#alert').hide();
        $.ajax({
        type : 'get',
        _token:"{{ csrf_token() }}",
        url : '{{route('user-search-chat')}}',
        data:{query:query},
            success:function(data){
                $('#alert').hide();
                $('#dvBuscaUsuario').html(data);
                $('#txBuscaChave').val('');
                if(data.length==0){
                    $('#alert').show();
                }

            }
        });
    }

    

</script>
</html>