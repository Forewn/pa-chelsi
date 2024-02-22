<?php

include 'conexion.php';

$codigo_niveles = $_POST['codigo_niveles'];
$codigo_seccion = $_POST['codigo_seccion'];

// Validar si ya existe una entrada con los mismos valores
$consultaExistencia = "SELECT * FROM nivel_seccion WHERE codigo_niveles = '$codigo_niveles' AND codigo_seccion = '$codigo_seccion'";
$resultadoExistencia = mysqli_query($conexion, $consultaExistencia);

if (mysqli_num_rows($resultadoExistencia) > 0) {
    // Ya existe una entrada con los mismos valores
    echo '
        <script>
            alert("Ya existe un registro con este Nivel y Sección");
            window.location="../admin/acciones/agregar_nise.php";
        </script>
    ';
} else {
    // No existe una entrada con los mismos valores, realizar la inserción
    $query = "INSERT INTO nivel_seccion(codigo_niveles, codigo_seccion) VALUES ('$codigo_niveles', '$codigo_seccion')";
    $queri = mysqli_query($conexion, $query);

    if ($queri) {
        echo '
            <script>
                alert("NIVEL/SECCIÓN REGISTRADO");
                window.location="../admin/niveles.php";
            </script>
        ';
    } else {
        echo '
            <script>
                alert("NIVEL/SECCIÓN NO REGISTRADO");
                window.location="../admin/acciones/agregar_nise.php";
            </script>
        ';
    }
}

mysqli_close($conexion);
?>
