<?php
  @header("Content-Type: text/html; charset=UTF-8",true);;
  @session_start();

  include "config.conf";
  require_once("funcoes.php");  

  if(!isset($_GET["acao"])){$_GET["acao"] = "";}
  if(!isset($_POST["txBannerCod"])){$_POST["txBannerCod"] = "";}

	$msg = "";

  if($_GET["acao"] == "BANNERUPLOAD")
    {
    $ret = "";
    //Verifica se o arquivo pode ser enviado
    if(!isset($_FILES["txBannerFile"])){$ret = "O arquivo não foi selecionado!";}
    if($ret == ""){if($_FILES["txBannerFile"]["name"]==""){$ret = "O arquivo não foi selecionado!";}}
    if($ret == ""){if($_FILES["txBannerFile"]["error"]!=0){$ret = "Erro ".$_FILES["txBannerFile"]["error"]." ao enviar o arquivo para o servidor!";}}
    if($ret == ""){if($_FILES["txBannerFile"]["tmp_name"]==''){$ret = "Erro desconhecido ao enviar o arquivo para o servidor!";}}
    set_time_limit(900);  //15 minutos
    //Copia o arquivo para o diretorio tmp
    if($ret == "")
      {
      $ret = "OK";  
      $fileFinal = $dbPathDados."\\plataforma\\grupos\\".$_POST["txBannerCod"]."\\banner1.jpg";
      $fileTmp = $_FILES["txBannerFile"]["tmp_name"]; 
      if(file_exists($fileFinal)){unlink($fileFinal);}
      if(!move_uploaded_file($fileTmp, $fileFinal)){$ret = "Erro ao mover o arquivo no servidor!";}
      }
    header("Location: personalizacao.php?aba=3");
    exit;
    }

  if($_GET["acao"] == "BANNEREXCLUIR")
    {
    $ret = "Erro desconhecido ao excluir a banner";
    $fileDefault = $dbPathDados."\\plataforma\\grupos\\banner.jpg";
    $fileFinal = $dbPathDados."\\plataforma\\grupos\\".$_GET["id"]."\\banner1.jpg";
    if(copy($fileDefault, $fileFinal)){$ret="OK";} else {$ret = "Erro ao excluir o banner";}    
    echo $ret;
    exit;
    }       

?>
<div class="modal fade" id="modalBanner" tabindex="-1" role="dialog">
  <div class="modal-dialog" style="width:600px">
    <div class="modal-content"  >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Enviar banner</h4>
      </div>
      <div class="modal-body">
        <form action="personalizacao_banner.php?acao=BANNERUPLOAD" enctype="multipart/form-data" method="POST" id="fmBannerUpload" name="fmBannerUpload">
          <input id="txBannerCod" name="txBannerCod" type="hidden" value="">
          <input id="txBannerFile" name="txBannerFile" type="file" class="filestyle" data-buttonText="&nbsp;Selecionar&nbsp;" data-buttonName="btn-info" style="width: 570px">
        </form>  
      </div>
      <div class="modal-footer">
        <table width="100%">
          <tr>
            <td>
              <button type="button" class="btn btn-primary" onclick="bannerUpload()" style="width: 100px">Enviar</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </td>
            <td align="right">
              <button type="button" class="btn btn-danger" onclick="bannerExcluir()" style="width: 130px">Excluir Banner</button>
            </td>
          </tr>  
        </table>  
      </div>
    </div>
  </div>
</div>
<script>

  function alterarBanner(codigo)
    {
    fmBannerUpload.txBannerCod.value = codigo; 
    $('#modalBanner').modal();
    setTimeout(function(){fmBannerUpload.txBannerFile.focus();}, 500);
    }

  function bannerUpload()
    {
    setTimeout(function(){fmBannerUpload.submit();}, 200);
    }

  function bannerExcluir()
    {
    if(confirm('Deseja realmente excluir a banner ?')==true)
      {
      $.ajax({
          type: 'GET',
          url: 'personalizacao_banner.php?acao=BANNEREXCLUIR&id='+fmBannerUpload.txBannerCod.value,
          error: function(){alerta('Ocorreu um erro no Ajaz jQuery.','danger');},
          success: function(msg)
            {
            if(msg.trim() == 'OK')
              {window.location.href = 'personalizacao.php?aba=3';} 
            else 
              {alerta(msg,'danger');}
            }
          });
        }
      }

</script>