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
  case "nombre_x":
    $nombre = explode(" ", $valor);
    $query = "SELECT * FROM casos WHERE nombre_x = '$nombre[0]' AND apellido_x = '$nombre[1]'";
    echo $query;
  case "cedula_x":
    $query = "SELECT * FROM casos WHERE cedula_x = $valor";
}

$resultado = mysqli_query($conexion, $query);

if (mysqli_num_rows($resultado) > 0) {
  include("gestionar_caso.html");
    // output data of each row
    while($row = mysqli_fetch_assoc($resultado)) {
      echo "id: " . $row["id_x"]. " - Nombre: " . $row["nombre_x"]. " " . $row["apellido_x"]. 
      " - Cédula: " . $row["cedula_x"]. " - Sexo: " . $row["Sexo"]. " - Fecha de Nacimiento: " . $row["fecha_de_nacimiento"]. 
      " - Dirección Residencia: " . $row["direccion_de_residencia"]. " - Dirección Trabajo: " . $row["direccion_de_trabajo"] . "<br>";
    }
} else {
    echo "El caso no existe";
}

?>