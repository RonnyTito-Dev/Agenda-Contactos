<?php 
    session_start();
    if(!isset($_SESSION['idUsuario'])) {
        header('Location: ingresar.php');
        exit();
    }

    include_once('../../clases/Contacto.php');
    include_once('../../clases/Grupo.php');

    $objContacto = new Contacto();
    $contactos = $objContacto -> cargarContactos($_SESSION['idUsuario']);

    $totalContactos = count($contactos);
    $ContactoSinGrupo = $objContacto -> cargarContactoFiltrado($_SESSION['idUsuario'], NULL);
    $totalContactosSinGrupo = count($ContactoSinGrupo);

    $objGrupo = new Grupo();
    $grupos = $objGrupo -> cargarGrupos($_SESSION['idUsuario']);

    $totalGrupos = count($grupos);

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">

    <script src="notificaciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title> Mi DashBoard </title>
</head>
<body>

    <!-- Mostrar Notificaciones -->

    <?php 

        // Notificacion Login Autorizado
        if(isset($_SESSION['notiLogin']) && $_SESSION['notiLogin'] === "Acceso autorizado") {

            echo '<script> notiLoginAutorizado(); </script>';
            unset($_SESSION['notiLogin']);
        }

        // Notificacion Crear Contacto
        if(isset($_SESSION['notiCrearContacto'])) {

            if($_SESSION['notiCrearContacto'] === "No se pudo cargar la foto"){

                echo '<script> notiErrorCargarFotoContacto(); </script>';
                unset($_SESSION['notiCrearContacto']);
            }

            else if($_SESSION['notiCrearContacto'] === "Solo puedes subir foto en JPG y PNG"){

                echo '<script> notiSoloPNGoJPGContacto(); </script>';
                unset($_SESSION['notiCrearContacto']);
            }

            else if($_SESSION['notiCrearContacto'] === "Error en el proceso de agregar el contacto"){

                echo '<script> notiErrorProcesoCrearContacto(); </script>';
                unset($_SESSION['notiCrearContacto']);
            }

            
            else if($_SESSION['notiCrearContacto'] === "Campos vacios"){

                echo '<script> notiCamposVaciosContacto(); </script>';
                unset($_SESSION['notiCrearContacto']);
            }

            else if($_SESSION['notiCrearContacto'] === "Contacto Agregado Correctamente"){

                echo '<script> notiContactoAgregado(); </script>';
                unset($_SESSION['notiCrearContacto']);
            }

        }

        // Notificacion Crear Grupo
        if(isset($_SESSION['notiCrearGrupo'])){

            if($_SESSION['notiCrearGrupo'] === "No se pudo cargar la foto") {

                echo '<script> notiErrorCargarFotoGrupo(); </script>';
                unset($_SESSION['notiCrearGrupo']);
            }

            else if($_SESSION['notiCrearGrupo'] === "No es una imagen") {

                echo '<script> notiSoloPNGoJPGGrupo(); </script>';
                unset($_SESSION['notiCrearGrupo']);
            }

            else if($_SESSION['notiCrearGrupo'] === "Grupo creado exitosamente") {

                echo '<script> notiGrupoCreado(); </script>';
                unset($_SESSION['notiCrearGrupo']);
            }

            else if($_SESSION['notiCrearGrupo'] === "Error al crear el grupo") {

                echo '<script> notiErrorCrearGrupo(); </script>';
                unset($_SESSION['notiCrearGrupo']);
            }

            
            else if($_SESSION['notiCrearGrupo'] === "Todos los campos son obligatorios") {

                echo '<script> notiCamposVaciosGrupo(); </script>';
                unset($_SESSION['notiCrearGrupo']);
            }

        }

        // Notificacion Eliminar Contacto
        if(isset($_SESSION['notiEliminarContacto'])) {

            if($_SESSION['notiEliminarContacto'] == "Contacto eliminado correctamente") {

                echo '<script> notiContactoEliminado(); </script>';
                unset($_SESSION['notiEliminarContacto']);

            }

            else if($_SESSION['notiEliminarContacto'] == "No se pudo eliminar el contacto") {

                echo '<script> notiErrorEliminarContacto(); </script>';
                unset($_SESSION['notiEliminarContacto']);

            }


        }

        // Notificacion Editar Contacto
        if(isset($_SESSION['notiEditarContacto'])){

            if($_SESSION['notiEditarContacto'] === "No hay cambios") {

                echo "<script> notiNoHayCambiosEditarContacto(); </script>";
                unset($_SESSION['notiEditarContacto']);
            }

            else if($_SESSION['notiEditarContacto'] === "Error al cargar la foto") {
                
                echo "<script> notiErrorCargarFotoEditarContacto(); </script>";
                unset($_SESSION['notiEditarContacto']);
            }

            else if($_SESSION['notiEditarContacto'] === "La foto subida no es JPG o PNG") {
                
                echo "<script> notiSoloPNGoJPGEditarContacto(); </script>";
                unset($_SESSION['notiEditarContacto']);
            }

            else if($_SESSION['notiEditarContacto'] === "Contacto actualizado correctamente") {
                
                echo "<script> notiContactoEditado(); </script>";
                unset($_SESSION['notiEditarContacto']);
            }

            else if($_SESSION['notiEditarContacto'] === "Ocurrio un error al actualizar el contacto") {
                
                echo "<script> notiErrorAlEditarContacto(); </script>";
                unset($_SESSION['notiEditarContacto']);
            }

            else if($_SESSION['notiEditarContacto'] === "Todos los campos son obligatorios") {
                
                echo "<script> notiCamposVaciosEditarContacto(); </script>";
                unset($_SESSION['notiEditarContacto']);
            }


        }

        // Notificacion Eliminar Grupo
        if(isset($_SESSION['notiEliminarGrupo'])){

            if($_SESSION['notiEliminarGrupo'] === "Grupo eliminado correctamente"){

                echo "<script> notiGrupoEliminado(); </script>";
                unset($_SESSION['notiEliminarGrupo']);

            }

            else if($_SESSION['notiEliminarGrupo'] === "Error al eliminar el grupo"){

                echo "<script> notiErrorEliminarGrupo(); </script>";
                unset($_SESSION['notiEliminarGrupo']);

            }


        }

        // Notificacion Editar Grupo
        if(isset($_SESSION['notiEditarGrupo'])){

            if($_SESSION['notiEditarGrupo'] === "No hay cambios"){

                echo "<script> notiNoHayCambiosEditarGrupo(); </script>";
                unset($_SESSION['notiEditarGrupo']);

            }

            else if($_SESSION['notiEditarGrupo'] === "Error al cargar la foto"){

                echo "<script> notiErrorCargarFotoEditarGrupo(); </script>";
                unset($_SESSION['notiEditarGrupo']);

            }

            else if($_SESSION['notiEditarGrupo'] === "La foto subida no es JPG o PNG"){

                echo "<script> notiSoloPNGoJPGEditarGrupo(); </script>";
                unset($_SESSION['notiEditarGrupo']);

            }

            else if($_SESSION['notiEditarGrupo'] === "Grupo actualizado correctamente"){

                echo "<script> notiGrupoEditado(); </script>";
                unset($_SESSION['notiEditarGrupo']);

            }

            else if($_SESSION['notiEditarGrupo'] === "Ocurrio un error al actualizar el grupo"){

                echo "<script> notiErrorAlEditarGrupo(); </script>";
                unset($_SESSION['notiEditarGrupo']);

            }

            else if($_SESSION['notiEditarGrupo'] === "El nombre del grupo es obligatorio"){

                echo "<script> notiCamposVaciosEditarGrupo(); </script>";
                unset($_SESSION['notiEditarGrupo']);

            }


        }

    ?>

    <div class="menuResponsivo">
        <ion-icon name="menu"></ion-icon>
        <ion-icon name="close"></ion-icon>
    </div>

    <div class="barraLateral">

        <div>
            <div class="nombrePagina">
                <ion-icon name="menu" class="iconoMenu" id="iconoMenu"></ion-icon>
                <span> Agenda C. </span>
            </div>

            <button class="botonCrearContacto" id="botonCrearContacto" onclick="botonCrearContacto()">
                <ion-icon name="add-outline"></ion-icon>
                <span> Crear Contacto </span>
            </button>

            <button class="botonCrearGrupo" id="botonCrearGrupo" onclick="botonCrearGrupo()">
                <ion-icon name="duplicate"></ion-icon>
                <span> Crear Grupo </span>
            </button>

            <div class="linea"> </div>
        </div>

        <div class="itemsMenu">
            <nav class="menu">
                <ul>
                    <li>
                        <a href="../../index.php">
                            <ion-icon name="home"></ion-icon>
                            <span> Ir a Inicio </span>
                        </a>
                    </li>

                    <li>
                        <a href="#" id="botonDashboard" onclick="botonDashboard()">
                            <ion-icon name="laptop"></ion-icon>
                            <span> DashBoard </span>
                        </a>
                    </li>
                    <li>

                        <?php 

                            if($totalContactos > 0){
                                echo '<a href="#" id="botonMisContactos" onclick="botonMisContactos()" >';
                                    echo '<ion-icon name="people"></ion-icon>';
                                    echo ' <span> Mis Contactos </span>';
                                echo '</a>';
                            }

                                if($totalGrupos > 0 && $totalContactos > 0){
                                    echo '<a href="#" id="botonContactosFiltrados" onclick="botonSubMenuContactos()">';
                                        echo '<ion-icon id="iconoVerTodosGrupos" name="chevron-down">';
                                    echo '</a>';
                                }
                        ?> 
                    </li> 
                    
                    <?php 

                        if($totalGrupos > 0){

                            echo '<div class="cajaListaGrupos" id="cajaSubMenuContactos">';

                            if($totalContactosSinGrupo > 0) {
                                echo '<li>';
                                    echo '<a href="#">';
                                        echo '<img src="../../recursos/sin-grupo.png" alt="">';
                                        echo '<span> Sin Grupo (' . $totalContactosSinGrupo . ') </span>';

                                        echo '<form action="../../acciones/contactos/filtrar_por_grupo.php" method="post">';
                                            echo '<input type="hidden" name="idGrupo" value="0">';
                                            echo '<input type="submit" value="cargarGrupo" class="enviar" id="botonEnviarGrupo">';
                                        echo '</form>';

                                    echo '</a>';
                                echo '</li>';

                            }
                                
                            foreach($grupos as $grupo) {

                                if($grupo['numeroDeContactos'] > 0) {

                                    if(empty($grupo['fotoGrupo'])){
                                        $rutaFoto = "../../recursos/grupoDefecto.png";
                                    } else {
                                        $rutaFoto = "../../Usuarios/" . $_SESSION['idUsuario'] . "/" . $grupo['fotoGrupo'];
                                    }

                                    echo '<li>';
                                        echo '<a href="#" action="../../acciones/contactos/filtrar_por_grupo.php" method="post">';
                                            echo '<img src="' . $rutaFoto . '" alt="">';
                                            echo '<span>' . $grupo['nombreGrupo'] . " ({$grupo['numeroDeContactos']})" . '</span>';

                                            echo '<form action="../../acciones/contactos/filtrar_por_grupo.php" method="post">';
                                                echo '<input type="hidden" name="idGrupo" value="' . $grupo['idGrupo'] . '">';
                                                echo '<input type="submit" value="cargarGrupo" class="enviar" id="botonEnviarGrupo">';
                                            echo '</form>';

                                        echo '</a>';
                                    echo '</li>';
                                }
                            }

                            echo '</div>';
                        }
                            
                    ?>

                    <li>

                    <?php 
                    if($totalGrupos > 0){
                        echo '<a href="#" id="botonMisGrupos" onclick="botonMisGrupos()">
                            <ion-icon name="layers"></ion-icon>
                            <span> Mis Grupos </span>
                        </a> ';
                    }
                    
                    ?>

                    </li>
                   
            </nav>
        </div>

        <div>
            <div class="miCuenta">
                <div class="linea"> </div>
                <ul>
                    <li>
                        <a href="#" id="botonMiCuenta" onclick="botonMiCuenta()">
                            <ion-icon name="person"></ion-icon>
                            <span> Mi Cuenta </span>
                        </a>
                    </li>
                    <li> 
                        <a href="#" onclick="salirDeMiCuenta(' <?php echo !empty($_SESSION['nombresUsuario']) ? $_SESSION['nombresUsuario'] : '' ?> ')">
                            <ion-icon name="exit"></ion-icon>
                            <span> Cerrar Sesión </span>
                        </a>
                    </li> 
                </ul>

            </div>

        </div>

    </div>
    
    


    <!-- ------------------------ Contenido De La Pagina -------------------------- -->
    <main>

        <div class="dashboard">

            <div class="bienvenida" id="bienvenida" <?php echo (isset($_SESSION['grupoFiltrado'])) ? 'style="display: none"': 'style="display: block"'; ?> >
                <video autoplay loop muted playsinline>
                    <source src="../../recursos/video1.mp4" type="video/mp4">
                </video>

                <div class="contenido">
                    <h1> Bienvenid@ <?php echo $_SESSION['nombresUsuario']; ?> </h1>
                </div>
            </div>

            <div class="calendario" id="calendario" <?php echo (isset($_SESSION['grupoFiltrado'])) ? 'style="display: none"': 'style="display: flex"'; ?> >
                <div>
                    <img src="../../recursos/calendario.png" alt="">
                </div>
                <div class="fecha" id="fecha">
                </div>
                <div class="hora" id="hora">
                </div>
            </div>

            <div class="contador" id="contador" <?php echo (isset($_SESSION['grupoFiltrado'])) ? 'style="display: none"': 'style="display: flex"'; ?> >
                <div class="contadorContactos">
                    <h3> Total Contactos </h3>
                    <h4> <?php echo $totalContactos; ?> </h4>
                </div>
                <div class="contadorGrupos">
                    <h3> Total Grupos </h3>
                    <h4> <?php echo $totalGrupos; ?> </h4>
                </div>
            </div>
            
            <div class="misContactos" id="misContactos" <?php echo (isset($_SESSION['grupoFiltrado'])) ? 'style="display: none"': 'style="display: block"'; ?> >

                <section class="cabeceraTabla">
                    <h1> Mis Contactos</h1>
                    <div class="buscador">
                        <input type="search" placeholder="Buscar contacto...">
                        <img src="../../recursos/buscar.png" alt="Buscar">
                    </div>
                </section>

                <section class="tabla">
                    <table>
                        <thead>
                            <tr>
                                <th> Foto </th>
                                <th> Nombre </th>
                                <th> Apellidos </th>
                                <th> Número </th>
                                <th> Email</th>
                                <th> Dirección </th>
                                <th> Acciones </th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php 

                                foreach($contactos as $contacto){
                                                                
                                    if(empty($contacto['fotoContacto'])){
                                        $ruta = "../../recursos/fotoContacto.png";
                                        $img = '<img src="' . $ruta . '">';
                                    }  
                                    else {
                                        $ruta = "../../Usuarios/" . $_SESSION['idUsuario'] . "/" . $contacto['fotoContacto'];
                                        $img = '<img src="' . $ruta . '">';
                                    }

                                    $datos = "{$contacto['idContacto']}, " . "'{$contacto['nombreContacto']}', " . "'{$contacto['apellidoContacto']}', " . "'{$contacto['numeroCelular']}', " . "'{$contacto['emailContacto']}', " . "'{$contacto['direccionContacto']}', " . "'{$contacto['idGrupo']}', " . "'{$ruta}', " . "'{$contacto['fotoContacto']}'";

                                    $editar = '<ion-icon name="create" class="editar" onclick="editarContacto(' . $datos . ')"> </ion-icon>';

                                    $eliminar = '<ion-icon name="trash" class="eliminar" onclick="eliminarContacto(' . $contacto['idContacto']. ')"> </ion-icon>';

                                    echo "<tr>
                                            <td> {$img} </td>
                                            <td> {$contacto['nombreContacto']} </td>
                                            <td> {$contacto['apellidoContacto']} </td>
                                            <td> {$contacto['numeroCelular']} </td>
                                            <td> {$contacto['emailContacto']} </td>
                                            <td> {$contacto['direccionContacto']} </td>
                                            <td> $editar $eliminar </td>
                                    </tr>";

                                }

                            ?>
                        
                        </tbody>
                    </table>
                </section>

            </div>


            <div class="misGrupos" id="misGrupos" <?php echo (isset($_SESSION['grupoFiltrado'])) ? 'style="display: none"': 'style="display: block"'; ?> >
                <section class="cabeceraTabla">
                    <h1> Mis Grupos </h1>
                    <div class="buscador">
                        <input type="search" placeholder="Buscar Grupo...">
                        <img src="../../recursos/buscar.png" alt="Buscar">
                    </div>
                </section>

                <section class="tabla">
                    <table>
                        <thead>
                            <tr>
                                <th> Imagen </th>
                                <th> Nombre de Grupo </th>
                                <th> Descripcion </th>
                                <th> Total Contactos </th>
                                <th> Acciones </th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php 
                            
                            foreach($grupos as $grupo){

                                if(empty($grupo['fotoGrupo'])) {

                                    $ruta = "../../recursos/grupoDefecto.png";
                                    $img = '<img src="'. $ruta . '">';

                                } else {
                                    $ruta = "../../Usuarios/" . $_SESSION['idUsuario'] . "/" . $grupo['fotoGrupo'];
                                    $img = '<img src="' . $ruta . '">';
                                }

                                $datosDelGrupo = "{$grupo['idGrupo']}, '{$grupo['nombreGrupo']}', '{$grupo['descripcionGrupo']}', '{$grupo['fotoGrupo']}', '{$ruta}'"; 

                                $editarGrupo = '<ion-icon name="create" class="editarElGrupo" onclick="editarGrupo(' . $datosDelGrupo . ')"> </ion-icon>';

                                $eliminarGrupo = '<ion-icon name="trash" class="eliminarElGrupo" onclick="eliminarGrupo(' . $grupo['idGrupo']. ')"> </ion-icon>';

                                echo "<tr> 
                                        <td> {$img} </td>
                                        <td> {$grupo['nombreGrupo']} </td>
                                        <td> {$grupo['descripcionGrupo']} </td>
                                        <td> {$grupo['numeroDeContactos']} </td>
                                        <td> $editarGrupo $eliminarGrupo </td>
                                     </tr>";
                            }
                            
                            ?>
                            
                            
                            <!-- <tr>
                                <td> <img src="../../recursos/calendario.png" alt="img"> </td>
                                <td> Tren </td>
                                <td> Los munas </td>
                                <td> 12 </td>
                                <td> 22 - 23- 1023</td>
                                <td> Acción </td>
                            </tr> -->

                        </tbody>
                    </table>
                </section>
            </div>


            <div class="crearContacto" id="crearContacto" <?php echo (isset($_SESSION['grupoFiltrado'])) ? 'style="display: none"': ''; ?> >

                    <h3> Crear Contacto </h3>

                    <form action="../../acciones/contactos/procesar_crear.php" enctype="multipart/form-data" method="post">
                        <div class="cajaDatos">
                            <label for=""> Nombres: * </label>
                            <input type="text" name="nombres" id="" maxlength="100" required>

                            <label for=""> Apellidos: * </label>
                            <input type="text" name="apellidos" id="" maxlength="100" required>

                            <label for=""> Numero Celular: * </label>
                            <input type="tel" name="celular" id="" minlength="9" maxlength="12" required>

                            <label for=""> Email: * </label>
                            <input type="email" name="email" id="" maxlength="50" required>

                            <label for=""> Direccion: </label>
                            <input type="text" name="direccion" id="" maxlength="50" >

                            <?php 
                                if($totalGrupos > 0){

                                    echo '<label for=""> Agregar contacto a un grupo? </label>';
                                    echo '<select name="grupo" id="" class="selectorGrupo">';
                                    echo '<option value="0" selected> Sin Grupo </option>';

                                    foreach($grupos as $grupo){
                                        echo '<option value="' . $grupo['idGrupo'] . '">' . $grupo['nombreGrupo']  . '</option>';

                                    }

                                    echo '</select>';

                                }
                            
                            ?>
                            
                            <input type="submit" value="Crear Contacto" class="botonAgregarContacto">

                        </div>

                        <div class="cajaFoto">

                            <label for="cargarFoto">Cargar Foto de Contacto</label>
                            <img id="fotoMostrada" src="../../recursos/fotoContacto.png" alt="">
                            <input type="file" name="foto" id="cargarFoto" style="display: none;" onchange="mostrarFotoSeleccionadaContacto(this)">
                            <input type="button" value="Seleccionar Foto" class="botonCargarFoto" onclick="document.getElementById('cargarFoto').click()">

                        </div>
                    </form>

            </div>

            <div class="crearGrupo" id="crearGrupo" <?php echo (isset($_SESSION['grupoFiltrado'])) ? 'style="display: none"': ''; ?> >
                <h3> Crear Grupo </h3>

                <form action="../../acciones/grupos/procesar_crear.php" enctype="multipart/form-data" method="post">
                    <div class="cajaDatos">
                        <label for=""> Nombre del Grupo: * </label>
                        <input type="text" name="nombreGrupo" id="" maxlength="50" required>

                        <label for=""> Descripcion: </label>
                        <textarea name="descripcionGrupo" id="" maxlength="100" > </textarea>

                        <input type="submit" value="Crear Grupo" class="botonCrearGrupo">
                    </div>

                    <div class="cajaFoto">

                        <label for="cargarFotoGrupo"> Cargar Foto del Grupo </label>
                        <img id="fotoMostradaGrupo" src="../../recursos/grupoDefecto.png" alt="">
                        <input type="file" name="foto" id="cargarFotoGrupo" style="display: none;" onchange="mostrarFotoSeleccionadaGrupo(this)">
                        <input type="button" value="Seleccionar Foto" class="botonCargarFotoGrupo" onclick="document.getElementById('cargarFotoGrupo').click()">

                    </div>
                </form>
            </div>

            <div class="miCuenta" id="miCuenta" <?php echo (isset($_SESSION['grupoFiltrado'])) ? 'style="display: none"': ''; ?> >
                <h3> Mi Cuenta (Pronto disponible :P ) </h3>
                <div class="cajaDatosMiCuenta">
                        <form action="">

                        </form>

                </div>
            </div>

            
            <div class="contactosFiltrado" id="contactosFiltrado" <?php echo (isset($_SESSION['grupoFiltrado'])) ? 'style="display: block"': 'style="display: none"'; ?> >

                <section class="cabeceraTabla">

                    <?php 
                        $nombreGrupo = is_array($_SESSION['infoGrupo']) ? $_SESSION['infoGrupo']['nombreGrupo'] : 'Sin Grupo';
                        $buscarEn = is_array($_SESSION['infoGrupo']) ? $_SESSION['infoGrupo']['nombreGrupo'] . "..." : 'contacto...'; 
                        if (isset($_SESSION['grupoFiltrado']) && is_array($_SESSION['grupoFiltrado'])) {

                            $contarContactos = " (" . count($_SESSION['grupoFiltrado']) . ")";
                            
                        }
                    ?>

                    <h1> <?php echo $nombreGrupo . $contarContactos ?> </h1>
                    <div class="buscador">
                        <input type="search" placeholder="Buscar en <?php echo $buscarEn; ?> ">
                        <img src="../../recursos/buscar.png" alt="Buscar">
                    </div>

                </section>

                <section class="tabla">
                    <table>
                        <thead>
                            <tr>
                                <th> Foto </th>
                                <th> Nombre </th>
                                <th> Apellidos </th>
                                <th> Número </th>
                                <th> Email</th>
                                <th> Dirección </th>
                                <th> Acciones </th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php 

                                foreach($_SESSION['grupoFiltrado'] as $contacto){
                                                                
                                    if(empty($contacto['fotoContacto'])){
                                        $img = '<img src="../../recursos/fotoContacto.png">';
                                    }  
                                    else {
                                        $ruta = "../../Usuarios/" . $_SESSION['idUsuario'] . "/" . $contacto['fotoContacto'];
                                        $img = '<img src="' . $ruta . '">';
                                    }

                                    $datos = "{$contacto['idContacto']}, " . "'{$contacto['nombreContacto']}', " . "'{$contacto['apellidoContacto']}', " . "'{$contacto['numeroCelular']}', " . "'{$contacto['emailContacto']}', " . "'{$contacto['direccionContacto']}', " . "'{$contacto['idGrupo']}', " . "'{$ruta}', " . "'{$contacto['fotoContacto']}'";

                                    $editar = '<ion-icon name="create" class="editar" onclick="editarContacto(' . $datos . ')"> </ion-icon>';

                                    $eliminar = '<ion-icon name="trash" class="eliminar" onclick="eliminarContacto(' . $contacto['idContacto'] . ')"></ion-icon>';

                                    echo "<tr>
                                            <td> {$img} </td>
                                            <td> {$contacto['nombreContacto']} </td>
                                            <td> {$contacto['apellidoContacto']} </td>
                                            <td> {$contacto['numeroCelular']} </td>
                                            <td> {$contacto['emailContacto']} </td>
                                            <td> {$contacto['direccionContacto']} </td>
                                            <td> $editar $eliminar </td>
                                         </tr>";

                                }

                                unset($_SESSION['grupoFiltrado']);
                                unset($_SESSION['infoGrupo']);

                            ?>

                            <!-- <tr>
                                <td> <img src="../../recursos/buscar.png" alt="img"> </td>
                                <td> Maria Felipa</td>
                                <td>987654321</td>
                                <td>maria@gmail.com</td>
                                <td>Velaco 123</td>
                                <td>Velaco 123</td>
                                <td>Colonial 123</td>
                            </tr> -->
                        

                        </tbody>
                    </table>
                </section>

            </div>


            <div class="editarContacto" id="editarContacto" <?php echo (isset($_SESSION['grupoFiltrado'])) ? 'style="display: none"': ''; ?> >

                <h3> Editar Contacto </h3>

                <form action="../../acciones/contactos/procesar_editar.php" enctype="multipart/form-data" method="post">
                    <div class="cajaDatos">

                        <!-- <label for="editarIdContacto"> Id: * </label> -->
                        <input type="hidden" name="idContacto" id="editarIdContacto">
                        
                        <label for=""> Nombres: * </label>
                        <input type="text" name="nombres" id="editarNombresContacto" maxlength="100" required>

                        <label for=""> Apellidos: * </label>
                        <input type="text" name="apellidos" id="editarApellidosContacto" maxlength="100" required>

                        <label for=""> Numero Celular: * </label>
                        <input type="tel" name="celular" id="editarCelularContacto" minlength="9" maxlength="12" required>

                        <label for=""> Email: * </label>
                        <input type="email" name="email" id="editarEmailContacto" maxlength="50" required>

                        <label for=""> Direccion: </label>
                        <input type="text" name="direccion" id="editarDireccionContacto" maxlength="50" >

                        <!-- <label for=""> Id Grupo: </label> -->
                        <input type="hidden" name="idGrupoPrueba" id="editarIdGrupoContacto">

                        <!-- <label for=""> Ruta Foto: </label> -->
                        <input type="hidden" name="rutaFoto" id="editarFotoContacto">

                        <?php 
                            if($totalGrupos > 0){

                                echo '<label for=""> Grupo del contacto? </label>';
                                echo '<select name="idGrupo" id="selectorGrupo" class="selectorGrupo">';
                                echo '<option value="0"> Sin Grupo </option>';

                                foreach($grupos as $grupo){
                                    echo '<option value="' . $grupo['idGrupo'] . '">' . $grupo['nombreGrupo']  . '</option>';

                                }

                                echo '</select>';

                            }
                        
                        ?>
                        
                        <input type="submit" value="Actualizar Contacto" class="botonAgregarContacto">

                    </div>

                    <!-- Formulario para editar contacto -->
                    <div class="cajaFoto">

                        <label for="fotoEditarContacto"> Foto del Contacto </label>
                        <img id="fotoEditarContacto" src="../../recursos/fotoContacto.png" alt="">
                        <input type="file" name="foto" id="cargarFotoEditarContacto" style="display: none;" onchange="mostrarFotoEditarContacto(this)">
                        <input type="button" value="Agregar Foto" class="botonAgregarFoto" id="botonAgregarFoto" onclick="document.getElementById('cargarFotoEditarContacto').click()">

                    </div>


                </form>

            </div>

            
            <div class="editarGrupo" id="editarGrupo" <?php echo (isset($_SESSION['grupoFiltrado'])) ? 'style="display: none"': ''; ?> >
                <h3> Editar Grupo </h3>

                <form action="../../acciones/grupos/procesar_editar.php" enctype="multipart/form-data" method="post">
                    <div class="cajaDatos">

                        <!-- <label for=""> ID Grupo: * </label> -->
                        <input type="hidden" name="idGrupo" id="idGrupo" required>

                        <label for=""> Nombre del Grupo: * </label>
                        <input type="text" name="nombreGrupo" id="nombreGrupo" maxlength="50" required>

                        <label for=""> Descripcion: </label>
                        <textarea name="descripcionGrupo" id="descripcionGrupo" maxlength="100" > </textarea>

                        <!-- <label for=""> Ruta de Foto: * </label> -->
                        <input type="hidden" name="rutaGrupo" id="rutaGrupo">

                        <input type="submit" value="Actualizar Grupo" class="botonEditarGrupo" >
                    </div>

                    <div class="cajaFoto">

                        <label for="cargarFotoGrupo"> Foto del Grupo </label>
                        <img id="fotoDelGrupo" src="../../recursos/grupoDefecto.png" alt="">
                        <input type="file" name="foto" id="cargarFotoEditarGrupo" style="display: none;" onchange="mostrarFotoEditarGrupo(this)">
                        <input type="button" value="Agregar Foto" id="agregarFotoGrupo" class="agregarFotoGrupo" onclick="document.getElementById('cargarFotoEditarGrupo').click()">

                    </div>
                </form>
            </div>

        </div>

    </main>

    

    <script src="dashboard.js"> </script>
    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>