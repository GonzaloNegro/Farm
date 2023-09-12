<?php
session_start();
include('../Modelo/Conexion.php');

$id = $_POST['id'];
$usuario = $_POST['usuario'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$pass = $_POST['pass'];

/* SI UNO DE LOS CAMPOS ESTA REPETIDO */
$sql = "SELECT id_usuario FROM usuarios WHERE (usuario = '$usuario' AND id_usuario != '$id')";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();
$usu = $row['id_usuario'];

if(isset($usu)){
    header("Location: ./datosPersonales.php?error");
    mysqli_close($conexion);
}else{
    mysqli_query($conexion, "UPDATE usuarios SET usuario = '$usuario', password = '$pass', nombre = '$nombre', apellido = '$apellido' WHERE id_usuario = '$id'");
    header("Location: ./datosPersonales.php?mod");
    mysqli_close($conexion);
}
?>