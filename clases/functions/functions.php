<?php

namespace functions;

require_once __DIR__ . '/../../autoload.php';

use \usuario\usuario as usuario;


class functions {


    function phone($numberPhone) {

        if (is_numeric($numberPhone)) {

            $num = trim($numberPhone);

            if (strlen($num) < 9 || strlen($num) > 9) {

                return false;
            } else {
                return true;
            }
        }
    }


    function encryptionPassword($password) {

        $pass = password_hash($password, PASSWORD_DEFAULT);

        return $pass;
    }


    function validatePass($password, $hash) {

        $encryptionPass = password_verify($password, $hash);

        return $encryptionPass;
    }

    
    function validateEmail($email) {

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }


    function saveSessionData($result) {

        session_start();
        $_SESSION['usuario'] = json_encode(Array("id"=>$result['id'],"nombre"=>$result['nombre'],"provincia"=>$result['provincia'],"email"=>$result['email'],"username"=>$result['usuario']));
        $_SESSION['rol'] = $result['nombre_rol'];

        //header("location:../index.php");
    }


    function checkSession() {

        if (session_status() == PHP_SESSION_NONE) { // Comprobamos si NO tenemos una sessión activo
            session_start(); // Iniciamos o recuperamos la información de la sessión actual
            

            if (!isset($_SESSION['rol'])) { // Comprobamos si no existe un ROL asignado
                $_SESSION['rol'] = 'visitante'; // Asignamos el rol por defecto
            }
        }
    }

    function dateDiff($date1, $date2) {
        $date1_ts = strtotime($date1);
        $date2_ts = strtotime($date2);
        $diff = $date2_ts - $date1_ts;
        return round($diff / 86400);
    }

    function checkzip($zip){
        if(strlen($zip) == 5){
            return true;
        }else{
            return false;
        }
    }

    function allfilled($array){
        $filled = true;
        foreach($array as $field){
            if($field == ""){
                $filled = false;
            }
        }
        return $filled;
    }

    function saveImgs($array,$id){
        var_dump($id);
        $nombre = 1;
        $valido = true;
        foreach($array['size'] as $file){
            if($file > 10485760){
                $valido = false;
            }
        }
        if($valido){
        if(!file_exists('../assets/uploads/'.$id)){
            mkdir('../assets/uploads/'.$id,0777,true);
        }
        $uploaded=0;
        foreach($array['tmp_name'] as $file){
                if(move_uploaded_file($file,'../assets/uploads/'.$id."/".$nombre.".jpg")){
                    $nombre++;
                    $uploaded++;
                };
                
            }
        }else{
        }
        return $uploaded;
    }
}
?>

