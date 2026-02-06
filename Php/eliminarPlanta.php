<?php
// Archivo: Php/eliminarPlanta.php
session_start();

// 1. SEGURIDAD: Verificar si el usuario es administrador
if (!isset($_SESSION["valido"]) || !$_SESSION["valido"]) {
    header("location: ../inicio_de_sesion.php?estado=4");
    exit();
}

include 'funciones.php';
include 'variables.php'; // Asegúrate de tener aquí tus config de Solr si usas variables externas

// 2. RECIBIR EL ID (Soporta POST del formulario y GET del enlace directo)
$id_planta = filter_input(INPUT_POST, 'id_planta', FILTER_VALIDATE_INT);
if (!$id_planta) {
    $id_planta = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
}

if (!$id_planta) {
    die("Error: ID no válido.");
}

$conexion = abrir_conexion_sql();

// 3. OBTENER NOMBRE DE LA IMAGEN (Antes de borrar el registro)
$sqlFoto = "SELECT nombre_imagen FROM arboles WHERE id_arbol = ?";
$stmtFoto = $conexion->prepare($sqlFoto);
$stmtFoto->bind_param("i", $id_planta);
$stmtFoto->execute();
$stmtFoto->bind_result($nombre_imagen);
$stmtFoto->fetch();
$stmtFoto->close();

// 4. BORRAR REGISTRO DE MYSQL
$sqlDelete = "DELETE FROM arboles WHERE id_arbol = ?";
$stmtDelete = $conexion->prepare($sqlDelete);
$stmtDelete->bind_param("i", $id_planta);

if ($stmtDelete->execute()) {
    
    // 5. BORRAR IMAGEN FÍSICA (Si existe y no es el logo)
    if ($nombre_imagen && $nombre_imagen !== "RSULogo.png") {
        $ruta_foto = "../data/" . $nombre_imagen;
        if (file_exists($ruta_foto)) {
            unlink($ruta_foto); // Borra el archivo
        }
    }

    // 6. BORRAR DE SOLR (Sincronización automática)
    // Esto evita que siga apareciendo como "fantasma" en el catálogo
    $solr_core = 'buscador_plantas'; 
    $url_delete = "http://localhost:8983/solr/$solr_core/update?commit=true";
    
    // XML para borrar por ID
    $data_delete = json_encode(['delete' => ['id' => $id_planta]]);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_delete);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_delete);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);

    // Redireccionar al panel con éxito
    header("Location: ../administracionVivero.php?mensaje=eliminado");

} else {
    echo "Error al eliminar de MySQL: " . $conexion->error;
}

$conexion->close();
?>