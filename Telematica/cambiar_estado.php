<?php

include 'db.php';

$id_x = $_POST['id_x'];
$estado = $_POST['estado'];
$fecha = $_POST['fecha'];
$estados = $_POST['estados'];
$fechas_estados = $_POST['fechas_estados'];

$estados = explode("_", $estados);
$fechas_estados = explode("_", $fechas_estados);
if (!is_array($estados)) {
    $estados = array($estados, $estado);
    $fechas_estados = array($fechas_estados, $fecha);
} else {
    array_push($estados, $estado);
    array_push($fechas_estados, $fecha);
}
$estados = implode("_", $estados);
$fechas_estados = implode("_", $fechas_estados);

$query = "UPDATE casos SET estados = '$estados', fechas_estados = '$fechas_estados' WHERE id_x = '$id_x'";
$resultado = mysqli_query($conexion, $query);

if ($resultado) {
    include("gestionar_caso.html");
    echo "Se ha actualizado el caso correctamente";
} else {
    echo mysqli_error($conexion);
}

?>


