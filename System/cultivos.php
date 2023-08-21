<title>Don Juan S.R.L detalles</title>
<?php #Llammo a cabecera, incluye el archivo cabecera.php desde template
include('../Template/Cabecera.php');
include('../Modelo/Conexion.php');
error_reporting(0);
?>

<script type="text/javascript">
    function ok(){
        swal.fire(  {title: "Datos cargados correctamente!",
                icon: "success",
                showConfirmButton: true,
                showCancelButton: false,
                });
    }	
</script>
<script type="text/javascript">
    function error(){
        swal.fire(  {title: "El cultivo ya se encuentra registrado!",
                icon: "error",
                showConfirmButton: true,
                showCancelButton: false,
                });
    }	
</script>
<script type="text/javascript">
    function mod(){
        swal.fire(  {title: "Datos modificados correctamente!",
                icon: "success",
                showConfirmButton: true,
                showCancelButton: false,
                });
    }	
</script>

<center>
	<div class="">
		<h1>Cultivos</h1>		
	</div>
    <div>
        <a href="./altaCultivo.php">
            <button class="btn btn-success">Agregar Cultivo</button>
        </a>
    </div>
    <br/>
</center>
<center>
<table style="border:none; width:1200px;box-shadow: 5px 5px 5px 5px rgba(165, 164, 164, 0.3);border-radius: 5px;background-color: whitesmoke;">
		<thead>
		<tr style="color:green; background-color:white;font-weight:bold;border-bottom: 2px solid green;">
			<th style="text-align:center;font-size:16pt;text-align:left;padding:5px;">Cultivo</th>
			<th style="text-align:center;font-size:16pt;text-align:right;padding:5px;">Kg semillas/Has</th>
			<th style="text-align:center;font-size:16pt;text-align:right;padding:5px;">Rinde esperado/Has</th>
			<th style="text-align:center;font-size:16pt;text-align:center;padding:5px;">Modificar</th>
		</tr>
		</thead>
	   <?php
$consulta=mysqli_query($conexion, "SELECT * FROM cultivos ORDER BY nombreCultivo ASC");
while($listar = mysqli_fetch_array($consulta))
{
	echo "
	<tr>

		<td style=text-align:left;padding:5px;>$listar[nombreCultivo]</td>
		<td style=text-align:right;padding:5px;>$listar[kgSemillaHas]</td>
		<td style=text-align:right;padding:5px;>$listar[rindeEsperadoHas]</td>
		<td class='text-center text-nowrap'><a class='btn btn-sm' href=./detalleCultivo.php?no=".$listar['id_Cultivo']." class=mod><svg xmlns='http://www.w3.org/2000/svg' height='1.5em' viewBox='0 0 576 512'><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d='M352 224H305.5c-45 0-81.5 36.5-81.5 81.5c0 22.3 10.3 34.3 19.2 40.5c6.8 4.7 12.8 12 12.8 20.3c0 9.8-8 17.8-17.8 17.8h-2.5c-2.4 0-4.8-.4-7.1-1.4C210.8 374.8 128 333.4 128 240c0-79.5 64.5-144 144-144h80V34.7C352 15.5 367.5 0 386.7 0c8.6 0 16.8 3.2 23.2 8.9L548.1 133.3c7.6 6.8 11.9 16.5 11.9 26.7s-4.3 19.9-11.9 26.7l-139 125.1c-5.9 5.3-13.5 8.2-21.4 8.2H384c-17.7 0-32-14.3-32-32V224zM80 96c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16H400c8.8 0 16-7.2 16-16V384c0-17.7 14.3-32 32-32s32 14.3 32 32v48c0 44.2-35.8 80-80 80H80c-44.2 0-80-35.8-80-80V112C0 67.8 35.8 32 80 32h48c17.7 0 32 14.3 32 32s-14.3 32-32 32H80z'/></svg></a></td>
	</tr>";
} ?>
<?php if(isset($_GET['ok'])){ ?> <script>ok();</script><?php }?>
<?php if(isset($_GET['error'])){ ?> <script>error();</script><?php }?>
<?php if(isset($_GET['mod'])){ ?> <script>mod();</script><?php }?>

<?php
$conexion->close();
?>
</body>