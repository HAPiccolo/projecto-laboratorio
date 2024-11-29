<!DOCTYPE html>
<html lang="en">
<?php include('./php/head.php'); ?>

<body>

    <?php include('./php/navbar.php'); ?>

    <main>

        <div class="container-login">

            <form class="form-login" action="./php/login_verificacion.php" method="post">
                <label for="username">Usuario</label>
                <input type="text" name="username" id="" required>
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="" required>
                <button type="">Ingresar</button>
                <div class="newlogin">
                    <a href="registro.php" class="newlogin">Registrarse</a> | <a href="#" class="newlogin">Recuperar cuenta</a>
                </div>
            </form>

        </div>

    </main>

    <footer>

    </footer>
</body>

</html>