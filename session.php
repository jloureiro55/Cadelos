<?php
    require_once(__DIR__ . '/autoload.php');

    use \functions\functions as func;
    use \conexion\connectDB as db;

    $tool = new func();

    $tool->checkSession();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/estilos/style.css">
    <title>Login</title>
</head>
<?php require_once('header.php'); ?>
<body class="container">
    <div>
    <div>
    <form class="form-login"  method="post" >
            <div class="login">
                <label for="user" class="label">Email</label> <input name="user" id="user" type="text" class="input" placeholder="Introduce tu correo">
                <label for="pass" class="label">Password</label> <input name="pass" id="pass" type="password" class="input" data-type="password" placeholder="Introduce tu contraseña">
            </div>
    </form>
            <div id="resultado-login"></div>
            <div class="group"> <button  class="btn btn-primary" id="login" name="login"> Iniciar Sesión</button> </div>
            <div class="hr"></div>
    </div>
    <div>
        <form class="form-register"  method="post" >
        
                <div class="group"> <label for="user" class="label">Nombre de usuario</label> <input id="user" type="text" class="input" placeholder="Nombre de usuario" name="username"> </div>
                <div class="group"> <label for="user" class="label">Nombre</label> <input id="user" type="text" class="input" placeholder="Nombre" name="name"> </div>
                <div class="group"> <label for="user" class="label">Apellidos</label> <input id="user" type="text" class="input" placeholder="Apellidos" name="surname"> </div>
                <div class="group"> <label for="pass" class="label">Correo Electronico</label> <input id="pass" type="text" class="input" placeholder="Introduce tu correo electrónico" name="email"> </div>
                <div class="group"> <label for="user" class="label">Localidad</label> <input id="user" type="text" class="input" placeholder="Localidad" name="place"> </div>
                <div class="group"> <label for="user" class="label">Codigo Postal</label> <input id="user" type="text" class="input" placeholder="Codigo Postal" name="zip"> </div>
                <div class="group"> <label for="user" class="label">Teléfono</label> <input id="user" type="text" class="input" placeholder="Número de teléfono" name="telf"> </div>
                <div class="group"> <label for="pass" class="label">Contraseña</label> <input name="pass" id="pass" type="password" class="input" data-type="password" placeholder="Introduce la contraseña"></div>
                <div class="group"> <label for="pass" class="label">Contraseña</label> <input name="repass" id="pass" type="password" class="input" data-type="password" placeholder="Repite la contraseña"></div>
                <div class="group"><?php require_once("provincias.html");?></div>

            </div>
        </form>
        <div id="resultado-register"></div>
        <div class="group"> <button class="btn btn-primary" id="register" name="register"> Registrarse </button></div>
    </div>
    </div>
    
</body>
    <script src="https://code.jquery.com/jquery-3.5.1.js"
    integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy"
    crossorigin="anonymous"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="./js/functions.js"></script>
</html>