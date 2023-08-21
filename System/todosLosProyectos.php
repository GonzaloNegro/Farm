<title>Don Juan S.R.L detalles</title>
<?php #Llammo a cabecera, incluye el archivo cabecera.php desde template
include('../Template/Cabecera.php');
include('../Modelo/Conexion.php');
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
    <?php
        if (!isset($_POST['buscar'])){$_POST['buscar'] = '';}
        if (!isset($_POST["orden"])){$_POST["orden"] = '';}
        if (!isset($_POST['parcela'])){$_POST['parcela'] = '';}
        if (!isset($_POST['tipoproyecto'])){$_POST['tipoproyecto'] = '';}
        if (!isset($_POST['estadoproyecto'])){$_POST['estadoproyecto'] = '';}
    ?>
<script type="text/javascript">
function mod(){
    swal.fire(  {title: "Proyecto modificado correctamente",
            icon: "success",
            showConfirmButton: true,
            showCancelButton: false,
            })
}	
</script>
<body>
	<div class="centrado">
		<div class="centrado--titulo">
			<h1>Todos los proyectos</h1>
		</div>

	
		<form method="POST" action="./todosLosProyectos.php" >
            <div class="filtros">
                <div class="filtros-listado">
                    <div>
                        <label class="form-label">Proyecto</label>
                        <input type="text" name="buscar"  placeholder="Buscar">
                    </div>
                    <div>
                        <label class="form-label">Orden</label>
                        <select id="assigned-tutor-filter" id="orden" name="orden">
                            <?php if ($_POST["orden"] != ''){ ?>
                                <option value="<?php echo $_POST["orden"]; ?>">
                                    <?php 
                            if ($_POST["orden"] == '1'){echo 'Ordenar por proyecto';} 
                            if ($_POST["orden"] == '2'){echo 'Ordenar por parcela';} 
                            if ($_POST["orden"] == '3'){echo 'Ordenar por tipo';}
                            if ($_POST["orden"] == '4'){echo 'Ordenar por estado';} 
                            ?>
                            </option>
                            <?php } ?>
                            <option value="">Sin orden</option>
                            <option value="1">Ordenar por proyecto</option>
                            <option value="2">Ordenar por parcela</option>
                            <option value="3">Ordenar por tipo</option>
                            <option value="4">Ordenar por estado</option>
                        </select>
                    </div>
					<div>
                        <label class="form-label">Parcela</label>
                        <select id="subject-filter" id="parcela" name="parcela">
                            <option value="">Todos</option>
                            <?php 
                            $consulta= "SELECT * FROM parcela ORDER BY id_Parcela ASC";
                            $ejecutar= mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
                            ?>
                            <?php foreach ($ejecutar as $opciones): ?> 
                                <option value="<?php echo $opciones['id_Parcela']?>"><?php echo $opciones['id_Parcela']?></option>
                                <?php endforeach ?>
                        </select>
                    </div>
                </div>
                    
                <div class="filtros-listado">

                    <div>
                        <label class="form-label">Tipo de Proyecto</label>
                        <select id="subject-filter" id="tipoproyecto" name="tipoproyecto">
                            <option value="">Todos</option>
                            <?php 
                            $consulta= "SELECT * FROM tipoproyecto ORDER BY tipoProyecto ASC";
                            $ejecutar= mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
                            ?>
                            <?php foreach ($ejecutar as $opciones): ?> 
                                <option value="<?php echo $opciones['id_tipoProyecto']?>"><?php echo $opciones['tipoProyecto']?></option>
                                <?php endforeach ?>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Estado</label>
                        <select id="subject-filter" id="estadoproyecto" name="estadoproyecto">
                            <option value="">Todos</option>
                            <?php 
                            $consulta= "SELECT * FROM estadoproyecto ORDER BY estado ASC";
                            $ejecutar= mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
                            ?>
                            <?php foreach ($ejecutar as $opciones): ?> 
                                <option value="<?php echo $opciones['id_EstadoProyecto']?>"><?php echo $opciones['estado']?></option>
                                <?php endforeach ?>
                        </select>
                    </div>
                    <div class="export">
						<input type="submit" class="btn btn-success" name="busqueda" value="Buscar">
						<button type="submit" form="formuFil" style="border:none; background-color:transparent;"><i class="fa-solid fa-file-excel fa-2x" style="color: #1f5120;"></i>CSV Filtrado</button>
						<button type="submit" form="formu" style="border:none; background-color:transparent;"><i class="fa-solid fa-file-excel fa-2x" style="color: #1f5120;"></i>CSV completo</button>
                    </div>
                </div>
            </div>

        <?php 

        if ($_POST['buscar'] == ''){ $_POST['buscar'] = ' ';}
        $aKeyword = explode(" ", $_POST['buscar']);

        if ($_POST["buscar"] == '' AND $_POST['id_Parcela'] == '' AND $_POST['id_tipoProyecto'] == '' AND $_POST['id_EstadoProyecto'] == ''){ 
                $query ="SELECT pr.id_Proyecto, pr.nombreProyecto, p.id_Parcela, tp.tipoProyecto, pr.cantidadHas, ep.estado
				FROM proyectos pr
                INNER JOIN parcela p ON p.id_Parcela = pr.id_Parcela
				INNER JOIN tipoProyecto tp ON pr.id_tipoProyecto = tp.id_tipoProyecto
				INNER JOIN estadoProyecto ep ON pr.id_EstadoProyecto = ep.id_EstadoProyecto
				ORDER BY pr.id_Proyecto ";
        }else{

                $query = "SELECT pr.id_Proyecto, pr.nombreProyecto, p.id_Parcela, tp.tipoProyecto, pr.cantidadHas, ep.estado
				FROM proyectos pr
                INNER JOIN parcela p ON p.id_Parcela = pr.id_Parcela
				INNER JOIN tipoProyecto tp ON pr.id_tipoProyecto = tp.id_tipoProyecto
				INNER JOIN estadoProyecto ep ON pr.id_EstadoProyecto = ep.id_EstadoProyecto ";

                if ($_POST["buscar"] != '' ){ 
                        $query .= " WHERE (pr.nombreProyecto LIKE LOWER('%".$aKeyword[0]."%')) ";
                
                    for($i = 1; $i < count($aKeyword); $i++) {
                    if(!empty($aKeyword[$i])) {
                        $query .= " OR pr.nombreProyecto LIKE '%" . $aKeyword[$i] . "%' ";
                    }
                    }

                }

		if ($_POST["parcela"] != '' ){
			$query .= " AND pr.id_Parcela = '".$_POST["parcela"]."' ";
		}
		if ($_POST["tipoproyecto"] != '' ){
			$query .= " AND pr.id_tipoProyecto = '".$_POST["tipoproyecto"]."' ";
		}
		if ($_POST["estadoproyecto"] != '' ){
			$query .= " AND pr.id_EstadoProyecto = '".$_POST["estadoproyecto"]."' ";
		}


         if ($_POST["orden"] == '' ){
                $query .= " ORDER BY pr.id_Proyecto DESC ";
        }
         if ($_POST["orden"] == '1' ){
                    $query .= " ORDER BY pr.nombreProyecto ASC ";
         }

         if ($_POST["orden"] == '2' ){
                $query .= "  ORDER BY p.id_Parcela ASC ";
         }

         if ($_POST["orden"] == '3' ){
            $query .= "  ORDER BY tp.tipoProyecto DESC ";
     	}
		
		 if ($_POST["orden"] == '4' ){
            $query .= "  ORDER BY ep.estado DESC ";
     	}

}

/*         $consulta=mysqli_query($conexion, $query); */
         $sql = $conexion->query($query);

         $numeroSql = mysqli_num_rows($sql);

        ?>
        <div class="contResult">
            <p style="font-weight: bold; color:blue; margin-bottom: 0px;"><i class="mdi mdi-file-document"></i> <?php echo $numeroSql; ?> Resultados encontrados</p>
        </div>
</form>
<?php if(isset($_GET['mod'])){ ?> <script>mod();</script><?php }?>

        <div>
			<table style="border:none; width:1200px;box-shadow: 5px 5px 5px 5px rgba(165, 164, 164, 0.3);border-radius: 5px;background-color: whitesmoke;">
				<thead>
					<tr style="color:green; background-color:white;font-weight:bold;border-bottom: 2px solid green;">
						<th style="text-align:center;font-size:16pt;text-align:left;padding:5px;">Nombre proyecto</th>
						<th style="text-align:center;font-size:16pt;text-align:left;padding:5px;">Parcela</th>
						<th style="text-align:center;font-size:16pt;text-align:left;padding:5px;">Tipo</th>
						<th style="text-align:center;font-size:16pt;text-align:right;padding:5px;">Cantidad Has</th>
						<th style="text-align:center;font-size:16pt;text-align:left;padding:5px;">Estado</th>
						<th style="text-align:center;font-size:16pt;text-align:center;padding:5px;">Detalles</th>
					</tr>
				</thead>
                <tbody>
                <?php While($rowSql = $sql->fetch_assoc()) {?>
                        <tr>
							<td><h4 style="font-size:14px; text-align:left; margin-left: 5px;"><?php echo $rowSql["nombreProyecto"]; ?></h4></td>
							<td><h4 style="font-size:14px; text-align: left; margin-left: 5px;"><?php echo "Parcela: N°".$rowSql["id_Parcela"]; ?></h4></td>
							<td><h4 style="font-size:14px; text-align:left; margin-left: 5px;"><?php echo $rowSql["tipoProyecto"]; ?></h4></td>
							<td><h4 style="font-size:14px; text-align:right; margin-right: 5px;"><?php echo $rowSql["cantidadHas"]." Has"; ?></h4></td>
							<td><h4 style="font-size:14px; text-align:left; margin-left: 5px;"><?php echo $rowSql["estado"]; ?></h4></td>
							<?php echo "
							<td class='text-center text-nowrap'><a class='btn btn-sm' href=./detalleProyecto.php?no=".$rowSql['id_Proyecto']." class=mod><svg xmlns='http://www.w3.org/2000/svg' height='1.5em' viewBox='0 0 576 512'><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d='M352 224H305.5c-45 0-81.5 36.5-81.5 81.5c0 22.3 10.3 34.3 19.2 40.5c6.8 4.7 12.8 12 12.8 20.3c0 9.8-8 17.8-17.8 17.8h-2.5c-2.4 0-4.8-.4-7.1-1.4C210.8 374.8 128 333.4 128 240c0-79.5 64.5-144 144-144h80V34.7C352 15.5 367.5 0 386.7 0c8.6 0 16.8 3.2 23.2 8.9L548.1 133.3c7.6 6.8 11.9 16.5 11.9 26.7s-4.3 19.9-11.9 26.7l-139 125.1c-5.9 5.3-13.5 8.2-21.4 8.2H384c-17.7 0-32-14.3-32-32V224zM80 96c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16H400c8.8 0 16-7.2 16-16V384c0-17.7 14.3-32 32-32s32 14.3 32 32v48c0 44.2-35.8 80-80 80H80c-44.2 0-80-35.8-80-80V112C0 67.8 35.8 32 80 32h48c17.7 0 32 14.3 32 32s-14.3 32-32 32H80z'/></svg></a></td>
							";?>
                        </tr>
               
               <?php }  
			   if($_POST['buscar'] != "" AND $_POST['buscar'] != " "  OR $_POST['parcela'] != "" OR $_POST['tipoproyecto'] != "" OR $_POST['estadoproyecto'] != ""){
            echo "
            <div class=filtrado>
            <h2>Filtrado por:</h2>
                <ul>";
                    if($_POST['buscar'] != "" AND $_POST['buscar'] != " "){
                        echo "<li><u>Proyecto</u>: ".$_POST['buscar']."</li>";
                    }
                    if($_POST['parcela'] != ""){
                        $sql = "SELECT id_Parcela FROM parcela WHERE id_Parcela = $_POST[parcela]";
                        $resultado = $conexion->query($sql);
                        $row = $resultado->fetch_assoc();
                        $parcela = $row['id_Parcela'];
                        echo "<li><u>Parcela</u>: ".$parcela."</li>";
                    }
                    if($_POST['tipoproyecto'] != ""){
                        $sql = "SELECT tipoProyecto FROM tipoproyecto WHERE id_tipoProyecto = $_POST[tipoproyecto]";
                        $resultado = $conexion->query($sql);
                        $row = $resultado->fetch_assoc();
                        $tipoproyecto = $row['tipoProyecto'];
                        echo "<li><u>Tipo de Proyecto</u>: ".$tipoproyecto."</li>";
                    }
                    if($_POST['estadoproyecto'] != ""){
                        $sql = "SELECT estado FROM estadoproyecto WHERE id_EstadoProyecto = $_POST[estadoproyecto]";
                        $resultado = $conexion->query($sql);
                        $row = $resultado->fetch_assoc();
                        $estadoproyecto = $row['estado'];
                        echo "<li><u>ESTADO</u>: ".$estadoproyecto."</li>";
                    }
                    echo"
                </ul>
            </div>
            ";
                }
        echo '</table>';
        ?>
        </div>
        <form id="formuFil" action="../Exportar/ExcelProyectosFiltrado.php" class="formOculto" method="POST">
            <input type="text" name="sql" class="oculto" readonly="readonly" value="<?php echo $query;?>">
        </form>
		<form id="formu" class="formOculto" action="../Exportar/ExcelProyectos.php" method="POST">
			<?php $consulta = "SELECT pr.id_Proyecto, pr.nombreProyecto, pr.id_Parcela, tp.tipoProyecto, pr.cantidadHas, ep.estado FROM proyectos pr INNER JOIN tipoProyecto tp ON pr.id_tipoProyecto = tp.id_tipoProyecto INNER JOIN estadoProyecto ep ON pr.id_EstadoProyecto = ep.id_EstadoProyecto";?>
			<input type="text" name="sql" class="oculto" readonly="readonly" value="<?php echo $consulta;?>">
		</form>
	
	</div>
</body>