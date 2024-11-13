<?php
class Asistencia {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($alumno_id, $materia_id, $fecha, $estado, $profesor_id) {
        $query = "INSERT INTO asistencia (alumno_id, materia_id, fecha, estado, profesor_id) VALUES (:alumno_id, :materia_id, :fecha, :estado, :profesor_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':alumno_id', $alumno_id);
        $stmt->bindParam(':materia_id', $materia_id);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':profesor_id', $profesor_id);
        return $stmt->execute();
    }

    public function update($id, $estado) {
        $query = "UPDATE asistencia SET estado = :estado WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM asistencia WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    
    // Función para obtener una lista de asistencias según criterios
    public function getAll($materia_id) {
        $query = "SELECT * FROM asistencia WHERE materia_id = :materia_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':materia_id', $materia_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>