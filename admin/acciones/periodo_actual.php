<?php
    require "../../php/conexion.php";
    $codigo = $_POST['periodo'];

    $sql = "UPDATE periodo_academico 
    SET actual = 0 
    WHERE codigo_periodo = (SELECT codigo_periodo FROM periodo_academico WHERE actual = 1);";

    if(mysqli_query($conexion, $sql) == 1){
        $sql = "UPDATE periodo_academico 
        SET actual = 1
        WHERE codigo_periodo = $codigo;";
        if(mysqli_query($conexion, $sql) == 1){
            echo 200;
        }
        else{
            echo 100;
        }
    }
    else{
        echo 101;
    }