<?php
  header("Content-Type: text/html; charset=UTF-8",true);
  session_start();
  include "config.conf";
  require_once("funcoes.php");
	
  if(!isset($_GET["acao"])){$_GET["acao"] = "";}

  if($_GET["acao"] == "SAIR" || $_GET["acao"] == "LOGOUT" || $_GET["acao"] == "LOGIN")
    {
    $_SESSION["avisoSolicitacaoGrupo"] = ""; 
    $_SESSION["avisoAceiteGrupo"] = 0; 

    $_SESSION["planoz_user"] = "";  
    $_SESSION["planoz_userId"] = 0;
    $_SESSION["planoz_grupo"] = 1;
    $_SESSION["planoz_nivel"] = 0;
    $_SESSION["planoz_nome"] = "";
    $_SESSION["planoz_foto"] = "";
    if($_GET["acao"] == "LOGOUT"){echo "OK"; exit;}
    }

  if($_GET["acao"] == "LOGIN")
    { 
    if(isset($_POST["email"]) && $_POST["email"]!=""){$email = $_POST["email"];} else {echo "Campo email não preenchido"; exit;}
    if(isset($_POST["senha"]) && $_POST["senha"]!=""){$senha = $_POST["senha"];} else {echo "Campo senha não preenchido"; exit;}
    if(isset($_POST["grupo"]) && $_POST["grupo"]!=""){$grupo = $_POST["grupo"];} else {$grupo = 1;}

    $_POST["email"] =  addslashes($_POST["email"]);
    $_POST["senha"] =  addslashes ($_POST["senha"]);
    $_POST["grupo"] =  addslashes ($_POST["grupo"]);

    $ret = "Problemas na conexão com o banco de dados";
    $con = new PDO($dbString,$dbUser,$dbPwd);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($con)
      {
      $ret = "Email ou senha inválida";
      $sql  = "SELECT idUsuario, idGrupo, email, AES_DECRYPT(senha,'".$chaveCrypt."') AS senha, nome, nivel, status, temAvisoGrupo, aceiteData FROM usuarios WHERE email = '".$email."' LIMIT 1";
      $con->query("SET NAMES 'utf8'");
      $con->query("SET character_set_connection=utf8");
      $con->query("SET character_set_client=utf8");
      $con->query("SET character_set_results=utf8");        
      $tab = $con->query($sql);
      if($tab)
        {
        while($reg = $tab->fetch())
          {
          if($reg['status'] == 2)
            {$ret = "Seu usuário está inativo!";}
          else
            {
            if($reg['senha']==$senha)
              {
              if($reg['aceiteData']=="")  
                {$ret = "ACEITE";}
              else
                {
                $ret = "OK";
                $_SESSION["planoz_userId"] = $reg['idUsuario'];
                $_SESSION["planoz_user"]   = $reg['email'];
                $_SESSION["planoz_nome"]   = $reg['nome'];
                $_SESSION["planoz_nivel"]  = $reg['nivel'];
                $_SESSION["planoz_grupo"]  = $reg['idGrupo'];
                $_SESSION["planoz_foto"]   = achaFoto($reg['idUsuario']);
                $_SESSION["avisoAceiteGrupo"] = $reg['temAvisoGrupo']; 
                }  
              }
            }
          }
        $tab = NULL;
        }

      if($ret == "OK")
        {$tab = $con->query("UPDATE usuarios SET dataLogin = NOW() WHERE idUsuario = ".$_SESSION["planoz_userId"]);}

      $con = NULL;
      }
    echo $ret;
    exit;
    }

  if(!isset($_GET["grupo"])){$_GET["grupo"] = "1";}

?>
<!DOCTYPE html>
<html lang="br">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $tituloSite; ?></title>
    <link href="objetos/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="objetos/plugins/awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
  </head>
  <script src="objetos/jquery/jquery.min.js"></script>
  <script src="objetos/bootstrap/js/bootstrap.min.js"></script>
  <script src='objetos/plugins/fittext/jquery.fittext.js'></script>
  <script src="funcoes.js"></script>    
  <script>

    function login()
      {
      $.ajax({
          type: 'POST',
          url: 'index.php?acao=LOGIN',
          data: {grupo:txGrupo.value, email:$('#txEmail').val(), senha:$('#txSenha').val()},
          error: function(){alerta('Ocorreu um erro no Ajaz jQuery','danger');},
          success: function(msg)
                      { 
                      if(msg=='ACEITE')
                        {exibirAceitar();}
                      else if(msg=='OK')
                        { 
                        gravarCookie('planoz_usuario', $('#txEmail').val());
                        gravarCookie('planoz_senha', $('#txSenha').val());
                        gravarCookie('planoz_lembrarSenha', txLembrarSenha.value);
                        window.location = 'home.php';
                        } 
                      else 
                        {alerta(msg,'danger');}}
          });
      }

    function recuperarSenha()
      {
      alerta('Enviando email de recuperação...','wait')
      $.ajax({
        type: 'GET',
        url: 'email.php?acao=RECUPERARSENHA&email='+txEmail.value,
        error: function(){alerta('Ocorreu um erro no Ajaz jQuery.','danger');},
        success: function(msg)
          {
          if(msg == 'Mensagem enviada com sucesso')
            {
            gravarCookie('planoz_usuario', $('#txEmail').val());
            alerta('Os dados de recuperação da senha foram enviados para o email informado','success');
            }
          else
            {alerta(msg,'danger');}
          }
        });
      }

  function mudaLembrarSenha()
    { 
    if(txLembrarSenha.value == '0'){txLembrarSenha.value = '1';} else {txLembrarSenha.value = '0';}
    atualizaLembrarSenha();  
    }

  function atualizaLembrarSenha()
    {
    if(txLembrarSenha.value == ''){txLembrarSenha.value = 0;}
    $('#txLembrarSenha0').css('display','none');
    $('#txLembrarSenha1').css('display','none');
    $('#txLembrarSenha'+txLembrarSenha.value).css('display','block');
    }

  $(document).keypress(function(e){if(e.which == 13){login();}});

  </script>

<body style="background-image:none !important;">
  <div style="position: absolute; right:10px; "><a href="javascript:beep(); location.reload(true)" style="color:#999999"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></a></div>
  <div width="100%" style="margin:10px;">
    <img id="imLogo" src="" alt="" class="img-responsive" style="max-height:40px; margin:auto">
  </div>
  <!-- SLIDES --------------------------------------------------------------------------------------------------- -->
  <div class="row" style="color:#000000">
  <img id="imBanner" width="100%" style="cursor: auto">
  <input type="hidden" id="txGrupo" value="<?php echo $_GET["grupo"]; ?>">
  <div id="cadastro" class="cadastro">
    <div class="cadTitulo" style="font-size:25px; margin-top:-10px;">Login</div>
    <div class="form-group cadPrimeiroCampo">
      <label for="txEmail" style="font font-weight:normal; font-size: 12px">Seu Email</label>
      <input type="email" class="form-control" id="txEmail" placeholder="Email" maxlength="255" onfocusout="gravarCookie('planoz_usuario', $('#txEmail').val());">
    </div>
    <div class="form-group" style="margin-top: -10px;">
      <label for="txSenha" style="font font-weight:normal; font-size: 12px">Sua Senha</label>
      <input type="password" class="form-control" id="txSenha" placeholder="Senha" maxlength="10" onfocusout="gravarCookie('planoz_senha', $('#txSenha').val());">
    </div>
    <div>
      <input type="hidden" id="txLembrarSenha" value="">
      <table>
        <tr onclick="beep(); mudaLembrarSenha();" style="cursor:pointer;">
          <td width="20">
            <span id="txLembrarSenha0" style="display:none" class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
            <span id="txLembrarSenha1" style="display:none" class="glyphicon glyphicon-check" aria-hidden="true"></span>
          </td>
          <td style="padding-top:1px;">Lembrar senha</td>
        </tr>
      </table>  
    <div>  
    <table width="100%" style="font-size:13px; margin-top:15px;">
      <tr>
        <td><a style="color:#5bc0de;" href="javascript:beep(); cadastrarUsuario();">Não sou cadastrado</a></td>
        <td align="right"><a style="color:#5bc0de;" href="javascript:beep(); recuperarSenha();">Esqueci minha senha</a></td>
      </tr>
    </table>
    <button class="btn btn-info" type="button"  onclick="beep(); login();">Entrar</button>
    <div style="width:100%; margin-top:25px; font-size:13px; text-align:center; ">Leia a <a style="color:#5bc0de;" href='javascript: beep(); exibirPolitica();'>política de privacidade</a> deste aplicativo e saiba como seus dados serão tratados.</div>
  </div>
  <?php include "index_cadastrar.php"; ?>
  <?php include "lgpd_aceitar.php"; ?>
  <?php include "lgpd_politica.php"; ?>
  <?php include "alerta.php"; ?>
</body>
</html>
<script>
  
  var imgPath = '<?php echo str_replace("\\","\\\\", $dbPathDados)."\\\\"."plataforma"."\\\\"."grupos"."\\\\".$_GET["grupo"]."\\\\"; ?>';
  $('#imBanner').attr('src','baixar.php?arquivo='+imgPath+'banner.jpg');
  $('#imLogo').attr('src','baixar.php?arquivo='+imgPath+'logo.png');

  var flagSair = false;  
  function androidVoltar()
    {
    var modal = '';
    $.each($('.modal'), function(){if($(this).is(':visible')){modal = this.id;}});
    if(modal != '')
      {$('#'+modal).modal('hide');}
    else
      {
      if(flagSair)
        {try{Android.finalizaApp();} catch(e){}}
      else
        {
        flagSair = true;
        try{Android.showToast('Clique novamente para sair');} catch(e){}
        setTimeout(function(){flagSair = false;}, 3000);
        }
      }
    }

  txEmail.value = lerCookie('planoz_usuario');
  txLembrarSenha.value = lerCookie('planoz_lembrarSenha');
  atualizaLembrarSenha();
  if(txLembrarSenha.value=='1')
    {txSenha.value = lerCookie('planoz_senha');}
  else
    {
    txSenha.value = '';
    setTimeout(function(){txSenha.value = ''; $('#txSenha').select();}, 300);
    }
  if(txEmail.value == ''){setTimeout(function(){$('#txEmail').select();}, 500);}

  <?php 
    if(isset($_GET["acao"]) && $_GET["acao"] == "sombra")
      { 
      echo "txEmail.value = '".$_GET["email"]."';";
      echo "txSenha.value = '".$_GET["senha"]."';";  
      }  
  ?>

</script>