<?php
session_start();
error_reporting(0);
include ("../Modelo/Conexion.php");

$cmbparcela = $_POST['cmbparcela1'];

$sql = "SELECT COUNT(p.id_Parcela) AS cantidad
FROM parcela p
LEFT JOIN proyectos pr ON pr.id_Parcela = p.id_Parcela
WHERE p.id_Parcela = '$cmbparcela' AND pr.id_EstadoProyecto = 2";

$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();
$cantidad = $row['cantidad'];

if($cantidad > 0){
    $sql = "SELECT p.id_Parcela, p.dimension, SUM(pr.cantidadHas) AS total, pr.id_EstadoProyecto
    FROM parcela p
    LEFT JOIN proyectos pr ON pr.id_Parcela = p.id_Parcela
    WHERE p.id_Parcela = '$cmbparcela' AND pr.id_EstadoProyecto = 2";
    
    $resultado = $conexion->query($sql);
    $row = $resultado->fetch_assoc();
    $dimension = $row['dimension'];
    $total = $row['total'];

    $dispon = $dimension - $total;
    
}else{
    $sql = "SELECT dimension AS largo FROM parcela WHERE id_Parcela = '$cmbparcela'";
    $resultado = $conexion->query($sql);
    $row = $resultado->fetch_assoc();
    $dimension = $row['largo'];

    $dispon = $dimension;
}


$cadena = "<div class='labelInput'><label>Hectareas disponibles: </label><p>".$dispon." Has</p></div>";

echo $cadena;

echo"
<div class='labelInput'>
    <label for='name'>Cantidad de Hectareas:</label>
    <input type='number' name='cantHas1' min='1' max='$dispon' required>
</div>
"
?>