<?php

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
//var_dump($id);

$familia = '';
$nombre_imagen = '';
$nombre_cientifico = '';
$nombre_comun = '';
$descripcion = '';
$fruto = '';
$floracion = '';
$usos = '';

if ($id) {
    $sql = "SELECT familia, 
               nombre_imagen, 
               nombre_cientifico, 
               nombre_comun, 
               descripcion, 
               fruto, 
               floracion, 
               usos from arbol_descripcion WHERE id_arbol = ?";

    include 'Php/funciones.php';
    $conexion = abrir_conexion_sql();

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $stmt->bind_result(
        $familia,
        $nombre_imagen,
        $nombre_cientifico,
        $nombre_comun,
        $descripcion,
        $fruto,
        $floracion,
        $usos
    );

    $stmt->fetch();

}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Fichero(ejemplo) | Vivero Institucional</title>
    <link href="Css/FicheroPlanta.css" rel="stylesheet">
    <style>
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

        #boton-descarga{
            position: absolute;
            bottom: 20px;
            left: 20px;
        }

    </style>
</head>
<body>
<header id="encabezado">
    <div class="encabezado-container">
        <div class="logo-container">
            <img alt="logo UADY" class="logo" src="Recursos/Svg/logo_uady.svg">
            <img alt="logo RSU" class="logo" src="Recursos/img/RSULogo.png">
        </div>
        <div class="lema-uady">
            <h4>"Luz, Ciencia y Verdad"</h4>
        </div>
        <nav>
            <ul class="nav">
                <li><a href="index.html">Inicio</a></li>
                <li><a href="catalogo.html">Catálogo</a></li>
                <li><a href="contacto.html">Contacto</a></li>
            </ul>
        </nav>
    </div>
</header>
<main>
    <div id="ficha-planta">
        <div id="titulo-planta">
                <pre>





                </pre>
            <h1><?php echo $nombre_comun ?></h1>
            <h2><?php echo $nombre_cientifico ?></h2>
        </div>
        <div id="planta-container">
            <div id="imagen-planta">
                <a href="data/<?php echo $nombre_imagen ?>" download="<?php echo $nombre_imagen ?>"><button id="boton-descarga">Descargar</button></a>
                <img alt="" height="700" src="data/<?php echo $nombre_imagen ?>" width="600">
            </div>
            <div id="descripcion-planta">
                <h3>Familia</h3>
                <p><?php echo $familia ?></p>
                <h3>Descripcion</h3>
                <p><?php echo $descripcion ?></p>
                <h3>Fruto</h3>
                <p><?php echo $fruto ?></p>
                <h3>Floracion</h3>
                <p><?php echo $floracion ?></p>
                <h3>Usos</h3>
                <p><?php echo $usos ?></p>
            </div>
        </div>
    </div>
</main>

<script src="Js/ajax.js"></script>

<script>
    window.onload = () => {
        const queryString = window.location.search;
        console.log(queryString);

    }

</script>

</body>

</html>
