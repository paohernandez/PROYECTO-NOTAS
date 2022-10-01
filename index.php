<?php

include('backend/conexion.php');
session_start();
error_reporting(0);

if ($_SESSION['user_rol'] == "1" || $_SESSION['user_rol'] == "2") {
    header('Location: admin/');
    exit;
}

if ($_SESSION['user_rol'] == "3") {
    header('Location: usuario/');
    exit;
}

if (isset($_POST['login'])) {

    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $query = $connection->prepare("SELECT * FROM usuarios WHERE usuario=:usuario");
    $query->bindParam("usuario", $usuario, PDO::PARAM_STR);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        $error = true;
        $isUser = true;
        $isPassword = false;
        $usernoexist = '"El usuario no existe!"';
        header('location: http://localhost/TRABAJO%20PAOLA/');
    }
    if (password_verify($password, $result['password'])) {
        $error = false;
        $_SESSION['user_id'] = $result['id'];
        $_SESSION['user_rol'] = $result['rol'];
        $_SESSION['autentificado'] = true;
        if ($result['rol'] == '1' || $result['rol'] == '2') {
            header('location: admin/home.php');
        }
        if ($result['rol'] == '3') {
            header('location: usuario/');
        }
    } else {
        $isUser = false;
        $isPassword = true;
        $error = true;
        $userandpasswordnoexist = '"La combinación de nombre de usuario y contraseña es incorrecta!"';
        header('location: ', $_SERVER['PHP_SELF']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/notificaciones.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://kit.fontawesome.com/26c6a8a648.js" crossorigin="anonymous"></script>
    <title>Inicio de sesión | Gestor de Notas</title>
</head>

<body>
    <div class="contenedor">
        <div class="login">
            <form action='<?php echo $_SERVER['PHP_SELF'] ?>' method='post'>
                <div class="contenedor">
                    <div class="logo"><img src="img/INEB.png" alt="" height="100"></div>
                    <h1>INICIO DE SESIÓN</h1>
                    <div class="contenedor__inputs">
                        <input type='text' name='usuario' placeholder="Usuario" autocomplete="off">
                        <input type='password' name='password' placeholder="Contraseña">
                        <input type='submit' name="login" value='Iniciar Sesión'>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="toast">
        <div class="toast-content">
            <i class="fa-solid fa-triangle-exclamation check"></i>

            <div class="message">
                <span class="text text-1"></span>
                <span class="text text-2"></span>
            </div>
        </div>
        <i class="fa-solid fa-xmark close"></i>

        <div class="progress"></div>
    </div>

    <script>
        const button = document.querySelector("button"),
            toast = document.querySelector(".toast");
        let text1 = document.querySelector(".text-1"),
            text2 = document.querySelector(".text-2");
        (closeIcon = document.querySelector(".close")),
        (progress = document.querySelector(".progress"));

        let timer1, timer2;

        function mostrarAlerta(message, isError) {
            toast.classList.add("active");
            progress.classList.add("active");

            text1.innerHTML = isError;
            text2.innerHTML = message;

            timer1 = setTimeout(() => {
                toast.classList.remove("active");
            }, 5000); //1s = 1000 milliseconds

            timer2 = setTimeout(() => {
                progress.classList.remove("active");
            }, 5300);
        }

        closeIcon.addEventListener("click", () => {
            toast.classList.remove("active");

            setTimeout(() => {
                progress.classList.remove("active");
            }, 300);

            clearTimeout(timer1);
            clearTimeout(timer2);
        });
    </script>

    <?php if ($error && $isPassword) {
        echo '<script>mostrarAlerta(',$userandpasswordnoexist,', "Error");</script>';
    } elseif ($error && $isUser) {
        echo '<script>mostrarAlerta(',$usernoexist,', "Error");</script>';
    } ?>


</body>

</html>