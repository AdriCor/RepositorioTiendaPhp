<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>página principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <?php require 'conexion.php' ?>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
<?php
    session_start();

    if(isset($_SESSION["usuario"])) {
        $usuario = $_SESSION["usuario"];
    } else {
        $_SESSION["usuario"] = "invitad@";
        $usuario = $_SESSION["usuario"];
    }
    
    ?>

<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="principal.php">Lista de productos</a>
  <a class="navbar-brand" href="iniciar_sesion.php">Iniciar sesión</a>
  <a class="navbar-brand" href="Micesta.php">Productos de mi cesta</a> <!--añadir aqui el total del precio de cesta-->
</nav>
    <div class="container">
        <h1>Mi cesta</h1>  
    </div>

    <div>
        <table class="table table-striped table-hover">
            <thead class="table table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>cantidad</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $sql = "SELECT * FROM productoscestas";
                $resultado = $conexion -> query($sql);

                while($fila = $resultado -> fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $fila['nombre_producto'] . "</td>";
                    echo "<td>" . $fila['Precio'] . "</td>";
                    echo "<td>" . $fila['Cantidad'] . "</td>";
                    echo "<td>"; 
                    ?>
                    <img witdh="50" height="100" src="<?php echo $fila["img"] ?>">
                    <?php 
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="cerrarSesion.php">Cerrar sesión</a>
    </div> 
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>