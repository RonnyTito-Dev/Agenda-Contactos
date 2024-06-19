<?php 
    require_once('../../clases/Usuario.php');

    session_start();

    if($_POST) {

        $email = trim($_POST['email']);
        $contrasenia = $_POST['password'];

        if(!empty($email) || !empty($contrasenia)) {

            $nuevoUsuario = new Usuario();
            $datosUsuario = $nuevoUsuario -> iniciarSesion($email, $contrasenia);

            if(is_array($datosUsuario)){

                date_default_timezone_set('America/Lima');
                $ultimoInicioSesion = date('Y-m-d H:i:s');

                $actualizarLogin = $nuevoUsuario -> ultimoInicioSesion($datosUsuario['idUsuario'], $ultimoInicioSesion);

                if($actualizarLogin) {

                    $_SESSION['idUsuario'] = $datosUsuario['idUsuario'];
                    $_SESSION['nombresUsuario'] = $datosUsuario['nombresUsuario'];
                    $_SESSION['apellidosUsuario'] = $datosUsuario['apellidosUsuario'];
                    $_SESSION['emailUsuario'] = $datosUsuario['emailUsuario'];
                    $_SESSION['ultimoInicioSesion'] = $ultimoInicioSesion;

                    $_SESSION['notiLogin'] = "Acceso autorizado";

                    //redirigir a dasboard
                    header('Location: ../../paginas/usuarios/dashboard.php');
                    exit();

                } else {

                    echo "Fallo un proceso de login, vuelve a intentarlo";
                }

            }
            else if($datosUsuario === "credenciales invalidas"){

                //rediricionar a login
                $_SESSION['notiLogin'] = "credenciales invalidas";
                header('Location: ../../paginas/usuarios/ingresar.php');
                exit();
                
            }

            else if($datosUsuario === "no existe email") {

                //rediricionar a login

                $_SESSION['notiLogin'] = "no existe email";

                header('Location: ../../paginas/usuarios/ingresar.php');
                exit();

            }

        } 

        else {

            //rediricionar a login
            $_SESSION['notiLogin'] = "Campos vacios";
            header('../../paginas/usuarios/ingresar.php');
            exit();

        }

    }

?>