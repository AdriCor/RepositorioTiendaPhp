<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php require "depurar.php"?>
    <?php require "conexion.php"?>
</head>

<body>
<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="principal.php">Lista de productos</a>
  <a class="navbar-brand" href="iniciar_sesion.php">Iniciar sesión</a>
  <a class="navbar-brand" href="Micesta.php">Mi cesta</a>
  <a class="navbar-brand" href="usuarios.php">Registrarse</a>
</nav>
    <div class="container">
        <h1>Registrarse</h1>  
    </div>

    <?php

    if (
        $_SERVER["REQUEST_METHOD"] == "POST" &&
        $_POST["formulario"] == "insertar" //condicion para que cuando se pulse el boton con de insertar haga todas las validaciones siguientes
    ) { 
        // Con esto marco que me es necesario de ese archivo en esta funcion en concreto 

        $temp_usu = depurar($_POST["nameUsu"]);
        $temp_pass= depurar($_POST["contrasena"]);
        $temp_edad=depurar($_POST["edad"]);


        //  Valido el usuario
        if (strlen($_POST["nameUsu"]) ==0) { 
            $err_usu = "*El usuario es obligatorio";
        } else {
            if (strlen($temp_usu) > 12 || strlen($temp_usu) < 4) {
                $err_usu = "*El usuario debe tener entre 4 y 12 caracteres";
            } else if (!preg_match("/^[a-zA-ZñÑáÁéÉíÍóÓúÚ]{4,12}$/", $temp_usu)) {
                $err_usu = "*EL usuario solo puede contener mayusculas, minúsculas, ñ y acentos";
            } else {
                $usuario = $temp_usu;
            }
        }

        //Valido la contraseña
        if (strlen($_POST["contrasena"]) ==0) {
            $err_pass = "*La contraseña es obligatoria";
        } else {

            if (strlen($temp_pass) > 255) {
                $err_pass = "*La contraseña puede contener como máximo 255 caracteres";
            } else if (!preg_match("/^[a-zA-Z 0-9]{0,255}$/", $temp_pass)) {
                $err_pass = "*La contraseña solo puede contener mayusculas, minúsculas, ñ y números";
            } else {
                $contrasena = $temp_pass;
            }
        }
        // Valido la edad
        if (strlen($_POST["edad"]) ==0) {
            $err_edad = "*La fecha de nacimiento es obligatoria";
        } else {
            function obtener_edad_segun_fecha($temp_edad)
            {
                $nacimiento = new DateTime($temp_edad);
                $ahora = new DateTime(date("Y-m-d"));
                $diferencia = $ahora->diff($nacimiento);
                return $diferencia->format("%y");//con esto devuelvo la diferencia de edad en formato numérico.
            }
            if (obtener_edad_segun_fecha($temp_edad) < 4 || obtener_edad_segun_fecha($temp_edad) > 120) {  
        //tengo que trabajar aqui usando la funcion por completo ya que devuelve un valor directamente que seria la diferencia, con lo que comparo para generar las condiciones
                $err_edad = "*Debes ser mayor de 12 años y menor de 120";
            } else {
                $edad = $temp_edad;
            }
        }
    }
    

    
    ?>
    <div class="container">
    <form action="" method="post"> <!-- preguntar si es correcto e laction -->
        <!-- 4-12 char,acepta de a-z en min y mayusc, ñ, acentos y _ -->
        <label class="form-label" >Nombre de Usuario: </label>
        <input class="form-control" type="text" name="nameUsu"></input>
        <?php if (isset($err_usu)) echo $err_usu; ?>
        <br><br>
        <!-- maximo 255 char -->
        <label class="form-label" id="contrasena"> Contraseña:</label>
        <input class="form-control" type="password" name="contrasena"></input>
        <?php if (isset($err_pass)) echo $err_pass; ?>
        <br><br>
        <label class="form-label" id="edad"> Fecha de nacimiento:</label>
        <input class="form-control" type="date" name="edad"></input>
        <?php if (isset($err_edad)) echo $err_edad; ?>
        <br><br>
        <input type="hidden" name="formulario" value="insertar">
<!--Queda que cuando se inserte el usuario correctamente se cree una cesta con un precio total de 0, por ahora.-->
<input class="btn btn-primary" type="submit" value="Registrarse">
    </form>
     <?php
     if(isset($usuario) && isset($contrasena) && isset($edad)) {
        $sql1 = "INSERT INTO usuarios (usuario, contraseña, fecha_nacimiento) VALUES ('$usuario', '$contrasena', '$edad')";
        $conexion -> query($sql1);
        $sql2 = "INSERT INTO cestas (usuario, precioTotal) VALUES ('$usuario','0')";
        $conexion -> query($sql2);
     }
     ?>
     </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>