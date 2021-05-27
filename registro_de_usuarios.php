<?php

include 'validar.php';

$nombre_x = $_POST['nombre_x'];
$apellido_x = $_POST['apellido_x'];
$cedula_x = $_POST['cedula_x'];
$usuario_x = $_POST['usuario_x'];
$contrasena_x = $_POST['contrasena_x'];

$query = "INSERT INTO xddd(nombre_x, apellido_x, cedula_x, usuario_x, contrasena_x)
                    VALUES('$nombre_x', '$apellido_x', '$cedula_x', '$usuario_x', '$contrasena_x')";

$ejecutar = mysqli_query($conexion ,$query);


?>