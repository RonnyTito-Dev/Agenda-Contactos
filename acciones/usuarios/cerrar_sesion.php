<?php 

    require_once('../../clases/Usuario.php');
    session_start();

    if(!isset($_SESSION['idUsuario'])){
        header('Location: ../../paginas/usuarios/ingresar.php');
        exit();
    }
    

    if (isset($_SESSION['ultimoInicioSesion'])) {

        $nuevoUsuario = new Usuario();
        $cerrarSesion = $nuevoUsuario -> cerrarSesion($_SESSION['idUsuario'], $_SESSION['ultimoInicioSesion']);

        if($cerrarSesion) {

            session_unset();
            session_destroy();
            header('Location: ../../paginas/usuarios/ingresar.php');
            exit();

        }
        else {
    
            echo "No se puede cerrar su sesion en este momento";

        }

    }
    
?>