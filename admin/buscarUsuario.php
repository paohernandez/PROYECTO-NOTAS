<?php
include('../backend/conexion.php');
include('../backend/buscador.php');
session_start();
if (!$_SESSION['autentificado']) {
    header('Location: ../');
    exit;
}
if ($_SESSION['user_rol'] != "1") {
    header('Location: ../');
    exit;
}
$query = $connection->prepare("SELECT id FROM ( SELECT alumnos.id as id FROM alumnos UNION ALL SELECT maestros.dpi as id FROM maestros) personal");
$query->execute();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/homeAdmin.css">
    <link rel="stylesheet" href="../css/tablaNotas.css">
    <link rel="stylesheet" href="../css/buscarUsuario.css">
    <link rel="stylesheet" href="../css/dropdown.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://kit.fontawesome.com/26c6a8a648.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <title>Asignar Cursos | Gestor de Notas</title>
</head>

<body>
    <?php require_once("../vistas/header.php"); ?>
    <form action='<?php $_SERVER['PHP_SELF'] ?>' method='post'>
        <div class="contenedor">
            <div class="header">
                <a class="volver"><i class="fa-solid fa-arrow-left"></i></a>
                <h1>Buscar Usuario</h1>
            </div>
            <div class="contenedor__inputs">
                <section class="tabla">
                    <div class="contenedor-escoger">
                        <div class="escoger_profesor">
                            <h1 class="titulo">Escoger Identificador</h1>
                            <select class="persona-single" name="persona">
                                <option value="" selected disabled>Seleccione un identificador...</option>
                                <?php
                                while ($array = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <option value="<?php echo $array['id']; ?>"><?php echo $array['id']; ?></option>
                                <?php } ?>
                            </select>
                            <div>
                                <button type="submit" name="buscar" id="btn-buscar"><i class="fa-solid fa-magnifying-glass icono-buscador"></i></button>
                            </div>
                        </div>
                        <div class="escoger">
                            <div class="escoger-clases">
                                <div class="contenedor-clases">
                                    <?php
                                    if (isset($_POST['buscar'])) {
                                        $id = $_POST['persona'];
                                        $stmt = $connection->prepare("SELECT * FROM usuarios WHERE id = '$id'");
                                        $stmt->execute();
                                        $rUsuario = $stmt->fetch();?>
                                    <h1 class="titulo">Usuario Encontrado</h1>
                                    <br>
                                    <span>Usuario: <h1 style="text-transform:unset;"><?php echo $rUsuario['usuario'] ?></h1></span>
                                    <?php } else { ?>
                                    <h1 class="titulo">Busque un usuario</h1>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <input type='hidden' name='insertar' value='insertar'>
            </div>
        </div>
    </form>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.persona-single').select2();
        });

        $('.volver').click(function() {
            window.history.back();
        });
    </script>
</body>

</html>