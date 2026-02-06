<?php
// Archivo: Php/buscarSolr.php
ob_start();
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
error_reporting(0);
ini_set('display_errors', 0);

$solr_host = 'localhost';
$solr_port = '8983';
$solr_core = 'buscador_plantas';

// --- CONFIGURACIÓN DE LÍMITE ---
// Aquí defines cuántas plantas quieres mostrar al principio.
// Pon 15, 20 o el número que gustes.
$limite = 15; 

$busqueda = isset($_GET['q']) ? trim($_GET['q']) : "";
$sort = ""; 

try {
    if (empty($busqueda)) {
        $querySolr = "*:*";
        // SIN BÚSQUEDA: Ordenamos Alfabéticamente (A-Z)
        $sort = "&sort=nombre_cientifico+asc"; 
    } else {
        $termino = urlencode($busqueda);
        // Búsqueda inteligente
        $querySolr = "nombre_comun:*$termino* OR nombre_cientifico:*$termino* OR descripcion:*$termino*";
        // CON BÚSQUEDA: Usamos relevancia (sin sort explícito)
        $sort = ""; 
    }

    // CAMBIO AQUÍ: Usamos la variable $limite en el parámetro 'rows'
    $url = "http://$solr_host:$solr_port/solr/$solr_core/select?q=" . urlencode($querySolr) . "&wt=json&rows=$limite" . $sort;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $respuesta = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    ob_clean();

    if ($httpCode != 200 || !$respuesta) {
        echo json_encode([]);
        exit();
    }

    $jsonSolr = json_decode($respuesta, true);
    if (isset($jsonSolr['response']['docs'])) {
        echo json_encode($jsonSolr['response']['docs']);
    } else {
        echo json_encode([]);
    }

} catch (Exception $e) {
    ob_clean();
    echo json_encode([]);
}
exit();
?>