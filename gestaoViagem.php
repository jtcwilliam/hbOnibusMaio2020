<?php
     include_once './classes/classeGenerica.php';
     
     include_once './classes/Viagem.php';
     
     
            
    $objGenerica = new ClasseGenerica();
    $objViagem = new Viagem();
 
 
 
  if(isset($_POST['gravarViagem']))
  {
      
      $objViagem->setLocalViagem($_POST['nomeLocalViagem']);
      $objViagem->setDataViagem($_POST['dataViagem']);
      
      if($objViagem->inserirViagem())
      {
          echo ' inserida a viagem';
      }
      
      
  }
    


    
      
    
       
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hamburgada do Bem</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <script src="js/validadores.js"></script>
  </head>
  <body>
    <div class="grid-container">
      <div class="grid-x grid-padding-x">
        <div class="large-12 cell">
          <h1>Gestão Viagens </h1>
        </div>
      </div>
        <!--modal mensagens de sucesso -->
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
                                
                                <center><img src="img/loader.gif" /></center>
                                
                            </div>
                            
                            <div  id="camposReserva"   class="cell small-12 medium-6 large-6"  style="color: white; font-weight: bolder; display: block" > 
                                <center>  <h4>Para confirmar sua reserva, insira os dados abaixo </h4></center>
                                <br>
                                <label class="" style="color: whitesmoke; font-weight: bold">Digite o nome na caixa abaixo
                                    <input class="txt" type="text" id="txtNome" style="border-radius: 10px;"      name="txtNome" placeholder="Digite o Nome "/>
                                </label> 
                                 <label class="" style="color: whitesmoke; font-weight: bold">Digite o celular na caixa abaixo
                                    <input class="txt" type="text" id="txtTelefone" style="border-radius: 10px;"    onkeyup="somenteNumeros(this); mascara(this, 'CEL')" maxlength="15"   name="txtTelefone" placeholder="Digite o Celular"/>
                                </label>
                                
                                 <label class="" style="color: whitesmoke; font-weight: bold">Digite o RG na caixa abaixo
                                    <input class="txt" type="text" id="txtRg" style="border-radius: 10px;"     name="txtRg" placeholder="Digite o RG"/>
                                    
                                    <input class="txt" type="hidden" id="txtNumeroPoltrona" style="border-radius: 10px;"    />
                                    
                                    <input class="txt" type="hidden" id="txtIdBus" style="border-radius: 10px;" value="1"   />
                                    
                                    <input class="txt" type="hidden" id="txtIdViagem" style="border-radius: 10px;" value="1"   />
                                </label> 
                                <br>  
                                <center>
                                    <div id="numeroPoltronaModal" >
                                        
                                    </div>
                                </center>
                                <br> 
                                <center>
                                    <a class="button  "  onclick="viagemUsuario();   $('#camposReserva').hide();     "   type="button" style="  width: 40%; border-radius: 8px; background-color: #555"   >   Aceitar  </a>
                                </center> 
                             
                            </div>  
                            <div class="cell auto" >

                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
        
         
        
        
        <div class="grid-x grid-padding-x">
            <div class="large-12 medium-12 small-12 cell">
               
                <form>
            <div class="grid-x grid-padding-x"  >
                <div class="large-12 cell">
                    <fieldset class="fieldset">
                        <legend>Cadastrar Viagem</legend>
                        <div class="grid-x grid-padding-x">
                            <div class="small-12 medium-6 cell">
                                <label>Local da Viagem
                                    <input type="text"  id="txtLocalViagem"  placeholder="Digite o local da viagem">
                                </label>
                            </div>
                            <div class="small-12 medium-3 cell">
                                <label>Data da Viagem
                                    <input   id="txtDataViagem" type="date">

                                </label>
                            </div>
                            <div class="small-12 medium-3 cell">
                                <label>&nbsp;<br>
                                    <a class="button success" onclick="cadastrarViagem()" style="width: 100%" >Inserir Viagem</a>

                                </label>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>

        </form>
                
            </div>
        </div>
           
    </div>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
    
    <script>
        
          function cadastrarViagem()
            {     
                 
                var nomeLocalViagem= $('#txtLocalViagem').val();
                
                var dataViagem= $('#txtDataViagem').val();
                 
                $.ajax({
                 dataType: 'html',
                 url: 'gestaoViagem.php',
                 type: 'post',
                     data: {gravarViagem: '1', nomeLocalViagem:nomeLocalViagem,  dataViagem:dataViagem    },
                     success: function (data)
                     {   
                         console.log(data);
                          
                           
                     }
                 });   
 
            } 
        
        
        
        
        </script>
  </body>
</html>
