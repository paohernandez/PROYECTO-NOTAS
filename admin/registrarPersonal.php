<?php
include('../backend/conexion.php');
session_start();
if (!$_SESSION['autentificado']) {
    header('Location: ../');
    exit;
}
if ($_SESSION['user_rol'] != "1") {
    header('Location: ../');
    exit;
}

if (isset($_POST['registrar'])) {

    $id = $_POST['id'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $rol = $_POST['rol'];

    $query = $connection->prepare("SELECT * FROM usuarios WHERE id=:id");
    $query->bindParam("id", $id, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() > 0) {
        echo '<p class="error">Este DPI ya ha sido registrado!</p>';
        header('location: http://localhost/TRABAJO%20PAOLA/admin/registrarPersonal.php');
    }

    if ($query->rowCount() == 0) {
        $query = $connection->prepare("INSERT INTO usuarios(id, usuario, password, rol) VALUES (:id,:usuario,:password_hash,:rol)");
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $query->bindParam("usuario", $usuario, PDO::PARAM_STR);
        $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
        $query->bindParam("rol", $rol, PDO::PARAM_STR);
        $result = $query->execute();

        if ($result) {
            echo '<p class="success">Tu registro se ha completado!</p>';
            header('location: ' . $_SERVER['PHP_SELF']);
        } else {
            echo '<p class="error">Algo ha ido mal!</p>';
            header('location: ' . $_SERVER['PHP_SELF']);
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
    <title>Registrar Personal | Gestor de Notas</title>
</head>

<body>
    <?php include_once("../vistas/header.php"); ?>
    <form action='<?php echo $_SERVER['PHP_SELF'] ?>' method='POST'>
        <div class="contenedor">
            <h1>Registrar Personal</h1>
            <div class="contenedor__inputs">
                <input type="text" name="id" placeholder="Código Personal o DPI" autocomplete="off" campo="texto" required>
                <input type="text" name="usuario" placeholder="Usuario" autocomplete="off" campo="texto" required>
                <div class="password">
                    <div class="pass-input">
                        <input type="password" id="pass" name="password" placeholder="Contraseña" autocomplete="off" required>
                        <label for="check" id="label-pass"><i class="fa-solid fa-eye"></i></label>
                        <input type="checkbox" name="check" id="check">
                    </div>
                    <div class="generar btn-generar">
                        <a><i class="fa-solid fa-key"></i></a>
                    </div>
                </div>
                <div class="seleccionar-bimestre">
                    <select name="rol">
                        <option value="" selected disabled>Rol</option>
                        <option value="1">Director</option>
                        <option value="2">Maestro</option>
                        <option value="3">Alumno</option>
                    </select>
                </div>
                <input type='submit' name='registrar' value='Registrar'>
            </div>
        </div>
    </form>
    <script src="../js/passwordGen.js"></script>
    <script>
        $('.btn-generar').click(function() {
            $('#pass').val(generatePassword());
        });
    </script>
    <script type='text/javascript'>
        $(document).ready(function() {
            $('#check').click(function() {
                if ($(this).is(':checked')){
                    $('#pass').attr('type', 'text');
                    $('#label-pass').html('<i class="fa-solid fa-eye-slash"></i>');
                } else {
                    $('#pass').attr('type', 'password');
                    $('#label-pass').html('<i class="fa-solid fa-eye"></i>');
                }
            });
        });
    </script>
</body>

</html>