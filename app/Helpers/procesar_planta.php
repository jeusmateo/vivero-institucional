<?php
// procesar_planta.php - Recibe el POST del formulario y llama al Controlador

ini_set('display_errors', 1);
error_reporting(E_ALL);

// 1. Cargar dependencias (Modelos, Config, Controladores)
require_once '../Config/database.php';
require_once '../Models/planta.php';
require_once '../Controllers/plantaController.php';

use app\Controllers\plantaController;

// 2. Verificar sesión (Seguridad extra)
session_start();
if (empty($_SESSION["valido"])) {
    header("location: ../Views/admin/login.php?estado=4");
    exit();
}

// 3. Instanciar Controlador
$controller = new plantaController();

// 4. Decidir qué hacer según el campo 'accion' oculto en el form
$accion = $_POST['accion'] ?? '';

if ($accion === 'guardar') {
    $controller->guardar(); // Esta función ya la tienes en tu controlador, redirige al finalizar
} elseif ($accion === 'eliminar') {
    $controller->eliminar();
} else {
    // Si llegan aquí sin acción, devolver al panel
    header("location: ../Views/admin/administrarCatalogo.html");
    exit();
}
?>