<?php
include('../backend/conexion.php');
session_start();
if (!$_SESSION['autentificado']) {
    header('Location: ../');
    exit;
}
if ($_SESSION['user_rol'] != "3") {
    header('Location: ../');
    exit;
}

$id_nombre = $_SESSION['user_id'];
$headerQuery = $connection->prepare("SELECT * FROM alumnos WHERE id=:id_nombre LIMIT 1");
$headerQuery->bindParam("id_nombre", $id_nombre, PDO::PARAM_STR);
$resultadoHeader = $headerQuery->execute();
$rNombre = $headerQuery->fetch(PDO::FETCH_ASSOC);
$nombreHeader = explode(' ', $rNombre['nombre']);

$bd = 'bd_ineb';
$query = $connection->prepare("SELECT table_name AS nombre FROM information_schema.tables WHERE table_schema = 'bd_ineb'");
$query->execute();
$i = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/homeAdmin.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Alumno</title>
</head>

<body>
    <section>
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <h5 class="my-3" style="text-transform: uppercase; font-weight: 900;"><?php echo $nombreHeader[0] . ' ' . $nombreHeader[2]; ?></h5>
                            <p class="text-muted mb-1"><strong><?php echo $rNombre['grado'] ?> Básico</strong></p>
                            <p class="text-muted mb-4"><?php echo $rNombre['direccion'] ?></p>
                            <div class="d-flex justify-content-center mb-2">
                                <button id='btn-cerrar_sesion' type="button" class="btn btn-outline-primary ms-1">Cerrar Sesión</button>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 mb-lg-0">
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush rounded-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fas fa-globe fa-lg text-warning"></i>
                                    <p class="mb-0">https://inebcerritos.com</p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                                    <p class="mb-0">Paola Hernández</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Código Personal</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $rNombre['id'] ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Nombre Completo</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $rNombre['nombre'] ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Edad</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $rNombre['edad'] ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Celular Personal</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo implode("-", str_split($rNombre['telpersonal'], 4)); ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Encargado</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $rNombre['encargado'] ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Celular del Encargado</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo implode("-", str_split($rNombre['telencargado'], 4)); ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Dirección</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $rNombre['direccion'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                        $grado_seccion = strtolower($rNombre['grado']) . '-' . strtolower($rNombre['seccion']);;
                        if (str_ends_with($result['nombre'], $grado_seccion)) {
                            $tabla = $result['nombre'];
                            $id = $_SESSION['user_id'];
                            $ingresarEnTabla = $connection->prepare("SELECT * FROM `$tabla` WHERE codPersonal = '$id'");
                            $ingresarEnTabla->execute();
                            $array = explode("-", $tabla);
                            $grado = strtoupper($array[1]);
                            $seccion = strtoupper($array[2]);
                            $clase = ucwords(str_replace('_', ' ', $array[0]));
                            $r = $ingresarEnTabla->fetchAll(PDO::FETCH_UNIQUE);
                    ?>
                            <div class="row mt-20">
                                <div class="col-md">
                                    <div class="card mb-4 mb-md-0">
                                        <div class="card-body p-4">
                                            <h3 class="mb-3"><?php echo $clase; ?></h3>
                                            <p class="small mb-0"><i class="far fa-star fa-lg"></i> <span class="mx-2">Primer Bimestre |</span>Nota:
                                                <strong id="b1<?php echo $i ?>"><?php echo $r['C688HVR']['b1']; ?></strong>
                                            </p>
                                            <p class="small mb-0"><i class="far fa-star fa-lg"></i> <span class="mx-2">Segundo Bimestre |</span>Nota:
                                                <strong id="b2<?php echo $i ?>"><?php echo $r['C688HVR']['b2']; ?></strong>
                                            </p>
                                            <p class="small mb-0"><i class="far fa-star fa-lg"></i> <span class="mx-2">Tercer Bimestre |</span>Nota:
                                                <strong id="b3<?php echo $i ?>"><?php echo $r['C688HVR']['b3']; ?></strong>
                                            </p>
                                            <p class="small mb-0"><i class="far fa-star fa-lg"></i> <span class="mx-2">Cuarto Bimestre |</span>Nota:
                                                <strong id="b4<?php echo $i ?>"><?php echo $r['C688HVR']['b4']; ?></strong>
                                            </p>
                                            <hr class="my-4">
                                            <div class="d-flex justify-content-start align-items-center">
                                                <p class="mb-0 text-uppercase"><i class="fas fa-cog me-2"></i> <span class="text-muted small">Promedio: </span><strong id="promedio<?php echo $i ?>">0</strong></p>
                                                <script>
                                                    vB1 = $('#b1<?php echo $i ?>').html();
                                                    vB2 = $('#b2<?php echo $i ?>').html();
                                                    vB3 = $('#b3<?php echo $i ?>').html();
                                                    vB4 = $('#b4<?php echo $i ?>').html();
                                                    vPromedio = ($('#promedio<?php echo $i ?>'));
                                                    if (vB2 != 0 && vB2 != 0 && vB3 != 0 && vB4 != 0) {
                                                        promedio = parseInt(vB1) + parseInt(vB2) + parseInt(vB3) + parseInt(vB4);
                                                        promedio = promedio / 4;
                                                        promedio = Math.ceil(promedio);
                                                        console.log(promedio);
                                                        vPromedio.html('<b>' + promedio + '<b>');
                                                    }
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php $i++;
                        }
                    }
                    ?>
                </div>
            </div>
    </section>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"></script>
    <script>
        $('#btn-cerrar_sesion').click(function() {
            window.location.href = '../backend/cerrar_sesion.php';
        });
    </script>
</body>

</html>