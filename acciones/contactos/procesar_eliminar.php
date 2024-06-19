<?php 

    session_start();
    include_once('../../clases/Contacto.php');

    if(!isset($_SESSION['idUsuario'])) {
        header('Location: ../../paginas/usuarios/ingresar.php');
        exit();
    }

    if($_POST){

        $idContacto = $_POST['idContacto'];

        $objContacto = new Contacto();
        $eliminar = $objContacto -> eliminarContacto($idContacto);

        if($eliminar === 1){

            $_SESSION['notiEliminarContacto'] = "Contacto eliminado correctamente";
            
            // echo "Contacto eliminado correctamente";

        }
        else {

            $_SESSION['notiEliminarContacto'] = "No se pudo eliminar el contacto";

            // echo "Error al eliminar contacto";

        }

        header('Location: ../../paginas/usuarios/dashboard.php');
        exit();

    }


?>