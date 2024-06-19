<?php 

    session_start();
    include_once('../../clases/Grupo.php');


    if(!isset($_SESSION['idUsuario'])){
        header('../../paginas/usuarios/dashboard.php');
        exit();
    }

    if($_POST){

        $idGrupo = $_POST['idGrupo'];
        
        $objGrupo = new Grupo();
        $eliminarGrupo = $objGrupo -> eliminarGrupo($idGrupo);

        if($eliminarGrupo === 1){

            $_SESSION['notiEliminarGrupo'] = "Grupo eliminado correctamente";
            header('Location: ../../paginas/usuarios/dashboard.php');
            exit();

        } else {

            $_SESSION['notiEliminarGrupo'] = "Error al eliminar el grupo";
            header('Location: ../../paginas/usuarios/dashboard.php');
            exit();

        }


    }

?>