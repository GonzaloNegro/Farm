<?php #Llammo a cabecera, incluye el archivo cabecera.php desde template
include ("../Modelo/Conexion.php");
include('../Template/Cabecera.php');
/* error_reporting(0); */

$parcela = $_GET['no'];

?>
<title>Don Juan S.R.L detalles</title>

<center>
<div class="centrado-vlv">
        <a href="./inicio.php"><button class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>&nbsp Atrás</button></a>
    </div>
	<div class="">
		<?php
			if($parcela == 1){
				echo "<h1>Parcela 1</h1>";
			}else if($parcela == 2){
				echo "<h1>Parcela 2</h1>";
			}else if($parcela == 3){
				echo "<h1>Parcela 3</h1>";
			}else if($parcela == 4){
				echo "<h1>Parcela 4</h1>";
			}else if($parcela == 5){
				echo "<h1>Parcela 5</h1>";
			}else if($parcela == 6){
				echo "<h1>Parcela 6</h1>";
			}else if($parcela == 7){
				echo "<h1>Parcela 7</h1>";
			}else if($parcela == 8){
				echo "<h1>Parcela 8</h1>";
			}else if($parcela == 9){
				echo "<h1>Parcela 9</h1>";
			}else if($parcela == 10){
				echo "<h1>Parcela 10</h1>";
			}else if($parcela == 11){
				echo "<h1>Parcela 11</h1>";
			}
		?>
		<!-- <p style="color:green;font-weight:bold;">Ubicación: -36.01162, -63.98526   (corresponde a la 7 con las nuevas tablas)</p> -->
	</div>		
	<br>
</center>
<center>
<table style="border:none; width:1200px; background-color: white; border-radius:2px;box-shadow: 5px 5px 5px 5px rgba(165, 164, 164, 0.3);">
		<thead>
		<tr style="color:green; background-color:white;font-weight:bold;border-bottom: 2px solid green;">			
			<th style="text-align:center;font-size:16pt;text-align:right;padding-right:5px;border-right: 2px solid green">Dimension</th>
			<th style="text-align:center;font-size:16pt;text-align:right;padding-right:5px;border-right: 2px solid green">Has Ocupadas</th>
			<th style="text-align:center;font-size:16pt;text-align:right;padding-right:5px;border-right: 2px solid green">Has Disponibles</th>
			<th style="text-align:center;font-size:16pt;text-align:right;padding-right:5px;">Proyectos Activos</th>					
		</tr>
		</thead>
	   <?php
		$consulta=mysqli_query($conexion, "SELECT p.id_Parcela, 
		p.dimension, sum(pr.cantidadHas) AS cantHas, p.dimension - sum(pr.cantidadHas) AS hasDisp, count(pr.id_Proyecto) AS cantPro
		FROM parcela p
		LEFT JOIN Proyectos pr on p.id_Parcela = pr.id_Parcela
		WHERE p.id_Parcela = '$parcela'");
		while($listar = mysqli_fetch_array($consulta))
		{
			date_default_timezone_set('UTC');
			date_default_timezone_set("America/Buenos_Aires");
			$fechaActual = date('Y-m-d');

			$sent= "SELECT count(p.id_Proyecto) AS totalH, SUM(p.cantidadHas) AS totalHasH, p.id_EstadoProyecto
			FROM proyectos p
			LEFT JOIN detallehacienda dh ON dh.id_Proyecto = p.id_Proyecto
			WHERE dh.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2 AND p.id_Parcela = '$parcela'";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$totalH = $row['totalH'];
			$totalHasH = $row['totalHasH'];

			$sent1= "SELECT count(*) AS totalS, SUM(p.cantidadHas) AS totalHasS, p.id_EstadoProyecto
			FROM proyectos p
			LEFT JOIN detallesiembra ds ON ds.id_Proyecto = p.id_Proyecto
			WHERE ds.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2 AND p.id_Parcela = $parcela";
			$resultado1 = $conexion->query($sent1);
			$row1 = $resultado1->fetch_assoc();
			$totalS = $row1['totalS'];
			$totalHasS = $row1['totalHasS'];

			$totalPr = $totalH + $totalS;
			$totalHas = $totalHasH + $totalHasS;

			$hasDisponibles = $listar['dimension'] - $totalHas;

			echo "
			<tr style='border-bottom:1px solid grey;'>
				<td style='font-weight:bold;text-align:right;padding-left:5px;border-right: 1px solid green'>$listar[dimension] Has</td>
				<td style='font-weight:bold;text-align:right;padding-right:5px;border-right: 1px solid green'>$totalHas Has</td>
				<td style='font-weight:bold;text-align:right;padding-right:5px;border-right: 1px solid green'>$hasDisponibles Has</td>
				<td style='font-weight:bold;text-align:right;padding-right:5px;'>$totalPr</td>
		</tr>";
		} 
?>
</table>
	<br>
	<br>
	<br>
	<br>
	<table style="border:none; width:1200px; background-color: white; border-radius:2px;">

		<h2> Proyecto de hacienda</caption>
		<?php
			date_default_timezone_set('UTC');
			date_default_timezone_set("America/Buenos_Aires");
			$fechaActual = date('Y-m-d');
		
			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallehacienda d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = '$parcela' AND p.id_TipoProyecto = 1 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$totalProyHac = $row['TOTAL'];

		if($totalProyHac > 0){
		?>
		<thead>
			<tr style="color:green; background-color:white;font-weight:bold; border-bottom: 2px solid green;">
				<th style="text-align:center;font-size:16pt;text-align:left;padding:3px;border-right: 2px solid green;">Nombre Proyecto</th>
				<th style="text-align:center;font-size:16pt;text-align:center;border-right: 2px solid green;padding:3px;">Fecha Inicio</th>
				<th style="text-align:center;font-size:16pt;text-align:center;border-right: 2px solid green;padding:3px;">Fecha Cierre</th>
				<th style="text-align:center;font-size:16pt;text-align:right;padding:3px;;border-right: 2px solid green;">Hectareas</th>
				<th style="text-align:center;font-size:16pt;text-align:right;padding:3px;border-right: 2px solid green;">Cabezas</th>
				<th style="text-align:center;font-size:16pt;text-align:left;padding:3px;border-right: 2px solid green;">Categoria</th>
				<th style="text-align:center;font-size:16pt;text-align:right;padding:3px;border-right: 2px solid green;">Inversión total USD</th>
				<th style="text-align:center;font-size:16pt;text-align:right;padding:3px;">Inversión total ARS</th>
			</tr>
		</thead>
</center>

<?php
		date_default_timezone_set('UTC');
		date_default_timezone_set("America/Buenos_Aires");
		$fechaActual = date('Y-m-d');

		$consulta=mysqli_query($conexion, "SELECT
		pr.id_Proyecto, pr.nombreProyecto, dh.fechaInicio, dh.fechaCierre, pr.cantidadHas, dh.cantidadCabezas, c.nombreCategoria, dh.inversion, dh.id_Moneda AS monHac, dh.tipoCambio AS tipoCambHac, pr.id_EstadoProyecto
		FROM Proyectos pr
		INNER JOIN detalleHacienda dh ON pr.id_Proyecto = dh.id_Proyecto
		INNER JOIN Categoria c ON c.id_Categoria = dh.id_Categoria
		WHERE pr.id_Parcela = '$parcela' AND pr.id_EstadoProyecto = 2 AND dh.fechaCierre > '$fechaActual'");
		while($listar = mysqli_fetch_array($consulta))
		{
			$proyec = $listar['id_Proyecto'];
			$fec = date("d-m-Y", strtotime($listar['fechaInicio']));
			$fec2 = date("d-m-Y", strtotime($listar['fechaCierre']));


			$invInicial = $listar['inversion'];

			if($listar['monHac'] == 2){
				$invInicialDolares = $invInicial;
				$invInicialPesos = $invInicial * $listar['tipoCambHac'];
			}

			if($listar['monHac'] == 1){
				$invInicialPesos = $invInicial;
				$invInicialDolares = $invInicial / $listar['tipoCambHac'];
			}

			
			$enPesos = 0;
			$enDolares = 0;
			
			$consulta2=mysqli_query($conexion, "SELECT c.importeTotal, c.id_Moneda, c.tipoCambio
			FROM compras c
			LEFT JOIN compraproyecto co ON co.id_Compras = c.id_Compras
			WHERE co.id_Proyecto = '$proyec'");
			while($listar2 = mysqli_fetch_array($consulta2)){
				
				//PARA SACAR IMPORTE TOTAL EN DOLARES
				if($listar2['id_Moneda'] == 1){
					$enPesos = $enPesos + $listar2['importeTotal'];
					$enDolares = $enDolares + ($listar2['importeTotal'] / $listar2['tipoCambio']);
				}
				
				//PARA SACAR IMPORTE TOTAL EN PESOS
				if($listar2['id_Moneda'] == 2){
					$enDolares = $enDolares + $listar2['importeTotal'];
					$enPesos = $enPesos + ($listar2['importeTotal'] * $listar2['tipoCambio']);
				}
			}

			$enDolares = $enDolares + $invInicialDolares;
			$enPesos = $enPesos + $invInicialPesos;

			$dolares = number_format($enDolares, 2, ',','.');
			$pesos = number_format($enPesos, 2, ',','.');

			echo "
			<tr style='border-bottom:1px solid grey;'>
				<td style='font-weight:bold;text-align:left;padding-left:5px;border-right: 1px solid green;'>$listar[nombreProyecto]</td>
				<td style='font-weight:bold;text-align:center;border-right: 1px solid green;'>$fec</td>
				<td style='font-weight:bold;text-align:center;border-right: 1px solid green;'>$fec2</td>
				<td style='font-weight:bold;text-align:right;padding-right:5px;border-right: 1px solid green;'>$listar[cantidadHas] Has</td>
				<td style='font-weight:bold;text-align:right;padding-right:5px;border-right: 1px solid green;'>$listar[cantidadCabezas]</td>
				<td style='font-weight:bold;text-align:left;padding-left:5px;border-right: 1px solid green;'>$listar[nombreCategoria]</td>
				<td style='font-weight:bold;text-align:right;padding-right:5px;border-right: 1px solid green;'>$$dolares</td>
				<td style='font-weight:bold;text-align:right;padding-right:5px;'>$$pesos</td> 
			</tr>";
		} 
	}
	else{
		echo "<h4>No hay proyectos activos</h4>";
	}
?>
</table>
<br>
<br>
<br>
<br>
<center>
	<table style="border:none; width:1200px; background-color: white; border-radius:2px;">
		<h2>Proyecto de siembra</h2>
		<?php
			date_default_timezone_set('UTC');
			date_default_timezone_set("America/Buenos_Aires");
			$fechaActual = date('Y-m-d');
		
			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallesiembra d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = '$parcela' AND p.id_TipoProyecto = 2 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$totalProySie = $row['TOTAL'];

		if($totalProySie > 0){
		?>
		<thead>
		<tr style="color:green; background-color:white;font-weight:bold;border-bottom: 2px solid green;">
			<th style="text-align:center;font-size:16pt;text-align:left;padding:3px;border-right: 2px solid green;padding:3px;">Nombre Proyecto</th>
			<th style="text-align:center;font-size:16pt;text-align:center;border-right: 2px solid green;padding:3px;">Fecha Inicio</th>
			<th style="text-align:center;font-size:16pt;text-align:center;border-right: 2px solid green;padding:3px;">Fecha Cierre</th>
			<th style="text-align:center;font-size:16pt;text-align:right;border-right: 2px solid green;padding:3px;">Hectareas</th>
			<th style="text-align:center;font-size:16pt;text-align:left;border-right: 2px solid green;padding:3px;">Cultivo </th>
			<th style="text-align:center;font-size:16pt;text-align:right;border-right: 2px solid green;padding:3px;">Rinde esperado</th>
			<th style="text-align:center;font-size:16pt;text-align:right;border-right: 2px solid green;padding:3px;">Inversión total USD</th>
			<th style="text-align:center;font-size:16pt;text-align:right;padding:5px;">Inversión total ARS</th>
		</tr>
		</thead>
</center>

<?php
		date_default_timezone_set('UTC');
		date_default_timezone_set("America/Buenos_Aires");
		$fechaActual = date('Y-m-d');

		$consulta=mysqli_query($conexion, "SELECT 
		pr.id_Proyecto, pr.nombreProyecto, ds.fechaInicio, ds.fechaCierre, pr.cantidadHas, c.nombreCultivo, ds.id_Moneda AS monSiem, ds.tipoCambio AS tipoCambSiem,
		ds.inversion, (pr.cantidadHas * c.rindeEsperadoHas) AS rinde
		FROM Proyectos pr
		INNER JOIN detalleSiembra ds ON pr.id_Proyecto = ds.id_Proyecto
		INNER JOIN Cultivos c ON c.id_Cultivo = ds.id_Cultivo
		WHERE pr.id_Parcela = '$parcela' AND pr.id_EstadoProyecto = 2 AND ds.fechaCierre > '$fechaActual'");
		while($listar = mysqli_fetch_array($consulta))
		{

			$proyec = $listar['id_Proyecto'];
			$fecs = date("d-m-Y", strtotime($listar['fechaInicio']));
			$fecs2 = date("d-m-Y", strtotime($listar['fechaCierre']));

			$invInicial = $listar['inversion'];

			if($listar['monSiem'] == 2){
				$invInicialDolares = $invInicial;
				$invInicialPesos = $invInicial * $listar['tipoCambSiem'];
			}

			if($listar['monSiem'] == 1){
				$invInicialPesos = $invInicial;
				$invInicialDolares = $invInicial / $listar['tipoCambSiem'];
			}

			
			$enPesos = 0;
			$enDolares = 0;
			
			$consulta2=mysqli_query($conexion, "SELECT c.importeTotal, c.id_Moneda, c.tipoCambio
			FROM compras c
			LEFT JOIN compraproyecto co ON co.id_Compras = c.id_Compras
			WHERE co.id_Proyecto = '$proyec'");
			while($listar2 = mysqli_fetch_array($consulta2)){
				
				//PARA SACAR IMPORTE TOTAL EN DOLARES
				if($listar2['id_Moneda'] == 1){
					$enPesos = $enPesos + $listar2['importeTotal'];
					$enDolares = $enDolares + ($listar2['importeTotal'] / $listar2['tipoCambio']);
				}
				
				//PARA SACAR IMPORTE TOTAL EN PESOS
				if($listar2['id_Moneda'] == 2){
					$enDolares = $enDolares + $listar2['importeTotal'];
					$enPesos = $enPesos + ($listar2['importeTotal'] * $listar2['tipoCambio']);
				}
			}

			$enDolares = $enDolares + $invInicialDolares;
			$enPesos = $enPesos + $invInicialPesos;

			$dolares = number_format($enDolares, 2, ',','.');
			$pesos = number_format($enPesos, 2, ',','.');
			
			
			$rinde = number_format($listar['rinde'], 2, ',','.');

			echo "
			<tr style='border-bottom:1px solid grey;'>
				<td style='font-weight:bold;text-align:left;padding-left:5px;border-right: 1px solid green;'>$listar[nombreProyecto] </td>
				<td style='font-weight:bold;text-align:center;border-right: 1px solid green;'>$fecs</td>
				<td style='font-weight:bold;text-align:center;border-right: 1px solid green;'>$fecs2</td>
				<td style='font-weight:bold;text-align:right;padding-right:5px;border-right: 1px solid green;'>$listar[cantidadHas] Has</td>
				<td style='font-weight:bold;text-align:left;padding-left:5px;border-right: 1px solid green;'>$listar[nombreCultivo]</td>
				<td style='font-weight:bold;text-align:right;padding-right:5px;border-right: 1px solid green;'>$rinde kg</td>
				<td style='font-weight:bold;text-align:right;padding-right:5px;border-right: 1px solid green;'>$$dolares</td>
				<td style='font-weight:bold;text-align:right;padding-right:5px;'>$$pesos</td> 
			</tr>";
		} 
	}
	else{
		echo "<h4>No hay proyectos activos</h4>";
	}
?>
</table>
	<br>
	<br>
	<br>
	<br>
	<table style="border:none; width:1200px; background-color: white; border-radius:2px;">

		<h2> Proyecto de Alquiler</caption>
		<?php
			date_default_timezone_set('UTC');
			date_default_timezone_set("America/Buenos_Aires");
			$fechaActual = date('Y-m-d');
		
			$sent= "SELECT count(p.id_Proyecto) AS TOTAL 
			FROM proyectos p
			LEFT JOIN detallealquiler d ON d.id_Proyecto = p.id_Proyecto
			WHERE p.id_Parcela = '$parcela' AND p.id_TipoProyecto = 3 AND d.fechaCierre > '$fechaActual' AND p.id_EstadoProyecto = 2";
			$resultado = $conexion->query($sent);
			$row = $resultado->fetch_assoc();
			$totalProyAlq = $row['TOTAL'];

		if($totalProyAlq > 0){
		?>
		<thead>
			<tr style="color:green; background-color:white;font-weight:bold; border-bottom: 2px solid green;">
				<th style="text-align:center;font-size:16pt;text-align:left;padding:3px;border-right: 2px solid green;">Nombre Proyecto</th>
				<th style="text-align:center;font-size:16pt;text-align:center;border-right: 2px solid green;padding:3px;">Fecha Inicio</th>
				<th style="text-align:center;font-size:16pt;text-align:center;border-right: 2px solid green;padding:3px;">Fecha Cierre</th>
				<th style="text-align:center;font-size:16pt;text-align:right;padding:3px;;border-right: 2px solid green;">Hectareas</th>
				<th style="text-align:center;font-size:16pt;text-align:right;padding:3px;border-right: 2px solid green;">Monto estipulado USD</th>
				<th style="text-align:center;font-size:16pt;text-align:right;padding:3px;">Monto estipulado ARS</th>
			</tr>
		</thead>
</center>

<?php
		date_default_timezone_set('UTC');
		date_default_timezone_set("America/Buenos_Aires");
		$fechaActual = date('Y-m-d');

		$consulta=mysqli_query($conexion, "SELECT
		pr.id_Proyecto, pr.nombreProyecto, da.fechaInicio, da.fechaCierre, pr.cantidadHas, da.montoEstipulado, da.id_Moneda AS monAlq, da.tipoCambio AS tipoCambHac, pr.id_EstadoProyecto
		FROM Proyectos pr
		INNER JOIN detallealquiler da ON pr.id_Proyecto = da.id_Proyecto
		WHERE pr.id_Parcela = '$parcela' AND pr.id_EstadoProyecto = 2 AND da.fechaCierre > '$fechaActual'");
		while($listar = mysqli_fetch_array($consulta))
		{
			$proyec = $listar['id_Proyecto'];
			$fec = date("d-m-Y", strtotime($listar['fechaInicio']));
			$fec2 = date("d-m-Y", strtotime($listar['fechaCierre']));


			$invInicial = $listar['montoEstipulado'];

			if($listar['monAlq'] == 2){
				$invInicialDolares = $invInicial;
				$invInicialPesos = $invInicial * $listar['tipoCambHac'];
			}

			if($listar['monAlq'] == 1){
				$invInicialPesos = $invInicial;
				$invInicialDolares = $invInicial / $listar['tipoCambHac'];
			}


			$dolares = number_format($invInicialDolares, 2, ',','.');
			$pesos = number_format($invInicialPesos, 2, ',','.');

			echo "
			<tr style='border-bottom:1px solid grey;'>
				<td style='font-weight:bold;text-align:left;padding-left:5px;border-right: 1px solid green;'>$listar[nombreProyecto]</td>
				<td style='font-weight:bold;text-align:center;border-right: 1px solid green;'>$fec</td>
				<td style='font-weight:bold;text-align:center;border-right: 1px solid green;'>$fec2</td>
				<td style='font-weight:bold;text-align:right;padding-right:5px;border-right: 1px solid green;'>$listar[cantidadHas] Has</td>
				<td style='font-weight:bold;text-align:right;padding-right:5px;border-right: 1px solid green;'>$$dolares</td>
				<td style='font-weight:bold;text-align:right;padding-right:5px;'>$$pesos</td> 
			</tr>";
		} 
	}
	else{
		echo "<h4>No hay proyectos activos</h4>";
	}
?>
</table>
</body>