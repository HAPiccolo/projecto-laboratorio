<?php
session_start();
include('./conexion.php'); // Archivo de conexión a la base de datos

// Verificar si el usuario está logueado
if (!isset($_SESSION['id_dni'])) {
    echo 'Error: Usuario no logueado';
    exit;
}

$id_usuario = $_SESSION['id_dni']; // ID del usuario logueado
$id_profesional = $_POST['id_profesional'] ?? null;
$fecha = $_POST['fecha'] ?? null;

// Validar campos
if (!$id_profesional || !$fecha) {
    echo 'Error: Faltan datos requeridos';
    exit;
}

// Preparar la consulta para insertar el turno
$sql = "INSERT INTO turnos (id_usuario, id_profesional, fecha) VALUES (?, ?, ?)";
$stmt = $mysqli->prepare($sql);

if (!$stmt) {
    echo 'Error en la consulta: ' . $mysqli->error;
    exit;
}

$stmt->bind_param("iis", $id_usuario, $id_profesional, $fecha);

if ($stmt->execute()) {
    echo 'success';
} else {
    echo 'Error al guardar el turno: ' . $stmt->error;
}

$stmt->close();
$mysqli->close();
