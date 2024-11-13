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
    
    // Método para verificar si ya existe un alumno con el mismo DNI
    public function existeDni($dni) {
        $query = "SELECT COUNT(*) FROM " . $this->table . " WHERE dni = :dni";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':dni', $dni);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Método para crear un nuevo alumno si el DNI es único
    public function create() {
        if ($this->existeDni($this->dni)) {
            echo "Error: Ya existe un alumno con este DNI.";
            return false;
        }

        $query = "INSERT INTO " . $this->table . " (nombre, apellido, dni, fecha_nacimiento) VALUES (:nombre, :apellido, :dni, :fecha_nacimiento)";
        
        $stmt = $this->conn->prepare($query);

        // Limpiar datos
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

    // Otros métodos (read, update, delete) se podrían implementar aquí

}

