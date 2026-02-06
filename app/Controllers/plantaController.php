<?php
namespace app\Controllers;

use app\Models\planta; // Importamos el Modelo que contiene el SQL

class plantaController {

    private $carpeta_imagenes;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (empty($_SESSION["valido"])) {
            header("location: /login?estado=4");
            exit();
        }

        $this->carpeta_imagenes = dirname(dirname(__DIR__)) . '/public/img';
    }


   

    public function guardar() {
        // 1. Validaciones Básicas
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;
        
        if ($this->isFieldsEmpty()) {
             header("location: /admin/plantas/form?error=campos_vacios");
             exit();
        }

        $id = !empty($_POST["id_planta"]) ? (int)$_POST["id_planta"] : null;
        $plantaModel = new Planta();

        // 2. Lógica de Imagen (El punto crítico)
        $nombreImagenFinal = '';

        // ¿El usuario subió una imagen nueva?
        if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == UPLOAD_ERR_OK && $_FILES["imagen"]["size"] > 0) {
            $nombreImagenFinal = $this->subirImagen($_FILES["imagen"]);
            if (!$nombreImagenFinal) {
                header("location: /admin/plantas/form?error=error_subida");
                exit();
            }
        } else {
            // No subió imagen nueva. 
            if ($id) {
                // Si es EDICIÓN, recuperamos la imagen que ya tenía en BD
                $plantaActual = $plantaModel->obtenerPorId($id);
                $nombreImagenFinal = $plantaActual['nombre_imagen'];
            } else {
                // Si es CREACIÓN, la imagen es obligatoria
                header("location: /admin/plantas/form?error=imagen_requerida");
                exit();
            }
        }

        // 3. Preparar Datos para el Modelo
        // Nota: htmlentities es mejor usarlo al MOSTRAR (View), no al guardar. 
        // Pero mantengo tu lógica de "limpieza" básica.
        $datos = [
            'nombre_cientifico' => trim($_POST["nombreCientifico"]),
            'nombre_imagen'     => $nombreImagenFinal,
            'id_familia'        => (int)$_POST["familia"],
            'nombre_comun'      => trim($_POST["nombreComun"]),
            'descripcion'       => trim($_POST["descripcion"]),
            'fruto'             => trim($_POST["fruto"]),
            'floracion'         => trim($_POST["floracion"]),
            'usos'              => trim($_POST["usos"])
        ];

        // 4. Guardar o Actualizar
        if ($id) {
            $plantaModel->actualizar($id, $datos);
        } else {
            $plantaModel->crear($datos);
        }

        header("location: /admin/vivero"); // O administracionVivero.php
        exit();
    }

    // --- Métodos Privados de Ayuda ---

    private function isFieldsEmpty() {
        return empty($_POST["nombreComun"]) || empty($_POST["nombreCientifico"]) ||
               empty($_POST["familia"]) || empty($_POST["fruto"]) ||
               empty($_POST["floracion"]) || empty($_POST["descripcion"]) ||
               empty($_POST["usos"]);
    }

    private function subirImagen($archivo) {
        // Asegurar que existe el directorio
        if (!file_exists($this->carpeta_imagenes)) {
            mkdir($this->carpeta_imagenes, 0777, true);
        }

        $nombre_archivo = basename($archivo["name"]);
        // IMPORTANTE: Deberías sanitizar el nombre del archivo para evitar duplicados o caracteres raros.
        // Por ahora mantenemos tu lógica simple:
        $ruta_destino = $this->carpeta_imagenes . '/' . $nombre_archivo;

        if (move_uploaded_file($archivo["tmp_name"], $ruta_destino)) {
            return $nombre_archivo; // Retornamos solo el nombre para la BD
        }
        return false;
    }
    
    public function eliminar() {
        // 1. Validar que la petición sea POST (Seguridad básica)
        // Evita que alguien borre cosas pegando una URL en el navegador.
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("location: /administracion");
            exit();
        }

        // 2. Saneamiento y Validación de entrada
        // Reemplaza tu filter_input suelto.
        $id = filter_input(INPUT_POST, 'id_planta', FILTER_VALIDATE_INT);

        if (!$id) {
            // Si el ID no es un entero válido, abortamos y notificamos error.
            header("location: /administracion?error=id_invalido");
            exit();
        }

        // 3. Delegación al Modelo (Aquí desaparece tu código SQL)
        // Instanciamos el modelo y le pasamos el ID limpio.
        $modelo = new Planta();
        $exito = $modelo->eliminar($id); // Este método contiene el "DELETE FROM arboles..."

        // 4. Respuesta al usuario
        if ($exito) {
            header("location: /administracion?mensaje=planta_eliminada");
        } else {
            header("location: /administracion?error=error_borrando_db");
        }
        exit();
    }
}