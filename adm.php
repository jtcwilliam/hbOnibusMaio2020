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
    
    
    legend, label{
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
      
      <Br><br>
      
      <div class="grid-container" id="boxSenha"> 

          <div class="grid-x grid-padding-x" style="background-color: #1779ba">
              <div class="cell small-12 medium-12 large-12">

                  <form>
                      <div class="grid-container">
                          <div class="grid-x grid-padding-x">
                               <div class="cell small-12 medium-5 large-5">
                             
                                  <label>usuario
                                      <input type="text" id="txtUser" placeholder="Digite seu usuário">
                                  </label>
                              </div>
                               <div class="cell small-12 medium-5 large-5">
                                  <label>senha
                                      <input type="text" id="txtSenha" placeholder="Digite sua Senha">
                                  </label>
                              </div>
                              
                           <div class="cell small-12 medium-2 large-2">
                                  <label>&nbsp;
                                      <a class="button success" onclick="consultaUsuario($('#txtUser').val(),  $('#txtSenha').val() )" style="color: whitesmoke;  background-color: #008DD7;  width: 100%">OK</a>
                                  </label>
                              </div>
                          </div>
                      </div>
                      
                      
                       
                      
                      
                      
                  </form>

              </div>
              
              
           



          </div>
      </div>
       
      
                <div class="grid-container" id="boxLinks">
                    <div class="grid-x grid-padding-x">

                        <div  class="cell small-12 medium-3 large-12">
                            <div class="expanded button-group">
                                <a class="button" style="width: 100%" href="cadastrarViagem.php" target="_blank">Administrar Viagem</a>
                                <a class="button"  href="relatorioPassageiros.php" target="_blank">Relatorio Onibus da Viagem</a>
                                <a class="button" href="index.php" target="_blank">Reservar</a>
                            </div>


                        </div>
                    </div>
                </div>
     

    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
    
    <script>
       
         $('#boxLinks').hide();
      
         
        function consultaUsuario(usuario, senha)
        {
            
            var user=usuario;
            var pwd=senha;
            
            if(user =='admhb' && senha=='admhb123')
            {
               $('#boxSenha').hide();
               
                $('#boxLinks').show ();
               
            }else
            {
                 
            }
	 
        } 
         
     
      
  
     
        
     
        
      
        
        $('#mensagemSucesso').hide();
         
        
        </script>
  </body>
</html>
