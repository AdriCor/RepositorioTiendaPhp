<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <?php require '../util/conexion.php'; ?>
    <?php require '../util/depurar.php'; ?>
    <link rel="stylesheet" href="./styles/styles.css">
</head>
<body class="login"></body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["user"])) {
            $temp_usuario = depurar($_POST["user"]);
        } else {
            $temp_usuario = "";
        }
        if (isset($_POST["pass"])) {
            $temp_pass = depurar($_POST["pass"]);
        } else {
            $temp_pass = "";
        }

        $sql = "SELECT * FROM usuarios WHERE usuario = '$temp_usuario'";
        // Guardamos en la variable resultado la query de arriba
        $resultado = $conexion->query($sql);

        while ($row = $resultado->fetch_assoc()) {
            $contrasena_cifrada = $row["contraseña"];
            $rol = $row["rol"];
        }

        if ($resultado->num_rows == 0) {
            ?>
            <div class="alert alert-danger" role="alert">
                El usuario no es válido
            </div>
            <?php

        } else {
            $acceso = password_verify($temp_pass, $contrasena_cifrada);
            if ($acceso == FALSE) {
                ?>
                <div class="alert alert-danger" role="alert">
                    La contraseña no es válida
                </div>
                <?php

            } else {
                echo "¡Validación correcta!";
                session_start();
                $_SESSION["user"] = $temp_usuario;
                $_SESSION["rol"] = $rol;
                header("Location:principal.php");
            }
        }
    }
    ?>
    <div class = "login">
    <h1>Iniciar sesión</h1>
    <form action="" method="POST" class="mb-3">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Usuario</label>
            <input type="text" name="user">
        </div>
        <div class="mb-3">
            <label for="pass" class="form-label">Contraseña</label>
            <input type="password" name="pass">
        </div>
        <input type="submit" class="btn btn-primary" value="Iniciar sesión">
        <p>Si no tienes cuenta de usuario, registrate <a href="./registro_usuarios.php">aquí</a></p>
    </form>
    </div>
</body>
</html>