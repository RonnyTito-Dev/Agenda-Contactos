<<<<<<< HEAD
# :ledger: Agenda de Contactos- CRUD

![Portada Proyecto](https://i.ibb.co/bgWzVSg/CRUD-Agenda-Contactos.png)


## Descripcion del Proyecto
Este es un proyecto de sistema de agenda de contactos que permite a los usuarios crear una cuenta, almacenar sus contactos(incluyendo fotos), crear grupos(también con fotos) y organizar los contactos en los grupos.

<br>

## Características
- :newspaper: **Gestión de contactos:** Crear, leer, actualizar y eliminar (cambiar el estado) de los contactos.
- :file_folder: **Organización por grupos:** Crear, leer, actualizar y eliminar (cambiar el estado) de los grupos.
- :lock: **Autenticación:** Registro e inicio de sesión para usuarios.
- :date: **Registro de actividad del usuario:** Fecha de registro, última sesión, último cierre de sesión y timpo de sesión (almacenado en DB).
- :mag: **Busqueda y filtrado:** Búsqueda de contactos y grupos, tambien filtrado por grupos.
- :bar_chart: **Interfaz amigable:** Diseño intuitivo y facil de usar.

<br>

## Tecnologías Utilizadas
- **HTML5**
- **CSS3**
- **JavaScript**
- **PHP**
- **MySQL**

<br>

---

## Requisitos Previos
Antes de comenzar, asegúrate de tener instalado lo siguiente:
- **XAMPP**
- **Navegador web moderno**

<br>

## Instalación
Sigue estos pasos para configurar el proyecto en tu entorno local:

1. **Clonar el repositorio**

    ```bash
    git clone https://github.com/tu-usuario/tu-repositorio.git
    ```
2. **Configurar la base de datos**
    - Inicia XAMPP y asegúrate de que Apache y MySQL están funcionando.
    - Abre el phpMyAdmin en tu navegador y crear una nueva base de datos, por ejemplo, `agenda_contactos` .
    - Importa el archivo `sql/database.sql` ubicado en el directorio del proyecto para crear las tablas necesarias.

    <br>

    #### Opción 1: Usando phpMyAdmin
    - Navega a `http://localhost/phpmyadmin/` o clic aqui **[phpMyAdmin](http://localhost/phpmyadmin/)**
    - Selecciona la base de datos que creaste (`agenda_contactos`).
    - Haz clic en la pestaña **Importar**.
    - Selecciona el archivo `sql/database.sql` y haz clic en **Continuar**.


    #### Opción 2: Usando la línea de comandos de MySQL
    ```bash
        mysql -u tu-usuario-DB -p tu-contraseña-DB agenda_contactos < sql/database.sql
    ```
    <br>

3. **Configurar el archivo de conexión a la base de datos**

    - Edita el archivo `clases/Conexion.php` con tus credenciales de MySQL.
    ```php
    <?php
        private $host = "localhost";
        private $nombreDB = "agenda_contactos";
        private $usuario = "root"; //el usuario por defecto de XAMPP es root
        private $contrasenia = ""; //la contraseña por defecto de XAMPP es una cadena vacia
    ?>
    ```

4. **Iniciar el servidor**
    - Coloca el proyecto en el directorio raíz de tu servidor web (por ejemplo, `htdocs` en XAMPP).
    - Abre tu navegador y navega a `http://localhost/AgendaContactos` o clic aqui **[AgendaContactos](http://localhost/AgendaContactos)**

<br>

## Uso
1. **Registro de usuario**
    - Registrate como nuevo usuario.
2. **Inicio de Sesión**
    - Inicia sesión con tus credenciales.
3. **Gestión de contactos**
    - Crea, edita y elimina los contactos (incluyendo subida de fotos).
4. **Gestión de grupos**
    - Crea, edita, y elimina los grupos (incluyendo la subida de fotos).

<br>

## Capturas de Pantalla
![Página Home](https://i.ibb.co/4Rvm3jg/Home.png)

![Página de registro](https://i.ibb.co/tmtp2V5/Registro.png)

![Página de Inicio de Sesión](https://i.ibb.co/R3nxqd5/Inicio-Sesion.png)

![Página de DashBoard 1](https://i.ibb.co/s5Vrgsj/Dash-Board-1.png)

![Página de DashBoard 1](https://i.ibb.co/0rtzGcL/Dash-Board-1-2.png)

<br>

## Contacto
<a href="mailto:ronnycito.dev@gmail.com" target="_blank"><img src="https://skillicons.dev/icons?i=gmail"></a>
<a href="https://www.linkedin.com/in/ronnytito" target="_blank" ><img src="https://skillicons.dev/icons?i=linkedin"></a>
<a href="https://x.com/RonnyTito_" target="_blank"><img src="https://skillicons.dev/icons?i=twitter"></a>

---
*¡Gracias por visitar!*
=======
# Agenda-Contactos
Agenda de contactos
>>>>>>> 177f7bd35ee93eccea906a6139202c3ffd2fd327
