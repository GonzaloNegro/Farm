<title>Don Juan S.R.L detalles</title>
<?php #Llammo a cabecera, incluye el archivo cabecera.php desde template
include('../Template/Cabecera.php');
include('../Modelo/Conexion.php');
error_reporting(0);
?>
    <?php
        if (!isset($_POST['buscar'])){$_POST['buscar'] = '';}
        if (!isset($_POST["orden"])){$_POST["orden"] = '';}
        if (!isset($_POST['moneda'])){$_POST['moneda'] = '';}
        if (!isset($_POST['formapago'])){$_POST['formapago'] = '';}
        if (!isset($_POST['tipo'])){$_POST['tipo'] = '';}
        if (!isset($_POST['buscafechadesde'])){$_POST['buscafechadesde'] = '';}
        if (!isset($_POST['buscafechahasta'])){$_POST['buscafechahasta'] = '';}
    ?>
<script type="text/javascript">
function pdf(){
    swal.fire(  {title: "Pdf cargado correctamente",
            icon: "success",
            showConfirmButton: true,
            showCancelButton: false,
            })
}	
</script>
<script type="text/javascript">
function ok(){
    swal.fire(  {title: "Compra cargada correctamente",
            icon: "success",
            showConfirmButton: true,
            showCancelButton: false,
            })
}	
</script>
<body>
	<div class="centrado">
		<div class="centrado--titulo">
			<h1>Todas las compras</h1>
		</div>

	
		<form method="POST" action="./verCompras.php" >
            <div class="filtros">
                <div class="filtros-listado">
                    <div>
                        <label class="form-label">Proveedor</label>
                        <input type="text" style="" name="buscar"  placeholder="Buscar">
                    </div>
                    <div>
                        <label class="form-label">Orden</label>
                        <select id="assigned-tutor-filter" id="orden" name="orden">
                            <?php if ($_POST["orden"] != ''){ ?>
                                <option value="<?php echo $_POST["orden"]; ?>">
                                    <?php 
                            if ($_POST["orden"] == '1'){echo 'Ordenar por proveedor';} 
                            if ($_POST["orden"] == '2'){echo 'Ordenar por fecha';} 
                            if ($_POST["orden"] == '3'){echo 'Ordenar por total';}
                            if ($_POST["orden"] == '4'){echo 'Ordenar por forma de pago';} 
                            ?>
                            </option>
                            <?php } ?>
                            <option value="">Sin orden</option>
                            <option value="1">Ordenar por proveedor</option>
                            <option value="2">Ordenar por fecha</option>
                            <option value="3">Ordenar por total</option>
                            <option value="4">Ordenar por forma de pago</option>
                        </select>
                    </div>
                    <div>
                        <div class="fechas">
                            <label class="form-label">Período</label>
                            <div>
                                <input type="date" id="buscafechadesde" name="buscafechadesde" class="form-control largo" >
                            </div>
                            <div>
                                <input type="date" id="buscafechahasta" name="buscafechahasta" class="form-control largo" >
                            </div>
                        </div>
                    </div>
                </div>
                    
                <div class="filtros-listado">

                    <div>
                        <label class="form-label">Moneda</label>
                        <select id="subject-filter" id="moneda" name="moneda">
                            <option value="">Todos</option>
                            <?php 
                            $consulta= "SELECT * FROM moneda ORDER BY moneda ASC";
                            $ejecutar= mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
                            ?>
                            <?php foreach ($ejecutar as $opciones): ?> 
                                <option value="<?php echo $opciones['id_Moneda']?>"><?php echo $opciones['moneda']?></option>
                                <?php endforeach ?>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Tipo</label>
                        <select id="subject-filter" id="tipo" name="tipo">
                            <option value="">Todos</option>
                            <?php 
                            $consulta= "SELECT * FROM tipocompra ORDER BY tipoCompra ASC";
                            $ejecutar= mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
                            ?>
                            <?php foreach ($ejecutar as $opciones): ?> 
                                <option value="<?php echo $opciones['id_TipoCompra']?>"><?php echo $opciones['tipoCompra']?></option>
                                <?php endforeach ?>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Forma de Pago</label>
                        <select id="subject-filter" id="formapago" name="formapago">
                            <option value="">Todos</option>
                            <?php 
                            $consulta= "SELECT * FROM formapago ORDER BY formaPago ASC";
                            $ejecutar= mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
                            ?>
                            <?php foreach ($ejecutar as $opciones): ?> 
                                <option value="<?php echo $opciones['id_Forma']?>"><?php echo $opciones['formaPago']?></option>
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

        if ($_POST["buscar"] == '' AND $_POST['id_Forma'] == '' AND $_POST['id_Moneda'] == '' AND $_POST['buscafechadesde'] == '' AND $_POST['buscafechahasta'] == ''){ 
                $query ="SELECT c.fecha, c.nroFactura, p.proveedor, m.moneda, c.importeNeto, c.IVA, c.importeTotal, c.id_Compras, f.formaPago, t.tipoCompra
                FROM compras c
                LEFT JOIN proveedores p ON p.id_Proveedor = c.id_Proveedor
                LEFT JOIN moneda m ON m.id_Moneda = c.id_Moneda
                LEFT JOIN compraproyecto co ON co.id_Compras = c.id_Compras
                LEFT JOIN tipocompra t ON t.id_TipoCompra = co.id_TipoCompra
                LEFT JOIN formapago f ON f.id_Forma = c.id_Forma ";
        }else{

                $query = "SELECT c.fecha, c.nroFactura, p.proveedor, m.moneda, c.importeNeto, c.IVA, c.importeTotal, c.id_Compras, f.formaPago, t.tipoCompra
                FROM compras c
                LEFT JOIN proveedores p ON p.id_Proveedor = c.id_Proveedor
                LEFT JOIN moneda m ON m.id_Moneda = c.id_Moneda
                LEFT JOIN compraproyecto co ON co.id_Compras = c.id_Compras
                LEFT JOIN tipocompra t ON t.id_TipoCompra = co.id_TipoCompra
                LEFT JOIN formapago f ON f.id_Forma = c.id_Forma ";

                if ($_POST["buscar"] != '' ){ 
                        $query .= " WHERE (p.proveedor LIKE LOWER('%".$aKeyword[0]."%')) ";
                
                    for($i = 1; $i < count($aKeyword); $i++) {
                    if(!empty($aKeyword[$i])) {
                        $query .= " OR p.proveedor LIKE '%" . $aKeyword[$i] . "%' ";
                    }
                    }

                }

		if ($_POST["moneda"] != '' ){
			$query .= " AND c.id_Moneda = '".$_POST["moneda"]."' ";
		}
		if ($_POST["formapago"] != '' ){
			$query .= " AND c.id_Forma = '".$_POST["formapago"]."' ";
		}
        if ($_POST["tipo"] != '' ){
			$query .= " AND co.id_TipoCompra = '".$_POST["tipo"]."' ";
		}
        if ($_POST["buscafechadesde"] != '' ){
            $query .= " AND c.fecha BETWEEN '".$_POST["buscafechadesde"]."' AND '".$_POST["buscafechahasta"]."' ";
        }


         if ($_POST["orden"] == '' ){
                $query .= " ORDER BY p.proveedor DESC, c.fecha DESC ";
        }
         if ($_POST["orden"] == '1' ){
                    $query .= " ORDER BY p.proveedor ASC, c.fecha DESC ";
         }

         if ($_POST["orden"] == '2' ){
                $query .= "  ORDER BY c.fecha DESC ";
         }

         if ($_POST["orden"] == '3' ){
            $query .= "  ORDER BY c.importeTotal DESC, c.fecha DESC ";
     	}
		
		 if ($_POST["orden"] == '4' ){
            $query .= "  ORDER BY f.formaPago ASC, c.fecha DESC ";
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
<?php if(isset($_GET['pdf'])){ ?> <script>pdf();</script><?php }?>
<?php if(isset($_GET['ok'])){ ?> <script>ok();</script><?php }?>

        <div>
			<table style="border:none; width:1200px;box-shadow: 5px 5px 5px 5px rgba(165, 164, 164, 0.3);border-radius: 5px;background-color: whitesmoke;">
				<thead>
					<tr style="color:green; background-color:white;font-weight:bold;border-bottom: 2px solid green;">
						<th style="text-align:center;font-size:16pt;text-align:left;padding:5px;">Fechas</th>
						<th style="text-align:center;font-size:16pt;text-align:left;padding:5px;">N°Factura</th>
						<th style="text-align:center;font-size:16pt;text-align:left;padding:5px;">Proveedor</th>
						<th style="text-align:center;font-size:16pt;text-align:left;padding:5px;">Tipo</th>
						<th style="text-align:center;font-size:16pt;text-align:right;padding:5px;">Moneda</th>
						<th style="text-align:right;font-size:16pt;padding:5px;">Importe Neto</th>
						<th style="text-align:center;font-size:16pt;text-align:right;padding:5px;">IVA</th>
						<th style="text-align:center;font-size:16pt;text-align:tight;padding:5px;">Total</th>
						<th style="text-align:center;font-size:16pt;text-align:left;padding:5px;">Forma de Pago</th>
						<th style="text-align:center;font-size:16pt;text-align:center;padding:5px;">Detalles</th>
					</tr>
				</thead>
                <tbody>
                <?php While($rowSql = $sql->fetch_assoc()) {?>
                    <?php
                        $fec = date("d-m-Y", strtotime($rowSql['fecha']));
                        $impNeto = number_format($rowSql['importeNeto'], 2, ',','.');
                        $total = number_format($rowSql['importeTotal'], 2, ',','.');
                    ?>
                        <tr>
							<td><h4 style="font-size:14px; text-align:left; margin-left: 5px;"><?php echo $fec; ?></h4></td>
							<td><h4 style="font-size:14px; text-align: right; margin-right: 5px;"><?php echo $rowSql["nroFactura"]; ?></h4></td>
							<td><h4 style="font-size:14px; text-align:left; margin-left: 5px;"><?php echo $rowSql["proveedor"]; ?></h4></td>
                            <td><h4 style="font-size:14px; text-align:left; margin-left: 5px;"><?php echo $rowSql["tipoCompra"]; ?></h4></td>
							<td><h4 style="font-size:14px; text-align:center;"><?php echo $rowSql["moneda"]; ?></h4></td>
							<td><h4 style="font-size:14px; text-align:right; margin-right: 5px;"><?php echo "$".$impNeto; ?></h4></td>
                            <td><h4 style="font-size:14px; text-align:right; margin-right: 5px;"><?php echo "$".$rowSql["IVA"]."%"; ?></h4></td>
                            <td><h4 style="font-size:14px; text-align:right; margin-right: 5px;"><?php echo "$".$total; ?></h4></td>
							<td><h4 style="font-size:14px; text-align:left; margin-left: 5px;"><?php echo $rowSql["formaPago"]; ?></h4></td>
							<?php echo "
                            <td class='text-center text-nowrap'><a class='btn btn-sm' href=./detalleCompra.php?no=".$rowSql['id_Compras']." class=mod><svg xmlns='http://www.w3.org/2000/svg' height='1.5em' viewBox='0 0 576 512'><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d='M352 224H305.5c-45 0-81.5 36.5-81.5 81.5c0 22.3 10.3 34.3 19.2 40.5c6.8 4.7 12.8 12 12.8 20.3c0 9.8-8 17.8-17.8 17.8h-2.5c-2.4 0-4.8-.4-7.1-1.4C210.8 374.8 128 333.4 128 240c0-79.5 64.5-144 144-144h80V34.7C352 15.5 367.5 0 386.7 0c8.6 0 16.8 3.2 23.2 8.9L548.1 133.3c7.6 6.8 11.9 16.5 11.9 26.7s-4.3 19.9-11.9 26.7l-139 125.1c-5.9 5.3-13.5 8.2-21.4 8.2H384c-17.7 0-32-14.3-32-32V224zM80 96c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16H400c8.8 0 16-7.2 16-16V384c0-17.7 14.3-32 32-32s32 14.3 32 32v48c0 44.2-35.8 80-80 80H80c-44.2 0-80-35.8-80-80V112C0 67.8 35.8 32 80 32h48c17.7 0 32 14.3 32 32s-14.3 32-32 32H80z'/></svg></a></td>
							";?>
                        </tr>
               
               <?php }  
			   if($_POST['buscar'] != "" AND $_POST['buscar'] != " " OR $_POST['buscafechadesde'] != "" AND $_POST['buscafechahasta'] != ""  OR $_POST['moneda'] != "" OR $_POST['formapago'] != "" OR $_POST['tipo'] != ""){
            echo "
            <div class=filtrado>
            <h2>Filtrado por:</h2>
                <ul>";
                    if($_POST['buscar'] != "" AND $_POST['buscar'] != " "){
                        echo "<li><u>Proveedor</u>: ".$_POST['buscar']."</li>";
                    }
                    if($_POST['buscafechadesde'] != "" AND $_POST['buscafechahasta'] != ""){
                        echo "<li><u>Período</u>: ".date("d-m-Y", strtotime($_POST['buscafechadesde']))." - ".date("d-m-Y", strtotime($_POST['buscafechahasta']))."</li>";
                    }
                    if($_POST['moneda'] != ""){
                        $sql = "SELECT moneda FROM moneda WHERE id_Moneda = $_POST[moneda]";
                        $resultado = $conexion->query($sql);
                        $row = $resultado->fetch_assoc();
                        $moneda = $row['moneda'];
                        echo "<li><u>Moneda</u>: ".$moneda."</li>";
                    }
                    if($_POST['tipo'] != ""){
                        $sql = "SELECT tipoCompra FROM tipocompra WHERE id_TipoCompra = $_POST[tipo]";
                        $resultado = $conexion->query($sql);
                        $row = $resultado->fetch_assoc();
                        $tipoCompra = $row['tipoCompra'];
                        echo "<li><u>Tipo:</u>: ".$tipoCompra."</li>";
                    }
                    if($_POST['formapago'] != ""){
                        $sql = "SELECT formaPago FROM formapago WHERE id_Forma = $_POST[formapago]";
                        $resultado = $conexion->query($sql);
                        $row = $resultado->fetch_assoc();
                        $formapago = $row['formaPago'];
                        echo "<li><u>Froma de pago</u>: ".$formapago."</li>";
                    }
                    echo"
                </ul>
            </div>
            ";
                }
        echo '</table>';
        ?>
        </div>
        <form id="formuFil" action="../Exportar/ExcelComprasFiltrado.php" class="formOculto" method="POST">
            <input type="text" name="sql" class="oculto" readonly="readonly" value="<?php echo $query;?>">
        </form>
		<form id="formu" class="formOculto" action="../Exportar/ExcelCompras.php" method="POST">
			<?php $consulta = "SELECT c.fecha, c.nroFactura, p.proveedor, t.tipoCompra, m.moneda, c.importeNeto, c.IVA, c.importeTotal, c.id_Compras, f.formaPago, c.tipoFactura, c.tipoCambio, c.puntoDeVenta, c.tipoDocEmisor, c.detalle, c.nroDocEmisor
                FROM compras c
                LEFT JOIN proveedores p ON p.id_Proveedor = c.id_Proveedor
                LEFT JOIN moneda m ON m.id_Moneda = c.id_Moneda
                LEFT JOIN formapago f ON f.id_Forma = c.id_Forma
                LEFT JOIN compraproyecto co ON co.id_Compras = c.id_Compras
                LEFT JOIN tipocompra t ON t.id_TipoCompra = co.id_TipoCompra";?>
			<input type="text" name="sql" class="oculto" readonly="readonly" value="<?php echo $consulta;?>">
		</form>	
	</div>
</body>

