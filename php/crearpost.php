<?php
    require_once(__DIR__ . './../autoload.php');

    use \functions\functions as func;
    use \conexion\connectDB as db;

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
        $tool->saveImgs($imagenes,$id_post);
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