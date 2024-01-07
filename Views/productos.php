<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php require "../util/depurar.php" ?>
    <?php require "../util/conexion.php"?>
</head>
<!-- Falta la imagen -->

<body>


    <?php
    if (
        $_SERVER["REQUEST_METHOD"] == "POST" &&
        $_POST["formulario"] == "insertar"
    ) {
        $temp_name = depurar($_POST["name"]);
        $temp_price = depurar($_POST["price"]);
        $temp_descrip = depurar($_POST["description"]);
        $temp_quantity = depurar($_POST["quantity"]);
        
        $nombre_imagen = $_FILES["img"]["name"];
        $ruta_temporal = $_FILES["img"]["tmp_name"];
        $ruta_final = "images/" . $nombre_imagen;
        move_uploaded_file($ruta_temporal, $ruta_final); 

        //  Valido el nombre del producto
        if (strlen($_POST["name"]) == 0) {
            $err_name = "*El nombre es obligatorio";
        } else {
            if (strlen($temp_name) > 40) {
                $err_name = "*El nombre debe tener máximo 40 caracteres";
            } else if (!preg_match("/^[a-zA-ZñÑáÁéÉíÍóÓúÚ 0-9]{0,40}$/", $temp_name)) {
                $err_name = "*EL nombre solo puede contener u mayusculas, minúsculas, ñ, acentosy números";
            } else {
                $name = $temp_name;
            }
        }
        // Valido el precio del producto
        if (strlen($_POST["price"]) == 0) {
            $err_price = "*El precio es obligatorio";
        } else {
            $temp_price = filter_var($temp_price, FILTER_VALIDATE_FLOAT);

            if (!$temp_price) {
                $err_price = "*El precio debe ser un número";
            } else {
                if ($temp_price < 0 || $temp_price>99999.99) {
                    $err_price = "*El precio debe ser mayor o igual a 0 y menor o igual a 99999.99";
                }
                else if (!preg_match('/^[0-9]{1,}$/', $temp_price)) {
                    $err_price = "*EL precio solo admite cantidades numéricas";
                } else {
                    $price = $_POST["price"];
                    $price = (float)$price;
                }
            }
        }

        //Valido la descripción del producto
        if (strlen($_POST["description"]) == 0) {
            $err_descrip = "*La descripción es obligatoria";
        } else {

            if (strlen($temp_descrip) > 255) {
                $err_descrip = "*La descripción puede contener como máximo 255 caracteres";
            } else if (!preg_match("/^[a-zA-ZñÑáÁéÉíÍóÓúÚ 0-9]{0,255}$/", $temp_descrip)) {
                $err_descrip = "*La descripción solo puede contener mayusculas, minúsculas, ñ, acentos y números";
            } else {
                $descrip = $temp_descrip;
            }
        }
        // Valido la cantidad de stock del producto
        if (strlen($_POST["quantity"]) == 0) {
            $err_quantity = "*La cantidad es obligatoria";
        } else {
            $temp_quantity = filter_var($temp_quantity, FILTER_VALIDATE_INT);
            if (!$temp_quantity) {
                $err_quantity = "*La cantidad debe ser un numérica";
            } else {
                if ($temp_quantity < 0 || $temp_quantity > 99999) {
                    $err_quantityt = "*La cantidad debe ser mayor o igual a cero y menor o igual a 99999";
                }
                else if (!preg_match('/^[0-9]{1,}$/', $temp_quantity)) {
                    $err_quantity = "*La cantidad solo admite cifras numéricas";
                } else {
                    $quantity = $_POST["quantity"];
                }
            }
        }
    }

    

    ?>
    <div class="container">
    <h2>Insertar productos</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <!-- maximo 40 char,acepta de a-z en min y mayusc, ñ y acentos -->
        <label class="form-label" for="nameProduct">Nombre del Producto: </label>
        <input class="form-control" type="text" name="name"></input>
        <?php if (isset($err_name)) echo $err_name; ?>
        <br><br>
        <!-- entre 1 y 9 -->
        <label class="form-label" for="price">Precio del Producto: </label>
        <input class="form-control" type="text" name="price"></input>
        <?php if (isset($err_price)) echo $err_price; ?>
        <br><br>
        <!-- maximo 255 char -->
        <label class="form-label" id="description"> Descripción del producto:</label>
        <input class="form-control" type="text" name="description"></input>
        <?php if (isset($err_descrip)) echo $err_descrip; ?>
        <br><br>
        <!-- entre 0 y 9 -->
        <label class="form-label" id="Quantity"> Cantidades del Producto:</label>
        <input class="form-control" type="text" name="quantity"></input>
        <?php if (isset($err_quantity)) echo $err_quantity; ?>
        <br><br>
        <label class="form-label">Imagen</label> 
        <input class="form-control" type="file" name="img"> 
        <br><br>
        <input type="hidden" name="formulario" value="insertar">
        <input class="btn btn-primary" type="submit" value="Insertar producto">
        
    </form>
    </div>
    <?php
     if(isset($name) && isset($price) && isset($descrip) && isset($quantity) && isset($ruta_final) ){
        //aqui meto un if isset para comorobar que se haga una vez está todo declarado correctamente
    $sql = "INSERT INTO Productos (nombre_producto, Precio, Descripción, Cantidad, img) VALUES ('$name', '$price', '$descrip', '$quantity', '$ruta_final')";
    $conexion -> query($sql);
//    && isset($ruta_final) , img , '$ruta_final' retiro esto porque simplemente me da fallo, no bien implementado

     }
     ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>