<!DOCTYPE html>
<html>
<?php include('./head.php'); ?>

<body>

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
    ?>
                <style>
                    /* Estilo de redireccion del comentario */

                    .comentario-exito {
                        text-align: center;
                        align-items: center;
                        justify-content: center;
                        font-size: xx-large;
                        background-color: #4087be;
                        margin-top: 13rem;
                    }

                    #countdown {
                        color: #fff;
                    }
                </style>
                <div class="comentario-exito">
                    <p>Comentario enviado con exito, sera redirigido en: <span id="countdown">5</span> segundos...</p>

                    <script>
                        // Obtener el elemento del contador
                        var countdownElement = document.getElementById('countdown');

                        var seconds = 5;

                        // Función para actualizar el contador y realizar la redirección
                        function countdown() {
                            seconds--;
                            countdownElement.textContent = seconds;

                            if (seconds <= 0) {
                                // Redirige al index
                                window.location.href = "../index.php";
                            } else {
                                setTimeout(countdown, 1000);
                            }
                        }

                        // Iniciar la cuenta atrás
                        countdown();
                    </script>

                </div>

    <?php
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

</body>

</html>