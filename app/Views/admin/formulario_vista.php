<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="../public/Css/encabezado.css" type="text/css">
    <title>Formulario de Plantas</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f4; }
        #plantaForm { background: white; max-width: 800px; margin: 20px auto; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input[type="text"], textarea, select { width: 100%; padding: 8px; margin: 5px 0; border: 1px solid #ddd; border-radius: 4px; }
        button { padding: 10px 20px; background-color: #C79316; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #a67c12; }
        img.preview-img { max-width: 200px; display: block; margin: 10px auto; }
        .nav { list-style: none; display: flex; gap: 15px; }
        .nav a { text-decoration: none; color: #333; }
    </style>
</head>
<body>

<header id="encabezado">
    <div class="encabezado-container">
        <div class="logo-container">
            <img src="../public/Svg/logo_uady.svg" alt="logo UADY" width="80">
            <img src="../public/img/RSULogo.png" alt="logo RSU" width="80">
        </div>
        <div class="dicho-uady">
            <h4>"Luz, Ciencia y Verdad"</h4>
        </div>
        <nav>
            <ul class="nav">
                <li><a href="administrarCatalogo.html">Volver al Catálogo</a></li>
                <li><a href="../Helpers/logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </div>
</header>

<section id="planta-section">
    <br>
    <div id="plantaForm">
        
        <?php if (!empty($planta['id_arbol'])): ?>
            <form action="../../Helpers/procesar_planta.php" method="post" onsubmit="return confirm('¿Estás seguro de eliminar esta planta?');">
                <input type="hidden" name="accion" value="eliminar">
                <input type="hidden" name="id_planta" value="<?php echo $planta['id_arbol']; ?>">
                <button type="submit" style="background-color: #e74c3c;">Eliminar planta</button>
            </form>
            <hr>
        <?php endif; ?>

        <form name="forma" action="../../Helpers/procesar_planta.php" method="post" enctype="multipart/form-data">
            
            <input type="hidden" name="accion" value="guardar">
            <input type="hidden" name="id_planta" value="<?php echo $planta['id_arbol']; ?>">
            
            <h2 style="text-align: center;"><?php echo $planta['id_arbol'] ? 'Editar Planta' : 'Nueva Planta'; ?></h2>

            <label>Nombre común:</label>
            <input type="text" name="nombreComun" value="<?php echo htmlspecialchars($planta['nombre_comun']); ?>" required>

            <label>Nombre científico:</label>
            <input type="text" name="nombreCientifico" value="<?php echo htmlspecialchars($planta['nombre_cientifico']); ?>" required>

            <label>Familia:</label>
            <select name="familia" required>
                <option value="">-- Seleccione una familia --</option>
                <?php foreach ($familias as $fam): ?>
                    <?php $nombreFam = isset($fam['nombre_familia']) ? $fam['nombre_familia'] : (isset($fam['nombre']) ? $fam['nombre'] : 'Sin Nombre'); ?>
                    <?php $selected = ($fam['id_familia'] == $planta['id_familia']) ? 'selected' : ''; ?>
                    <option value="<?= $fam['id_familia'] ?>" <?= $selected ?>>
                        <?= $nombreFam ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Fruto:</label>
            <input type="text" name="fruto" value="<?php echo htmlspecialchars($planta['fruto']); ?>">

            <label>Floración:</label>
            <input type="text" name="floracion" value="<?php echo htmlspecialchars($planta['floracion']); ?>">

            <label>Descripción:</label>
            <textarea name="descripcion" rows="5"><?php echo htmlspecialchars($planta['descripcion']); ?></textarea>

            <label>Usos:</label>
            <textarea name="usos" rows="5"><?php echo htmlspecialchars($planta['usos']); ?></textarea>

            <div style="text-align: center; margin: 20px 0;">
                <?php if (!empty($planta['nombre_imagen'])): ?>
                    <p>Imagen actual:</p>
                    <img src="../../public/img/<?= $planta['nombre_imagen'] ?>" 
                    class="preview-img" 
                    alt="Imagen actual"
                    onerror="this.onerror=null; this.src='../public/img/RSULogo.png';">
                <?php else: ?>
                    <p>Sin imagen asignada</p>
                <?php endif; ?>
            </div>

            <label>Subir nueva imagen:</label>
            <input type="file" name="imagen" accept="image/*">

            <br><br>
            <button type="submit" style="width: 100%; font-size: 1.2rem;">Guardar Cambios</button>

        </form>
    </div>
</section>

</body>
</html>