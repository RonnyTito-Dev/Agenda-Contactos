<?php 

    include_once('Conexion.php');

    class Grupo {

        private $conexionPDO;
        
        public function __construct() {

            $nuevaConexion = new Conexion();
            $this -> conexionPDO = $nuevaConexion -> obtenerConexion();

        }

        public function crearGrupo($idUsuario, $nombreGrupo, $descripcionGrupo, $fotoGrupo){

            $sql = "INSERT INTO grupos (idUsuario, nombreGrupo, descripcionGrupo, fotoGrupo) VALUES (?, ?, ?, ?)";

            try {

                $sqlPreparado = $this -> conexionPDO -> prepare($sql);
                $sqlPreparado -> execute([$idUsuario, $nombreGrupo, $descripcionGrupo, $fotoGrupo]);

                $idGrupo = $this -> conexionPDO -> lastInsertId();

                if(!empty($idGrupo)) {
                    return 1;
                }

            } catch(PDOException $g) {

                echo "Error al crear el contacto <br>" .
                "Mensaje: " . $g -> getMessage() . "<br>" .
                "Linea: " . $g -> getLine();

                return 2;

            }

        }


        public function cargarGrupos($idUsuario){

            $estadoGrupo = 1;
            $estadoContacto = 1;

            $sql = "SELECT g.idGrupo, g.fotoGrupo, g.nombreGrupo, g.descripcionGrupo, COUNT(c.idContacto) AS numeroDeContactos, 
            g.creacionGrupo 
            FROM Grupos g 
            LEFT JOIN Contactos c 
            ON g.idGrupo = c.idGrupo AND c.idEstadoContacto = ? 
            WHERE g.idUsuario = ? AND g.idEstadoGrupo = ? 
            GROUP BY g.idGrupo, g.fotoGrupo, g.nombreGrupo, g.descripcionGrupo, g.creacionGrupo";

            try {

                $sqlPreparado = $this -> conexionPDO -> prepare($sql);
                $sqlPreparado -> execute([$estadoContacto, $idUsuario, $estadoGrupo]);

                $grupos = $sqlPreparado -> fetchAll();
                
                return $grupos;

            } catch (PDOException $e) {
                
                echo "Error al cargar grupos <br>" .
                "Mensaje: " . $e -> getMessage() . "<br>" .
                "Linea: " . $e -> getLine();

                return "error";
            }


        }



        public function cargarGrupo($idUsuario, $idGrupo){

            $idEstadoGrupo = 1;
            $sql = "SELECT * FROM Grupos WHERE idUsuario = ? AND idGrupo = ? AND idEstadoGrupo = ?";

            try {

                $sqlPreparado = $this -> conexionPDO -> prepare($sql);
                $sqlPreparado -> execute([$idUsuario, $idGrupo, $idEstadoGrupo]);

                $infoGrupo = $sqlPreparado -> fetch(PDO::FETCH_ASSOC);
                
                return $infoGrupo;

            } catch (PDOException $e) {
                
                echo "Error al cargar el Grupo <br>" .
                "Mensaje: " . $e -> getMessage() . "<br>" .
                "Linea: " . $e -> getLine();

                return "error";
            }


        }


        public function eliminarGrupo($idGrupo){

            $idEstadoGrupo  = 2;

            $sqlLiberarContactos  = "UPDATE Contactos SET idGrupo = ? WHERE idGrupo = ?";

            $sqlEliminarGrupo = "UPDATE Grupos SET idEstadoGrupo = ? WHERE idGrupo = ?";

            try {

                $sqlPreLiberarContacto = $this -> conexionPDO -> prepare($sqlLiberarContactos);
                $sqlPreLiberarContacto -> execute([NULL, $idGrupo]);

                $sqlPreEliminarGrupo = $this -> conexionPDO -> prepare($sqlEliminarGrupo);
                $sqlPreEliminarGrupo -> execute([$idEstadoGrupo, $idGrupo]);

                return 1;

            } catch(PDOException $eliGrupo){

                echo "Error al eliminar el Grupo <br>" .
                "Mensaje: " . $eliGrupo -> getMessage() . "<br>" .
                "Linea: " . $eliGrupo -> getLine();

                return "error";

            }

        }


        public function editarGrupo($nombreGrupo, $descripcionGrupo, $fotoGrupo, $idGrupo){

            $sql = "UPDATE Grupos SET nombreGrupo = ?, descripcionGrupo = ?, fotoGrupo = ? WHERE idGrupo = ?";

            try {

                $sqlPreparado = $this -> conexionPDO -> prepare($sql);
                $sqlPreparado -> execute([$nombreGrupo, $descripcionGrupo, $fotoGrupo, $idGrupo]);

                return 1;

            } catch (PDOException $ediGrupo) {

                echo "Error al editar el Grupo <br>" .
                "Mensaje: " . $ediGrupo -> getMessage() . "<br>" .
                "Linea: " . $ediGrupo -> getLine();

                return "error";

            }

        }

    }

?>