<?php
// Conexión a la base de datos
include('./php/conexion.php');

// Obtener el id de la especialidad desde la petición AJAX
$especialidadId = $_POST['especialidad'];

// Consulta SQL para obtener los profesionales de la especialidad
$sql = "SELECT u.id_dni, u.nombre FROM usuarios u
        INNER JOIN profesionales p ON u.id_dni = p.id_dni
        WHERE p.especialidad = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $especialidadId);
$stmt->execute();
$result = $stmt->get_result();

// Formatear los resultados como JSON
$profesionales = [];
while ($row = $result->fetch_assoc()) {
    $profesionales[] = $row;
}
echo json_encode($profesionales);
