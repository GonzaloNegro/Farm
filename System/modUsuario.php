<?php
session_start();
include('../Modelo/Conexion.php');

$id = $_POST['id'];
$usuario = $_POST['usuario'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$pass = $_POST['pass'];
$tipo = $_POST['tipo'];
$estado = $_POST['estado'];

if($tipo == "100"){
    $sql3 = "SELECT id_tipoUsuario FROM usuarios WHERE id_usuario = '$id'";
    $result3 = $conexion->query($sql3);
    $row3 = $result3->fetch_assoc();
    $tipo = $row3['id_tipoUsuario'];
}

if($estado == "200"){
    $sql3 = "SELECT id_EstadoUsuario FROM usuarios WHERE id_usuario = '$id'";
    $result3 = $conexion->query($sql3);
    $row3 = $result3->fetch_assoc();
    $estado = $row3['id_EstadoUsuario'];
}

/* SI UNO DE LOS CAMPOS ESTA REPETIDO */
$sql = "SELECT id_usuario FROM usuarios WHERE (usuario = '$usuario' AND id_usuario != '$id')";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();
$usu = $row['id_usuario'];

if(isset($usu)){
    header("Location: ./usuarios.php?error");
    mysqli_close($conexion);
}else{
    mysqli_query($conexion, "UPDATE usuarios SET usuario = '$usuario', password = '$pass', nombre = '$nombre', apellido = '$apellido', id_tipoUsuario = '$tipo', id_EstadoUsuario = '$estado' WHERE id_usuario = '$id'");
    header("Location: ./usuarios.php?mod");
    mysqli_close($conexion);
}
?>