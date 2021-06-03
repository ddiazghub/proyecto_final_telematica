<?php

include 'db.php';

$nombre_x = $_POST['nombre_x'];
$apellido_x = $_POST['apellido_x'];
$cedula_x = $_POST['cedula_x'];
$Sexo= $_POST['Sexo'];
$fecha_de_nacimiento = $_POST['fecha_de_nacimiento'];
$direccion_de_residencia = $_POST['direccion_de_residencia'];
$direccion_de_trabajo = $_POST['direccion_de_trabajo'];
$Resultados= $_POST['Resultados'];
$fecha_de_examen = $_POST['fecha_de_examen'];



if ($Resultados == "Positivo") {
    $Resultados = "En Tratamiento Casa";
}

$query = "INSERT INTO casos(nombre_x, apellido_x, cedula_x, Sexo, fecha_de_nacimiento, direccion_de_residencia, direccion_de_trabajo, estados, fechas_estados)
                    VALUES('$nombre_x', '$apellido_x', '$cedula_x', '$Sexo', '$fecha_de_nacimiento', '$direccion_de_residencia', '$direccion_de_trabajo', '$Resultados', '$fecha_de_examen')";

$ejecutar = mysqli_query($conexion ,$query);

if ($ejecutar) {
    include("registro_de_casos.html");

    echo "Se ha registrado el caso correctamente.";

} else {
    echo "Error";
}

?>