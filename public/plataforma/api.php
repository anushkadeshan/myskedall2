<?php 
  header("Content-Type: text/html; charset=UTF-8",true);
  session_start();

  include "config.conf";
  require_once("funcoes.php");
  require_once("funcoes_db.php");

  if(!isset($_GET["acao"])){$_GET["acao"] = "";}

  if($_GET["acao"] == "MUDAGRUPO")
    {
    $_SESSION["planoz_grupo"] = $_GET["idGrupo"];
    $dados = array();
    $dados[] = "idGrupo = ".$_GET["idGrupo"];
    $dados[] = "temAvisoGrupo = 0";
    $msg = db_ExecutaSQL("EDIT", "usuarios", "idUsuario = ".$_SESSION["planoz_userId"], $dados);
    echo "OK";
    exit;
    }

  // CEP ----------------------------------------------------------------------------------------------------
  // api.php?cep=06045360
  //
  if(isset($_GET["cep"]) && $_GET["cep"] != "")
    {
    $cep = str_replace('-','',$_GET['cep']);
    $url = "http://cep.republicavirtual.com.br/web_cep.php?formato=xml&cep=".$cep;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);
    $reg = simplexml_load_string($result);
    $dados['sucesso'] = (string) $reg->resultado;
    $dados['rua']     = (string) $reg->tipo_logradouro . ' ' . $reg->logradouro;
    $dados['bairro']  = (string) $reg->bairro;
    $dados['cidade']  = (string) $reg->cidade;
    $dados['estado']  = (string) $reg->uf;
    echo json_encode($dados);
    exit;
    }

  // GRAVAR CONFIGURACOES -----------------------------------------------------------------------------------------
  // api.php?acao=GRAVARCONFIG&idUsuario=1&campo=nome&valor=alexandre
  //
  if($_GET["acao"]=="GRAVARCONFIG")
    {
    if(isset($_GET["idUsuario"])){$idUsuario = $_GET["idUsuario"];} else {$idUsuario = "0";}
    if(isset($_GET["campo"])){$campo = $_GET["campo"];} else {$campo = "";}
    if(isset($_GET["valor"])){$valor = $_GET["valor"];} else {$valor = "";}
    $ret = gravarConfig($idUsuario, $campo, $valor);
    echo $ret;
    exit;
    }

  // GRAVAR CALENDARIO -----------------------------------------------------------------------------------------
  // api.php?acao=GRAVARCALENDARIO&key=55B287FX2&idGrupo=1&dataIni=2019-03-01&dataFim=2019-03-04&titulo=teste api&url=http://www.liondas.com.br
  //
  if($_GET["acao"]=="GRAVARCALENDARIO")
    {
    $ret = "";
    if(!isset($_GET["key"])){$ret = "Erro, faltam parametros";}
    if(!isset($_GET["idGrupo"])){$ret = "Erro, faltam parametros";}
    if((!isset($_GET["dataIni"])) || $_GET["dataIni"] == ""){$ret = "Erro, faltam parametros";}
    if(!isset($_GET["titulo"])){$ret = "Erro, faltam parametros";}
    if($ret == "")
      {
      if((!isset($_GET["dataFim"])) || $_GET["dataIni"] == ""){$_GET["dataFim"] = $_GET["dataIni"];}
      if(!isset($_GET["url"])){$_GET["url"] = "";}
      $dados = array();  
      $dados[] = "idGrupo = ".$_GET["idGrupo"]; 
      $dados[] = "dataIni = '".$_GET["dataIni"]."'"; 
      $dados[] = "dataFim = '".$_GET["dataFim"]."'"; 
      $dados[] = "titulo = '".$_GET["titulo"]."'"; 
      $dados[] = "url = '".$_GET["url"]."'"; 
      $ret = db_ExecutaSQL("NEW", "pla_grupos_calendario", "", $dados);
      }
    echo $ret;
    exit;
    }
  echo "Erro, comando invalido"

?>