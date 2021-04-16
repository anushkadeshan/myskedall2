
//verifica se � um mobile ou pc
function isMobile()
  {
  var check = false;
  (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
  return check;
  }

function beep(){try{Android.beep(false,true);} catch(e){}}
function irPara(url){beep(); window.location.href = url;}

//funcoes para cookie (incluindo interface com Android)
function gravarCookie(name,value)
  {
  var date = new Date(); 
  date.setTime(date.getTime()+(365*24*60*60*1000)); 
  var expires = "; expires="+date.toGMTString();
  try{document.cookie = name+"="+value+expires+"; path=/";} catch(e){}
  try{Android.gravarCookie(name,value);} catch(e){}
  }
function lerCookie(name)
  {
  var ret = '';
  try
    {
    var strNomeIgual = name + "=";
    var arrCookies = document.cookie.split(';');
    for(var i = 0; i < arrCookies.length; i++)
      {
      var strValorCookie = arrCookies[i];
      while(strValorCookie.charAt(0) == ' '){strValorCookie = strValorCookie.substring(1, strValorCookie.length);}
      if(strValorCookie.indexOf(strNomeIgual) == 0){ret = strValorCookie.substring(strNomeIgual.length, strValorCookie.length); break;}
      }
    }  catch(e){}
  if(ret == ''){try{ret = Android.lerCookie(name);} catch(e){}}  
  return ret;
  }
function excluirCookie(name)
  {
  gravarCookie(name,"",-1);
  try{Android.excluirCookie(name);} catch(e){}
  }      

//grava configuracoes no banco de dados
function gravarConfig(idUsuario, campo, valor)
  {
  $.ajax({
    type: 'GET',
    url: 'api.php?acao=GRAVARCONFIG&idUsuario='+idUsuario+'&campo='+campo+'&valor='+valor,
    error: function(){alerta('Ocorreu um erro no Ajaz jQuery','danger');},
    success: function(msg){if(msg != 'OK'){alerta(msg,'danger');}}
    });        
  }

//Desabilita ou habilita um botao
//colocar no ajax do jquery:
//complete: function(msg){botaoGravar('btGravarEventoWizard',true);},
function botaoGravar(id,status)
  {
  if(status)
    {$('#'+id).css('pointer-events','auto'); $('#'+id).prop('disabled',false);}
  else
    {$('#'+id).css('pointer-events','none'); $('#'+id).prop('disabled',true);}
  }

function limpaString(str)
  {
  var str1 = '����������������������������������������������';
  var str2 = 'aaaaaeeeeiiiiooooouuuucAAAAAEEEEIIIIOOOOOUUUUC';
  var ret = "";
  for(var i=0; i<str.length; i++){if(str1.indexOf(str.charAt(i)) != -1){ret += str2.substr(str1.search(str.substr(i, 1)), 1);} else {ret += str.substr(i, 1);}}
		return ret;
  }

function replaceAll(str, find, replace){return str.replace(new RegExp(find, 'g'), replace);}

var oldPage = '';
function PrintPage(conteudo){oldPage = document.body.innerHTML;	document.body.innerHTML = '<html><head><title>credencial print</title></head><body>' + conteudo + '</body></html>'; setTimeout('PrintPageStep1()', 1000);}
function PrintPageStep1(){window.print(); setTimeout('PrintPageStep2()', 1);}
function PrintPageStep2(){document.body.innerHTML = oldPage;}		

//funcoes para string
function Left(str, n){if (n <= 0){return "";} else {if (n > String(str).length) {return str;} else {return String(str).substring(0,n);}}}
function Right(str, n){if (n <= 0){return "";} else {if (n > String(str).length) {return str;} else {var iLen = String(str).length; return String(str).substring(iLen, iLen - n);}}}

//Preenche zero a esquerda
function zeroPad(num, places) {var zero = places - num.toString().length + 1; return Array(+(zero > 0 && zero)).join("0") + num;}

//S� passa digita��o de numeros (funcao auxiliar par ao JQuery)
//exemplo: <input type="text" id="nome"/>
//         $(function(){$('#nome').bind('keydown',soNumeros);});
function soNumeros(e)
		{
		keyCodesPermitidos = new Array(8,9,37,39,46);
		for(x=48;x<=57;x++){keyCodesPermitidos.push(x);}
		for(x=96;x<=105;x++){keyCodesPermitidos.push(x);}
		keyCode = e.which; 
		if($.inArray(keyCode,keyCodesPermitidos) != -1){return true;}    
		return false;
		}
		
//Verifica se � o IE
function navegadorIE()
		{
		var IE = 1;
		if($.browser.name == 'chrome'){IE = 0;}
		if($.browser.name == 'opera'){IE = 0;}
		if($.browser.name == 'safari'){IE = 0;}
		if($.browser.name == 'msie'){IE = 1;}
		return IE;
		}			
		
	

/*
 * Function that will redirect to a new page & pass data using submit
 * @param {type} path -> new url
 * @param {type} params -> JSON data to be posted
 * @param {type} method -> GET or POST
 * @returns {undefined} -> NA
 */
function gotoUrl(path, params, method)
	{
  //Null check
  method = method || "post"; // Set method to post by default if not specified.
  // The rest of this code assumes you are not using a library.
  // It can be made less wordy if you use one.
  var form = document.createElement("form");
  form.setAttribute("method", method);
  form.setAttribute("action", path);
  //Fill the hidden form
  if(typeof params === 'string')
  	{
    var hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", 'data');
    hiddenField.setAttribute("value", params);
    form.appendChild(hiddenField);
    }
  else
  	{
    for(var key in params)
    	{
      if(params.hasOwnProperty(key))
      	{
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", key);
        if(typeof params[key] === 'object')
        	{hiddenField.setAttribute("value", JSON.stringify(params[key]));}
        else
        	{hiddenField.setAttribute("value", params[key]);}
        form.appendChild(hiddenField);
        }
      }
    }
  document.body.appendChild(form);
  form.submit();
	}


 function formatar(src, mask)
  {
  var i = src.value.length;
  var saida = mask.substring(0,1);
  var texto = mask.substring(i)
  if(saida=="#"){if(isNaN(String.fromCharCode(window.event.keyCode))) {return false;}}
  if(texto.substring(0,1) != saida){src.value += texto.substring(0,1);}
  }

  // Funcao para validar a hora
  function valida_hora(str)
    { 
    hora = (str.value.substring(0,2)); 
    minu = (str.value.substring(3,5)); 
    pont = (str.value.substring(2,1)); 
    cons = true; 
    if (isNaN(hora) || isNaN(minu)){alert("Preencha a hora somente com n�meros."); str.value = ""; str.focus(); return false;}
    if (hora < 00 || hora > 23){cons = false;} 
    if (minu < 00 || minu > 59 ){cons = false;} 
    if (pont =! ':' ){cons = false;} 
    if (cons == false){alert("A hora inserida n�o � v�lida: " + str.value); str.value = ""; str.focus(); return false;} 
    return true;
    }

  // colocar no evento onKeyUp passando o objeto como parametro
  function formata_hora(val)
    {
    var pass = val.value;
    var expr = /[0123456789]/;
    for(i=0; i<pass.length; i++)
      {
      var lchar = val.value.charAt(i);
      var nchar = val.value.charAt(i+1);
      if(i==0)
        {if((lchar.search(expr) != 0) || (lchar>23)){val.value = "";}}
      else if(i==1)
        {
        if(lchar.search(expr) != 0){var tst1 = val.value.substring(0,(i)); val.value = tst1; continue;}
        if((nchar != ':') && (nchar != ''))
          {
          var tst1 = val.value.substring(0, (i)+1);
          if(nchar.search(expr) != 0) 
            {var tst2 = val.value.substring(i+2, pass.length);}
          else
            {var tst2 = val.value.substring(i+1, pass.length);}
          val.value = tst1 + ':' + tst2;
          }
        }
      else if(i==4)
         {
        if(lchar.search(expr) != 0){var tst1 = val.value.substring(0, (i)); val.value = tst1; continue; }
        if((nchar != ':') && (nchar != ''))
            {
          var tst1 = val.value.substring(0, (i)+1);
          if(nchar.search(expr) != 0) 
            {var tst2 = val.value.substring(i+2, pass.length);}
          else
            {var tst2 = val.value.substring(i+1, pass.length);}
          val.value = tst1 + ':' + tst2;
          }
        }
       }
    if(pass.length>5) val.value = val.value.substring(0, 5);
    return true;
    }