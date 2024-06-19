<?php 

    session_start();
    require_once('../../clases/Contacto.php');
    require_once('../../clases/Grupo.php');

    if(!isset($_SESSION['idUsuario'])) {
        header('Location: ../../paginas/usuarios/ingresar.php');
        exit();
    }

    if($_POST){

        $idGrupo = $_POST['idGrupo'];

        $objContacto = new Contacto();
        $grupoFiltrado = $objContacto -> cargarContactoFiltrado($_SESSION['idUsuario'], $idGrupo);

        $objGrupo = new Grupo();
        $infoGrupo = $objGrupo -> cargarGrupo($_SESSION['idUsuario'], $idGrupo);

        if($grupoFiltrado != "Error"){

            $_SESSION['grupoFiltrado'] = $grupoFiltrado;
            $_SESSION['infoGrupo'] = $infoGrupo;
            header('Location: ../../paginas/usuarios/dashboard.php');
            exit();



        }
    }

?>