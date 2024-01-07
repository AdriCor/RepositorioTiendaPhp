<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/styles.css">
    <?php require '../util/conexion.php'; ?>
    <?php require '../util/depurar.php'; ?>
</head>

<body class="register">
    <?php
    $temp_usuario = "";
    $temp_pass = "";
    $birthDate = "";
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
        if (isset($_POST["birthDate"])) {
            $temp_fechaNacimiento = depurar($_POST["birthDate"]);
        } else {
            $temp_fechaNacimiento = "";
        }
        // Validamos los campos
        if (strlen($temp_usuario) == 0) {
            $err_usuario = "El nombre es obligatorio";
        } elseif (strlen($temp_usuario) < 4 || strlen($temp_usuario) > 12) {
            $err_usuario = "El nombre tiene que tener entre 4 y 12 caracteres";
        } else {
            $patron = "/^[a-zñáéíóúA-ZÑÁÉÍÓÚ0-9\s]{1,40}$/";
            if (!preg_match($patron, $temp_usuario)) {
                $err_usuario = "Debe tener al menos un caracter y menos de 40 caracteres y que sean letras, números y espacios";
            } else {
                $user = $temp_usuario;
            }
        }
        if (strlen($temp_pass) == 0) {
            $err_pass = "La contraseña es obligatoria";
        } elseif (strlen($temp_pass) >= 255) {
            $err_pass = "La contraseña tiene que tener hasta 255 caracteres";
        } else {
            $pass = $temp_pass;
        }
        $birthDate = "";
        if (empty($temp_fechaNacimiento)) {
            $err_fechaNacimiento = "La fecha de nacimiento es obligatoria";
        } else {
            $birthDate = $temp_fechaNacimiento;
        }

    }

    if (!isset($err_usuario) && !isset($err_pass) && !isset($err_fechaNacimiento) && !empty($birthDate)) {
        $usuario = $temp_usuario;
        $pass = $temp_pass;
        $contrasena_cifrada = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (usuario, contraseña, fecha_nacimiento)
        VALUES ('$usuario', '$contrasena_cifrada', '$birthDate')";
        $conexion->query($sql);
        $alert_exito = "<div class='alert alert-success mt-5' role='alert'>
        Cuenta creada con éxito
        </div>";
    }
    ?>
    <div class="login">
    <h2>Registro de sesión.</h2>
    <form action="" method="POST" class="mb-3">
        <div class="mb-3">
            <label for="user" class="form-label">Usuario</label>
            <input type="text" id="user" name="user">
            <?php
            if (isset($err_usuario)) {
                echo $err_usuario;
            }
            ?>
        </div>
        <div class="mb-3">
            <label for="pass" class="form-label">Contraseña</label>
            <input type="password" id="pass" name="pass">
            <?php
            if (isset($err_pass)) {
                echo $err_pass;
            }
            ?>
        </div>
        <div class="mb-3">
            <label for="birthDate" class="form-label">Fecha de nacimiento</label>
            <input type="date" id="birthDate" name="birthDate">
            <?php
            if (isset($err_fechaNacimiento)) {
                echo $err_fechaNacimiento;
            }
            ?>
        </div>
        <input type="submit" class="btn btn-info" value="Registrarse">
        <?php if (isset($alert_exito))
            echo $alert_exito ?>
            <p>Si ya te has registrado, puedes loguearte <a href="./iniciar_sesion.php">aquí</a></p>
        </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    </body>
  
    </html>