<?php
session_start();
include('../Modelo/Conexion.php');

$nombreFinal = $_POST['prov'];

/* SI UNO DE LOS CAMPOS ESTA REPETIDO */
$sql = "SELECT id_Proveedor FROM proveedores WHERE proveedor = '$nombreFinal'";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();
$prov = $row['id_Proveedor'];

if(isset($prov)){
    header("Location: ./proveedores.php?error");
    mysqli_close($conexion);
}else{
    mysqli_query($conexion, "INSERT INTO proveedores VALUES(DEFAULT, '$nombreFinal')");
    header("Location: ./proveedores.php?ok");
    mysqli_close($conexion);
}
?>