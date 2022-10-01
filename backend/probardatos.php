<?php
$bd = 'bd_ineb';
include('conexion.php');
$query = $connection->prepare("SELECT table_name AS nombre FROM information_schema.tables WHERE table_schema = 'bd_ineb'");
$query->execute();

while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
    //echo 'Tabla: ' . $result['nombre'] . '<br>';
    if (str_ends_with($result['nombre'], 'primero-a')) {
        echo "<br> ola <br>";
        echo $result['nombre'];
    }
}

/* $maestro = $_POST["maestro"];
$grado = $_POST["grado"];
$seccion = $_POST["seccion"];
$clases = $_POST["clases"];

//recorremos el array de cervezas seleccionadas. No olvidarse q la primera posición de un array es la 0

for ($i = 0; $i < count($clases); $i++) {
    $clase = str_replace(' ', '_', $clases[$i]);
    echo "<br><br>Maestro: " . $maestro;
    echo "<br>Grado: " . $grado;
    echo "<br>Clase: " . $clase;
    echo "<br>Seccion: " . $seccion . '<br>';
    $qry = "CREATE TABLE `$clase-$grado-$seccion` (
        `codPersonal` varchar(10) NOT NULL,
        `nombre` varchar(255) NOT NULL,
        `b1` int(3) NOT NULL,
        `b2` int(3) NOT NULL,
        `b3` int(3) NOT NULL,
        `b4` int(3) NOT NULL,
        `promedio` float NOT NULL)
    " . '<br>';
    echo $qry;
}
 */