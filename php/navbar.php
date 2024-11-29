<?php
session_start(); // Inicia la sesión
?>

<header>
    <nav>
        <div class="nav">
            <div class="logo">
                <a href="./index.php"><img src="./img/logo.png" alt="logo"></a>
            </div>
            <div class="menu">
                <ul class="botones">
                    <li><a href="#">SERVICIOS</a></li>
                    <li><a href="./especialidades.php">ESPECIALIDADES</a></li>
                    <li><a href="./profesionales.php">PROFESIONALES</a></li>

                    <?php if (isset($_SESSION['id_dni'])): ?>
                        <?php if ($_SESSION['user_type'] === 'paciente'): ?>
                            <!-- Opción para pacientes: Registrar Turnos -->
                            <li><a href="./turnos.php">REGISTRAR TURNOS</a></li>
                        <?php elseif ($_SESSION['user_type'] === 'profesional'): ?>
                            <!-- Opción para especialistas: Ver Lista de Turnos -->
                            <li><a href="./php/lista_turnos.php">LISTA DE TURNOS</a></li>
                        <?php endif; ?>

                        <!-- Opción para cerrar sesión -->
                        <li><a href="./php/salirse.php">CERRAR SESIÓN</a></li>
                    <?php else: ?>
                        <!-- Opción para iniciar sesión si no está logueado -->
                        <li><a href="login.php">INGRESAR</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
