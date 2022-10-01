<div class="dropdown">
    <input type="checkbox" id="dropdown">

    <label class="dropdown__face" for="dropdown">
        <?php if ($_SESSION['user_rol'] == "1") { ?>
            <div class="dropdown__text">Acciones de Director</div>
        <?php } ?>
        <?php if ($_SESSION['user_rol'] == "2") { ?>
            <div class="dropdown__text">Acciones de Maestro</div>
        <?php } ?>
        <div class="dropdown__arrow"></div>
    </label>

    <ul class="dropdown__items">
        <?php if ($_SESSION['user_rol'] == "1") { ?>
            <li><a href="buscarUsuario.php" class=""><i class="fa-solid fa-folder-tree"></i> Buscar Usuarios</a></li>
            <li><a href="registrarPersonal.php" class=""><i class="fa-solid fa-plus"></i> Registrar Personal</a></li>
            <li><a href="anadirMaestro.php" class=""><i class="fa-solid fa-users"></i> Añadir Maestros</a></li>
            <li><a href="asignarClases.php" class=""><i class="fa-solid fa-swatchbook"></i> Asignar Clases</a></li>
            <li><a href="anadirAlumno.php" class=""><i class="fa-solid fa-user-plus"></i> Añadir Alumnos</a></li>
            <li><a href="../backend/cerrar_sesion.php" class=""><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a></li>
        <?php } ?>
        <?php if ($_SESSION['user_rol'] == "2") { ?>
            <li><a href="clases.php" class=""><i class="fa-solid fa-bookmark"></i> Clases</a></li>
            <li><a href="../backend/cerrar_sesion.php" class=""><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a></li>
        <?php } ?>
    </ul>
</div>

<svg>
    <filter id="goo">
        <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
        <feColorMatrix in="blur" type="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo" />
        <feBlend in="SourceGraphic" in2="goo" />
    </filter>
</svg>