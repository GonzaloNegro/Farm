<?php
session_start();
include('../Modelo/Conexion.php');

$id = $_POST['id'];

//SI SE PRESIONA EL BOTON GLOBAL
//PUEDE TRAER FECHAS DE SIEMBRA, HACIENDA O ALQUILER
//PUEDE TRAER PDF DE ALQUILER
//PUEDE TRAER ESTADO DE SIEMBRA, HACIENDA O ALQUILER

if(isset($_POST['fechaCierreH'])){
    $fechaCierreH = $_POST['fechaCierreH'];
    mysqli_query($conexion, "UPDATE detallehacienda SET fechaCierre = '$fechaCierreH' WHERE id_Proyecto = '$id'");
}

if(isset($_POST['fechaCierreS'])){
    $fechaCierreS = $_POST['fechaCierreS'];
    mysqli_query($conexion, "UPDATE detallesiembra SET fechaCierre = '$fechaCierreS' WHERE id_Proyecto = '$id'");
}

if(isset($_POST['fechaCierreA'])){
    $fechaCierreA = $_POST['fechaCierreA'];
    mysqli_query($conexion, "UPDATE detallealquiler SET fechaCierre = '$fechaCierreA' WHERE id_Proyecto = '$id'");
}

if(isset($_POST['estado'])){
    $estado = $_POST['estado'];

    if($estado == "100"){
        $sql3 = "SELECT id_EstadoProyecto FROM proyectos WHERE id_Proyecto = '$id'";
        $result3 = $conexion->query($sql3);
        $row3 = $result3->fetch_assoc();
        $estado = $row3['id_EstadoProyecto'];
    }

    
    mysqli_query($conexion, "UPDATE proyectos SET id_EstadoProyecto = '$estado' WHERE id_Proyecto = '$id'");
}

//VERIFICAR SI YA EXISTE UN PDF CARGADO PREVIAMENTE, PARA MODIFICARLO
$pdf = "../archivos/proyectos/".$id.".pdf";
$sent= "SELECT id_archivo FROM archivos WHERE url = '$pdf'";
$resultado = $conexion->query($sent);
$row = $resultado->fetch_assoc();
$url = $row['id_archivo'];

if(isset($url)){
    //ELIMINAR ARCHIVO PREVIO
    mysqli_query($conexion, "DELETE FROM archivos WHERE url = '$pdf'");

    //INSERTAR NUEVO ARCHIVO
    if(file_exists($_FILES['fichero']['tmp_name'])){
        $url = '../archivos/proyectos/'.$id.".pdf";
    
        if(move_uploaded_file($_FILES['fichero']['tmp_name'], $url)){
            $nombre = "Proyecto";
            mysqli_query($conexion, "INSERT INTO archivos VALUES (DEFAULT, '$nombre', '".$url."')");
        }
    };
}else{
    //INSERTAR NUEVO ARCHIVO
    if(file_exists($_FILES['fichero']['tmp_name'])){
        $url = '../archivos/proyectos/'.$id.".pdf";
    
        if(move_uploaded_file($_FILES['fichero']['tmp_name'], $url)){
            $nombre = "Proyecto";
            mysqli_query($conexion, "INSERT INTO archivos VALUES (DEFAULT, '$nombre', '".$url."')");
        }
    };
}

header("Location: ./todosLosProyectos.php?mod");
mysqli_close($conexion);
?>