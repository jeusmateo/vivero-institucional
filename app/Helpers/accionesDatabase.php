<?php
// MOVER ESTE ARCHIVO A app/Helpers y cambiar las rutas que utilicen esta 

function EjecutarSQL ($servidor, $usuario, $contrasena, $basedatos, $sentenciaSQL) {
	$conexion = mysqli_connect($servidor, $usuario, $contrasena, $basedatos);
	if (!$conexion) {
    	die("Fallo: " . mysqli_connect_error());
	}

	$resultado = mysqli_query($conexion, $sentenciaSQL);
	mysqli_close($conexion);

}

function ConsultarSQL ($servidor, $usuario, $contrasena, $basedatos, $sentenciaSQL) {
	$conexion = mysqli_connect($servidor, $usuario, $contrasena, $basedatos);
	if (!$conexion) {
    	die("Fallo: " . mysqli_connect_error());
	}

	$resultado = mysqli_query($conexion, $sentenciaSQL);

	for ($registros = array (); $fila = mysqli_fetch_assoc($resultado); $registros[] = $fila);

	mysqli_close($conexion);

	return $registros;
}



function ejecutar_sql_configurado($sentenciaSQL): array {
    $mysqli=abrir_conexion_sql();

    $resultado = $mysqli->query($sentenciaSQL);
    $mysqli->close();

    $registro = array();

    foreach ($resultado as $fila){
        $registro[] = $fila;
    }

    return $registro;
}
