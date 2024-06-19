<?php 

    require_once('../../clases/Contacto.php');

    session_start();

    if(!isset($_SESSION['idUsuario'])) {
        header('Location: ../../paginas/usuarios/ingresar.php');
        exit();
    }

    //Establecer zona horaria Lima
    date_default_timezone_set('America/Lima');

    if($_POST) {

        //Id Usuario
        $idUsuario = $_SESSION['idUsuario'];

        //Almacenar Variables
        $nombresContacto = trim($_POST['nombres']);
        $apellidosContacto = trim($_POST['apellidos']);
        $numeroCelular = trim($_POST['celular']);
        $emailContacto = trim($_POST['email']);

        //Operador Ternario - Verificar Direccion
        $direccionContacto = empty(trim($_POST['direccion'])) ? "":trim($_POST['direccion']);
        $idGrupo = ($_POST['grupo'] == 0) ? NULL : $_POST['grupo'];

        //Validar campos vacios
        if(!empty($nombresContacto) || !empty($apellidosContacto) || !empty($numeroCelular) || !empty($emailContacto)) {


            //Comprobar subida de foto
            if(!empty($_FILES['foto']['name'])) {

                //Si se subio Foto

                // Comprobar si es imagen JPG o PNG
                $esImagen = exif_imagetype($_FILES['foto']['tmp_name']);

                if($esImagen === 2 || $esImagen === 3) {

                    //Si es JPG o PNG

                    //Carpeta
                    $carpeta = "../../Usuarios/" . $idUsuario . "/";

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

                        // Notificacion paso un error al subir la foto
                        $_SESSION['notiCrearContacto'] = "No se pudo cargar la foto";
                        header('Location: ../../paginas/usuarios/dashboard.php');
                        exit();

                        // echo "No se pudo cargar la foto <br>";

                    }

                }

                else {
                    //No es Imagen 
                    $_SESSION['notiCrearContacto'] = "Solo puedes subir foto en JPG y PNG";
                    header('Location: ../../paginas/usuarios/dashboard.php');
                    exit();

                    // echo "Solo puedes subir foto en JPG y PNG <br>";

                }


            } 
            else {

                // No se subio foto - Asignar imagen por defecto
                $nombreFoto = "";

            }

            //Capturar fecha Creacion Contacto
            $creacionContacto = date('Y-m-d H:i:s');
            
            //Llamar al metodo crear Contacto
            $nuevoContacto = new Contacto();

            // idUsuario- nombreContacto - apellidoContacto - numeroCelular - emailContacto - direccionContacto - fotoContacto - creacionContacto - estadoContacto
            $agregarContacto = $nuevoContacto -> crearContacto($idUsuario, $idGrupo, $nombresContacto, $apellidosContacto, $numeroCelular, $emailContacto, $direccionContacto, $nombreFoto, $creacionContacto);

            //Notificacion a resultados
            if($agregarContacto === 1) {

                //Contacto agregado
                $_SESSION['notiCrearContacto'] = "Contacto Agregado Correctamente";
                header('Location: ../../paginas/usuarios/dashboard.php');
                exit();

                // echo "Contacto Agregado Correctamente <br>";
            } 
            else {

                // Notificacion Ocurrio un error en el proceso de agregar un contacto
                $_SESSION['notiCrearContacto'] = "Error en el proceso de agregar el contacto";
                header('Location: ../../paginas/usuarios/dashboard.php');
                exit();

                // echo "Error en el proceso de agregar el contacto <br>";
            }


        } 
        else {

            //Notificacion - todos los Campos Son Obligatorios
            $_SESSION['notiCrearContacto'] = "Campos vacios";
            header('Location: ../../paginas/usuarios/dashboard.php');
            exit();

            // echo "Algunos campos son obligatorios <br>";
        }


    }

?>