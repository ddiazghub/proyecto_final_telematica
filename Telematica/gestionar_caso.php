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
    $query = "SELECT * FROM casos";
    $nombre = explode(" ", $valor);
    $query = "SELECT * FROM casos WHERE nombre_x = '$nombre[0]' AND apellido_x = '$nombre[1]'";
    break;
  case "cedula_x":
    $query = "SELECT * FROM casos WHERE cedula_x = $valor";
}

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
  include("gestionar_caso.html");
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
    if ($estados[count($estados) - 1] == "Muerte") {
      echo "No se puede editar el estado una vez la persona ha muerto.";
    } else {
      $estados = implode("_", $estados);
      $fechas_estados = implode("_", $fechas_estados);
    ?>
    <form action="cambiar_estado.php" method="post">

      <p>Cambiar estado:</p>
      <p>
        <input type="hidden" name="id_x" value="<?php echo $id_x; ?>"> 
        <input type="hidden" name="estados" value="<?php echo $estados; ?>"> 
        <input type="hidden" name="fechas_estados" value="<?php echo $fechas_estados; ?>"> 
        <select name = "estado">
          <option>----------Estado----------</option>
          <option value="En Tratamiento Casa">En Tratamiento Casa</option>
          <option value="En Tratamiento Hospital">En Tratamiento Hospital</option>
          <option value="En UCI">En UCI</option>
          <option value="Curado">Curado</option>
          <option value="Muerte">Muerte</option>
        </select>
        <input type="date" id="fecha" name="fecha"
            value="2018-07-22"
            min="1900-01-01" max="2022-01-01">
      </p>
      <input type="submit" value="Buscar">

    </form> 

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