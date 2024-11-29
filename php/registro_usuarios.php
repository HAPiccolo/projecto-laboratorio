<?php
// Conexión a la base de datos
include('./conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario
    $id_dni = intval($_POST['id_dni']);
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido = htmlspecialchars($_POST['apellido']);
    $contrasenia = password_hash($_POST['contrasenia'], PASSWORD_BCRYPT); // Encriptar contraseña

    // Validar que no exista un usuario con el mismo DNI
    $check_query = "SELECT * FROM usuarios WHERE id_dni = ?";
    $stmt = $mysqli->prepare($check_query);
    $stmt->bind_param("i", $id_dni); // Buscamos por id_dni
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "El usuario con DNI ya está registrado.";
    } else {
        // Insertar nuevo registro
        $insert_query = "INSERT INTO usuarios (id_dni, nombre, apellido, contrasenia, tipo_usuario) VALUES (?, ?, ?, ?, 'paciente')";
        $stmt = $mysqli->prepare($insert_query);
        $stmt->bind_param("isss", $id_dni, $nombre, $apellido, $contrasenia);

        if ($stmt->execute()) {
            echo "Registro exitoso.";
            header("Location: ../login.php"); // Redirigir al login después del registro
        } else {
            echo "Error al registrar al usuario.";
        }
    }
    $stmt->close();
}
$mysqli->close();
?>
