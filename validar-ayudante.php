<?php
include('db.php');
$usuario=$_POST['usuario'];
$contraseña=$_POST['contraseña'];
session_start();
$_SESSION['usuario']=$usuario;


$conexion=mysqli_connect("localhost","root","12345","login");

$consulta="SELECT*FROM ayudantes where usuario='$usuario' and contraseña='$contraseña'";
$resultado=mysqli_query($conexion,$consulta);

$filas = mysqli_num_rows($resultado);




if($filas){
  
    header("location:registro_casos.html");
   

}else{
    ?>
    <?php
    include("login-ayudante.html");

  ?>
  <h1 class="bad">ERROR DE AUTENTIFICACION</h1>
  <?php
}

mysqli_free_result($resultado);
mysqli_close($conexion);
