<?php
  header("Content-Type: text/html; charset=UTF-8",true);
  session_start();

  include "config.conf";
  require_once("funcoes.php");
  require_once("funcoes_db.php");

  if(!Login()){header("Location: index.php");}

  if(!isset($_GET["acao"])){$_GET["acao"] = "";}

  if($_GET["acao"]=="CARREGARPAINEL")
    {

    $regs = "";
    $quadros = scandir($dbPathDados."plataforma\\grupos\\".$_SESSION["planoz_grupo"]."\\downloads");

    $ret  = "<table width='100%' class='painel'>";
    for($i=0; $i<count($quadros); $i++)
      {
      if($quadros[$i] != "." && $quadros[$i] != "..")  
        {
        if($i % 2 == 0){$ret .= "<tr>";}
        $titulo = explode("_",$quadros[$i]);
        $titulo = $titulo[0];
        $tipo = strtolower(substr($quadros[$i],-3));
        $nome = str_replace("_"," ",$quadros[$i]);
        $nome = substr($nome,0,strlen($nome)-4);
        $nome = substr($nome,-(strlen($nome)-strlen($titulo))+1);

        if($tipo == "pdf")
          {$icone = "<img src='imagens/pdf.png' width='40'>";}
        else if($tipo == "xls")
          {$icone = "<img src='imagens/excel.png' width='40'>";}
        else
          {$icone = "<img src='imagens/file.png' width='40'>";}
       
        $regs .= "<tr onclick='beep(); window.location = \""."baixar.php?arquivo=".str_replace("\\","\\\\", $dbPathDados)."\\\\plataforma\\\\grupos\\\\".$_SESSION["planoz_grupo"]."\\\\"."downloads"."\\\\".$quadros[$i]."\"'>";
        $regs .= "<td width='40' align='center' style='padding:10px; padding-right:5px'>".$icone."</td>";
        $regs .= "<td style='padding:10px;'>";
        $regs .= "  <div class='appTitulo'>".$titulo."</div>";
        $regs .= "  <div class='appDescricao'>".$nome."</div>";
        $regs .= "</td>";      
        $regs .= "</tr>";
        $regs .= "<tr><td colspan='2'><hr style='padding:0px; margin:0px;'></td></tr>";

        }
      }

    $ret  = "<table width='100%' class='painelNivel'>";
    $ret .= "  <tr>";
    $ret .= "    <td id='td1' width='100%' onclick='beep(); mudarPainel(1)'>Downloads</td>"; 
    $ret .= "  </tr>";
    $ret .= "  <tr>";
    $ret .= "    <td id='td1Aux' style='font-size:2px; padding:0px; background-color:#999999'>&nbsp;</td>"; 
    $ret .= "  </tr>";
    $ret .= "</table>";  

    $ret .= "<table class='lista' style='width:100%; color:#333333'>";
    $ret .= $regs;
    $ret .= "<tr>";
    $ret .= "  <td colspan='2' style='height:60px; background-color:#ffffff; text-align:center;' onclick='irPara(\"home.php\")'>";
    $ret .= "    <img src='imagens/voltar.png' width='40'>";
    $ret .= "  </td>";
    $ret .= "</tr>";
    $ret .= "</table>";  

    echo $ret;
    exit;
    }

?>
<script src='objetos/jquery/jquery.min.js'></script>
<script src='objetos/bootstrap/js/bootstrap.min.js'></script>
<script src="objetos/plugins/multiselect/bootstrap-multiselect.js"></script>
<script src='funcoes.js'></script>
<script>

  function carregarPainel()
    {
    $.ajax({
      type: 'GET',
      url: 'downloads.php?acao=CARREGARPAINEL',
      error: function(){alerta('Ocorreu um erro no Ajaz jQuery','danger');},
      success: function(msg){$('#dvPainel').html(msg);}
      });
    }

</script>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $tituloSite; ?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="objetos/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="objetos/plugins/awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="objetos/plugins/multiselect/bootstrap-multiselect.css" rel="stylesheet">
	<link href="style.css" rel="stylesheet">
</head>
<body>
  <div class="workspace sombra">
    <?php $pagAtual = nomePaginaAtual(); include "menu.php" ?>
    <div id='dvPainel'></div>
  </div>
  <?php require_once "alerta.php"; ?>
</body>
</html>
<script>
  carregarPainel();  
</script>