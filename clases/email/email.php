<?php

namespace email;

require(__DIR__ . '/../../vendor/autoload.php');

use \PHPMailer\PHPMailer\PHPMailer; // Importamos la liberia PHPMailer

class email {

    private $email;
    private $pass;
    private $xml = __DIR__ . "/../../config/correo.xml";
    private $xsd = __DIR__ . "/../../config/correo.xsd";

    function __construct() {

        $datos = $this->leer_configCorreo($this->xml, $this->xsd);

        $this->email = $datos[0];
        $this->pass = $datos[1];
    }


    function enviarCorreo($correo, $cuerpo, $asunto = "") {


        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0; 
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->Username = $this->email;
        $mail->Password = $this->pass;        
        $mail->SetFrom($this->email, 'WhereIsMyPet');
        $mail->Subject = $asunto;
        $mail->MsgHTML($cuerpo);
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        
        $mail->AddAddress($correo, $correo);
		
        if (!$mail->Send()) {
			echo $mail->ErrorInfo;
            return $mail->ErrorInfo;
        } else {
            return TRUE;
        }
    }




    function leer_configCorreo($xml, $xsd) {

        $config = new \DOMDocument();
        $config->load($xml);
        $res = $config->schemaValidate($xsd);

        if ($res === FALSE) {
            throw new InvalidArgumentException("Error en el fichero de configuración del correo");
        }

        $datos = simplexml_load_file($xml);
        $usu = $datos->xpath("//usuario");
        $clave = $datos->xpath("//clave");
        $resul = [];
        $resul[] = $usu[0];
        $resul[] = $clave[0];
        return $resul;
    }

}
