<?php
include('../Template/Cabecera.php');
include('../Modelo/Conexion.php');
error_reporting(0);

if (empty($_SESSION["usuario"])) {
    header("location: ../index.php");
}
$iduser = $_SESSION['usuario'];
$sql = "SELECT * FROM usuarios WHERE usuario='$iduser'";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();

$nombre = $row['nombre'];
$apellido = $row['apellido'];
$tipoUsu = $row['id_tipoUsuario'];

$consulta = Consultar($_GET['no']);

function Consultar($no_id)
{	
    include('../Modelo/Conexion.php');
	$sentencia =  "SELECT * FROM compras WHERE id_Compras='".$no_id."'";
	$resultado = mysqli_query($conexion, $sentencia);
	$filas = mysqli_fetch_assoc($resultado);
	return [
		$filas['id_Compras'],/*0*/
		$filas['fecha'],/* 1 */
		$filas['tipoFactura'],/* 2 */
		$filas['puntoDeVenta'],/* 3 */
		$filas['nroFactura'],/* 4 */
		$filas['tipoDocEmisor'],/* 5 */
		$filas['nroDocEmisor'],/* 6 */
		$filas['id_Proveedor'],/* 7 */
		$filas['tipoCambio'],/* 8 */
		$filas['id_Moneda'],/* 9 */
		$filas['importeNeto'],/* 10 */
		$filas['IVA'],/* 11 */
		$filas['importeTotal'],/* 12 */
		$filas['detalle'],/* 13 */
		$filas['id_Forma'],/* 14 */
	];
}
$id = $consulta[0];
?>
<script>
$(document).ready(function() {
    $('#btnform').click(function() {
        Swal.fire({
                title: "¿Está seguro de modificar esta compra?",
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
        <a href="./verCompras.php"><button class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" style="fill:#ffffff;"><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>&nbsp Atrás</button></a>
    </div>
    <div class="centrado--titulo">
        <h1>Detalle compra</h1>	
    </div>
    <form action="" style="margin-bottom:20px;">
    <div class="centrado--form">
    <?php 
    $sent= "SELECT id_TipoCompra, id_Proyecto FROM compraproyecto WHERE id_Compras = $consulta[0]";
    $resultado = $conexion->query($sent);
    $row = $resultado->fetch_assoc();
    $tipoCompra = $row['id_TipoCompra'];
    $proj = $row['id_Proyecto'];
    
    if($tipoCompra == 2){
        $sent= "SELECT nombreProyecto FROM proyectos WHERE id_Proyecto = $proj";
        $resultado = $conexion->query($sent);
        $row = $resultado->fetch_assoc();
        $nombreProyecto = $row['nombreProyecto'];
    ?>
    <div class="centrado--form">
        <div class="labelInput">
            <div>
                <h4>-Compra asignada al proyecto:</h4>
            </div>
            <div>
                <p><?php echo $nombreProyecto;?></p>
            </div>
        </div>
    </div>
    <?php }else{?>
    <div class="centrado--form">
        <div class="labelInput">
            <div>
                <h4>-Tipo de compra:</h4>
            </div>
            <div>
                <p>General</p>
            </div>
        </div>
    </div>
    <?php }?>

        <div class="labelInput">
            <div>
                <h4>-Fecha:</h4>
            </div>
            <div>
                <p><?php         
                $fec = date("d-m-Y", strtotime($consulta[1]));
                echo $fec;?></p>
            </div>
        </div>

        <div class="labelInput">
            <div>
                <h4>-Tipo de Factura:</h4>
            </div>
            <div>
                <p><?php echo $consulta[2];?></p>
            </div>
        </div>

        <div class="labelInput">
            <div>
                <h4>-Punto de Venta:</h4>
            </div>
            <div>
                <p><?php echo $consulta[3];?></p>
            </div>
        </div>

        <div class="labelInput">
            <div>
                <h4>-N° de Factura:</h4>
            </div>
            <div>
                <p><?php echo $consulta[4];?></p>
            </div>
        </div>

        <div class="labelInput">
            <div>
                <h4>-Tipo de Documento del emisor:</h4>
            </div>
            <div>
                <p><?php echo $consulta[5];?></p>
            </div>
        </div>

        <div class="labelInput">
            <div>
                <h4>-N° de Documento del emisor:</h4>
            </div>
            <div>
                <p><?php echo $consulta[6];?></p>
            </div>
        </div>

        <div class="labelInput">
            <div>
                <h4>-Proveedor:</h4>
            </div>
            <div>
                <p><?php 
                $sent= "SELECT proveedor FROM proveedores WHERE id_Proveedor = $consulta[7]";
                $resultado = $conexion->query($sent);
                $row = $resultado->fetch_assoc();
                $prov = $row['proveedor'];
                
                echo $prov;?></p>
            </div>
        </div>

        <div class="labelInput">
            <div>
                <h4>-Tipo de Cambio:</h4>
            </div>
            <div>
                <p><?php 
                    $tipoCambio = number_format($consulta[8], 2, ',','.');
                    echo "$".$tipoCambio;?>
                </p>
            </div>
        </div>

        <div class="labelInput">
            <div>
                <h4>-Moneda:</h4>
            </div>
            <div>
            <p><?php 
                $sent= "SELECT moneda FROM moneda WHERE id_Moneda = $consulta[9]";
                $resultado = $conexion->query($sent);
                $row = $resultado->fetch_assoc();
                $moneda = $row['moneda'];
                
                echo $moneda;?></p>
            </div>
        </div>

        <div class="labelInput">
            <div>
                <h4>-Importe Neto:</h4>
            </div>
            <div>
                <p><?php 
                    $importeNeto = number_format($consulta[10], 2, ',','.');
                    echo "$".$importeNeto;?>
                </p>
            </div>
        </div>

        <div class="labelInput">
            <div>
                <h4>-IVA:</h4>
            </div>
            <div>
                <p><?php echo $consulta[11]."%";?></p>
            </div>
        </div>

        <div class="labelInput">
            <div>
                <h4>-Importe Total:</h4>
            </div>
            <div>
                <p><?php 
                    $importeTotal = number_format($consulta[12], 2, ',','.');
                    echo "$".$importeTotal;?>
                </p>
            </div>
        </div>

        <div class="labelInput">
            <div>
                <h4>-Detalle:</h4>
            </div>
            <div>
                <p><?php echo $consulta[13];?></p>
            </div>
        </div>

        <div class="labelInput">
            <div>
                <h4>-Forma de Pago:</h4>
            </div>
            <div>
            <p><?php 
                $sent= "SELECT formaPago FROM formapago WHERE id_Forma = $consulta[14]";
                $resultado = $conexion->query($sent);
                $row = $resultado->fetch_assoc();
                $formaPago = $row['formaPago'];
                
                echo $formaPago;?></p>
            </div>
        </div>

        <div class="labelInput">
            <div>
                <h4>-Documento:</h4>
            </div>
            <div>
                <p>
                <?php
                    $pdf = "../archivos/compras/".$consulta[4].".pdf";
                    $sent= "SELECT id_archivo FROM archivos WHERE url = '$pdf'";
                    $resultado = $conexion->query($sent);
                    $row = $resultado->fetch_assoc();
                    $url = $row['id_archivo'];

                    if($url == ""){
                        echo "Sin archivo";
                    }else{
                    echo 
                        "
                        <a class='btn btn-sm btn-outline-danger' href=$pdf target=new><svg xmlns='http://www.w3.org/2000/svg' height='1.25em' viewBox='0 0 512 512'><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ae2424}</style><path d='M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V304H176c-35.3 0-64 28.7-64 64V512H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128zM176 352h32c30.9 0 56 25.1 56 56s-25.1 56-56 56H192v32c0 8.8-7.2 16-16 16s-16-7.2-16-16V448 368c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24H192v48h16zm96-80h32c26.5 0 48 21.5 48 48v64c0 26.5-21.5 48-48 48H304c-8.8 0-16-7.2-16-16V368c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H320v96h16zm80-112c0-8.8 7.2-16 16-16h48c8.8 0 16 7.2 16 16s-7.2 16-16 16H448v32h32c8.8 0 16 7.2 16 16s-7.2 16-16 16H448v48c0 8.8-7.2 16-16 16s-16-7.2-16-16V432 368z'/></svg></a>
                        "; 
                    }?>
                </p>
            </div>
        </div>
        </form>
        <?php
        $pdf = "../archivos/compras/".$consulta[4].".pdf";
        $sent= "SELECT id_archivo FROM archivos WHERE url = '$pdf'";
        $resultado = $conexion->query($sent);
        $row = $resultado->fetch_assoc();
        $url = $row['id_archivo'];

        if($url == "" AND $tipoUsu == 1){
        echo"

        <div class='centrado--form--info'>
                <form action='./cargaPdf.php' method='POST' name='form_mod' id='form_mod' class='centrado--form--form' enctype='multipart/form-data'
                style='	box-shadow: none;border-radius: 0px;background-color: transparent;'>
                <div>
                    <input type='number' name='nroFactura' class='oculto' value='$consulta[4]'></input>
                </div>
                <div class='labelInput'>
                        <label for='name'>Subir Archivo:</label>
                        <input type='file' name='fichero' size='150' id='archivo' accept='application/pdf' required>
                    </div>
                    <div class='labelInputbtn' style='gap:5px;'>
                        <button type='reset' class='btn btn-danger'>Cancelar</button>
                        <button type='button' id='btnform' class='btn btn-success'>Agregar</button>
                    </div>
                </form>
            </div>
        </div>
        ";}else if($url != ""){
            echo"

            <div class='centrado--form--info'>
                    <form action='./cargaPdf.php' method='POST' name='form_mod' id='form_mod' class='centrado--form--form' enctype='multipart/form-data'
                    style='	box-shadow: none;border-radius: 0px;background-color: transparent;'>
                    <div>
                        <input type='number' name='nroFactura' class='oculto' value='$consulta[4]'></input>
                    </div>
                    <div class='labelInput'>
                            <label for='name'>Modificar Archivo:</label>
                            <input type='file' name='fichero' size='150' id='archivo' accept='application/pdf' required>
                        </div>
                        <div class='labelInputbtn' style='gap:5px;'>
                            <button type='reset' class='btn btn-danger'>Cancelar</button>
                            <button type='button' id='btnform' class='btn btn-success'>Modificar</button>
                        </div>
                    </form>
                </div>
            </div>
            ";}
        ?>
    </div>
</div>
</body>