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
    <title>Inicio</title>
</head>
<body class="container">
        <?php 
            require_once('header.php');
        ?>
        <div id="cartas" class="flex row"></div>
</body>
    <script src="https://code.jquery.com/jquery-3.5.1.js"
    integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy"
    crossorigin="anonymous"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $.ajax({
                url: "php/loaddata.php",
                success: function(data){
                    $('#cartas').html(data);
            }
        })});
    </script>
    <script src="./js/functions.js"></script>
</html>