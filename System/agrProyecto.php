<?php
session_start();
include ("../Modelo/Conexion.php");

date_default_timezone_set('UTC');
date_default_timezone_set("America/Buenos_Aires");
$fechaActual = date('Y-m-d');


if(isset($_POST['btn1'])){
    $parcela1 = $_POST['cmbparcela1'];
    $proyecto1 = $_POST['nombre1'];
    $tipo1 = $_POST['cmbTipoProyecto1'];
    $cantidad1 = $_POST['cantHas1'];
    $estado1 = $_POST['cmbEstado1'];

    mysqli_query($conexion, "INSERT INTO proyectos VALUES(DEFAULT, '$parcela1', '$proyecto1', '$tipo1', '$cantidad1', '$estado1')");


    $header = 'Enviado desde Don Juan S.R.L.';
    $asunto = "Se ha creado un nuevo proyecto";
    $destinatario = 'luciladolce@hotmail.com';
    $fec = date("d-m-Y", strtotime($fechaActual));
    $mensaje = "El día ".$fec." se ha creado el proyecto: ".$proyecto1.".\nPor favor ingrese a https://donjuansrl.online/ para asignar más detalles.";
    
    $mensajeCompleto = $mensaje . "\Don Juan S.R.L.";
    
    mail($destinatario, $asunto, $mensajeCompleto, $header);
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

        $header = 'Enviado desde Don Juan S.R.L.';
        $asunto = "Se ha creado un nuevo proyecto";
        $destinatario = 'luciladolce@hotmail.com';
        $fec = date("d-m-Y", strtotime($fechaActual));
        $mensaje = "El día ".$fec." se ha creado el proyecto: ".$proyecto2." de Hacienda.\nPor favor ingrese a https://donjuansrl.online/ para ver más detalles.";
        
        $mensajeCompleto = $mensaje . "\Don Juan S.R.L.";
        
        mail($destinatario, $asunto, $mensajeCompleto, $header);
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

        $header = 'Enviado desde Don Juan S.R.L.';
        $asunto = "Se ha creado un nuevo proyecto";
        $destinatario = 'luciladolce@hotmail.com';
        $fec = date("d-m-Y", strtotime($fechaActual));
        $mensaje = "El día ".$fec." se ha creado el proyecto: ".$proyecto2." de Siembra.\nPor favor ingrese a https://donjuansrl.online/ para ver más detalles.";
        
        $mensajeCompleto = $mensaje . "\Don Juan S.R.L.";
        
        mail($destinatario, $asunto, $mensajeCompleto, $header);
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

        $header = 'Enviado desde Don Juan S.R.L.';
        $asunto = "Se ha creado un nuevo proyecto";
        $destinatario = 'luciladolce@hotmail.com';
        $fec = date("d-m-Y", strtotime($fechaActual));
        $mensaje = "El día ".$fec." se ha creado el proyecto: ".$proyecto2." de Alquiler.\nPor favor ingrese a https://donjuansrl.online/ para ver más detalles.";
        
        $mensajeCompleto = $mensaje . "\Don Juan S.R.L.";
        
        mail($destinatario, $asunto, $mensajeCompleto, $header);
    }
}

header("Location: ./altaProyectos.php?ok");
mysqli_close($conexion);

?>