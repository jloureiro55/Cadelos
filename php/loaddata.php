<?php
    require_once(__DIR__ . './../autoload.php');

    use \functions\functions as func;
    use \conexion\connectDB as db;

    $tool = new func();

    $tool->checkSession();



    $db = new db($_SESSION['rol']);

    $posts = $db->loadallposts();

    $resultado="";
    foreach($posts as $post){
      $numImg = $db->loadFirstImg($post['id']);
      $existe = false;
      $primera = "";
      if($numImg > 0){
        $primera = './assets/uploads/'.$post['id'].'/1.jpg';
      }else{
        $primera = './assets/img/placeholder.jpg';
      }
        $creador = $db->cargarCreador($post['creador']);
        $resultado .= '<div class="post card col-4 m-2" id="'.$post['id'].'" style="width: 18rem;">
        <img class="card-img-top p-md-2" src="'.$primera.'" alt="'.$post['nombre'].'">
        <div class="card-body">
          <h5 class="card-title">'.$post['nombre'].'</h5>
          <p class="card-text">Publicado por: '.$creador['usuario'].'</p>
          <p class="card-text">'.$post['provincia'].'</p>
        </div>
        <form action="post.php" method="get"><input type="hidden" name="id" value="'.$post['id'].'"><input type="submit" class="btn btn-primary" value="Visitar"></form>
      </div>';
    };

    echo $resultado;
    ?>