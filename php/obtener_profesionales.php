<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/html; charset=utf-8');

include('./conexion.php'); // Asegúrate de tener este archivo correctamente configurado

// Verifica que el ID de especialidad está presente
if (!isset($_POST['especialidad'])) {
    echo '<option value="">Error: No se recibió una especialidad</option>';
    exit;
}

$especialidadId = intval($_POST['especialidad']); // Sanitiza la entrada

// Consulta SQL
$sql = "SELECT u.id_dni, u.nombre, u.apellido FROM usuarios u
        INNER JOIN profesionales p ON u.id_dni = p.id_dni
        WHERE p.especialidad = ?";
$stmt = $mysqli->prepare($sql);
if (!$stmt) {
    echo '<option value="">Error en la consulta</option>';
    exit;
}

$stmt->bind_param("i", $especialidadId);
$stmt->execute();
$result = $stmt->get_result();

// Verifica si hay resultados
if ($result->num_rows > 0) {
    $options = '';
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='" . htmlspecialchars($row['id_dni']) . "'>" . htmlspecialchars($row['nombre'] . " " . $row['apellido']) . "</option>";
    }
    echo $options;
} else {
    echo '<option value="">Sin profesionales disponibles</option>';
}

$stmt->close();
$mysqli->close();
