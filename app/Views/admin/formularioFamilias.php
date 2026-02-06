<?php
// NO ESTA IMPLEMENTADO, NO SE PUEDEN AGREGAR FAMILIAS DESDE LA INTERFAZ ACTUALMENTE
session_start();
if (!isset($_SESSION["valido"]) || !$_SESSION["valido"]) {
    header("location: inicio_de_sesion.php?estado=4");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de familias</title>
    <link rel="stylesheet" href="Css/encabezado.css" type="text/css">
    <link rel="stylesheet" href="Css/registroFamilias.css" type="text/css">
</head>
<body>

<header id="encabezado">
    <div class="encabezado-container">
        <div class="logo-container">
            <img src="Recursos/Svg/logo_uady.svg" alt="logo UADY" class="logo">
            <img src="Recursos/img/RSULogo.png" alt="logo RSU" class="logo">
        </div>

        <div  class="dicho-uady">
            <h4>"Luz, Ciencia y Verdad"</h4>
        </div>

        <nav>
            <ul class="nav">
            </ul>
        </nav>
        
    </div>
</header>

<div id="blankSpace"></div>

<table width=100% cellpadding=0 cellspacing=0>
    <tr align="center">
        <td>
        <h1>REGISTRO DE FAMILIAS<h1>
        </td>
    </tr>
    <tr>
        <td>
            <div id="contenedorFormFamilias">
                <form action="Php/guardarFamilia.php" method="post">
                    <label for="nombreFamilia">Nombre de la familia: </label>
                    <input type="text" name="nombreFamilia" id="nombreFamilia">
                    <input type="submit" value="Añadir">
                </form>
            </div>
            <br>
            <br>
            <br>
        </td>
    </tr>
    <tr>
        <td>
        <div id="contenedorTablaFamilias">
        <label><b>TABLA DE FAMILIAS DE PLANTAS</b></label>
        <br>
        <br>
        <form action="Php/eliminarFamilia.php" method="post">
            <table id="tabla-familias" border=1 cellpadding=2 cellspacing=0 width="60%">
                <tr class="tableHeader" align="left" bgcolor="lightgray">
                    <td></td>
                    <th colspan="2">Nombre</th>
                </tr>
                <?php

                include 'Php/funciones.php';

                $sql = 'SELECT id_familia, nombre FROM arboles_familia';

                $resultado = ejecutar_sql_configurado($sql);

                foreach ($resultado as $fila) {
                    echo "<tr><td><input type='checkbox' name='familia[]' value='$fila[id_familia]'></td><td>$fila[nombre]</td></tr>\n";
                }

                ?>
            </table>
            <p><input type="submit" value="Eliminar"></p>
        </form>
        </div>
        </td>

    </tr>
</table>

</body>
</html>