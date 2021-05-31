<!DOCTYPE html>
<html lang="en">
    <head>  
       <meta charset="UTF 8">
       <META name="viewport" content="width-device-width, inital-scale-1.0">
        <title>Login y Registro</title>

    </head> 
    <body>
        
        <main>
           
            <div class="contenedor__login-register">
   
           <form action="registro_de_usuarios.php"  method="POST"  class="formulario__register">

            <h2>Registrarse</h2>
            <input type="text" placeholder="Nombre" name="nombre_x">
            <input type="text" placeholder="Apellido" name="apellido_x">
            <input type="int" placeholder="Cedula"  name="cedula_x">
            <input type="text" placeholder="Usuario"  name="usuario">
            <input type="password" placeholder="Contrasena" name="contraseña">
            
            <select name = "Rol">
            
                <option value="ayudante">Ayudante</option>

                <option value="medico">Medico</option>
                
            </select>
            
            <button>Entrar</button>

           </form>     
        
            </div>


        </main>

    </body>
</html>

