<?php
session_start();
include ("../Modelo/Conexion.php");

$cmbparcela = $_POST['cmbparcela2'];

$sql = "SELECT p.id_Parcela, p.dimension, SUM(pr.cantidadHas) AS total
FROM parcela p
LEFT JOIN proyectos pr ON pr.id_Parcela = p.id_Parcela
WHERE p.id_Parcela = '$cmbparcela'";

$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();
$dimension = $row['dimension'];
$total = $row['total'];

/* $dispon = $dimension - $total; */

$cadena = "<div class='labelInput'><label>Hectareas disponibles: </label><p>".$dimension." Has</p></div>";

echo $cadena;

echo"
<div class='labelInput' id='divHectareas'>
    <label for='name'>Cantidad de Hectareas:</label>
    <input type='number' name='cantHas2' min='1' max='$dimension' id='inpHectareas' required>
</div>
"
?>