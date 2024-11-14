<?php

require_once '../conexion.php';

class Alumno {
    private $conn;
    private $table = 'alumno';

    public $id;
    public $nombre;
    public $apellido;
    public $dni;
    public $fecha_nacimiento;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAll() {
        $query = "SELECT id, nombre, apellido, dni, fecha_nacimiento FROM alumno";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function existeDni($dni) {
        $query = "SELECT COUNT(*) FROM " . $this->table . " WHERE dni = :dni";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':dni', $dni);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function create() {
        if ($this->existeDni($this->dni)) {
            echo "Error: Ya existe un alumno con este DNI.";
            return false;
        }

        $query = "INSERT INTO " . $this->table . " (nombre, apellido, dni, fecha_nacimiento) VALUES (:nombre, :apellido, :dni, :fecha_nacimiento)";
        
        $stmt = $this->conn->prepare($query);

        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellido = htmlspecialchars(strip_tags($this->apellido));
        $this->dni = htmlspecialchars(strip_tags($this->dni));
        $this->fecha_nacimiento = htmlspecialchars(strip_tags($this->fecha_nacimiento));

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':apellido', $this->apellido);
        $stmt->bindParam(':dni', $this->dni);
        $stmt->bindParam(':fecha_nacimiento', $this->fecha_nacimiento);

        if ($stmt->execute()) {
            echo "Alumno creado exitosamente.";
            return true;
        } else {
            echo "Error: No se pudo crear el alumno.";
            return false;
        }
    }

    public function update($dni) {
        $query = "UPDATE " . $this->table . " SET nombre = :nombre, apellido = :apellido, fecha_nacimiento = :fecha_nacimiento WHERE dni = :dni";
        $stmt = $this->conn->prepare($query);

        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellido = htmlspecialchars(strip_tags($this->apellido));
        $this->fecha_nacimiento = htmlspecialchars(strip_tags($this->fecha_nacimiento));

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':apellido', $this->apellido);
        $stmt->bindParam(':fecha_nacimiento', $this->fecha_nacimiento);
        $stmt->bindParam(':dni', $dni);

        if ($stmt->execute()) {
            echo "Alumno actualizado correctamente.";
            return true;
        } else {
            echo "Error: No se pudo actualizar el alumno.";
            return false;
        }
    }

    public function delete($dni) {
        $query = "DELETE FROM " . $this->table . " WHERE dni = :dni";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':dni', $dni);

        if ($stmt->execute()) {
            echo "Alumno eliminado correctamente.";
            return true;
        } else {
            echo "Error: No se pudo eliminar el alumno.";
            return false;
        }
    }
}
