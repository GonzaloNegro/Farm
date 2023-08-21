<?php
session_start();
include('../Modelo/Conexion.php');

$proyecto = $_POST['cmbNombre'];
$txtFechaInicio = $_POST['txtFechaInicio'];
$cmbMoneda = $_POST['cmbMoneda'];
$tipoCambio = $_POST['tipoCambio'];
$txtInversion = $_POST['txtInversion'];
$txtFechaCierre = $_POST['txtFechaCierre'];

mysqli_query($conexion, "INSERT INTO detallealquiler VALUES(DEFAULT, '$proyecto', '$txtFechaInicio', '$txtFechaCierre', '$txtInversion', '$cmbMoneda', '$tipoCambio')");
header("Location: ./detalleAlquiler.php?ok");
mysqli_close($conexion);
?>