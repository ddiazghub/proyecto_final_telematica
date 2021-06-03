<?php

include 'db.php';

$nombre_x = $_POST['nombre_x'];
$apellido_x = $_POST['apellido_x'];
$cedula_x = $_POST['cedula_x'];
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];
$Rol= $_POST['Rol'];



$query = "";

if(($Rol == "ayudante")){
  
    $query = "INSERT INTO ayudantes(nombre_x, apellido_x, cedula_x, usuario, contraseña)
    VALUES('$nombre_x', '$apellido_x', '$cedula_x', '$usuario', '$contraseña')";
   

}else{
   

    $query = "INSERT INTO medicos(nombre_x, apellido_x, cedula_x, usuario, contraseña)
    VALUES('$nombre_x', '$apellido_x', '$cedula_x', '$usuario', '$contraseña')";
    
}




$ejecutar = mysqli_query($conexion ,$query);


?>


