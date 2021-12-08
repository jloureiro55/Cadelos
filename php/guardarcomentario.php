<?php
    require_once(__DIR__ . './../autoload.php');

    use \functions\functions as func;
    use \conexion\connectDB as db;

    $tool = new func();

    $tool->checkSession();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require_once "../vendor/autoload.php";



    $db = new db($_SESSION['rol']);

    $datos = $_POST;

    $postid = $datos['postid'];
    $iduser = $datos['id'];
    $texto = $datos['texto'];

    $resultado = var_dump($datos);

    if($texto !=""){
        if($db->savecomment($postid,$iduser,$texto)){
            $resultado = "Comentario añadido con éxito";
        }
    }else{
        $resultado = "Error al añadir el comentario";
    }


    echo $resultado;
    ?>