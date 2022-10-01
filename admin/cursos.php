<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/tablaCursos.css">
    <link rel="stylesheet" href="../css/homeAdmin.css">
	<link rel="stylesheet" href="../css/dropdown.css">
    <script src="https://kit.fontawesome.com/26c6a8a648.js" crossorigin="anonymous"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <title>Cursos | Gestor de Notas</title>
</head>

<body>
    <?php require_once("../vistas/header.php"); ?>
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
                    <td>1</td>
                    <td>1ro Basico</td>
                    <td>Compu II</td>
                    <td>A</td>
                    <td><a href="ingresarNotas.php"><i class="fa-solid fa-file-circle-plus acciones"></i></a></td>
                    <td><a href="verNotas.php"><i class="fa-solid fa-file-import acciones"></i></a></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>2do Basico</td>
                    <td>Ciencias Sociales</td>
                    <td>B</td>
                    <td><a href="ingresarNotas.php"><i class="fa-solid fa-file-circle-plus acciones"></i></a></td>
                    <td><a href="verNotas.php"><i class="fa-solid fa-file-import acciones"></i></a></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>3ro Basico</td>
                    <td>Matematica</td>
                    <td>C</td>
                    <td><a href="ingresarNotas.php"><i class="fa-solid fa-file-circle-plus acciones"></i></a></td>
                    <td><a href="verNotas.php"><i class="fa-solid fa-file-import acciones"></i></a></td>
                </tr>
            </tbody>
        </table>
    </section>
</body>

</html>