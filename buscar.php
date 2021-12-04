<?php
    require_once(__DIR__ . '/autoload.php');

    use \functions\functions as func;
    use \conexion\connectDB as db;

    $tool = new func();

    $tool->checkSession();

    if($_SESSION['rol'] == 'visitante'){
        header('location:session.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca tu animal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/estilos/style.css">
</head>
<body class="container">
    <?php require_once('header.php'); ?>
    <h1>¿Quieres encontrar a tu mascota?</h1>
    <p>¡Este es tu lugar! En WhereIsMyPet somos una comunidad amable que se dedica a ofrecer información y a reencontrar a dueños y mascotas perdidas.</p>
    <form class="form-post" id="buscarpost" type="POST" enctype="multipart/form-data">
        <div class="inputs">
        <label>Nombre: </label><input type="text" class="form-control" name="name" placeholder="Nombre de tu mascota" value="">
        <label>Localidad: </label><input type="text" class="form-control" name="place" placeholder="Donde se perdió" value="">
        <label>Codigo Postal: </label> <input type="text" class="form-control" name="zip" placeholder="Codigo Postal" value="">
        <label>Imágenes: </label><input type="file" name="file[]" placeholder="Subir Imagen" multiple value="">
        <label>Descripción: </label> <input type="textarea" class="form-control" name="description" placeholder="Describe lo que ha pasado..." value="">
        <label>Provincia: </label><?php require_once("provincias.html");?>
        </div>  
    </form>
    <button name="enviar" id="publicar" class="btn btn-primary btn-form" >Publicar</button>
    <div id="resultadocreacion">

    </div>
</body>
    <script src="https://code.jquery.com/jquery-3.5.1.js"
    integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy"
    crossorigin="anonymous"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./js/functions.js"></script>
</html>