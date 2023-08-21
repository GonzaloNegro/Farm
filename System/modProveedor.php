<?php
session_start();
include('../Modelo/Conexion.php');

$idFinal = $_POST['id'];
$nombreFinal = $_POST['prov'];

/* SI UNO DE LOS CAMPOS ESTA REPETIDO */
$sql = "SELECT id_Proveedor FROM proveedores WHERE (proveedor = '$nombreFinal' AND id_Proveedor != '$idFinal')";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();
$prov = $row['id_Proveedor'];

if(isset($prov)){
    header("Location: ./proveedores.php?error");
    mysqli_close($conexion);
}else{
    mysqli_query($conexion, "UPDATE proveedores SET proveedor = '$nombreFinal' WHERE id_Proveedor = '$idFinal'");
    header("Location: ./proveedores.php?ok");
    mysqli_close($conexion);
}
?>