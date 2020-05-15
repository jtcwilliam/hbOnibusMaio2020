<?php

session_start();

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

 include_once './classes/classeGenerica.php';
 
 include_once './classes/Onibus.php';
 
 include_once './classes/Viagem.php';
 
 $objViagem = new Viagem();
 
 $objOnibus = new Onibus();
 
 $objGenerica = new ClasseGenerica();
                    
    if(empty($_POST))
    {
       
        $idViagem = $objGenerica->selecaoGenerica(' * from viagem where statusViagem=1');
        
         $onibusFinal = $objGenerica->selecaoGenerica(' * from onibusViagem where idViagem='.$idViagem[0]['idViagem']);
         
         $onibusViagem = $onibusFinal[0]['tipoOnibusViagem'];
         
         $_SESSION['onibusAtivo'] = $onibusFinal[0]['idOnibusViagem'];
                    
          
                    
         
                    
    }
                    
    if(isset($_POST['gravarPoltrona']))
    {
              $dados = $objGenerica->selecaoGenerica("  * FROM casadojo_moduloOnibus.usuario where rgusuario='".$_POST['rgPoltrona']."'");
              
              
              if(isset($dados[0]['statusUsuario']))
                {

                    if ($dados[0]['statusUsuario'] =='1' ) {
                        
                         echo json_encode(array('retorno' => TRUE));
                    } else {
                        
                        echo json_encode(array('retorno' => FALSE));
                    }
                }else
                {
                    
                      echo json_encode(array('retorno' => FALSE));
                }
                    
              
              exit();
              
    }



 //procedimento para gravar usuario; poltrona
 if(isset($_POST['gravarCadeira']))
    {
                    
     
     include_once './classes/Usuario.php';
     
     $objUsuario = new Usuario();
     
            $objUsuario->setNomeUsuario($_POST['nomePoltrona']);
            $objUsuario->setTelefoneUsuario($_POST['telefonePoltrona']);
            $objUsuario->setRgUsuario($_POST['rgPoltrona']);
            $objUsuario->setEmailUsuario($_POST['emailPoltrona']);
            $objUsuario->setStatusUsuario('1');

            
            
          
            
    if($objUsuario->inserirUsuario() == true)
        {
                    

                $dadosUsuarioInserido = $objViagem->selecaoGenerica( " * from usuario where nomeUsuario = '".$_POST['nomePoltrona']."' "
                      . " and telefoneUsuario='".$_POST['telefonePoltrona']."' and rgUsuario =  '".$_POST['rgPoltrona'].  "' ");
                
                    


                $objViagem->setUsuario_idusuario($dadosUsuarioInserido[0]['idusuario']);
                    
                
                $onibusAtivo  = $_SESSION['onibusAtivo'];
                
                $objViagem->setOnibusViagem_idOnibusViagem($onibusAtivo);
              //  $objViagem->setBusIdOnibus($_POST['idCodigoOnibus']);
                $objViagem->setNumeroPoltrona($_POST['numeroPoltrona']);


                if($objViagem->inserirUsuarioViagemPoltrona())
                    {
                        echo json_encode(array('retorno'=>TRUE));
                    }

        }
            else
                {
                     echo json_encode(array('retorno'=>FALSE));
                }

        exit();
      
    }
                    

    $dados = $objGenerica->selecaoGenerica(' usuario_idusuario, numeroPoltrona   from poltrona where onibusViagem_idOnibusViagem='. $_SESSION['onibusAtivo']);
                    

            switch($onibusViagem) 
                {
                    case 46:
                        //onibus de 40 lugares
                        $tabelaA = $objOnibus->gerarOnibusMenor($onibusViagem, 1);
                        $tabelaB = $objOnibus->gerarOnibusMenor($onibusViagem, 2);
                        $tabelaC = $objOnibus->gerarOnibusMenor($onibusViagem, 3);
                        $tabelaD = $objOnibus->gerarOnibusMenor($onibusViagem, 4);

                        break;
                    
                      case 42:
                        //onibus de 40 lugares
                        $tabelaA = $objOnibus->gerarOnibusMenor($onibusViagem, 1);
                        $tabelaB = $objOnibus->gerarOnibusMenor($onibusViagem, 2);
                        $tabelaC = $objOnibus->gerarOnibusMenor($onibusViagem, 3);
                        $tabelaD = $objOnibus->gerarOnibusMenor($onibusViagem, 4);

                        break;
                    
                    
                    default:
                        break;
                }                    
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foundation for Sites</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <script src="js/validadores.js"></script>
    
    <style>
        
     
    a
        {
            color: white;
            font-weight: bold;
        }
    
    
    @font-face {
        font-family: Roger-Serif_Bold;
        src: url('css/fontes/Roger-Serif_Bold.otf');
    }
    
    h5{
        color: white;
       
    }
    
    .btnPraReservar:link
    {
       background-color: #8ebccb;
        font-weight: bolder;
        color: black
    }
    
    
    legend{
        color: white;
        font-weight: bolder;
         font-family: Roger-Serif_Bold;
        
    }
    
    
    
    .titulos
        {
            font-family: Roger-Serif_Bold;
            color: #4F8DB7;
        }
     .imagemTop 
        {
          float: right;
       }
    
    @media screen and (max-width: 992px) 
    {
        .imagemTop 
            {
                position: relative;
                float: left;

            }

        .title-bar
            {
                background-color: #4f8db7;
            }
    }
    
    
</style>
        
    </style>
    
  </head>
  <body style="background-color: #008DD7">
      
      <div class="grid-x grid-padding-x" style="background-color: white">
        <div class="cell small-12 medium-12 large-12">
            <div class="grid-container"> 

                <div class="grid-x grid-padding-x" style="background-color: white">
                    <div  style="font-size: 30px; margin-top: 30px" class="cell small-12 medium-9 large-9">
                        <span class="titulos" >Bem Vindo ao Bus da Hamburgada !</span>
                    </div>
                    <div  class="cell small-12 medium-3 large-3">




                        <img  class="imagemTop" src="img/logoPNGTOP.png" />
                    </div>
                </div>
            </div>
        </div>
    </div>
      
      <!-- revel para fianlizar -->
      <div class="full reveal" id="finalizarReserva" data-reveal>
          <h1>Reserva Finalizada.</h1>
          
          <p>Seu lugar está garantido. Vamos Entrar em contato com você para mais informações</p>
          
          <a class="button success"  onclick="location.reload(true)" style="width:100%">Fechar tela da Reserva  </a>
          <button class="close-button" data-close aria-label="Close modal" type="button">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      
       
      
       <!-- revel para fianlizar -->
       
      
    <div class="grid-container">
     
        
        <div class="grid-x grid-padding-x">
            <div class="cell small-12 medium-12 large-12" id="poltronasReservadas">
                 
            </div>
            
            
            
        </div>
        
        
        
        <div class="grid-x grid-padding-x">
            <div class="cell small-12 medium-12 large-12">

                <div class="full reveal" id="abrirComandoInserir" data-reveal data-v-offset="0" style="   background-color: rgba(0, 0, 0, 0.9);   "  >
                    <div class="grid-container meioTelaVertical">
                        <div class="grid-x grid-margin-x">
                            <div class="cell auto" > 
                            </div> 
                            
                            <div  id="mensagemSucesso"   class="cell small-12 medium-6 large-6"  style="color: white; font-weight: bolder" > 
                                <center>  <h2>Parabéns </h2>
                                <br>
                                
                                <h4>Você reservou sua Poltrona com  Sucesso </h4>
                                
                                </center>
                                
                                <br>  
                                 
                                <br> 
                                <center>
                                    <a class="button success" href="https://www.hamburgadadobem.com.br/"  target="_self"     type="button" style="  width: 100%; border-radius: 8px; color: white"    >   Voltar para o site da Hamburgada  </a>
                                    <br>
                                     <a class="button warning" href="index.php"  target="_self"     type="button" style="  width: 100%; border-radius: 8px; color: white"    >   Reservar outra poltrona </a>
                                </center> 
                             
                            </div>  
                            
                            
                            
                            <div  id="loaderReserva"   class="cell small-12 medium-6 large-6"  style="color: white; font-weight: bolder; display: none" > 
                                
                                
                                
                            </div>
                            
                            <div class="large-6 medium-6 small-12 cell" id="inserirUsuariosPoltrona">
                                
                                
                                
                            </div>
                            
                            <div class="cell auto" >

                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        
        
        <div class="grid-x grid-padding-x">
            <div class="cell small-12 medium-12 large-12">

                <div class="full reveal" id="mensagensErro" data-reveal data-v-offset="0" style="   background-color: rgba(250, 0, 0, 0.9);   "  >
                    <div class="grid-container meioTelaVertical">
                        <div class="grid-x grid-margin-x">
                            <div class="cell auto" > 
                            </div> 
                            
                            <div  id=" "   class="cell small-12 medium-6 large-6"  style="color: white; font-weight: bolder" > 
                                <center>  <h2>Você Ja tem uma poltrona selecionada para esta viagem </h2>
                                <br>
                                
                              
                                
                                </center>
                                 
                             
                            </div>  
                            
                            
                            
                             
                            
                             
                            
                             
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        
        <div class="grid-x grid-padding-x">
            <div class="cell small-12 medium-12 large-12">

                <div class="full reveal" id="abrirComandoInserir" data-reveal data-v-offset="0" style="   background-color: rgba(0, 0, 0, 0.9);   "  >
                    <div class="grid-container meioTelaVertical">
                        <div class="grid-x grid-margin-x">
                           
                              
                            
                            <div class="large-6 medium-6 small-12 cell" id="inserirUsuariosPoltrona">
                                
                                
                                
                            </div>
                            
                            
                        </div>
                        
                        <div class="grid-x grid-margin-x">
                        
                                <div class="cell auto" id="finalizarReserva" >

                                        <a class='button success'    data-open='abrirComandoInserir'       >Finalizar Reserva</a>

                                    </div> 
                        </div>

                        
                        
                    </div>
                </div>
            </div>
        </div>
        
        
        
        
      
        
 
        
        <div class="grid-x grid-padding-x">
            
            
            <div class="cell small-12   medium-6 large-6  ">
            
                <fieldset class="fieldset">
                    <legend style="font-size: 25px">Escolha poltrona</legend>
                    
                            

                
                <div class="grid-x grid-padding-x">
                    <div class="large-3 medium-3 small-3 cell">
                        <h5>Janela</h5>
                        <?php
                        foreach ($tabelaA as $valueTabelaA) {
                           
                            if(array_search($valueTabelaA, array_column($dados, 'numeroPoltrona'))    )
                                        {       
                                            ?>
                                                <div class="large-12 medium-12 small-12 cell">
                                                    <p    class="button alert"      style="width: 100%; border-radius: 8px; cursor: not-allowed"     > <?=$valueTabelaA ?></p>
                                                </div>
                                            <?php
                                            }else
                                            {  ?>
                                                <div class="large-12 medium-12 small-12 cell">
                                              
                                                    
                                                    <a class="button  btnPraReservar"   style="width: 100%; border-radius: 8px "       onclick="reservaPoltrona(<?=$valueTabelaA ?>); $(this).css('background-color', 'black') ; $(this).css('cursor', 'not-allowed');  $(this).prop('onclick', null); " > <?=$valueTabelaA ?></a> 
                                                </div>
                                            <?php
                                                
                                            }
                        }
                        ?>

                    </div>

                    <div class="large-3 medium-3 small-3 cell">
                            <h5>Corredor</h5>    
                        <?php
                        
                            foreach ($tabelaB as $valueTabelaB) 
                                {
                              if(array_search($valueTabelaB, array_column($dados, 'numeroPoltrona'))    )
                                        {                                                           
                                            ?>
                                                <div class="large-12 medium-12 small-12 cell">
                                                    <p    class="button alert"      style="width: 100%; border-radius: 8px; cursor: not-allowed"     > <?=$valueTabelaB ?></p>
                                                </div>
                                            <?php
                                            }else
                                            {  ?>
                                                <div class="large-12 medium-12 small-12 cell">
                                                    
                                                    <a class="button btnPraReservar"   style="width: 100%; border-radius: 8px "       onclick="reservaPoltrona(<?=$valueTabelaB ?>); $(this).css('background-color', 'black');  $(this).css('cursor', 'not-allowed');  $(this).prop('onclick', null);   " > <?=$valueTabelaB ?></a> 
                                                    
                                                <!-- <a class="button success"    data-open="abrirComandoInserir"   onclick="$('#txtNumeroPoltrona').val('<?=$valueTabelaB ?>');      $('#numeroPoltronaModal').html('<h3>Sua poltrona é a de nº: <h3>' +  '<h1 style=\'color:green\'  >'+<?=$valueTabelaB ?>+'</h1>')"  style="width: 100%; border-radius: 8px"   > <?=$valueTabelaB ?></a> -->
                                                </div>
                                            <?php
                                                
                                            }
                                
                            }
                                    ?>

                    </div>

                 <div class="large-3 medium-3 small-3 cell">
                         <h5>Corredor</h5>
                        <?php
                        foreach ($tabelaD as $valueTabelaD) 
                            {
                            
                                if($valueTabelaD == '0')
                                    { 
                                    ?>
                                                <div class="large-12 medium-12 small-12 cell">
                                                 <a class="button " onclick="alert(<?= $valueTabelaD ?>)"   style=" background-color: transparent ;width: 100%; border-radius: 8px"   > &nbsp </a>
                                                </div>



                                    <?php
                                            
                                        
                                    }else
                                        {
                                        
                                        
                                       
                                        
                                        if(array_search($valueTabelaD, array_column($dados, 'numeroPoltrona'))    )
                                        {                                                           
                                            ?>
                                                <div class="large-12 medium-12 small-12 cell">
                                                    <p    class="button alert"      style="width: 100%; border-radius: 8px; cursor: not-allowed"     > <?=$valueTabelaD ?></p>
                                                </div>
                                            <?php
                                            }else
                                            {  ?>
                                                <div class="large-12 medium-12 small-12 cell">
                                                    
                                                     <a class="button btnPraReservar"   style="width: 100%; border-radius: 8px "       onclick="reservaPoltrona(<?=$valueTabelaD ?>); $(this).css('background-color', 'black'); $(this).css('cursor', 'not-allowed');  $(this).prop('onclick', null);  " > <?=$valueTabelaD ?></a> 
                                                    
                                                <!-- <a class="button success"    data-open="abrirComandoInserir"   onclick="$('#txtNumeroPoltrona').val('<?=$valueTabelaD ?>');   $('#numeroPoltronaModal').html('<h3>Sua poltrona é a de nº: <h3>' +  '<h1 style=\'color:green\'  >'+<?=$valueTabelaD ?>+'</h1>')"  style="width: 100%; border-radius: 8px"   > <?=$valueTabelaD ?></a> -->
                                                </div>
                                            <?php
                                                
                                            }
                                }
                        }
                            ?>

                    </div>
                    
                    
                    <div class="large-3 medium-3 small-3 cell">
                         <h5>Janela</h5>
                        <?php
                        foreach ($tabelaC as $valueTabelaC) 
                            {
                            
                                if($valueTabelaC == '0')
                                    { 
                                    ?>
                                                <div class="large-12 medium-12 small-12 cell">
                                                 <a class="button " onclick="alert(<?= $valueTabelaC ?>)"   style=" background-color: transparent ;width: 100%; border-radius: 8px"   > &nbsp </a>
                                                </div>
 
                                    <?php 
                                    }else
                                        {
                    
                                       if(array_search($valueTabelaC, array_column($dados, 'numeroPoltrona'))    )
                                        {                                                           
                                            ?>
                                                <div class="large-12 medium-12 small-12 cell">
                                                     <p    class="button alert"      style="width: 100%; border-radius: 8px; cursor: not-allowed"     > <?=$valueTabelaC ?></p>
                                                </div>
                                            <?php
                                            }else
                                            {  ?>
                                                <div class="large-12 medium-12 small-12 cell">
                                                    
                                                    <a class="button btnPraReservar"   style="width: 100%; border-radius: 8px "       onclick="reservaPoltrona(<?=$valueTabelaC ?>);  $(this).css('background-color', 'black'); $(this).css('cursor', 'not-allowed');  $(this).prop('onclick', null);  " > <?=$valueTabelaC ?></a> 
                                                    <!-- <a class="button success"       data-open="abrirComandoInserir"   onclick="$('#txtNumeroPoltrona').val('<?=$valueTabelaC ?>'));      $('#numeroPoltronaModal').html('<h3>Sua poltrona é a de nº: <h3>' +  '<h1 style=\'color:green\'  >'+<?=$valueTabelaC ?>+'</h1>')"  style="width: 100%; border-radius: 8px"   > <?=$valueTabelaC ?></a> -->
                                                </div>
                                            <?php
                                                
                                            }
                                }
                        }
                            ?>

                    </div>  
                    
                       
                </div>
                    
                </fieldset>

            </div>
            
            
            
            
              <div class="cell small-12   medium-6 large-4  ">
              
                <fieldset class="fieldset">
                     <legend style="font-size: 25px">Poltrona(s) Selecionada(   s)</legend>
                    <div id="botPoltronasReservada">



                    </div>
                    
                    
                    
                    <a class="button success" onclick="inserirDadosPoltronas()" style="width: 100%; background-color: #d7ecfa; border-radius: 20px" >Clique Aqui após escolher sua poltrona</a>
                </fieldset>
                
                
            </div>
            
            
            
            
            <div class="cell auto"></div>
        </div>
           
    </div>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
    
    <script>
        
    var contandoClicks = 0;   
        
    
   
    
      
         
        function consultaUsuario(rgPoltrona, callback){
	$.ajax({
		data: {rgPoltrona : rgPoltrona, gravarPoltrona:'1'},
		url: 'index.php',
                dataType: 'json',
                type: 'POST',
		success: function(resultado){
			callback(resultado.retorno);
		}
                });
            } 
         
        function reservaPoltrona(poltronaClicada)
        {
            contandoClicks++;
            
            $('#poltronasReservadas').append("<input class=\"txtPoltronaEscolhida\" type=\"hidden\"    value=\""+poltronaClicada+"\"   /> "    );     
             
            $('#botPoltronasReservada').append("<div class=\"grid-x grid-padding-x\"> <div class=\"  small-12   large-12 medium-12 cell\"> <button   style='background-color: #1779ba; width: 100%; border-radius: 10px ;color: black; font-size: 22px' class= 'button ' \" >"+poltronaClicada+"</button></div> </div> "    );     
         
             
             if(contandoClicks == 2)
             {
                $('.btnPraReservar').attr("disabled", true);
                $('.btnPraReservar').prop("onclick", null);
            }
             
        } 
        
        function resetarCampoRG() 
        {
                                   
                $('.camposUsuario').each(function (){

                    $(this).css('background-color','');
                    $(this).val('');
                    $('.mensagemPoltrona').html('');
                    $('#botaoConfirmaReservas').show();

                });
        
        
                                    
            
        }   
    function gravarPoltronas()
    {           
        
           $('#botaoConfirmaReservas').hide();
           
           
           var cont=0;
           var contFinal = 0;
           
            $( ".usuariosDasPoltronas " ).each(function(  ) 
            {   
                
                cont++;
                
                }); 
        
        $( ".usuariosDasPoltronas " ).each(function(  ) 
            {                
                var nomePoltrona = $(this).find('[id="nomePoltrona"]');
                var rgPoltrona = $(this).find('[id="rgPoltrona"]');
                var telefonePoltrona = $(this).find('[id="telefonePoltrona"]');
                var emailPoltrona = $(this).find('[id="emailPoltrona"]');
                var mensagemPoltrona = $(this).find('[id=mensagemPoltrona]');
                var numeroPoltrona  = $(this).find('[id=numeroPoltrona]');
                
                    mensagemPoltrona.html('<center><h3>Aguarde</h3></center>');
                    
                     nomePoltrona.attr('readOnly', 'true');
                                                    rgPoltrona.hide();
                                                    telefonePoltrona.hide();
                                                    emailPoltrona.hide();
                                                    $('#botaoConfirmaReservas').hide();
                   
                //  paranaue para consultar se esse rg ja tem poltrona registrada
                   consultaUsuario(rgPoltrona.val(), function(resultado){
                        
                                   if(resultado === true){
                                       rgPoltrona.css('background-color','red');
                                       
                                       nomePoltrona.css('background','red');
                                       mensagemPoltrona.html('Você ja possui uma poltrona reservada nesse onibus');
                                       $('#botaoConfirmaReservas').hide();
                                   }else
                                   {
                                            rgPoltrona.css('background-color','white');
                                       //    mensagemPoltrona.html('Aguarde');
                                       
                                      gravarUsuarioNaPoltrona(nomePoltrona.val(), rgPoltrona.val(),
                                      telefonePoltrona.val(), emailPoltrona.val(), numeroPoltrona.val() , function (resultado) {   
                                                    console.log(resultado);
                                                if(resultado === true){
                                                    
                                                    nomePoltrona.attr('readOnly', 'true');
                                                    rgPoltrona.hide();
                                                    telefonePoltrona.hide();
                                                    emailPoltrona.hide();
                                                    $('#botaoConfirmaReservas').hide();
                                                    
                                                     contFinal++;
                                                     mensagemPoltrona.html('<center><h3>Inserido</h3></center>');
                                                     
                                                      
                                                }
                                    
                                        })  ;
                                        
                            }
                             
                    }); 
                   
            });  
            
            if(cont === contFinal )
            { 
              
              $('#finalizarReserva').foundation('open');
                  
            } 
    }   
     
     function gravarUsuarioNaPoltrona(nomePoltrona,rgPoltrona, telefonePoltrona, emailPoltrona, numeroPoltrona  ,callback  )
            {     
                 $.ajax({
                 dataType: 'json',
                 url: 'index.php',
                 type: 'post',
                     data: {gravarCadeira: '1', nomePoltrona:nomePoltrona, rgPoltrona:rgPoltrona,
                         telefonePoltrona:telefonePoltrona,    emailPoltrona:emailPoltrona, numeroPoltrona:numeroPoltrona},
                     success: function (data)
                     {     
                         console.log(data);
                          
                          callback(data.retorno);
                     }
                 });   
            } 
        
        function inserirDadosPoltronas()
       {
            $('#abrirComandoInserir').foundation('open');
            
           $( ".txtPoltronaEscolhida" ).each(function(  ) { 
                //  console.log('data');            
         var  valor = $(this).attr('value');
            
               $('#inserirUsuariosPoltrona').append( " <div class='grid-x grid-padding-x   usuariosDasPoltronas  '   >" + 
                    " <div class='large-12 medium-12 small-12 cell      '> " +
                    " <fieldset class='fieldset'> " +
                    " <legend><h4 style='color:white' >Poltrona:  " + valor + "  </h4></legend> "+
                    " <input type='text' class='camposUsuario'     id='nomePoltrona' placeholder='Nome' /> " +
                    " <input type='hidden' class='camposUsuario'     id='numeroPoltrona' placeholder='Nome' value='"+valor+"' /> " +
                    " <input type='text' class='camposUsuario'    id='telefonePoltrona'  onkeyup=\"somenteNumeros(this); mascara(this, 'CEL')\" maxlength=\"15\"    placeholder='Telefone' /> " +
                    " <input type='text' class='camposUsuario'    id='emailPoltrona' placeholder='Email' /> " +
                    " <h5 style='color:white' class='mensagemPoltrona' id=mensagemPoltrona> </h5>    " +
                    " <input type=text   class='camposUsuario'  id=rgPoltrona placeholder=\RG            /> " +
                    
                    
                    " </fieldset> </div></div> ");
               
              });
           
             $('#inserirUsuariosPoltrona').append( " <div class='grid-x grid-padding-x'>" + 
                    " <div class='large-12 medium-12 small-12 cell'>  <a class='button succes'  id='botaoConfirmaReservas' onclick='gravarPoltronas(); $(this).text(\"<center>AGUARDE</center>\")     ' style='width:100%'   >Enviar </a>   </div></div>");
             
  
             $('#inserirUsuariosPoltrona').append( " <div class='grid-x grid-padding-x'>" + 
                    " <div class='large-12 medium-12 small-12 cell'>  <a class='button success'  id='botaoConfirmaReservas' onclick='location.reload(true)' style='width:100%'   >Fechar tela da Reserva  </a>   </div></div>");
  
        
        
//                                location.reload(true);

        
        
        } 
        
      
        
        $('#mensagemSucesso').hide();
         
        
        </script>
  </body>
</html>
