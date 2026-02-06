<?php
// Archivo: Php/leer.php
include 'funciones.php';
header('Content-Type: application/json');

$conexion = abrir_conexion_sql();
$busqueda = isset($_GET['search']) ? $conexion->real_escape_string($_GET['search']) : '';

$sql = "SELECT * FROM arbol_descripcion";

if ($busqueda != '') {
    // FILTRO DE BÚSQUEDA
    $sql .= " WHERE nombre_comun LIKE '%$busqueda%' 
              OR nombre_cientifico LIKE '%$busqueda%' 
              OR familia LIKE '%$busqueda%'";
              
    // --- SIMULACIÓN DE RELEVANCIA EN MYSQL ---
    // 1. Coincidencia exacta primero
    // 2. Empieza con la búsqueda segundo
    // 3. El resto después
    $sql .= " ORDER BY 
              CASE 
                WHEN nombre_cientifico LIKE '$busqueda' THEN 1
                WHEN nombre_comun LIKE '$busqueda' THEN 2
                WHEN nombre_cientifico LIKE '$busqueda%' THEN 3
                WHEN nombre_comun LIKE '$busqueda%' THEN 4
                ELSE 5
              END, nombre_cientifico ASC";
} else {
    // SIN BÚSQUEDA: Orden Alfabético (A-Z) idéntico a Solr
    $sql .= " ORDER BY nombre_cientifico ASC";
}

$resultado = $conexion->query($sql);

$plantas = array();
while ($row = $resultado->fetch_assoc()) {
    $plantas[] = $row;
}

echo json_encode($plantas);
$conexion->close();
?>