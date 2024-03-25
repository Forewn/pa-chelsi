<?php
// Verificar si se recibieron los datos del formulario

use FontLib\Table\Type\head;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Aquí obtienes las variables del formulario
    $cedulaEscolar = $_POST['cedula_escolar'];
    $codigoNivelseccion = $_POST['codigo_nivelseccion'];
    $codigoPeriodo = $_POST['codigo_periodo'];
    $fecha = date('Y/m/d');

    include 'conexion.php';

    // Obtener el nombre del nivel directamente de la tabla nivel_seccion
    $sqlObtenerNivel = "SELECT niveles.descripcion
                        FROM nivel_seccion
                        INNER JOIN niveles ON nivel_seccion.codigo_niveles = niveles.codigo_niveles
                        WHERE nivel_seccion.codigo_nivelseccion = '$codigoNivelseccion'";
    
    $resultObtenerNivel = $conexion->query($sqlObtenerNivel);

    if ($resultObtenerNivel->num_rows > 0) {
        $rowNivel = $resultObtenerNivel->fetch_assoc();
        $nombreNivel = $rowNivel['descripcion'];

        // Verificar si ya existe una inscripción con la misma cédula escolar, nivel y periodo
        $sqlVerificarInscripcion = "SELECT * FROM inscripcion WHERE cedula_escolar = '$cedulaEscolar' AND codigo_periodo = '$codigoPeriodo'";
        $resultVerificarInscripcion = $conexion->query($sqlVerificarInscripcion);

        if ($resultVerificarInscripcion->num_rows > 0) {
            // Ya existe una inscripción para esta cédula y periodo
            echo '<script>alert("Ya existe una inscripción para esta cédula y periodo.");</script>';
            // echo '<script>window.location = "../admin/registroestudiante.php";</script>';
            echo '<script>window.location = "./generar_planillaInscripcion.php?codigo_inscripcion='.$codigoInscripcion.'"</script>';
            exit();
        } else {
            // No existe una inscripción duplicada, procede con la inserción
            $codigoInscripcion = $cedulaEscolar . '-' . $codigoPeriodo . '-' . $codigoNivelseccion;
            $sqlInscripcion = "INSERT INTO inscripcion (codigo_inscripcion, cedula_escolar, codigo_nivelseccion, codigo_periodo, fecha)
                              VALUES ('$codigoInscripcion', '$cedulaEscolar', '$codigoNivelseccion', '$codigoPeriodo', '$fecha')";

            if ($conexion->query($sqlInscripcion) === TRUE) {
                // Verificar si el nivel es "Grupo C" y cambiar el estado del estudiante a 2
                if ($nombreNivel == 'Grupo C') {
                    $sqlActualizarEstado = "UPDATE estudiante SET estado_estudiante = 2 WHERE cedula_escolar = '$cedulaEscolar'";
                    $conexion->query($sqlActualizarEstado);
                }
                echo '
                <script>
                    alert("Inscripción realizada con éxito.");
                </script>';
                header('Location: ./generar_planillaInscripcion.php?codigo_inscripcion='.$codigoInscripcion);
            } else {
                echo "Error al realizar la inscripción: " . $conexion->error;
            }
        }
    } else {
        echo "Error al obtener el nombre del nivel: " . $conexion->error;
    }

    // Cierra la conexión
    $conexion->close();
}
?>
