<?php 

    require_once('../../clases/Usuario.php');
    session_start();

    if($_POST) {

        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $email = trim($_POST['email']);
        $contrasenia = $_POST['contrasenia'];

        if(!empty($nombre) || !empty($apellido) || !empty($email) || !empty($contrasenia)) {

            $nuevoUsuario = new Usuario();
            $registroUsuario = $nuevoUsuario -> registrarUsuario($nombre, $apellido, $email, $contrasenia);

            if($registroUsuario === 0) {

                $_SESSION['notiRegistro'] = "Ocurrio un error al registrarte";
                header('Location: ../../paginas/usuarios/ingresar.php');
                exit();

            }
            else if($registroUsuario === 1) {

                $_SESSION['notiRegistro'] = "Registro exitoso";
                header('Location: ../../paginas/usuarios/ingresar.php');
                exit();
            }

            else if($registroUsuario === 2) {

                $_SESSION['notiRegistro'] = "El email ya existe";
                header('Location: ../../paginas/usuarios/ingresar.php');
                exit();

            }


        } else {

            $_SESSION['notiRegistro'] = "Campos Vacios";
                header('Location: ../../paginas/usuarios/ingresar.php');
                exit();

        }

    }

?>