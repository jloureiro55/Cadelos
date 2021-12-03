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
        $resultado .= '<div class="post card col-4 m-2" id="'.$post['id'].'" style="width: 18rem;">
        <img class="card-img-top" src="" alt="">
        <div class="card-body">
          <h5 class="card-title">'.$post['nombre'].'</h5>
          <p class="card-text">'.$post['provincia'].'</p>
        </div>
        <form action="post.php" method="get"><input type="hidden" name="id" value="'.$post['id'].'"><input type="submit" class="btn btn-primary" value="Visitar"></form>
      </div>';
    };

    echo $resultado;
    ?>