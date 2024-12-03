<!DOCTYPE html>
<html lang="en">
<!--- test --->

<?php include('./php/head.php'); ?>

<body>
    <?php include('./php/navbar.php'); ?>

    <main>
        <?php if (isset($_SESSION['id_dni'])): ?>
            <?php if ($_SESSION['user_type'] === 'paciente'): ?>
                <h1 class="saludo">Bienvenido al Registro de Turnos</h1>
                <div class="contenedor-turno">
                    <div class="container-turno">
                        <h3>Solicitar turno</h3>
                        <div class="seleccion-turno">
                            <div class="select-container">
                                <!-- Carga las profesiones -->
                                <?php
                                include('./php/conexion.php');
                                $sql = "SELECT id_especialidad, nombre_especialidad FROM especialidades";
                                $result = $mysqli->query($sql);

                                echo "<select name='especialidad' id='especialidades'>";
                                if ($result->num_rows > 0) {
                                    //recorre los resultados
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row["id_especialidad"] . "'>" . $row["nombre_especialidad"] . "</option>";
                                    }
                                }
                                echo "</select>"
                                ?>
                            </div>
                            <!-- Carga los profesionales -->
                            <select id="profesionales">
                            </select>
                            <input class="fecha" type="date" name="fecha" id="">
                        </div>
                        <form action="" method="post">
                            <button class="btn-turno" type="">Agendar</button>
                        </form>
                    </div>
                </div>
                <div class="contenedor-turno">
                    <div class="container-turno">
                        <h3>Tus turnos</h3>
                        <table class="tabla-turnos">
                            <thead style="background-color: #7c7b7a;">
                                <tr>
                                    <td>Estado</td>
                                    <td>Especialista</td>
                                    <td>Fecha</td>
                                </tr>
                            </thead>
                            <tr>
                                <td style="text-align:center;">
                                    <input type="checkbox" name="" id="" checked>
                                </td>
                                <td>asdasd</td>
                                <td>sdfffdfffd</td>
                            </tr>
                        </table>
                    </div>

                </div>
            <?php else: ?>
                <h1 style="text-align: center; margin-top:3rem;">Pagina no disponible</h1>
            <?php endif; ?>
        <?php endif; ?>

    </main>
    <footer>
    </footer>


    <!-- JS para manejar el DOM -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Manejador de evento para el cambio de especialidad
            $('#especialidades').change(function() {
                var especialidadId = $(this).val();
                // Petición AJAX al servidor
                $.ajax({
                    url: './php/obtener_profesionales.php', // Ajusta la ruta al archivo PHP
                    data: {
                        especialidad: especialidadId
                    },
                    dataType: 'json',
                    success: function(data) {
                        // Limpiar el select de profesionales
                        $('#profesionales').empty();

                        // Crear las opciones del select
                        $.each(data, function(index, profesional) {
                            $('#profesionales').append('<option value="' + profesional.id_dni + '">' + profesional.nombre + '</option>');
                        });
                    }
                });
            });
        });
    </script>

</body>

</html>