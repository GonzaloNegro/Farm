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
		$arquivo = 'Proyectos.xls';

		// Crear la tabla HTML
		$html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="4">Lista de Proyectos</tr>';
		$html .= '</tr>';


		$html .= '<tr>';
		$html .= '<td><b>Nombre</b></td>';
		$html .= '<td><b>Tipo</b></td>';
		$html .= '<td><b>Cantidad de Has</b></td>';
		$html .= '<td><b>Parcela</b></td>';
		$html .= '<td><b>Fecha Inicio</b></td>';
		$html .= '<td><b>Fecha Cierre</b></td>';
		$html .= '<td><b>Cantidad Cabezas</b></td>';
		$html .= '<td><b>Nombre Categoria</b></td>';
		$html .= '<td><b>Inversion</b></td>';
		$html .= '<td><b>Nombre Cultivo</b></td>';
		$html .= '<td><b>Estado</b></td>';
		$html .= '</tr>';

		//Seleccionar todos los elementos de la tabla
	/* 	$result_msg_contatos = "SELECT * FROM contactos"; */
		$variable = "SELECT p.id_Proyecto, p.nombreProyecto, t.tipoProyecto, p.cantidadHas, p.id_Parcela, dh.fechaInicio AS fih, dh.fechaCierre AS fch, ds.fechaInicio AS fis, ds.fechaCierre AS fcs, dh.cantidadCabezas, c.nombreCategoria, dh.inversion AS ihc, cu.nombreCultivo, ds.inversion AS isi, e.estado
        FROM `proyectos` p 
        LEFT JOIN estadoproyecto e ON e.id_EstadoProyecto = p.id_EstadoProyecto
        LEFT JOIN tipoproyecto t ON t.id_tipoProyecto = p.id_TipoProyecto 
        LEFT JOIN detallehacienda dh ON dh.id_Proyecto = p.id_Proyecto 
        LEFT JOIN categoria c ON c.id_Categoria = dh.id_Categoria 
        LEFT JOIN detallesiembra ds ON ds.id_Proyecto = p.id_Proyecto 
        LEFT JOIN cultivos cu ON cu.id_Cultivo = ds.id_Cultivo
        ORDER BY p.nombreProyecto";
		$resultado_msg_contatos = mysqli_query($conexion, $variable);

		while ($row_msg_contatos = mysqli_fetch_assoc($resultado_msg_contatos)) {
			$html .= '<tr>';
			$html .= '<td>' . $row_msg_contatos["nombreProyecto"] . '</td>';
            $html .= '<td>' . $row_msg_contatos["tipoProyecto"]. '</td>';
			$html .= '<td>' . $row_msg_contatos["cantidadHas"] . 'Has</td>';
			$html .= '<td>Parcela: N°' . $row_msg_contatos["id_Parcela"] . '</td>';

            $fecIniH = date("d-m-Y", strtotime($row_msg_contatos['fih']));
            $fecCieH = date("d-m-Y", strtotime($row_msg_contatos['fch']));
        
            $fecIniS = date("d-m-Y", strtotime($row_msg_contatos['fis']));
            $fecCieS = date("d-m-Y", strtotime($row_msg_contatos['fcs']));

            if($fecIniH != '01-01-1970'){
                $html .= '<td>' . $fecIniH . '</td>';
            }else{
                $html .= '<td>' . $fecIniS . '</td>';
            }

            if($fecCieH != '01-01-1970'){
                $html .= '<td>' . $fecCieH . '</td>';
            }else{
                $html .= '<td>' . $fecCieS . '</td>';
            }

            $html .= '<td>' . $row_msg_contatos["cantidadCabezas"]. '</td>';
            $html .= '<td>' . $row_msg_contatos["nombreCategoria"]. '</td>';

            if(isset($row_msg_contatos['ihc'])){
                $invH = number_format($row_msg_contatos['ihc'], 2, ',','.');
                $html .= '<td>$' . $invH . '</td>';
            }else{
                $invS = number_format($row_msg_contatos['isi'], 2, ',','.');
                $html .= '<td>$' . $invS . '</td>';
            }

            $html .= '<td>' . $row_msg_contatos["nombreCultivo"]. '</td>';
            $html .= '<td>' . $row_msg_contatos["estado"]. '</td>';
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