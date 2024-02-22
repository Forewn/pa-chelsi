<?php
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
    $sentencia = ("SELECT inscripcion.*, estudiante.nombres AS nombres_estudiante, estudiante.apellidos AS apellidos_estudiante,
    periodo_academico.fecha_inicio, periodo_academico.fecha_fin, niveles.descripcion AS nivel_descripcion, periodo_academico.nombre, secciones.nombre as seccion 
FROM inscripcion
INNER JOIN estudiante ON inscripcion.cedula_escolar = estudiante.cedula_escolar
INNER JOIN periodo_academico ON inscripcion.codigo_periodo = periodo_academico.codigo_periodo
INNER JOIN nivel_seccion ON inscripcion.codigo_nivelseccion = nivel_seccion.codigo_nivelseccion
INNER JOIN niveles ON niveles.codigo_niveles=nivel_seccion.codigo_niveles
INNER JOIN secciones ON secciones.codigo_seccion=nivel_seccion.codigo_seccion;");
    $mostrar = mysqli_query($conexion, $sentencia);
    ?>
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Matricula</h4>
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
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabla de Periodos Academicas</h5>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Codigo Inscripcion</th>
                                            <th>Nombre Estudiante</th>
                                            <th>Apellido Estudiante</th>
                                            <th>Nivel</th>
                                            <th>Seccion</th>
                                            <th>Periodo</th>
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Fin</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($r = mysqli_fetch_array($mostrar)) {
                                            $nivelDescripcion = $r['nivel_descripcion'];

                                            ?>
                                            <tr>
                                                <th>
                                                    <?php echo $r['codigo_inscripcion'] ?>
                                                </th>
                                                <th>
                                                    <?php echo $r['nombres_estudiante'] ?>
                                                </th>
                                                <th>
                                                    <?php echo $r['apellidos_estudiante'] ?>
                                                </th>

                                                <th>
                                                    <?php echo $nivelDescripcion ?>
                                                </th>

                                                <th>
                                                    <?php echo $r['seccion'] ?>
                                                </th>
                                                <th>
                                                    <?php echo $r['nombre'] ?>
                                                </th>
                                                <th>
                                                    <?php echo $r['fecha_inicio'] ?>
                                                </th>
                                                <th>
                                                    <?php echo $r['fecha_fin'] ?>
                                                </th>
                                                <th>
                                                    <div class="constancia-btn">
                                                        <?php echo "<a class='btn btn-success btn-sm' href='../php/generar_constancia.php?codigo_inscripcion=" . $r['codigo_inscripcion'] . "' target='_blank'><i class='fa fa-edit'></i>&nbsp; Generar Constancia de Inscripcion</a>"; ?>
                                                    </div>
                                                    <div class="constancia-btn">
                                                        <?php echo "<a class='btn btn-primary btn-sm' href='../php/generar_constanciaestudio.php?codigo_inscripcion=" . $r['codigo_inscripcion'] . "&cedula_escolar=" . $r['cedula_escolar'] . "' target='_blank'><i class='fa fa-edit'></i>&nbsp; Generar Constancia de Estudio</a>"; ?>
                                                    </div>
                                                    <div class="constancia-btn">
                                                        <?php
                                                        if ($nivelDescripcion == 'Grupo C') {
                                                            echo "<a class='btn btn-success btn-sm' href='../php/generar_constancia_graduacion.php?codigo_inscripcion=" . $r['codigo_inscripcion'] . "&cedula_escolar=" . $r['cedula_escolar'] . "' target='_blank'><i class='fa fa-graduation-cap'></i>&nbsp; Generar Constancia de Graduación</a>";
                                                        }
                                                        ?>
                                                    </div>
                                                </th>
                                            </tr>

                                            <?php
                                            include 'modales/eliminar_nivel.php';
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