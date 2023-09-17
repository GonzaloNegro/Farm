<?php #Llammo a pie 
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

$nombre = $row['nombre'];
$apellido = $row['apellido'];
$tipoUsu = $row['id_tipoUsuario'];
?>



<script type="text/javascript">
    function ok(){
        swal.fire(  {title: "Proyecto cargado",
                icon: "success",
                showConfirmButton: true,
                showCancelButton: false,
                });
    }	
</script>
<script>
    window.onload = verificarRB();
    
    function verificarRB() {
        var hac = document.getElementById('hacienda');
        var sie = document.getElementById('siembra');
        var alq = document.getElementById('alquiler');
        var inpSiembra = document.getElementById('inpSiembra');
        var inp1Hacienda = document.getElementById('inp1Hacienda');
        var inp2Hacienda = document.getElementById('inp2Hacienda');
        var inpHectareas = document.getElementById('inpHectareas');

        var divSiembra = document.getElementById('divSiembra');
        var div1Hacienda = document.getElementById('div1Hacienda');
        var div2Hacienda = document.getElementById('div2Hacienda');
        var divHectareas = document.getElementById('divHectareas');
        var arch = document.getElementById('arch');
        
        if(hac.checked){
/*             inp1Hacienda.disabled = false;
            inp2Hacienda.disabled = false;
            inpSiembra.disabled = true; */

            div1Hacienda.style.display = "flex";
            div2Hacienda.style.display = "flex";
            divSiembra.style.display = "none";
            arch.style.display = "none";
            divHectareas.style.display = "flex";

            inpSiembra.required = false;
            inp1Hacienda.required = true;
            inp2Hacienda.required = true;
            inpHectareas.required = true;
        }

        if(sie.checked){
/*             inp1Hacienda.disabled = true;
            inp2Hacienda.disabled = true;
            inpSiembra.disabled = false; */

            div1Hacienda.style.display = "none";
            div2Hacienda.style.display = "none";
            divSiembra.style.display = "flex";
            arch.style.display = "none";
            divHectareas.style.display = "flex";

            inpSiembra.required = true;
            inp1Hacienda.required = false;
            inp2Hacienda.required = false;
            inpHectareas.required = true;
        }

        if(alq.checked){
/*             inp1Hacienda.disabled = true;
            inp2Hacienda.disabled = true;
            inpSiembra.disabled = true; */

            div1Hacienda.style.display = "none";
            div2Hacienda.style.display = "none";
            divSiembra.style.display = "none";
            arch.style.display = "flex";
            divHectareas.style.display = "none";

            inpSiembra.required = false;
            inp1Hacienda.required = false;
            inp2Hacienda.required = false;
            inpHectareas.required = false;
        }
    }
</script>

<script>
function ValidarFechas()
{
    var estadoProyecto = document.getElementById('estadoProyecto').value;
    var fechainicial = document.getElementById("FechaInicial").value;
    var fechafinal = document.getElementById("FechaFinal").value;
    var hoy = new Date();

    if(estadoProyecto != 1 || estadoProyecto != 2){
            if(Date.parse(fechafinal) > hoy) {
                alert("La fecha de cierre debe ser menor a la fecha actual");
                $("input[type=date]").val("");
            }

            if(Date.parse(fechainicial) > hoy) {
                alert("La fecha de inicio no puede ser mayor a la fecha actual");
                $("input[type=date]").val("");
            }
        }

    if(Date.parse(fechafinal) < Date.parse(fechainicial)) {
    alert("La fecha de cierre debe ser mayor a la fecha inicial");
    $("input[type=date]").val("")
  }
}
</script>

<div class="centrado">
    <div class="centrado--titulo">
    <h1>Alta de proyecto</h1>	
    </div>
    <div>
        <button class="btn btn-info" id="btnProyecto" style="color:white;">Cargar proyecto finalizado</button>
    </div>
    <div class="centrado--form" id="formu1">
        <form action="./agrProyecto.php" method="POST" class="centrado--form--form">
            <div><h4>Carga de proyecto Iniciado/No iniciado</h4></div>
          <div class="labelInput">
              <label for="name">Nombre del proyecto:</label>
              <input type="text" name="nombre1" id="proyec" required>
          </div>
          <div class="labelInput">
              <label for="name">Parcela involucrada:</label>
              <select name="cmbparcela1" id="lista1" required>
                  <option value="" selected disabled="cmbparcela1">-Seleccione una-</option>
                  <?php
                  $consulta= "SELECT * FROM parcela";
                  $ejecutar= mysqli_query($conexion, $consulta) or die(mysqli_error($datos_base));
                  ?>
                  <?php foreach ($ejecutar as $opciones): ?> 
                  <option value="<?php echo $opciones['id_Parcela']?>"><?php echo $opciones['id_Parcela']?></option>
                  <?php endforeach ?>
              </select>
          </div>

          <div class="cantHas" id="select1lista"></div>

          <div class="labelInput">
              <label for="name">Estado del proyecto:</label>
              <select name="cmbEstado1" required id="estadoProyecto">
                  <option value="" selected disabled="cmbestado1">-Seleccione una-</option>
                  <?php
                  $consulta= "SELECT * FROM estadoproyecto LIMIT 0,2";
                  $ejecutar= mysqli_query($conexion, $consulta) or die(mysqli_error($datos_base));
                  ?>
                  <?php foreach ($ejecutar as $opciones): ?> 
                  <option value="<?php echo $opciones['id_EstadoProyecto']?>"><?php echo $opciones['estado']?></option>
                  <?php endforeach ?>
              </select>
          </div>

          <div class="labelInput">
              <label for="name">Tipo de proyecto:</label>
              <select name="cmbTipoProyecto1"required>
                  <option value="" selected disabled="cmbTipoProyecto1">-Seleccione una-</option>
                  <?php
                  $consulta= "SELECT * FROM tipoproyecto ORDER BY tipoProyecto ASC";
                  $ejecutar= mysqli_query($conexion, $consulta) or die(mysqli_error($datos_base));
                  ?>
                  <?php foreach ($ejecutar as $opciones): ?> 
                  <option value="<?php echo $opciones['id_tipoProyecto']?>"><?php echo $opciones['tipoProyecto']?></option>
                  <?php endforeach ?>
              </select>
          </div>
          <div class="labelInputbtn" style="gap:5px;">
            <input  type="reset" value="Cancelar" class="btn btn-danger">
            <input type="submit" value="Crear Proyecto" name="btn1" class="btn btn-success"> 
          </div>
        </form>
    </div>



    <div class="centrado--form" id="formu2">
        <form action="./agrProyecto.php" method="POST" class="centrado--form--form">
            <div><h4>Carga de proyecto Finalizado</h3></div>
          <div class="labelInput">
              <label for="name">Nombre del proyecto:</label>
              <input type="text" name="nombre2" id="prov" required>
          </div>
          <div class="labelInput">
              <label for="name">Parcela involucrada:</label>
              <select name="cmbparcela2" id="lista2" required>
                  <option value="" selected disabled="cmbParcelas2">-Seleccione una-</option>
                  <?php
                  $consulta= "SELECT * FROM parcela";
                  $ejecutar= mysqli_query($conexion, $consulta) or die(mysqli_error($datos_base));
                  ?>
                  <?php foreach ($ejecutar as $opciones): ?> 
                  <option value="<?php echo $opciones['id_Parcela']?>"><?php echo $opciones['id_Parcela']?></option>
                  <?php endforeach ?>
              </select>
          </div>

          <div class="cantHas" id="select2lista"></div>


          <div class="labelInput">
            <label for="name">Tipo de proyecto:</label>
            <div>
                Hacienda &nbsp<input type="radio" value="1" id="hacienda" onchange="verificarRB()" name="tipo" checked>&nbsp&nbsp&nbsp&nbsp&nbsp
                Siembra &nbsp<input type="radio" value="2" id="siembra" onchange="verificarRB()" name="tipo">&nbsp&nbsp&nbsp&nbsp&nbsp
                Alquiler &nbsp<input type="radio" value="3" id="alquiler" onchange="verificarRB()" name="tipo">
            </div>
          </div>



          <hr style="border: 1px solid black;width:100%;height:1px;"/>




<!--         <div class="labelInput">
          <label for="name">Nombre del proyecto:</label>
          <select name="cmbNombre" required>
          <option value="" selected disabled="cmbnombre">-Seleccione una-</option>
          <?php
          $consulta= "SELECT * FROM proyectos WHERE id_Proyecto NOT IN (SELECT id_Proyecto FROM detallesiembra) AND id_TipoProyecto = '2'  AND id_EstadoProyecto != 3";
          $ejecutar= mysqli_query($conexion, $consulta) or die(mysqli_error($datos_base));
          ?>
          <?php foreach ($ejecutar as $opciones): ?> 
          <option value="<?php echo $opciones['id_Proyecto']?>"><?php echo $opciones['nombreProyecto']?></option>
          <?php endforeach ?>
          </select>
      </div> -->
      <div class="labelInput">
          <label for="name">Fecha de inicio:</label>
          <input name="txtFechaInicio" type="date" class="form-control" onchange="ValidarFechas()" id="FechaInicial" required/>
      </div>
      <div class="labelInput">
          <label for="name">Fecha de cierre aproximado:</label>
          <input name="txtFechaCierre" type="date" class="form-control" onchange="ValidarFechas()" id="FechaFinal" required />
      </div>


      <div class="labelInput" id="divSiembra">
          <label for="name">Cultivo:</label>
          <select name="cmbCultivo" id="inpSiembra">
          <option value="" selected disabled="cmbCultivos">-Seleccione una-</option>
          <?php
          $consulta= "SELECT * FROM cultivos";
          $ejecutar= mysqli_query($conexion, $consulta) or die(mysqli_error($datos_base));
          ?>
          <?php foreach ($ejecutar as $opciones): ?> 
          <option value="<?php echo $opciones['id_Cultivo']?>"><?php echo $opciones['nombreCultivo']?></option>
          <?php endforeach ?>
          </select>
      </div>

      <div class="labelInput" id="div1Hacienda">
          <label for="name">Cantidad de cabezas:</label>
          <input name="txtCabezas" type="number" min="1" id="inp1Hacienda" required />	
      </div>
      <div class="labelInput" id="div2Hacienda">
        <label for="name">Categoria:</label>
        <select name="cmbCategoria" required id="inp2Hacienda">
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
          <input type="number" name="tipoCambio" min="1" id="prov" step=".01" required>
      </div>
      <div class="labelInput">
          <label for="name">Inversion inicial:</label>
          <input name="txtInversion" type="number" min="1" step=".01" required /> 
      </div>
      <div class="labelInput" id="arch">
          <label for="name">Subir archivo:</label>
          <input type="file" name='fichero' size='150' id='archivo' accept='application/pdf' /> 
      </div>






          <div class="labelInputbtn" style="gap:5px;">
            <input  type="reset" value="Cancelar" class="btn btn-danger">
            <input type="submit" value="Crear Proyecto" name="btn2" class="btn btn-success"> 
          </div>
        </form>
    </div>
</div>

<?php if(isset($_GET['ok'])){ ?> <script>ok();</script><?php }?>

<script type="text/javascript">
        $(document).ready(function(){
            recargarLista();
            $('#lista1').change(function(){
                recargarLista();
            });
        })
    </script>
    <script type="text/javascript">
        function recargarLista(){
            $.ajax({
                type: "POST",
                url: "./datosCarga.php",
                data: "cmbparcela1=" + $('#lista1').val(),
                success:function(r){
                    $('#select1lista').html(r);
                }
            });
        }
    </script>

<script type="text/javascript">
        $(document).ready(function(){
            recargarLista2();
            $('#lista2').change(function(){
                recargarLista2();
            });
        })
    </script>
    <script type="text/javascript">
        function recargarLista2(){
            $.ajax({
                type: "POST",
                url: "./datosCarga2.php",
                data: "cmbparcela2=" + $('#lista2').val(),
                success:function(r){
                    $('#select2lista').html(r);
                }
            });
        }
    </script>
    <script src="../JavaScript/formu.js"></script>