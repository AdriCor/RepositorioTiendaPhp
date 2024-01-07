<?php
    class productoCesta{
        public string $nombre;
        public float $precio;
        public string $imagen;
        public int $cantidad;

        function __construct(string $nombre, float $precio, string $imagen, int $cantidad){
            $this->nombre = $nombre;
            $this->precio = $precio;
            $this->imagen = $imagen;
            $this->cantidad = $cantidad;
        }
    }
?>