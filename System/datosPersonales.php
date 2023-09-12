<?php
include ("../Modelo/Conexion.php");
include('../Template/Cabecera.php');
error_reporting(0);

if (empty($_SESSION["usuario"])) {
    header("location: ../index.php");
}
$iduser = $_SESSION['usuario'];
$sql = "SELECT * FROM usuarios WHERE usuario='$iduser'";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();
$idUsu = $row['id_usuario'];
?>

<script>
$(document).ready(function() {
    $('#btnform').click(function() {
        Swal.fire({
                title: "¿Está seguro de modificar sus datos de usuario?",
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
<script type="text/javascript">
    function error(){
        swal.fire(  {title: "El usuario ya se encuentra registrado!",
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
<div class="centrado">
    <div class="centrado--titulo">
        <h1>Mis datos</h1>	
    </div>
    <div class="centrado--form">
        <?php
			$sent= "SELECT * FROM usuarios WHERE id_usuario = '$idUsu'";
            $resultado = $conexion->query($sent);
            $row = $resultado->fetch_assoc();
            $usuario = $row['usuario'];
            $password = $row['password'];
            $nombre = $row['nombre'];
            $apellido = $row['apellido'];

        ?>
        <form class="centrado--form--form" name="form_mod" id="form_mod" action="./modDatos.php" method="POST">
			<div class="labelInput">
				<label for="id">Usuario N°:</label>
                <input type="text" name="id" id="id" class="readonly" value="<?php echo $idUsu; ?>" readonly>
            </div>
            <div class="labelInput">
                <label for="name">Usuario:</label>
                <input type="text" name="usuario" id="prov" style="background-color: transparent;border: none;cursor: default;width: 80px;" value="<?php echo $usuario; ?>"  readonly>
            </div>
            <div class="labelInput">
                <label for="name">Nombre:</label>
                <input type="text" name="nombre" id="prov" value="<?php echo $nombre; ?>" required>
            </div>
            <div class="labelInput">
                <label for="name">Apellido:</label>
                <input type="text" name="apellido" id="prov" value="<?php echo $apellido; ?>"  required>
            </div>
            <div class="labelInput">
                <label for="name">Contraseña:</label>
                <input type="password" name="pass" id="prov" value="<?php echo $password; ?>"  required>
            </div>
            <div class="labelInputbtn" style="gap:5px;">
                <button type="reset" class="btn btn-danger">Cancelar</button>
                <button type="button" id="btnform" class="btn btn-success">Modificar</button>
            </div>
        </form>
        <?php if(isset($_GET['error'])){ ?> <script>error();</script><?php }?>
        <?php if(isset($_GET['mod'])){ ?> <script>mod();</script><?php }?>
    </div>
</div>

</body>