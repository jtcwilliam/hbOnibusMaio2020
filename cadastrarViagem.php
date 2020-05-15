<?php


//inseridos os onibus no sistema
        
    include_once 'classes/Viagem.php';
    include_once './classes/Onibus.php';
    
    $objViagem = new Viagem();
    $objOnibus = new Onibus();

    
        if(isset($_POST['consultarOnibusDaViagem']))
        {
            
            
            $onibusCadastradosParaviagem = $objViagem->selecaoGenerica("  * from onibusViagem where statusOnibusViagem = 1 and idViagem=".$_POST['idViagem']);
            
            print_r($onibusCadastradosParaviagem);
            
            exit();
            
            
        }
    
        if(isset($_POST['inserirOnibus']))
        {
            //  tipoOnibus:tipoOnibus, idViagem:idViagem 
            $objOnibus->setIdViagem($_POST['idViagem']);
            $objOnibus->setTipoOnibus($_POST['tipoOnibus']);
            $objOnibus->setStatusOnibus('1');
            
            $objOnibus->inserirOnibus();
            
            
            exit();
           
            
        }
        
        if(isset($_POST['alterarStatusViagem']))
        {
            //alterarStatusViagem: '1',   idViagem:idViagem, statusViagem:statusViagem 
            $objViagem->setIdViagem($_POST['idViagem']);
            $objViagem->setStatusViagem($_POST['statusViagem']);
            
            $objViagem->alterarStatusViagem();
             
            exit();
            
        }
    
        if(isset($_POST['inserirViagem']))
        {
            $objViagem->setDataViagem($_POST['dataViagem']);
            $objViagem->setLocalViagem($_POST['localViagem']);
            $objViagem->setStatusViagem('1');
            $objViagem->inserirViagem();
            
            
            exit();
        }    
         
        if(isset($_POST['localViagem']))
        {
            $dadosViagem = $objViagem->selecaoGenerica( "    idviagem, localviagem,  DATE_FORMAT( dataViagem, '%d/%m/%Y' ) as dataDaViagem   FROM  viagem  where statusViagem=1 ");
                        
            foreach ($dadosViagem as $value)                                  
                {?>
                   <div class="small-12 medium-12   large-6 cell">
                        <table class="tabs-content" style="width: 100%; text-align: left " >
                            <tr><td colspan="2"><center>  <h3><?=$value['localviagem']?></h3><center> </td></tr>
                            <tr><td><b>Data</b></td> <td  style="text-align: left"><?=$value['dataDaViagem']?>  </td></tr>                                  
                            <tr>  <td    style="text-align: center">  <a  onclick="alterarStatusViagem(<?=$value['idviagem']?>, 0)"> <i  style="color: red; font-size: 30px" class="fas fa-times-circle" aria-hidden="true"></i> </a>  </td>
                                    <td   style="text-align: center">  <a   onclick=" $('#complementarViagem').foundation('open');  $('#viagemBusInserir').val(<?=$value['idviagem']?>);  selecionarOnibus(<?=$value['idviagem']?>)     "> <i  style="color: blue; font-size: 30px " class="fas fa-edit" aria-hidden="true"></i> </a>  </td>
                            </tr>
                        </table>
                    </div>                     
                    <?php
                }
            exit();
        }
?>      
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão Viagem</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <script src="https://kit.fontawesome.com/9747768da7.js"></script>
  </head>
  <body>
      
      
      
      <div class="full reveal" id="complementarViagem" data-reveal data-v-offset="0" style="   background-color: rgba(0, 0, 0, 1);   "  >
                    <div class="grid-container  ">
                        
                             
                                <input type="hidden" id="viagemBusInserir" />
                                
                                <fieldset class="fieldset">
                                    <legend><h4 style="color: white;  ">Inserir Onibus</h4></legend>
                                    <div class="grid-x grid-margin-x">
                                        <div     class="cell small-12 medium-4 large-4"  style="color: white;  " > 
                                            <a onclick="inserirOnibus('42', $('#viagemBusInserir').val())" class="button success" style="width: 100%; border-radius: 10px"><h2 style="color: white"> 42 lugares   </h2>  </a>
                                            
                                            
                                        </div>
                                        
                                        <div     class="cell small-12 medium-4 large-4"  style="color: white;  " > 
                                            <a onclick="inserirOnibus('46', $('#viagemBusInserir').val())" class="button warning" style="width: 100%; border-radius: 10px "><h2 style="color: white"> 46 lugares   </h2>  </a>
                                            
                                            
                                        </div>
                                        
                                         <div     class="cell small-12 medium-4 large-4"  style="color: white;  " > 
                                             <a onclick="inserirOnibus('75', $('#viagemBusInserir').val())" class="button alert" style="width: 100%; border-radius: 10px"><h2 style="color: white"> 2000 lugares   </h2>  </a>
                                            
                                            
                                        </div>
                                    </div>
                                </fieldset>
                                
                                <br>
                                <h4 id=" "> </h4>
                                </center>
                             
                        
                    </div>
                </div>
      
      
      
                <div class="full reveal" id="sucessoDiv" data-reveal data-v-offset="0" style="   background-color: rgba(0, 0, 0, 0.9);   "  >
                    <div class="grid-container meioTelaVertical">
                        <div class="grid-x grid-margin-x">
                            <div  id="mensagemSucesso"   class="cell small-12 medium-12 large-12"  style="color: white; font-weight: bolder" > 
                                <center>  <h2>Parabéns </h2>
                                <br>
                                <h4 id="mensagem"> </h4>
                                </center>
                            </div>  
                        </div>
                    </div>
                </div>
      
      
    <div class="grid-container">
       

     
            <div class="grid-x grid-padding-x"  >
                <div class="large-12 cell">
                    <fieldset class="fieldset">
                        <legend ><h3 style="font-weight: bold" >Cadastrar Viagem</h3></legend>
                        <div class="grid-x grid-padding-x">
                            <div class="small-12 medium-6 cell">
                                <label>Local da Viagem
                                    <input type="text" id="localViagem" placeholder="Digite o local da viagem">
                                </label>
                            </div>
                            <div class="small-12 medium-3 cell">
                                <label>Data da Viagem
                                    <input id="dataViagem" type="date">

                                </label>
                            </div>
                            <div class="small-12 medium-3 cell">
                                <label>&nbsp;<br>
                                    <a class="button success" style="width: 100%" onclick="inserirViagem()"  >Inserir Viagem</a>

                                </label>
                            </div>
                        </div>
                    </fieldset>
                    
                    
                    
                </div>
            </div>
        
        
       
                <fieldset class="fieldset">
                    <legend ><h3 style="font-weight: bold" >Viagens Ativas</h3></legend>
                        
                  

                             <div class="grid-x grid-padding-x"   id="viagensAtivas" >  </div>
                             
                           

                     
                </fieldset>

           
       
    </div>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
    <script>
        
          selecionarViagens();
          
          
           
          
          
    function selecionarOnibus(idViagem)
        {   
                       
            $.ajax({
            dataType: 'html',
            url: 'cadastrarViagem.php',
            type: 'post',
                data: {consultarOnibusDaViagem: '1', idViagem:idViagem },
                success: function (data)
                    {
                         console.log(data);
                    }
            });   
        }      
          
          
          
          
          
    function inserirViagem(   )
        {   
            var localViagem = $('#localViagem').val();
            var dataViagem = $('#dataViagem').val();            
            $.ajax({
            dataType: 'html',
            url: 'cadastrarViagem.php',
            type: 'post',
                data: {inserirViagem: '1',  localViagem:localViagem, dataViagem:dataViagem   },
                success: function (data)
                    {
                        $('#sucessoDiv').foundation('open');
                        $('#mensagem').html('Viagem Cadastrada com Sucesso');
                        selecionarViagens();
                    }
            });   
        }
        
        function inserirOnibus( tipoOnibus, idViagem  )
        {           
            $.ajax({
            dataType: 'html',
            url: 'cadastrarViagem.php',
            type: 'post',
                data: {inserirOnibus: '1',  tipoOnibus:tipoOnibus, idViagem:idViagem   },
                success: function (data)
                    {
                        
                        console.log(data);
                        
                         $('#complementarViagem').foundation('close');
                          $('#sucessoDiv').foundation('open');
                        $('#mensagem').html('Onibus inserido');
                        
                    }
            });   
        }
        
        //essa função troca o status da viagem
        function alterarStatusViagem(  idViagem, statusViagem )
        {   
           
            $.ajax({
            dataType: 'html',
            url: 'cadastrarViagem.php',
            type: 'post',
                data: {alterarStatusViagem: '1',   idViagem:idViagem, statusViagem:statusViagem   },
                success: function (data)
                    {
                        
                        console.log(data);
                        $('#sucessoDiv').foundation('open');
                          $('#mensagem').html('Viagem Excluída');
                        selecionarViagens();
                    }
            });   
        }
        
        
    function selecionarViagens(   )
        {   
            $.ajax({
            dataType: 'html',
            url: 'cadastrarViagem.php',
            type: 'post',
                data: {localViagem: '1' },
                success: function (data)
                    {    
                        
                        
                        $('#viagensAtivas').html(data);
                        
                        //console.log(data);
                       
                    }
            });   
 
        }
        
        
        
        
        
        
            </script>
  </body>
</html>
