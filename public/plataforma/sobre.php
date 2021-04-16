<?php
  @header("Content-Type: text/html; charset=UTF-8",true);
  @session_start();

  include "config.conf";
	require_once("funcoes.php");
  require_once("funcoes_db.php");

  if(!isset($_GET["acao"])){$_GET["acao"] = "";}

	$msg = "";

  if($_GET["acao"] == "LER")
    {
    $con = new PDO($dbString,$dbUser,$dbPwd);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($con)
      {
      $con->query("SET NAMES 'utf8'");
      $con->query("SET character_set_connection=utf8");
      $con->query("SET character_set_client=utf8");
      $con->query("SET character_set_results=utf8");        
      $sql  = "SELECT * FROM usuarios WHERE idUsuario = ".$_GET["codigo"]." LIMIT 1" ;
      $tab = $con->query($sql);
      if($tab)
        {
        while($reg = $tab->fetch())
          {
          $idFoto = achaFoto($reg['idUsuario']);
          $msg =  $reg['idUsuario'].";".$reg['nome'].";".$reg['apelido'].";".$reg['email'].";".$reg['senha'].";".
                  $reg['fone'].";".$reg['endereco'].";".$reg['cep'].";".$reg['bairro'].";".$reg['cidade'].";".$reg['uf'].";".
                  $reg['profissao'].";".$reg['rg'].";".$reg['cpf'].";".$reg['nivel'].";".$reg['status'].";".
                  $reg['dataInclusao'].";".$reg['dataAlteracao'].";".DatBR($reg['dataLogin']).";".
                  $idFoto;
          }
        $tab = NULL;
        }
      $con = NULL;
      }
    echo $msg;
    exit;
    }

?>
<div class="modal fade" id="modalSobre" tabindex="-1" role="dialog" aria-labelledby="modalSobreTitulo" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width:95%; max-width:600px;">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title" id="modalSobreTitulo">Sobre</h5></div>
      <div class="modal-body">

        <table width="95%" align="center" style="margin-top:3px; font-size: 20px;">
          <tr><td style="font-weight:bold;">PlanOz</td></tr>
        </table>

        <table width="95%" align="center" style="margin-top:10px;">
          <tr><td colspan="3" style="font-weight:bold;">Aplicativo Android</td></tr>
          <tr><td width="55">versão</td><td width="5">:</td><td><div id="dvVersao"></div></td></tr>
          <tr><td>grupo</td><td>:</td><td><?php echo $_SESSION["planoz_grupo"]; ?></td></tr>
        </table>
        <table width="95%" align="center" style="margin-top:10px;">
          <tr><td style="font-weight:bold;">Desenvolvedores</td></tr>
          <tr><td>www.prak.com.br</td></tr>
          <tr><td>www.liondas.com.br</td></tr>
        </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" style="width:90px;">Sair</button>
      </div>
    </div>
  </div>
</div>
<script>
  
  function sobre()
    {
    var info = ''; try{info = Android.appInfo();} catch(e){}  
    var res = info.split(";");
    $('#dvVersao').html(res[0]);
    $('#modalSobre').modal();
    }

</script>