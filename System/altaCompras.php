<?php #Llammo a pie 
include('../Template/Cabecera.php');
include('../Modelo/Conexion.php');
error_reporting(0);
?>

<script>
    window.onload = function() {
      var general = document.getElementById('general');
      var nombreProyecto = document.getElementById('nombreProyecto');
      
      general.addEventListener('change', function() {
        if(general.checked == true){
            nombreProyecto.disabled = true;
        }else{
            nombreProyecto.disabled = false;
        }
        /* general.checked = false; */
      });

    }
  </script>
  
  <script>
        var general = document.getElementById('general');
        var proye = document.getElementById('nombreProyecto');

        window.onload = verificar();

        function verificar() {
            if(general.checked){
                proye.required = false;
            }else{
                proye.required = true;
            }
        }
  </script>

<script>
    function alerta(campo) { 
    alert("Por favor, completa el campo "+campo) 
    }
    function validar_formulario(form){
/*         if (form.nombreProyecto.value == "") { 
            alerta('\"Asignar al proyecto\"'); form.nombreProyecto.focus(); return true; 
            } */
        if (form.fecha.value == "") { 
            alerta('\"Fecha\"'); form.fecha.focus(); return true; 
            }
        if (form.cmbTipoFactura.value == "") { 
            alerta('\"Tipo de factura\"'); form.cmbTipoFactura.focus(); return true; 
            }
        if (form.ptoVenta.value == "") { 
            alerta('\"Punto de venta\"'); form.ptoVenta.focus(); return true; 
            }
        if (form.nroFactura.value == "") { 
            alerta('\"Nro de Factra\"'); form.nroFactura.focus(); return true; 
            }
        if (form.cmbTipoDoc.value == "") { 
            alerta('\"Tipo de Documento del emisor\"'); form.cmbTipoDoc.focus(); return true; 
            }
        if (form.dni.value == "") { 
            alerta('\"Nro de Documento del emisor\"'); form.dni.focus(); return true; 
            }
        if (form.cmbMoneda.value == "") { 
            alerta('\"Moneda\"'); form.cmbMoneda.focus(); return true; 
            }
        if (form.tipoCambio.value == "") { 
            alerta('\"Tipo de Cambio\"'); form.tipoCambio.focus(); return true; 
            }
        if (form.impNeto.value == "") { 
            alerta('\"Importe Neto\"'); form.impNeto.focus(); return true; 
            }
        if (form.iva.value == "") { 
            alerta('\"IVA\"'); form.iva.focus(); return true; 
            }
        if (form.detalle.value == "") { 
            alerta('\"Detalle\"'); form.detalle.focus(); return true; 
            }
        if (form.cmbFormaPago.value == "") { 
            alerta('\"Forma de Pago\"'); form.cmbFormaPago.focus(); return true; 
            }
            
            
            
            if(form.fecha.value != "" && form.cmbTipoFactura.value != "" && form.ptoVenta.value != "" && form.nroFactura.value != "" && form.cmbTipoDoc.value != "" && form.dni.value != "" && form.cmbMoneda.value != "" && form.tipoCambio.value != "" && form.impNeto.value != "" && form.iva.value != "" && form.detalle.value != "" && form.cmbFormaPago.value != ""){
                $(document).ready(function() {
                    $('#btnform').click(function() {
                        Swal.fire({
                            title: "¿Está seguro que desea cargar la compra?",
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
/* form.submit() */
            }
        }
</script>

<div class="centrado">
    <div class="centrado--titulo">
    <h1>Cargar compra</h1>
    </div>
    <div class="centrado--form">
        <form action="./cargaCompra.php" name="form_mod" id="form_mod" method="POST" class="centrado--form--form" enctype="multipart/form-data">
            <div class="labelInput">
                <label for="name">Compra General:</label>
                <input type="checkbox" id="general" name="general"/>
            </div>

            <hr style="width:100%;">

            <div class="labelInput">
                <label for="name">Asignar al Proyecto:</label>
                <select id="nombreProyecto" name="nombreProyecto" required>
                    <option value="" selected disabled="nombreProyecto">-Seleccione una-</option>
                    <?php
                    $consulta= "SELECT * FROM proyectos ORDER BY nombreproyecto ASC";
                    $ejecutar= mysqli_query($conexion, $consulta) or die(mysqli_error($datos_base));
                    ?>
                    <?php foreach ($ejecutar as $opciones): ?> 
                    <option value="<?php echo $opciones['id_Proyecto']?>"><?php echo $opciones['nombreProyecto']?></option>
                    <?php endforeach ?>
                </select>  
            </div>
            <div class="labelInput">
                <label for="name">Fecha:</label>
                <input type="date" name="fecha"  id="prov" class="form-control" required>
            </div>
            <div class="labelInput">
                <label for="name">Tipo de factura:</label>
                <select  name="cmbTipoFactura"  required> 
                  <option  value="" disabled selected >-Seleccione una-</option>
                  <option  value="A">A</option>
                  <option value="B" >B</option>
                  <option value="C" >C</option>
                  <option value="Otro" >Otro</option>
                </select>
            </div>
            <div class="labelInput">
                <label for="name">Punto de venta:</label>
                <input type="text" name="ptoVenta" id="prov" required>
            </div>
            <div class="labelInput">
                <label for="name">Nro de Factura:</label>
                <input type="text" name="nroFactura" id="prov" required>
            </div>
            <div class="labelInput">
              <label>Proveedor:</label>
              <select name="prov"  required>
                  <option value="" selected disabled="tipo">-Seleccione una-</option>
                  <?php
                  $consulta= "SELECT * FROM proveedores ORDER BY proveedor ASC";
                  $ejecutar= mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
                  ?>
                  <?php foreach ($ejecutar as $opciones): ?> 
                  <option value="<?php echo $opciones['id_Proveedor']?>"><?php echo $opciones['proveedor']?></option>
                  <?php endforeach ?>
                </select>
            </div>
            <div class="labelInput">
                <label for="name">Tipo de Documento del emisor:</label>
                <select  name="cmbTipoDoc"  required> 
                  <option  value="" disabled selected >-Seleccione una-</option>
                  <option  value="CUIT">CUIT</option>
                  <option value="CUIL" >CUIL</option>
                  <option value="DNI" >DNI</option>
                </select>
            </div>
            <div class="labelInput">
                <label for="name">Nro de Documento del emisor:</label>
                <input type="number" name="dni" min="1" id="prov" required>
            </div>
            <div class="labelInput">
              <label for="name">Moneda:</label>
              <select name="cmbMoneda"  required>
                  <option value="" selected disabled="cmbMoneda">-Seleccione una-</option>
                  <?php
                  $consulta= "SELECT * FROM moneda ORDER BY moneda ASC";
                  $ejecutar= mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
                  ?>
                  <?php foreach ($ejecutar as $opciones): ?> 
                  <option value="<?php echo $opciones['id_Moneda']?>"><?php echo $opciones['moneda']?></option>
                  <?php endforeach ?>
                </select>
            </div>
            <div class="labelInput">
                <label for="name">Tipo de Cambio*:</label>
                <input type="number" name="tipoCambio" min="1" id="prov" step=".01" required>
            </div>
            <div class="labelInput">
                <label for="name">Importe Neto:</label>
                <input type="number" name="impNeto" min="1" id="prov" step=".01" required>
            </div>
            <div class="labelInput">
              <label for="iva">IVA:</label>
              <select name="iva"  required>
                  <option value="" selected disabled="iva">-Seleccione una-</option>
                  <?php
                  $consulta= "SELECT * FROM iva ORDER BY iva ASC";
                  $ejecutar= mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
                  ?>
                  <?php foreach ($ejecutar as $opciones): ?> 
                  <option value="<?php echo $opciones['id_Iva']?>"><?php echo "%".$opciones['iva']?></option>
                  <?php endforeach ?>
                </select>
            </div>
            <div class="labelInput">
              <label for="name">Detalle:</label>
              <textarea name="detalle" id="" cols="30" rows="3" required></textarea>
            </div>
            <div class="labelInput">
              <label>Forma de Pago:</label>
              <select name="cmbFormaPago"  required>
                  <option value="" selected disabled="cmbFormaPago">-Seleccione una-</option>
                  <?php
                  $consulta= "SELECT * FROM formapago ORDER BY formaPago ASC";
                  $ejecutar= mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
                  ?>
                  <?php foreach ($ejecutar as $opciones): ?> 
                  <option value="<?php echo $opciones['id_Forma']?>"><?php echo $opciones['formaPago']?></option>
                  <?php endforeach ?>
                </select>
            </div>
            <div class="labelInput">
                <label for="name">Subir Archivo:</label>
                <input type="file" name="fichero" size="150" id="archivo" accept="application/pdf">
            </div>
            <div class="labelInput" style="width:100%;">
                <a href="https://www.bna.com.ar/Personas" target="_blank" style="width:100%;display: flex;justify-content:center;"><p>*Cotización USD divisa venta Banco Nación</p></a>
            </div>

            <div class="labelInputbtn" style="gap:5px;">
                <button type="reset" class="btn btn-danger">Cancelar</button>
                <button type="button" id="btnform" onClick="validar_formulario(this.form)" class="btn btn-success">Agregar</button>
            </div>
        </form>
    </div>
</div>