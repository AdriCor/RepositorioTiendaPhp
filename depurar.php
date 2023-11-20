<?php
	function depurar($dato) {
    	$dato = trim($dato); //retiramos los espacios en blanco
    	$dato = stripslashes($dato);  // retiramos las barras de un string
    	$dato = htmlspecialchars($dato); //con esto retiramos los caracteres especiales del string
    	return $dato; //devolvemos el dato ya completamente depurado, listo para poderlo utilizar en nuestras validaciones y base de datos.
	}
?>
