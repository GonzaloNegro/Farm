<?php
session_start();
include ("../Modelo/Conexion.php");

if(isset($_POST['btn1'])){
    $parcela1 = $_POST['cmbparcela1'];
    $proyecto1 = $_POST['nombre1'];
    $tipo1 = $_POST['cmbTipoProyecto1'];
    $cantidad1 = $_POST['cantHas1'];
    $estado1 = $_POST['cmbEstado1'];

    mysqli_query($conexion, "INSERT INTO proyectos VALUES(DEFAULT, '$parcela1', '$proyecto1', '$tipo1', '$cantidad1', '$estado1')");
}

if(isset($_POST['btn2'])){
    $parcela2 = $_POST['cmbparcela2'];
    $proyecto2 = $_POST['nombre2'];
    $cantidad2 = $_POST['cantHas2'];
    $estado2 = 3;/* Proyecto finalizado */
    $tipoPro =  $_POST['tipo'];
    $FechaInicial = $_POST['txtFechaInicio'];
    $FechaFinal = $_POST['txtFechaCierre'];
    $cmbMoneda = $_POST['cmbMoneda'];
    $tipoCambio = $_POST['tipoCambio'];
    $txtInversion = $_POST['txtInversion'];

    if($tipoPro == 1){//HACIENDA
        $txtCabezas = $_POST['txtCabezas'];
        $cmbCategoria = $_POST['cmbCategoria'];

        //INSERT EN PROYECTOS
        mysqli_query($conexion, "INSERT INTO proyectos VALUES(DEFAULT, '$parcela2', '$proyecto2', '$tipoPro', '$cantidad2', '$estado2')");
        
        //TRAIGO EL ID DEL PROYECTO RECIEN CARGADO, PARA AGREGARLO EN LA TABLA DE HACIENDA
        $tic = mysqli_query($conexion, "SELECT MAX(id_Proyecto) AS id FROM proyectos");
        if ($row = mysqli_fetch_row($tic)) {
            $tic1 = trim($row[0]);
        }
        
        //INSERT EN DETALLEHACIENDA
        mysqli_query($conexion, "INSERT INTO detallehacienda VALUES(DEFAULT, '$tic1', '$FechaInicial', '$FechaFinal', '$txtCabezas', '$cmbCategoria', '$txtInversion', '$cmbMoneda', '$tipoCambio')");
    }

    if($tipoPro == 2){//SIEMBRA
        $cmbCultivo = $_POST['cmbCultivo'];

        //INSERT EN PROYECTOS
        mysqli_query($conexion, "INSERT INTO proyectos VALUES(DEFAULT, '$parcela2', '$proyecto2', '$tipoPro', '$cantidad2', '$estado2')");

        //TRAIGO EL ID DEL PROYECTO RECIEN CARGADO, PARA AGREGARLO EN LA TABLA DE SIEMBRA
        $tic = mysqli_query($conexion, "SELECT MAX(id_Proyecto) AS id FROM proyectos");
        if ($row = mysqli_fetch_row($tic)) {
            $tic1 = trim($row[0]);
        }
        
        //INSERT EN DETALLESIEMBRA
        mysqli_query($conexion, "INSERT INTO detallesiembra VALUES(DEFAULT, '$tic1', '$FechaInicial', '$FechaFinal', '$cmbCultivo', '$txtInversion', '$cmbMoneda', '$tipoCambio')");        
    }

    if($tipoPro == 3){//ALQUILER

        $sql = "SELECT dimension FROM parcela WHERE id_Parcela = '$parcela2'";
        $resultado = $conexion->query($sql);
        $row = $resultado->fetch_assoc();
        $dimension = $row['dimension'];

        //INSERT EN PROYECTOS
        mysqli_query($conexion, "INSERT INTO proyectos VALUES(DEFAULT, '$parcela2', '$proyecto2', '$tipoPro', '$dimension', '$estado2')");

        //TRAIGO EL ID DEL PROYECTO RECIEN CARGADO, PARA AGREGARLO EN LA TABLA DE ALQUILER
        $tic = mysqli_query($conexion, "SELECT MAX(id_Proyecto) AS id FROM proyectos");
        if ($row = mysqli_fetch_row($tic)) {
            $tic1 = trim($row[0]);
        }

        //INSERT EN DETALLEALQUILER
        mysqli_query($conexion, "INSERT INTO detallealquiler VALUES(DEFAULT, '$tic1', '$FechaInicial', '$FechaFinal', '$txtInversion', '$cmbMoneda', '$tipoCambio')");

        //INSERT EN ARCHIVOS COMO Proyecto
        if(file_exists($_FILES['fichero']['tmp_name'])){
            $url = '../archivos/proyectos/'.$tic1.".pdf";

            if(move_uploaded_file($_FILES['fichero']['tmp_name'], $url)){

                $nombre = "Proyecto";
                mysqli_query($conexion, "INSERT INTO archivos VALUES (DEFAULT, '$nombre', '".$url."')");
            }
        };
    }
}

header("Location: ./altaProyectos.php?ok");
mysqli_close($conexion);

?>