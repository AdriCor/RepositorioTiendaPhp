<?php
$_servidor='localhost';
$_usuario='root';
$_contrasena='medac'; //en casa la otra contraseña
$_base_de_datos='db_tienda';
$conexion= new Mysqli($_servidor, $_usuario,$_contrasena,$_base_de_datos)
    or die("Error de conexion")
?>