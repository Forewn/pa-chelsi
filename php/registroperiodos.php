<?php

include 'conexion.php';

$codigo_periodo = $_POST['codigo_periodo'];
$nombre = $_POST['nombre'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];

$query = "INSERT INTO periodo_academico(codigo_periodo, nombre, fecha_inicio, fecha_fin)
VALUES ('$codigo_periodo', '$nombre', '$fecha_inicio','$fecha_fin')";

$verificando_codigo_periodo = mysqli_query($conexion, "SELECT * FROM periodo_academico where codigo_periodo='$codigo_periodo'");
if (mysqli_num_rows($verificando_codigo_periodo) > 0) {

    echo '
   <script>
        alert("Esta codigo ya esta registrado, intenta con uno nuevo");           
        window.location = "../admin/acciones/agregar_periodos.php";
        </script>

';
    exit();
}


$queri = mysqli_query($conexion, $query);
if ($queri) {

    echo '
          <script>
          alert ("PERIODO REGISTRADO");
          window.location="../admin/periodos.php";
          </script>
      
      ';
} else {
    echo '
           <script>
           alert ("PERIODO NO REGISTRADO");
           window.location="../admin/acciones/agregar_periodos.php";
           </script>
      
      
      ';
}
mysqli_close($conexion);
