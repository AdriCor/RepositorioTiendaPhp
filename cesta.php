<?php
//     usuario VARCHAR (12) NOT NULL ,
// FOREIGN KEY (usuario) REFERENCES usuarios(usuario),  --De esto no tengo ni pajolera ahora, escribiendo esto, preguntar--,
// precioTotal NUMERIC(7,2) NOT NULL 
class Cesta{
    public $usuario;
    public $precio;

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    public function getUsuario($usuario) {
        return $this->usuario ;
    }
    public function setPrecio($precio) {
        $this->usuario = $precio;
    }
    public function getPrecio($precio) {
        return $this->usuario ;
    }
}
?>
