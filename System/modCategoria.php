<?php
session_start();
include('../Modelo/Conexion.php');

$idFinal = $_POST['id'];
$nombreFinal = $_POST['cat'];

/* SI UNO DE LOS CAMPOS ESTA REPETIDO */
$sql = "SELECT id_Categoria FROM categoria WHERE (nombreCategoria = '$nombreFinal' AND id_Categoria != '$idFinal')";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();
$cat = $row['id_Categoria'];

if(isset($cat)){
    header("Location: ./categorias.php?error");
    mysqli_close($conexion);
}else{
    mysqli_query($conexion, "UPDATE categoria SET nombreCategoria = '$nombreFinal' WHERE id_Categoria = '$idFinal'");
    header("Location: ./categorias.php?mod");
    mysqli_close($conexion);
}
?>