<?php
session_start();
include('../Modelo/Conexion.php');

$cultivo = $_POST['cultivo'];
$semillas = $_POST['semillas'];
$rinde = $_POST['rinde'];

/* SI UNO DE LOS CAMPOS ESTA REPETIDO */
$sql = "SELECT id_Cultivo FROM cultivos WHERE nombreCultivo = '$cultivo'";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();
$cult = $row['id_Cultivo'];

if(isset($cult)){
    header("Location: ./cultivos.php?error");
    mysqli_close($conexion);
}else{
    mysqli_query($conexion, "INSERT INTO cultivos VALUES(DEFAULT, '$cultivo', '$semillas', '$rinde')");
    header("Location: ./cultivos.php?ok");
    mysqli_close($conexion);
}
?>