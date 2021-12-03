<?php 

namespace usuario;

class usuario {

            private $id;
            private $nombre;
            private $usuario;
            private $apellidos;
            private $localidad;
            private $provincia;
            private $telefono;
            private $tipo;
            private $postal;
            private $email;

            public function __construct($nombre,$usuario,$id,$apellidos,$localidad,$provincia,$telefono,$tipo,$postal,$email){
                    $this->nombre = $nombre;
                    $this->usuario =$usuario;
                    $this->apellidos = $apellidos;
                    $this->id = $id;
                    $this->localidad = $localidad;
                    $this->provincia = $provincia;
                    $this->telefono = $telefono;
                    $this->tipo = $tipo;
                    $this->postal = $postal;
                    $this->email = $email;
            }

            public function __get($var) {
                if(property_exists($this, $var)){
                    return $this->$var;
                }
              
            }
            
            public function __set($var, $value) {
                $this->$var = $value;
                
            }
}





?>