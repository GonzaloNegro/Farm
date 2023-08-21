<?php
session_start();
include('../Modelo/Conexion.php');

$nroFactura=$_POST['nroFactura'];

//VERIFICAR SI YA EXISTE UN PDF CARGADO PREVIAMENTE, PARA MODIFICARLO
$pdf = "../archivos/compras/".$nroFactura.".pdf";
$sent= "SELECT id_archivo FROM archivos WHERE url = '$pdf'";
$resultado = $conexion->query($sent);
$row = $resultado->fetch_assoc();
$url = $row['id_archivo'];

if(isset($url)){
    //ELIMINAR ARCHIVO PREVIO
    mysqli_query($conexion, "DELETE FROM archivos WHERE url = '$pdf'");

    //INSERTAR NUEVO ARCHIVO
    if(file_exists($_FILES['fichero']['tmp_name'])){
        $url = '../archivos/compras/'.$nroFactura.".pdf";
    
        if(move_uploaded_file($_FILES['fichero']['tmp_name'], $url)){
            $nombre = "Compra";
            mysqli_query($conexion, "INSERT INTO archivos VALUES (DEFAULT, '$nombre', '".$url."')");
        }
    }
}else{
    //INSERTAR NUEVO ARCHIVO
    if(file_exists($_FILES['fichero']['tmp_name'])){
        $url = '../archivos/compras/'.$nroFactura.".pdf";
    
        if(move_uploaded_file($_FILES['fichero']['tmp_name'], $url)){
            $nombre = "Compra";
            mysqli_query($conexion, "INSERT INTO archivos VALUES (DEFAULT, '$nombre', '".$url."')");
        }
    }
}

header("Location: ./verCompras.php?pdf");
mysqli_close($conexion);
?>