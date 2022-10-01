<?php
/* $conexion = mysqli_connect("localhost", "root", "", "bd_ineb");
$conexion->set_charset("utf8");
$id = $_POST['id'];
$nota = $_POST['nota'];
$nombreTabla = $_POST['tabla'];

if ($_POST['bimestre'] == 'PRIMERO') {
    $sentencia = "UPDATE `$nombreTabla` SET b1='$id' WHERE codPersonal = '$id'";
    mysqli_query($conexion, $sentencia);
    header('Location: ' . $_SERVER['PHP_SELF']);
}
if ($_POST['bimestre'] == 'SEGUNDO') {
    $sentencia = "UPDATE `$nombreTabla` SET b2='$id' WHERE codPersonal = '$id'";
    mysqli_query($conexion, $sentencia);
    header('Location: ' . $_SERVER['PHP_SELF']);
}
if ($_POST['bimestre'] == 'TERCERO') {
    $sentencia = "UPDATE `$nombreTabla` SET b3='$id' WHERE codPersonal = '$id'";
    mysqli_query($conexion, $sentencia);
    header('Location: ' . $_SERVER['PHP_SELF']);
}
if ($_POST['bimestre'] == 'CUARTO') {
    $sentencia = "UPDATE `$nombreTabla` SET b4='$id' WHERE codPersonal = '$id'";
    mysqli_query($conexion, $sentencia);
    header('Location: ' . $_SERVER['PHP_SELF']);
} */

   
function randomPassword ($length = 8)
{
  $genpassword = "";
  $possible = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $i = 0;
  while ($i < $length) {
    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
    if (!strstr($genpassword, $char)) {
      $genpassword .= $char;
      $i++;
    }
  }
  return $genpassword;
}
?>
<input type="text" class="form-control"  value="<?php echo randomPassword(); ?>">