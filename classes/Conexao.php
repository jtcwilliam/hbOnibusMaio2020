<?php

class Conexao 
{
    private $success;
	
	

    public function Conectar() 
    {
        try 
        {   
            
   /*
            //desenvolvimento
               
                $user = 'root';
                $password = 'root';
                $db = 'bancoWilliam';
                $host = 'localhost';
                
                //producao
           
                $user = 'casadojo_dev';
                $password = 'harlem';
                $db = 'casadojo_bancoHbSonhos';
                $host = 'localhost';                            
               */
                
                
                
                   //producao2
               
                $user = 'casadojo_busHB';
                $password = 'harlem';
                $db = 'casadojo_moduloOnibus';
                $host = 'casadojovemguarulhos.com.br';                            
              
                 
       $con=mysqli_connect($host,$user,$password,$db);
                 
              //producao
            //$conexao = pg_connect('host=pgsql.pgsql05-farm56.kinghost.net   port=5432 dbname=casadojovemguarulhos4 user=casadojovemguarulhos4 password=harlem');
            
            //desenvolvimento
           //  $conexao = pg_connect('host=pgsql.pgsql05-farm56.kinghost.net   port=5432 dbname=casadojovemguarulhos4 user=casadojovemguarulhos4 password=harlem');
 
              if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }




           
            
            
            
            
            
        return $con;
           
            } catch (Exception $exc) 
            {
                echo $exc->getTraceAsString();
            }
    }
}
