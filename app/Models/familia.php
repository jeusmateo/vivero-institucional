<?php
namespace app\Models;

// Asumimos que tienes una clase Database wrapper (lo veremos luego)
use app\Config\Database; 

class Familia {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection(); // Tu singleton
    }

    public function eliminar($id) {
        $sql = "DELETE FROM arboles_familia WHERE id_familia = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function crear($nombre) {
        // CORRECCIÓN DE SEGURIDAD:
        // En lugar de "VALUES ('$nombre')", usamos un marcador "?"
        $sql = "INSERT INTO arboles_familia (nombre) VALUES (?)";
        
        $stmt = $this->db->prepare($sql);
        
        // 's' indica que el parametro es String
        $stmt->bind_param("s", $nombre); 
        
        return $stmt->execute();
    }
}