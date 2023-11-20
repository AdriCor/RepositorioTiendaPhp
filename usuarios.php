<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <?php require "depurar.php"?>
</head>

<body>
    <?php
    if (
        $_SERVER["REQUEST_METHOD"] == "POST" &&
        $_POST["formulario"] == "insertar" //condicion para que cuando se pulse el boton con de insertar haga todas las validaciones siguientes
    ) { 
        // Con esto marco que me es necesario de ese archivo en esta funcion en concreto 

        $temp_usu = depurar($_POST["nameUsu"]);
        $temp_pass= depurar($_POST["contraseña"]);
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
        if (strlen($_POST["contraseña"]) ==0) {
            $err_pass = "*La contraseña es obligatoria";
        } else {

            if (strlen($temp_pass) > 255) {
                $err_pass = "*La contraseña puede contener como máximo 255 caracteres";
            } else if (!preg_match("/^[a-zA-Z 0-9]{0,255}$/", $temp_pass)) {
                $err_pass = "*La contraseña solo puede contener mayusculas, minúsculas, ñ y números";
            } else {
                $contraseña = $temp_pass;
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
    <h2>Registrarse</h2>
    <form action="cesta.php" method="post"> <!-- preguntar si es correcto e laction -->
        <!-- 4-12 char,acepta de a-z en min y mayusc, ñ, acentos y _ -->
        <label >Nombre de Ususario: </label>
        <input type="text" name="nameUsu"></input>
        <?php if (isset($err_usu)) echo $err_usu; ?>
        <br><br>
        <!-- maximo 255 char -->
        <label id="contraseña"> Contraseña:</label>
        <input type="text" name="contraseña"></input>
        <?php if (isset($err_pass)) echo $err_pass; ?>
        <br><br>
        <label id="edad"> Fecha de nacimiento:</label>
        <input type="date" name="edad"></input>
        <?php if (isset($err_edad)) echo $err_edad; ?>
        <br><br>
        <input type="hidden" name="formulario" value="insertar">
<!--Queda que cuando se inserte el usuario correctamente se cree una cesta con un precio total de 0, por ahora.-->
        <input type="submit"  name="creacionCesta" value="Insertar usuario">
    </form>


</body>

</html>