<?php
session_start();
include ("../Modelo/Conexion.php");

if (isset($_POST)){

// Captura los datos ingresados en el formulario
$fecha=$_POST['fecha'];
$factura=$_POST['cmbTipoFactura'];  
$puntoVenta=$_POST['ptoVenta'];
$nroFactura=$_POST['nroFactura'];
$proveedor=$_POST['prov'];
$tipoDoc=$_POST['cmbTipoDoc'];
$dni=$_POST['dni'];
$tipoCambio=$_POST['tipoCambio'];
$moneda=$_POST['cmbMoneda'];
$importeNeto=$_POST['impNeto'];
$iva=$_POST['iva'];
$importeTotal=$_POST['impTotal'];
$detalle=$_POST['detalle'];
$formaPago=$_POST['cmbFormaPago'];


mysqli_query($conexion, "INSERT INTO compras VALUES (DEFAULT, '$fecha','$factura','$puntoVenta','$nroFactura','$tipoDoc','$dni','$proveedor','$tipoCambio', '$moneda','$importeNeto','$iva','$importeTotal','$detalle','$formaPago')");

$tic = mysqli_query($conexion, "SELECT MAX(id_Compras) AS id FROM compras");
if ($row = mysqli_fetch_row($tic)) {
    $tic1 = trim($row[0]);
    }

if(isset($_POST['nombreProyecto'])){
    $idProyecto = $_POST['nombreProyecto'];
    mysqli_query($conexion, "INSERT INTO compraproyecto VALUES (DEFAULT, '$tic1', '$idProyecto', 2)");
}else{
    mysqli_query($conexion, "INSERT INTO compraproyecto VALUES (DEFAULT, '$tic1', 0, 1)");
}

/* SUBIR ARCHIVO */
if(file_exists($_FILES['fichero']['tmp_name'])){
    $url = '../archivos/compras/'.$nroFactura.".pdf";

    if(move_uploaded_file($_FILES['fichero']['tmp_name'], $url)){

        $nombre = "Compra";
        mysqli_query($conexion, "INSERT INTO archivos VALUES (DEFAULT, '$nombre', '".$url."')");
    }
};

header("Location: ./verCompras.php?ok");
mysqli_close($conexion);
}
?>