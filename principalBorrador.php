<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>página principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <?php require 'conexion.php' ?>
    <?php require 'Producto.php' ?>
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
  <a class="navbar-brand" href="Micesta.php">Productos de mi cesta</a>
</nav>
    <div class="container">
        <h1>Bienvenid@ <?php echo $usuario ?></h1>  <!-- mirar como meter aquí el usuario -->
    </div>


    <?php
    $sql = "SELECT * FROM productos";
    $resultado = $conexion -> query($sql);
    $productos = [];

    while($fila = $resultado -> fetch_assoc()) {
        $nuevo_producto = new Producto(
            $fila["NombreProd"], 
            $fila["Precio"], 
            $fila["Descripcion"],
            $fila["Cantidad"],
        );
        array_push($productos, $nuevo_producto);
    }
    ?>
    <div class="container">
        <h1>Listado de películas</h1>

        <div>
            <table class="table table-striped table-hover">
                <thead class="table table-dark">
                    <tr>
                        <th>ID Producto</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Descripcion</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($productos as $producto) { ?>
                        <tr>
                            <td><?php echo $producto -> id_producto ?></td>
                            <td><?php echo $producto -> nombre_producto ?></td>
                            <td><?php echo $producto -> Precio ?></td>
                            <td><?php echo $producto -> Descripción ?></td>
                            <td><?php echo $producto -> Cantidad ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" 
                                           name="id_pelicula" 
                                           value="<?php echo $producto -> id_pelicula ?>">
                                    <input class="btn btn-warning" type="submit" value="Añadir">
                                </form>
                            </td>
                        </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        <a href="cerrarSesion.php">Cerrar sesión</a>
    </div> 
                </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>