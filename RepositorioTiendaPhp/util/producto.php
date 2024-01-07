<?php
class Producto {
    public int $idProducto;
    public String $nombreProducto;
    public float $precio;
    public String $descripcion;
    public float $cantidad;
    public String $imagen;

    public function __construct($idProducto, $nombreProducto, $precio, $descripcion, $cantidad, $imagen) {
        $this->idProducto = $idProducto;
        $this->nombreProducto = $nombreProducto;
        $this->precio = $precio;
        $this->descripcion = $descripcion;
        $this->cantidad = $cantidad;
        $this->img = $imagen;
    }
}
?>