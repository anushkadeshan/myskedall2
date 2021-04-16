<?php
  @header("Content-Type: text/html; charset=UTF-8",true);;
  @session_start();

  include "config.conf";
	require_once("funcoes.php");
  require_once("funcoes_db.php");

  if(!isset($_GET["acao"])){$_GET["acao"] = "";}
	$msg = "";

 	if($_GET["acao"] == "GRAVAR")
	  {
		if(limpaNumero($_POST["cpf"]) == ''){$msg = 'Campo "CPF" não preenchido!';}
    if($_POST["nome"] == ''){$msg = 'Campo "nome" não preenchido!';}
    if($_POST["email"] == ''){$msg = 'Campo "email" não preenchido!';}
    if($_POST["senha"] == ''){$msg = 'Campo "senha" não preenchido!';}
    if($_POST["senha"] != $_POST["senha2"]){$msg = 'Redigite a "senha" corretamente!';}

    if(dbTemRegistro("usuarios", "email = '".$_POST["email"]."'")){$msg = 'Email já cadastrado, tente a recuperação de senha se necessário!';}

    if($msg == "")
		  {
      $dados = array();  
      $dados[] = "cpf   = '".limpaNumero($_POST["cpf"])."'";
      $dados[] = "nome   = '".$_POST["nome"]."'";
      $dados[] = "email  = '".$_POST["email"]."'";
      $dados[] = "senha  = AES_ENCRYPT('".$_POST["senha"]."','".$chaveCrypt."')";
      $dados[] = "cidade = '".$_POST["cidade"]."'";
      $dados[] = "uf     = '".$_POST["uf"]."'";
      $msg = db_ExecutaSQL("NEW", "usuarios", "", $dados);
      }
    echo $msg;
    exit;
	  }

?>
<div class="modal fade" id="modalCadastrar" tabindex="-1" role="dialog" aria-labelledby="modalCadastrarTitulo" aria-hidden="true" style="z-index: 99999">
  <div class="modal-dialog" role="document" style="width:95%; max-width:600px;">
    <div class="modal-content">
      <div class="modal-header" style="padding:10px;"><h5 class="modal-title" style="color:#333333; font-size:18px;">Novo cadastro</h5></div>
      <div class="modal-body">
        <div class="input-group" style="margin-top:-5px;">
          <font style="color:#999999">Seu CPF *</font><br>
          <input type="text" name="txCadastroCpf" id="txCadastroCpf" value="" maxlength="12" class="form-control" style="width:200px;">
        </div>
        <div class="input-group">
          <font style="color:#999999">Seu nome *</font><br>
          <input type="text" name="txCadastroNome" id="txCadastroNome" value="" maxlength="255" class="form-control">
        </div>
        <div class="input-group">
          <font style="color:#999999">Seu email *</font><br>
          <input type="text" name="txCadastroEmail" id="txCadastroEmail" value="" maxlength="255" class="form-control">
        </div>
        
        <table width="100%">
          <tr>
            <td width="140">
              <div class="input-group">
                <font style="color:#999999">Digite uma senha *</font><br>
                <input type="text" name="txCadastroSenha" id="txCadastroSenha" value="" maxlength="10" class="form-control" style="width:130px;">
              </div>
            </td>
            <td>
              <div class="input-group">
                <font style="color:#999999">Redigite a senha *</font><br>
                <input type="text" name="txCadastroSenha2" id="txCadastroSenha2" value="" maxlength="10" class="form-control" style="width:130px;">
              </div>
            </td>  
          </tr>
        </table>

        <table width="100%">
          <tr>
            <td>
              <div class="input-group">
                <font style="color:#999999">Cidade onde mora</font><br>
                <input type="text" name="txCadastroCidade" id="txCadastroCidade" value="" maxlength="100" class="form-control">
              </div>
            </td>  
            <td width="60">  
              <div class="input-group" style="margin-left: 10px;">
                <font style="color:#999999">UF</font><br>
                <input type="text" name="txCadastroUf" id="txCadastroUf" value="" maxlength="2" class="form-control" style="width:50px;">
              </div>
            </td>  
          </tr>
        </table>

      </div>
      <div class="modal-footer" style="margin-top:3px;">
	      <button type="button" class="btn btn-success" onClick="gravarCadastro()" style="width:90px;">Gravar</button>
	      <button type="button" class="btn btn-default" data-dismiss="modal" style="width:90px;">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<script>

  var idText = 0;

  function cadastrarUsuario(id)
	  {
    idText = id; 
    txCadastroEmail.value = $('#txEmail').val();
    txCadastroSenha.value = '';
    txCadastroSenha2.value = '';
    txCadastroNome.value = '';
    txCadastroCpf.value = '';
    txCadastroCidade.value = '';
    txCadastroUf.value = '';
    $('#modalCadastrar').modal();
    setTimeout(function(){$('#txCadastroCpf').focus();}, 500);
		}

  function gravarCadastro()
	  {
		$.ajax({
			type: 'POST',
			url: 'index_cadastrar.php?acao=GRAVAR',
			data: {cpf:txCadastroCpf.value, email:txCadastroEmail.value, senha:txCadastroSenha.value, senha2:txCadastroSenha2.value, nome:txCadastroNome.value, cidade:txCadastroCidade.value, uf:txCadastroUf.value},
			error: function(){alerta('Ocorreu um erro no Ajaz jQuery','danger');},
			success: function(msg)
                {
                if(msg.trim() != 'OK')
                  {alerta(msg,'danger');} 
                else 
                  {
                  $('#modalCadastrar').modal('hide'); 
                  $('#txEmail').val(txCadastroEmail.value);
                  $('#txSenha').val(txCadastroSenha.value);
                  validarCadastro();
                  }
                }
			});
		}

  function validarCadastro()
    {
    alerta('Enviando email de validação...','wait')
    $.ajax({
      type: 'GET',
      url: 'email.php?acao=VALIDARCADASTRO&email='+txEmail.value,
      error: function(){alerta('Ocorreu um erro no Ajaz jQuery.','danger');},
      success: function(msg)
        {
        if(msg == 'Mensagem enviada com sucesso')
          {alerta('As informações para validação foram enviadas para seu email','success');}
        else
          {alerta(msg,'danger');}
        }
      });
    }

</script>