<?php
session_start();
include('../Modelo/Conexion.php');

$proyecto = $_POST['cmbNombre'];
$txtFechaInicio = $_POST['txtFechaInicio'];
$cmbCultivo = $_POST['cmbCultivo'];
$cmbMoneda = $_POST['cmbMoneda'];
$tipoCambio = $_POST['tipoCambio'];
$txtInversion = $_POST['txtInversion'];
$txtFechaCierre = $_POST['txtFechaCierre'];

mysqli_query($conexion, "INSERT INTO detallesiembra VALUES(DEFAULT, '$proyecto', '$txtFechaInicio', '$txtFechaCierre', '$cmbCultivo', '$txtInversion', '$cmbMoneda', '$tipoCambio')");
header("Location: ./detalleSiembra.php?ok");
mysqli_close($conexion);
?>