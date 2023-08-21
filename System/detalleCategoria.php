<?php
include('../Template/Cabecera.php');
include('../Modelo/Conexion.php');
error_reporting(0);

$consulta = Consultar($_GET['no']);

function Consultar($no_id)
{	
    include('../Modelo/Conexion.php');
	$sentencia =  "SELECT * FROM categoria WHERE id_Categoria='".$no_id."'";
	$resultado = mysqli_query($conexion, $sentencia);
	$filas = mysqli_fetch_assoc($resultado);
	return [
		$filas['id_Categoria'],/*0*/
		$filas['nombreCategoria'],
	];
}
$id = $consulta[0];
$cat = $consulta[1];

?>

<script>
$(document).ready(function() {
    $('#btnform').click(function() {
        Swal.fire({
                title: "¿Está seguro de modificar los datos del usuario?",
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
        <a href="./categorias.php"><button class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>&nbsp Atrás</button></a>
    </div>
    <div class="centrado--titulo">
        <h1>Detalle Categoria</h1>
    </div>
    <div class="centrado--form">
        <form action="./modCategoria.php" name="form_mod" id="form_mod" method="POST" class="centrado--form--form">
            <div>
                <label for="id">CATEGORIA N°:</label>
                <input type="text" name="id" id="id" class="readonly" value="<?php echo $id; ?>" readonly>
            </div>
            <div>
                <label for="name">Nombre de Categoria:</label>
                <input type="text" name="cat" id="cat" value="<?php echo $cat;?>" required>
            </div>
            <div class="labelInputbtn" style="gap:5px;">
                <button type="reset" class="btn btn-danger">Cancelar</button>
                <button type="button" id="btnform" class="btn btn-success">Modificar</button>
            </div>
        </form>
    </div>
</div>