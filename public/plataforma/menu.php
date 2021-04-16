<?php 
  $nomeGrupo = dbPegaValor("grupos", "nome", "idGrupo = ".$_SESSION["planoz_grupo"]); 
?>

<div id='dvMenu' style="width:100%; ">
  <table width='100%' class='painel'>
    <tr>
      <td onclick="">
        <div>
          <div class="banner">
            <img id="imBanner">
            <img id="imLogo" class="sombraImagem" style="position:absolute; width:30%; left:50%; top:50%;">
          </div>
          <div class="quadroMenu" style="position:absolute;"></div>
          <div class="displayMenu" style="position:absolute; text-align:left; padding-left:10px; padding-top:2px; width:80%; z-index:997;">
            <div class="dropdown" style="cursor: pointer">
              <a class="dropdown-toggle" type="button" id="dropdownMenuGrupo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?php echo ($nomeGrupo == "PlanOz" ? "Grupo " : "").$nomeGrupo; ?></a>
              <i id='iIndicador' class='fa fa-hand-o-left' aria-hidden='true' style="display: none;"></i>
              <ul class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuGrupo">
                <?php 
                  echo "<li class='dropdown-header' style='font-size:12px'>GRUPOS</li>";
                  $meusGrupos = dbGrupos($_SESSION["planoz_userId"]);
                  if(!(strpos($meusGrupos,";1;")===false)){echo "<li><a href='javascript:mudaGrupo(1)'>".($_SESSION["planoz_grupo"]==1 ? iconOk : "")." Planoz</a></li>";}
                  if(!(strpos($meusGrupos,";2;")===false)){echo "<li><a href='javascript:mudaGrupo(2)'>".($_SESSION["planoz_grupo"]==2 ? iconOk : "")." Edificando OZ</a></li>";}
                  if(!(strpos($meusGrupos,";3;")===false)){echo "<li><a href='javascript:mudaGrupo(3)'>".($_SESSION["planoz_grupo"]==3 ? iconOk : "")." Edificando em Cristo</a></li>";}
                  if(!(strpos($meusGrupos,";4;")===false)){echo "<li><a href='javascript:mudaGrupo(4)'>".($_SESSION["planoz_grupo"]==4 ? iconOk : "")." Comunidade Cristâ Adamantina</a></li>";}
                ?>
                <li role="separator" class="divider"></li>
                <li><a href='javascript:conectarGrupo()'>Conectar a um grupo...</a></li>
              </ul>
            </div>
          </div>
          <div class="displayMenu" style="position:absolute; text-align:right; padding-right:10px; padding-top:2px; z-index:996;">
            <div style="float: right"><i class="fa fa-bars" onclick="beep(); mudarMenuLateral()" style="cursor: pointer;"></i></div>
          </div>
        </div>
      </td>
    </tr>  
  </table>  
</div>

<div id='idMenuLateral' class="menuLateral" style="overflow-y:auto;">
  <div class="menuLateralUser">    
    <div style="height:30px;">&nbsp;</div>
    <table>
      <tr><td style="padding-top:5px;"><a href="javascript:beep(); alterarFoto(<?php echo $_SESSION["planoz_userId"]; ?>);"><img src="baixar.php?arquivo=<?php echo $dbPathDados; ?>plataforma/usuarios/<?php echo $_SESSION["planoz_foto"]; ?>.jpg" class="img-rounded" width="45"></a></td></tr>
      <tr><td style="padding-top:10px;">Olá,</td></tr>
      <tr><td style="padding-top:2px; font-size:16px"><?php echo primeiroNome($_SESSION["planoz_nome"]); ?></td></tr>
      <tr><td style="padding-top:5px;"><a href="javascript:beep(); alterarSenha();" style="font-size:12px; color:#cccccc; ">trocar senha</a></td></tr>
    </table>
  </div>
  <div class="menuLateralOption"><a href="javascript:beep(); alterarUsuario(<?php echo $_SESSION["planoz_userId"]; ?>);"><i class="fa fa-user-circle" aria-hidden="true"></i> meu cadastro</a></div>
  <hr>
  <div class="menuLateralOption"><a href="javascript:beep(); conectarGrupo();">conectar a um grupo</a></div>
  <?php if($pagAtual=="home.php" && 1==2){ ?>
  <hr>
  <div class="menuLateralOption"><a href="javascript:beep(); mudaModoExibicao(0);"><i class="fa fa-th-large" aria-hidden="true"></i> exibir em quadros</a></div>
  <div class="menuLateralOption"><a href="javascript:beep(); mudaModoExibicao(1);"><i class="fa fa-th-list" aria-hidden="true"></i> exibir em lista</a></div>
  <hr>
  <div class="menuLateralOption"><a href="javascript:beep(); location.reload(true)"><i class="fa fa-refresh" aria-hidden="true"></i> atualizar</a></div>
  <?php } ?>
  <?php if(isMobile()){?><div class="menuLateralOption"><a href="javascript:beep(); sobre();">sobre</a></div><?php } ?>
  <hr>
  <div><a href="javascript:beep(); ajuda('plataforma');">ajuda e contato</a></div>
  <div><a href="javascript:beep(); compartilhar();">compartilhar app</a></div>
  <hr>
  <div class="menuLateralOption">
    <?php 
      if($pagAtual=="home.php")
        {
        if(isMobile())
          {echo "<a href='javascript:beep(); try{Android.finalizaApp();} catch(e){}'>sair</a>";} 
        else 
          {echo "<a href='javascript:irPara(\"index.php\")'>sair</a>";}
        } 
      else 
        {
        $ir = "home.php";  
        if($pagAtual=="videos_gestao.php"){$ir = "home_secretaria.php";}
        echo "<a href='javascript:irPara(\"".$ir."\")'>voltar</a>";
        } 
    ?>   
  </div>
</div>
<?php require_once "usuarios_edit.php"; ?>
<?php require_once "usuarios_senha.php"; ?>
<?php require_once "usuarios_foto.php"; ?>
<?php require_once "usuarios_grupo.php"; ?>
<?php require_once "compartilhar.php"; ?>
<?php require_once "ajuda.php"; ?>
<?php require_once "sobre.php"; ?>
<script src="objetos/plugins/mobile/jquery.mobile-events.min.js"></script>
<script>

  var sWait = '<i class="fa fa-refresh fa-spin"></i>&nbsp;&nbsp;processando...';

  var imgPath = '<?php echo str_replace("\\","\\\\", $dbPathDados)."\\\\"."plataforma"."\\\\"."grupos"."\\\\".$_SESSION["planoz_grupo"]."\\\\"; ?>';
  <?php if($pagAtual=="home_distribuidor.php"){ ?>
    $('#imBanner').attr('src','imagens/slide2.jpg');
  <?php } else { ?>  
    $('#imBanner').attr('src','baixar.php?arquivo='+imgPath+'banner.jpg');
    $('#imLogo').attr('src','baixar.php?arquivo='+imgPath+'logo.png');
  <?php } ?>

  $(window).on('swiperight', function (e, touch){exibirMenuLateral('swiperight', touch );})
           .on('swipeleft', function (e, touch){exibirMenuLateral('swipeleft', touch );})
           .on('tap', function(e, touch){exibirMenuLateral('tap', touch );});

  var mnLateral = false;
  function exibirMenuLateral(eventName, touch, forcar=false)
    { //console.log(touch);
    var x = 0; var y = 0;
    if(!forcar){try {x = touch.startEvnt.offset.x;} catch(e){}}
    if(!forcar){try {y = touch.startEvnt.offset.y;} catch(e){}}
    if(eventName == 'swiperight' && x <= 100){mnLateral = true; $('#idMenuLateral').addClass('menuLateralHover');}
    if(eventName == 'swipeleft' && x <= 200){mnLateral = false; $('#idMenuLateral').removeClass('menuLateralHover');}
    if(eventName == 'swipeleft' && x <= 200){mnLateral = false; $('#idMenuLateral').removeClass('menuLateralHover');}
    if(y<280 && x>50 && (eventName == 'swiperight' || eventName == 'swipeleft'))
      {
      if('<?php echo nomePaginaAtual(); ?>' == 'home.php'){mudarTabMenu(eventName);}
      }
    }
  function mudarMenuLateral(){if(mnLateral){exibirMenuLateral('swipeleft', 0, true);} else {exibirMenuLateral('swiperight', 0, true);}}

  function mudaModoExibicao(modo)
    {
    $.ajax({
      type: 'GET',
      url: 'api.php?acao=GRAVARCONFIG&idUsuario=<?php echo $_SESSION["planoz_userId"]; ?>&campo=plaExibir&valor='+modo,
      error: function(){alerta('Ocorreu um erro no Ajaz jQuery','danger');},
      success: function(msg){if(msg.trim() != 'OK'){alerta(msg,'danger');} else {location.reload(true);}}
      }); 
    }

  function mudaGrupo(id)
    {
    $.ajax({
      type: 'GET',
      url: 'api.php?acao=MUDAGRUPO&idGrupo='+id,
      error: function(){alerta('Ocorreu um erro no Ajaz jQuery','danger');},
      success: function(msg){if(msg.trim() != 'OK'){alerta(msg,'danger');} else {location.reload(true);}}
      }); 
    }

  var flagSair = false;  
  function androidVoltar()
    {
    var modal = '';
    $.each($('.modal'), function(){if($(this).is(':visible')){modal = this.id;}});
    if(modal != '')
      {$('#'+modal).modal('hide');}
    else
      {
      var page = location.href.split("/").slice(-1)  
      <?php 
        if(nomePaginaAtual()=="home.php")
          {
          echo "if(flagSair)
                  {try{Android.finalizaApp();} catch(e){}}
                else
                  {
                  flagSair = true;
                  try{Android.showToast('Clique novamente para sair');} catch(e){}
                  setTimeout(function(){flagSair = false;}, 3000);
                  }";
          } 
        else if(nomePaginaAtual()=="videos_gestao.php")
          {echo "window.location = 'home_secretaria.php';";} 
        else 
          {echo "window.location = 'home.php';";} 
        ?>    
      }
    }

  //faz com que o app android saiba que está dentro do site  
  gravarCookie('planoz_externo', '');  

  //faz com que o app android saiba o ultimo grupo selecionado 
  gravarCookie('planoz_last_grupo', <?php echo $_SESSION["planoz_grupo"]; ?>);

  function animaIndicador()
    {
    $('#iIndicador').css("display","inline");  
    var indCor = '';
    setInterval(function()
                  { 
                  if(indCor == '#ffffff'){indCor = '#5bc0de';} else {indCor = '#ffffff';}
                  $('#iIndicador').css("color",indCor);
                  }, 1000);
    }

</script>