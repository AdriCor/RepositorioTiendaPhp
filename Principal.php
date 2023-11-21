<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <?php require 'conexion.php' ?>
</head>
<body>
    <?php
    session_start();

    if(isset($_SESSION["usuario"])) {
        $usuario = $_SESSION["usuario"];
    } else {
        //header('location: iniciar_sesion.php');
        $_SESSION["usuario"] = "invitado";
        $usuario = $_SESSION["usuario"];
    }
    ?>
    <table>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Descripción</th>
            <th>Cantidad</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($Productos as => $producto) {?>
            <tr>
                <td><?php echo $producto ->?></td>
            </tr>
            

        <?php
        }
        ?>
        </tbody>
        
    </table>


    <div class="container">
        <h1>Página principal</h1>
        <h2>Bienvenid@ <?php echo $usuario ?></h2>

        <a href="cerrar_sesion.php">Cerrar sesión</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>