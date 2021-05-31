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
   
           <form action="registro_de_casos.php"  method="POST"  class="formulario__register">

            <h2>Registrarse</h2>
            <input type="text" placeholder="Nombre" name="nombre_x">
            <input type="text" placeholder="Apellido" name="apellido_x">
            <input type="int" placeholder="Cedula"  name="cedula_x">
            
            <select name = "Sexo">
            
            <option>---Sexo---</option>
            <option value="Masculino">Masculino</option>

            <option value="Femenino">Femenino</option>
            
             </select>


            <input type="date" id="start" name="fecha_de_nacimiento"
            value="2018-07-22"
            min="1900-01-01" max="2022-01-01">
            
            <input type="text" placeholder="Direccion de residencia" name="direccion_de_residencia">
            <input type="text" placeholder="Direccion de trabajo" name="direccion_de_trabajo">

            
            
            <select name = "Resultados">
            <option>---Resultados---</option>

            <option value="positivo">Positivo</option>

            <option value="negativo">Negativo</option>

    
            
             </select>
                        
            
         <input type="date" id="start"  name="fecha_de_examen"
            value="2018-07-22"
            min="1900-01-01" max="2022-01-01">

            <button>Entrar</button>

           </form>     
        
            </div>


        </main>

    </body>
</html>

