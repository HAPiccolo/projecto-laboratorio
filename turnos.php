<!DOCTYPE html>
<html lang="en">
<!--- test --->

<?php include('./php/head.php'); ?>

<body>
    <?php include('./php/navbar.php'); ?>


    <main>
        <h1 class="saludo">Bienvenido al Registro de Turnos</h1>
        <div class="contenedor-turno">
            <div class="container-turno">
                <h3>Solicitar turno</h3>
                <div class="seleccion-turno">
                    <select name="especialidad">
                        <option value="Cardiologia">Cardiologia</option>
                        <option value="Analisis clinicos">Analisis clinicos</option>
                        <option value="Pediatria">Pediatria</option>

                    </select>
                    <select name="especialista">
                        <option value="Cardiologia">Pedro Sanchez</option>
                        <option value="Analisis clinicos">Analisis clinicos</option>
                        <option value="Pediatria">Pediatria</option>
                    </select>
                    <input class="fecha" type="date" name="fecha" id="">
                </div>

                <form action="" method="post">
                    <button class="btn-turno" type="">Agendar</button>
                </form>
            </div>
        </div>
    </main>

    <footer>

    </footer>
</body>

</html>