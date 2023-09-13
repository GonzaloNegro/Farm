<?php
session_start();
include('../Modelo/Conexion.php');

$id = $_POST['id'];
$passActual = $_POST['passActual'];
$passNueva = $_POST['passNueva'];

/* SI UNO DE LOS CAMPOS ESTA REPETIDO */
$sql = "SELECT id_usuario FROM usuarios WHERE password = '$passActual' AND id_usuario = '$id'";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();
$usu = $row['id_usuario'];

if(isset($usu)){
    mysqli_query($conexion, "UPDATE usuarios SET password = '$passNueva' WHERE id_usuario = '$id'");
    header("Location: ./datosPersonales.php?mod");

    mysqli_close($conexion);
}else{
    header("Location: ./datosPersonales.php?error");
    mysqli_close($conexion);
}
?>