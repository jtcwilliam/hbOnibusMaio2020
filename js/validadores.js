//FUNÇÃO ESPECÍFICA PARA VALIDAÇÃO DE CADASTRO DE INSTITUIÇÃO
function validaCadastroInstituicao(formulario){
	if (!validaCnpj(formulario.txt_cnpj)){
		return false;
	}
	if (!validaPublico()){
		return false;
	}
	if (!validaArea()){
		return false;
	}
}

function validarEmail(campo) {
 
    filtro = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    if(!filtro.test(campo)){
        return false;
    } else {
        return true;
    }
}

function checaTudoDiaSemana(campo){
	if (campo.value == 0){
		var arr = document.getElementsByName("txt_dia_semana[]"); 
		for (i=1;i< arr.length;i++){
			if (campo.checked == true){
				arr[i].checked = true;
			} else {
				arr[i].checked = false;
			}
		}
	}
} 

//FUNÇÃO ESPECÍFICA PARA VALIDAÇÃO DE CADASTRO DE VOLUNTÁRIO
function validaCadastroVoluntario(formulario){
	if (!validaCpf(formulario.txt_cpf)){
		return false;
	}
	if (!validaData(formulario.txt_data_nascimento)){
		return false;
	}
	if (!validaTels(formulario)){
		return false;
	}
	if (!validaPublico()){
		return false;
	}
	if (!validaArea()){
		return false;
	}
	return true;
}

//FUNÇÃO PARA VALIDAR SE ALGUM TELEFONE FOI INSERIDO
function validaTels(formulario){
	if (formulario.txt_tel_residencial.value == "" && formulario.txt_tel_comercial.value == "" && formulario.txt_tel_celular.value == ""){
		alert ('Informe ao menos um telefone para contato.');
		formulario.txt_tel_residencial.focus();
		return false;
	} else {
		return true;
	}
}

//FUNÇÃO PARA VALIDAÇÃO CHECKBOX ÁREA DE ATUAÇÃO
function validaArea(){
	var auxA = 0;
	var areaAtuacao = document.getElementsByName("txt_area_atuacao[]");  
	for (var i=0;i<areaAtuacao.length;i++){  
		if (areaAtuacao[i].checked){  
			auxA++;
		}
	}
	if (auxA == 0){
		document.getElementById("erroArea").style.display = 'block';
		return false;
	} else {
		document.getElementById("erroArea").style.display = 'none';
		return true;
	}
}

//FUNÇÃO PARA VALIDAR CHECKBOX PÚBLICO
function validaPublico(){
	var auxP = 0;
	var publico = document.getElementsByName("txt_publico[]");  
	for (var i=0;i<publico.length;i++){  
		if (publico[i].checked){  
			auxP++;
		}
	}
	if (auxP == 0){
		document.getElementById("erroPublico").style.display = 'block';
		return false;
	} else {
		document.getElementById("erroPublico").style.display = 'none';
		return true;
	}
}

//FUNÇÃO PARA RETIRAR ASPAS
function retiraAspas(campo){
	campo.value = campo.value.replace(/"/gi,"");
	campo.value = campo.value.replace(/'/gi,"");
}



function somenteNumeros(num) {
    
     
    
        var er = /[^0-9.\.\- () )]/;
        er.lastIndex = 0;
        var campo = num;
        if (er.test(campo.value)) {
          campo.value = "";
        }
    }



//MÁSCARAS
function mascara(campo, tipo){
    valor = campo.value;
    
    switch(tipo){
		case 'CPF':
			if (valor.length == 3){
				valor = valor + ".";
				campo.value = valor;
			}
			if (valor.length == 7){
				valor = valor + ".";
				campo.value = valor;
			}
			if (valor.length == 11){
				valor = valor + "-";
				campo.value = valor;
			}
			break;
		case 'CNPJ':
			if (valor.length == 2){
				valor = valor + ".";
				campo.value = valor;
			}
			if (valor.length == 6){
				valor = valor + ".";
				campo.value = valor;
			}
			if (valor.length == 10){
				valor = valor + "/";
				campo.value = valor;
			}
			if (valor.length == 15){
				valor = valor + "-";
				campo.value = valor;
			}
			break;
		case 'DATA':
			if (valor.length == 2){
				valor = valor + "/";
				campo.value = valor;
			}
			if (valor.length == 5){
				valor = valor + "/";
				campo.value = valor;
			}
			break;
		case 'TEL':
			if (valor.length == 2){
				valor = "(" + valor + ") ";
				campo.value = valor;
			}
			if (valor.length == 9){
				valor = valor + "-";
				campo.value = valor;
			}
			break;
		case 'IE':
			if (valor.length == 3){
				valor = valor + ".";
				campo.value = valor;
			}
			if (valor.length == 7){
				valor = valor + ".";
				campo.value = valor;
			}
			if (valor.length == 11){
				valor = valor + ".";
				campo.value = valor;
			}
			break;
		case 'CEL':
			if (valor.length == 2){
				valor = "(" + valor + ") ";
				campo.value = valor;
			}
			if (valor.length == 10){
				valor = valor + "-";
				campo.value = valor;
			}
			break;
		case 'CEP':
			if (valor.length == 5){
				valor = valor + "-";
				campo.value = valor;
			}
			break;
	}
}

//FUNÇÃO PARA LIMPAR O CAMPO
function limpa(campo) {
    campo.value = '';
}








 

function apenasNumeros(string){
    var permitidos = "0123456789";
    var temp = "";
    var digito = "";
    for (var i=0; i<string.length; i++){
		digito = string.charAt(i);
		if (permitidos.indexOf(digito)>=0){temp=temp+digito}
    }
    return temp
}

//FUNÇÃO PARA VALIDAR O CPF
function validaCpf(cpf){
    valor = apenasNumeros(cpf);
    var numeros, digitos, soma, i, resultado, digitos_iguais;
    digitos_iguais = 1;
    for (i = 0; i < valor.length - 1; i++){
        if (valor.charAt(i) != valor.charAt(i + 1))
        {
            digitos_iguais = 0;
            break;
        }
    }
    if (!digitos_iguais)
    {
        numeros = valor.substring(0, 9);
        digitos = valor.substring(9);
        soma = 0;
        for (i = 10; i > 1; i--)
            soma += numeros.charAt(10 - i) * i;
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0)){
            //alert('CPF inválido.');
            cpf = '';
            //cpf.focus();
            return false;
        }
        numeros = valor.substring(0, 10);
        soma = 0;
        for (i = 11; i > 1; i--)
            soma += numeros.charAt(11 - i) * i;
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1)){
            //alert('CPF inválido.');
            //cpf = '';
            //cpf.focus();
            return false;
        } else {
            return true;
        }
    } else {
        //alert('CPF inválido.');
        //cpf = '';
        //cpf.focus();
        return false;
    }
}

//FUNÇÃO PARA VERIFICAR SE CPF JÁ FOI CADASTRADO
function buscaCpf(cpf){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState === 4 && xmlhttp.status === 200){
			if (xmlhttp.responseText == 1){
				alert ('CPF já cadastrado. Faça o login.');
				cpf.value = '';
				cpf.focus();
				window.location = '../';
				return false;
			}
		}
	};
	xmlhttp.open("GET", "../voluntario/busca.php?cpf="+cpf.value, true);
	xmlhttp.send();
}

//FUNÇÃO PARA VALIDAR DATA E IDADE > 18
function validaData(campo){
    bissexto = 0;
    data = campo.value.split('/');
    dia = data[0];
    mes = data[1];
    ano = data[2];
    data = new Date();
    anoAtual = data.getFullYear();
        
    if (ano > 1900 && ano < anoAtual){
        if (mes < 1 || mes > 12){
            alert ('Mês inválido');
            campo.focus();
            return false;
        }
	switch (mes){
            case '01':
            case '03':
            case '05':
            case '07':
            case '08':
            case '10':
            case '12':
		if  (dia > 31 || dia < 1){
                    alert ('Dia inválido');
                    campo.focus();
                    return false;
                }
		break
            case '04':		
            case '06':
            case '09':
            case '11':
		if  (dia > 30 || dia < 1){
                    alert ('Dia inválido');
                    campo.focus();
                    return false;
                }
		break
            case '02':
		/* Validando ano Bissexto / fevereiro / dia */ 
		if ((ano % 4 == 0) || (ano % 100 == 0) || (ano % 400 == 0)){ 
                    bissexto = 1; 
		} 
		if ((bissexto == 1) && ((dia > 29) || (dia < 1))){ 
                   alert ('Dia inválido');
                   campo.focus();
                   return false;				 
		} 
                if ((bissexto != 1) && ((dia > 28) || (dia < 1))){ 
                   alert ('Dia inválido');
                   campo.focus();
                   return false;
                }
					
		break						
	}
    } else {
        alert ('Ano inválido');
        campo.focus();
        return false;
    }
                
    var nascimento = new Date(mes+"/"+dia+"/"+ano);
    var hoje = new Date();
    var idade = hoje.getFullYear() - nascimento.getFullYear();
    nascimento.setFullYear(hoje.getFullYear());
    if (hoje < nascimento){
        idade--;
    }
    if (idade < 18){
        alert('A idade mínima para cadastro é 18 anos.');
        campo.focus();
        return false;
    } else {
        return true;
    }
}

 

//FUNÇÃO PARA VALIDAR CNPJ
function validaCnpj(campo) {
    var s;
    s = apenasNumeros(campo);
    // checa se é cgc
    if (s.length == 14) {
        if (valida_CGC(campo) == false ) {
            //alert('CNPJ inválido.');
            //campo.focus();
            return false;
        }
    } else {
        //alert('CNPJ inválido.');
        //campo.focus();
        return false;
    }
    return true;
}

//FUNÇÃO AUXILIAR PARA VALIDAR CNPJ
function valida_CGC(s) {
    var i;
    s = apenasNumeros(s);
    var c = s.substr(0,12);
    var dv = s.substr(12,2);
    var d1 = 0;
    for (i = 0; i < 12; i++){
        d1 += c.charAt(11-i)*(2+(i % 8));
    }
    if (d1 == 0) return false;
        d1 = 11 - (d1 % 11);
    if (d1 > 9) d1 = 0;
    if (dv.charAt(0) != d1){
        return false;
    }
    d1 *= 2;
    for (i = 0; i < 12; i++){
        d1 += c.charAt(11-i)*(2+((i+1) % 8));
    }
    d1 = 11 - (d1 % 11);
    if (d1 > 9) d1 = 0;
    if (dv.charAt(1) != d1){
        return false;
    }
    return true;
}

//FUNÇÃO PARA POPULAR CAMPOS DE ENDEREÇO PELO CEP ATRAVÉS DO WEBSERVICE DO GEO
function webServiceGeo(cep){

	if (cep === ""){
		document.cadastro.txt_bairro.value = "";
		document.cadastro.txt_cidade.value = "";
		document.cadastro.txt_logradouro.value = "";
		document.cadastro.txt_uf.value = "";
		document.cadastro.txt_coordenada_x.value = "";
		document.cadastro.txt_coordenada_y.value = "";
		return;
	}
	
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		bairro = new XMLHttpRequest();
		cidade = new XMLHttpRequest();
		logradouro = new XMLHttpRequest();
		uf = new XMLHttpRequest();
		coordenadaX = new XMLHttpRequest();
		coordenadaY = new XMLHttpRequest();
	} else {// code for IE6, IE5
		bairro = new ActiveXObject("Microsoft.XMLHTTP");
		cidade = new ActiveXObject("Microsoft.XMLHTTP");
		logradouro = new ActiveXObject("Microsoft.XMLHTTP");
		uf = new ActiveXObject("Microsoft.XMLHTTP");
		coordenadaX = new ActiveXObject("Microsoft.XMLHTTP");
		coordenadaY = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	logradouro.onreadystatechange = function(){
		if (logradouro.readyState === 4 && logradouro.status === 200){
			document.cadastro.txt_logradouro.value = logradouro.responseText;
		}
	};
	  
	bairro.onreadystatechange = function(){
		if (bairro.readyState === 4 && bairro.status === 200){
			document.cadastro.txt_bairro.value = bairro.responseText;
		}
	};
	
	cidade.onreadystatechange = function(){
		if (cidade.readyState === 4 && cidade.status === 200){
			document.cadastro.txt_cidade.value = cidade.responseText;
		}
	};
	
	uf.onreadystatechange = function(){
		if (uf.readyState === 4 && uf.status === 200){
			document.cadastro.txt_uf.value = uf.responseText;
		}
	};
	
	coordenadaX.onreadystatechange = function(){
		if (coordenadaX.readyState === 4 && coordenadaX.status === 200){
			document.cadastro.txt_coordenada_x.value = coordenadaX.responseText;
		}
	};
	
	coordenadaY.onreadystatechange = function(){
		if (coordenadaY.readyState === 4 && coordenadaY.status === 200){
			document.cadastro.txt_coordenada_y.value = coordenadaY.responseText;
		}
	};
 
	bairro.open("GET", "../classes/webServiceGeo.php?cep="+cep+"&tipo=bairro", true);
	cidade.open("GET", "../classes/webServiceGeo.php?cep="+cep+"&tipo=cidade", true);
	logradouro.open("GET", "../classes/webServiceGeo.php?cep="+cep+"&tipo=logradouro", true);
	uf.open("GET", "../classes/webServiceGeo.php?cep="+cep+"&tipo=uf", true);
	coordenadaX.open("GET", "../classes/webServiceGeo.php?cep="+cep+"&tipo=x", true);
	coordenadaY.open("GET", "../classes/webServiceGeo.php?cep="+cep+"&tipo=y", true);
	bairro.send();            
	cidade.send();
	logradouro.send();
	uf.send();
	coordenadaX.send();
	coordenadaY.send();
}



    function fechamodal() {
        $('.close-reveal-modal').trigger('click');
    }
    
    
    
    function EscondeLimite() {
         var selecionado = $('.selected').attr('id').replace('_tab',''); 
          $('.EsconderMensagem[id="'+selecionado+'"]').click();
          //alert('Favor fechar algumas abas abertas para abrir outra');
            $('#modalmsg').foundation('reveal', 'open');  
            $('#modalmsg .retorno').html('<div style="margin-top:30px;"class="alert-box radius alert"><center>O Limite Para Exibição de Abas Foi Excedido - Feche Alguma Aba Já Aberta</center></div>');
            setTimeout("fechamodal()",4000);
        
    }     

function Limita(campo,tamanho,contador) { 
    if (tamanho !==0) { 
        if ( $('#'+campo).val().length >=  tamanho)  {
                $('#'+campo).val($('#'+campo).val().substring(0, tamanho)); 
        }
    }
    $('#'+contador).html(tamanho - $('#'+campo).val().length + ' Caracteres Restantes');
      
} 


