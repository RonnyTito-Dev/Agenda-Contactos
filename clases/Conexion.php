<?php

class Conexion {

    private $host = "localhost";
    private $nombreDB = "agenda_contactos"; //nombre de tu base de datos
    private $usuario = "root"; //el usuario por defecto de XAMPP es root
    private $contrasenia = ""; //la contraseña por defecto de XAMPP es una cadena vacia

    private $conexionPDO;

    // Metodo Constructor (Conectar a la Base de Datos)
    public function conectar() {
        
        if($this -> conexionPDO === null) {

            try {

                $this -> conexionPDO = new PDO("mysql:host=" . $this -> host . ";dbname=" . $this -> nombreDB, $this -> usuario, $this -> contrasenia);

                $this -> conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // echo "<span style = 'color:green'> Conexión con la BD establecida </span> <br>";

            } catch (PDOException $e) {

                echo "Error al conectarse a la Base de Datos: <br>" . 
                     "Mensaje: " . $e->getMessage() . " <br> " .
                     "Línea: " . $e->getLine();
            }
        }

        return $this -> conexionPDO;

    }

    // Metodo Obtener Conexion DB
    public function obtenerConexion(){

        if($this -> conexionPDO === null) {

            $this -> conectar();

        } 

        return $this -> conexionPDO;

    }

    //Metodo Desconectar Conexion DB
    public function desconectar(){

        $this -> conexionPDO = null;
        echo "<span style = 'color:red'> Conexión con la DB cerrada </span> <br>";

    }

}

?>
