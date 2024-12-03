<!DOCTYPE html>
<html lang="en">
<!--- test --->

<?php include('./php/head.php'); ?>

<body>
    <?php include('./php/navbar.php'); ?>



    <main>
        <?php if (isset($_SESSION['id_dni'])): ?>
            <?php if ($_SESSION['user_type'] === 'profesional'): ?>
                <h1 class="saludo">Turnos del dia</h1>

                <div class="contenedor-turno">
                    <div class="container-turno">
                        <h3>Sus pacientes</h3>
                        <table class="tabla-turnos">
                            <thead style="background-color: #7c7b7a;">
                                <tr>
                                    <td>Paciente</td>
                                    <td>Telefono</td>
                                    <td>Estado</td>

                                </tr>
                            </thead>
                            <tr>
                                <td>
                                    Fulanito de tal
                                </td>
                                <td>
                                    3795035775
                                </td>
                                <td>
                                    <select style="width: 100%">
                                        <option name="Pendiente">Pendiente</option>
                                        <option name="Finalizado">Finalizado</option>
                                        <option name="Cancelado">Cancelado</option>
                                    </select>
                                </td>

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
</body>

</html>