<?php
  @header("Content-Type: text/html; charset=UTF-8",true);;
  @session_start();

  include "config.conf";
  require_once("funcoes.php");
  require_once("funcoes_db.php");

  if(!isset($_GET["acao"])){$_GET["acao"] = "";}

	$ret = "";

  if($_GET["acao"] == "LERCONFIG")
    {
    $con = new PDO($dbString,$dbUser,$dbPwd);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($con)
      {
      $con->query("SET NAMES 'utf8'");
      $con->query("SET character_set_connection=utf8");
      $con->query("SET character_set_client=utf8");
      $con->query("SET character_set_results=utf8");        
      $sql  = "SELECT * FROM usuarios_config WHERE idUsuario = ".$_POST["idUsuario"]." LIMIT 1" ;
      $tab = $con->query($sql);
      if($tab)
        {
        while($reg = $tab->fetch())
          {
          $ret =  $reg['idUsuario'].";".$reg['eveNome'].";".$reg['eveObjetivo'].";".$reg['eveEndereco'].";".$reg['eveData'].";".$reg['eveHoraIni'].";".$reg['eveHoraFim'].";".$reg['eveModelo'];
          }
        $tab = NULL;
        }
      $con = NULL;
      }
    echo $ret;
    exit;
    }

  if($_GET["acao"] == "CARREGATAREFAS")
    {
    $con = new PDO($dbString,$dbUser,$dbPwd);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($con)
      {
      $con->query("SET NAMES 'utf8'");
      $con->query("SET character_set_connection=utf8");
      $con->query("SET character_set_client=utf8");
      $con->query("SET character_set_results=utf8");  

      $ret .= "<table width='100%' class='tabela-zebrada'>";
      $sql = "SELECT * FROM tar_modelos WHERE modelo = '".$_POST["modelo"]."' ORDER BY ordem, atividade, tarefa";
      $tab = $con->query($sql);
      if($tab)
        {
        while($reg = $tab->fetch())
          {
          $ret .= "<tr>";
          $ret .= "<td valign='top' style='width:25px; padding-top:0px;'>";
          $ret .= "  <input type='checkbox' idModelo='".$reg["idModelo"]."' modelo='".$reg["modelo"]."' onClick='beep(); selecionaWzdModelo(this)' style='width:20px; height:20px'>";
          $ret .= "</td>";
          $ret .= "<td>".$reg["atividade"]." - ".$reg["tarefa"]."</td>";
          $ret .= "</tr>";
          }
        $tab= NULL;
        }
      $ret .= "</table>";  
      $con = NULL;
      }
    echo $ret;
    exit;
    }  

 	if($_GET["acao"] == "GRAVAR")
	  {

    $next = dbProximoId("tar_eventos");

    //Grava o evento
    $dados = array();  
    $dados[] = "idEvento    =  ".$next; 
    $dados[] = "idGrupo     =  ".$_SESSION["login_grupo"]; 
    $dados[] = "evento      = '".$_POST["nome"]."'"; 
    $dados[] = "objetivo    = '".$_POST["objetivo"]."'"; 
    $dados[] = "endereco    = '".$_POST["endereco"]."'"; 
    $dados[] = "horaIni     = '".$_POST["horaIni"]."'";
    $dados[] = "horaFim     = '".$_POST["horaFim"]."'";         
    $dados[] = "idModerador = ".$_SESSION["login_codigo"];
    $msg = db_ExecutaSQL("NEW", "tar_eventos", "", $dados);

    //Grava a data
    if($msg == "OK")
      {
      $data = substr($_POST["data"],6,4)."-".substr($_POST["data"],3,2)."-".substr($_POST["data"],0,2);
      $dados = array("idEvento = ".$next, "data = '".$data."'");
      $msg = db_ExecutaSQL("NEW", "tar_eventos_datas", "", $dados);
      }

    //Grava as tarefas
    if($msg == "OK")
      {
      $con = new PDO($dbString,$dbUser,$dbPwd);
      $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      if(!$con)
        {$msg = "ERRO";}
      else
        {
        $con->query("SET NAMES 'utf8'");
        $con->query("SET character_set_connection=utf8");
        $con->query("SET character_set_client=utf8");
        $con->query("SET character_set_results=utf8");        

        $tarefas = explode(';',$_POST["tarefas"]);
        foreach ($tarefas as $idTarefa)
          {
          if($msg == "OK" && $idTarefa != '')
            {  
            $sql  = "SELECT * FROM tar_modelos WHERE idModelo = ".$idTarefa." LIMIT 1" ;
            //echo $sql;
            $tab = $con->query($sql);
            if($tab)
              {
              while($reg = $tab->fetch())
                {
                $dados = array();  
                $dados[] = "tarefa    = '".$reg['tarefa']."'"; 
                $dados[] = "horaIni   = '".$_POST["horaIni"]."'";
                $dados[] = "horaFim   = '".$_POST["horaFim"]."'";         
                $dados[] = "atividade = '".$reg['atividade']."'"; 
                $dados[] = "descricao = '".$reg['tarefa']."'"; 
                $dados[] = "idEvento  = ".$next; 
                $dados[] = "ordem     = ".$reg['ordem']; 
                $dados[] = "acao      = 1"; 
                $msg = db_ExecutaSQL("NEW", "tar_tarefas", "", $dados);
                }
              $tab = NULL;
              }
            }    
          }
        $con = NULL;
        }
      }

    if($msg == "OK"){$ret = $next;} else {$ret = "Erro ao gravar o novo evento";}
    echo $ret;
    exit;
	  }

?>
<div class="modal fade" id="modalEditWzdEvento" tabindex="-1" role="dialog" aria-labelledby="modalEditWzdEventoTitulo" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width:525px;">
    <div class="modal-content">
      <div class="modal-body">
        <div style="position:absolute; top:10px; right:10px; z-index:99"><a href="javascript:beep(); $('#modalEditWzdEvento').modal('hide');"><?php echo iconRemove; ?></a></div>
        <!-- NOME -->
        <div id="tabWzd1">
          <div class="input-group" style="width:100%;">
            <div class="tituloWizard">Nome do evento</div>
            <input type="text" name="txEditWzdEventoNome" id="txEditWzdEventoNome" value="" maxlength="255" class="form-control">
            <table width="100%">
              <tr>
                <td><a href="javascript:beep(); limparCamposWizard()" style="font-size: 12px;">limpar campos</a></td>
                <td align="right"><button class="btn btn-default botaoWizard" style="float:right;" onClick="beep(); WzdEventoTab(2)"><?php echo iconOk; ?> avançar</button></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- OBJETIVO -->
        <div id="tabWzd2">
          <div class="input-group" style="width:100%;">
            <div class="tituloWizard">Objetivo do evento</div>
            <textarea name="txEditWzdEventoObjetivo" id="txEditWzdEventoObjetivo" rows="4" maxlength="1000" class="form-control" style=" resize:vertical;"></textarea>
            <button class="btn btn-default botaoWizard" style="float:right;" onClick="beep(); WzdEventoTab(3)"><?php echo iconOk; ?> avançar</button>
          </div>
        </div>
        <!-- ENDERECO -->
        <div id="tabWzd3">
          <div class="input-group" style="width:100%;">
            <div class="tituloWizard">Endereço do evento</div>
            <input type="text" name="txEditWzdEventoEndereco" id="txEditWzdEventoEndereco" value="" maxlength="255" class="form-control">
            <button class="btn btn-default botaoWizard" style="float:right;" onClick="beep(); WzdEventoTab(4)"><?php echo iconOk; ?> avançar</button>
          </div>
        </div>
        <!-- DATA -->
        <div id="tabWzd4">
          <div class="input-group" style="width:100%;">
            <div class="tituloWizard">Data do evento</div>
            <input name="txEditWzdEventoData" id="txEditWzdEventoData" type="text" value="" maxlength="10" style="width:120px;" class="form-control">
            <button type="button" class="btn btn-default" onClick="beep(); $('#txEditWzdEventoData').datetimepicker('show')" style="width:30px;"><span style="color:#999999; margin-left:-5px;" class="glyphicon glyphicon-calendar" aria-hidden="true"></span></button>
            <button class="btn btn-default botaoWizard" style="float:right;" onClick="beep(); WzdEventoTab(5)"><?php echo iconOk; ?> avançar</button>
          </div>
          <script>
            $('#txEditWzdEventoData').datetimepicker({closeOnDateSelect:true, allowBlank:true, defaultSelect:true, datepicker:true, timepicker:false, dayOfWeekStart:0, format:'d/m/Y', mask:'39/19/9999', lang:'pt', startDate:''});
          </script>
        </div>
        <!-- HORARIO -->
        <div id="tabWzd5">
          <div class="input-group" style="width:100%;">
            <div class="tituloWizard">Horário do evento</div>
            <!-- <input name="txEditWzdEventoData" id="txEditWzdEventoData" type="text" value="" maxlength="10" style="width:120px;" class="form-control"> -->
          </div>
          <table width="98%" align="center" style="font-size:15px; color:#999999 ">
            <tr>
              <td width="65">
                <input class="form-control" id="txEditWzdEventoHoraIni" value="00:00" style="width:55px;">
                <script>$('#txEditWzdEventoHoraIni').clockpicker({placement:'bottom', align:'left', autoclose:true, 'default':'now'}); </script>
              </td>
              <td width="25">às</td>
              <td>
                <input class="form-control" id="txEditWzdEventoHoraFim" value="00:00" style="width:55px;">
                <script>$('#txEditWzdEventoHoraFim').clockpicker({placement:'bottom', align:'left', autoclose:true, 'default':'now'}); </script>
              </td>
            </tr>
            <tr>
              <td colspan="3">
                <div style="text-align: right;">
                  <button class="btn btn-default botaoWizard" onClick="beep(); WzdEventoTab(6)"><?php echo iconOk; ?> avançar</button>
                </div>
              </td>
            </tr>  
          </table>  
        </div>
        <!-- MODELOS -->
        <div id="tabWzd6">
          <div class="input-group" style="width:100%;">
            <div class="tituloWizard">Escolha um modelo de evento</div>
            <select name="txEditWzdEventoModelo" id="txEditWzdEventoModelo" class="form-control" onclick="beep(); carregaWzdModelo()">
              <option value=''>selecionar um modelo</option>
              <option value='0'>não usar modelo</option>
              <?php 
                $con = new PDO($dbString,$dbUser,$dbPwd);
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                if($con)
                  {
                  $con->query("SET NAMES 'utf8'");
                  $con->query("SET character_set_connection=utf8");
                  $con->query("SET character_set_client=utf8");
                  $con->query("SET character_set_results=utf8");  
                  $sql = "SELECT modelo FROM tar_modelos GROUP BY modelo ORDER BY modelo";
                  $tab = $con->query($sql);
                  if($tab)
                    {
                    while($reg = $tab->fetch())
                      {
                      echo "<option value='".$reg['modelo']."'>".$reg['modelo']."</option>";
                      }
                    $tab = NULL;
                    }
                  $con = NULL;
                  } 
              ?>
            </select>
            <button class="btn btn-default botaoWizard" style="float:right;" onClick="beep(); WzdEventoTab(7)"><?php echo iconOk; ?> avançar</button>
          </div>
        </div>        

        <!-- TAREFAS -->
        <div id="tabWzd7">
          <div class="input-group" style="width:100%;">
            <div class="tituloWizard">Escolha as tarefas</div>
            <div id="dvModelos" style="width:100%; height:250px; overflow-y:scroll; z-index: 9999999"></div>
            <input type="hidden" id="txEditWzdTarefas" value="">
            <table width="100%">
              <tr>
                <td><a href="javascript:beep(); selecionarTudoWizard()" style="font-size: 12px;">selecionar todos</a></td>
                <td align="right"><button class="btn btn-default botaoWizard" style="float:right;" onClick="beep(); WzdEventoTab(0)"><?php echo iconOk; ?> avançar</button></td>
              </tr>
            </table>
          </div>
        </div>     

        <!-- SALVAR -->
        <div id="tabWzd0" style="text-align:center">
          <div class="input-group" style="width:100%;">
            <div class="tituloWizard"><i class="fa fa-flag-checkered" aria-hidden="true"></i> Parabéns!</div><br>
            <div style="color:#999999; font-size:17px; margin-top:-15px;">Você criou o seu evento, basta agora clicar em salvar</div>
          </div>
          <button id="btGravarEventoWizard" class="btn btn-success" style="width:100px; height:50px; margin-top:25px; font-size:18px;" onClick="beep(); gravarWzdEvento()">salvar</button>
        </div>
      </div>

      <!-- BOTOES -->
      <div class="modal-footer" style="padding: 10px;">
        <div class="modalTitulo" style="font-size:12px; color:#999999; margin-left:5px;">Assistente de criação de evento</div>
        <div class="row" style="margin:5px; ">
          <div class="col-xs-3 col-md-3" style="padding:1px;"><button id="btWzdEvento1" class="btn btn-default navTab" onClick="beep(); WzdEventoTab(1)">1<br>Nome</button></div>
          <div class="col-xs-3 col-md-3" style="padding:1px;"><button id="btWzdEvento2" class="btn btn-default navTab" onClick="beep(); WzdEventoTab(2)">2<br>Objetivo</button></div>
          <div class="col-xs-3 col-md-3" style="padding:1px;"><button id="btWzdEvento3" class="btn btn-default navTab" onClick="beep(); WzdEventoTab(3)">3<br>Endereço</button></div>
          <div class="col-xs-3 col-md-3" style="padding:1px;"><button id="btWzdEvento4" class="btn btn-default navTab" onClick="beep(); WzdEventoTab(4)">4<br>Data</button></div>
          <div class="col-xs-3 col-md-3" style="padding:1px;"><button id="btWzdEvento5" class="btn btn-default navTab" onClick="beep(); WzdEventoTab(5)">5<br>Horário</button></div>
          <div class="col-xs-3 col-md-3" style="padding:1px;"><button id="btWzdEvento6" class="btn btn-default navTab" onClick="beep(); WzdEventoTab(6)">6<br>Modelos</button></div>
          <div class="col-xs-3 col-md-3" style="padding:1px;"><button id="btWzdEvento7" class="btn btn-default navTab" onClick="beep(); WzdEventoTab(7)">7<br>Tarefas</button></div>
          <div class="col-xs-3 col-md-3" style="padding:1px;"><button id="btWzdEvento0" class="btn btn-default navTab" onClick="beep(); WzdEventoTab(0)">Concluir</button></div>
        </div>
        <table width="98%" align="center" style="margin-top:10px;">
          <tr>
            <td>
              <div class='progress' style='height:16px; background-color:#dddddd;'>
                <div id='pbWzdEvento' class='progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:0%;'></div>
              </div>        
            </td>
            <td width="40" align="right" valign="top"><div id='pbWzdEventoValue' style="font-size:13px; color:#337ab7;">0%</span></td>
          </tr>    
        </table>
      </div>

    </div>
  </div>
</div>
<script>

  function wizardEvento()
    { 
    botaoGravar('btGravarEventoWizard',true);  
    //carrega ultimas configuracoes  
    $.ajax({
      type: 'POST',
      url: 'eventos_wizard.php?acao=LERCONFIG',
      data: {idUsuario:<?php echo $_SESSION["login_codigo"]; ?>},
      error: function(){alerta('Ocorreu um erro no Ajaz jQuery','danger');},
      success: function(msg)
        {
        if(msg == 'ERRO')
          {alerta('Erro ao carregar regitro para alteração','danger');} 
        else 
          {
          if(msg != '')  
            {
            try
              {
              var res = msg.split(";");
              txEditWzdEventoNome.value = res[1];
              txEditWzdEventoObjetivo.value = res[2];
              txEditWzdEventoEndereco.value = res[3];
              txEditWzdEventoData.value = res[4];
              txEditWzdEventoHoraIni.value = res[5];
              txEditWzdEventoHoraFim.value = res[6];
              txEditWzdEventoModelo.value = res[7]; 
              if(txEditWzdEventoModelo.value != '' && txEditWzdEventoModelo.value != '0'){carregaWzdModelo();}

              if(txEditWzdEventoNome.value=='' && txEditWzdEventoObjetivo.value=='')
                {limparCamposWizard();}

              }
            catch(e){}
            }
          }        
        wizardEvento2();
        }
      });
    }

  function wizardEvento2()
    { 
    $('#modalEditWzdEvento').modal({backdrop: 'static', keyboard: false});
    WzdEventoTab(1);

    var bVazio = true;
    for(var i=1; i<=7; i++){if($('#btWzdEvento'+i).hasClass('btn-success')){bVazio = false;}}
    if(!bVazio)  
      {
      var ret = confirm('Existe uma criação de evento em andamento, clique em ok para continuar ou cancelar para iniciar um novo');
      if(!ret){limparCamposWizard();}
      }

    setTimeout(function(){$('#txEditWzdEventoNome').select();}, 500);
    }

  function WzdEventoTab(id)
    {
    //verifica se pode avancar
    if((id==0 || id>7) && txEditWzdEventoNome.value == ''){alerta('Falta informar o nome do evento;','alert'); return}
    if((id==0 || id>7) && txEditWzdEventoObjetivo.value == ''){alerta('Falta informar o objetivo do evento;','alert'); return}
    if((id==0 || id>7) && txEditWzdEventoEndereco.value == ''){alerta('Falta informar o endereço do evento;','alert'); return}
    if((id==0 || id>7) && (txEditWzdEventoData.value == '' || txEditWzdEventoData.value == '__/__/____')){alerta('Falta informar a data do evento;','alert'); return}
    if((id==0 || id>7) && (txEditWzdEventoHoraIni.value == '' && txEditWzdEventoHoraFim.value == '')){alerta('Falta informar a hora do evento;','alert'); return}
    if((id==0 || id>7) && txEditWzdEventoModelo.value == ''){alerta('Falta informar o modelo do evento;','alert'); return}
    if((id==0 || id>7) && txEditWzdTarefas.value == '' && txEditWzdEventoModelo.value == ''){alerta('Falta informar pelo menos uma tarefa;','alert'); return}
    if((id==7) && txEditWzdEventoModelo.value == ''){alerta('Falta informar o modelo do evento;','alert'); return}
    //if((id==7) && txEditWzdEventoModelo.value == '0'){alerta('Você selecionou o modelo para cadastrar as tarefas manualmente;','alert'); return}

    //permite salvar o evento no botão concluir
    if(id == 0){if($('#tabWzd0').is(":visible")){gravarWzdEvento();}}

    if(!$('#tabWzd'+id).length){id=0;}  
    //remove atributos dos elementos  
    for(var i=0; i<999; i++){if($('#tabWzd'+i).length){$('#tabWzd'+i).hide();} else {break;}}
    for(var i=0; i<999; i++){if($('#btWzdEvento'+i).length){$('#btWzdEvento'+i).removeClass('btn-primary'); $('#btWzdEvento'+i).removeClass('btn-success');} else {break;}}
    $('#txEditWzdEventoData').datetimepicker('hide');

    //botao concluido
    var pbOK=0; var pbTot=0; 
    if(txEditWzdEventoNome.value != ''){$('#btWzdEvento1').addClass('btn-success'); pbOK++;} pbTot++;
    if(txEditWzdEventoObjetivo.value != ''){$('#btWzdEvento2').addClass('btn-success'); pbOK++;} pbTot++;
    if(txEditWzdEventoEndereco.value != ''){$('#btWzdEvento3').addClass('btn-success'); pbOK++;} pbTot++;
    if(txEditWzdEventoData.value != '' && txEditWzdEventoData.value != '__/__/____'){$('#btWzdEvento4').addClass('btn-success'); pbOK++;} pbTot++;
    if(txEditWzdEventoHoraIni.value != '' && txEditWzdEventoHoraFim.value != ''){$('#btWzdEvento5').addClass('btn-success'); pbOK++;} pbTot++;
    if(txEditWzdEventoModelo.value != ''){$('#btWzdEvento6').addClass('btn-success'); pbOK++;} pbTot++;
    if(txEditWzdTarefas.value != '' || txEditWzdEventoModelo.value == '0'){$('#btWzdEvento7').addClass('btn-success'); pbOK++;} pbTot++;

    //botao ativo
    $('#btWzdEvento'+id).removeClass('btn-success');
    $('#btWzdEvento'+id).addClass('btn-primary');  
    $('#tabWzd'+id).fadeIn('medium');  
    //barra de progresso
    var pbPorc = 0;
    if(pbTot != 0){pbPorc = parseInt((pbOK/pbTot)*100);}
    $('#pbWzdEvento').css('width', pbPorc+'%').attr('aria-valuenow', pbPorc);
    $('#pbWzdEventoValue').html(pbPorc+'%');
    //coloca o focus no campo ao exibir
    var txFocus = '';
    if($('#tabWzd1').is(":visible")){txFocus = 'txEditWzdEventoNome';}
    if($('#tabWzd2').is(":visible")){txFocus = 'txEditWzdEventoObjetivo';}
    if($('#tabWzd3').is(":visible")){txFocus = 'txEditWzdEventoEndereco';}
    if($('#tabWzd4').is(":visible")){txFocus = 'txEditWzdEventoData';}

    //Grava os valores do campo para recuperacao se necessário;
    if(id == 2){gravarConfig(<?php echo $_SESSION["login_codigo"]; ?>, 'eveNome', txEditWzdEventoNome.value);}
    if(id == 3){gravarConfig(<?php echo $_SESSION["login_codigo"]; ?>, 'eveObjetivo', txEditWzdEventoObjetivo.value);}
    if(id == 4){gravarConfig(<?php echo $_SESSION["login_codigo"]; ?>, 'eveEndereco', txEditWzdEventoEndereco.value);}
    if(id == 5){gravarConfig(<?php echo $_SESSION["login_codigo"]; ?>, 'eveData', txEditWzdEventoData.value);}
    if(id == 6)
      {
      gravarConfig(<?php echo $_SESSION["login_codigo"]; ?>, 'eveHoraIni', txEditWzdEventoHoraIni.value);
      gravarConfig(<?php echo $_SESSION["login_codigo"]; ?>, 'eveHoraFim', txEditWzdEventoHoraFim.value);
      }
    if(id == 7){gravarConfig(<?php echo $_SESSION["login_codigo"]; ?>, 'eveModelo', txEditWzdEventoModelo.value);}

    //sem modelo
    if(id == 7 && txEditWzdEventoModelo.value == '0'){WzdEventoTab(0)}

    if(txFocus != ''){setTimeout(function(){$('#'+txFocus).select();}, 500);}

    }

  function carregaWzdModelo()
    {
    $('#txEditWzdTarefas').val('');
    $('#dvModelos').html('');
    $.ajax({
      type: 'POST',
      url: 'eventos_wizard.php?acao=CARREGATAREFAS',
      data: {modelo:$('#txEditWzdEventoModelo').val()},
      error: function(){alerta('Ocorreu um erro no Ajaz jQuery','danger');},
      success: function(msg){$('#dvModelos').html(msg);}
      });
    }

  function selecionaWzdModelo(obj)
    {
    var idModelo = $(obj).attr('idModelo');
    var modelo = $(obj).attr('modelo');
    var val = 0; if($(obj).prop('checked')){val = 1;}
    var sVal = $('#txEditWzdTarefas').val();
    if(val){sVal = sVal+';'+idModelo+';'} else {sVal = replaceAll(sVal, ';'+idModelo+';', '');}
    $('#txEditWzdTarefas').val(sVal);
    }

  function gravarWzdEvento()
    { 
    //verifica integridade de dados
    if(txEditWzdEventoNome.value == ''){WzdEventoTab(1); alerta('O nome do evento não foi informado','danger'); return;}
    if(txEditWzdEventoObjetivo.value == ''){WzdEventoTab(2); alerta('O objetivo do evento não foi informado','danger'); return;}
    if(txEditWzdEventoEndereco.value == ''){WzdEventoTab(3); alerta('O endereço do evento não foi informado','danger'); return;}
    if(txEditWzdEventoData.value == ''){WzdEventoTab(4); alerta('A data do evento não foi informada','danger'); return;}
    if(txEditWzdEventoModelo.value == ''){WzdEventoTab(3); alerta('O modelo do evento não foi informado','danger'); return;}

    botaoGravar('btGravarEventoWizard',false);
    //envia dados para gravar
    $.ajax({
      type: 'POST',
      url: 'eventos_wizard.php?acao=GRAVAR',
      data: {nome:txEditWzdEventoNome.value, objetivo:txEditWzdEventoObjetivo.value, endereco:txEditWzdEventoEndereco.value, data:txEditWzdEventoData.value, horaIni:txEditWzdEventoHoraIni.value, horaFim:txEditWzdEventoHoraFim.value, tarefas:$('#txEditWzdTarefas').val()},
      error: function(){alerta('Ocorreu um erro no Ajaz jQuery','danger');},
      complete: function(msg){botaoGravar('btGravarEventoWizard',true);},
      success: function(msg)
        {
        if(msg == '' || msg == 'ERRO' || !$.isNumeric(msg))
          {alerta('Ocorreu um erro ao incluir o evento '+msg,'danger');}
        else
          {
          gravarConfig(<?php echo $_SESSION["login_codigo"]; ?>, 'eveNome', '');
          gravarConfig(<?php echo $_SESSION["login_codigo"]; ?>, 'eveObjetivo', '');
          gravarConfig(<?php echo $_SESSION["login_codigo"]; ?>, 'eveEndereco', '');
          gravarConfig(<?php echo $_SESSION["login_codigo"]; ?>, 'eveData', '');
          gravarConfig(<?php echo $_SESSION["login_codigo"]; ?>, 'eveHoraIni', '');
          gravarConfig(<?php echo $_SESSION["login_codigo"]; ?>, 'eveHoraFim', '');
          gravarConfig(<?php echo $_SESSION["login_codigo"]; ?>, 'eveModelo', '');
          window.location = 'escalas.php?voltar=PAINEL&exibir='+msg;
          }
        }
      });
    }

  function limparCamposWizard()
    {

    var data = new Date();
    var sdata = String(data.getYear()).substr(-2)+'.'+ String(data.getMonth()+1).padStart(2,'0') +'.'+data.getDate();

    txEditWzdEventoNome.value = sdata;
    txEditWzdEventoObjetivo.value = '';
    txEditWzdEventoEndereco.value = '';
    txEditWzdEventoData.value = '';
    txEditWzdEventoHoraIni.value = '';
    txEditWzdEventoHoraFim.value = '';
    txEditWzdEventoModelo.value = '';
    WzdEventoTab(1);
    gravarConfig(<?php echo $_SESSION["login_codigo"]; ?>, 'eveNome', '');
    gravarConfig(<?php echo $_SESSION["login_codigo"]; ?>, 'eveObjetivo', '');
    gravarConfig(<?php echo $_SESSION["login_codigo"]; ?>, 'eveEndereco', '');
    gravarConfig(<?php echo $_SESSION["login_codigo"]; ?>, 'eveData', '');
    gravarConfig(<?php echo $_SESSION["login_codigo"]; ?>, 'eveHoraIni', '');
    gravarConfig(<?php echo $_SESSION["login_codigo"]; ?>, 'eveHoraFim', '');
    gravarConfig(<?php echo $_SESSION["login_codigo"]; ?>, 'eveModelo', '');
    }

  function selecionarTudoWizard()
    {
    $('input[type="checkbox"]').each(function() {$(this).prop("checked", true); selecionaWzdModelo($(this)); });
    }

</script>