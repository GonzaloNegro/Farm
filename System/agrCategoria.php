<?php
session_start();
include('../Modelo/Conexion.php');

$nombreFinal = $_POST['cat'];

/* SI UNO DE LOS CAMPOS ESTA REPETIDO */
$sql = "SELECT id_Categoria FROM categoria WHERE nombreCategoria = '$nombreFinal'";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();
$cat = $row['id_Categoria'];

if(isset($cat)){
    header("Location: ./categorias.php?error");
    mysqli_close($conexion);
}else{
    mysqli_query($conexion, "INSERT INTO categoria VALUES(DEFAULT, '$nombreFinal')");
    header("Location: ./categorias.php?ok");
    mysqli_close($conexion);
}
?>