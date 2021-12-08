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
        /*$resultado .= '<div class="row post card col-12 m-2" id="'.$post['id'].'"">
        <img class="card-img-left p-md-2 col-5" src="'.$primera.'" alt="'.$post['nombre'].'">
        <div class="card-body col-5">
          <h5 class="card-title">'.$post['nombre'].'</h5>
          <p class="card-text">Publicado por: '.$creador['usuario'].'</p>
          <p class="card-text">'.$post['provincia'].'</p>
        
        </div>
      </div>';*/
      $resultado .= '<div class="card mb-3" style="max-width: 90%;" id="'.$post['id'].'"">
      <div class="row g-0">
        <div class="col-md-4">
          <img src="'.$primera.'" class="img-fluid img-responsive rounded-start" alt="'.$post['nombre'].'">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">'.$post['nombre'].'</h5>
            <p class="card-text">Publicado por: '.$creador['usuario'].'</p>
            <p class="card-text">'.$post['provincia'].'</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            <form action="post.php" method="get"><input type="hidden" name="id" value="'.$post['id'].'"><input type="submit" class="btn btn-primary" value="Visitar"></form>
          </div>
        </div>
      </div>
    </div>';
    };
    
    echo $resultado;
    ?>