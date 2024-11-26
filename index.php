<!DOCTYPE html>
<html lang="en">
<!--- test --->

<?php include('./php/head.php'); ?>


<body>

    <?php include('./php/navbar.php'); ?>

    <main>
        <section class="img-fachada">
            <img src="./img/fachada.jpg" alt="imagen fachada">
        </section>

        <section class="contenedores">
            <div class="container-flex">
                <div class="container-servicios">
                    <h1>Nuestros servicios</h1>

                    <p>Nos destacamos en la region por contar con uno de los equipos de <b>Laboratorio</b> mas modernos,
                        a su vez contamos con servicio de <b>Internacion</b> atendidos por los mejores profesionales del
                        area. Disponemos de consultorios a disposición para cualquier consulta y un area de
                        <b>Emergencias</b> adaptado para atender urgencias de cualquier tipo.
                    </p>

                </div>
                <div class="container-contacto">
                    <h1>Contacto</h1>
                    <form action="./php/guardar_comentario.php" method="POST">
                    <input type="email" name="email" id="email" placeholder="Ingrese su direccion de email" required>
                    <textarea name="comentario" id="id_comentario" placeholder="Mensaje" required></textarea>
                    <button type="submit">Enviar</button>
                    </form>
                </div>
            </div>
        </section>


    </main>

    <footer>

    </footer>
</body>

</html>