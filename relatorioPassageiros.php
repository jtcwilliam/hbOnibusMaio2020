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
      
      
      <div class="grid-container"> 
          
          <Br>

          <div class="grid-x grid-padding-x"  >
              <div class="cell small-12 medium-12 large-12">

                  <?php
                  $viagensAtivas = $objGenerica->selecaoGenerica(" * from onibusViagem where idViagem in(   select idViagem from viagem where statusViagem=1)");

             
                  foreach ($viagensAtivas as $key => $value) 
                  {
                      ?>
                  
                  
                            <table>
                                    <thead>
                                      <tr>
                                        <th width="400">Nome</th>
                                        <th>RG</th>
                                         <th>Telefone</th>
                                        <th>Poltrona</th>
                                      </tr>
                                    </thead>
                                    <tbody> 
                      
                      <?php
                      
                      $onibusAtivo = $objGenerica->selecaoGenerica("  nomeUsuario, telefoneUsuario, rgUsuario, pt.numeroPoltrona
                        from usuario us inner join poltrona pt   on pt.usuario_idusuario = us. idusuario where pt.onibusViagem_idOnibusViagem =".$value['idOnibusViagem'] );
                      
                        foreach ($onibusAtivo as $key => $value) 
                            {

                                ?>
                                      <tr>
                                          <td width="200"><?=$value['nomeUsuario']?></th>
                                         <td width=""><?=$value['rgUsuario']?></th>
                                          <td width=""><?=$value['telefoneUsuario']?></th>
                                       <td width=""><?=$value['numeroPoltrona']?></th>
                                      </tr>
                                  <?php


                              

                            }?>
                      
                        </tbody>
                                  </table>
                   
                        
                  <?php }  ?>
              </div>
          </div>
      </div>
       
     

    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
    
    <script>
       
        
      
         
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
         
     
      
  
     
        
     
        
      
        
        $('#mensagemSucesso').hide();
         
        
        </script>
  </body>
</html>
