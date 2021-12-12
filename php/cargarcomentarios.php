<?php
    require_once(__DIR__ . './../autoload.php');

    use \functions\functions as func;
    use \conexion\connectDB as db;

    $tool = new func();

    $tool->checkSession();



    $db = new db($_SESSION['rol']);

    $datos = $_POST;

    $post = $datos['postid'];

    $comments = $db->loadcomments($post);
    $resultado= "";
    if(is_array($comments)){
        foreach($comments as $comment){
            $resultado .= '<div class="comment mt-4 text-justify container" id="'.$comment['id'].'"> <div class="d-flex col"><img src="https://i.imgur.com/yTFUilP.jpg" alt="" class="rounded-circle img-fluid" width="40" height="40">
                <h4>'.$comment['usuario'].'</h4></div> <span>'.$comment['fecha'].'</span>
                <p>'.$comment['comentario'].'</p>
                <p id="votos"> <button class="positivo" id="'.$comment['id'].'">Positivos:'.$comment['positivos'].'</button></p>
            </div>';
        }
    }else{
        $resultado = "No hay comentarios.";
    }

    echo $resultado;
    ?>