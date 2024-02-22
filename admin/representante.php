﻿<?php
session_start();

if (!isset($_SESSION['codigo_usuario'])) {
    echo '
    <script>
            alert("Por favor debes iniciar sesión");
            window.location = "../index.php";
    </script>';
    session_destroy();
    die();
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title></title>
    <link href="../assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/extra-libs/multicheck/multicheck.css">
    <link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="../dist/css/style.min.css" rel="stylesheet">
    <link href="css/formulario.css" rel="stylesheet">
</head>

<body>
    <?php
    include 'includes/navbar.php';
    include '../php/conexion.php';
    $sentencia = ("SELECT a.*, b.descripcion, e.estado FROM representante_legal a, parentesco b, estado e WHERE
    b.codigo_parentesco=a.codigo_parentesco and e.codigo_estado=a.codigo_estado");
    $mostrar = mysqli_query($conexion, $sentencia);
    ?>
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Representantes Legales</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="border-top">
                        <div class="card-body">
                            


                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabla de Representantes</h5>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Cedula</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Telefono</th>
                                            <th>Parentesco</th>
                                            <th>Foto del Representante</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        while ($r = mysqli_fetch_array($mostrar)) {
                                            $estado = $r['codigo_estado'];
                                            $clase_estado = ($estado == 1) ? 'badge badge-success custom-badge' : 'badge badge-danger custom-badge';

                                        ?>
                                            <?php
                                            if (isset($_GET['error'])) {
                                                $mensaje_error = urldecode($_GET['error']);
                                                echo '<div class="alert alert-danger">' . $mensaje_error . '</div>';
                                            }
                                            ?>

                                            <tr>
                                                <th><?php echo $r['cedula_representante'] ?></th>
                                                <th><?php echo $r['nombres'] ?></th>
                                                <th><?php echo $r['apellidos'] ?></th>
                                                <th><?php echo $r['telefono'] ?></th>
                                                <th><?php echo $r['descripcion'] ?></th>
                                                <th><button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#ver<?php echo $r['cedula_representante']; ?>">Ver Foto</button></th>
                                                <th><span class="<?php echo $clase_estado; ?>"><?php echo $r['estado']; ?></span></th>
                                                <th><?php echo "<a class='btn btn-success btn-sm'href='acciones/editar_representante.php?id=" . $r['cedula_representante'] . "'><i class='fa fa-edit'></i></a>"; ?>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#elim<?php echo $r['cedula_representante']; ?>"><i class="fa fa-trash"></i></button>
                                                </th>
                                            </tr>

                                        <?php
                                            include 'modales/foto_representante.php';
                                            include 'modales/eliminar_representante.php';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="..//libs/popper.js/dist/umd/popper.min.js"></script>
        <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
        <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
        <script src="../dist/js/waves.js"></script>
        <script src="../dist/js/sidebarmenu.js"></script>
        <script src="../dist/js/custom.min.js"></script>
        <script src="../assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
        <script src="../assets/extra-libs/multicheck/jquery.multicheck.js"></script>
        <script src="../assets/extra-libs/DataTables/datatables.min.js"></script>
        <script>
            $('#zero_config').DataTable();
        </script>
</body>

</html>