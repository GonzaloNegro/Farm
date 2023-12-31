<?php #Llammo a pie 
include ("../Modelo/Conexion.php");
include('../Template/Cabecera.php');
error_reporting(0);
?>
<!--codigo aca-->

<script type="text/javascript">
			function ok(){
				swal.fire(  {title: "Detalle cargado!",
						icon: "success",
						showConfirmButton: true,
						showCancelButton: false,
						})
          }	
</script>
<script>
function ValidarFechas()
{
   var fechainicial = document.getElementById("FechaInicial").value;
   var fechafinal = document.getElementById("FechaFinal").value;
   var hoy = new Date();
/*    var hoy = new Date();
   var dd = today.getDate();
   var mm = today.getMonth() + 1;
   var yyyy = today.getFullYear();
   
   if(dd < 10){
    dd = '0' + dd;
   }

   if(mm < 10){
    mm = '0' + mm;
   }

   hoy = yyyy + '-' + mm + '-' + dd;
   fechafinal.setAttribute("max", hoy); */


   if(Date.parse(fechafinal) < Date.parse(fechainicial)) {
   alert("La fecha de cierre debe ser mayor a la fecha inicial");
   $("input[type=date]").val("");
  }

}
</script>
<script>
    function alerta(campo) { 
    alert("Por favor, completa el campo "+campo) 
    }
    function validar_formulario(form){
        if (form.cmbNombre.value == "") { 
            alerta('\"Nombre del proyecto\"'); form.cmbNombre.focus(); return true; 
            }
        if (form.txtFechaInicio.value == "") { 
            alerta('\"Fecha de inicio\"'); form.txtFechaInicio.focus(); return true; 
            }
        if (form.txtFechaCierre.value == "") { 
            alerta('\"Fecha de cierre aproximado\"'); form.txtFechaCierre.focus(); return true; 
            }
        if (form.txtCabezas.value == "") { 
            alerta('\"Cantidad de cabezas\"'); form.txtCabezas.focus(); return true; 
            }
        if (form.cmbCategoria.value == "") { 
            alerta('\"Categoria\"'); form.cmbCategoria.focus(); return true; 
            }
        if (form.cmbMoneda.value == "") { 
            alerta('\"Moneda\"'); form.cmbMoneda.focus(); return true; 
            }
        if (form.tipoCambio.value == "") { 
            alerta('\"Tipo de cambio\"'); form.tipoCambio.focus(); return true; 
            }
        if (form.txtInversion.value == "") { 
            alerta('\"Inversion inicial\"'); form.txtInversion.focus(); return true; 
            }
            
            
            
            if(form.cmbNombre.value != "" && form.txtFechaInicio.value != "" && form.txtFechaCierre.value != "" && form.txtCabezas.value != "" && form.cmbCategoria.value != "" && form.cmbMoneda.value != "" && form.tipoCambio.value != "" && form.txtInversion.value != ""){
                $(document).ready(function() {
                    $('#btnform').click(function() {
                        Swal.fire({
                            title: "¿Está seguro que desea agregar el detalle?",
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
    <h1>Asignar detalles proyecto de hacienda</h1>
  </div>
  <div class="centrado--form">
    <form action="./agrDetalleHacienda.php" name="form_mod" id="form_mod" method="POST" class="centrado--form--form">
      <div class="labelInput">
        <label for="name">Nombre del proyecto:</label>
        <select name="cmbNombre" required>
          <option value="" selected disabled="cmbnombre">-Seleccione una-</option>
          <?php
          $consulta= "SELECT * FROM proyectos WHERE id_Proyecto NOT IN (SELECT id_Proyecto FROM detallehacienda) AND id_TipoProyecto = '1' AND id_EstadoProyecto != 3";
          $ejecutar= mysqli_query($conexion, $consulta) or die(mysqli_error($datos_base));
          ?>
          <?php foreach ($ejecutar as $opciones): ?> 
          <option value="<?php echo $opciones['id_Proyecto']?>"><?php echo $opciones['nombreProyecto']?></option>
          <?php endforeach ?>
          </select>
      </div>
      <div class="labelInput">
        <label for="name">Fecha de inicio:</label>
        <input name="txtFechaInicio" type="date" class="form-control" onchange="ValidarFechas()" id="FechaInicial" required/>
      </div>
      <div class="labelInput">
        <label for="name">Fecha de cierre aproximado:</label>
        <input name="txtFechaCierre" type="date" class="form-control" onchange="ValidarFechas()" id="FechaFinal" required />
      </div>      
      <div class="labelInput">
          <label for="name">Cantidad de cabezas:</label>
          <input name="txtCabezas" type="number" min="1" required />	
      </div>
      <div class="labelInput">
        <label for="name">Categoria:</label>
        <select name="cmbCategoria" required>
        <option value="" selected disabled="cmbcategoria">-Seleccione una-</option>
        <?php
        $consulta= "SELECT * FROM categoria";
        $ejecutar= mysqli_query($conexion, $consulta) or die(mysqli_error($datos_base));
        ?>
        <?php foreach ($ejecutar as $opciones): ?> 
        <option value="<?php echo $opciones['id_Categoria']?>"><?php echo $opciones['nombreCategoria']?></option>
        <?php endforeach ?>
        </select>    
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
          <label for="name">Tipo de Cambio:</label>
          <input type="number" name="tipoCambio" min="1" id="prov" required>
      </div>
      <div class="labelInput">
          <label for="name">Inversion inicial:</label>
          <input name="txtInversion" type="number" min="1" required />   
      </div>
      <div class="labelInputbtn" style="gap:5px;">
        <button type="reset" class="btn btn-danger">Cancelar</button>
        <button type="button" id="btnform" onClick="validar_formulario(this.form)" class="btn btn-success">Cargar detalle</button>
      </div>
    </form>
    <?php if(isset($_GET['ok'])){ ?> <script>ok();</script><?php }?>
  </div>
</div>