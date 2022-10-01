<?php
include('../backend/acentos.php');
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

$bd = 'bd_ineb';
$query = $connection->prepare("SELECT table_name AS nombre FROM information_schema.tables WHERE table_schema = 'bd_ineb'");
$query->execute();

$i = 1;

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/notas.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://kit.fontawesome.com/26c6a8a648.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div class="volver">
        <a class="btn-volver"><i class="fa-solid fa-arrow-left"></i> <span>Volver</span></a>
    </div>
    <div class="imprimir btn-imprimir">
        <a><i class="fa-solid fa-print"></i></a>
    </div>
    <?php if ($_SESSION['user_rol'] == "1") { ?>
        <section class="notas">
            <div class="row">
                <div class="col-md-12" id="notas">
                    <div class="cabecera">
                        <h5 class="titulo"> Tarjeta de Calificaciones Ciclo Escolar 2022 </h5>
                    </div>
                    <!--  CONTENIDO DE LA VENTANA-->
                    <div class="modal-body">
                        <table class="table table-Condensed" cellspacing="0" cellpadding="0">
                            <tr>
                                <th class="titulos">
                                    <h5>Instituto Nacional de Educación Básica Cerritos</h5>
                                    <h5>Los Cerritos, Sansare, El Progreso</h5>
                                </th>
                                <th>
                                    <center>
                                        <img src="../img/logoINEB.png" alt="" height="60">
                                        <h6><b>INEB Cerritos</b></h6>
                                    </center>
                                </th>
                            </tr>
                            <tr>
                                <td class="active">Nombre del Alumno: <strong><?php echo $_POST['nombre'] ?></strong></td>
                                <td class="active">Código Personal: <strong><?php echo $_POST['id'] ?></strong></td>
                            </tr>
                        </table>
                        <table class="table table-condensed table-hover table-bordered">
                            <tr>
                                <td colspan="7" class="active">
                                    <center><strong><?php echo $_POST['grado'] ?> Básico</strong> Sección: <strong> <?php echo $_POST['seccion'] ?></strong></center>
                                </td>
                            </tr>
                            <tr class="active" align="center">
                                <th>#</th>
                                <th>Clase</th>
                                <th>B1</th>
                                <th>B2</th>
                                <th>B3</th>
                                <th>B4</th>
                                <th>Promedio</th>
                            </tr>
                            <?php
                            while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                                $grado_seccion = strtolower($_POST['grado'] . '-' . $_POST['seccion']);
                                $id = $_POST['id'];
                                if (str_ends_with($result['nombre'], $grado_seccion)) {
                                    $tabla = $result['nombre'];
                                    $clases = $connection->prepare("SELECT nombre,b1,b2,b3,b4 FROM `$tabla` WHERE codPersonal=:id");
                                    $clases->bindParam('id', $id, PDO::PARAM_STR);
                                    $clases->execute();
                                    $resultado = $clases->fetch();
    
                                    $array = explode("-", $result['nombre']);
                                    $grado = strtoupper($array[1]);
                                    $seccion = strtoupper($array[2]);
                                    $clase = ucwords(str_replace('_', ' ', $array[0]));
                            ?>
    
                                    <td class="active"><?php echo $i ?></td>
                                    <td><?php echo $clase ?></td>
                                    <td id="b1<?php echo $i ?>"><?php echo $resultado['b1'] ?></td>
                                    <td id="b2<?php echo $i ?>"><?php echo $resultado['b2'] ?></td>
                                    <td id="b3<?php echo $i ?>"><?php echo $resultado['b3'] ?></td>
                                    <td id="b4<?php echo $i ?>"><?php echo $resultado['b4'] ?></td>
                                    <td id="promedio<?php echo $i ?>" class="success"><b>0</b></td>
                                    </tr>
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
    
                            <?php $i++;
                                }
                            }
                            ?>
    
                        </table>
                        <div class="pie">
                            <div class="firma">
                                <div>f._______________________</div>
                                <div>Dirección</div>
                            </div>
                            <div class="timestamps">
                                <span class="fecha"></span>
                                <span class="hora"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>


    <?php if ($_SESSION['user_rol'] == "2") {
        $id_maestro = $_SESSION['user_id'];
        $stmt = $connection->prepare("SELECT * FROM clases WHERE id_maestro=:id_maestro");
        $stmt->bindParam("id_maestro", $id_maestro, PDO::PARAM_STR);
        $stmt->execute();
        $rstmt = $stmt->fetchAll();
    ?>
    <section class="notas">
        <div class="row">
            <div class="col-md-12" id="notas">
                <div class="cabecera">
                    <h5 class="titulo"> Tarjeta de Calificaciones Ciclo Escolar 2022 </h5>
                </div>
                <!--  CONTENIDO DE LA VENTANA-->
                <div class="modal-body">
                    <table class="table table-Condensed" cellspacing="0" cellpadding="0">
                        <tr>
                            <th class="titulos">
                                <h5>Instituto Nacional de Educación Básica Cerritos</h5>
                                <h5>Los Cerritos, Sansare, El Progreso</h5>
                            </th>
                            <th>
                                <center>
                                    <img src="../img/logoINEB.png" alt="" height="60">
                                    <h6><b>INEB Cerritos</b></h6>
                                </center>
                            </th>
                        </tr>
                        <tr>
                            <td class="active">Nombre del Alumno: <strong><?php echo $_POST['nombre'] ?></strong></td>
                            <td class="active">Código Personal: <strong><?php echo $_POST['id'] ?></strong></td>
                        </tr>
                    </table>
                    <table class="table table-condensed table-hover table-bordered">
                        <tr>
                            <td colspan="7" class="active">
                                <center><strong><?php echo $_POST['grado'] ?> Básico</strong> Sección: <strong> <?php echo $_POST['seccion'] ?></strong></center>
                            </td>
                        </tr>
                        <tr class="active" align="center">
                            <th>#</th>
                            <th>Clase</th>
                            <th>B1</th>
                            <th>B2</th>
                            <th>B3</th>
                            <th>B4</th>
                            <th>Promedio</th>
                        </tr>
                        <?php
                        while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                            foreach ($rstmt as $key => $value) {
                                $clase_maestro = strtolower(str_replace(' ', '_', eliminar_acentos($value['clase']))) . '-' . strtolower($value['grado']) . '-' . strtolower($value['seccion']);
                                $grado_seccion = strtolower($_POST['grado'] . '-' . $_POST['seccion']);
                                $id = $_POST['id'];
                                if (str_ends_with($result['nombre'], $grado_seccion)) {
                                    if ($result['nombre'] == $clase_maestro) {
                                        $tabla = $result['nombre'];
                                        $clases = $connection->prepare("SELECT nombre,b1,b2,b3,b4 FROM `$tabla` WHERE codPersonal=:id");
                                        $clases->bindParam('id', $id, PDO::PARAM_STR);
                                        $clases->execute();
                                        $resultado = $clases->fetch();

                                        $array = explode("-", $result['nombre']);
                                        $grado = strtoupper($array[1]);
                                        $seccion = strtoupper($array[2]);
                                        $clase = ucwords(str_replace('_', ' ', $array[0]));
                        ?>

                                        <td class="active"><?php echo $i ?></td>
                                        <td><?php echo $clase ?></td>
                                        <td id="b1<?php echo $i ?>"><?php echo $resultado['b1'] ?></td>
                                        <td id="b2<?php echo $i ?>"><?php echo $resultado['b2'] ?></td>
                                        <td id="b3<?php echo $i ?>"><?php echo $resultado['b3'] ?></td>
                                        <td id="b4<?php echo $i ?>"><?php echo $resultado['b4'] ?></td>
                                        <td id="promedio<?php echo $i ?>" class="success"><b>0</b></td>
                                        </tr>
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

                        <?php $i++;
                                    }
                                }
                            }
                        }
                        ?>

                    </table>
                    <div class="pie">
                        <div class="firma">
                            <div>f._______________________</div>
                            <div>Dirección</div>
                        </div>
                        <div class="timestamps">
                            <span class="fecha"></span>
                            <span class="hora"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    <script>
        var hoy = new Date();
        var ahora = hoy.toLocaleString();
        $('.fecha').html(ahora);
        console.log(ahora);

        $('.btn-volver').click(function() {
            window.history.back();
        });

        $('.btn-imprimir').click(function() {
            let element = document.getElementById('notas');
            var opt = {
                margin: 1,
                filename: 'Notas <?php echo $_POST['nombre'] ?>.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 5
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a4',
                    orientation: 'landscape'
                }
            };

            // New Promise-based usage:
            html2pdf().set(opt).from(element).save();
        });
    </script>
</body>

</html>