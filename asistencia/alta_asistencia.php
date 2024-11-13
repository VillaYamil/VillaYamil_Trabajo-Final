<?php
// Conexión a la base de datos
// try {
//     $conn = new PDO('mysql:host=localhost;dbname=tp_asistencias_v4', 'root', '');
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     echo "Error de conexión: " . $e->getMessage();
//     exit;
// }
require_once '../conexion.php';
// Obtener materias
$sqlMaterias = "SELECT id, nombre FROM materia";
$stmtMaterias = $conn->query($sqlMaterias);
$materias = $stmtMaterias->fetchAll(PDO::FETCH_ASSOC);

// Obtener alumnos
$sqlAlumnos = "SELECT id, nombre, apellido FROM alumno";
$stmtAlumnos = $conn->query($sqlAlumnos);
$alumnos = $stmtAlumnos->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alta Asistencia</title>
    <link rel="stylesheet" href="../css/estilos_asistencia/alta_asistencia.css">
</head>

<body>
    <form action="registrar_asistencia.php" method="POST">
        <label for="materia_id">Seleccionar Materia:</label>
        <select name="materia_id" required>
            <?php foreach ($materias as $materia): ?>
                <option value="<?php echo $materia['id']; ?>">
                    <?php echo htmlspecialchars($materia['nombre']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" value="<?php echo date('Y-m-d'); ?>" required>

        <h3>Lista de Alumnos</h3>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Asistencia</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alumnos as $alumno): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($alumno['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($alumno['apellido']); ?></td>
                        <td>
                            <label>
                                <input type="radio" name="alumnos[<?php echo $alumno['id']; ?>][estado]" value="presente" required> Presente
                            </label>
                            <label>
                                <input type="radio" name="alumnos[<?php echo $alumno['id']; ?>][estado]" value="ausente" required> Ausente
                            </label>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <input type="submit" value="Registrar Asistencia">
        <a href="../opciones.php">opciones</a>
    </form>
    
</body>
</html>
