<?php

include 'db.php';

$query = "SELECT * from casos";

$resultado = mysqli_query($conexion, $query);
$casos_negativos = 0;
$casos_positivos = 0;
$muertos = 0;
$infectados = 0;
$curados = 0;
$tratamiento_casa = 0;
$tratamiento_hospital = 0;
$en_uci = 0;
$f_casos = [];
$fechas_casos;
$casos_dia = [];

// Function to get all the dates in given range
function getDatesFromRange($start, $end, $format = 'Y-m-d') {
      
  // Declare an empty array
  $array = array();
    
  // Variable that store the date interval
  // of period 1 day
  $interval = new DateInterval('P1D');

  $realEnd = new DateTime($end);
  $realEnd->add($interval);

  $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

  // Use loop to store date into array
  foreach($period as $date) {                 
      $array[] = $date->format($format); 
  }

  // Return the array elements
  return $array;
}


if ($resultado) {
  if (mysqli_num_rows($resultado) > 0) {
      // output data of each row
    while($row = mysqli_fetch_assoc($resultado)) {
      $estados = explode("_", $row["estados"]);
      $fechas_estados = explode("_", $row["fechas_estados"]);

      if (!is_array($estados)) {
        $estados = array($estados);
        $fechas_estados = array($fechas_estados);
      }
      if ($estados[count($estados) - 1] == "Negativo") {
        $casos_negativos++;
      } else {
        $casos_positivos++;
      }

      if ($estados[count($estados) - 1] == "Curado") {
        $curados++;
      } else if ($estados[count($estados) - 1] == "Muerte") {
        $muertos++;
      } else if ($estados[count($estados) - 1] != "Negativo") {
        $infectados++;
        switch ($estados[count($estados) - 1]) {
          case "En Tratamiento Casa":
            $tratamiento_casa++;
            break;
          case "En Tratamiento Hospital":
            $tratamiento_hospital++;
            break;
          case "En UCI":
            $en_uci++;
        }
      }
      array_push($f_casos, $fechas_estados[0]);
    }
    $fechas_casos = getDatesFromRange(min($f_casos), max($f_casos));
    for ($i = 0; $i < count($fechas_casos); $i++) array_push($casos_dia, 0);
    foreach ($f_casos as $fecha) {
      $index = array_search($fecha, $fechas_casos);
      $casos_dia[$index]++;
    }
  } else {
      echo "El caso no existe";
  }
} else {
  echo $query;
  echo mysqli_error($conexion);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChartCases);
      google.charts.setOnLoadCallback(drawChartInfected);
      google.charts.setOnLoadCallback(drawChartResults);
      google.charts.setOnLoadCallback(drawChartLine);

      function drawChartLine() {
        var data = google.visualization.arrayToDataTable([
          ['Día', 'Casos'],
          <?php 
          for ($i = 0; $i < count($fechas_casos); $i++) {
            echo "['".$fechas_casos[$i]."', ".$casos_dia[$i]."], ";
          }
          ?>
        ]);

        var options = {
          title: 'Casos por día',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }

      function drawChartCases() {
        var data = google.visualization.arrayToDataTable([
          ['Caso', 'Frecuencia'],
          ['Infectados', <?php echo $infectados?>],
          ['Muertos', <?php echo $muertos?>],
          ['Curados', <?php echo $curados?>]
        ]);

        var options = {
          title: 'Casos'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_cases'));

        chart.draw(data, options);
      }

      function drawChartInfected() {
        var data = google.visualization.arrayToDataTable([
          ['Infectados', 'Frecuencia'],
          ['En Tratamiento Casa', <?php echo $tratamiento_casa?>],
          ['En Tratamiento Hospital', <?php echo $tratamiento_hospital?>],
          ['En UCI', <?php echo $en_uci?>],
          ['Muertos', <?php echo $muertos?>]
        ]);

        var options = {
          title: 'Infectados'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_infected'));

        chart.draw(data, options);
      }

      function drawChartResults() {
        var data = google.visualization.arrayToDataTable([
          ['Resultado', 'Frecuencia'],
          ['Negativo', <?php echo $casos_negativos?>],
          ['Positivo', <?php echo $casos_positivos?>]
        ]);

        var options = {
          title: 'Resultados de exámenes'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_results'));

        chart.draw(data, options);
      }
    </script>
</head>
<body>
  <a href="modulos.html">Módulos</a>
  <div id="curve_chart" style="width: 900px; height: 500px;"></div>
  <div id="piechart_cases" style="width: 900px; height: 500px;"></div>
  <div id="piechart_infected" style="width: 900px; height: 500px;"></div>
  <div id="piechart_results" style="width: 900px; height: 500px;"></div>
    
</body>
</html>