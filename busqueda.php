<?php

include 'db.php';

$valor = $_GET['valor'];
$consulta = $_GET['consulta'];

mysqli_set_charset($conexion, 'utf16');

$query = "";

switch ($consulta) {
  case "id_x":
    $query = "SELECT * FROM casos WHERE id_x = $valor";
    break;
  case "cedula_x":
    $query = "SELECT * FROM casos WHERE cedula_x = $valor";
}

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
  include("busqueda.html");
  if (mysqli_num_rows($resultado) > 0) {
      // output data of each row
    $estados;
    $fechas_estados;
    while($row = mysqli_fetch_assoc($resultado)) {
      $id_x = $row['id_x'];
      echo "id: " . $row["id_x"]. " - Nombre: " . $row["nombre_x"]. " " . $row["apellido_x"]. 
      " - Cédula: " . $row["cedula_x"]. " - Sexo: " . $row["Sexo"]. " - Fecha de Nacimiento: " . $row["fecha_de_nacimiento"]. 
      " - Dirección Residencia: " . $row["direccion_de_residencia"]. " - Dirección Trabajo: " . $row["direccion_de_trabajo"] . "<br>";
      $estados = explode("_", $row["estados"]);
      $fechas_estados = explode("_", $row["fechas_estados"]);

      if (!is_array($estados)) {
        $estados = array($estados);
        $fechas_estados = array($fechas_estados);
      }
      echo "Estados registrados: <br>";
      for($i = 0; $i < count($estados); $i++) {
        echo $estados[$i] . "     " . $fechas_estados[$i] . "<br>";
      }
      ?>
       <div id="map"></div>
       <script type="text/javascript">
       var map = L.map('map').setView([51.505, -0.09], 13);
       L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {attribution: 'OSM'}).addTo(map);
       var home_icon = new L.Icon({
            iconUrl: "./images/home_icon.png",
            shadowUrl: "https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png",
            iconSize: [44, 50],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41],
        });

        var work_icon = new L.Icon({
            iconUrl: "./images/work_icon.png",
            shadowUrl: "https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png",
            iconSize: [38, 50],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41],
        });
        var group = new L.featureGroup([
          L.marker([<?php echo $row['lat_residencia'].",".$row['lng_residencia']?>], { icon: home_icon }).addTo(map), 
          L.marker([<?php echo $row['lat_trabajo'].",".$row['lng_trabajo']?>], { icon: work_icon }).addTo(map)]);
          map.fitBounds(group.getBounds().pad(0.5));
       </script>
      <?php
    }
  } else {
      echo "El caso no existe";
  }
} else {
  echo $query;
  echo mysqli_error($conexion);
}

?>