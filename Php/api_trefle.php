<?php
include 'variables.php';
header('Content-Type: application/json');

if (!isset($_GET['q'])) die(json_encode(["error" => "Falta parametro q"]));

$query = urlencode($_GET['q']);

// Configuración SSL
$arrContextOptions = array(
    "ssl" => array(
        "verify_peer" => false,
        "verify_peer_name" => false,
    ),
);

// Solo hacemos UNA llamada de búsqueda (Search)
// Esto es rápido y suficiente para obtener nombre, familia e imagen
$url = "https://trefle.io/api/v1/plants/search?token=$trefle_token&q=$query&limit=1";

$response = @file_get_contents($url, false, stream_context_create($arrContextOptions));

if ($response) {
    echo $response; // Devolvemos el JSON tal cual llega de Trefle
} else {
    echo json_encode(["data" => []]);
}
?>