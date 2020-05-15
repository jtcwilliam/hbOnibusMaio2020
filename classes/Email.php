<?php
//Variáveis

class Email {
    
    private $destinatario;
    private $mensagem;
    private $mensageiro;
    
    
    function getMensageiro() {
        return $this->mensageiro;
    }

    function setMensageiro($mensageiro) {
        $this->mensageiro = $mensageiro;
    }

        
    function getDestinatario() {
        return $this->destinatario;
    }

    function getMensagem() {
        return $this->mensagem;
    }

    function setDestinatario($destinatario) {
        $this->destinatario = $destinatario;
    }

    function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }

    
    public function enviarEmail() {

/*
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $opcoes = $_POST['escolhas'];
        $mensagem = $_POST['msg'];
        $data_envio = date('d/m/Y');
        $hora_envio = date('H:i:s');
*/

        // Compo E-mail
                $arquivo = '
              <html>
            <head>
                <title>TODO supply a title</title>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
            </head>
             <body style="color: black"  >
             <center>'.$this->getMensagem().'

             </center>

             <center><img src="https://www.guarulhos.sp.gov.br/sites/default/files/inline-images/LOGO_BRASAO_PREFEITURA_GRU_VERTICAL_CONTORNO.png" style="width: 40%" ></center>
            </body>
        </html>


  ';
        //enviar
        // emails para quem será enviado o formulário
        $emailenviar = $this->getDestinatario();
        $destino = $emailenviar;
        $assunto = "Contato pelo Site";

        // É necessário indicar que o formato do e-mail é html
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: 9ª Feira do Estudante - Prefeitura de Guarulhos.<$email>';
        //$headers .= "Bcc: $EmailPadrao\r\n";

        
        try {
             $enviaremail = mail($destino, $assunto, $arquivo, $headers);
             
             if($enviaremail){
                 return true;
             }else
             {
                 return false;
             }
             
             
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }



       
        
        
        /*if ($enviaremail) {
            $mgm = "E-MAIL ENVIADO COM SUCESSO! <br> O link será enviado para o e-mail fornecido no formulário";
            echo " <meta http-equiv='refresh' content='10;URL=contato.php'>";
        } else {
            $mgm = "ERRO AO ENVIAR E-MAIL!";
            echo "";
        }
         * 
         */
    }

}
