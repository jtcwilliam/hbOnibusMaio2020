<?php

class Onibus {

    private $conexao;
    
    private $tipoOnibus;
    
    private $idViagem;
    
    private $statusOnibus;
    
    private $cadeira;
    
    private $numeroColuna;
    
    private $idUsuario;
     
    
    function getConexao() {
        return $this->conexao;
    }

    function setConexao($conexao) {
        $this->conexao = $conexao;
		
	
	}

	
        
        function getTipoOnibus() {
            return $this->tipoOnibus;
        }

        function getIdViagem() {
            return $this->idViagem;
        }

        function getStatusOnibus() {
            return $this->statusOnibus;
        }

        function getCadeira() {
            return $this->cadeira;
        }

        function getNumeroColuna() {
            return $this->numeroColuna;
        }

        function getIdUsuario() {
            return $this->idUsuario;
        }

        function setTipoOnibus($tipoOnibus) {
            $this->tipoOnibus = $tipoOnibus;
        }

        function setIdViagem($idViagem) {
            $this->idViagem = $idViagem;
        }

        function setStatusOnibus($statusOnibus) {
            $this->statusOnibus = $statusOnibus;
        }

        function setCadeira($cadeira) {
            $this->cadeira = $cadeira;
        }

        function setNumeroColuna($numeroColuna) {
            $this->numeroColuna = $numeroColuna;
        }

        function setIdUsuario($idUsuario) {
            $this->idUsuario = $idUsuario;
        }

        	
	
public function gerarOnibusTotal($tipoBus,$numeroColuna)
    {
                
        $bancos = array();
    
        $tabelaA = array();
        $tabelaB = array();
        $tabelaC = array();
        $tabelaD = array();

        $i=0;

        $vA=1;
        $vB=2;
        $vC=3;
        $vD=4;

        while ($i <11){
			
	 
			
			if($tipoBus == 70)
				{
				
					
				
				array_push($tabelaA, $vA);

				array_push($tabelaB, $vB);
				
				$vA+=4;        
				$vB+=4; 
				
				  
			 	if($i == 1  ){
					
				 
					   array_push($tabelaD,  0);
					   array_push($tabelaC, 0);
						$vD=0; 
						$vC=0; 
				} 
				 else if($i == 2  ){
					   array_push($tabelaD, 0);
					   array_push($tabelaC, 0);
						$vD=8;
						$vC=7;
				}  

				else
				{
					
				 
					array_push($tabelaD, $vD);
					 array_push($tabelaC, $vC);
					 $vD+=4; 
					 $vC+=4;
				}	
				
				$i++;
			} 
			//termina trecho do onibus grande
			
			 
				 
			else
				{
					
				 array_push($tabelaA, $vA);

				array_push($tabelaB, $vB); 
				
				array_push($tabelaC, $vC);
			
				array_push($tabelaD, $vD);

				
					$vA+=4;        
					$vB+=4;   
					$vC+=4;
					$vD+=4;
					$i++;
				 
				
				} 
        } 
		  
		//alterando cadeiras do final do bus
		switch($tipoBus){
			case 44:
				 array_push($tabelaA, '45');

            array_push($tabelaB, '46'); 
				break;
				
			case 70:
				 array_push($tabelaA, '43' );
      
				  array_push($tabelaB, '44' );

				  array_push($tabelaC,  '40');

				  array_push($tabelaD, '39' );
				break;
				 
		} 
			
			
		//vai definir o retorno, cada coluna precisa criar um array 
		switch($numeroColuna){
			case 1:
				return $tabelaA;
				break;
				
			case 2:
				return $tabelaB;
				break;
				
			case 3:
				return $tabelaC;
				break;
				
			case 4:
				return $tabelaD;
				break;
				
		}
		
		 
    }
	
	
	
    
   //classe para onibus menores de 40 e 44 lugares 
    public function gerarOnibusMenor($tipoBus = null,$numeroColuna = null)
    {
                
        $bancos = array();
    
        $tabelaA = array();
        $tabelaB = array();
        $tabelaC = array();
        $tabelaD = array();

        $i=0;

        $vA=1;
        $vB=2;
        $vC=3;
        $vD=4;

        while ($i <11){

            array_push($tabelaA, $vA);

            array_push($tabelaB, $vB); 
			
			array_push($tabelaC, $vC);
			
			array_push($tabelaD, $vD);

			
				$vA+=4;        
				$vB+=4;   
                                
                                
                        
                                
				$vC+=4;
				$vD+=4;
                        
				$i++;
			  
                        
		 
        } 
		
		if($tipoBus == 46)
		{
			  array_push($tabelaA, '45');

            array_push($tabelaB, '46'); 
		}
                
                if($tipoBus == 42)
                {
                     unset($tabelaD[10]);
                        
                     unset($tabelaC[10]);

                }
		
		
		
		switch($numeroColuna){
			case 1:
				return $tabelaA;
				break;
				
			case 2:
				return $tabelaB;
				break;
				
			case 3:
				return $tabelaC;
				break;
				
			case 4:
				return $tabelaD;
				break;
				
		}
		
		 
    }
	
	
	
	//classe para onibus grande
	 public function gerarOnibusMaior($numeroColuna = null)
    {
                
        $bancos = array();
    
        $tabelaA = array();
        $tabelaB = array();
        $tabelaC = array();
        $tabelaD = array();

        $i=0;

        $vA=1;
        $vB=2;
        $vC=3;
        $vD=4;

        while ($i <11){

            array_push($tabelaA, $vA);

            array_push($tabelaB, $vB); 
			 
			
			  
			
			//começa o trecho do onibus grande
			 	if($i == 1  ){
					   array_push($tabelaD, 0);
					   array_push($tabelaC, 0);
						$vD=0; 
						$vC=0; 
				} 
				 else if($i == 2  ){
					   array_push($tabelaD, 0);
					   array_push($tabelaC, 0);
						$vD=8;
						$vC=7;
				}  

				else
				{
					array_push($tabelaD, $vD);
					 array_push($tabelaC, $vC);
					 $vD+=4; 
					 $vC+=4;
				}		
			
			
				$vA+=4;        
				$vB+=4;   
				 
				$i++;
			} 
			//termina trecho do onibus grande
			
			
			
		 
		  array_push($tabelaA, '43' );
      
		  	array_push($tabelaB, '44' );

		  array_push($tabelaC,  '40');

		  	array_push($tabelaD, '39' );

		
		
		switch($numeroColuna){
			case 1:
				return $tabelaA;
				break;
				
			case 2:
				return $tabelaB;
				break;
				
			case 3:
				return $tabelaC;
				break;
				
			case 4:
				return $tabelaD;
				break;
				
		}
		
		 
    }
    

    public function __construct() 
        {
            include_once 'Conexao.php';
            $objConectar = new conexao();
            $banco = $objConectar->conectar();
            $this->setConexao($banco);
        }
        
        
    public function inserirOnibus() {                
        {                
            $sql = "  INSERT INTO onibusViagem 
                        (   
                            tipoOnibusViagem,
                            statusOnibusViagem,
                            idViagem
                        )
                            VALUES
                                (
                                    '".$this->getTipoOnibus()."',
                                    '".$this->getStatusOnibus()."',
                                    '".$this->getIdViagem()."'
                                )";
                 
            
            echo $sql;
            
            
            $query = mysqli_query($this->getConexao(), $sql);

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