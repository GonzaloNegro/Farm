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
      google.charts.setOnLoadCallback(drawChart);
      google.charts.setOnLoadCallback(drawChart1);
      google.charts.setOnLoadCallback(drawChart2);
      google.charts.setOnLoadCallback(drawChart3);
      google.charts.setOnLoadCallback(drawChart4);

      google.charts.setOnLoadCallback(drawChart5);
      google.charts.setOnLoadCallback(drawChart6);
      google.charts.setOnLoadCallback(drawChart7);
      google.charts.setOnLoadCallback(drawChart8);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
<?php    
          $SQL = "SELECT * FROM proyectos WHERE id_EstadoProyecto = 2";
     
          $consulta = mysqli_query($conexion, $SQL);
          while ($resultado = mysqli_fetch_assoc($consulta)){
            echo "['" .$resultado['nombreProyecto']."', " .$resultado['cantidadHas']."],";
          }

?>
        ]);

        var options = {
          title: 'Estadisticas de Rinde Especulado - Deberia ser RINDE OBTENIDO '
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }




      function drawChart1() {

      var data1 = google.visualization.arrayToDataTable([
        ['Task', ''],
      <?php    
        $SQL = "SELECT * FROM detallesiembra ds
                INNER JOIN proyectos p ON p.id_Proyecto = ds.id_Proyecto
                WHERE id_EstadoProyecto = 2";

        $consulta = mysqli_query($conexion, $SQL);
        while ($resultado = mysqli_fetch_assoc($consulta)){
          echo "['" .$resultado['nombreProyecto']."', " .$resultado['cantidadHas']."],";
        }

      ?>
      ]);

      var options1 = {
        title: 'Hectáreas por proyecto de siembra [ACTIVOS]'
      };

      var chart1 = new google.visualization.AreaChart(document.getElementById('piechart1'));
      chart1.draw(data1, options1);
      }




      function drawChart2() {

      var data2 = google.visualization.arrayToDataTable([
      <?php    
          $sent= "SELECT COUNT(*) AS TOTAL FROM proyectos WHERE id_TipoProyecto = 1 AND id_EstadoProyecto = 2";
          $resultado = $conexion->query($sent);
          $row = $resultado->fetch_assoc();
          $totHacienda = $row['TOTAL'];        

          $sent= "SELECT COUNT(*) AS TOTAL1 FROM proyectos WHERE id_TipoProyecto = 2 AND id_EstadoProyecto = 2";
          $resultado = $conexion->query($sent);
          $row = $resultado->fetch_assoc();
          $totSiembra = $row['TOTAL1'];   
          
          $sent= "SELECT COUNT(*) AS TOTAL1 FROM proyectos WHERE id_TipoProyecto = 3 AND id_EstadoProyecto = 2";
          $resultado = $conexion->query($sent);
          $row = $resultado->fetch_assoc();
          $totAlquiler = $row['TOTAL1'];   
          ?>
          ['', 'Total', { role: "style" } ],
          ['Hacienda', <?php echo $totHacienda;?>, 'rgb(16, 150, 24)'],
          ['Siembra', <?php echo $totSiembra;?>, "rgb(220, 57, 18)"],
          ['Alquiler', <?php echo $totAlquiler;?>, "rgb(140, 37, 68)"],
      ]);

      var options2 = {
        title: 'Cantidad de proyectos Hacienda/Siembra/Alquiler [ACTIVOS]'
      };

      var chart2 = new google.visualization.ColumnChart(document.getElementById('piechart2'));
      chart2.draw(data2, options2);
      }





      function drawChart3() {

      var data3 = google.visualization.arrayToDataTable([
        ['Task', ''],
        <?php    
        $SQL = "SELECT id_Parcela, COUNT(id_Proyecto) AS total
        FROM proyectos
        WHERE id_EstadoProyecto = 2
        GROUP BY id_Parcela
        ORDER BY id_Parcela";

        $consulta = mysqli_query($conexion, $SQL);
        while ($resultado = mysqli_fetch_assoc($consulta)){
          echo "['Parcela N°" .$resultado['id_Parcela']."', " .$resultado['total']."],";
        }

      ?>
      ]);
      /* rgb(220, 57, 18)  ROJO
      rgb(16, 150, 24) VERDE
      rgb(255, 153, 0) AMARILLO      
      */
      var options3 = {
        title: 'Cantidad de proyectos por Parcela [ACTIVOS]'
      };

      var chart3 = new google.visualization.ColumnChart(document.getElementById('piechart3'));
      chart3.draw(data3, options3);
      }



      function drawChart4() {

      var data4 = google.visualization.arrayToDataTable([
        ['Task', ''],
      <?php    
        $SQL = "SELECT * FROM detallehacienda ds
                INNER JOIN proyectos p ON p.id_Proyecto = ds.id_Proyecto
                WHERE id_EstadoProyecto = 2";

        $consulta = mysqli_query($conexion, $SQL);
        while ($resultado = mysqli_fetch_assoc($consulta)){
          echo "['" .$resultado['nombreProyecto']."', " .$resultado['cantidadHas']."],";
        }

      ?>
      ]);

      var options4 = {
        title: 'Hectáreas por proyecto de Hacienda [ACTIVOS]'
      };

      var chart4 = new google.visualization.AreaChart(document.getElementById('piechart4'));
      chart4.draw(data4, options4);
      }


      /* ------------------------------------------------------ */
      /* ------------------------------------------------------ */

      function drawChart5() {

      var data5 = google.visualization.arrayToDataTable([
        <?php
          $sent= "SELECT COUNT(*) AS TOTAL FROM proyectos WHERE id_TipoProyecto = 1 AND id_EstadoProyecto = 3";
          $resultado = $conexion->query($sent);
          $row = $resultado->fetch_assoc();
          $totHacienda = $row['TOTAL'];        

          $sent= "SELECT COUNT(*) AS TOTAL1 FROM proyectos WHERE id_TipoProyecto = 2 AND id_EstadoProyecto = 3";
          $resultado = $conexion->query($sent);
          $row = $resultado->fetch_assoc();
          $totSiembra = $row['TOTAL1'];   
          
          $sent= "SELECT COUNT(*) AS TOTAL1 FROM proyectos WHERE id_TipoProyecto = 3 AND id_EstadoProyecto = 3";
          $resultado = $conexion->query($sent);
          $row = $resultado->fetch_assoc();
          $totAlquiler = $row['TOTAL1'];   
          ?>
          ['', 'Total', { role: "style" } ],
          ['Hacienda', <?php echo $totHacienda;?>, 'rgb(16, 150, 24)'],
          ['Siembra', <?php echo $totSiembra;?>, "rgb(220, 57, 18)"],
          ['Alquiler', <?php echo $totAlquiler;?>, "rgb(140, 37, 68)"],
      ]);

      var options5 = {
        title: 'Cantidad de proyectos Hacienda/Siembra/Alquiler [FINALIZADOS]'
      };

      var chart5 = new google.visualization.ColumnChart(document.getElementById('piechart5'));
      chart5.draw(data5, options5);
      }


      function drawChart6() {

      var data6 = google.visualization.arrayToDataTable([
        ['Task', ''],
      <?php    
        $SQL = "SELECT * FROM detallesiembra ds
                INNER JOIN proyectos p ON p.id_Proyecto = ds.id_Proyecto
                WHERE id_EstadoProyecto = 3";

        $consulta = mysqli_query($conexion, $SQL);
        while ($resultado = mysqli_fetch_assoc($consulta)){
          echo "['" .$resultado['nombreProyecto']."', " .$resultado['cantidadHas']."],";
        }

      ?>
      ]);

      var options6 = {
        title: 'Hectáreas por proyecto de siembra [FINALIZADOS]'
      };

      var chart6 = new google.visualization.AreaChart(document.getElementById('piechart6'));
      chart6.draw(data6, options6);
      }





      function drawChart7() {

      var data7 = google.visualization.arrayToDataTable([
        ['Task', ''],
        <?php    
        $SQL = "SELECT id_Parcela, COUNT(id_Proyecto) AS total
        FROM proyectos
        WHERE id_EstadoProyecto = 3
        GROUP BY id_Parcela
        ORDER BY id_Parcela";

        $consulta = mysqli_query($conexion, $SQL);
        while ($resultado = mysqli_fetch_assoc($consulta)){
          echo "['Parcela N°" .$resultado['id_Parcela']."', " .$resultado['total']."],";
        }

      ?>
      ]);
      var options7 = {
        title: 'Cantidad de proyectos por Parcela [FINALIZADOS]'
      };

      var chart7 = new google.visualization.ColumnChart(document.getElementById('piechart7'));
      chart7.draw(data7, options7);
      }



      function drawChart8() {

      var data8 = google.visualization.arrayToDataTable([
        ['Task', ''],
      <?php    
        $SQL = "SELECT * FROM detallehacienda ds
                INNER JOIN proyectos p ON p.id_Proyecto = ds.id_Proyecto
                WHERE id_EstadoProyecto = 3";

        $consulta = mysqli_query($conexion, $SQL);
        while ($resultado = mysqli_fetch_assoc($consulta)){
          echo "['" .$resultado['nombreProyecto']."', " .$resultado['cantidadHas']."],";
        }

      ?>
      ]);

      var options8 = {
        title: 'Hectáreas por proyecto de Hacienda [FINALIZADOS]'
      };

      var chart8 = new google.visualization.AreaChart(document.getElementById('piechart8'));
      chart8.draw(data8, options8);
      }
    </script>


  </head>
    <div class="centrado">
      <div class="centrado--titulo">
        <h1>Estadísticas generales</h1>		
      </div>
      <h2>Activos</h2>
<!--       <div class="centrado--btn">
        <button class="btn btn-success" id="changeG">Ver Finalizados</button>
      </div> -->
      <div class="centrado--stats">
        <div class="centrado--stats--cont">
          <div class="centrado--stats--cont--detail" id="piechart"></div>
          <div class="centrado--stats--cont--detail" id="piechart2"></div>
        </div>
            
        <div class="centrado--stats--cont">
          <div class="centrado--stats--cont--detail" id="piechart1"></div>
          <div class="centrado--stats--cont--detail" id="piechart4"></div>
          <div class="centrado--stats--cont--detail" id="piechart3"></div>
        </div>
      </div>

      <h2>Finalizados</h2>

      <div class="centrado--stats">
        <div class="centrado--stats--cont">
          <div class="centrado--stats--cont--detail" id="piechart5"></div>
          <div class="centrado--stats--cont--detail" id="piechart7"></div>
        </div>
        
        <div class="centrado--stats--cont">
          <div class="centrado--stats--cont--detail" id="piechart6"></div>
          <div class="centrado--stats--cont--detail" id="piechart8"></div>
        </div>
      </div>

    </div>
    
    <script src="../JavaScript/formu2.js"></script>