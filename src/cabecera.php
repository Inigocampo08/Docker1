<header id="cabecera">
    <nav id="menu-nav" class="ocultar">
        <ul>
            <!-- Cargar todos los botonesgenericos -->
            <li><a href="index.php">Inicio</a></li>
            <li><a href="equipos.php">Equipos</a></li>
            <li><a href="iniciarsesion.php">Iniciar sesion</a></li>
            <?php
            session_start();
            if (isset($_SESSION['usuario'])) {
                echo " <li><a href='cerrarsesion.php'>Cerrar Sesion</a></li>";
                echo " <li><a href='jugadores.php'>Nuevos jugadores</a></li>";
        
            }
            ?>
        </ul>
    </nav>

</header>