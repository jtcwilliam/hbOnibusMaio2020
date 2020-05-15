<?php

class Viagem {

    
    private $LocalViagem; 
    private $dataViagem;
    private $idViagem;
    private $statusViagem;
    
    
    private $numeroPoltrona;
    private $onibusViagem_idOnibusViagem;
    private $usuario_idusuario;
    private $idPoltrona;
    
    function getNumeroPoltrona() {
        return $this->numeroPoltrona;
    }

    function getOnibusViagem_idOnibusViagem() {
        return $this->onibusViagem_idOnibusViagem;
    }

    function getUsuario_idusuario() {
        return $this->usuario_idusuario;
    }

    function getIdPoltrona() {
        return $this->idPoltrona;
    }

    function setNumeroPoltrona($numeroPoltrona) {
        $this->numeroPoltrona = $numeroPoltrona;
    }

    function setOnibusViagem_idOnibusViagem($onibusViagem_idOnibusViagem) {
        $this->onibusViagem_idOnibusViagem = $onibusViagem_idOnibusViagem;
    }

    function setUsuario_idusuario($usuario_idusuario) {
        $this->usuario_idusuario = $usuario_idusuario;
    }

    function setIdPoltrona($idPoltrona) {
        $this->idPoltrona = $idPoltrona;
    }

        
    
    function getStatusViagem() {
        return $this->statusViagem;
    }

    function setStatusViagem($statusViagem) {
        $this->statusViagem = $statusViagem;
    }

        
    
    function getLocalViagem() {
        return $this->LocalViagem;
    }

    function getDataViagem() {
        return $this->dataViagem;
    }

    function getIdViagem() {
        return $this->idViagem;
    }

    function setLocalViagem($LocalViagem) {
        $this->LocalViagem = $LocalViagem;
    }

    function setDataViagem($dataViagem) {
        $this->dataViagem = $dataViagem;
    }

    function setIdViagem($idViagem) {
        $this->idViagem = $idViagem;
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
        
        
        
        
        
         public function inserirViagem() {                
            {                
            $sqlInserirUsuario = " 
                                     INSERT INTO viagem
                                                    (   localViagem,
                                                        dataViagem,
                                                        statusViagem
                                                    )
                                                VALUES
                                                    (
                                                        '".$this->getLocalViagem()." ',
                                                        '".$this->getDataViagem()." ',
                                                        '".$this->getStatusViagem()." '"
                                . ")";
                                             
    
                          
               
            $query = mysqli_query($this->getConexao(), $sqlInserirUsuario);

            if($query)
                {
                    return true;
                }    
               
        } 

    }
        
        
         
  
    
      public function inserirUsuarioViagemPoltrona() {                
            {                
            $sqlInserirUsuarioBusViagem = " INSERT INTO  poltrona (numeroPoltrona,onibusViagem_idOnibusViagem,usuario_idusuario )
                                                            VALUES
                                                                ('".$this->getNumeroPoltrona()."', '".$this->getOnibusViagem_idOnibusViagem()."',  '".$this->getUsuario_idusuario()."')" ;
            
            
         
                 
            
            $query = mysqli_query($this->getConexao(), $sqlInserirUsuarioBusViagem);

            if($query)
                {
                      return true;
                }                   
        } 
    }



    public function atualizarUsuarioViagemPoltrona() {                
        {                
        $sqlInserirUsuarioBusViagem = "update poltrona set usuario_idUsuario = ".$this->getUsuario_idusuario()." where numeroPoltrona = ".$this->getNumeroPoltrona()." and onibusViagem_idOnibusViagem = ".$this->getOnibusViagem_idOnibusViagem();
        
        
        
     
             
        
        $query = mysqli_query($this->getConexao(), $sqlInserirUsuarioBusViagem);

        if($query)
            {
                return true;
            }                   
    } 
}
    
    
    
     public function alterarStatusViagem() {                
            {                
            $sqlInserirUsuarioBusViagem = " 
                                       update viagem set statusViagem = ".$this->getStatusViagem()." 
                                                                    where idviagem = ". $this->getIdViagem();
                 
            
         
                    
            
            $query = mysqli_query($this->getConexao(), $sqlInserirUsuarioBusViagem);

            if($query)
                {
                    return true;
                }                   
        } 
    }
        
        
        
        
     public function selecaoGenerica ( $filtro )
        
            { 
        
            $resultado=     mysqli_query($this->getConexao(),   "select  ".$filtro);
             
            
            //echo "select    ".$filtro;
           
           $dados = array();
            
            while ($row = mysqli_fetch_assoc($resultado))
            {
                
                array_push($dados, $row);
            }
            
            return $dados;
 
        }
        
        
         
        
        
        
        
        
        
        
        


}

?>