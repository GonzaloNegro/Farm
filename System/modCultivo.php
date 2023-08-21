<?php
session_start();
include('../Modelo/Conexion.php');

$id = $_POST['id'];
$cultivo = $_POST['cultivo'];
$semillas = $_POST['semillas'];
$rinde = $_POST['rinde'];

/* SI UNO DE LOS CAMPOS ESTA REPETIDO */
$sql = "SELECT id_Cultivo FROM cultivos WHERE nombreCultivo = '$cultivo' AND id_Cultivo != '$id'";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();
$cult = $row['id_Cultivo'];

if(isset($cult)){
    header("Location: ./cultivos.php?error");
    mysqli_close($conexion);
}else{
    mysqli_query($conexion, "UPDATE cultivos SET nombreCultivo = '$cultivo', kgSemillaHas = '$semillas', rindeEsperadoHas = '$rinde' WHERE id_Cultivo = '$id'");
    header("Location: ./cultivos.php?mod");
    mysqli_close($conexion);
}
?>