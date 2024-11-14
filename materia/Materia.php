<?php

require_once '../conexion.php';

class Materia {
    private $conn;

    public $id;
    public $nombre;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllMaterias() {
        $query = "SELECT id, nombre FROM materia";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function createMateria() {
        try {
            $query = "INSERT INTO materia (nombre) VALUES (:nombre)";
            $stmt = $this->conn->prepare($query);
            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->execute();
            return true;  // Esto indica que la materia fue creada correctamente.
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {  // Error de clave duplicada
                return "Error: Ya existe una materia con ese nombre.";
            } else {
                return "Error: " . $e->getMessage();
            }
        }
    }
    

    public function exists($nombre) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM materia WHERE nombre = :nombre");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    }
    
    public function updateMateria($id) { //Modificar
        $query = "UPDATE materia SET nombre = :nombre WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function hasAssociatedAsistencias($id) {
        $query = "SELECT COUNT(*) FROM asistencia WHERE materia_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Método para eliminar una materia
    public function deleteMateria($id) {
        $query = "DELETE FROM materia WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
}

?>