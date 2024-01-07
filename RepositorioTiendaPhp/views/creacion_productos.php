<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar nuevos productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <?php require '../util/conexion.php'; ?>
    <?php require '../util/depurar.php'; ?>
    <link rel="stylesheet" href="./styles/styles.css">
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['user'])) {
        if (($_SESSION['rol']) != 'admin') {
            header("Location:iniciar_sesion.php");
        }
    }
    // Trabajamos con variables temporales para comprobar que existe todo
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Comprobamos si cada campo está relleno
        if (isset($_POST["name"])) {
            $temp_nombre = depurar($_POST["name"]);
        } else {
            $temp_nombre = "";
        }
        if (isset($_POST["price"])) {
            $temp_precio = depurar($_POST["price"]);
        } else {
            $temp_precio = "";
        }
        if (isset($_POST["description"])) {
            $temp_descripcion = depurar($_POST["description"]);
        } else {
            $temp_descripcion = "";
        }
        if (isset($_POST["amount"])) {
            $temp_cantidad = depurar($_POST["amount"]);
        } else {
            $temp_cantidad = "";
        }
        $imagen = $_FILES["imagen"]["name"];
        $imagenFinal = "images/" . $imagen;

        // Validación y patrón de nombres
        if (!strlen($temp_nombre) > 0) {
            $err_nombre = "El nombre es obligatorio";
        } elseif (strlen($temp_nombre) > 40) {
            $err_nombre = "No puede contener más de 40 caracteres";
        } else {
            $patron = "/^[a-zñáéíóúA-ZÑÁÉÍÓÚ0-9\s]{1,40}$/";
            if (!preg_match($patron, $temp_nombre)) {
                $err_nombre = "Debe tener al menos un caracter y menos de 40 caracteres y que sean letras, números y espacios";
            } else {
                $nombre = $temp_nombre;
            }
        }
        // Validación de precios
        if (!strlen($temp_precio) > 0) {
            $err_precio = "El precio es obligatorio";
        } else {
            $temp_precio = (float) $temp_precio;
            if ($temp_precio < 0 || $temp_precio > 99999.99) {
                $err_precio = "El precio tiene que ser entre 0 y 99999.99";
            } else {
                $precio = $temp_precio;
            }
        }
        // Validación de descripción
        if (!strlen($temp_descripcion) > 0) {
            $err_descripcion = "La descripción es obligatoria";
        } elseif (strlen($temp_descripcion) > 255) {
            $err_descripcion = "La descripción no puede tener más de 255 caracteres";
        } else {
            $descripcion = $temp_descripcion;
        }
        // Validación de cantidad
        if (!strlen($temp_cantidad) > 0) {
            $err_cantidad = "La cantidad es obligatoria";
        } else {
            $temp_cantidad = (int) $temp_cantidad;
            if ($temp_cantidad < 0 || $temp_cantidad > 99999) {
                $err_cantidad = "La cantidad tiene que ser entre 0 y 99999";
            } else {
                $cantidad = $temp_cantidad;
            }
        }
        // Validación de imagen
        if (!isset($imagen)) {
            $err_imagen = "La imagen es obligatoria";
        } else {
            move_uploaded_file($_FILES['imagen']['tmp_name'], $imagenFinal);
        }

    }
    ?>
    <div class=container>
        <h1>Insertar nuevos productos</h1>
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="principal.php">Inicio</a>
            <?php
            if (isset($_SESSION["usuario"])) {
            ?>
                <a class="navbar-brand" href="../util/cerrarSesion.php">Cerrar sesion</a>
                <a class="navbar-brand" href="cesta.php">Cesta</a>
            <?php
            }
            ?>
        </nav>

        <form action="" method="POST" class="mb-3" enctype="multipart/form-data">
            <label for="exampleFormControlInput1" class="form-label">Nombre producto:</label>
            <input type="text" name="name">
            <?php
            if (isset($err_nombre)) {
                echo $err_nombre;
            }
            ?>
            <br><br>
            <label for="price">Precio:</label>
            <input type="text" name="price">
            <?php
            if (isset($err_precio)) {
                echo $err_precio;
            }
            ?>
            <br><br>
            <label for="description">Descripción:</label>
            <input type="text" name="description">
            <?php
            if (isset($err_descripcion)) {
                echo $err_descripcion;
            }
            ?>
            <br><br>
            <label for="amount">Cantidad:</label>
            <input type="text" name="amount">
            <?php
            if (isset($err_cantidad)) {
                echo $err_cantidad;
            }
            ?>
            <br><br>
            <label for="image">Imagen:</label>
            <input type="file" name="imagen" id="imagen">
            <?php
            if (isset($err_imagen)) {
                echo $err_imagen;
            }
            ?>
            <br><br>
            <input type="submit" class="btn btn-primary" value="Crear producto">
        </form>
        <?php
        if (isset($nombre) && isset($precio) && isset($descripcion) && isset($cantidad) && isset($imagen)) {
            echo "<h3>¡Producto introducido con éxito!</h3>";

            $sql = "INSERT INTO productos VALUES (null,'$nombre', '$precio', '$descripcion', '$cantidad', '$imagen')";

            $conexion->query($sql);
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>