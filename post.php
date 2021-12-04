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
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Página del Post</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="/estilos/style.css">
    </head>
    <body>
        <?php echo '<input type="hidden" id="id-post" value="'.$_GET['id'].'">' ?>
        <?php require_once('header.php'); ?>
        <section class="py-5" id="post-content">
            
        </section>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"
    integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="./js/functions.js"></script>
        <script>
        $(document).ready(function(){
            var id = $('#id-post').val();
            console.log(id);
            $.ajax({
                type: 'POST',
                data: {id : id},
                url: "./php/cargarpost.php",
                success: function(data){
                    $('#post-content').html(data);
            }
        })});
    </script>
    </body>
</html>
