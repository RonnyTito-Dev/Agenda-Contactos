<?php 

    session_start();
    date_default_timezone_set('America/Lima');

    include_once('../../clases/Grupo.php');

    if(!isset($_SESSION['idUsuario'])){
        header('Location: ../../paginas/usuarios/dashboard.php');
        exit();
    }

    



    if($_POST){

        $idGrupo = $_POST['idGrupo'];
        $nombreGrupo = trim($_POST['nombreGrupo']);
        $descripcionGrupo = trim($_POST['descripcionGrupo']);

        if(!empty($nombreGrupo)) {

            $objGrupo = new Grupo();
            $infoGrupo = $objGrupo -> cargarGrupo($_SESSION['idUsuario'], $idGrupo);

            if($infoGrupo['nombreGrupo'] === $nombreGrupo && $infoGrupo['descripcionGrupo'] === $descripcionGrupo && empty($_FILES['foto']['name'])){

                // echo "no puedes editar sin hacer modificaciones";
                $_SESSION['notiEditarGrupo'] = "No hay cambios";
                header('Location: ../../paginas/usuarios/dashboard.php');
                exit();

            }

            //Se Procede a editar
            if(!empty($_FILES['foto']['name'])){

                //si hubo subida de foto

                $esFoto = exif_imagetype($_FILES['foto']['tmp_name']);

                if($esFoto === IMAGETYPE_JPEG || $esFoto === IMAGETYPE_PNG){

                    //Carpeta
                    $carpeta = "../../Usuarios/" . $_SESSION['idUsuario'] . "/";

                    //Nombre de foto
                    $nombreFoto = "grupo(" . date('H.i.s__d-m-Y') . ")-" . $_FILES['foto']['name'];

                    //Ruta de Almacenamiento
                    $rutaDestino = $carpeta . $nombreFoto;

                    //Existe Directorio para guardar?
                    if(!is_dir($carpeta)) {
                        //Crear carpeta
                        mkdir($carpeta, 0777, true);
                    }

                    //Mover la Foto
                    $moverFoto = move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino);

                    if($moverFoto === false){
    
                        $_SESSION['notiEditarGrupo'] = "Error al cargar la foto";
                        header('Location: ../../paginas/usuarios/dashboard.php');
                        exit();
    
                    }

                } else {

                    // la imagen no es png ni jpg
                    $_SESSION['notiEditarGrupo'] = "La foto subida no es JPG o PNG";
                    header('Location: ../../paginas/usuarios/dashboard.php');
                    exit();
                    

                }

            } else {

                //no hubo subida de foto
                $nombreFoto = "";
            }


            $editarGrupo = $objGrupo -> editarGrupo($nombreGrupo, $descripcionGrupo, $nombreFoto, $idGrupo);

            if($editarGrupo === 1) {

                // grupo editado correctamente
                $_SESSION['notiEditarGrupo'] = "Grupo actualizado correctamente";
                header('Location: ../../paginas/usuarios/dashboard.php');
                exit();

            } else {

                // error al editar el grupo
                $_SESSION['notiEditarGrupo'] = "Ocurrio un error al actualizar el grupo";
                header('Location: ../../paginas/usuarios/dashboard.php');
                exit();
            }


        } else {

            $_SESSION['notiEditarGrupo'] = "El nombre del grupo es obligatorio";
            header('Location: ../../paginas/usuarios/dashboard.php');
            exit();

        }

    }

?>