<?php
session_start();
unset($_SESSION["user_id"]);
unset($_SESSION["user_rol"]);
unset($_SESSION["autentificado"]);
session_destroy();
header('location: ../');
?>