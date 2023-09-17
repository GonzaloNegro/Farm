<?php
session_start();
include ("../Modelo/Conexion.php");

date_default_timezone_set('UTC');
date_default_timezone_set("America/Buenos_Aires");
$fechaActual = date('Y-m-d');

if (isset($_POST)){

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
$detalle=$_POST['detalle'];
$formaPago=$_POST['cmbFormaPago'];

if($factura == "C"){
    $iva = 4;
    $importeTotal = $importeNeto;
}else{
/* CALCULO DEL IMPORTE TOTAL */
    $sql = "SELECT * FROM iva WHERE id_Iva = '$iva'";
    $resultado = $conexion->query($sql);
    $row = $resultado->fetch_assoc();
    $ivanro = $row['iva'];

    $ivanro=str_replace(',','',$ivanro); 

    if($ivanro ==  105){
        $ivaFinal = $ivanro / 1000;
    }else{
        $ivaFinal = $ivanro / 100;
    }

    $importeTotal = $importeNeto + ($importeNeto * $ivaFinal);
}





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

if(file_exists($_FILES['fichero']['tmp_name'])){
    $url = '../archivos/compras/'.$nroFactura.".pdf";

    if(move_uploaded_file($_FILES['fichero']['tmp_name'], $url)){

        $nombre = "Compra";
        mysqli_query($conexion, "INSERT INTO archivos VALUES (DEFAULT, '$nombre', '".$url."')");
    }
};

$header = 'Enviado desde Don Juan S.R.L.';
$asunto = "Se ha cargado una nueva compra";
$destinatario = 'luciladolce@hotmail.com';
$fec = date("d-m-Y", strtotime($fechaActual));
$mensaje = "El día ".$fec." se ha registrado una nueva compra.\nPor favor ingrese a https://donjuansrl.online/ para ver más detalles.";

$mensajeCompleto = $mensaje . "\Don Juan S.R.L.";

mail($destinatario, $asunto, $mensajeCompleto, $header);

header("Location: ./verCompras.php?ok");
mysqli_close($conexion);
}
?>