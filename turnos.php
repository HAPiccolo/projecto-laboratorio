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


    <script>
        // Función para cargar los profesionales al cambiar la especialidad
        function cargarProfesionales(especialidadId) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', './php/obtener_profesionales.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status === 200) {
                    const profesionalesSelect = document.getElementById('profesionales');
                    profesionalesSelect.innerHTML = this.responseText; // Cargar los resultados en el select
                } else {
                    console.error('Error al cargar los profesionales');
                }
            };
            xhr.send('especialidad=' + encodeURIComponent(especialidadId));
        }
        document.getElementById('especialidades').addEventListener('change', function() {
            const especialidadId = this.value;
            cargarProfesionales(especialidadId);
        });
    </script>
    </script>

</body>

</html>