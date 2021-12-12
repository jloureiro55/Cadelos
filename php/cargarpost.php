<?php

require_once(__DIR__ . '/../autoload.php');

use \functions\functions as func;
use \conexion\connectDB as db;

$tool = new func();

$tool->checkSession();

$db = new db($_SESSION['rol']);

$id = $_POST['id'];

$datospost = $db->cargarPost($id);

if($datospost['imagen'] > 0){
    $imagen = './assets/uploads/'.$id.'/1.jpg';
}else{
    $imagen = './assets/img/placeholder.jpg';
}

$creador = $db->cargarCreador($datospost['creador']);



$post = '<div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="'.$imagen.'" alt="..." /></div>
                    <input type="hidden" id="postid" value="'.$id.'">
                    <div class="col-md-6">
                        <h1 class="display-5 fw-bolder">'.$datospost['nombre'].'</h1>
                        <h5 class="fs-5 mb-5">Publicado por: '.$creador['nombre']." ".$creador['apellidos'].'</h5>
                        <div class="fs-5 mb-5">
                            <span >Localidad: '.$datospost['localidad'].'</span><br>
                            <span>Provincia: '.$datospost['provincia'].'</span>
                        </div>
                        <p class="lead">'.$datospost['descripcion'].'</p>
                    </div>
                </div>
            </div>
            <div class="container w-80"><input type="text" class="form-control" placeholder="Escribe un comentario" id="nuevocomentario">
                    <button href="#" id="enviarcomentario">Enviar</button>
                    <p id="resultado"></p>
            </div>
            <div id="comentarios">
            </div>';
            
            echo $post;
            ?>