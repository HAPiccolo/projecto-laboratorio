<?php
session_start();

// Verificar si ya está logueado
if (isset($_SESSION['id_dni'])) {
    header("Location: ../index.php"); // Si ya está logueado, redirigir al inicio
    exit();
}
    
// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    include('./conexion.php');

    // Obtener los datos del formulario
    $username = $_POST['username']; // id_dni (usuario)
    $password = $_POST['password'];

    // Consultar si el usuario existe en la base de datos
    $query = "SELECT * FROM usuarios WHERE id_dni = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $username); // Buscamos por id_dni
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // El usuario existe
        $usuario = $result->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($password, $usuario['contrasenia'])) {
            // Si la contraseña es correcta, iniciar sesión
            $_SESSION['id_dni'] = $usuario['id_dni']; // Guardamos el id_dni
            $_SESSION['user_type'] = $usuario['tipo_usuario']; // Guardamos el tipo de usuario
            header("Location: ../index.php"); // Redirigir a la página principal
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "El usuario no existe.";
    }

    $stmt->close();
    $mysqli->close();
}
?>
