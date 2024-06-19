<?php 

    require_once('Conexion.php');

    class Usuario {

        private string $nombres;
        private string $apellidos;
        private string $email;
        private string $contrasenia;

        private $conexionPDO;


        //Metodo Constructor
        public function __construct() {

            $nuevaConexion = new Conexion();
            $this -> conexionPDO = $nuevaConexion -> obtenerConexion();

        }


        // Metodo Registrar Usuario
        public function registrarUsuario(string $nombres, string $apellidos, string $email, string $contrasenia) {

            $this -> nombres = $nombres;
            $this -> apellidos = $apellidos;
            $this -> email = $email;
            $this -> contrasenia = password_hash($contrasenia, PASSWORD_BCRYPT);

            //Proceso de Registro

            try {

                $sqlVe = "SELECT COUNT(*) FROM Usuarios WHERE emailUsuario = ?";
                $sqlVePrepado = $this -> conexionPDO -> prepare($sqlVe);
                $sqlVePrepado -> execute([$this -> email]);

                $usuarios = $sqlVePrepado -> fetchColumn();

                if(empty($usuarios)) {

                    $sqlRe = "INSERT INTO Usuarios (nombresUsuario, apellidosUsuario, emailUsuario, contraseniaUsuario) VALUES (? , ?, ? ,?)";

                    $sqlRePrepado = $this -> conexionPDO -> prepare($sqlRe);
                    $sqlRePrepado -> execute([$this -> nombres, $this -> apellidos, $this -> email, $this -> contrasenia]);

                    $idUsuario = $this -> conexionPDO -> lastInsertId();

                    $carpetaUsuario = "../../Usuarios/{$idUsuario}";
                    mkdir($carpetaUsuario, 0777, true);

                    return 1;

                }
                else {

                    return 2;
                }

            } catch (PDOException $r) {

                echo "Error en el Proceso de Registro <br>" .
                     "Mensaje: " . $r -> getMessage() . "<br>" .
                     "Linea: " . $r -> getLine() . "<br>"; 

                return 0;

            }

        }



        // Metodo Iniciar Sesion
        public function iniciarSesion(string $email, string $contrasenia) {

            $this -> email = $email;
            $this -> contrasenia = $contrasenia;

            try{

                $sqlVe = "SELECT * FROM Usuarios WHERE emailUsuario = ?";
                $sqlVePrepado = $this -> conexionPDO -> prepare($sqlVe);
                $sqlVePrepado -> execute([$this -> email]);

                $datosUsuario = $sqlVePrepado -> fetch(PDO::FETCH_ASSOC);

                if(!empty($datosUsuario)) {

                    if( $this -> email === $datosUsuario['emailUsuario'] && password_verify($this -> contrasenia, $datosUsuario['contraseniaUsuario'])) {

                        // Credenciales Validas
                        return $datosUsuario;

                    } else {

                        return "credenciales invalidas";

                    }

                } else {

                    return "no existe email";

                }

            } catch (PDOException $l) {

                echo "Error en el Proceso iniciar Sesión <br>" .
                "Mensaje: " . $l -> getMessage() . "<br>" .
                "Linea: " . $l -> getLine() . "<br>"; 

            }


        }



        //Metodo Actualizar ultimoLogin
        public function ultimoInicioSesion($idUsuario, $ultimoInicioSesion){

            $sqlLo = "UPDATE Usuarios SET ultimoInicioSesion = ? WHERE idUsuario = ?";

            try {

                $sqlLoPreparado = $this -> conexionPDO -> prepare($sqlLo);
                $sqlLoPreparado -> execute([$ultimoInicioSesion, $idUsuario]);

                return true;

            } catch(PDOException $lo) {

                echo "No se pudo Actulizar el ultimo login <br>" .
                "Mensaje: " . $lo -> getMessage() . "<br>" .
                "Linea: " . $lo -> getLine() . "<br>";
                
                return false;

            }
            

        }


        //Metodo Cerrar Sesion
        public function cerrarSesion($idUsuario, $ultimoLogin) {

            date_default_timezone_set('America/Lima');
            $cerraSesion = date('Y-m-d H:i:s');

            $ultimoInicioSesion = new DateTime($ultimoLogin);
            $ultimoCerrarSesion = new DateTime($cerraSesion);
            $diferencia = $ultimoInicioSesion -> diff($ultimoCerrarSesion);

            $duracionUltimaSesion = "{$diferencia -> format('%h')} hrs  {$diferencia -> format('%i')} min {$diferencia -> format('%s')} seg";


            $sqlCe = "UPDATE Usuarios SET ultimoCierreSesion = ?, duracionUltimaSesion = ? WHERE idUsuario = ?";

            try {

                $sqlCePreparado = $this -> conexionPDO -> prepare($sqlCe);
                $sqlCePreparado -> execute([$cerraSesion, $duracionUltimaSesion, $idUsuario]);

                return true;

            } catch(PDOException $ce) {

                echo "Error al cerrar sesion <br>" .
                "Mensaje: " . $ce -> getMessage() . "<br>" .
                "Linea: " . $ce -> getLine() . "<br>";

                return false;

            }

        }

    }

?>