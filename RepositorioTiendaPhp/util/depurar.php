<?php
function depurar($entrada){
    $salida = htmlspecialchars($entrada);
    $salida = trim($salida);
    return $salida;
}
?>