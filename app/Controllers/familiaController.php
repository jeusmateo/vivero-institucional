<?php
namespace app\Controllers;

use app\Models\familia;

class familiaController {

    public function __construct() {
        // 1. SEGURIDAD CENTRALIZADA: 
        // Si no está logueado, se muere aquí. No tienes que repetirlo en cada función.
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (empty($_SESSION["valido"])) {
            header("location: /login?estado=4");
            exit();
        }
    }

    public function guardar() {
        // 1. VALIDACIÓN
        if (empty($_POST['nombreFamilia'])) {
            // Si está vacío, lo devolvemos al formulario
            header("location: /admin/familias/crear?error=vacio");
            exit();
        }

        // 2. OBTENCIÓN DE DATOS
        // htmlentities es para mostrar en HTML, no para guardar en BD.
        // Para BD usamos sentencias preparadas, así que con trim basta aquí.
        $nombre = trim($_POST['nombreFamilia']);

        // 3. LLAMADA AL MODELO
        $familiaModel = new Familia();
        $familiaModel->crear($nombre);

        // 4. REDIRECCIÓN
        header("location: /admin/familias?success=creado");
        exit();
    }
    
    public function eliminar() {
        // 2. VALIDACIÓN HTTP
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            // Evitamos que borren cosas pegando la URL en el navegador (GET)
            header('location: /admin/familias'); 
            exit();
        }

        if (empty($_POST["familia"])) {
            header('location: /admin/familias?error=seleccion_vacia');
            exit();
        }

        // 3. LLAMADA AL MODELO
        $familiaModel = new Familia();
        
        // Tu lógica original soportaba eliminar varios (array)
        foreach ($_POST["familia"] as $item) {
            $id = filter_var($item, FILTER_VALIDATE_INT);
            if ($id) {
                $familiaModel->eliminar($id);
            }
        }

        // 4. RESPUESTA
        header('location: /admin/familias?success=1');
        exit();
    }
}