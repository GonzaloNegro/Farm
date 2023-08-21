<?php
session_start();
include('../Modelo/Conexion.php');

$usuario = $_POST['usuario'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$pass = $_POST['pass'];
$tipo = $_POST['tipo'];
$estado = $_POST['estado'];

/* SI UNO DE LOS CAMPOS ESTA REPETIDO */
$sql = "SELECT id_usuario FROM usuarios WHERE usuario = '$usuario'";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();
$usu = $row['id_usuario'];

if(isset($usu)){
    header("Location: ./usuarios.php?error");
    mysqli_close($conexion);
}else{
    mysqli_query($conexion, "INSERT INTO usuarios VALUES(DEFAULT, '$usuario', '$pass', '$nombre', '$apellido', '$tipo', '$estado')");
    header("Location: ./usuarios.php?ok");
    mysqli_close($conexion);
}
?>