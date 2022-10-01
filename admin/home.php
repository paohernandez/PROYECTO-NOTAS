<?php
error_reporting(0);
include('../backend/conexion.php');
include('../backend/buscador.php');
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
	<link rel="stylesheet" href="../css/cards.css">
	<link rel="stylesheet" href="../css/homeAdmin.css">
	<link rel="stylesheet" href="../css/modal.css">
	<link rel="stylesheet" href="../css/buscador.css">
	<link rel="stylesheet" href="../css/botones.css">
	<link rel="stylesheet" href="../css/dropdown.css">
	<link rel="stylesheet" href="../css/paginacion.css">
	<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
	<script src="https://kit.fontawesome.com/26c6a8a648.js" crossorigin="anonymous"></script>
	<title>Inicio | Gestor de Notas</title>
</head>

<body>
	<?php require_once("../vistas/header.php"); ?>
	<form id="form-buscador" action='<?php echo $_SERVER['PHP_SELF'] ?>' method='REQUEST'>
		<?php require_once("../vistas/buscador.php"); ?>
	</form>
	<?php if ($_SESSION['user_rol'] == "1") {

		if (isset($_REQUEST['submit-buscar'])) {
			$buscar = $_REQUEST['buscar'];
	?>
			<section class="tarjetas">
				<div class="contenedor-tarjetas">
					<?php
					if (isset($_REQUEST['i'])) {
						$ruta = $_REQUEST['i'];
					}
					if ($ruta >= 1) {
						$init = ($ruta - 1) * 3;
						$max = 3;
					} else {
						$ruta = 1;
						$init = 0;
						$max = 3;
					}
					$query = $connection->prepare("SELECT * FROM alumnos WHERE nombre LIKE '%$buscar%' OR edad LIKE '%$buscar%' OR direccion LIKE '%$buscar%' OR grado LIKE '%$buscar%' OR id LIKE '%$buscar%' LIMIT $init, $max");
					$query->execute();
					?>
					<?php while ($result = $query->fetch(PDO::FETCH_ASSOC)) { ?>
						<div class="card">
							<div class="content">
								<div class="details">
									<h2><?php echo $result['nombre']
										?><br><span><?php echo $result['telencargado']
													?> - <b><?php echo $result['telpersonal']
														?></b></span></h2>
									<div class="data">
										<h3><?php echo $result['edad'] ?> años<br><span>Edad</span></h3>
										<h3><?php echo $result['grado'] ?> Básico <?php echo $result['seccion'] ?><br><span>Grado</span></h3>
										<h3><?php echo $result['id'] ?><br><span>Código</span></h3>
										<h3><?php echo $result['encargado'] ?><br><span>Encargado</span></h3>
									</div>
									<div class="actionBtn">
										<form action="notasAlumnos.php" method="POST">
											<input type="hidden" name="id" value="<?php echo $result['id'] ?>">
											<input type="hidden" name="grado" value="<?php echo $result['grado'] ?>">
											<input type="hidden" name="seccion" value="<?php echo $result['seccion'] ?>">
											<input type="hidden" name="nombre" value="<?php echo $result['nombre'] ?>">
											<input type="submit" name="verNotas" class="btn-enviar" value="Ver Notas">
										</form>
									</div>
								</div>
							</div>
						</div>
					<?php }
					$resultado = $query->fetchAll(); ?>
				</div>
			</section>
			<?php if (is_array($resultado) || is_object($resultado)) {
				$stmt = $connection->prepare("SELECT * FROM alumnos WHERE nombre LIKE '%$buscar%' OR edad LIKE '%$buscar%' OR direccion LIKE '%$buscar%' OR grado LIKE '%$buscar%' OR id LIKE '%$buscar%'");
				$stmt->execute();
				$cantAlumnos = $stmt->fetchAll();
				$paginas = ceil(count($cantAlumnos) / 3);
				if (!$cantAlumnos) {
		?>
					<div class="contenedor-error">
						<div class="contenido">
							<h1>NO HAY DATOS PARA SU BÚSQUEDA</h1>
						</div>
					</div>

				<?php
				}
				?><section class="paginacion">
					<div class="contenedor-selector">
						<div class="selector">
							<ul>
								<?php if ($_REQUEST['i'] <= 1) { ?>
									<li><a class="no-link"><i class="fa-solid fa-angle-left"></i></a></li>
								<?php } else { ?>
									<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?submit-buscar=true&buscar=<?php echo $_REQUEST['buscar']; ?>&i=<?php echo $_REQUEST['i'] - 1; ?>"><i class="fa-solid fa-angle-left"></i></a></li>
								<?php } ?>

								<?php for ($i = 1; $i <= $paginas; $i++) {
									if ($_REQUEST['i'] == $i) {
								?>
										<li><a class="active" href="<?php echo $_SERVER['PHP_SELF']; ?>?submit-buscar=true&buscar=<?php echo $_REQUEST['buscar']; ?>&i=<?php echo $i; ?>"><?php echo $i; ?></a></li>
									<?php } else { ?>
										<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?submit-buscar=true&buscar=<?php echo $_REQUEST['buscar']; ?>&i=<?php echo $i; ?>"><?php echo $i; ?></a></li>
								<?php }
								} ?>

								<?php if ($_REQUEST['i'] >= $paginas) { ?>
									<li><a class="no-link"><i class="fa-solid fa-angle-right"></i></a></li>
								<?php } else { ?>
									<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?submit-buscar=true&buscar=<?php echo $_REQUEST['buscar']; ?>&i=<?php echo $_REQUEST['i'] + 1; ?>"><i class="fa-solid fa-angle-right"></i></a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</section>
			<?php }
		} else { ?>
			<section class="tarjetas">
				<div class="contenedor-tarjetas">
					<?php
					if (isset($_REQUEST['i'])) {
						$ruta = $_REQUEST['i'];
					}
					if ($ruta >= 1) {
						$init = ($ruta - 1) * 3;
						$max = 3;
					} else {
						$ruta = 1;
						$init = 0;
						$max = 3;
					}
					$query = $connection->prepare("SELECT * FROM alumnos ORDER BY grado LIMIT $init, $max");
					$query->execute();
					?>
					<?php while ($result = $query->fetch(PDO::FETCH_ASSOC)) { ?>
						<div class="card">
							<div class="content">
								<div class="details">
									<h2><?php echo $result['nombre']
										?><br><span><?php echo $result['telencargado']
												?> - <b><?php echo $result['telpersonal']
														?></b></span></h2>
									<div class="data">
										<h3><?php echo $result['edad'] ?> años<br><span>Edad</span></h3>
										<h3><?php echo $result['grado'] ?> Básico <?php echo $result['seccion'] ?><br><span>Grado</span></h3>
										<h3><?php echo $result['id'] ?><br><span>Código</span></h3>
										<h3><?php echo $result['encargado'] ?><br><span>Encargado</span></h3>
									</div>
									<div class="actionBtn">
										<form action="notasAlumnos.php" method="POST">
											<input type="hidden" name="id" value="<?php echo $result['id'] ?>">
											<input type="hidden" name="grado" value="<?php echo $result['grado'] ?>">
											<input type="hidden" name="seccion" value="<?php echo $result['seccion'] ?>">
											<input type="hidden" name="nombre" value="<?php echo $result['nombre'] ?>">
											<input type="submit" name="verNotas" class="btn-enviar" value="Ver Notas">
										</form>
									</div>
								</div>
							</div>
						</div>
					<?php }
					$resultado = $query->fetchAll(); ?>
				</div>
			</section>
			<?php if (is_array($resultado) || is_object($resultado)) {
				$stmt = $connection->prepare("SELECT * FROM alumnos");
				$stmt->execute();
				$cantAlumnos = $stmt->fetchAll();
				$paginas = ceil(count($cantAlumnos) / 3);
			?>
				<section class="paginacion">
					<div class="contenedor-selector">
						<div class="selector">
							<ul>
								<?php if ($_REQUEST['i'] <= 1) { ?>
									<li><a class="no-link"><i class="fa-solid fa-angle-left"></i></a></li>
								<?php } else { ?>
									<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?i=<?php echo $_REQUEST['i'] - 1; ?>"><i class="fa-solid fa-angle-left"></i></a></li>
								<?php } ?>

								<?php for ($i = 1; $i <= $paginas; $i++) {
									if ($_REQUEST['i'] == $i) {
								?>
										<li><a class="active" href="<?php echo $_SERVER['PHP_SELF']; ?>?i=<?php echo $i; ?>"><?php echo $i; ?></a></li>
									<?php } else { ?>
										<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?i=<?php echo $i; ?>"><?php echo $i; ?></a></li>
								<?php }
								} ?>

								<?php if ($_REQUEST['i'] >= $paginas) { ?>
									<li><a class="no-link"><i class="fa-solid fa-angle-right"></i></a></li>
								<?php } else { ?>
									<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?i=<?php echo $_REQUEST['i'] + 1; ?>"><i class="fa-solid fa-angle-right"></i></a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</section>
			<?php }

			?>
</body>

</html>
<?php }
	} ?>
<?php if ($_SESSION['user_rol'] == "2") {
	if (isset($_REQUEST['submit-buscar'])) {
		$id_maestro = $_SESSION['user_id'];
		$buscar = $_REQUEST['buscar'];
		$stmt = $connection->prepare("SELECT * FROM `alumnos` INNER JOIN clases ON alumnos.grado = clases.grado AND clases.grado = alumnos.grado AND clases.seccion = alumnos.seccion AND alumnos.nombre LIKE '%$buscar%' OR alumnos.edad LIKE '%$buscar%' OR alumnos.direccion LIKE '%$buscar%' OR alumnos.grado LIKE '%$buscar%' OR alumnos.id LIKE '%$buscar%' INNER JOIN maestros ON clases.id_maestro = maestros.dpi WHERE maestros.dpi = '$id_maestro' ORDER BY alumnos.grado");
		$stmt->execute();
		$array = $stmt->fetchAll(PDO::FETCH_UNIQUE);

		$r = array_keys($array);
		if (!$r) {
?>
			<div class="contenedor-error">
				<div class="contenido">
					<h1>NO HAY DATOS PARA SU BÚSQUEDA</h1>
				</div>
			</div>

		<?php
		}
		?>
		<section class="tarjetas">
			<div class="contenedor-tarjetas">
				<?php
				if (isset($_REQUEST['i'])) {
					$ruta = $_REQUEST['i'];
				}
				if ($ruta >= 1) {
					$init = ($ruta - 1) * 3;
					$max = $init + 3;
				} else {
					$ruta = 1;
					$init = 0;
					$max = $init + 3;
				}
				for ($i = $init; $i < $max; $i++) {
					$id = $r[$i];
					$query = $connection->prepare('SELECT * FROM alumnos WHERE id = :id');
					$query->bindParam('id', $id, PDO::PARAM_STR);
					$query->execute();
				?>
					<?php while ($result = $query->fetch(PDO::FETCH_ASSOC)) { ?>
						<div class="card">
							<div class="content">
								<div class="details">
									<h2><?php echo $result['nombre']
										?><br><span><?php echo $result['telencargado']
													?> - <b><?php echo $result['telpersonal']
															?></b></span></h2>
									<div class="data">
										<h3><?php echo $result['edad']
											?> años<br><span>Edad</span></h3>
										<h3><?php echo $result['grado']
											?> Básico <?php echo $result['seccion']
														?><br><span>Grado</span></h3>
										<h3><?php echo $result['id']
											?><br><span>Código</span></h3>
										<h3><?php echo $result['encargado']
											?><br><span>Encargado</span></h3>
									</div>
									<div class="actionBtn">
										<form action="notasAlumnos.php" method="POST">
											<input type="hidden" name="id" value="<?php echo $result['id'] ?>">
											<input type="hidden" name="grado" value="<?php echo $result['grado'] ?>">
											<input type="hidden" name="seccion" value="<?php echo $result['seccion'] ?>">
											<input type="hidden" name="nombre" value="<?php echo $result['nombre'] ?>">
											<input type="submit" name="verNotas" class="btn-enviar" value="Ver Notas">
										</form>
									</div>
								</div>
							</div>
						</div>
				<?php }
				} ?>
			</div>
		</section>
		<?php $paginas = ceil(count($r) / 3); ?>
		<section class="paginacion">
			<div class="contenedor-selector">
				<div class="selector">
					<ul>
						<?php if ($_REQUEST['i'] <= 1) { ?>
							<li><a class="no-link"><i class="fa-solid fa-angle-left"></i></a></li>
						<?php } else { ?>
							<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?submit-buscar=true&buscar=<?php echo $_REQUEST['buscar']; ?>&i=<?php echo $_REQUEST['i'] - 1; ?>"><i class="fa-solid fa-angle-left"></i></a></li>
						<?php } ?>

						<?php for ($i = 1; $i <= $paginas; $i++) {
							if ($_REQUEST['i'] == $i) {
						?>
								<li><a class="active" href="<?php echo $_SERVER['PHP_SELF']; ?>?submit-buscar=true&buscar=<?php echo $_REQUEST['buscar']; ?>&i=<?php echo $i; ?>"><?php echo $i; ?></a></li>
							<?php } else { ?>
								<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?submit-buscar=true&buscar=<?php echo $_REQUEST['buscar']; ?>&i=<?php echo $i; ?>"><?php echo $i; ?></a></li>
						<?php }
						} ?>

						<?php if ($_REQUEST['i'] >= $paginas) { ?>
							<li><a class="no-link"><i class="fa-solid fa-angle-right"></i></a></li>
						<?php } else { ?>
							<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?submit-buscar=true&buscar=<?php echo $_REQUEST['buscar']; ?>&i=<?php echo $_REQUEST['i'] + 1; ?>"><i class="fa-solid fa-angle-right"></i></a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</section>
		</body>

		</html>
	<?php
	} else {

		$id_maestro = $_SESSION['user_id'];

		$consulta = $connection->prepare("SELECT * FROM `alumnos` INNER JOIN clases ON alumnos.grado = clases.grado AND clases.grado = alumnos.grado AND clases.seccion = alumnos.seccion INNER JOIN maestros ON clases.id_maestro = maestros.dpi WHERE maestros.dpi = '$id_maestro' ORDER BY alumnos.grado"
		);
		$resultado = $consulta->execute();

		$array = $consulta->fetchAll(PDO::FETCH_UNIQUE);

		$r = array_keys($array);
	?>
		<section class="tarjetas">
			<div class="contenedor-tarjetas">
				<?php
				if (isset($_REQUEST['i'])) {
					$ruta = $_REQUEST['i'];
				}
				if ($ruta >= 1) {
					$init = ($ruta - 1) * 3;
					$max = $init + 3;
				} else {
					$ruta = 1;
					$init = 0;
					$max = $init + 3;
				}
				for ($i = $init; $i < $max; $i++) {
					$id = $r[$i];
					$query = $connection->prepare('SELECT * FROM alumnos WHERE id = :id');
					$query->bindParam('id', $id, PDO::PARAM_STR);
					$query->execute();
				?>
					<?php while ($result = $query->fetch(PDO::FETCH_ASSOC)) { ?>
						<div class="card">
							<div class="content">
								<div class="details">
									<h2><?php echo $result['nombre']
										?><br><span><?php echo $result['telencargado']
													?> - <b><?php echo $result['telpersonal']
															?></b></span></h2>
									<div class="data">
										<h3><?php echo $result['edad']
											?> años<br><span>Edad</span></h3>
										<h3><?php echo $result['grado']
											?> Básico <?php echo $result['seccion']
														?><br><span>Grado</span></h3>
										<h3><?php echo $result['id']
											?><br><span>Código</span></h3>
										<h3><?php echo $result['encargado']
											?><br><span>Encargado</span></h3>
									</div>
									<div class="actionBtn">
										<form action="notasAlumnos.php" method="POST">
											<input type="hidden" name="id" value="<?php echo $result['id'] ?>">
											<input type="hidden" name="grado" value="<?php echo $result['grado'] ?>">
											<input type="hidden" name="seccion" value="<?php echo $result['seccion'] ?>">
											<input type="hidden" name="nombre" value="<?php echo $result['nombre'] ?>">
											<input type="submit" name="verNotas" class="btn-enviar" value="Ver Notas">
										</form>
									</div>
								</div>
							</div>
						</div>
				<?php }
				} ?>
			</div>
		</section>
		<?php $paginas = ceil(count($r) / 3); ?>
		<section class="paginacion">
			<div class="contenedor-selector">
				<div class="selector">
					<ul>
						<?php if ($_REQUEST['i'] <= 1) { ?>
							<li><a class="no-link"><i class="fa-solid fa-angle-left"></i></a></li>
						<?php } else { ?>
							<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?i=<?php echo $_REQUEST['i'] - 1; ?>"><i class="fa-solid fa-angle-left"></i></a></li>
						<?php } ?>

						<?php for ($i = 1; $i <= $paginas; $i++) {
							if ($_REQUEST['i'] == $i) {
						?>
								<li><a class="active" href="<?php echo $_SERVER['PHP_SELF']; ?>?i=<?php echo $i; ?>"><?php echo $i; ?></a></li>
							<?php } else { ?>
								<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?i=<?php echo $i; ?>"><?php echo $i; ?></a></li>
						<?php }
						} ?>

						<?php if ($_REQUEST['i'] >= $paginas) { ?>
							<li><a class="no-link"><i class="fa-solid fa-angle-right"></i></a></li>
						<?php } else { ?>
							<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?i=<?php echo $_REQUEST['i'] + 1; ?>"><i class="fa-solid fa-angle-right"></i></a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</section>
		</body>

		</html>
<?php }
} ?>