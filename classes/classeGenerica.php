<?php

class ClasseGenerica {

    private $conexao;
 
    
    function getConexao() {
        return $this->conexao;
    }

    function setConexao($conexao) {
        $this->conexao = $conexao;
    }

    

    public function __construct() 
        {
            include_once 'Conexao.php';
            $objConectar = new conexao();
            $banco = $objConectar->conectar();
            $this->setConexao($banco);
        }
        
        
         
        
     public function selecaoGenerica ( $filtro )
        
            { 
        
            $resultado=     mysqli_query($this->getConexao(),   "select    ".$filtro);
            
      
            
            
             
           $dados = array();
            
            while ($row = mysqli_fetch_assoc($resultado))
            {
                
                array_push($dados, $row);
            }
            
           
            
            
            return $dados;
 
        }
        
        
         
        
        
        
        
        
        
        
        


}

?>