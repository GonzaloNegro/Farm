<?php
include('../Template/Cabecera.php');
include ("../Modelo/Conexion.php");
error_reporting(0);

date_default_timezone_set('UTC');
date_default_timezone_set("America/Buenos_Aires");
$fechaActual = date('Y-m-d');

$consulta=mysqli_query($conexion, "SELECT id_Proyecto, id_Tipoproyecto, id_EstadoProyecto FROM proyectos");
while($listar = mysqli_fetch_array($consulta)){

	$proye = $listar['id_Proyecto'];
	
	//CERRAR PROYECTO DE HACIENDA AL LLEGAR LA FECHA LIMITE
	if($listar['id_Tipoproyecto'] == 1 AND $listar['id_EstadoProyecto'] == 2){//Hacienda
		$sent= "SELECT * FROM detallehacienda WHERE id_Proyecto = '$proye' AND fechaCierre <= '$fechaActual'";
		$resultado = $conexion->query($sent);
		$row = $resultado->fetch_assoc();
		$idDetalleHacienda = $row['id_DetalleHacienda'];
		if(isset($idDetalleHacienda)){
			mysqli_query($conexion, "UPDATE proyectos SET id_EstadoProyecto  = 3 WHERE id_Proyecto = '$proye'");
		}
	}
	//ABRIR PROYECTO DE HACIENDA AL LLEGAR LA FECHA DE INICIO
	if($listar['id_Tipoproyecto'] == 1 AND $listar['id_EstadoProyecto'] == 1){//Hacienda
		$sent= "SELECT * FROM detallehacienda WHERE id_Proyecto = '$proye' AND fechaInicio = '$fechaActual'";
		$resultado = $conexion->query($sent);
		$row = $resultado->fetch_assoc();
		$idDetalleHaciendaIni = $row['id_DetalleHacienda'];
		if(isset($idDetalleHaciendaIni)){
			mysqli_query($conexion, "UPDATE proyectos SET id_EstadoProyecto  = 2 WHERE id_Proyecto = '$proye'");
		}
	}
	
	//CERRAR PROYECTO DE SIEMBRA AL LLEGAR LA FECHA LIMITE
	if($listar['id_Tipoproyecto'] == 2 AND $listar['id_EstadoProyecto'] == 2){//Siembra
		$sent= "SELECT * FROM detallesiembra WHERE id_Proyecto = '$proye' AND fechaCierre <= '$fechaActual'";
		$resultado = $conexion->query($sent);
		$row = $resultado->fetch_assoc();
		$idDetalleSiembra = $row['id_DetalleSiembra'];
		if(isset($idDetalleSiembra)){
			mysqli_query($conexion, "UPDATE proyectos SET id_EstadoProyecto  = 3 WHERE id_Proyecto = '$proye'");
		}
	}
	//ABRIR PROYECTO DE SIEMBRA AL LLEGAR LA FECHA DE INICIO
	if($listar['id_Tipoproyecto'] == 2 AND $listar['id_EstadoProyecto'] == 1){//Siembra
		$sent= "SELECT * FROM detallesiembra WHERE id_Proyecto = '$proye' AND fechaInicio = '$fechaActual'";
		$resultado = $conexion->query($sent);
		$row = $resultado->fetch_assoc();
		$idDetalleSiembraIni = $row['id_DetalleSiembra'];
		if(isset($idDetalleSiembraIni)){
			mysqli_query($conexion, "UPDATE proyectos SET id_EstadoProyecto  = 2 WHERE id_Proyecto = '$proye'");
		}
	}
}

?>

	<main class="contenedor">
		<!-- Contenido parcelas -->
	<section class="centrado">
		<div class="centrado--titulo">
			<h1>Información de las parcelas</h1>
		</div>
		<div class="centrado--parcelas">
			<?php
			date_default_timezone_set('UTC');
			date_default_timezone_set("America/Buenos_Aires");
			$fechaActual = date('Y-m-d');


			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallehacienda d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 1 AND p.id_TipoProyecto = 1 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc1H = $row['TOTAL'];

			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallesiembra d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 1 AND p.id_TipoProyecto = 2 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc1S = $row['TOTAL'];

			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallealquiler d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 1 AND p.id_TipoProyecto = 3 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc1A = $row['TOTAL'];

			$par1 = $parc1H + $parc1S + $parc1A;

			/* ------------------ */
			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallehacienda d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 2 AND p.id_TipoProyecto = 1 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc2H = $row['TOTAL'];

			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallesiembra d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 2 AND p.id_TipoProyecto = 2 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc2S = $row['TOTAL'];

			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallealquiler d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 2 AND p.id_TipoProyecto = 3 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc2A = $row['TOTAL'];

			$par2 = $parc2H + $parc2S + $parc2A;

			/* ------------------ */
			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallehacienda d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 3 AND p.id_TipoProyecto = 1 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc3H = $row['TOTAL'];

			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallesiembra d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 3 AND p.id_TipoProyecto = 2 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc3S = $row['TOTAL'];

			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallealquiler d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 3 AND p.id_TipoProyecto = 3 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc3A = $row['TOTAL'];

			$par3 = $parc3H + $parc3S + $parc3A;

			/* ------------------ */
			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallehacienda d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 4 AND p.id_TipoProyecto = 1 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc4H = $row['TOTAL'];

			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallesiembra d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 4 AND p.id_TipoProyecto = 2 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc4S = $row['TOTAL'];

			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallealquiler d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 4 AND p.id_TipoProyecto = 3 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc4A = $row['TOTAL'];

			$par4 = $parc4H + $parc4S + $parc4A;

			/* ------------------ */
			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallehacienda d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 5 AND p.id_TipoProyecto = 1 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc5H = $row['TOTAL'];

			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallesiembra d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 5 AND p.id_TipoProyecto = 2 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc5S = $row['TOTAL'];

			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallealquiler d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 5 AND p.id_TipoProyecto = 3 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc5A = $row['TOTAL'];

			$par5 = $parc5H + $parc5S + $parc5A;

			/* ------------------ */
			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallehacienda d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 6 AND p.id_TipoProyecto = 1 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc6H = $row['TOTAL'];

			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallesiembra d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 6 AND p.id_TipoProyecto = 2 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc6S = $row['TOTAL'];

			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallealquiler d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 6 AND p.id_TipoProyecto = 3 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc6A = $row['TOTAL'];

			$par6 = $parc6H + $parc6S + $parc6A;

			/* ------------------ */
			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallehacienda d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 7 AND p.id_TipoProyecto = 1 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc7H = $row['TOTAL'];

			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallesiembra d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 7 AND p.id_TipoProyecto = 2 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc7S = $row['TOTAL'];

			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallealquiler d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 7 AND p.id_TipoProyecto = 3 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc7A = $row['TOTAL'];

			$par7 = $parc7H + $parc7S + $parc7A;

			/* ------------------ */
			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallehacienda d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 8 AND p.id_TipoProyecto = 1 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc8H = $row['TOTAL'];

			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallesiembra d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 8 AND p.id_TipoProyecto = 2 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc8S = $row['TOTAL'];

			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallealquiler d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 8 AND p.id_TipoProyecto = 3 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc8A = $row['TOTAL'];

			$par8 = $parc8H + $parc8S + $parc8A;

			/* ------------------ */
			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallehacienda d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 9 AND p.id_TipoProyecto = 1 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc9H = $row['TOTAL'];

			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallesiembra d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 9 AND p.id_TipoProyecto = 2 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc9S = $row['TOTAL'];

			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallealquiler d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 9 AND p.id_TipoProyecto = 3 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc9A = $row['TOTAL'];

			$par9 = $parc9H + $parc9S + $parc9A;

			/* ------------------ */
			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallehacienda d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 10 AND p.id_TipoProyecto = 1 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc10H = $row['TOTAL'];

			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallesiembra d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 10 AND p.id_TipoProyecto = 2 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc10S = $row['TOTAL'];

			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallealquiler d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 10 AND p.id_TipoProyecto = 3 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc10A = $row['TOTAL'];

			$par10 = $parc10H + $parc10S + $parc10A;

			/* ------------------ */
			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallehacienda d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 11 AND p.id_TipoProyecto = 1 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc11H = $row['TOTAL'];

			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallesiembra d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 11 AND p.id_TipoProyecto = 2 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc11S = $row['TOTAL'];

			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallealquiler d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = 11 AND p.id_TipoProyecto = 3 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$parc11A = $row['TOTAL'];

			$par11 = $parc11H + $parc11S + $parc11A;

			$parcT = $par1 + $par2 + $par3 + $par4 + $par5 + $par6 + $par7 + $par8 + $par9 + $par10 + $par11; 

			/* ------------------ */
			?>
			<div class="centrado--table">
				<table>
					<tr>
						<th>Parcela</th>
						<th style="text-align: right;padding:15px;">Proyectos activos</th>
						<th class="change changealto">Detalles</th>
					</tr>
					<tr>
						<td>1</td>
						<td><?php echo $par1; ?></td>
						<td class="change"><a href="./parcelas.php?no=1"><button style="background-color: transparent;border:none;padding:3px;"><svg xmlns='http://www.w3.org/2000/svg' height='1.5em' viewBox='0 0 576 512'><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d='M352 224H305.5c-45 0-81.5 36.5-81.5 81.5c0 22.3 10.3 34.3 19.2 40.5c6.8 4.7 12.8 12 12.8 20.3c0 9.8-8 17.8-17.8 17.8h-2.5c-2.4 0-4.8-.4-7.1-1.4C210.8 374.8 128 333.4 128 240c0-79.5 64.5-144 144-144h80V34.7C352 15.5 367.5 0 386.7 0c8.6 0 16.8 3.2 23.2 8.9L548.1 133.3c7.6 6.8 11.9 16.5 11.9 26.7s-4.3 19.9-11.9 26.7l-139 125.1c-5.9 5.3-13.5 8.2-21.4 8.2H384c-17.7 0-32-14.3-32-32V224zM80 96c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16H400c8.8 0 16-7.2 16-16V384c0-17.7 14.3-32 32-32s32 14.3 32 32v48c0 44.2-35.8 80-80 80H80c-44.2 0-80-35.8-80-80V112C0 67.8 35.8 32 80 32h48c17.7 0 32 14.3 32 32s-14.3 32-32 32H80z'/></svg></button></a></td>
					</tr>
					<tr>
						<td>2</td>
						<td><?php echo $par2; ?></td>
						<td class="change"><a href="./parcelas.php?no=2"><button style="background-color: transparent;border:none;padding:3px;"><svg xmlns='http://www.w3.org/2000/svg' height='1.5em' viewBox='0 0 576 512'><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d='M352 224H305.5c-45 0-81.5 36.5-81.5 81.5c0 22.3 10.3 34.3 19.2 40.5c6.8 4.7 12.8 12 12.8 20.3c0 9.8-8 17.8-17.8 17.8h-2.5c-2.4 0-4.8-.4-7.1-1.4C210.8 374.8 128 333.4 128 240c0-79.5 64.5-144 144-144h80V34.7C352 15.5 367.5 0 386.7 0c8.6 0 16.8 3.2 23.2 8.9L548.1 133.3c7.6 6.8 11.9 16.5 11.9 26.7s-4.3 19.9-11.9 26.7l-139 125.1c-5.9 5.3-13.5 8.2-21.4 8.2H384c-17.7 0-32-14.3-32-32V224zM80 96c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16H400c8.8 0 16-7.2 16-16V384c0-17.7 14.3-32 32-32s32 14.3 32 32v48c0 44.2-35.8 80-80 80H80c-44.2 0-80-35.8-80-80V112C0 67.8 35.8 32 80 32h48c17.7 0 32 14.3 32 32s-14.3 32-32 32H80z'/></svg></button></a></td>
					</tr>
					<tr>
						<td>3</td>
						<td><?php echo $par3; ?></td>
						<td class="change"><a href="./parcelas.php?no=3"><button style="background-color: transparent;border:none;padding:3px;"><svg xmlns='http://www.w3.org/2000/svg' height='1.5em' viewBox='0 0 576 512'><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d='M352 224H305.5c-45 0-81.5 36.5-81.5 81.5c0 22.3 10.3 34.3 19.2 40.5c6.8 4.7 12.8 12 12.8 20.3c0 9.8-8 17.8-17.8 17.8h-2.5c-2.4 0-4.8-.4-7.1-1.4C210.8 374.8 128 333.4 128 240c0-79.5 64.5-144 144-144h80V34.7C352 15.5 367.5 0 386.7 0c8.6 0 16.8 3.2 23.2 8.9L548.1 133.3c7.6 6.8 11.9 16.5 11.9 26.7s-4.3 19.9-11.9 26.7l-139 125.1c-5.9 5.3-13.5 8.2-21.4 8.2H384c-17.7 0-32-14.3-32-32V224zM80 96c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16H400c8.8 0 16-7.2 16-16V384c0-17.7 14.3-32 32-32s32 14.3 32 32v48c0 44.2-35.8 80-80 80H80c-44.2 0-80-35.8-80-80V112C0 67.8 35.8 32 80 32h48c17.7 0 32 14.3 32 32s-14.3 32-32 32H80z'/></svg></button></a></td>
					</tr>
					<tr>
						<td>4</td>
						<td><?php echo $par4; ?></td>
						<td class="change"><a href="./parcelas.php?no=4"><button style="background-color: transparent;border:none;padding:3px;"><svg xmlns='http://www.w3.org/2000/svg' height='1.5em' viewBox='0 0 576 512'><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d='M352 224H305.5c-45 0-81.5 36.5-81.5 81.5c0 22.3 10.3 34.3 19.2 40.5c6.8 4.7 12.8 12 12.8 20.3c0 9.8-8 17.8-17.8 17.8h-2.5c-2.4 0-4.8-.4-7.1-1.4C210.8 374.8 128 333.4 128 240c0-79.5 64.5-144 144-144h80V34.7C352 15.5 367.5 0 386.7 0c8.6 0 16.8 3.2 23.2 8.9L548.1 133.3c7.6 6.8 11.9 16.5 11.9 26.7s-4.3 19.9-11.9 26.7l-139 125.1c-5.9 5.3-13.5 8.2-21.4 8.2H384c-17.7 0-32-14.3-32-32V224zM80 96c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16H400c8.8 0 16-7.2 16-16V384c0-17.7 14.3-32 32-32s32 14.3 32 32v48c0 44.2-35.8 80-80 80H80c-44.2 0-80-35.8-80-80V112C0 67.8 35.8 32 80 32h48c17.7 0 32 14.3 32 32s-14.3 32-32 32H80z'/></svg></button></a></td>
					</tr>
					<tr>
						<td>5</td>
						<td><?php echo $par5; ?></td>
						<td class="change"><a href="./parcelas.php?no=5"><button style="background-color: transparent;border:none;padding:3px;"><svg xmlns='http://www.w3.org/2000/svg' height='1.5em' viewBox='0 0 576 512'><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d='M352 224H305.5c-45 0-81.5 36.5-81.5 81.5c0 22.3 10.3 34.3 19.2 40.5c6.8 4.7 12.8 12 12.8 20.3c0 9.8-8 17.8-17.8 17.8h-2.5c-2.4 0-4.8-.4-7.1-1.4C210.8 374.8 128 333.4 128 240c0-79.5 64.5-144 144-144h80V34.7C352 15.5 367.5 0 386.7 0c8.6 0 16.8 3.2 23.2 8.9L548.1 133.3c7.6 6.8 11.9 16.5 11.9 26.7s-4.3 19.9-11.9 26.7l-139 125.1c-5.9 5.3-13.5 8.2-21.4 8.2H384c-17.7 0-32-14.3-32-32V224zM80 96c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16H400c8.8 0 16-7.2 16-16V384c0-17.7 14.3-32 32-32s32 14.3 32 32v48c0 44.2-35.8 80-80 80H80c-44.2 0-80-35.8-80-80V112C0 67.8 35.8 32 80 32h48c17.7 0 32 14.3 32 32s-14.3 32-32 32H80z'/></svg></button></a></td>
					</tr>
					<tr>
						<td>6</td>
						<td><?php echo $par6; ?></td>
						<td class="change"><a href="./parcelas.php?no=6"><button style="background-color: transparent;border:none;padding:3px;"><svg xmlns='http://www.w3.org/2000/svg' height='1.5em' viewBox='0 0 576 512'><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d='M352 224H305.5c-45 0-81.5 36.5-81.5 81.5c0 22.3 10.3 34.3 19.2 40.5c6.8 4.7 12.8 12 12.8 20.3c0 9.8-8 17.8-17.8 17.8h-2.5c-2.4 0-4.8-.4-7.1-1.4C210.8 374.8 128 333.4 128 240c0-79.5 64.5-144 144-144h80V34.7C352 15.5 367.5 0 386.7 0c8.6 0 16.8 3.2 23.2 8.9L548.1 133.3c7.6 6.8 11.9 16.5 11.9 26.7s-4.3 19.9-11.9 26.7l-139 125.1c-5.9 5.3-13.5 8.2-21.4 8.2H384c-17.7 0-32-14.3-32-32V224zM80 96c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16H400c8.8 0 16-7.2 16-16V384c0-17.7 14.3-32 32-32s32 14.3 32 32v48c0 44.2-35.8 80-80 80H80c-44.2 0-80-35.8-80-80V112C0 67.8 35.8 32 80 32h48c17.7 0 32 14.3 32 32s-14.3 32-32 32H80z'/></svg></button></a></td>
					</tr>
					<tr>
						<td>7</td>
						<td><?php echo $par7; ?></td>
						<td class="change"><a href="./parcelas.php?no=7"><button style="background-color: transparent;border:none;padding:3px;"><svg xmlns='http://www.w3.org/2000/svg' height='1.5em' viewBox='0 0 576 512'><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d='M352 224H305.5c-45 0-81.5 36.5-81.5 81.5c0 22.3 10.3 34.3 19.2 40.5c6.8 4.7 12.8 12 12.8 20.3c0 9.8-8 17.8-17.8 17.8h-2.5c-2.4 0-4.8-.4-7.1-1.4C210.8 374.8 128 333.4 128 240c0-79.5 64.5-144 144-144h80V34.7C352 15.5 367.5 0 386.7 0c8.6 0 16.8 3.2 23.2 8.9L548.1 133.3c7.6 6.8 11.9 16.5 11.9 26.7s-4.3 19.9-11.9 26.7l-139 125.1c-5.9 5.3-13.5 8.2-21.4 8.2H384c-17.7 0-32-14.3-32-32V224zM80 96c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16H400c8.8 0 16-7.2 16-16V384c0-17.7 14.3-32 32-32s32 14.3 32 32v48c0 44.2-35.8 80-80 80H80c-44.2 0-80-35.8-80-80V112C0 67.8 35.8 32 80 32h48c17.7 0 32 14.3 32 32s-14.3 32-32 32H80z'/></svg></button></a></td>
					</tr>
					<tr>
						<td>8</td>
						<td><?php echo $par8; ?></td>
						<td class="change"><a href="./parcelas.php?no=8"><button style="background-color: transparent;border:none;padding:3px;"><svg xmlns='http://www.w3.org/2000/svg' height='1.5em' viewBox='0 0 576 512'><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d='M352 224H305.5c-45 0-81.5 36.5-81.5 81.5c0 22.3 10.3 34.3 19.2 40.5c6.8 4.7 12.8 12 12.8 20.3c0 9.8-8 17.8-17.8 17.8h-2.5c-2.4 0-4.8-.4-7.1-1.4C210.8 374.8 128 333.4 128 240c0-79.5 64.5-144 144-144h80V34.7C352 15.5 367.5 0 386.7 0c8.6 0 16.8 3.2 23.2 8.9L548.1 133.3c7.6 6.8 11.9 16.5 11.9 26.7s-4.3 19.9-11.9 26.7l-139 125.1c-5.9 5.3-13.5 8.2-21.4 8.2H384c-17.7 0-32-14.3-32-32V224zM80 96c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16H400c8.8 0 16-7.2 16-16V384c0-17.7 14.3-32 32-32s32 14.3 32 32v48c0 44.2-35.8 80-80 80H80c-44.2 0-80-35.8-80-80V112C0 67.8 35.8 32 80 32h48c17.7 0 32 14.3 32 32s-14.3 32-32 32H80z'/></svg></button></a></td>
					</tr>
					<tr>
						<td>9</td>
						<td><?php echo $par9; ?></td>
						<td class="change"><a href="./parcelas.php?no=9"><button style="background-color: transparent;border:none;padding:3px;"><svg xmlns='http://www.w3.org/2000/svg' height='1.5em' viewBox='0 0 576 512'><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d='M352 224H305.5c-45 0-81.5 36.5-81.5 81.5c0 22.3 10.3 34.3 19.2 40.5c6.8 4.7 12.8 12 12.8 20.3c0 9.8-8 17.8-17.8 17.8h-2.5c-2.4 0-4.8-.4-7.1-1.4C210.8 374.8 128 333.4 128 240c0-79.5 64.5-144 144-144h80V34.7C352 15.5 367.5 0 386.7 0c8.6 0 16.8 3.2 23.2 8.9L548.1 133.3c7.6 6.8 11.9 16.5 11.9 26.7s-4.3 19.9-11.9 26.7l-139 125.1c-5.9 5.3-13.5 8.2-21.4 8.2H384c-17.7 0-32-14.3-32-32V224zM80 96c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16H400c8.8 0 16-7.2 16-16V384c0-17.7 14.3-32 32-32s32 14.3 32 32v48c0 44.2-35.8 80-80 80H80c-44.2 0-80-35.8-80-80V112C0 67.8 35.8 32 80 32h48c17.7 0 32 14.3 32 32s-14.3 32-32 32H80z'/></svg></button></a></td>
					</tr>
					<tr>
						<td>10</td>
						<td><?php echo $par10; ?></td>
						<td class="change"><a href="./parcelas.php?no=10"><button style="background-color: transparent;border:none;padding:3px;"><svg xmlns='http://www.w3.org/2000/svg' height='1.5em' viewBox='0 0 576 512'><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d='M352 224H305.5c-45 0-81.5 36.5-81.5 81.5c0 22.3 10.3 34.3 19.2 40.5c6.8 4.7 12.8 12 12.8 20.3c0 9.8-8 17.8-17.8 17.8h-2.5c-2.4 0-4.8-.4-7.1-1.4C210.8 374.8 128 333.4 128 240c0-79.5 64.5-144 144-144h80V34.7C352 15.5 367.5 0 386.7 0c8.6 0 16.8 3.2 23.2 8.9L548.1 133.3c7.6 6.8 11.9 16.5 11.9 26.7s-4.3 19.9-11.9 26.7l-139 125.1c-5.9 5.3-13.5 8.2-21.4 8.2H384c-17.7 0-32-14.3-32-32V224zM80 96c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16H400c8.8 0 16-7.2 16-16V384c0-17.7 14.3-32 32-32s32 14.3 32 32v48c0 44.2-35.8 80-80 80H80c-44.2 0-80-35.8-80-80V112C0 67.8 35.8 32 80 32h48c17.7 0 32 14.3 32 32s-14.3 32-32 32H80z'/></svg></button></a></td>
					</tr>
					<tr>
						<td>11</td>
						<td><?php echo $par11; ?></td>
						<td class="change"><a href="./parcelas.php?no=11"><button style="background-color: transparent;border:none;padding:3px;"><svg xmlns='http://www.w3.org/2000/svg' height='1.5em' viewBox='0 0 576 512'><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d='M352 224H305.5c-45 0-81.5 36.5-81.5 81.5c0 22.3 10.3 34.3 19.2 40.5c6.8 4.7 12.8 12 12.8 20.3c0 9.8-8 17.8-17.8 17.8h-2.5c-2.4 0-4.8-.4-7.1-1.4C210.8 374.8 128 333.4 128 240c0-79.5 64.5-144 144-144h80V34.7C352 15.5 367.5 0 386.7 0c8.6 0 16.8 3.2 23.2 8.9L548.1 133.3c7.6 6.8 11.9 16.5 11.9 26.7s-4.3 19.9-11.9 26.7l-139 125.1c-5.9 5.3-13.5 8.2-21.4 8.2H384c-17.7 0-32-14.3-32-32V224zM80 96c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16H400c8.8 0 16-7.2 16-16V384c0-17.7 14.3-32 32-32s32 14.3 32 32v48c0 44.2-35.8 80-80 80H80c-44.2 0-80-35.8-80-80V112C0 67.8 35.8 32 80 32h48c17.7 0 32 14.3 32 32s-14.3 32-32 32H80z'/></svg></button></a></td>
					</tr>
					<tr style="color: #0a6111; font-weight: bold;">
						<td>Total</td>
						<td><?php echo $parcT; ?></td>
					</tr>

				</table>
			</div>

			<div class="containerMapMobile">
				<img src="../imagenes/DJ-marcada.png" alt="">
			</div>

			<div class="containerMap">
				<map name="mapa">
					<img src="../imagenes/DJ-marcada.png" usemap="#mapa" style="border-radius: 15px;box-shadow: none;">
					<area id="area1" class="area" shape="rectangle" coords="494, 690 333, 626" href="./parcelas.php?no=1" title="Parcela 1 [43ha]"></area>
					<area id="area2" shape="rectangle" coords="333, 626 497, 478" class="area" href="./parcelas.php?no=2" title="Parcela 2 [90ha]">
					<area id="area" shape="rectangle" coords="494, 527 657, 367" class="area" href="./parcelas.php?no=3" title="Parcela 3 [100ha]">
					<area id="area" shape="rectangle" coords="497, 478 334, 365" class="area" href="./parcelas.php?no=4" title="Parcela 4 [70ha]">
					<area id="area" shape="rectangle" coords="170, 481 331, 690" class="area" href="./parcelas.php?no=5" title="Parcela 5 [100ha]">
					<area id="area" shape="rectangle" coords="334, 365 170, 481" class="area" href="./parcelas.php?no=6" title="Parcela 6 [70ha]">
					<area id="area" shape="rectangle" coords="426, 365 667, 251" class="area" href="./parcelas.php?no=7" title="Parcela 7 [100ha]">
					<area id="area" shape="rectangle" coords="426, 365 342, 247" class="area" href="./parcelas.php?no=8" title="Parcela 8 [35ha]">
					<area id="area" shape="rectangle" coords="342, 247 429, 38" class="area" href="./parcelas.php?no=9" title="Parcela 9 [65ha]">
					<area id="area" shape="rectangle" coords="429, 38 542, 250" class="area" href="./parcelas.php?no=10" title="Parcela 10 [95ha]">
					<area id="area1" class="area" shape="rectangle" coords="347, 38 257, 163" href="./parcelas.php?no=11" title="Parcela 11 [30ha]">
				</map>
			</div>

			<div class="centrado--notif">
				<div class="centrado--notif-tit">
					<h4>Notificaciones</h4>
				</div>
				<div class="centrado--notif-cont">
					<?php
					/* CALCULAR DIAS TRANSCURRIDOS ENTRE ANTERIOR ESTADO Y ESTE */

					date_default_timezone_set('UTC');
					date_default_timezone_set("America/Buenos_Aires");
					$fechaActual = date('Y-m-d');
					$mensaje = "";

					$cantidadRegistros = 0;
					$consulta=mysqli_query($conexion, "SELECT p.id_Proyecto, p.nombreProyecto, ds.fechaCierre AS fcs, dh.fechaCierre AS fch, da.fechaCierre AS fca, t.tipoProyecto, ds.fechaInicio AS fis, dh.fechaInicio AS fih, da.fechaInicio AS fia, p.id_EstadoProyecto
					FROM proyectos p 
					LEFT JOIN detallesiembra ds ON ds.id_Proyecto = p.id_Proyecto 
					LEFT JOIN detallehacienda dh ON dh.id_Proyecto = p.id_Proyecto
					LEFT JOIN detallealquiler da ON da.id_Proyecto = p.id_Proyecto
					LEFT JOIN tipoproyecto t ON t.id_tipoProyecto = p.id_TipoProyecto
					WHERE ds.fechaCierre > '$fechaActual' OR dh.fechaCierre > '$fechaActual' OR da.fechaCierre > '$fechaActual'");
					while($listar = mysqli_fetch_array($consulta))
					{
						if(isset($listar['fch'])){
							$fechabd = $listar['fch'];
						}else if(isset($listar['fcs'])){
							$fechabd = $listar['fcs'];
						}else{
							$fechabd = $listar['fca'];
						}
						
						$fec1bd = $fechabd;
						$fec1actual = $fechaActual;

						$segundosFechabd = strtotime($fec1bd);
						$segundosFechaactual = strtotime($fec1actual);
						
						$segundosTranscurridos = $segundosFechabd - $segundosFechaactual;
						$minutosTranscurridos = $segundosTranscurridos / 60;
						$horas = $minutosTranscurridos / 60;
						$dias = $horas / 24;
						$diasRedondedos = floor($dias);

						if($diasRedondedos < 30 AND $diasRedondedos > 0){
							echo "<li>El proyecto '<strong>$listar[nombreProyecto]</strong>' de $listar[tipoProyecto] está próximo a <strong><span style='color:red;'>finalizar</span></strong>.<br/><u>Días para el cierre</u>: $diasRedondedos</li>";
							echo "<hr/>";
							$mensaje = $mensaje + "<li>El proyecto '<strong>$listar[nombreProyecto]</strong>' de $listar[tipoProyecto] está próximo a <strong><span style='color:red;'>finalizar</span></strong>.<br/><u>Días para el cierre</u>: $diasRedondedos</li><br/>";
							$cantidadRegistros++;
						}


/* ----------------------------PROYECTOS POR COMENZAR ---------------------------------------- */

						if(isset($listar['fis'])){
							$fechabd2 = $listar['fis'];
						}else if(isset($listar['fih'])){
							$fechabd2 = $listar['fih'];
						}else{
							$fechabd2 = $listar['fia'];
						}

						$fec2bd = $fechabd2;
						$fec2actual = $fechaActual;
	
						$segundosFechabd2 = strtotime($fec2bd);
						$segundosFechaactual2 = strtotime($fec2actual);
						
						$segundosTranscurridos2 = $segundosFechabd2 - $segundosFechaactual2;
						$minutosTranscurridos2 = $segundosTranscurridos2 / 60;
						$horas2 = $minutosTranscurridos2 / 60;
						$dias2 = $horas2 / 24;
						$diasRedondedos2 = floor($dias2);
	
						if($listar['id_EstadoProyecto'] == 1 AND $diasRedondedos2 < 30 AND $diasRedondedos2 > 0){
							echo "<li>El proyecto '<strong>$listar[nombreProyecto]</strong>' de $listar[tipoProyecto] está próximo a <strong><span style='color:green;'>Comenzar</span></strong>.<br/><u>Días para el inicio</u>: $diasRedondedos2</li>";
							echo "<hr/>";
							$mensaje = $mensaje + "<li>El proyecto '<strong>$listar[nombreProyecto]</strong>' de $listar[tipoProyecto] está próximo a <strong><span style='color:green;'>Comenzar</span></strong>.<br/><u>Días para el inicio</u>: $diasRedondedos2</li>";
							$cantidadRegistros++;
						}
						
					}

					if($cantidadRegistros == 0){
						echo "<p class='centrado--notif-contva'>No hay notificaciones</p>";
					}
					?>
				</div>
			</div>
		</div>
	</section>
	</main>
