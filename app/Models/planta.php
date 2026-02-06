<?php
namespace app\Models;

use app\Config\Database;

class Planta {

    private $db;

    public function __construct() {
        $this->db = Database::getConnection(); // Tu singleton
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM arboles WHERE id_arbol = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    public function buscar($termino = "") {
        $sql = "SELECT * FROM arboles";
        
        // Si hay término de búsqueda, filtramos
        if (!empty($termino)) {
            $sql .= " WHERE nombre_cientifico LIKE ? OR nombre_comun LIKE ?";
            $stmt = $this->db->prepare($sql);
            $busqueda = "%" . $termino . "%";
            $stmt->bind_param("ss", $busqueda, $busqueda);
        } else {
            // Si no hay búsqueda, traemos todo
            $stmt = $this->db->prepare($sql);
        }

        $stmt->execute();
        $resultado = $stmt->get_result();
        
        // Convertimos el resultado de MySQL a un Array de PHP
        $plantas = [];
        while ($fila = $resultado->fetch_assoc()) {
            $plantas[] = $fila;
        }
        return $plantas;
    }

    public function crear($datos) {
        $sql = "INSERT INTO arboles(nombre_cientifico, nombre_imagen, id_familia, nombre_comun, descripcion, fruto, floracion, usos) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssisssss", 
            $datos['nombre_cientifico'],
            $datos['nombre_imagen'],
            $datos['id_familia'],
            $datos['nombre_comun'],
            $datos['descripcion'],
            $datos['fruto'],
            $datos['floracion'],
            $datos['usos']
        );
        return $stmt->execute();
    }

    public function actualizar($id, $datos) {
        $sql = "UPDATE arboles SET 
                nombre_cientifico = ?, 
                nombre_imagen = ?, 
                id_familia = ?, 
                nombre_comun = ?, 
                descripcion = ?, 
                fruto = ?, 
                floracion = ?, 
                usos = ? 
                WHERE id_arbol = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssisssssi", 
            $datos['nombre_cientifico'],
            $datos['nombre_imagen'],
            $datos['id_familia'],
            $datos['nombre_comun'],
            $datos['descripcion'],
            $datos['fruto'],
            $datos['floracion'],
            $datos['usos'],
            $id
        );
        return $stmt->execute();
    }

    public function eliminar($id) {
        $sql = "DELETE FROM arboles WHERE id_arbol = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public function obtenerFamilias() {
    $sql = "SELECT id_familia, nombre_familia FROM arboles_familia";
    $resultado = $this->db->query($sql);
    
    $familias = [];
    while ($fila = $resultado->fetch_assoc()) {
        $familias[] = $fila;
    }
    return $familias;
}
}