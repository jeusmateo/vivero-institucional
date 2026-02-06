<?php
session_start();
if (!isset($_SESSION["valido"]) || !$_SESSION["valido"]) {
    header("location: ../inicio_de_sesion.php?estado=4");
    exit();
}

global $servidor, $usuario, $contrasena, $basedatos, $carpeta_imagenes;
include 'variables.php';
include 'funciones.php';
require_once 'Service/solrIndex.php'; 

$conexion = abrir_conexion_sql();

// ... includes iniciales ...
$conexion = abrir_conexion_sql();

// FUNCIÓN CLAVE: CREA LA FAMILIA SI NO EXISTE
function obtenerIdFamilia($nombreFamilia, $conn) {
    if (empty($nombreFamilia) || $nombreFamilia === "[object Object]") {
        $nombreFamilia = "Desconocida";
    }
    $nombreFamilia = trim($nombreFamilia);
    
    // 1. Buscar
    $sql = "SELECT id_familia FROM arboles_familia WHERE nombre = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombreFamilia);
    $stmt->execute();
    $res = $stmt->get_result();
    
    if ($row = $res->fetch_assoc()) {
        return $row['id_familia']; // Ya existía
    }

    // 2. Crear
    $sqlInsert = "INSERT INTO arboles_familia (nombre) VALUES (?)";
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bind_param("s", $nombreFamilia);
    if ($stmtInsert->execute()) {
        return $conn->insert_id; // Nueva ID creada
    }
    
    // 3. Fallback (para no romper)
    return 7; // O el ID de una familia "General" que tengas
}

// Recibimos el TEXTO del input readonly
$nombreFamiliaTexto = isset($_REQUEST["nombreFamiliaTexto"]) ? $_REQUEST["nombreFamiliaTexto"] : "Desconocida";
// Obtenemos el ID mágico
$idFamiliaFinal = obtenerIdFamilia($nombreFamiliaTexto, $conexion);


// --- MANEJO DE IMÁGENES ---
$nombre_imagen_final = ''; 

// A. Subida Manual
if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == UPLOAD_ERR_OK && $_FILES["imagen"]["size"] > 0) {
    $tmp_name = $_FILES["imagen"]["tmp_name"];
    $nombre_archivo = time() . "_" . htmlentities(basename($_FILES["imagen"]["name"])); 
    $ruta_destino = "$carpeta_imagenes/$nombre_archivo";
    if (!file_exists($carpeta_imagenes)) mkdir($carpeta_imagenes, 0777, true);
    if (move_uploaded_file($tmp_name, $ruta_destino)) $nombre_imagen_final = $nombre_archivo;
} 
// B. Trefle URL
elseif (!empty($_POST['trefle_image_url'])) {
    $contenido = @file_get_contents($_POST['trefle_image_url']); 
    if ($contenido) {
        $nombre_archivo = "trefle_" . time() . ".jpg";
        $ruta_destino = "$carpeta_imagenes/$nombre_archivo";
        if (!file_exists($carpeta_imagenes)) mkdir($carpeta_imagenes, 0777, true);
        file_put_contents($ruta_destino, $contenido);
        $nombre_imagen_final = $nombre_archivo;
    }
}
// C. Edición
elseif (!empty($_REQUEST["id_planta"])) {
    $id = (int)$_REQUEST["id_planta"];
    $res = $conexion->query("SELECT nombre_imagen FROM arboles WHERE id_arbol = $id");
    if ($row = $res->fetch_assoc()) $nombre_imagen_final = $row['nombre_imagen'];
}

if (empty($nombre_imagen_final)) $nombre_imagen_final = "RSULogo.png";


// --- GUARDADO DE PLANTA ---
$nombreComun = $_REQUEST["nombreComun"];
$nombreCientifico = $_REQUEST["nombreCientifico"];
$descripcion = $_REQUEST["descripcion"];
$fruto = $_REQUEST["fruto"] ?? '';
$floracion = $_REQUEST["floracion"] ?? '';
$usos = $_REQUEST["usos"] ?? '';

$id_planta_guardada = 0;

if (empty($_REQUEST["id_planta"])) {
    // INSERT
    $stmt = $conexion->prepare("INSERT INTO arboles(nombre_cientifico, nombre_imagen, id_familia, nombre_comun, descripcion, fruto, floracion, usos) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisssss", $nombreCientifico, $nombre_imagen_final, $idFamiliaFinal, $nombreComun, $descripcion, $fruto, $floracion, $usos);
    if ($stmt->execute()) $id_planta_guardada = $conexion->insert_id;
} else {
    // UPDATE
    $id_planta_guardada = $_REQUEST["id_planta"];
    $stmt = $conexion->prepare("UPDATE arboles SET nombre_cientifico=?, nombre_imagen=?, id_familia=?, nombre_comun=?, descripcion=?, fruto=?, floracion=?, usos=? WHERE id_arbol=?");
    $stmt->bind_param("ssisssssi", $nombreCientifico, $nombre_imagen_final, $idFamiliaFinal, $nombreComun, $descripcion, $fruto, $floracion, $usos, $id_planta_guardada);
    $stmt->execute();
}

// --- SOLR ---
if ($id_planta_guardada > 0) {
    try {
        $datosParaSolr = [
            'id_arbol' => $id_planta_guardada,
            'nombre_comun' => $nombreComun,
            'nombre_cientifico' => $nombreCientifico,
            'descripcion' => $descripcion,
            'usos' => $usos,
            'nombre_imagen' => $nombre_imagen_final,
            'nombre_familia' => $nombreFamiliaTexto // Enviamos texto
        ];
        $indexer = new SolrIndex();
        $indexer->indexarPlanta($datosParaSolr);
    } catch (Throwable $e) { error_log($e->getMessage()); }
}

$conexion->close();
header("location: ../administracionVivero.php");
?>