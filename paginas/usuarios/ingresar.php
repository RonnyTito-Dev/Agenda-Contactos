<?php
    session_start();
    if(isset($_SESSION['idUsuario'])) {
        
        header('Location: ../usuarios/dashboard.php');
        exit();

    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="notificaciones.js"></script>
    <link rel="stylesheet" href="ingresar.css">

    <title> Ingresar </title>
</head>
<body>

    <!-- Notificaciones PHP y JS -->
    <?php 

        //Mostrar Notificacion Login
        if(isset($_SESSION['notiLogin'])) {

            if($_SESSION['notiLogin'] === "Campos vacios") {

                echo '<script> notiCamposVaciosLogin();</script>';
                unset($_SESSION['notiLogin']);
                session_destroy();
            }

            else if($_SESSION['notiLogin'] === "no existe email"){

                echo '<script> notiNoExisteEmailLogin();</script>';
                unset($_SESSION['notiLogin']);
                session_destroy();
            }

            else if($_SESSION['notiLogin'] === "credenciales invalidas") {

                echo '<script> notiCredencialesInvalidasLogin();</script>';
                unset($_SESSION['notiLogin']);
                session_destroy();
            }
        }

    
        //Mostrar Notificacion Registro
        if(isset($_SESSION['notiRegistro'])) {

            if($_SESSION['notiRegistro'] === "Ocurrio un error al registrarte") {
                
                echo '<script> notiErrorRegistro(); </script>';
                unset($_SESSION['notiRegistro']);
                session_destroy();
            }

            else if($_SESSION['notiRegistro'] === "El email ya existe") {
                echo '<script> notiEmailYaExiste(); </script>';

                unset($_SESSION['notiRegistro']);
                session_destroy();
            }

            else if($_SESSION['notiRegistro'] === "Registro exitoso") {
                echo '<script> notiRegistroExitoso(); </script>';

                unset($_SESSION['notiRegistro']);
                session_destroy();
            }
            
            else if($_SESSION['notiRegistro'] === "Campos Vacios") {

                echo '<script> notiCamposVaciosRegistro(); </script>';

                unset($_SESSION['notiRegistro']);
                session_destroy();
            }

        }

    ?>

    <header>
        <nav class="cajaMenu">
            <div class="cajaLogo">
                <div class="logo">
                    <img src="../../recursos/Logo.png" alt="Logo">
                </div>
                <div class="cajaIconoMenu">
                    <img src="recursos/abrirMenu.png" alt="" class="iconoMenu" id="iconoMenu">
                    <input type="checkbox" name="abrirMenu" id="activadorMenuMovil" class="activador">
                </div>
            </div>

            <div class="cajaItems" id="cajaItems">
                <a href="../../index.php"> Inicio </a>
                <a href="../../index.php#cajaAcercaDe"> Acerca de </a>
                <a href="../../index.php#cajaTestimonios"> Testimonios </a>
            </div>

            <div class="cajaBotones" id="CajaBotones">

                <a href="#" onclick="cajaLogin()">
                    <button type="button">Iniciar Sesión</button>
                </a>

                <a href="#" onclick="cajaRegistro()">
                    <button type="button">Registrarme</button>
                </a>

            </div>
        </nav>
    </header>
 

<div class="cajaFormularioIngreso">
    <div class="cajaLogin" id="cajaLogin">
        <span> No tienes una cuenta? <a href="#" onclick="cajaRegistro()"> Registrarme </a> </span>
        <h2> Iniciar Sesión </h2>

        <form action="../../acciones/usuarios/procesar_login.php" method="post">
            <input type="email" name="email" placeholder="Email" maxlength="50" required>
            <input type="password" name="password" placeholder="Contraseña" maxlength="60" required>
            <input type="submit" value="Iniciar Sesión">
        </form>
    </div>



    <div class="cajaRegistro" id="cajaRegistro">
        <span> Ya tienes tu cuenta? <a href="#" onclick="cajaLogin()"> Iniciar Sesión </a> </span>
        <h2> Registrame </h2>

        <form action="../../acciones/usuarios/procesar_registro.php" method="post">

            <div class="juntos">
                <input type="text" name="nombre" placeholder="Nombres" maxlength="100" required>
                <input type="text" name="apellido" placeholder="Apellidos" maxlength="100" required>
            </div>
            <input type="email" name="email" placeholder="Email" maxlength="50" required>
            <input type="password" name="contrasenia" placeholder="Contraseña" minlength="8" maxlength="60" required>
            <input type="submit" value="Registrarme">
        </form>
    </div>

</div>

<script>

    const checkbox = document.getElementById("activadorMenuMovil");
    const cajaItems = document.getElementById("cajaItems");
    const cajaBotones = document.getElementById("CajaBotones");

    function toggleMenu() {
            
        if (checkbox.checked) {
            cajaItems.classList.add("mostrar");
            cajaBotones.classList.add("mostrar");
            iconoMenu.src = "../../recursos/cerrarMenu.png";

        } else {
            cajaItems.classList.remove("mostrar");
            cajaBotones.classList.remove("mostrar");
            iconoMenu.src = "../../recursos/abrirMenu.png";
        }
    }

    function ajustarCheckbox() {
        if (window.innerWidth >= 721) {
            checkbox.checked = false;
            toggleMenu();
        }
    }

    checkbox.addEventListener("change", toggleMenu);
    window.addEventListener("load", ajustarCheckbox);
    window.addEventListener("resize", ajustarCheckbox);

    
    function cajaLogin(){

        var cajaLogin = document.getElementById("cajaLogin");
        var cajaRegistro = document.getElementById("cajaRegistro");

        cajaLogin.style.display = 'block';
        cajaRegistro.style.display = 'none';

    }

    function cajaRegistro(){

        var cajaRegistro = document.getElementById("cajaRegistro");
        var cajaLogin = document.getElementById("cajaLogin");

        cajaLogin.style.display = 'none';
        cajaRegistro.style.display = 'block';

    }

</script>

</body>
</html>