<?php
include('../Template/Cabecera.php');
include('../Modelo/Conexion.php');
error_reporting(0);

$consulta = Consultar($_GET['no']);

function Consultar($no_id)
{	
    include('../Modelo/Conexion.php');
	$sentencia =  "SELECT * FROM usuarios WHERE id_usuario='".$no_id."'";
	$resultado = mysqli_query($conexion, $sentencia);
	$filas = mysqli_fetch_assoc($resultado);
	return [
		$filas['id_usuario'],/*0*/
		$filas['usuario'],/* 1 */
		$filas['password'],/* 2 */
		$filas['nombre'],/* 3 */
		$filas['apellido'],/* 4 */
		$filas['id_tipoUsuario'],
		$filas['id_EstadoUsuario'],
	];
}
$id = $consulta[0];
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
        <a href="./usuarios.php"><button class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>&nbsp Atrás</button></a>
    </div>
    <div class="centrado--titulo">
        <h1>Modificar usuario</h1>	
    </div>
    <div class="centrado--form">
		<?php
            $sent= "SELECT tipo FROM tipo_usuario WHERE id_tipoUsuario = $consulta[5]";
            $resultado = $conexion->query($sent);
            $row = $resultado->fetch_assoc();
            $tipo = $row['tipo'];

			$sent= "SELECT estadoUsuario FROM estadousuario WHERE id_EstadoUsuario = $consulta[6]";
            $resultado = $conexion->query($sent);
            $row = $resultado->fetch_assoc();
            $estado = $row['estadoUsuario'];

		?>
        <form class="centrado--form--form" name="form_mod" id="form_mod" action="./modUsuario.php" method="POST">
			<div class="labelInput">
				<label for="id">Usuario N°:</label>
                <input type="text" name="id" id="id" class="readonly" value="<?php echo $id; ?>" readonly>
            </div>
            <div class="labelInput">
                <label for="name">Usuario:</label>
                <input type="text" name="usuario" id="prov" value="<?php echo $consulta[1]; ?>"  required>
            </div>
            <div class="labelInput">
                <label for="name">Nombre:</label>
                <input type="text" name="nombre" id="prov" value="<?php echo $consulta[3]; ?>" required>
            </div>
            <div class="labelInput">
                <label for="name">Apellido:</label>
                <input type="text" name="apellido" id="prov" value="<?php echo $consulta[4]; ?>"  required>
            </div>
            <div class="labelInput">
                <label for="name">Contraseña:</label>
                <input type="text" name="pass" id="prov" value="<?php echo $consulta[2]; ?>"  required>
            </div>
            <div class="labelInput">
                <label>Tipo:</label>
                <select name="tipo"  required>
					<option selected value="100"><?php echo $tipo?></option>
                    <?php
                    $consulta= "SELECT * FROM tipo_usuario ORDER BY tipo";
                    $ejecutar= mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
                    ?>
                    <?php foreach ($ejecutar as $opciones): ?> 
                    <option value="<?php echo $opciones['id_tipoUsuario']?>"><?php echo $opciones['tipo']?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="labelInput">
                <label>Estado:</label>
                <select name="estado"  required>
					<option selected value="200"><?php echo $estado?></option>
                    <?php
                    $consulta= "SELECT * FROM estadousuario ORDER BY estadoUsuario";
                    $ejecutar= mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
                    ?>
                    <?php foreach ($ejecutar as $opciones): ?> 
                    <option value="<?php echo $opciones['id_EstadoUsuario']?>"><?php echo $opciones['estadoUsuario']?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="labelInputbtn" style="gap:5px;">
                <button type="reset" class="btn btn-danger">Cancelar</button>
                <button type="button" id="btnform" class="btn btn-success">Modificar</button>
            </div>
        </form>
    </div>
</div>

</body>