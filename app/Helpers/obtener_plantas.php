<?php
// 1. Configuración de cabeceras para JSON
header('Content-Type: application/json');

// 2. Incluir manualmente tus archivos de configuración y modelo
// Ajusta estos "require" según tu estructura de carpetas real
require_once '../Config/database.php';
require_once '../Models/planta.php';

use app\Models\planta;

try {
    // 3. Instanciar el modelo
    $modelo = new planta();

    // 4. Obtener el término de búsqueda si existe
    $busqueda = isset($_GET['search']) ? $_GET['search'] : "";

    // 5. Obtener los datos
    $datos = $modelo->buscar($busqueda);

    // 6. Devolver JSON
    echo json_encode($datos);

} catch (Exception $e) {
    // Si falla, devolver error en JSON
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
?>