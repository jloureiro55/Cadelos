<?php
    require_once(__DIR__ . './../autoload.php');

    use \functions\functions as func;
    use \conexion\connectDB as db;
    use \email\email as email;

    $tool = new func();

    $tool->checkSession();



    $db = new db($_SESSION['rol']);

    $datos = $_POST;

    $postid = $datos['postid'];
    $iduser = $datos['id'];
    $texto = $datos['texto'];

    if($texto !=""){
        if($db->savecomment($postid,$iduser,$texto)){
            $resultado = true;
            $user = json_decode($_SESSION['usuario']);
            $contenido = '
            <div class="d-flex col">
                <h4>'.$user->nombre.'</h4></div>
                <p>'.$texto.'</p>
                </div>';
        $post = $db->cargarPost($postid);
        $creador = $db->cargarCreador($post['creador']);

        $email = new email();
        $email->enviarCorreo($creador['email'],$contenido,"Nuevo comentario en tu post");
        }
    }else{
        $resultado = "Error al añadir el comentario";
    }


    echo $resultado;
    ?>