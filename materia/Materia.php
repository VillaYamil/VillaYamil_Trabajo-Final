<?php

// require_once '../conexion.php';

// class Materia 
    //private $conn;
    //private $table = 'materia';

    // public $id;
    // public $nombre;

    // // public function __construct($db) {
    // //     $this->conn = $db;
    // // }

    // // Crear una nueva materia
    // public function create() {
    //     $query = "INSERT INTO materia (nombre) VALUES (:nombre)";

    //     $stmt = $conn->prepare($query);
    //     //$this->id = htmlspecialchars(strip_tags($this->id));
    //     $this->nombre = htmlspecialchars(strip_tags($this->nombre));
    //     $stmt->bindParam(':nombre',$this->nombre);

    //     return $stmt->execute();
    

    // // Obtener el nombre de la materia
    // $sqlMateria = "SELECT nombre FROM materia WHERE id = :materia_id";
    // $stmtMateria = $pdo->prepare($sqlMateria);
    // $stmtMateria->execute([':materia_id' => $materia_id]);
    // $materia = $stmtMateria->fetch(PDO::FETCH_ASSOC);
    // $materiaNombre = $materia['nombre'];
    //}
    // // Leer todas las materias
    // public function readAll() {
    //     $query = "SELECT * FROM " . $this->table;
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->execute();
    //     return $stmt;
    // }

    // // Obtener alumnos por materia
    // public function getAlumnosByMateria($materia_id) {
    //     $query = "SELECT alumnos.* FROM alumnos 
    //               JOIN inscripciones ON alumnos.id_alumno = inscripciones.id_alumno 
    //               WHERE inscripciones.id_materia = :id_materia";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(':id_materia', $id_materia);
    //     $stmt->execute();
    //     return $stmt;
    // }

require_once '../conexion.php';

class Materia {
    private $conn;

    public $id;
    public $nombre;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAll() {
        $query = "SELECT id, nombre FROM materia";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Crear una nueva materia
    // public function create() { //crear
    //     $query = "INSERT INTO materia (nombre) VALUES (:nombre)";

    //     $stmt = $this->conn->prepare($query);
    //     $this->nombre = htmlspecialchars(strip_tags($this->nombre));
    //     $stmt->bindParam(':nombre', $this->nombre);

    //     return $stmt->execute();
    // }
    public function create() {
        try {
            $query = "INSERT INTO materia (nombre) VALUES (:nombre)";
            $stmt = $this->conn->prepare($query);
            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->execute();
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {  // Error de clave duplicada
                echo "Error: Ya existe una materia con ese nombre.";
            } else {
                echo "Error: " . $e->getMessage();
            }
            return false;
        }
    }

    public function exists($nombre) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM materia WHERE nombre = :nombre");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    }
    
    public function update($id) { //Modificar
        $query = "UPDATE materia SET nombre = :nombre WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // public function delete($id) { // Eliminar
    //     $query = "DELETE FROM materia WHERE id = :id";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    //     return $stmt->execute();
    // Método para verificar si la materia tiene asistencias asociadas
    public function hasAssociatedAsistencias($id) {
        $query = "SELECT COUNT(*) FROM asistencia WHERE materia_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Método para eliminar una materia
    public function delete($id) {
        $query = "DELETE FROM materia WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
}


?>
