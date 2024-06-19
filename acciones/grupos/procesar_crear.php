<?php 

    session_start();
    include_once('../../clases/Grupo.php');

    date_default_timezone_set('America/Lima');

    if(!isset($_SESSION['idUsuario'])) {
        header('Location: ../../paginas/usuarios/ingresar.php');
        exit();

    }

    if($_POST) {

        $nombreGrupo = trim($_POST['nombreGrupo']);
        $descripcionGrupo = empty($_POST['descripcionGrupo']) ? '': trim($_POST['descripcionGrupo']);

        if(!empty($nombreGrupo)) {


            if(!empty($_FILES['foto']['name'])){

                $esImagen = exif_imagetype($_FILES['foto']['tmp_name']);

                if($esImagen === 2 || $esImagen === 3){

                    $carpeta = "../../Usuarios/" . $_SESSION['idUsuario'] . "/";

                    $nombreFoto = "grupo(" . date("H.i.s__d-m-Y") . ")-" . $_FILES['foto']['name'];

                    $rutaDestino = $carpeta . $nombreFoto;

                    if(!is_dir($carpeta)){
                        mkdir($carpeta, 0777, true);
                    }

                    $moverFoto = move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino);

                    if($moverFoto === false){

                        // Notificacion paso un error al subir la foto
                        $_SESSION['notiCrearGrupo'] = "No se pudo cargar la foto";
                        header('Location: ../../paginas/usuarios/dashboard.php');
                        exit();
                        // echo "No se pudo cargar la foto <br>";
                    }

                }

                else {
                    //notificacion no es imagen
                    $_SESSION['notiCrearGrupo'] = "No es una imagen";
                    header('Location: ../../paginas/usuarios/dashboard.php');
                    exit();

                    // echo "La foto no es una imagen <br>";
                }

            }

            else {
                //Nunca se subio una foto
                $nombreFoto = "";

            }

            $objConexion = new Grupo();
            $crearGrupo = $objConexion -> crearGrupo($_SESSION['idUsuario'], $nombreGrupo, $descripcionGrupo, $nombreFoto);

            if($crearGrupo === 1) {
                // echo "Grupo creado exitosamente";
                $_SESSION['notiCrearGrupo'] = "Grupo creado exitosamente";
                header('Location: ../../paginas/usuarios/dashboard.php');
                exit();

            }
            else if($crearGrupo === 2) {
                // echo "Error al crear grupo";
                $_SESSION['notiCrearGrupo'] = "Error al crear el grupo";
                header('Location: ../../paginas/usuarios/dashboard.php');
                exit();

            }

        }
        else {
            // echo "todos los campos son obligatorios";
            $_SESSION['notifiCrearGrupo'] = "Todos los campos son obligatorios";
            header('Location: ../../paginas/usuarios/dashboard.php');
            exit();
        }

    }


?>