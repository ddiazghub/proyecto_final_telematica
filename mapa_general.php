<?php

include 'db.php';

$query = "SELECT * from casos";

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
  if (mysqli_num_rows($resultado) > 0) {
    ?>
      <html>
      <head>
      <title>Leaflet Address Lookup and Coordinates</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" />
      <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"></script>
      <style type="text/css">
      #map { height: 600px; width: 100%;}
      </style>
      </head>
      <body>

      <div id="map"></div>

      <script type="text/javascript">

      var map = L.map('map').setView([51.505, -0.09], 13);
       L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {attribution: 'OSM'}).addTo(map);
       var greenIcon = new L.Icon({
          iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
          shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
          iconSize: [25, 41],
          iconAnchor: [12, 41],
          popupAnchor: [1, -34],
          shadowSize: [41, 41]
        });

        var yellowIcon = new L.Icon({
          iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-yellow.png',
          shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
          iconSize: [25, 41],
          iconAnchor: [12, 41],
          popupAnchor: [1, -34],
          shadowSize: [41, 41]
        });

        var orangeIcon = new L.Icon({
          iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-orange.png',
          shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
          iconSize: [25, 41],
          iconAnchor: [12, 41],
          popupAnchor: [1, -34],
          shadowSize: [41, 41]
        });

        var violetIcon = new L.Icon({
          iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-violet.png',
          shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
          iconSize: [25, 41],
          iconAnchor: [12, 41],
          popupAnchor: [1, -34],
          shadowSize: [41, 41]
        });

        var redIcon = new L.Icon({
          iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
          shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
          iconSize: [25, 41],
          iconAnchor: [12, 41],
          popupAnchor: [1, -34],
          shadowSize: [41, 41]
        });
        
        var group = new L.featureGroup([
        <?php
        while($row = mysqli_fetch_assoc($resultado)) {
          $estados = explode("_", $row["estados"]);
          $fechas_estados = explode("_", $row["fechas_estados"]);

          if (!is_array($estados)) {
            $estados = array($estados);
            $fechas_estados = array($fechas_estados);
          }
          $icon = "";
          switch ($estados[count($estados)-1]) {
            case "Negativo":
              $icon = "greenIcon";
              break;
            case "En Tratamiento Casa":
            case "En Tratamiento Hospital":
              $icon = "yellowIcon";
              break;
            case "En UCI":
              $icon = "orangeIcon";
              break;
            case "Curado":
              $icon = "violetIcon";
              break;
            case "Muerte":
              $icon = "redIcon";
          }
          echo "L.marker([".$row['lat_residencia'].",".$row['lng_residencia']."], { icon: ".$icon." }).addTo(map),";
        }
        ?>
        ]);
        map.fitBounds(group.getBounds().pad(0.5));
          

      </script>

      </body>
      </html>
    <?php
  } else {
      echo "El caso no existe";
  }
} else {
  echo $query;
  echo mysqli_error($conexion);
}

?>