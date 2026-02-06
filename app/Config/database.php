<?php
namespace app\Config;

class Database { // Cambiado a mayúscula inicial por convención
    private static $conexion = null;

    private $servidor = "localhost";
    private $usuario = "vivero";
    private $contrasena = "viveroUADY";
    private $basedatos = "vivero";

    private function __construct() {}

    public static function getConnection() {
        if (self::$conexion === null) {
            // Usamos 'new \mysqli' con barra invertida para indicar que es clase global de PHP
            self::$conexion = new \mysqli("localhost", "vivero", "viveroUADY", "vivero");

            if (self::$conexion->connect_error) {
                die("Error de conexión: " . self::$conexion->connect_error);
            }
            self::$conexion->set_charset("utf8mb4");
        }
        return self::$conexion;
    }
}