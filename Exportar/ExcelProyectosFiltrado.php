<?php
session_start();
include('../Modelo/Conexion.php');
?>
<!DOCTYPE html>
<html lang="es-es">

<head>
	<meta charset="utf-8">

	<head>

	<body>
		<?php
		// Definimos el archivo exportado
		$arquivo = 'ProyectosFiltrados.xls';

		// Crear la tabla HTML
		$html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="4">Listado de Proyectos filtrados</tr>';
		$html .= '</tr>';


		$html .= '<tr>';
		$html .= '<td><b>Nombre proyecto</b></td>';
		$html .= '<td><b>Parcela</b></td>';
		$html .= '<td><b>Tipo</b></td>';
		$html .= '<td><b>Cantidad Has</b></td>';
        $html .= '<td><b>Estado</b></td>';
		$html .= '</tr>';

		//Seleccionar todos los elementos de la tabla
	/* 	$result_msg_contatos = "SELECT * FROM contactos"; */
		$variable = $_POST['sql'];
		$resultado_msg_contatos = mysqli_query($conexion, $variable);

		while ($row_msg_contatos = mysqli_fetch_assoc($resultado_msg_contatos)) {
			$html .= '<tr>';
			$html .= '<td>' . $row_msg_contatos["nombreProyecto"] . '</td>';
            $html .= '<td>Parcela N° ' . $row_msg_contatos["id_Parcela"]. '</td>';
			$html .= '<td>' . $row_msg_contatos["tipoProyecto"] . '</td>';
            $html .= '<td>' . $row_msg_contatos["cantidadHas"]. 'Has</td>';
			$html .= '<td>' . $row_msg_contatos["estado"] . '</td>';
			$html .= '</tr>';
		}
		// Configuración en la cabecera
		header("Expires: Mon, 26 Jul 2227 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header("Cache-Control: no-cache, must-revalidate");
		header("Pragma: no-cache");
		header("Content-type: application/x-msexcel");
		header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
		header("Content-Description: PHP Generado Data");
		// Envia contenido al archivo
		echo $html;
		exit; ?>
	</body>
