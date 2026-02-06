<?php
namespace app\Models;

use app\Config\Database;

class Usuario {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function autenticar($usuario, $inputContrasena) {
       
        $sql = "SELECT id_usuario, usuario, contrasena, nombre FROM usuarios WHERE usuario = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($fila = $resultado->fetch_assoc()) {


            // VERIFICACIÓN
            // Comparación directa porque tus contraseñas no están encriptadas MANTENIMIENTO PREVENTIVO.
            if ($inputContrasena === $fila['contrasena']) {
                
            
                unset($fila['contrasena']);
                return $fila;
            }
        }
        
        return false;
    }
}