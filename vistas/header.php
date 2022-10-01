<?php
$id_nombre = $_SESSION['user_id'];
$headerQuery = $connection->prepare("SELECT * FROM maestros WHERE dpi=:id_nombre");
$headerQuery->bindParam("id_nombre", $id_nombre, PDO::PARAM_STR);
$resultadoHeader = $headerQuery->execute();
$rNombre = $headerQuery->fetch(PDO::FETCH_ASSOC);
$nombreHeader = explode(' ', $rNombre['nombre']);
?>

<header class="header-menu">
	<div class="contenedor__menu" id="nav-menu">
		<div class="logo">
			<div class="logo_img"></div>
			<h1><?php echo $nombreHeader[0] . ' ' . $nombreHeader[2]; ?></h1>
		</div>
		<div class="menu">
			<nav id="nav">
				<ul class="elementos-nav">
					<li><a href="home.php" class="elemento-nav">Inicio</a></li>
					<?php if ($_SESSION['user_rol'] == "1") { ?>
						<li><a href="clases.php" class="elemento-nav">Clases</a></li>
					<?php } ?>
					<?php include_once("../vistas/dropdown.php"); ?>
				</ul>
			</nav>
		</div>
	</div>
</header>