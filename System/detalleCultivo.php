<?php
include('../Template/Cabecera.php');
include('../Modelo/Conexion.php');
error_reporting(0);

$consulta = Consultar($_GET['no']);

function Consultar($no_id)
{	
    include('../Modelo/Conexion.php');
	$sentencia =  "SELECT * FROM cultivos WHERE id_Cultivo='".$no_id."'";
	$resultado = mysqli_query($conexion, $sentencia);
	$filas = mysqli_fetch_assoc($resultado);
	return [
		$filas['id_Cultivo'],/*0*/
		$filas['nombreCultivo'],/* 1 */
		$filas['kgSemillaHas'],/* 2 */
		$filas['rindeEsperadoHas'],/* 3 */
	];
}
$id = $consulta[0];
?>

<script>
$(document).ready(function() {
    $('#btnform').click(function() {
        Swal.fire({
                title: "¿Está seguro de modificar los datos del cultivo?",
                type: "warning",
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonColor: '#2CB073',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: "Cancelar",
                customClass:{
                    actions: 'sweet--btn'
                }
            })
            .then((result) => {
                if (result.isConfirmed) {
                    $("#form_mod").submit()
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })
        }
    )
})
</script>

<div class="centrado">
    <div class="centrado-vlv">
        <a href="./usuarios.php"><button class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>&nbsp Atrás</button></a>
    </div>
    <div class="centrado--titulo">
        <h1>Modificar cultivo</h1>	
    </div>
    <div class="centrado--form">
        <form class="centrado--form--form" name="form_mod" id="form_mod" action="./modCultivo.php" method="POST">
			<div class="labelInput">
				<label for="id">Cultivo N°:</label>
                <input type="text" name="id" id="id" class="readonly" value="<?php echo $id; ?>" readonly>
            </div>
            <div class="labelInput">
                <label for="name">Cultivo:</label>
                <input type="text" name="cultivo" id="prov" value="<?php echo $consulta[1]; ?>"  required>
            </div>
            <div class="labelInput">
                <label for="name">Kg semillas/Has:</label>
                <input type="number" min="0" name="semillas" id="prov" value="<?php echo $consulta[2]; ?>" required>
            </div>
            <div class="labelInput">
                <label for="name">Rinde esperado/Has:</label>
                <input type="number" min="0" name="rinde" id="prov" value="<?php echo $consulta[3]; ?>"  required>
            </div>
            <div class="labelInputbtn" style="gap:5px;">
                <button type="reset" class="btn btn-danger">Cancelar</button>
                <button type="button" id="btnform" class="btn btn-success">Modificar</button>
            </div>
        </form>
    </div>
</div>

</body>