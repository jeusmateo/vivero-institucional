<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$rutaDatabase   = '../Config/database.php';
$rutaModelo     = '../Models/usuario.php';
$rutaControlador= '../Controllers/authController.php';


if (!file_exists($rutaDatabase) || !file_exists($rutaModelo) || !file_exists($rutaControlador)) {
    die("Error de rutas: No se encuentran los archivos necesarios en ../Config, ../Models o ../Controllers");
}

require_once $rutaDatabase;
require_once $rutaModelo;
require_once $rutaControlador;

use app\Controllers\AuthController;

// 3. Instanciar el controlador y ejecutar el login
try {
    $auth = new AuthController();
    $auth->login(); // Esto procesa el POST y redirige automáticamente
} catch (Exception $e) {
    die("Error crítico al iniciar sesión: " . $e->getMessage());
}
?>