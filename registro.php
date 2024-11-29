<!DOCTYPE html>
<html lang="en">
<?php include('./php/conexion.php'); ?>
<?php include('./php/head.php'); ?>

<body>

    <?php include('./php/navbar.php'); ?>

    <main>

        <div class="container-login">

            <form class="form-login" action="./php/registro_usuarios.php" method="post">
                <h2>Registro de Paciente</h2>

                <label for="id_dni">DNI</label>
                <input type="number" name="id_dni" id="id_dni" required>

                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" required>

                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" id="apellido" required>

                <label for="contrasenia">Contraseña</label>
                <input type="password" name="contrasenia" id="contrasenia" required>

                <button type="submit">Registrarse</button>

                <div class="newlogin">
                    <a href="login.php" class="newlogin">Volver al login</a>
                </div>
            </form>

        </div>

    </main>

    <footer>

    </footer>
</body>

</html>
