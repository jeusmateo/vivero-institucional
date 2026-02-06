<?php
session_start();
if (!isset($_SESSION["valido"]) || !$_SESSION["valido"]) {
    header("location: inicio_de_sesion.php?estado=4");
    exit();
}

include 'Php/funciones.php';

// Filtros de seguridad
$accion = filter_input(INPUT_GET, 'accion', FILTER_SANITIZE_STRING);
$id_planta = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Inicializamos el array con 9 espacios vacíos para evitar errores al crear nueva planta
$campos = array_fill(0, 9, '');

// SOLO SI ESTAMOS EDITANDO (Hay acción 'editar' y un ID válido)
if ($accion == 'editar' && $id_planta > 0) {
    
    // --- CORRECCIÓN CLAVE BASADA EN TU SQL ---
    // Usamos la vista 'arbol_descripcion' en lugar de la tabla 'arboles'.
    // Esto garantiza que 'familia' sea el TEXTO (ej: Fabaceae) y no el ID (ej: 87).
    
    $sql = "SELECT 
                nombre_comun,       -- [0]
                nombre_cientifico,  -- [1]
                familia,            -- [2] ¡AQUÍ ESTÁ EL CAMBIO! (Trae el nombre real de la vista)
                fruto,              -- [3]
                floracion,          -- [4]
                descripcion,        -- [5]
                usos,               -- [6]
                nombre_imagen,      -- [7]
                id_arbol            -- [8]
            FROM arbol_descripcion 
            WHERE id_arbol = ?";

    $conexion = abrir_conexion_sql();
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('i', $id_planta);
    $stmt->execute();

    $resultado = $stmt->get_result();
    if ($fila = $resultado->fetch_row()) {
        $campos = $fila; 
        // Ahora $campos[2] contiene "Fabaceae" (Texto), no "87" (ID)
    }
    
    $stmt->close();
    $conexion->close();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/encabezado.css" type="text/css">
    <link rel="stylesheet" href="Css/formularioPlantas.css" type="text/css">
    <title>Formulario de Plantas</title>
</head>

<body>
    <header id="encabezado">
        <div class="encabezado-container">
            <div class="logo-container">
                <img src="Recursos/Svg/logo_uady.svg" alt="logo UADY" class="logo">
                <img src="Recursos/img/RSULogo.png" alt="logo RSU" class="logo">
            </div>
            <div class="dicho-uady">
                <h4>"Luz, Ciencia y Verdad"</h4>
            </div>

            <nav>
                <ul class="nav">
                    <li><a href="index.html">Inicio</a></li>
                    <li><a href="">Catálogo</a></li>
                    <li><a href="contacto.html">Contacto</a></li>
                    <li><a href="administracionVivero.php">Volver al Panel</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="planta-section">
        <br><br><br><br>
        <div id="plantaForm">
            <form action="Php/eliminarPlanta.php" method="post" onsubmit="return confirm('¿Estás seguro de eliminar esta planta?');">
                <input type="hidden" name="id_planta" value="<?php echo $campos[8] ?>">
                <?php echo empty($campos[0]) ? "" : '<button style="background-color: #dc3545;">Eliminar planta</button>' ?>
            </form>
            
            <form name="forma" action="Php/guardar.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_planta" value="<?php echo $campos[8] ?>">
                
                <h2><?php echo empty($campos[0]) ? "Registro de nueva planta" : "Edición de planta"; ?></h2>
                
                <table align="center">
                    <tr>
                        <td><label for="nombreComun">Nombre común de la planta:</label></td>
                        <td><input type="text" id="nombreComun" name="nombreComun" placeholder="Nombre común"
                                value="<?php echo $campos[0] ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="nombreCientifico">Nombre científico:</label></td>
                        <td style="display: flex; gap: 10px; align-items: center;">
                            <input type="text" id="nombreCientifico" name="nombreCientifico"
                                placeholder="Ej: Monstera deliciosa" value="<?php echo $campos[1] ?>">

                            <button type="button" onclick="autocompletarTrefle()" 
                                    style="background-color: #28a745; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 4px;">
                                Autocompletar
                            </button>
                        </td>
                    </tr>

                    <input type="hidden" id="trefle_image_url" name="trefle_image_url" value="">
                    
                    <tr>
                        <td><label for="nombreFamiliaTexto">Familia (Automático):</label></td>
                        <td>
                            <input type="text" id="nombreFamiliaTexto" name="nombreFamiliaTexto"
                                placeholder="Se llenará automáticamente..."
                                readonly
                                style="background-color: #f0f0f0; color: #555; cursor: not-allowed;"
                                value="<?php echo isset($campos[2]) ? $campos[2] : ''; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td><label for="fruto">Fruto de la planta:</label></td>
                        <td><input type="text" id="fruto" name="fruto" placeholder="Fruto" value="<?php echo $campos[3] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td><label for="floracion">Floracion de la planta:</label></td>
                        <td><input type="text" id="floracion" name="floracion" placeholder="Floracion"
                                value="<?php echo $campos[4] ?>"></td>
                    </tr>
                </table>

                <label for="descripcion">Descripcion de la planta</label>
                <textarea id="descripcion" name="descripcion" placeholder="Descripción de la planta"
                    rows="5"><?php echo $campos[5] ?></textarea>

                <label for="usos">Usos de la planta</label>
                <textarea name="usos" id="usos" rows="5"><?php echo $campos[6] ?></textarea>

                <div id="dropZone">
                    Arrastra aquí una imagen
                </div>
                
                <div id="preview">
                    <?php if (!empty($campos[7]) && $campos[7] !== 'RSULogo.png'): ?>
                        <img src="data/<?php echo $campos[7]; ?>" alt="Imagen de la planta" style="max-width: 100%; height: auto;">
                    <?php else: ?>
                        <p style="color: #888;">Sin imagen seleccionada</p>
                    <?php endif; ?>
                </div>

                <input type="hidden" name="MAX_FILE_SIZE" value="16777219" />
                
                <input type="file" id="fileInput" name="imagen" style="display: none;">

                <button type="submit" style="margin-top: 20px;">Enviar</button>

            </form>
        </div>

        <script src="Js/formularioPlanta.js"></script>
    </section>

</body>
</html>