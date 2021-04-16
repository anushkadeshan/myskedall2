@extends('mensagens.top-bar')
@section('content')
<input type="hidden" id="txChatRemetente" value="">
<input type="hidden" id="txChatDestinatario" value="">
<div id="dvMinhasConversas" style="width:calc(100% - 3px);  
                                     height:calc(100% - 8px); 
                                     padding-left:5px; padding-top:10px; 
                                     display: grid; grid-template-columns: 65px 100%;
                                     overflow: hidden;
                                     ">

    <div style="height:calc(100% + 0px); padding:8px; background-color:#eeeeee;">
        <div style="display: grid; grid-template-columns: 50px 100%">
            <div style="height:50px; font-size:25px; padding-top:10px; padding-left:10px; "><a
                    href="javascript:beep(); mudaChatMenu();"><i class='fa fa-bars' aria-hidden='true'></i></a></div>
            <div id='dvChatBuscar' style="font-size:16px; display:none; margin:5px;">
                <button type="button" class="btn btn-info" onclick="beep(); buscarUsuario('chat');"
                    style="width:150px; height:35px;"><i class="fa fa-user-plus"></i> buscar usuários</button>
            </div>
        </div>
        <hr style="border-top: 1px solid #cdcdcd; margin:0px 0px 8px 0px;">
        <div id="dvChatUsuarios" class='scroolFino' style="height:calc(100% - 90px); overflow-y:auto;"></div>
    </div>

    <div id="dvMensagens"
        style="width:calc(100% - 70px);  height:calc(100% + 0px); background-color:#dddddd; overflow:hidden;">
        <div id="dvChatMensagens" style="height:calc(100% - 70px); padding:8px; padding-bottom: 0px;">
            <div id="dvChatMensagens1">

            </div>
            
            <div id="chatArea" style="overflow-y:scroll ;padding:20px; min-height:450px; max-height:450px">
                
            </div>
        </div>
        <div style="padding:8px;">
            <table width="100%">
                <tr>
                    <td><textarea name="txChatMensagem" id="txChatMensagem" rows="2" maxlength="255"
                            class="form-control" style="resize:none;"></textarea></td>
                    <td width="60" align="right"><button type="button" class="btn btn-info"
                            onclick="beep(); sendChat({{Auth::user()->id}});"
                            style="width:55px; height:50px; padding:0px;">Enviar</button></td>
                </tr>
            </table>
        </div>
    </div>

</div>
@endsection
<script src='{{asset('plataforma/objetos/jquery/jquery.min.js')}}'></script>

<script>
    
    var menuChat = 1;
  function mudaChatMenu(forcar)   //1-fechado  2-aberto
    {
    if(typeof forcar == 'undefined')
      {if(menuChat == 2){menuChat = 1;} else {menuChat = 2;}}
    else 
      {menuChat = forcar;} 
      
    $('#tbUsuarios1').hide();  
    $('#tbUsuarios2').hide();
    $('#tbUsuarios'+menuChat).show();
    if(menuChat == 1)
      {
      $('#dvMinhasConversas').css('grid-template-columns','65px 100%'); 
      $('#dvMensagens').show(); 
      $('#dvChatBuscar').hide();  
      }
    if(menuChat == 2)
      {
      $('#dvMinhasConversas').css('grid-template-columns','calc(100% + 65px) 0px');
      $('#dvMensagens').hide();
      $('#dvChatBuscar').show();
      }
    }

function addUserToChat(id)
  	{
        $.ajax({
        type : 'get',
        _token:"{{ csrf_token() }}",
        url : '{{route('add.user.to.chat')}}',
        data:{id:id},
            success:function(data){
                setCookie('chat_user', id,365);
                if(data.exsist==1){   
                $('#chatArea').html(data.output2);
                $('#dvChatMensagens1').html(data.output);
                }
                else{
                    setCookie('chat_user', id,365);
                    getChatHeads();
                    $('#chatArea').html(data.output2);
                }
                $('#dvChatMensagens1').html(data.output);
                var d = $("#chatArea");
                d.scrollTop(d.prop("scrollHeight"));
                
                
            }
        });
    
    $('#modalBusca').modal('hide');

  	}
    $(document).ready(function(){
        getChatHeads();
        function getChatHeads(query = ''){
            $('#alert').hide();
            $.ajax({
            type : 'get',
            _token:"{{ csrf_token() }}",
            url : '{{route('get-chat-heads')}}',
            data:{query:query},
                success:function(data){
                    $('#dvChatUsuarios').html(data);
                    chat_user = getCookie('chat_user');
                    addUserToChat(chat_user);
                    if(data.length==0){
                        $('#alert').show();
                    }

                }
            });
        }
    }); 

    function getChatHeads(query = ''){
            $('#alert').hide();
            $.ajax({
            type : 'get',
            _token:"{{ csrf_token() }}",
            url : '{{route('get-chat-heads')}}',
            data:{query:query},
                success:function(data){
                    $('#dvChatUsuarios').html(data);
                    if(data.length==0){
                        $('#alert').show();
                    }

                }
            });
        }

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  var expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function sendChat(sender) {
    var chat_user = getCookie('chat_user');
    var message = document.getElementById("txChatMensagem").value;

    $.ajax({
        type : 'get',
        _token:"{{ csrf_token() }}",
        url : '{{route('add-message-to-chat')}}',
        data:{
            sender:sender,
            chat_user:chat_user,
            message:message,
            },
            success:function(data){
                var message = document.getElementById("txChatMensagem").value = "";
                addUserToChat(chat_user);
                

            }
    });
}
</script>