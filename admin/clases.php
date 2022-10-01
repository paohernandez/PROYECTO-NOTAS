<?php
include('../backend/conexion.php');
include('../backend/acentos.php');
session_start();
if (!$_SESSION['autentificado']) {
    header('Location: ../');
    exit;
}
if ($_SESSION['user_rol'] != "1" && $_SESSION['user_rol'] != "2") {
    header('Location: ../');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/tablaClases.css">
    <link rel="stylesheet" href="../css/homeAdmin.css">
    <link rel="stylesheet" href="../css/dropdown.css">
    <script src="https://kit.fontawesome.com/26c6a8a648.js" crossorigin="anonymous"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <title>Clases | Gestor de Notas</title>
</head>

<body>
    <?php require_once("../vistas/header.php"); ?>
    <?php if ($_SESSION['user_rol'] == "1") {

        $query = $connection->prepare("SELECT * FROM clases ORDER BY grado");
        $result = $query->execute();
        $i = 1;
        ?>
        <section class="tabla">
            <table class="content-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Maestro</th>
                        <th>Grado</th>
                        <th>Clase</th>
                        <th>Sección</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                        $dpi = $result['id_maestro'];
                        $consulta = $connection->prepare("SELECT * FROM maestros WHERE dpi=:dpi LIMIT 1");
                        $consulta->bindParam("dpi", $dpi, PDO::PARAM_STR);
                        $resultado = $consulta->execute();
                        $resultadoNombre = $consulta->fetch(PDO::FETCH_ASSOC);
                        $nombre = explode(' ', $resultadoNombre['nombre']);
                    ?>
                        <tr>
                            <td><?php echo $i; $i++;?></td>
                            <td><?php echo $nombre[0] . ' ' . $nombre[2]; ?></td>
                            <td><?php echo $result['grado']; ?> Básico</td>
                            <td><?php echo $result['clase']; ?></td>
                            <td><?php echo $result['seccion'] ?></td>
                            <td><a href="ingresarNotas.php?tabla=<?php echo strtolower(str_replace(' ', '_', eliminar_acentos($result['clase']))) . '-' . strtolower($result['grado']) . '-' . strtolower($result['seccion']); ?>"><i class="fa-solid fa-file-circle-plus acciones"></i></a></td>
                            <td><a href="verNotas.php?tabla=<?php echo strtolower(str_replace(' ', '_', eliminar_acentos($result['clase']))) . '-' . strtolower($result['grado']) . '-' . strtolower($result['seccion']); ?>&maestro=<?php echo $resultadoNombre['nombre']; ?>"><i class="fa-solid fa-file-import acciones"></i></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    <?php } ?>
    <?php if ($_SESSION['user_rol'] == "2") {
        $id = $_SESSION['user_id'];
        $query = $connection->prepare("SELECT * FROM clases WHERE id_maestro=:id");
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $result = $query->execute();
        $i = 1;
        ?>
        <section class="tabla">
            <table class="content-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Grado</th>
                        <th>Clase</th>
                        <th>Sección</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php while ($result = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><?php echo $i; $i++;?></td>
                        <td><?php echo $result['grado']; ?> Básico</td>
                        <td><?php echo $result['clase']; ?></td>
                        <td><?php echo $result['seccion'] ?></td>
                        <td><a href="ingresarNotas.php?tabla=<?php echo strtolower(str_replace(' ', '_', eliminar_acentos($result['clase']))) . '-' . strtolower($result['grado']) . '-' . strtolower($result['seccion']); ?>"><i class="fa-solid fa-file-circle-plus acciones"></i></a></td>
                        <td><a href="verNotas.php?tabla=<?php echo strtolower(str_replace(' ', '_', eliminar_acentos($result['clase']))) . '-' . strtolower($result['grado']) . '-' . strtolower($result['seccion']); ?>&maestro=<?php echo $rNombre['nombre']; ?>"><i class="fa-solid fa-file-import acciones"></i></a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </section>
    <?php } ?>
</body>

</html>