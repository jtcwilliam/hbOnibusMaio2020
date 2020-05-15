<?php




 ini_set('default_charset','UTF-8');



session_start();
 //ob_start();
    
                                             

                                             

        include 'classes/classeGenerica.php';

        $objGenerica = new ClasseGenerica();

                                             
        $poltronas = $objGenerica->selecaoGenerica('    nomeBusUsuario, telefoneBusUsuario, rgBusUsuario, buv.busPoltrona
                        from busUsuario bus inner join busUsuarioViagem buv on buv.busUsuario = bus.idBusNomeUsuario where buv.buspoltrona !=0 ');
                                             

        ?>

    <html class="no-js" lang="en" dir="ltr">
 
        <style>        
            label
            {
                color: white;
                font-weight: bold;
            }

        </style>

        <body style="background-color: white" >
 
            <div class="grid-container">
 
                <div class="grid-x  " id="cartasSemAdocao">
                    <div class="small-12 medium-12 large-12">    
  
                         <table   style="width: 100%;   border: 3px solid black;">
                        <thead>
                            <TD style="width: 60%; font-size: 18px; font-weight: bolder; " >Nome Usuário</td>
                            <TD style="width: 15%; font-size: 18px; font-weight: bolder; " >Telefone Usuário</td>
                            
                            <TD style="width: 60%; font-size: 18px; font-weight: bolder; " >Rg Usuario</td>
                            <TD style="width: 15%; font-size: 18px; font-weight: bolder; " >Poltrona</td>
                            
                            
                             
                        </thead>



                            <tbody>
                                <?php 
                                
                               
                                
                                
                                    foreach ($poltronas as $valor) 
                                        {?>
                                            <tr style="font-size: 25px;   align-content: center">
                                                
                                                <TD style="width: 60%; font-size: 14px; text-align: left; font-weight: normal; " ><?=$valor['nomeBusUsuario'] ?></td>
                                                <TD style="width: 15%; font-size: 14px; text-align: left; font-weight: normal; " ><?=$valor['telefoneBusUsuario'] ?></td>

                                                <TD style="width: 60%; font-size: 14px; text-align: left; font-weight: normal; " ><?=$valor['rgBusUsuario'] ?></td>
                                                <TD style="width: 15%; font-size: 14px; text-align: left; font-weight: normal; " ><?=$valor['busPoltrona'] ?></td>

                                                

                                            </tr>
                                                  
                                             <?php
                                           
                                         }

                                           

                                        ?>   






                            </tbody>
                        </table>
                    </div> 
                </div>              
            </div>









        <script>







            </script>




        </body>
    </html>


    <?php


                                             
            
            
      /*
  //  $dados = ob_get_contents();
    
     $nomeArquio = date('d-m-y_s');
     $arquivo = "relatorioStatus".$nomeArquio.".xls";  
    // Configurações header para forçar o download  
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$arquivo.'"');
    header('Cache-Control: max-age=0');
    // Se for o IE9, isso talvez seja necessário
    header('Cache-Control: max-age=1');
       
    // Envia o conteúdo do arquivo  
    echo $dados;  
   
    exit();
       
    */

     ?>