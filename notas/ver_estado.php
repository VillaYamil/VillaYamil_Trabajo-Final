<?php
require_once '../conexion.php';
?> 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado del Alumno</title>
    <link rel="stylesheet" href="notas_generales.css">
</head>
<body>
    <div class="container">
        <h2>Estado del Alumno</h2>
        <form method="POST" action="calcular_estado.php">
            <!-- Contenido del formulario -->
            <label for="alumno_id">Alumno:</label>
            <select name="alumno_id" id="alumno_id" required>
                <?php
                // Cargar alumnos desde la base de datos
                $alumnos = $conn->query("SELECT id, nombre, apellido FROM alumno")->fetchAll();
                foreach ($alumnos as $alumno) {
                    echo "<option value='" . $alumno['id'] . "'>" . $alumno['nombre'] . " " . $alumno['apellido'] . "</option>";
                }
                ?>
            </select>

            <label for="materia_id">Materia:</label>
            <select name="materia_id" id="materia_id" required>
                <?php
                // Cargar materias desde la base de datos
                $materias = $conn->query("SELECT id, nombre FROM materia")->fetchAll();
                foreach ($materias as $materia) {
                    echo "<option value='" . $materia['id'] . "'>" . $materia['nombre'] . "</option>";
                }
                ?>
            </select>
            <button type="submit">Ver Estado</button>
        </form>
        <a href="../opciones.php">opciones</a>
    </div>
</body>
</html>
