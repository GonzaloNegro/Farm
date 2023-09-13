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
                title: "¿Está seguro de modificar su contraseña?",
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
        swal.fire(  {title: "La contraseña actual ingresada es incorrecta",
                icon: "error",
                showConfirmButton: true,
                showCancelButton: false,
                });
    }	
</script>
<script type="text/javascript">
    function mod(){
        swal.fire(  {title: "Contraseña modificada correctamente!",
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
                <div>
                    <h4>-Usuario N°:</h4>
                </div>
                <div>
                    <input type="text" name="id" class="readonly" value="<?php echo $idUsu;?>" readonly>
                </div>
            </div>
            
            <div class="labelInput">
                <div>
                    <h4>-Nombre usuario:</h4>
                </div>
                <div>
                    <p><?php echo $usuario;?></p>
                </div>
            </div>

            <div class="labelInput">
                <div>
                    <h4>-Nombre:</h4>
                </div>
                <div>
                    <p><?php echo $nombre;?></p>
                </div>
            </div>

            <div class="labelInput">
                <div>
                    <h4>-Apellido:</h4>
                </div>
                <div>
                    <p><?php echo $apellido;?></p>
                </div>
            </div>

            <div class="labelInput">
                <div>
                    <h4>-Contraseña actual:</h4>
                </div>
                <div>
                    <input type="password" name="passActual" id="prov" required>
                </div>
            </div>

            <div class="labelInput">
                <div>
                    <h4>-Contraseña nueva:</h4>
                </div>
                <div>
                    <input type="password" name="passNueva" id="prov" required>
                </div>
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