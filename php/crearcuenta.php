<?php
    require_once(__DIR__ . './../autoload.php');

    use \functions\functions as func;
    use \conexion\connectDB as db;
    use \email\email as email;

    $tool = new func();




    $db = new db('visitante');

    $datos = $_POST;
    $phone = $datos['telf'];
    $username = $datos['username'];
    $name= $datos['name'];
    $surname = $datos['surname'];
    $email = $datos['email'];
    $place = $datos['place'];
    $zip = $datos['zip'];
    $pass = $datos['pass'];
    $repass = $datos['repass'];
    $provincia = $datos['provincia'];
    $passcryp = $tool->encryptionPassword($pass);
    if($tool->allfilled($datos)){
        if($tool->phone($phone) && $tool->validateEmail($email) && $pass == $repass){
            if($db->registerUser($username,$name,$surname,$zip,$email,$provincia,$place,$phone,$passcryp)){
                $result = $db->loginUser($email);
                $tool->saveSessionData($result);
                $contenido = '<h1>Bienvenido a WhereIsMyPet '.$name.' '.$surname.'!</h1>
                <p>Esto es solo un correo de confirmación!</p>';
        
        $correo = new email();
        $correo->enviarCorreo($email,$contenido,"Cuenta creada con exito");
                $resultado=true;
            }else{
                $resultado = 'Error al crear la cuenta comprueba que los datos sean válidos';
            }
        }
    }else{
        $resultado = "Faltan campos por rellenar";
    }

    echo $resultado;

    ?>