<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Notas</title>
    <link rel="stylesheet" href="notas_generales.css">
</head>
<body>
<div class="container">
        <h2>Registrar Notas</h2>
        <?php
// Incluir la conexión a la base de datos
require_once '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $alumno_id = $_POST['alumno_id'];
    $materia_id = $_POST['materia_id'];
    
    // Verificar si ya existen notas para ese alumno en la materia seleccionada
    $queryCheck = "SELECT * FROM notas WHERE alumno_id = ? AND materia_id = ?";
    $stmtCheck = $conn->prepare($queryCheck);
    $stmtCheck->execute([$alumno_id, $materia_id]);
    $existingNotes = $stmtCheck->fetch();

    if ($existingNotes) {
        echo "<p style='color: red;'>¡Este alumno ya tiene notas registradas para esta materia! Si desea modificarlas, puede hacerlo.</p>";
    }
}
?>

<form method="POST" action="guardar_notas.php">
    <label for="alumno_id">Alumno:</label>
    <select name="alumno_id" id="alumno_id" required>
        <?php
        // Aquí deberías cargar los alumnos desde la base de datos
        $alumnos = $conn->query("SELECT id, nombre, apellido FROM alumno")->fetchAll();
        foreach ($alumnos as $alumno) {
            echo "<option value='" . $alumno['id'] . "'>" . $alumno['nombre'] . " " . $alumno['apellido'] . "</option>";
        }
        ?>
    </select>

    <label for="materia_id">Materia:</label>
    <select name="materia_id" id="materia_id" required>
        <?php
        // Aquí deberías cargar las materias desde la base de datos
        $materias = $conn->query("SELECT id, nombre FROM materia")->fetchAll();
        foreach ($materias as $materia) {
            echo "<option value='" . $materia['id'] . "'>" . $materia['nombre'] . "</option>";
        }
        ?>
    </select>

    <label for="nota1">Nota 1:</label>
    <input type="number" name="nota1" id="nota1" min="0" max="10" required>

    <label for="nota2">Nota 2:</label>
    <input type="number" name="nota2" id="nota2" min="0" max="10" required>

    <label for="nota3">Nota 3:</label>
    <input type="number" name="nota3" id="nota3" min="0" max="10" required>

    <button type="submit">Guardar Notas</button><br><br>
    <a href="../opciones.php">Opciones</a>
</form>

</body>
</html>
