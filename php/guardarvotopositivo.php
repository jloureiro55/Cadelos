<?php
    require_once(__DIR__ . './../autoload.php');

    use \functions\functions as func;
    use \conexion\connectDB as db;

    $tool = new func();

    $tool->checkSession();



    $db = new db($_SESSION['rol']);

    $datos = $_POST;

    $id = $datos['id'];

    $iduser = $datos['iduser'];

    //if($db->checkvote($id,$iduser)){};