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
    $edad = $_POST['edad'];
    $direccion = $_POST['direccion'];
    $telpersonal = $_POST['telpersonal'];
    $encargado = $_POST['encargado'];
    $telencargado = $_POST['telencargado'];
    $grado = $_POST['grado'];
    $seccion = $_POST['seccion'];

    $query = $connection->prepare("SELECT * FROM alumnos WHERE id=:id");
    $query->bindParam("id", $id, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() > 0) {
        echo '<p class="error">Este ALUMNO ya ha sido registrado!</p>';
        header('location: ../');
    }

    if ($query->rowCount() == 0) {
        $conexion = mysqli_connect("localhost","root","","bd_ineb");
        $conexion->set_charset("utf8");

        $query = $connection->prepare("INSERT INTO alumnos(id, nombre, edad, direccion, telpersonal, encargado, telencargado, grado, seccion) VALUES (:id, :nombre, :edad, :direccion, :telpersonal, :encargado, :telencargado, :grado, :seccion)");
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $query->bindParam("nombre", $nombre, PDO::PARAM_STR);
        $query->bindParam("edad", $edad, PDO::PARAM_STR);
        $query->bindParam("direccion", $direccion, PDO::PARAM_STR);
        $query->bindParam("telpersonal", $telpersonal, PDO::PARAM_STR);
        $query->bindParam("encargado", $encargado, PDO::PARAM_STR);
        $query->bindParam("telencargado", $telencargado, PDO::PARAM_STR);
        $query->bindParam("grado", $grado, PDO::PARAM_STR);
        $query->bindParam("seccion", $seccion, PDO::PARAM_STR);
        $result = $query->execute();

        if ($result) {
            echo '<p class="success">Tu registro se ha completado!</p>';
            header('location: ', $_SERVER['PHP_SELF']);
        } else {
            echo '<p class="error">Algo ha ido mal!</p>';
            header('location: ', $_SERVER['PHP_SELF']);
        }

        $bd = 'bd_ineb';
        $query = $connection->prepare("SELECT table_name AS nombre FROM information_schema.tables WHERE table_schema = 'bd_ineb'");
        $query->execute();

        while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
            $grado_seccion = strtolower($_POST['grado'] . '-' . $_POST['seccion']);
            if (str_ends_with($result['nombre'], $grado_seccion)) {
                $tabla = $result['nombre'];
                $ingresarEnTabla = "INSERT INTO `$tabla` (codPersonal, nombre) VALUES ('$id', '$nombre')";
                mysqli_query($conexion,$ingresarEnTabla);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/homeAdmin.css">
    <link rel="stylesheet" href="../css/dropdown.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/formulario.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://kit.fontawesome.com/26c6a8a648.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <title>Añadir Alumno | Gestor de Notas</title>
</head>

<body>
    <?php include_once("../vistas/header.php"); ?>
    <form action='<?php echo $_SERVER['PHP_SELF'] ?>' method='post'>
        <div class="contenedor">
            <h1>Añadir Alumno</h1>
            <div class="contenedor__inputs">
                <input type="text" name="id" placeholder="Código Personal" autocomplete="off" campo="texto" required>
                <input type="text" name="nombre" placeholder="Nombre Completo" autocomplete="off" campo="texto" required>
                <input type="number" name="edad" placeholder="Edad" autocomplete="off" min="1" max="99" required>
                <input type="text" name="direccion" placeholder="Dirección" autocomplete="off" campo="texto" required>
                <input type="number" name="telpersonal" placeholder="Numero de telefono del alumno">
                <input type="text" name="encargado" placeholder="Nombre del Encargado" autocomplete="off" campo="texto">
                <input type="number" name="telencargado" placeholder="Numero de telefono del encargado">
                <div class="seleccionar-bimestre">
                    <select name="grado" class="grado">
                        <option value="" selected disabled>Grado</option>
                        <option value="Primero">Primero Básico</option>
                        <option value="Segundo">Segundo Básico</option>
                        <option value="Tercero">Tercero Básico</option>
                    </select>
                    <select name="seccion" class="seccion">
                        <option value="" selected disabled>Sección</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                    </select>
                </div>
                <input type='submit' name='insertar' value='Enviar Datos'>
            </div>
        </div>
    </form>
</body>

</html>