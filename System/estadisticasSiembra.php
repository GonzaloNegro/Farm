<?php #Llammo a pie 
include('../Template/Cabecera.php');
include('../Modelo/Conexion.php');
error_reporting(0);
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart1);
      
      function drawChart1() {

      var data1 = google.visualization.arrayToDataTable([
        ['Task', ''],
        <?php    
        $SQL = "SELECT c.nombreCultivo, COUNT(d.id_DetalleSiembra) AS total
        FROM detallesiembra d
        LEFT JOIN cultivos c ON c.id_Cultivo = d.id_Cultivo
        GROUP BY d.id_Cultivo
        ORDER BY c.nombreCultivo";          

        $consulta = mysqli_query($conexion, $SQL);
        while ($resultado = mysqli_fetch_assoc($consulta)){
          echo "['Cultivo: " .$resultado['nombreCultivo']."', " .$resultado['total']."],";
        }

      ?>
      ]);
      /* rgb(220, 57, 18)  ROJO
      rgb(16, 150, 24) VERDE
      rgb(255, 153, 0) AMARILLO      
      */
      var options1 = {
        title: 'Proyectos de Siembra por Tipo de Cultivo'
      };

      var chart1 = new google.visualization.ColumnChart(document.getElementById('piechart1'));
      chart1.draw(data1, options1);
      }
    </script>
  </head>
    <div class="centrado">
        <div class="centrado--titulo">
            <h1>Estadísticas siembra</h1>		
        </div>
        <div class="centrado--stats">
            <div class="centrado--stats--cont">
              <div class="centrado--stats--cont--detail particular">
                  <h2><u>Proyectos</u></h2>
                  <?php
                    $sent= "SELECT COUNT(*) AS TOTAL FROM proyectos WHERE id_TipoProyecto = 2 AND id_EstadoProyecto = 1";
                    $resultado = $conexion->query($sent);
                    $row = $resultado->fetch_assoc();
                    $totalNo = $row['TOTAL'];

                    $sent= "SELECT COUNT(*) AS TOTAL FROM proyectos WHERE id_TipoProyecto = 2 AND id_EstadoProyecto = 2";
                    $resultado = $conexion->query($sent);
                    $row = $resultado->fetch_assoc();
                    $totalIn = $row['TOTAL'];

                    $sent= "SELECT COUNT(*) AS TOTAL FROM proyectos WHERE id_TipoProyecto = 2 AND id_EstadoProyecto = 3";
                    $resultado = $conexion->query($sent);
                    $row = $resultado->fetch_assoc();
                    $totalFi = $row['TOTAL'];

                    $tot = $totalFi + $totalIn + $totalNo;
                  ?>      
                    <div class="labelInput">
                      <h4>Activos:</h4>
                      <h4><?php echo $totalIn; ?></h4>
                    </div>
                    <div class="labelInput">
                      <h4>Por comenzar:</h4>
                      <h4><?php echo $totalNo; ?></h4>
                    </div>
                    <div class="labelInput">
                      <h4>Finalizados:</h4>
                      <h4><?php echo $totalFi; ?></h4>
                    </div>
                    <hr style="border: 1px solid black;width:100%;height:1px;"/>
                    <div class="labelInput">
                      <h2 style="color:green;">Totales:</h2>
                      <h2 style="color:green;"><?php echo $tot; ?></h2>
                    </div>


                  </div>
                <div class="centrado--stats--cont--detail" id="piechart1"></div>

                <div class="centrado--stats--cont--detail2 particular">
                <h2><u>Inversiones</u></h2>
                  <?php
                    $invInicialDolares = 0;
                    $invInicialPesos = 0;
                    $consulta=mysqli_query($conexion, "SELECT SUM(d.inversion) AS monto, d.id_Moneda, d.tipoCambio, SUM(p.cantidadHas) AS TOTAL
                    FROM detallesiembra d
                    LEFT JOIN proyectos p ON p.id_Proyecto = d.id_Proyecto");
                    while($listar = mysqli_fetch_array($consulta)){
                      $inversionP = $listar['monto'];
                      $id_MonedaP = $listar['id_Moneda'];
                      $tipoCambioP = $listar['tipoCambio'];
                      $hectareas = $listar['TOTAL'];

                      //1 = ARS
                      //2 = USD

                      if($id_MonedaP == 2){//USD
                        $invInicialDolares = $inversionP;
                        $invInicialPesos = $inversionP * $tipoCambioP;
                      }
                
                      if($id_MonedaP == 1){//ARS
                        $invInicialPesos = $inversionP;
                        $invInicialDolares = $inversionP / $tipoCambioP;
                      }
                    }
                    $pesosIni = number_format($invInicialPesos, 2, ',','.');
                    $dolaresIni = number_format($invInicialDolares, 2, ',','.');

                    $hectareasPesos = number_format(($invInicialPesos / $hectareas), 2, ',','.');
                    $hectareasDolares = number_format(($invInicialDolares / $hectareas), 2, ',','.');

                  /* --------------------------------------------------------- */

                  $invInicialDolaresC = 0;
                  $invInicialPesosC = 0;
                  $consulta2=mysqli_query($conexion, "SELECT SUM(c.importeTotal) AS monto, c.id_Moneda, c.tipoCambio
                  FROM compras c
                  LEFT JOIN compraproyecto cp ON cp.id_Compras = c.id_Compras
                  LEFT JOIN proyectos p ON p.id_Proyecto = cp.id_Proyecto
                  WHERE p.id_TipoProyecto = 2 AND cp.id_TipoCompra = 2");
                  while($listar2 = mysqli_fetch_array($consulta2)){
                    $inversionC = $listar2['monto'];
                    $id_MonedaC = $listar2['id_Moneda'];
                    $tipoCambioC = $listar2['tipoCambio'];

                    //1 = ARS
                    //2 = USD

                    if($id_MonedaC == 2){//USD
                      $invInicialDolaresC = $invInicialDolaresC + $inversionC;
                      $invInicialPesosC = $invInicialPesosC + ($inversionC * $tipoCambioC);
                    }
              
                    if($id_MonedaC == 1){//ARS
                      $invInicialPesosC = $invInicialPesosC + $inversionC;
                      $invInicialDolaresC =$invInicialDolaresC + ($inversionC / $tipoCambioC);
                    }

                  }
                  $pesosIniC = number_format($invInicialPesosC, 2, ',','.');
                  $dolaresIniC = number_format($invInicialDolaresC, 2, ',','.');


                  /* -----------------------SUMA TOTAL---------------------------------- */
                  $totalDolares = $invInicialDolares + $invInicialDolaresC;
                  $totalPesos = $invInicialPesos + $invInicialPesosC;

                  $totalDolares = number_format($totalDolares, 2, ',','.');
                  $totalPesos = number_format($totalPesos, 2, ',','.');
                  ?>      
                    <div class="labelInput">
                      <h5>Inversiones iniciales USD:</h5>
                      <h5><?php echo "$".$dolaresIni; ?></h5>
                    </div>
                    <div class="labelInput">
                      <h5>Inversiones iniciales ARS:</h5>
                      <h5><?php echo "$".$pesosIni; ?></h5>
                    </div>
                    <div class="labelInput">
                      <h5>Promedio invertido por hectárea USD:</h5>
                      <h5><?php echo "$".$hectareasDolares; ?></h5>
                    </div>
                    <div class="labelInput">
                      <h5>Promedio invertido por hectárea ARS:</h5>
                      <h5><?php echo "$".$hectareasPesos; ?></h5>
                    </div>
<!--                     <div class="labelInput">
                      <h5>Compras USD:</H5>
                      <h5><?php echo "$".$dolaresIniC; ?></h5>
                    </div>
                    <div class="labelInput">
                      <h5>Compras ARS:</h5>
                      <h5><?php echo "$".$pesosIniC; ?></h5>
                    </div> -->
                    <hr style="border: 1px solid black;width:100%;height:1px;"/>
                    <div class="labelInput">
                      <h3 style="color:green;">Total USD:</h3>
                      <h3 style="color:green;"><?php echo "$".$totalDolares; ?></h3>
                    </div>
                    <div class="labelInput">
                      <h3 style="color:green;">Total ARS:</h3>
                      <h3 style="color:green;"><?php echo "$".$totalPesos; ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>