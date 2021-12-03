<?php 

    namespace conexion;

use Exception;

require_once (__DIR__ . '/../../autoload.php');


    class connectDB {

        private $nameBD;
        private $user;
        private $password;
        private $server;
        private $pdo;
        private $fileXML = __DIR__ . '/../../config/configurationdb.xml';
        private $fileXSD = __DIR__ . '/../../config/configurationdb.xsd';

        //Constructor de la clase.
        function __construct($rol) {

            $data = $this->read_config($this->fileXML, $this->fileXSD, $rol);
    
            $this->nameBD = $data[0];
            $this->server = $data[1];
            $this->user = $data[2];
            $this->password = $data[3];
            //Inicializamos la conexión desde el constructor para poder utilizarla en la app cuando sea necesario.
            $this->pdo = $this->connect();
        }

        //Creamos la conexión
        protected function connect() {
            try {
                $pdo = new \PDO("mysql:host=" . $this->server . ";dbname=" . $this->nameBD . ";charset=utf8", $this->user, $this->password);
                return $pdo;
            } catch (\PDOException $ex) {
                echo $ex->getMessage();
            }
        }

        //Leemos el fichero XML para coger los datos necesarios para crear la conexion
        function read_config($fileXml, $fileXsd, $rol) {

            $conf = new \DOMDocument(); //Instancia un objeto DOMDocument para poder interpretar los ficheros xml
            $conf->load($fileXml); //Carga el documento xml
    
            if (!$conf->schemaValidate($fileXsd)) { //Comprueba si el fichero xsd es válido
                throw new \PDOException("Ficheiro de usuarios no valido");
            }
    
    
            $xml = simplexml_load_file($fileXml); //Interpreta el fichero xml
            //array que obtiene los datos del fichero xml usando rutas xpath para obtener los datos
            $array = [
                "" . $xml->xpath('//dbname')[0],
                "" . $xml->xpath('//ip')[0],
                "" . $xml->xpath('//nombre[../rol="' . $rol . '"]')[0],
                "" . $xml->xpath('//password[../rol="' . $rol . '"]')[0]
            ];
            return $array;
        }

        //Funcion para crear usuarios
        function registerUser($usuario,$nombre,$apellido,$zip,$email,$provincia,$localidad,$telf,$pass){
            try {
                $sql = "insert into usuarios(usuario,nombre,apellidos,telefono,zip,localidad,provincia,tipo,email,pass) values (?,?,?,?,?,?,?,?,?,?)";

                $dbh = $this->pdo;

                if($smtp = $dbh->prepare($sql)){
                    $smtp->bindValue(1, $usuario, \PDO::PARAM_STR);
                    $smtp->bindValue(2, $nombre, \PDO::PARAM_STR);
                    $smtp->bindValue(3, $apellido, \PDO::PARAM_STR);
                    $smtp->bindValue(4, $telf, \PDO::PARAM_INT);
                    $smtp->bindValue(5, $zip, \PDO::PARAM_INT);
                    $smtp->bindValue(6, $localidad, \PDO::PARAM_STR);
                    $smtp->bindValue(7, $provincia, \PDO::PARAM_STR);
                    $smtp->bindValue(8, '2', \PDO::PARAM_STR);
                    $smtp->bindValue(9, $email, \PDO::PARAM_STR);
                    $smtp->bindValue(10, $pass, \PDO::PARAM_STR);
                    if($smtp->execute()){
                        return true;
                    }
                }
            }catch(Exception $ex){
                echo $ex->getMessage();
                return false;
            }
        }

        function createPost($name,$description,$place,$usuario,$provincia,$image=NULL){
            $db = $this->pdo;
            $sql = 'INSERT INTO posts (nombre,descripcion,imagen,creador,localidad,provincia) VALUES (?,?,?,?,?,?)';
            $insert = $db->prepare($sql);
            $insert->bindParam(1,$name);
            $insert->bindParam(2,$description);
            $insert->bindParam(3,$image);
            $insert->bindParam(4,$usuario);
            $insert->bindParam(5,$place);
            $insert->bindParam(6,$provincia);
            if($insert->execute()){
                return true;
            }else{
                return false;
            }
        }

        function loginUser($nameLogin) {
            try {
                $sql = "select usuarios.id as id,usuario, nombre,apellidos, pass,email,telefono,localidad,provincia,zip, tipo, nombre_rol "
                        . "from usuarios "
                        . "inner join roles on usuarios.tipo = roles.id"
                        . " where email = ?";
    
                $db = $this->pdo;
    
                $consult = $db->prepare($sql);
    
                $consult->bindParam(':emailUser', $nameLogin);
    
                $consult->execute();
    
                $result = $consult->fetch(\PDO::FETCH_ASSOC);

                return $result;
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }

        function loadallposts(){
            try{
                $sql = "SELECT * FROM posts";
                $db = $this->pdo;
                $consult = $db->prepare($sql);
                $consult->execute();
                $result = $consult->fetchAll(\PDO::FETCH_ASSOC);
                return $result;
            }catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }

        function getId($email){
            try{
                $sql = "SELECT id FROM usuarios";
                $db = $this->pdo;
                $consult = $db->prepare($sql);
                $consult->execute();
                $result = $consult->fetch(\PDO::FETCH_ASSOC);
                return $result;
            }catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }
    }

    
    

    




?>