<?php
session_start();
include('../Modelo/Conexion.php');

$proyecto = $_POST['cmbNombre'];
$txtFechaInicio = $_POST['txtFechaInicio'];
$txtCabezas = $_POST['txtCabezas'];
$cmbMoneda = $_POST['cmbMoneda'];
$tipoCambio = $_POST['tipoCambio'];
$txtInversion = $_POST['txtInversion'];
$cmbCategoria = $_POST['cmbCategoria'];
$txtFechaCierre = $_POST['txtFechaCierre'];

mysqli_query($conexion, "INSERT INTO detallehacienda VALUES(DEFAULT, '$proyecto', '$txtFechaInicio', '$txtFechaCierre', '$txtCabezas', '$cmbCategoria', '$txtInversion', '$cmbMoneda', '$tipoCambio')");
header("Location: ./detalleHacienda.php?ok");
mysqli_close($conexion);
?>