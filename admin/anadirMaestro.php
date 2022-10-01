<?php

include('../backend/conexion.php');
session_start();
if(!$_SESSION['autentificado']){
    header('Location: ../');
    exit;
}
if ($_SESSION['user_rol'] != "1") {
    header('Location: ../');
    exit;
}
if (isset($_POST['insertar'])) {

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telpersonal = $_POST['telpersonal'];

    $query = $connection->prepare("SELECT * FROM maestros WHERE dpi=:id");
    $query->bindParam("id", $id, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() > 0) {
        echo '<p class="error">Este MAESTRO ya ha sido registrado!</p>';
        header('location: ../');
    }

    if ($query->rowCount() == 0) {
        $query = $connection->prepare("INSERT INTO maestros(dpi, nombre, direccion, telpersonal) VALUES (:id, :nombre, :direccion, :telpersonal)");
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $query->bindParam("nombre", $nombre, PDO::PARAM_STR);
        $query->bindParam("direccion", $direccion, PDO::PARAM_STR);
        $query->bindParam("telpersonal", $telpersonal, PDO::PARAM_STR);
        $result = $query->execute();

        if ($result) {
            echo '<p class="success">Tu registro se ha completado!</p>';
            header('location: ', $_SERVER['PHP_SELF']);
        } else {
            echo '<p class="error">Algo ha ido mal!</p>';
            header('location: ', $_SERVER['PHP_SELF']);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/homeAdmin.css">
    <link rel="stylesheet" href="../css/dropdown.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/formulario.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://kit.fontawesome.com/26c6a8a648.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <title>Añadir Alumno | Gestor de Notas</title>
</head>

<body>
    <?php include_once("../vistas/header.php"); ?>
    <form action='<?php echo $_SERVER['PHP_SELF'] ?>' method='post'>
        <div class="contenedor">
            <h1>Añadir Maestro</h1>
            <div class="contenedor__inputs">
                <input type="number" name="id" placeholder="DPI" autocomplete="off" campo="texto" required>
                <input type="text" name="nombre" placeholder="Nombre Completo" autocomplete="off" campo="texto" required>
                <input type="text" name="direccion" placeholder="Dirección" autocomplete="off" campo="texto" required>
                <input type="number" name="telpersonal" placeholder="Numero de telefono">
                <input type='submit' name="insertar" value='Enviar Datos'>
            </div>
        </div>
    </form>
</body>

</html>