<?php
    require_once(__DIR__ . './../autoload.php');

    use \functions\functions as func;
    use \conexion\connectDB as db;

    $tool = new func();


    $db = new db('visitante');

    $credenciales = $_POST;
    
    $result = $db->loginUser($credenciales['user']);
    if (is_array($result) && isset($result['pass'])) {

        $hash = $result['pass'];
        if (password_verify($credenciales['pass'], $hash)) {
            $tool->saveSessionData($result);
            $devolver=true;
        }else{
            $devolver = "La contraseña no es correcta";
        }
    }else{
        $devolver = "El usuario no existe";
    }

    echo $devolver;
    ?>