<?php
// Iniciar la sesión
session_start();

// Destruir la sesión
session_unset(); // Elimina todas las variables de sesión
session_destroy(); // Destruye la sesión actual

// Redirigir al usuario a la página deseada (por ejemplo, login.php)
header("Location: ../login.php");
exit;
?>