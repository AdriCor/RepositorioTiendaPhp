<?php
//     usuario VARCHAR (12) NOT NULL ,
// FOREIGN KEY (usuario) REFERENCES usuarios(usuario),  --De esto no tengo ni pajolera ahora, escribiendo esto, preguntar--,
// precioTotal NUMERIC(7,2) NOT NULL 
class Producto{
    public $ID="SELECT id_producto FROM productos WHERE nombre_producto='$NombreProd'";
    public $NombreProd;
    public $Precio;
    public $Descripcion;
    public $Cantidad;
    public function constructor($NombreProd, $Precio, $Descripcion, $Cantidad) {
        $this->$NombreProd = $NombreProd;
        $this->Precio = $Precio;
        $this->$Descripcion = $Descripcion;
        $this->$Cantidad = $Cantidad;
    }

    public function setID($ID) {
        $this->ID = $ID;
    }
    public function getID($ID) {
        return $this->ID ;
    }
    public function setNombreProd($NombreProd) {
        $this->NombreProd = $NombreProd;
    }
    public function getNombreProd($NombreProd) {
        return $this->NombreProd ;
    }
    public function setPrecio($Precio) {
        $this->Precio = $Precio;
    }
    public function getPrecio($Precio) {
        return $this->Precio ;
    }
    public function setDescripcion($Descripcion) {
        $this->Descripcion = $Descripcion;
    }
    public function getDescripcion($Descripcion) {
        return $this->Descripcion ;
    }
    public function setCantidad($Cantidad) {
        $this->Cantidad= $Cantidad;
    }
    public function getCantidad($Cantidad) {
        return $this->Cantidad ;
    }


   
    
    
}




?>