<?php
//     usuario VARCHAR (12) NOT NULL ,
// FOREIGN KEY (usuario) REFERENCES usuarios(usuario),  --De esto no tengo ni pajolera ahora, escribiendo esto, preguntar--,
// precioTotal NUMERIC(7,2) NOT NULL 
class Producto{
    public string $ID;
    public string $NombreProd;
    public int $Precio;
    public string $Descripcion;
    public int $Cantidad;
    public string $img;
    function __construct($ID,$NombreProd, $Precio, $Descripcion, $Cantidad, $img) {
        $this->ID = $ID;
        $this->NombreProd = $NombreProd;
        $this->Precio = $Precio;
        $this->Descripcion = $Descripcion;
        $this->Cantidad = $Cantidad;
        $this->img = $img;
    }
}
?>