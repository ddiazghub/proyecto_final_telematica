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
    }
  } else {
      echo "El caso no existe";
  }
} else {
  echo $query;
  echo mysqli_error($conexion);
}

?>