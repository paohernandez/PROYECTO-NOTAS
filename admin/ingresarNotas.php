<?php
include('../backend/conexion.php');
session_start();
if (!$_SESSION['autentificado']) {
	header('Location: ../');
	exit;
}
if ($_SESSION['user_rol'] != "1" && $_SESSION['user_rol'] != "2") {
	header('Location: ../');
	exit;
}

if ($_SESSION['user_rol'] != "1") {
	$array = explode("-", $_REQUEST['tabla']);
	$grado = '%'.$array[1].'%';
	$seccion = '%'.$array[2].'%';
	$clase = ucwords(str_replace('_', ' ', $array[0]));
	$id = $_SESSION['user_id'];
	$stmt = $connection->prepare("SELECT clase, id_maestro, grado FROM clases WHERE clase = :clase AND id_maestro = :id AND (grado LIKE :grado) AND (seccion LIKE :seccion)");
	$stmt->bindParam('id', $id, PDO::PARAM_STR);
	$stmt->bindParam('clase', $clase, PDO::PARAM_STR);
	$stmt->bindParam('grado', $grado, PDO::PARAM_STR);
	$stmt->bindParam('seccion', $seccion, PDO::PARAM_STR);
	$stmt->execute();
	$res = $stmt->fetchAll();
	if (!$res) {
		header('Location: ../');
	}
}

$tabla = $_REQUEST['tabla'];
$query = $connection->prepare("SELECT * FROM `$tabla`");
$query->execute();
$r1 = str_replace('-', ' ', $tabla);
$r2 = str_replace('_', ' ', $r1);
$texto = ucwords($r2);
$i = 1;

if (isset($_POST['ingresarNotas'])) {
    $conexion = mysqli_connect("localhost", "root", "", "bd_ineb");
    $conexion->set_charset("utf8");
    $nombreTabla = $_POST['tabla'];

    for ($i=0; $i < count($_POST['nota']); $i++) {
        $_POST['nota'][$_POST['id'][$i]] = $_POST['nota'][$i];
        unset($_POST['nota'][$i]);
    }

    if ($_POST['bimestre'] == 'PRIMERO') {
        foreach ($_POST['nota'] as $id => $nota) {
            $nombreTabla = $_POST['tabla'];
            $sentencia = "UPDATE `$nombreTabla` SET b1='$nota' WHERE codPersonal = '$id'";
            mysqli_query($conexion, $sentencia);
        }
    }
    if ($_POST['bimestre'] == 'SEGUNDO') {
        foreach ($_POST['nota'] as $id => $nota) {
            $nombreTabla = $_POST['tabla'];
            $sentencia = "UPDATE `$nombreTabla` SET b2='$nota' WHERE codPersonal = '$id'";
            mysqli_query($conexion, $sentencia);
        }
    }
    if ($_POST['bimestre'] == 'TERCERO') {
        foreach ($_POST['nota'] as $id => $nota) {
            $nombreTabla = $_POST['tabla'];
            $sentencia = "UPDATE `$nombreTabla` SET b3='$nota' WHERE codPersonal = '$id'";
            mysqli_query($conexion, $sentencia);
        }
    }
    if ($_POST['bimestre'] == 'CUARTO') {
        foreach ($_POST['nota'] as $id => $nota) {
            $nombreTabla = $_POST['tabla'];
            $sentencia = "UPDATE `$nombreTabla` SET b4='$nota' WHERE codPersonal = '$id'";
            mysqli_query($conexion, $sentencia);
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
	<link rel="stylesheet" href="../css/header.css">
	<link rel="stylesheet" href="../css/homeAdmin.css">
	<link rel="stylesheet" href="../css/tablaNotas.css">
	<link rel="stylesheet" href="../css/ingresar.css">
	<link rel="stylesheet" href="../css/dropdown.css">
	<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
	<script src="https://kit.fontawesome.com/26c6a8a648.js" crossorigin="anonymous"></script>
	<title>Ingresar Notas | Gestor de Notas</title>
</head>

<body>
	<?php require_once("../vistas/header.php"); ?>
	<form action='<?php echo $_SERVER['PHP_SELF'] ?>' method='POST'>
		<div class="contenedor">
			<div class="header">
				<a href="clases.php"><i class="fa-solid fa-arrow-left"></i></a>
				<h1>Ingresar Notas</h1>
				<p><?php echo $texto; ?></p>
			</div>
			<div class="contenedor__inputs">
				<section class="tabla">
					<table class="content-table">
						<thead>
							<tr>
								<th></th>
								<th>Código Personal</th>
								<th>Nombre</th>
								<th>Nota</th>
							</tr>
						</thead>
						<tbody>
							<?php while ($resultado = $query->fetch(PDO::FETCH_ASSOC)) {
							?>
								<tr>
									<td><?php echo $i ?></td>
									<td><?php echo $resultado['codPersonal'] ?></td>
									<td><?php echo $resultado['nombre'] ?></td>
									<td><input type="number" name="nota[]"></td>
									<input type="hidden" name="id[]" value="<?php echo $resultado['codPersonal'] ?>">
								</tr>
							<?php
							$i++;
							} ?>
						</tbody>
					</table>
				</section>
				<div class="seleccionar-bimestre">
					<div class="contenedor-select">
						<label for="bimestre">Bimestre:</label>
						<select name="bimestre" id="bimestre">
							<option value="PRIMERO">PRIMERO</option>
							<option value="SEGUNDO">SEGUNDO</option>
							<option value="TERCERO">TERCERO</option>
							<option value="CUARTO">CUARTO</option>
						</select>
					</div>
				</div>
				<input type="hidden" name="tabla" value="<?php echo $_REQUEST['tabla'] ?>">
				<input type='submit' name='ingresarNotas' value='Enviar Notas'>
			</div>
		</div>
	</form>
</body>

</html>