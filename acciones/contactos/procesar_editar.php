<?php 
    
    session_start();
    date_default_timezone_set('America/Lima');
    include_once('../../clases/Contacto.php');

    if(!isset($_SESSION['idUsuario'])) {

        header('Location: ../../paginas/usuarios/ingresar.php');
        exit();

    }

    if($_POST){

        $idContacto = trim($_POST['idContacto']);
        $nombres = trim($_POST['nombres']);
        $apellidos = trim($_POST['apellidos']);
        $numeroCelular  = trim($_POST['celular']);
        $email = trim($_POST['email']);
        $direccion = trim($_POST['direccion']);
        $nombreDeFoto = trim($_POST['rutaFoto']);

        $idGrupo = $_POST['idGrupo'] == 0 ? NULL: $_POST['idGrupo'];

        // echo "idContacto: $idContacto <br>";
        // echo "nombres: $nombres <br>";
        // echo "apellidos: $apellidos <br>";
        // echo "numeroCelular: $numeroCelular <br>";
        // echo "email: $email <br>";
        // echo "direccion: $direccion <br>";
        // echo "nombreDeFoto: $nombreDeFoto <br>";
        
        // echo "idGrupo: $idGrupo <br>";


        if(!empty($idContacto) && !empty($nombres) && !empty($apellidos) && !empty($numeroCelular) && !empty($email)) {

            $objContacto = new Contacto();
            $infoContacto = $objContacto -> solicitarUnContacto($idContacto);

            if($nombres === $infoContacto['nombreContacto'] && $apellidos === $infoContacto['apellidoContacto'] && $numeroCelular === $infoContacto['numeroCelular'] && $email === $infoContacto['emailContacto'] && $direccion === $infoContacto['direccionContacto'] && empty($_FILES['foto']['name']) && $idGrupo == $infoContacto['idGrupo']){

                $_SESSION['notiEditarContacto'] = "No hay cambios";
                header('Location: ../../paginas/usuarios/dashboard.php');
                exit();

                // echo "No puedes actualizar un contacto sin modificar nada";  
            }

            if(!empty($_FILES['foto']['name'])){

                $esImagen = exif_imagetype($_FILES['foto']['tmp_name']);
    
                if($esImagen === 2 || $esImagen === 3){
    
                    $carpeta = "../../Usuarios/" . $_SESSION['idUsuario'] . "/";
    
                    //Nombre de foto
                    $nombreFoto = "contacto(" . date('H.i.s__d-m-Y') . ")-" . $_FILES['foto']['name'];
    
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
    
                        $_SESSION['notiEditarContacto'] = "Error al cargar la foto";
                        header('Location: ../../paginas/usuarios/dashboard.php');
                        exit();
    
                    }
    
                }
                else {
    
                    $_SESSION['notiEditarContacto'] = "La foto subida no es JPG o PNG";
                    header('Location: ../../paginas/usuarios/dashboard.php');
                    exit();
                }

    
            }
            else {
                //no se subio ninguna imagen asignar por defecto
                $nombreFoto = $nombreDeFoto;
            }

            $actualizarContacto = $objContacto -> actualizarContacto($idGrupo, $nombres, $apellidos, $numeroCelular, $email, $direccion, $nombreFoto, $idContacto);

            if($actualizarContacto === 1){
                
                $_SESSION['notiEditarContacto'] = "Contacto actualizado correctamente";
                header('Location: ../../paginas/usuarios/dashboard.php');
                exit();

            }
            else {

                $_SESSION['notiEditarContacto'] = "Ocurrio un error al actualizar el contacto";
                header('Location: ../../paginas/usuarios/dashboard.php');
                exit();
            }
    
        }
        else {

            $_SESSION['notiEditarContacto'] = "Todos los campos son obligatorios";
            header('Location: ../../paginas/usuarios/dashboard.php');
            exit();

        }

    }


?>