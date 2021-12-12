<?php
    require_once(__DIR__ . './../autoload.php');

    use \functions\functions as func;
    use \conexion\connectDB as db;
    use \email\email as email;

    $tool = new func();

    $tool->checkSession();



    $db = new db($_SESSION['rol']);

    $datos = $_POST;

    $name = $datos['name'];
    $place = $datos['place'];
    $zip = $datos['zip'];
    $description = $datos['description'];
    $provincia = $datos['provincia'];
    
    $imagenes = $_FILES['file'];
    $imagen = sizeof($imagenes['name']);

    

    $fields="";
    if($name ==""){
        $fields = "Nombre";
    }

    if($place ==""){
        if($fields !=""){
            $fields .= ", Localidad";
        }else{
            $fields = "Localidad";
        }
    }

    if($zip =="" && !($tool->checkzip($zip))){
        if($fields !=""){
            $fields .= ", Código Postal";
        }else{
            $fields = "Código Postal";
        }
    }

    if($description ==""){
        if($fields !=""){
            $fields .= ", Descripción";
        }else{
            $fields = "Descripción";
        }
    }

    if($provincia ==""){
        if($fields !=""){
            $fields .= ", Provincia";
        }else{
            $fields = "Provincia";
        }
    }

    

    if($_SESSION != 'visitante'){
    if($fields == ""){
        $user = json_decode($_SESSION['usuario']);
        $usuario = $user->id;
      if($db->createPost($name,$description,$place,$usuario,$provincia,$imagen)){
          $id_post = $db->getLastPostId();
          $datos_user = $db->cargarCreador($usuario);
        $tool->saveImgs($imagenes,$id_post);
        $contenido = '<div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="http://a19.daw2d.iesteis.gal/assets/uploads/'.$id_post.'/1.jpg" alt="..." width="200px" height="200px"/></div>
                    <div class="col-md-6">
                        <h1 class="display-5 fw-bolder">'.$name.'</h1>
                        <h5 class="fs-5 mb-5">Publicado por: '.$datos_user['nombre']." ".$datos_user['apellidos'].'</h5>
                        <div class="fs-5 mb-5">
                            <span >Localidad: '.$place.'</span><br>
                            <span>Provincia: '.$provincia.'</span>
                        </div>
                        <p class="lead">'.$description.'</p>
                    </div>
                </div>
            </div>
            <a href="http://a19.daw2d.iesteis.gal/post.php?id='.$id_post.'" style="text-decoration:none;
            width: 200px; padding: 15px; box-shadow: 6px 6px 5px; 
            font-weight: MEDIUM; background: #3ebfac; color: #000000; 
            cursor: pointer; border-radius: 10px; border: 1px solid #D9D9D9; 
            font-size: 110%;">Visita el post pulsando aqui</a>
            </div>';
        
        $email = new email();
        $email->enviarCorreo($user->email,$contenido,"Nuevo post creado con exito");
        $resultado = "Post creado con éxito";
        
      }else{
        $resultado = "Error a la hora de crear el post, intentelo mas tarde.";
      }

        

        
    }else{
        $resultado = "Error a la hora de crear el post, faltan los siguientes campos ".$fields.".";
    }
}else{
    $resultado = "Registrate para poder crear un post";
}


echo $resultado;

?>