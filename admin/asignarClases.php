<?php
include('../backend/conexion.php');
include('../backend/acentos.php');
session_start();
if (!$_SESSION['autentificado']) {
    header('Location: ../');
    exit;
}
if ($_SESSION['user_rol'] != "1") {
    header('Location: ../');
    exit;
}

$query = $connection->prepare("SELECT * FROM maestros");
$query->execute();

if (isset($_POST['asignar'])) {
    $conexion = mysqli_connect("localhost","root","","bd_ineb");
    $conexion->set_charset("utf8");

    $clases = $_POST["clases"];

    for ($i = 0; $i < count($clases); $i++) {
        $id_maestro = $_POST["maestro"];
        $grado = $_POST["grado"];
        $seccion = $_POST["seccion"];
        $clase = $clases[$i];
        $clasefiltrada = str_replace(' ', '_', $clases[$i]);
        $grado_sin_acento = eliminar_acentos($grado);
        $consulta = "INSERT INTO clases (id_maestro, grado, seccion, clase) VALUES ('$id_maestro', '$grado', '$seccion', '$clase')";
        mysqli_query($conexion,$consulta);
        $crear = "CREATE TABLE `$clasefiltrada-$grado_sin_acento-$seccion` (codPersonal varchar(10), nombre varchar(255) NOT NULL, b1 int(3) NOT NULL, b2 int(3) NOT NULL, b3 int(3) NOT NULL, b4 int(3) NOT NULL, PRIMARY KEY(codPersonal))";
        mysqli_query($conexion,$crear);
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
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/homeAdmin.css">
    <link rel="stylesheet" href="../css/tablaNotas.css">
    <link rel="stylesheet" href="../css/asignarClases.css">
    <link rel="stylesheet" href="../css/dropdown.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://kit.fontawesome.com/26c6a8a648.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <title>Asignar Clases | Gestor de Notas</title>
</head>

<body>
    <?php require_once("../vistas/header.php"); ?>
    <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='post'>
        <div class="contenedor">
            <div class="header">
                <a class="volver" onclick="volver()"><i class="fa-solid fa-arrow-left"></i></a>
                <h1>Asignar Clases</h1>
            </div>
            <div class="contenedor__inputs">
                <section class="tabla">
                    <div class="contenedor-escoger">
                        <div class="escoger_maestro">
                            <h1 class="titulo">Escoger Maestro</h1>
                            <select class="maestro-single" name="maestro">
                                <option value="" selected disabled>Seleccione un maestro...</option>
                                <?php while ($result = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <option value="<?php echo $result['dpi']; ?>"><?php echo $result['nombre']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="escoger">
                            <div class="escoger-grado">
                                <div class="contenedor-grado">
                                    <h1 class="titulo">Escoger Grado</h1>
                                    <select class="grado-single" name="grado">
                                        <option value="Primero">Primero Básico</option>
                                        <option value="Segundo">Segundo Básico</option>
                                        <option value="Tercero">Tercero Básico</option>
                                    </select>
                                    <h1 class="titulo" style="margin-top:20px;">Escoger Sección</h1>
                                    <select class="seccion-single" name="seccion">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                    </select>
                                </div>
                            </div>
                            <div class="escoger-clases">
                                <div class="contenedor-clases">
                                    <h1 class="titulo">Escoger Clases</h1>
                                    <select class="clases-multiple" name="clases[]" multiple="multiple">
                                        <option value="Matemática">Matemática</option>
                                        <option value="Idioma Materno">Idioma Materno</option>
                                        <option value="Cultura E Idioma">Cultura e Idioma</option>
                                        <option value="Inglés">Inglés</option>
                                        <option value="Ciencias Naturales">Ciencias Naturales</option>
                                        <option value="Ciencias Sociales">Ciencias Sociales</option>
                                        <option value="Educación Artística">Educación Artística</option>
                                        <option value="Educación Física">Educación Física</option>
                                        <option value="Emprendimiento Para La Productividad">Emprendimiento para la productividad</option>
                                        <option value="Tecnologías De Aprendizaje">Tecnologías de aprendizaje</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <input type='submit' name='asignar' value='Asignar Clases'>
            </div>
        </div>
    </form>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.maestro-single').select2();
            $('.grado-single').select2();
            $('.seccion-single').select2();
            $('.clases-multiple').select2();
        });

        $('.volver').click(function() {
            window.history.back();
        });
    </script>
</body>

</html>