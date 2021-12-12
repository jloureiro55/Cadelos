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

    /**
     * Función que envia un corre electorinico
     * 
     * @param string $correo cadena de texto con la dirección del correo del usuario
     * @param string $cuerpo cadena de texto con la información del correo
     * @param sting $asunto cadena de texto opcional con el asunto del correo
     * @return mixed Duelve true si el correo fue envia con exito, en caso contrario
     * devuelve el error
     */
    function enviarCorreo($correo, $cuerpo, $asunto = "") {

        /*
         * Recibe un array de direcciones de correo, el cuerpo del correo y el asunto.
         * Envía el correo a todas las direcciones.
         */
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;  // cambiar a 1 o 2 para ver errores
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->Username = $this->email;  // Cuenta del Gmail
        $mail->Password = $this->pass; // Contraseña del Gmail          
        $mail->SetFrom($this->email, 'Hotel Cache');
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



    /**
     * Función leer los datos de conexión del correo
     * 
     * @param sting $xml cadena de texto con la ruta del xml que contiene
     * el nombre de usuarios y contraseña del correo
     * @param string $xsd cadena de texto con la ruta del xsd
     * @return array devuelve un array con los datos de
     * @throws InvalidArgumentException
     */
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
