<?php
session_start();
include('../Modelo/Conexion.php');

?>
<!DOCTYPE html>
<html lang="es-es">

<head>
	<meta charset="utf-8">
	<title>Contacto</title>

	<head>

	<body>
		<?php
		// Definimos el archivo exportado
		$arquivo = 'comprasFiltradas.xls';

		// Crear la tabla HTML
		$html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="4">Lista de compras Filtradas</tr>';
		$html .= '</tr>';


		$html .= '<tr>';
		$html .= '<td><b>Fecha</b></td>';
		$html .= '<td><b>NroFactura</b></td>';
		$html .= '<td><b>Proveedor</b></td>';
		$html .= '<td><b>Moneda</b></td>';
		$html .= '<td><b>ImporteNeto</b></td>';
		$html .= '<td><b>IVA</b></td>';
		$html .= '<td><b>Total</b></td>';
		$html .= '<td><b>FormaPago</b></td>';
		$html .= '</tr>';

		//Seleccionar todos los elementos de la tabla
	/* 	$result_msg_contatos = "SELECT * FROM contactos"; */
		$variable = $_POST['sql'];
		$resultado_msg_contatos = mysqli_query($conexion, $variable);

		while ($row_msg_contatos = mysqli_fetch_assoc($resultado_msg_contatos)) {
            $fec = date("d-m-Y", strtotime($row_msg_contatos['fecha']));
            $impNeto = number_format($row_msg_contatos['importeNeto'], 2, ',','.');
            $total = number_format($row_msg_contatos['importeTotal'], 2, ',','.');

			$html .= '<tr>';
			$html .= '<td>' . $fec. '</td>';
			$html .= '<td>' . $row_msg_contatos["nroFactura"] . '</td>';
			$html .= '<td>' . $row_msg_contatos["proveedor"] . '</td>';
            $html .= '<td>' . $row_msg_contatos["moneda"]. '</td>';
            $html .= '<td>$' . $impNeto. '</td>';
			$html .= '<td>' . $row_msg_contatos["IVA"] . '%</td>';
            $html .= '<td>$' . $total. '</td>';
            $html .= '<td>' . $row_msg_contatos["formaPago"]. '</td>';
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

</html>