<?php
include 'conexion.php';

// Comprobar si el formulario fue enviado correctamente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y sanitizar los datos del formulario
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $comentario = htmlspecialchars($_POST['comentario']);

    // Validar que el correo electrónico sea válido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Correo electrónico no válido.";
        exit;
    }

    // Prevenir inyecciones SQL usando prepared statements
    if ($stmt = $mysqli->prepare("INSERT INTO comentarios (email, comentario, estado) VALUES (?, ?, ?)")) {
        // Asignar el estado como "pendiente" por defecto
        $estado = "pendiente";
        $stmt->bind_param("sss", $email, $comentario, $estado);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Comentario enviado con éxito.";
        } else {
            // Mostrar el error en caso de fallo de la consulta
            echo "Error en la ejecución de la consulta: " . $stmt->error;
        }

        // Cerrar la conexión
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $mysqli->error;
    }

    // Cerrar la conexión
    $mysqli->close();
}
?>
