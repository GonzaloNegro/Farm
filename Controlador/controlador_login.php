<?php
include ("../Modelo/Conexion.php");

if(isset($_POST['btningresar'])){
	$usuario = $_POST['usuario'];
	$contraseña = $_POST['password'];

	$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
	$resultado = $conexion->query($sql);
	$row = $resultado->fetch_assoc();
    $id = $row['id_usuario'];
	$contra = $row['password'];
	$estado = $row['id_EstadoUsuario'];


    if($contraseña == $contra AND $estado == 1){
        session_start();
        $_SESSION['usuario'] = $usuario; 
        header("location: ../index.php?ok");
    }
    if($estado != 1){
        header("location: ../index.php?ini");
        mysqli_close($conexion);
    }
    if($contraseña != $contra){
        $_SESSION['usuario'] = $usuario; 
        header("location: ../index.php?err");
        mysqli_close($conexion);
    }
    mysqli_close($conexion);
}
?>