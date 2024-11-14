<?php

require_once '../conexion.php';

// Verificar que se haya recibido el ID de la materia
if (!isset($_GET['materia_id'])) {
    echo "No se ha seleccionado ninguna materia.";
    exit;
}

$materia_id = $_GET['materia_id'];

// Obtener el nombre de la materia seleccionada
$sqlMateria = "SELECT nombre FROM materia WHERE id = :materia_id";
$stmtMateria = $conn->prepare($sqlMateria);
$stmtMateria->execute([':materia_id' => $materia_id]);
$materia = $stmtMateria->fetch(PDO::FETCH_ASSOC);

if (!$materia) {
    echo "Materia no encontrada.";
    exit;
}

// Obtener las fechas únicas de asistencia para la materia seleccionada
$sqlFechas = "SELECT DISTINCT fecha FROM asistencia WHERE materia_id = :materia_id ORDER BY fecha DESC";
$stmtFechas = $conn->prepare($sqlFechas);
$stmtFechas->execute([':materia_id' => $materia_id]);
$fechas = $stmtFechas->fetchAll(PDO::FETCH_ASSOC);

// Verificar si se ha seleccionado una fecha específica
$fechaSeleccionada = isset($_GET['fecha']) ? $_GET['fecha'] : null;

// Obtener las asistencias de la materia seleccionada y de la fecha seleccionada (si existe)
$sqlAsistencias = "SELECT a.fecha, a.estado, al.nombre AS alumno_nombre, al.apellido AS alumno_apellido
                   FROM asistencia AS a
                   JOIN alumno AS al ON a.alumno_id = al.id
                   WHERE a.materia_id = :materia_id" . 
                   ($fechaSeleccionada ? " AND a.fecha = :fecha" : "") . 
                   " ORDER BY a.fecha DESC";

$stmtAsistencias = $conn->prepare($sqlAsistencias);
$params = [':materia_id' => $materia_id];
if ($fechaSeleccionada) {
    $params[':fecha'] = $fechaSeleccionada;
}
$stmtAsistencias->execute($params);
$asistencias = $stmtAsistencias->fetchAll(PDO::FETCH_ASSOC);
?>

<head>
    <meta charset="UTF-8">
    <title>Lista de Asistencias - <?php echo htmlspecialchars($materia['nombre']); ?></title>
    <link rel="stylesheet" href="../css/estilos_asistencia/ver_asistencias.css">
</head>

<body>
    <div class="container">
        <h1>Lista de Asistencias para <?php echo htmlspecialchars($materia['nombre']); ?></h1>

        <!-- Selector de Fecha -->
        <form method="get" action="">
            <input type="hidden" name="materia_id" value="<?php echo htmlspecialchars($materia_id); ?>">
            <label for="fecha">Seleccionar Fecha:</label>
            <select name="fecha" id="fecha" onchange="this.form.submit()">
                <option value="">-- Todas las Fechas --</option>
                <?php foreach ($fechas as $fecha): ?>
                    <option value="<?php echo htmlspecialchars($fecha['fecha']); ?>" <?php echo ($fechaSeleccionada == $fecha['fecha']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($fecha['fecha']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>

        <!-- Mostrar asistencias -->
        <?php if (empty($asistencias)): ?>
            <p>No se encontraron asistencias para esta materia en la fecha seleccionada.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Alumno</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($asistencias as $asistencia): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($asistencia['fecha']); ?></td>
                            <td><?php echo htmlspecialchars($asistencia['alumno_nombre']) . " " . htmlspecialchars($asistencia['alumno_apellido']); ?></td>
                            <td class="<?php echo $asistencia['estado'] ? 'presente' : 'ausente'; ?>">
                                <?php echo $asistencia['estado'] ? 'Presente' : 'Ausente'; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        <a href="../opciones.php">Opciones</a>
    </div>
</body>
</html>
