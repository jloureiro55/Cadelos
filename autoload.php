<?php
/*
 * Función autoload que recibe una clase
 * Busca desde el directorio raiz la carpeta clases y reemplaza las barras dobles para obtener el nombre de la clase,
 * de siguiente se concatena el tipo de fichero, en este caso es php.
 * Se comprueba que el fichero tiene un nombre, y si existe, incluye el fichero.
 */
spl_autoload_register(function($nombre_clase) {

    $file = __DIR__ . DIRECTORY_SEPARATOR . 'clases' . DIRECTORY_SEPARATOR. str_replace('\\', DIRECTORY_SEPARATOR, $nombre_clase) . ".php";

    if ($file != "") {

        if (file_exists($file)) {
           //echo $file;
            include $file;
        }
    }
});