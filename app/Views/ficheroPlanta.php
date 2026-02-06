<?php
// ESTE ARCHIVO TAMBIEN SE TENDRIA QUE MOVER DE LA VISTA
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. Importamos tu Modelo y Base de Datos (MVC)
// Asumimos que ficheroPlanta.php está en app/Views/
require_once '../Config/database.php';
require_once '../Models/planta.php';

use app\Models\Planta;

// 3. Obtener ID y validar
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

// Inicializamos variables vacías por seguridad
$planta = [
    'nombre_comun' => 'Planta no encontrada',
    'nombre_cientifico' => '',
    'nombre_imagen' => '',
    'descripcion' => '',
    'fruto' => '',
    'floracion' => '',
    'usos' => '',
    'id_familia' => '' // Nota: Tu tabla 'arboles' tiene id_familia, no el nombre.
];

if ($id) {
    try {
        // Usamos el MODELO que ya arreglamos, en lugar de escribir SQL aquí
        $modelo = new Planta();
        $resultado = $modelo->obtenerPorId($id);
        
        if ($resultado) {
            $planta = $resultado;
        }
    } catch (Exception $e) {
        die("Error al cargar la planta: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?php echo $planta['nombre_comun']; ?> | Vivero Institucional</title>
    
    <link href="../public/Css/encabezado.css" rel="stylesheet"> 
    
    <style>
        /* Pego tus estilos aquí para asegurar que se vean */
        body { font-family: sans-serif; }
        
        /* Ajustes básicos de layout para que no se vea roto si falta el CSS externo */
        #ficha-planta { display: flex; flex-direction: column; align-items: center; padding: 20px; }
        #planta-container { display: flex; gap: 40px; flex-wrap: wrap; justify-content: center; }
        #imagen-planta { position: relative; max-width: 500px; }
        #imagen-planta img { width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.2); }
        #descripcion-planta { max-width: 600px; text-align: justify; }
        
        button {
            background-color: #C79316;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        #boton-descarga { margin-top: 10px; }
        
        h1 { color: #2c3e50; }
        h2 { color: #7f8c8d; font-style: italic; }
        h3 { color: #C79316; border-bottom: 2px solid #C79316; display: inline-block; margin-top: 20px; }
    </style>
</head>
<body>

<header id="encabezado">
    <div class="encabezado-container">
        <div class="logo-container" style="display: flex; gap: 20px; padding: 10px;">
            <img alt="logo UADY" class="logo" width="100" src="../public/Svg/logo_uady.svg">
            <img alt="logo RSU" class="logo" width="100" src="../public/img/RSULogo.png">
        </div>
        
        <div class="lema-uady">
            <h4>"Luz, Ciencia y Verdad"</h4>
        </div>

        <nav>
            <ul class="nav">
                <li><a href="home/index.html">Inicio</a></li> 
                <li><a href="home/catalogo.html">Catálogo</a></li>
                <li><a href="home/contacto.html">Contacto</a></li>
            </ul>
        </nav>
    </div>
</header>

<main>
    <?php if (!$id || !$resultado): ?>
        <h1 style="text-align:center; margin-top:50px;">Planta no encontrada o ID inválido.</h1>
    <?php else: ?>
        <div id="ficha-planta">
            <div id="titulo-planta" style="text-align: center;">
                <h1><?php echo htmlspecialchars($planta['nombre_comun']); ?></h1>
                <h2><?php echo htmlspecialchars($planta['nombre_cientifico']); ?></h2>
            </div>

            <div id="planta-container">
                <div id="imagen-planta">
                    <img id="imgPlanta"
                         src="../public/img/<?php echo $planta['nombre_imagen']; ?>" 
                         alt="<?php echo $planta['nombre_cientifico']; ?>"
                         onerror="this.onerror=null;this.src='../public/img/RSULogo.png';">
                    
                    <br>
                    <a href="../public/img/<?php echo $planta['nombre_imagen']; ?>" download="<?php echo $planta['nombre_imagen']; ?>">
                        <button id="boton-descarga">Descargar Imagen</button>
                    </a>
                </div>

                <div id="descripcion-planta">
                    <h3>Familia</h3>
                    <p><?php echo $planta['id_familia']; ?></p>

                    <h3>Descripción</h3>
                    <p><?php echo nl2br(htmlspecialchars($planta['descripcion'])); ?></p>

                    <h3>Fruto</h3>
                    <p><?php echo htmlspecialchars($planta['fruto']); ?></p>

                    <h3>Floración</h3>
                    <p><?php echo htmlspecialchars($planta['floracion']); ?></p>

                    <h3>Usos</h3>
                    <p><?php echo htmlspecialchars($planta['usos']); ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>
</main>

<script src="../public/Js/ajax.js"></script>

</body>
</html>