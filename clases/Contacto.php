<?php 

    require_once('Conexion.php');

    class Contacto {

        private string $nombres;
        private string $apellidos;
        private string $numeroCelular;
        private string $email;
        private string $direccion;
        private string $nombreFoto;

        private $conexionPDO;

        //Metodo constructor
        public function __construct() {
            $nuevaConexion = new Conexion();
            $this -> conexionPDO = $nuevaConexion -> obtenerConexion();
        }

        //MetodoCrear Contacto
        public function crearContacto($idUsuario, $idGrupo, string $nombreContacto, string $apellidoContacto, string $numeroCelular, string $emailContacto, string $direccionContacto, string $nombreFoto, $creacionContacto){

            $this -> nombres = $nombreContacto;
            $this -> apellidos = $apellidoContacto;
            $this -> numeroCelular = $numeroCelular;
            $this -> email = $emailContacto;
            $this -> direccion = $direccionContacto;
            $this -> nombreFoto = $nombreFoto;


            $sql = "INSERT INTO contactos (idUsuario, idGrupo, nombreContacto, apellidoContacto, numeroCelular, emailContacto, direccionContacto, fotoContacto, creacionContacto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            try {

                $sqlPreparado = $this -> conexionPDO -> prepare($sql);
                $sqlPreparado -> execute([$idUsuario, $idGrupo, $this -> nombres, $this -> apellidos, $this -> numeroCelular, $this -> email, $this -> direccion, $this -> nombreFoto, $creacionContacto]);

                $idContacto = $this -> conexionPDO -> lastInsertId();

                if(!empty($idContacto)) {
                    return 1;
                }


            } catch (PDOException $c) {

                echo "Error al crear el contacto <br>" .
                     "Mensaje: " . $c -> getMessage() . "<br>" .
                     "Linea: " . $c -> getLine();

                return 2;
            }

        }

        public function cargarContactos($id){

            $estadoContacto = 1;
            $sqlCargar = "SELECT * FROM contactos WHERE idUsuario = ? AND idEstadoContacto = ?";
            

            try {
                $sqlCargarPreparado = $this -> conexionPDO -> prepare($sqlCargar);
                $sqlCargarPreparado -> execute([$id, $estadoContacto]);

                $contactos = $sqlCargarPreparado -> fetchAll();

                return $contactos;

            } catch(PDOException $cargar) {

                echo "Error al crear el contacto <br>" .
                "Mensaje: " . $cargar -> getMessage() . "<br>" .
                "Linea: " . $cargar -> getLine();

                return "Error al consultar datos";

            }

        }


        public function eliminarContacto($idContacto){

            $estadoContacto = 2;

            $sql = "UPDATE Contactos SET idEstadoContacto = ? WHERE idContacto = ?";

            try {
                $sqlPreparado = $this -> conexionPDO -> prepare($sql);
                $sqlPreparado -> execute([$estadoContacto, $idContacto]);

                return 1;

            } catch(PDOException $delete) {

                echo "Error al eliminar el contacto <br>" .
                "Mensaje: " . $delete -> getMessage() . "<br>" .
                "Linea: " . $delete -> getLine();

                return 2;

            }

        }


        public function contarContactos($idUsuario) {
            $estadoContacto = 1;
            $sql = "SELECT COUNT(*) FROM Contactos WHERE idUsuario = ? AND idEstadoContacto = ?";

            try{

                $sqlPreparado = $this -> conexionPDO -> prepare($sql);
                $sqlPreparado -> execute([$idUsuario, $estadoContacto]);

                $totalContactos = $sqlPreparado -> fetchColumn(0);

                return $totalContactos;

            } catch(PDOException $contar){
                echo "Error al contar los Contactos <br>" .
                "Mensaje: " . $contar -> getMessage() . "<br>" .
                "Linea: " . $contar -> getLine();

                return "Error";

            }
        }

        public function cargarContactoFiltrado($idUsuario, $idGrupo){

            $idEstadoContacto = 1;

            try {

                if($idGrupo == 0){
                    $sql = "SELECT * FROM Contactos WHERE idUsuario = ? AND idEstadoContacto = ? AND idGrupo IS NULL";
                    $sqlPreparado = $this -> conexionPDO -> prepare($sql);
                    $sqlPreparado -> execute([$idUsuario, $idEstadoContacto]);

                }
                else {
                    $sql = "SELECT * FROM Contactos WHERE idUsuario = ? AND idEstadoContacto = ? AND idGrupo = ?";
                    $sqlPreparado = $this -> conexionPDO -> prepare($sql);
                    $sqlPreparado -> execute([$idUsuario, $idEstadoContacto, $idGrupo]);
                }

                $contactosGrupo = $sqlPreparado -> fetchAll(PDO::FETCH_ASSOC);
                return $contactosGrupo;

            } catch(PDOException $ex){

                echo "Error al cargar contacto del Grupo <br>" .
                "Mensaje: " . $ex -> getMessage() . "<br>" .
                "Linea: " . $ex -> getLine();

                return "Error";

            }

        }


        public function solicitarUnContacto($idContacto){

            $sql = "SELECT * FROM Contactos WHERE idContacto = ?";

            try {

                $sqlPreparado = $this -> conexionPDO -> prepare($sql);
                $sqlPreparado -> execute([$idContacto]);

                $infoContacto = $sqlPreparado -> fetch();

                return $infoContacto;

            } catch(PDOException $pedir){

                echo "Error al cargar contacto del Grupo <br>" .
                "Mensaje: " . $pedir -> getMessage() . "<br>" .
                "Linea: " . $pedir -> getLine();

                return "Error";

            }

        }        


        public function actualizarContacto($idGrupo, $nombreContacto, $apellidoContacto, $numeroCelular, $emailContacto, $direccionContacto, $fotoContacto, $idContacto){


            $sql = "UPDATE Contactos SET idGrupo = ?, nombreContacto = ?, apellidoContacto = ?, numeroCelular = ?, emailContacto = ?, direccionContacto = ?, fotoContacto = ? WHERE idContacto = ?";

            try{

                $sqlPreparado = $this -> conexionPDO -> prepare($sql);
                $sqlPreparado -> execute([$idGrupo, $nombreContacto, $apellidoContacto, $numeroCelular, $emailContacto, $direccionContacto, $fotoContacto, $idContacto]);

                return 1;


            } catch(PDOException $update){

                echo "Error al cargar contacto del Grupo <br>" .
                "Mensaje: " . $update -> getMessage() . "<br>" .
                "Linea: " . $update -> getLine();

                return "Error";


            }

        }

    }

?>