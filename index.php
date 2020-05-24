<?php

session_start();
 


include_once './classes/classeGenerica.php';

include_once './classes/Onibus.php';

include_once './classes/Viagem.php';

$objViagem = new Viagem();

$objOnibus = new Onibus();

$objGenerica = new ClasseGenerica();



if (isset($_POST['preReservaCadeira'])) {


    // preReservaCadeira: '1',
    //onibusAtivo: onibusAtivo,
    //poltronaClicada: poltronaClicada


    $objViagem->setNumeroPoltrona($_POST['poltronaClicada']);
    $objViagem->setOnibusViagem_idOnibusViagem($_POST['onibusAtivo']);
    $objViagem->setUsuario_idusuario('999999');



    $gravarClick = $objViagem->inserirUsuarioViagemPoltrona();
}



$viagensAtivas = $objGenerica->selecaoGenerica('* from viagem');

if (isset($_POST['selecionarOnibus'])) {

    $onibus =    $objOnibus->selecaoGenerica('* from onibusViagem  where idViagem=' . $_POST['idViagem']);
?>

    <div class="grid-x grid-padding-x">

        <?php foreach ($onibus as  $urlOnibus) {

            $PoltronasVazias = $objOnibus->selecaoGenerica(' count(onibusViagem_idOnibusViagem) as ocupadas FROM casadojo_moduloOnibus.poltrona
            where onibusViagem_idOnibusViagem =' . $urlOnibus['idOnibusViagem']);

            $tipoOnibus = $urlOnibus['tipoOnibusViagem'];

            $ocupadas =  $PoltronasVazias[0]['ocupadas'];

            $disponiveis = $tipoOnibus - $ocupadas;


        ?> <div class="cell small-12 medium-3 large-3">
                <a style="width:100%; background-color: transparent" onclick="recarregar('<?= $urlOnibus['idOnibusViagem'] ?>',30 )" class="button links_A">
                    <img src="img/busao.png"><br>
                    <h5><?php echo $disponiveis . ' Poltronas Disponíveis';      ?> </h5>
                </a>
            </div> <?php
                }
                    ?>
    </div>

<?php



    exit();
}



//  consultar o onibus pos click/ montagem dos onibus e poltronas
if (isset($_POST['carregarViagem'])) {



    $onibusFinal = $objGenerica->selecaoGenerica(' * from onibusViagem where idOnibusViagem=' . $_POST['idOnibusViagem']);



    $_SESSION['onibusAtivo'] =  $_POST['idOnibusViagem'];

    $qtdePoltronas = $onibusFinal[0]['tipoOnibusViagem'];





    $dados = $objGenerica->selecaoGenerica(' usuario_idusuario, numeroPoltrona   from poltrona 
    where onibusViagem_idOnibusViagem=' . $_SESSION['onibusAtivo']);

    if(isset($_POST['poltronasReservadasClicadas'])){
       $tabelaClicadaReserva =  $_POST['poltronasReservadasClicadas'];
 
    }


    /*
    $dados = $objGenerica->selecaoGenerica(' usuario_idusuario, numeroPoltrona   from poltrona 
    where onibusViagem_idOnibusViagem='. $_POST['idOnibusViagem']);
    */
    switch ($qtdePoltronas) {
        case 46:
            //onibus de 40 lugares
            $tabelaA = $objOnibus->gerarOnibusMenor($qtdePoltronas, 1);
            $tabelaB = $objOnibus->gerarOnibusMenor($qtdePoltronas, 2);
            $tabelaC = $objOnibus->gerarOnibusMenor($qtdePoltronas, 3);
            $tabelaD = $objOnibus->gerarOnibusMenor($qtdePoltronas, 4);

            break;

        case 42:
            //onibus de 40 lugares
            $tabelaA = $objOnibus->gerarOnibusMenor($qtdePoltronas, 1);
            $tabelaB = $objOnibus->gerarOnibusMenor($qtdePoltronas, 2);
            $tabelaC = $objOnibus->gerarOnibusMenor($qtdePoltronas, 3);
            $tabelaD = $objOnibus->gerarOnibusMenor($qtdePoltronas, 4);

            break;


        default:
            break;
    }
?>


  


        <div class="cell small-12   small-order-2 medium-6  medium-order-1 large-6   larger-order-1 ">

            <fieldset class="fieldset">
                <legend style="font-size: 25px">Escolha poltrona</legend>




                <div class="grid-x grid-padding-x">
                    <div class="large-3 medium-3 small-3 cell">
                        <h5>Janela</h5>
                        <?php

 
                        foreach ($tabelaA as $valueTabelaA) {
 

                            if ($key = (array_search($valueTabelaA, array_column($dados, 'numeroPoltrona'))) !== false) {
                        ?>
                                <div class="large-12 medium-12 small-12 cell">
                                    <p class="button alert  btnHb " style="width: 100%; border-radius: 8px; cursor: not-allowed"> <?= $valueTabelaA ?></p>
                                </div>
                            <?php
                            } else { 
                                    
                             
                            
                                
                                ?>
                                <div class="large-12 medium-12 small-12 cell">
                                    <a class="button  btnPraReservar btnHb" style="width: 100%; border-radius: 8px " onclick="reservaPoltrona(<?= $valueTabelaA ?>); $(this).css('background-color', 'black') ; $(this).css('cursor', 'not-allowed');  $(this).prop('onclick', null); "> <?= $valueTabelaA ?></a>
                                </div>
                        <?php

                            }
                        }
                        ?>

                    </div>

                    <div class="large-3 medium-3 small-3 cell">
                        <h5>Corredor</h5>
                        <?php

                        foreach ($tabelaB as $valueTabelaB) {
                            if ($key = (array_search($valueTabelaB, array_column($dados, 'numeroPoltrona'))) !== false) {
                        ?>
                                <div class="large-12 medium-12 small-12 cell">
                                    <p class="button alert btnHb " style="width: 100%; border-radius: 8px; cursor: not-allowed"> <?= $valueTabelaB ?></p>
                                </div>
                            <?php
                            } else {  ?>
                                <div class="large-12 medium-12 small-12 cell">

                                    <a class="button btnPraReservar btnHb" style="width: 100%; border-radius: 8px " onclick="reservaPoltrona(<?= $valueTabelaB ?>); $(this).css('background-color', 'black');  $(this).css('cursor', 'not-allowed');  $(this).prop('onclick', null);   "> <?= $valueTabelaB ?></a>

                                    <!-- <a class="button success"    data-open="abrirComandoInserir"   onclick="$('#txtNumeroPoltrona').val('<?= $valueTabelaB ?>');      $('#numeroPoltronaModal').html('<h3>Sua poltrona é a de nº: <h3>' +  '<h1 style=\'color:green\'  >'+<?= $valueTabelaB ?>+'</h1>')"  style="width: 100%; border-radius: 8px"   > <?= $valueTabelaB ?></a> -->
                                </div>
                        <?php

                            }
                        }
                        ?>

                    </div>

                    <div class="large-3 medium-3 small-3 cell">
                        <h5>Corredor</h5>
                        <?php
                        foreach ($tabelaD as $valueTabelaD) {

                            if ($valueTabelaD == '0') {
                        ?>
                                <div class="large-12 medium-12 small-12 cell">
                                    <a class="button  btnHb " onclick="alert(<?= $valueTabelaD ?>)" style=" background-color: transparent ;width: 100%; border-radius: 8px"> &nbsp </a>
                                </div>



                                <?php


                            } else {




                                if ($key = (array_search($valueTabelaD, array_column($dados, 'numeroPoltrona'))) !== false) {
                                ?>
                                    <div class="large-12 medium-12 small-12 cell">
                                        <p class="button alert btnHb" style="width: 100%; border-radius: 8px; cursor: not-allowed"> <?= $valueTabelaD ?></p>
                                    </div>
                                <?php
                                } else {  ?>
                                    <div class="large-12 medium-12 small-12 cell">

                                        <a class="button btnPraReservar btnHb" style="width: 100%; border-radius: 8px " onclick="reservaPoltrona(<?= $valueTabelaD ?>); $(this).css('background-color', 'black'); $(this).css('cursor', 'not-allowed');  $(this).prop('onclick', null);  "> <?= $valueTabelaD ?></a>

                                        <!-- <a class="button success"    data-open="abrirComandoInserir"   onclick="$('#txtNumeroPoltrona').val('<?= $valueTabelaD ?>');   $('#numeroPoltronaModal').html('<h3>Sua poltrona é a de nº: <h3>' +  '<h1 style=\'color:green\'  >'+<?= $valueTabelaD ?>+'</h1>')"  style="width: 100%; border-radius: 8px"   > <?= $valueTabelaD ?></a> -->
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
                        foreach ($tabelaC as $valueTabelaC) {

                            if ($valueTabelaC == '0') {
                        ?>
                                <div class="large-12 medium-12 small-12 cell">
                                    <a class="button btnHb " onclick="alert(<?= $valueTabelaC ?>)" style=" background-color: transparent ;width: 100%; border-radius: 8px"> &nbsp </a>
                                </div>

                                <?php
                            } else {

                                if ($key = (array_search($valueTabelaC, array_column($dados, 'numeroPoltrona'))) !== false) {
                                ?>
                                    <div class="large-12 medium-12 small-12 cell">
                                        <p class="button alert btnHb" style="width: 100%; border-radius: 8px; cursor: not-allowed"> <?= $valueTabelaC ?></p>
                                    </div>
                                <?php
                                } else {  ?>
                                    <div class="large-12 medium-12 small-12 cell">

                                        <a class="button btnPraReservar btnHb" style="width: 100%; border-radius: 8px " onclick="reservaPoltrona(<?= $valueTabelaC ?>);  $(this).css('background-color', 'black'); $(this).css('cursor', 'not-allowed');  $(this).prop('onclick', null);  "> <?= $valueTabelaC ?></a>
                                        <!-- <a class="button success"       data-open="abrirComandoInserir"   onclick="$('#txtNumeroPoltrona').val('<?= $valueTabelaC ?>'));      $('#numeroPoltronaModal').html('<h3>Sua poltrona é a de nº: <h3>' +  '<h1 style=\'color:green\'  >'+<?= $valueTabelaC ?>+'</h1>')"  style="width: 100%; border-radius: 8px"   > <?= $valueTabelaC ?></a> -->
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



<!--
        <div class="cell small-12   small-order-1  medium-6  medium-order-1 large-4  larger-order-1 ">

            <fieldset class="fieldset">
                <legend style="font-size: 25px">Poltrona(s) Selecionada( s)</legend>
                <div id="botPoltronasReservada">

                </div>

                <a class="button success" onclick="inserirDadosPoltronas()" style="width: 100%; background-color: #d7ecfa; border-radius: 20px">Clique Aqui após escolher sua poltrona</a>

                <a class="button warning" href="index.php" style="width: 100%; background-color: red; color: whitesmoke; border-radius: 20px">Cancelar</a>
            </fieldset>


        </div>


         <div class="cell auto"></div>
    </div>
                    -->


       
<?php





    exit();
}






/*  consultar o onibus antigo
if ($_POST['consultarViagem']) {

    $idViagem = $objGenerica->selecaoGenerica(' * from viagem where statusViagem=1');

    $onibusFinal = $objGenerica->selecaoGenerica(' * from onibusViagem where idOnibusViagem=' . $_GET['idOnibus']);

    $onibusViagem = $onibusFinal[0]['tipoOnibusViagem'];

    $_SESSION['onibusAtivo'] = $onibusFinal[0]['idOnibusViagem'];
}

*/

if (isset($_POST['gravarPoltrona'])) {
    $dados = $objGenerica->selecaoGenerica("  * FROM casadojo_moduloOnibus.usuario where rgusuario='" . $_POST['rgPoltrona'] . "'");


    if (isset($dados[0]['statusUsuario'])) {

        if ($dados[0]['statusUsuario'] == '1') {

            echo json_encode(array('retorno' => TRUE));
        } else {

            echo json_encode(array('retorno' => FALSE));
        }
    } else {

        echo json_encode(array('retorno' => FALSE));
    }


    exit();
}



//procedimento para gravar usuario; poltrona
if (isset($_POST['gravarCadeira'])) {


    include_once './classes/Usuario.php';

    $objUsuario = new Usuario();

    $objUsuario->setNomeUsuario($_POST['nomePoltrona']);
    $objUsuario->setTelefoneUsuario($_POST['telefonePoltrona']);
    $objUsuario->setRgUsuario($_POST['rgPoltrona']);
    $objUsuario->setEmailUsuario($_POST['emailPoltrona']);
    $objUsuario->setStatusUsuario('1');





    if ($objUsuario->inserirUsuario() == true) {


        $dadosUsuarioInserido = $objViagem->selecaoGenerica(" * from usuario where nomeUsuario = '" . $_POST['nomePoltrona'] . "'
         and telefoneUsuario='" . $_POST['telefonePoltrona'] . "' and rgUsuario='" . $_POST['rgPoltrona'] . "'");




        $objViagem->setUsuario_idusuario($dadosUsuarioInserido[0]['idusuario']);


        $onibusAtivo  = $_SESSION['onibusAtivo'];

        $objViagem->setOnibusViagem_idOnibusViagem($onibusAtivo);
        //  $objViagem->setBusIdOnibus($_POST['idCodigoOnibus']);
        $objViagem->setNumeroPoltrona($_POST['numeroPoltrona']);


        if ($objViagem->atualizarUsuarioViagemPoltrona()) {
            echo json_encode(array('retorno' => TRUE));
        }
    } else {
        echo json_encode(array('retorno' => FALSE));
    }

    exit();
}
//$dados = $objGenerica->selecaoGenerica(' usuario_idusuario, numeroPoltrona   from poltrona where onibusViagem_idOnibusViagem=' . $_SESSION['onibusAtivo']);






?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva HB</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <script src="js/validadores.js"></script>

    <style>
        a {
            color: white;
            font-weight: bold;
        }


        @font-face {
            font-family: Roger-Serif_Bold;
            src: url('css/fontes/Roger-Serif_Bold.otf');
        }

        h5 {
            color: white;

        }

        .btnPraReservar:link {
            background-color: #8ebccb;
            font-weight: bolder;
            color: black
        }


        legend {
            color: white;
            font-weight: bolder;
            font-family: Roger-Serif_Bold;

        }


        .linksBotoes {
            font-family: Roger-Serif_Bold;
            color: bisque;
        }


        .titulos {
            font-family: Roger-Serif_Bold;
            color: #4F8DB7;
        }

        .imagemTop {
            float: right;
        }

        .modalEntradaTEstes {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;


        }


        @media screen and (max-width: 992px) {
            .imagemTop {
                position: relative;
                float: left;

            }

            .title-bar {
                background-color: #4f8db7;
            }
        }
    </style>



</head>

<body style="background-color: #008DD7">




    <input type="hidden" value="" name="" id="hdOnibusAtivo">


    <div class="full reveal " data-animation-in="fade-in" id="modalEscolhaViagem" data-reveal style="background-color: #008DD7">
        <div class="modalEntradaTEstes">

            <fieldset class="fieldset">

                <legend style="font-size: 40; text-align: center"> Escolha Sua Viagem</legend>
                <div class="grid-x grid-padding-x">
                    <?php
                    foreach ($viagensAtivas as $key => $value) { ?>
                        <div class="cell small-12 medium-3 large-3">
                            <a style="width:100%" onclick="carregarOnibus(<?= $value['idViagem'] ?>,  '<?= $value['localViagem'] ?>')" class="button links_A">
                                <?= $value['localViagem'] ?>
                            </a>
                        </div>

                    <?php   } ?>
                </div>
            </fieldset>
            <button class="close-button" data-close aria-label="Close modal" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>



    <div class="full reveal " data-animation-in="fade-in" id="modalEscolheOnibus" data-reveal style="background-color: #008DD7">
        <div class="modalEntradaTEstes">
            <fieldset class="fieldset">
                <legend id="textoLegend" style="font-size: 40; text-align: center"> </legend>
                <center>
                    <h4 style="color: whitesmoke; font-weight: bold">Escolha abaixo o onibus que você quer viajar</h4>
                </center>

                <div id="carregarOnibus">

                </div>
            </fieldset>
            <button class="close-button" data-close aria-label="Close modal" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>










    <div class="grid-x grid-padding-x" style="background-color: white">
        <div class="cell small-12 medium-12 large-12">
            <div class="grid-container">

                <div class="grid-x grid-padding-x" style="background-color: white">
                    <div style="font-size: 30px; margin-top: 30px" class="cell small-12 medium-9 large-9">
                        <span class="titulos">Bem Vindo ao Bus da Hamburgada !</span>
                    </div>
                    <div class="cell small-12 medium-3 large-3">




                        <img class="imagemTop" src="img/logoPNGTOP.png" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- revel para fianlizar -->
    <div class="full reveal" id="finalizarReserva" data-reveal>
        <h1>Reserva Finalizada.</h1>

        <p>Seu lugar está garantido. Vamos Entrar em contato com você para mais informações</p>

        <a class="button success" onclick="location.reload(true)" style="width:100%">Fechar tela da Reserva </a>
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

                <div class="full reveal" id="abrirComandoInserir" data-reveal data-v-offset="0" style="   background-color: rgba(0, 0, 0, 0.9);   ">
                    <div class="grid-container meioTelaVertical">
                        <div class="grid-x grid-margin-x">
                            <div class="cell auto">
                            </div>

                            <div id="mensagemSucesso" class="cell small-12 medium-6 large-6" style="color: white; font-weight: bolder">
                                <center>
                                    <h2>Parabéns </h2>
                                    <br>

                                    <h4>Você reservou sua Poltrona com Sucesso </h4>

                                </center>

                                <br>

                                <br>
                                <center>
                                    <a class="button success" href="https://www.hamburgadadobem.com.br/" target="_self" type="button" style="  width: 100%; border-radius: 8px; color: white"> Voltar para o site da Hamburgada </a>
                                    <br>
                                    <a class="button warning" href="reservarOnibus.php" target="_self" type="button" style="  width: 100%; border-radius: 8px; color: white"> Reservar outra poltrona </a>
                                </center>

                            </div>



                            <div id="loaderReserva" class="cell small-12 medium-6 large-6" style="color: white; font-weight: bolder; display: none">



                            </div>

                            <div class="large-6 medium-6 small-12 cell" id="inserirUsuariosPoltrona">



                            </div>

                            <div class="cell auto">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        <div class="grid-x grid-padding-x">
            <div class="cell small-12 medium-12 large-12">

                <div class="full reveal" id="mensagensErro" data-reveal data-v-offset="0" style="   background-color: rgba(250, 0, 0, 0.9);   ">
                    <div class="grid-container meioTelaVertical">
                        <div class="grid-x grid-margin-x">
                            <div class="cell auto">
                            </div>

                            <div id=" " class="cell small-12 medium-6 large-6" style="color: white; font-weight: bolder">
                                <center>
                                    <h2>Você Ja tem uma poltrona selecionada para esta viagem </h2>
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

                <div class="full reveal" id="abrirComandoInserir" data-reveal data-v-offset="0" style="   background-color: rgba(0, 0, 0, 0.9);   ">
                    <div class="grid-container meioTelaVertical">
                        <div class="grid-x grid-margin-x">



                            <div class="large-6 medium-6 small-12 cell" id="inserirUsuariosPoltrona">



                            </div>


                        </div>

                        <div class="grid-x grid-margin-x">

                            <div class="cell auto" id="finalizarReserva">

                                <a class='button success' data-open='abrirComandoInserir'>Finalizar Reserva</a>

                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>




<div id="poltronasReservadasTeste"> </div>


        <!-- montagem das poltronas -->


        <div class="grid-x grid-margin-x">
        <div id="montaPoltronas">
        </div>

        <div class="cell small-12   small-order-1  medium-6  medium-order-1 large-4  larger-order-1 ">

            <fieldset class="fieldset">
                <legend style="font-size: 25px">Poltrona(s) Selecionada( s)</legend>
                <div id="botPoltronasReservada">

                </div>

                <a class="button success" onclick="inserirDadosPoltronas()" style="width: 100%; background-color: #d7ecfa; border-radius: 20px">Clique Aqui após escolher sua poltrona</a>

                <a class="button warning" href="index.php" style="width: 100%; background-color: red; color: whitesmoke; border-radius: 20px">Cancelar</a>
            </fieldset>


            </div>
        </div>


        


    </div>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>

    <script>
        var contandoClicks = 0;
        var poltronasClicadasPraReserva = [];

        var timer;
        

        $('#modalEscolhaViagem').foundation('open');
            

              
  
        function consultarOnibusDaViagem(idOnibusViagem, verificador, poltronasClicadasPraReserva) {
  
            $('#modalEscolheOnibus').foundation('close');
            //$('#montaPoltronas').html('<center><img src="img/bus-loading.gif" ></center>');

            $('#hdOnibusAtivo').val(idOnibusViagem); 
 
            $.ajax({
                dataType: 'html',
                url: 'index.php',
                type: 'post',
                data: {
                    carregarViagem: '1',
                    poltronasClicadasPraReserva: poltronasClicadasPraReserva,
                    idOnibusViagem: idOnibusViagem
                },
                success: function(data) {
                   
                   

                      if(poltronasClicadasPraReserva.length ==0){
                        $('#montaPoltronas').html(data);
                            console.log('recarregar');
                            recarregar(idOnibusViagem, true);


                      }else{
                          clearTimeout(timer);
                          console.log('não carrega');
                      }
                     
                  

                      if (contandoClicks ==2 ) 
                        {
                            $('.btnPraReservar').attr("disabled", true);
                            $('.btnPraReservar').prop("onclick", null);
                        } 
                            

              
                   

                    

                }
            });
       
     }

        function carregarOnibus(idViagem, labelLocal) {

            $('#modalEscolhaViagem').foundation('close');

            $('#montaPoltronas').html('<center><img src="img/bus-loading.gif" ></center>');


            console.log(labelLocal); 
            $.ajax({
                dataType: 'html',
                url: 'index.php',
                type: 'post',
                data: {
                    selecionarOnibus: '1',
                    idViagem: idViagem
                },
                success: function(data) {
                    $('#carregarOnibus').html(data);
                    $('#textoLegend').html('Viagem: ' + labelLocal);
                    $('#modalEscolheOnibus').foundation('open');

                    


                }
            });
        }

        
 
        function recarregar(idOnibusViagem, contador) {

  
                         timer = setTimeout(function() {
                           
                            consultarOnibusDaViagem(idOnibusViagem, true, poltronasClicadasPraReserva)
                    }, 4000);

 
 
    }


        function reservaPoltrona(poltronaClicada) {
          
          
                poltronasClicadasPraReserva.push(poltronaClicada);

            

                $('#poltronasReservadasTeste').append('<input type="hidden"   class="poltronasReservadasClass"  id="campoPoltrona'+contandoClicks+'" value='+poltronaClicada+' > ');

             
            contandoClicks++; 
            console.log(poltronasClicadasPraReserva);
            var onibusAtivo = $('#hdOnibusAtivo').val(); 
          

            $.ajax({
                dataType: 'json',
                url: 'index.php',
                type: 'post',
                data: {

               
                    preReservaCadeira: '1',
                    onibusAtivo: onibusAtivo,
                    poltronaClicada: poltronaClicada

                    
                },
                success: function(data) {
                  
                    console.log('retornada poltrona');

                }
            }); 

            $('#poltronasReservadas').append("<input class=\"txtPoltronaEscolhida\" type=\"hidden\"    value=\"" + poltronaClicada + "\"   /> ");

            $('#botPoltronasReservada').append("<div class=\"grid-x grid-padding-x\"> <div class=\"  small-12   large-12 medium-12 cell\"> <button   style='background-color: #1779ba; width: 100%; border-radius: 10px ;color: black; font-size: 22px' class= 'button ' \" >" + poltronaClicada + "</button></div> </div> ");


            if (contandoClicks == 2) {
                $('.btnPraReservar').attr("disabled", true);
                $('.btnPraReservar').prop("onclick", null);
            } 
        }

       

        //função a ser migrada para novo arquivo
        function gravarPoltronas() {

            $('#botaoConfirmaReservas').hide();


            var cont = 0;
            var contFinal = 0;

            $(".usuariosDasPoltronas ").each(function() {

                cont++;

            });

            $(".usuariosDasPoltronas ").each(function() {
                var nomePoltrona = $(this).find('[id="nomePoltrona"]');
                var rgPoltrona = $(this).find('[id="rgPoltrona"]');
                var telefonePoltrona = $(this).find('[id="telefonePoltrona"]');
                var emailPoltrona = $(this).find('[id="emailPoltrona"]');
                var mensagemPoltrona = $(this).find('[id=mensagemPoltrona]');
                var numeroPoltrona = $(this).find('[id=numeroPoltrona]');

                mensagemPoltrona.html('<center><h3>Aguarde</h3></center>');

                nomePoltrona.attr('readOnly', 'true');
                rgPoltrona.hide();
                telefonePoltrona.hide();
                emailPoltrona.hide();
                $('#botaoConfirmaReservas').hide();

                //  paranaue para consultar se esse rg ja tem poltrona registrada
                consultaUsuario(rgPoltrona.val(), function(resultado) {

                    if (resultado === true) {
                        rgPoltrona.css('background-color', 'red');

                        nomePoltrona.css('background', 'red');
                        mensagemPoltrona.html('Você ja possui uma poltrona reservada nesse onibus');
                        $('#botaoConfirmaReservas').hide();
                    } else {
                        rgPoltrona.css('background-color', 'white');
                        //    mensagemPoltrona.html('Aguarde');

                        gravarUsuarioNaPoltrona(nomePoltrona.val(), rgPoltrona.val(),
                            telefonePoltrona.val(), emailPoltrona.val(), numeroPoltrona.val(),
                            function(resultado) {
                                console.log(resultado);
                                if (resultado === true) {

                                    nomePoltrona.attr('readOnly', 'true');
                                    rgPoltrona.hide();
                                    telefonePoltrona.hide();
                                    emailPoltrona.hide();
                                    $('#botaoConfirmaReservas').hide();

                                    contFinal++;
                                    mensagemPoltrona.html('<center><h3>Inserido</h3></center>');


                                }

                            });

                    }

                });

            });

            if (cont === contFinal) {

                $('#finalizarReserva').foundation('open');

            }
        }

        function consultaUsuario(rgPoltrona, callback) {
            $.ajax({
                data: {
                    rgPoltrona: rgPoltrona,
                    gravarPoltrona: '1'
                },
                url: 'index.php',
                dataType: 'json',
                type: 'POST',
                success: function(resultado) {
                    callback(resultado.retorno);
                }
            });
        }

        //funcao a ser migrada para outro arquivo
        function gravarUsuarioNaPoltrona(nomePoltrona, rgPoltrona, telefonePoltrona, emailPoltrona, numeroPoltrona, callback) {
            $.ajax({
                dataType: 'json',
                url: 'index.php',
                type: 'post',
                data: {
                    gravarCadeira: '1',
                    nomePoltrona: nomePoltrona,
                    rgPoltrona: rgPoltrona,
                    telefonePoltrona: telefonePoltrona,
                    emailPoltrona: emailPoltrona,
                    numeroPoltrona: numeroPoltrona
                },
                success: function(data) {
                    console.log(data);

                    callback(data.retorno);
                }
            });
        }

        //funcao a ser migrada para outro arquivo
        function inserirDadosPoltronas() {
            $('#abrirComandoInserir').foundation('open');

            $(".txtPoltronaEscolhida").each(function() {
                //  console.log('data');            
                var valor = $(this).attr('value');

                $('#inserirUsuariosPoltrona').append(" <div class='grid-x grid-padding-x   usuariosDasPoltronas  '   >" +
                    " <div class='large-12 medium-12 small-12 cell      '> " +
                    " <fieldset class='fieldset'> " +
                    " <legend><h4 style='color:white' >Poltrona:  " + valor + "  </h4></legend> " +
                    " <input type='text' class='camposUsuario'     id='nomePoltrona' placeholder='Nome' /> " +
                    " <input type='hidden' class='camposUsuario'     id='numeroPoltrona' placeholder='Nome' value='" + valor + "' /> " +
                    " <input type='text' class='camposUsuario'    id='telefonePoltrona'  onkeyup=\"somenteNumeros(this); mascara(this, 'CEL')\" maxlength=\"15\"    placeholder='Telefone' /> " +
                    " <input type='text' class='camposUsuario'    id='emailPoltrona' placeholder='Email' /> " +
                    " <h5 style='color:white' class='mensagemPoltrona' id=mensagemPoltrona> </h5>    " +
                    " <input type=text   class='camposUsuario'  id=rgPoltrona placeholder=\RG            /> " +


                    " </fieldset> </div></div> ");

            });

            $('#inserirUsuariosPoltrona').append(" <div class='grid-x grid-padding-x'>" +
                " <div class='large-12 medium-12 small-12 cell'>  <a class='button succes'  id='botaoConfirmaReservas' onclick='gravarPoltronas(); $(this).text(\"<center>AGUARDE</center>\")     ' style='width:100%'   >Enviar </a>   </div></div>");


            $('#inserirUsuariosPoltrona').append(" <div class='grid-x grid-padding-x'>" +
                " <div class='large-12 medium-12 small-12 cell'>  <a class='button success'  id='botaoConfirmaReservas' onclick='location.reload(true)' style='width:100%'   >Fechar tela da Reserva  </a>   </div></div>");



            //                                location.reload(true);



        }






        $('#mensagemSucesso').hide();
    </script>
</body>

</html>