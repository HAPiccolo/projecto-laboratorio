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
                        <form id="form-turno">
                            <div class="seleccion-turno">
                                <div class="select-container">
                                    <!-- Carga las profesiones -->
                                    <?php
                                    include('./php/conexion.php');
                                    $sql = "SELECT id_especialidad, nombre_especialidad FROM especialidades";
                                    $result = $mysqli->query($sql);

                                    echo "<select name='id_especialidad' id='id_especialidades'>";
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
                                <select id="id_profesionales" name="id_profesionales">
                                </select>
                                <input class="fecha" type="date" name="fecha" id="fecha">
                            </div>
                            <form action="">
                                <button class="btn-turno" type="button" id="guardarTurno">Agendar</button>
                            </form>
                    </div>
                </div>
                </form>
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
                    const profesionalesSelect = document.getElementById('id_profesionales');
                    profesionalesSelect.innerHTML = this.responseText; // Cargar los resultados en el select
                } else {
                    console.error('Error al cargar los profesionales');
                }
            };
            xhr.send('especialidad=' + encodeURIComponent(especialidadId));
        }
        document.getElementById('id_especialidades').addEventListener('change', function() {
            const especialidadId = this.value;
            cargarProfesionales(especialidadId);
        });
    </script>
    <script>
        // GUARDA LE TURNO
        document.getElementById('guardarTurno').addEventListener('click', function() {
            const form = document.getElementById('form-turno');
            const idEspecialidad = document.getElementById('id_especialidades').value;
            const idProfesional = document.getElementById('id_profesionales').value;
            const fecha = document.getElementById('fecha').value;

            if (!idEspecialidad || !idProfesional || !fecha) {
                alert('Por favor, complete todos los campos.');
                return;
            }

            const formData = new FormData();
            formData.append('id_especialidad', idEspecialidad);
            formData.append('id_profesional', idProfesional);
            formData.append('fecha', fecha);

            fetch('./php/guardar_turno.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    if (data === 'success') {
                        alert('Turno guardado exitosamente');
                        form.reset(); // Limpia el formulario
                    } else {
                        alert('Error al guardar el turno: ' + data);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>


</body>

</html>