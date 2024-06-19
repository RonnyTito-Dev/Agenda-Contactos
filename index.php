<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="estilos.css">

    <title> Agenda Contactos </title>
</head>

<body>

    <header>
        <nav class="cajaMenu">
            <div class="cajaLogo">
                <div class="logo">
                    <img src="recursos/Logo.png" alt="Logo">
                </div>
                <div class="cajaIconoMenu">
                    <img src="recursos/abrirMenu.png" alt="" class="iconoMenu" id="iconoMenu">
                    <input type="checkbox" name="abrirMenu" id="activadorMenuMovil" class="activador">
                </div>
            </div>

            <div class="cajaItems" id="cajaItems">
                <a href="index.php"> Inicio </a>
                <a href="#cajaAcercaDe"> Acerca de </a>
                <a href="#cajaTestimonios"> Testimonios </a>
            </div>

            <div class="cajaBotones" id="CajaBotones">

            <?php 
            
                if(isset($_SESSION['nombresUsuario'])) {

                    echo '<a href="paginas/usuarios/dashboard.php">
                    <button type="button"> Mi Cuenta </button>
                    </a>';

                    echo '<a href="paginas/usuarios/cerrar_sesion.php">
                    <button type="button"> Cerrar Sesión </button>
                    </a>';

                }
                else {
                    echo '<a href="paginas/usuarios/ingresar.php">
                    <button type="button">Iniciar Sesión</button>
                    </a>';

                    echo '<a href="paginas/usuarios/ingresar.php">
                    <button type="button">Registrarme</button>
                    </a>';
                }
            ?>

            </div>
        </nav>
    </header>

    <main>

        <div class="cajaPortada">
            <div class="cajaVideo">
                <video autoplay loop muted plays-inline>
                    <source src="recursos/video_degradado.mp4" type="video/mp4">
                </video>
            </div>

            <div class="cajaContenido">

                    <h1> Un Lugar único y dedicado </h1>
                    <h2> Gestiona y organiza tus contactos de manera eficiente y fácil </h2>

                    <p> "Con esta plataforma, podrás mantener todos tus contactos fácilmente accesibles y gestionados, simplificando tu vida digital y mejorando tu productividad en cada momento." </p>

                    <?php 

                        if(isset($_SESSION['nombresUsuario'])){
                            echo '<a href="paginas/usuarios/dashboard.php"> <button type="button" > Ir a mi Cuenta </button> </a>';
                        }
                        else {
                            echo '<a href="paginas/usuarios/ingresar.php"> <button type="button" > Unirme Ahora </button> </a>';
                        }
                    
                    ?>
            </div>
        </div>


        <div class="cajaAcercaDe" id="cajaAcercaDe">

            <h2> Acerca de Agenda Contactos</h2>

            <div class="cajaMision">
                <img src="recursos/mision.png" alt="">
                <h3> Misión </h3>
                <p> Simplificar la gestión de contactos al proporcionar una plataforma intuitiva y segura. </p>
            </div>

            <div class="cajaVision">
                <img src="recursos/vision.png" alt=""> 
                <h3> Visión </h3>
                <p> Ser la opción principal para millones de personas en la gestión de contactos, con innovación constante y adaptación a las necesidades de los usuarios. </p>
            </div>

            <div class="cajaValores"> 
                <img src="recursos/valores.png" alt="">
                <h3> Valores </h3>
                <p> Facilidad de uso, innovación, confianza y seguridad, atención al cliente y más <p>
            </div>

        </div>


        <div class="fondo" id="cajaTestimonios">
            <div class="cajaTestimonios">
                <h2> Testimonios </h2>
                <div class="cajaTestimonio1">
                    <img src="recursos/user1.png" alt="">
                    <h3> Juan Pablo Torres </h3>
                    <p> "Desde que uso esta web, mi vida digital está mucho más organizada. ¡Acceder a mis contactos nunca fue tan fácil!" </p>
                </div>

                <div class="cajaTestimonio2">
                    <img src="recursos/user2.png" alt=""> 
                    <h3> Maria Valladares </h3>
                    <p> "Agenda Contactos es increíblemente útil. La interfaz intuitiva y la búsqueda potente han transformado cómo gestiono mis contactos." </p>
                </div>

                <div class="cajaTestimonio3"> 
                    <img src="recursos/user3.png" alt="">
                    <h3> Lucas Rodriguez </h3>
                    <p> "Esta herramienta ha simplificado cómo gestiono mis contactos. Su seguridad y facilidad de uso son impresionantes." <p>
                </div>

            </div> 
        </div>

    </main>

    <script>
    const checkbox = document.getElementById("activadorMenuMovil");
    const cajaItems = document.getElementById("cajaItems");
    const cajaBotones = document.getElementById("CajaBotones");

    function toggleMenu() {
        if (checkbox.checked) {
            cajaItems.classList.add("mostrar");
            cajaBotones.classList.add("mostrar");
            iconoMenu.src = "recursos/cerrarMenu.png";
        } else {
            cajaItems.classList.remove("mostrar");
            cajaBotones.classList.remove("mostrar");
            iconoMenu.src = "recursos/abrirMenu.png";
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
</script>
    
</body>
</html>

