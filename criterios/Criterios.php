<?php
require_once '../conexion.php';

class Criterios {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Método para obtener todos los valores de la tabla criterios
    public function getCriterios() {
        $query = $this->conn->prepare("SELECT * FROM ram LIMIT 1");
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Método para actualizar los valores en la tabla criterios
    public function actualizarCriterios($porcentajePromocion, $porcentajeRegularizar, $notaPromocion, $notaRegularizar) {
        $query = $this->conn->prepare("UPDATE ram SET 
            porcentaje_asistencia_promocion = ?, 
            porcentaje_asistencia_regularizar = ?, 
            nota_promocion = ?, 
            nota_regularizar = ? 
            WHERE id = 1");
        return $query->execute([$porcentajePromocion, $porcentajeRegularizar, $notaPromocion, $notaRegularizar]);
    }
}
?>
