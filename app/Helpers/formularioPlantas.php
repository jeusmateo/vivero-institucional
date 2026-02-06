<?php
// app/Views/admin/formularioPlantas.php

// 1. SEGURIDAD Y CONFIGURACIÓN
session_start();
if (empty($_SESSION["valido"])) {
    header("location: login.php?estado=4");
    exit();
}

require_once '../Config/database.php';
require_once '../Models/planta.php';
require_once '../Controllers/plantaController.php';

use app\Controllers\plantaController;

// 2. OBTENER DATOS (Usando el Controlador)
$controller = new plantaController();
$datos = $controller->obtenerDatosParaFormulario();

if ($datos['error']) {
    die($datos['error']);
}

// 3. DESEMPAQUETAR VARIABLES
$planta = $datos['planta'];
$familias = $datos['familias'];

// 4. CARGAR LA VISTA
// CORRECCIÓN: Asegúrate de que el archivo en Views se llame EXACTAMENTE así:
require '../Views/admin/formulario_vista.php';
?>