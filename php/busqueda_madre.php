<?php
// Incluye el archivo de conexión a la base de datos
include_once '../php/conexion.php';

// Verifica si se ha enviado la cédula de la madre
if (isset($_POST['cedulaMama'])) {
    $cedulaMama = $_POST['cedulaMama'];

    // Query para buscar la madre por cédula
    $sql = "SELECT * FROM mama WHERE cedula_mama = '$cedulaMama'";
    $result = $conexion->query($sql);

    // Inicializa un array para almacenar la información de la madre
    $madreInfo = array();

    if ($result->num_rows > 0) {
        // La madre existe, obtén la información
        $row = $result->fetch_assoc();
        $madreInfo['apellidos'] = $row['apellidos'];
        $madreInfo['nombres'] = $row['nombres'];
        $madreInfo['codigoCivil'] = $row['codigo_estadocivil'];
        $madreInfo['nacionalidad'] = $row['codigo_nacionalidad'];
        $madreInfo['edad'] = $row['edad'];
        $madreInfo['direccionHabitacion'] = $row['direccion_habitacion'];
        $madreInfo['telefonoHabitacion'] = $row['telefono_habitacion'];
        $madreInfo['direccionTrabajo'] = $row['direccion_trabajo'];
        $madreInfo['telefonoTrabajo'] = $row['telefono_trabajo'];
        $madreInfo['nivelAcademico'] = $row['codigo_nivelacademico'];
        $madreInfo['ocupacion'] = $row['ocupacion'];
        $madreInfo['profesion'] = $row['profesion'];
        $madreInfo['correo'] = $row['correo'];
        $madreInfo['datosExtras'] = $row['datos_extras'];
        // Convierte el array a formato JSON y lo devuelve
        echo json_encode($madreInfo);
    } else {
        // Representante no encontrado, devolver null
        echo json_encode(null);
    }

} else {
    // Si no se ha enviado la cédula, devuelve un mensaje de error
    echo "Error: No se ha proporcionado la cédula de la madre.";
}

// Cierra la conexión a la base de datos
$conexion->close();
?>