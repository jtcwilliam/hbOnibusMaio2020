<?php

class Usuario {

    private $conexao;
    
    
 
  private $idusuario;
  private $nomeUsuario;
  private $telefoneUsuario;
  private $emailUsuario;
  private $statusUsuario;
  private $rgUsuario;
  
  
  function getIdusuario() {
      return $this->idusuario;
  }

  function getNomeUsuario() {
      return $this->nomeUsuario;
  }

  function getTelefoneUsuario() {
      return $this->telefoneUsuario;
  }

  function getEmailUsuario() {
      return $this->emailUsuario;
  }

  function getStatusUsuario() {
      return $this->statusUsuario;
  }

  function getRgUsuario() {
      return $this->rgUsuario;
  }

  function setIdusuario($idusuario) {
      $this->idusuario = $idusuario;
  }

  function setNomeUsuario($nomeUsuario) {
      $this->nomeUsuario = $nomeUsuario;
  }

  function setTelefoneUsuario($telefoneUsuario) {
      $this->telefoneUsuario = $telefoneUsuario;
  }

  function setEmailUsuario($emailUsuario) {
      $this->emailUsuario = $emailUsuario;
  }

  function setStatusUsuario($statusUsuario) {
      $this->statusUsuario = $statusUsuario;
  }

  function setRgUsuario($rgUsuario) {
      $this->rgUsuario = $rgUsuario;
  }

   
    
    
     
 
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
         
          public function inserirUsuario() {                
            {                
            $sqlInserirUsuario = "INSERT INTO  usuario ( nomeUsuario, telefoneUsuario,emailUsuario, rgUsuario, statusUsuario)VALUES
            ('".$this->getNomeUsuario()."',
            '".$this->getTelefoneUsuario()."' ,
            '".$this->getEmailUsuario()."' ,
            '".$this->getRgUsuario()."' ,
            '".$this->getStatusUsuario()."')";
            
            
            //echo $sqlInserirUsuario;
                 
            $query = mysqli_query($this->getConexao(), $sqlInserirUsuario);
            
            

            if($query)
                {
                    return true;
                }    
            
            
        } 

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