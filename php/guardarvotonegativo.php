<?php
    require_once(__DIR__ . './../autoload.php');

    use \functions\functions as func;
    use \conexion\connectDB as db;

    $tool = new func();

    $tool->checkSession();



    $db = new db($_SESSION['rol']);

    $datos = $_POST;

    echo var_dump($datos);

    $id = $datos['id'];

    $iduser = $datos['iduser'];