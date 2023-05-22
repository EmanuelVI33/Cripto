<?php 
$text = $_POST['texto'];
$clave = $_POST['desplazamiento'];
$encriptar = $_POST['tarea'] == 'encriptar';

$text = $encriptar
    ? cifradoconpalabraclave($text, $clave)
    : descifradoconpalabraclave($text, $clave);

$reponse = array('status' => 'success', 'message' => $text);
echo json_encode($reponse);


function cifradoconpalabraclave($mensaje, $clave) {
    $mensaje = strtoupper($mensaje); // Convertimos el mensaje a mayúsculas
    $clave = strtoupper($clave); // Convertimos la clave a mayúsculas
    $mensajeCifrado = '';

    $longitudMensaje = strlen($mensaje);
    $longitudClave = strlen($clave);

    for ($i = 0; $i < $longitudMensaje; $i++) {
        $caracter = $mensaje[$i];

        if (ctype_alpha($caracter)) { // Solo ciframos letras
            $valorCaracter = ord($caracter) - 65; // Convertimos el caracter a un valor numérico de 0 a 25 (A=0, B=1, ...)
            $valorClave = ord($clave[$i % $longitudClave]) - 65; // Obtenemos el valor numérico del caracter de la clave correspondiente

            $valorCifrado = ($valorCaracter + $valorClave) % 26; // Aplicamos el desplazamiento y aseguramos que se mantenga dentro del rango de letras (0 a 25)
            $caracterCifrado = chr($valorCifrado + 65); // Convertimos el valor numérico cifrado a su correspondiente letra

            $mensajeCifrado .= $caracterCifrado;
        } else {
            $mensajeCifrado .= $caracter; // Mantenemos cualquier otro tipo de carácter sin cambios
        }
    }

    return $mensajeCifrado;
}
$mensaje = "HOLA MUNDO";
$clave = "SECRETA";

$mensajeCifrado = cifradoconpalabraclave($mensaje, $clave);
// echo "Mensaje cifrado: " . $mensajeCifrado;



function descifradoconpalabraclave($mensajeCifrado, $clave) {
    $mensajeCifrado = strtoupper($mensajeCifrado); // Convertimos el mensaje cifrado a mayúsculas
    $clave = strtoupper($clave); // Convertimos la clave a mayúsculas
    $mensajeDescifrado = '';

    $longitudMensajeCifrado = strlen($mensajeCifrado);
    $longitudClave = strlen($clave);

    for ($i = 0; $i < $longitudMensajeCifrado; $i++) {
        $caracterCifrado = $mensajeCifrado[$i];

        if (ctype_alpha($caracterCifrado)) { // Solo desciframos letras
            $valorCaracterCifrado = ord($caracterCifrado) - 65; // Convertimos el caracter cifrado a un valor numérico de 0 a 25 (A=0, B=1, ...)
            $valorClave = ord($clave[$i % $longitudClave]) - 65; // Obtenemos el valor numérico del caracter de la clave correspondiente

            $valorDescifrado = ($valorCaracterCifrado - $valorClave + 26) % 26; // Aplicamos el desplazamiento inverso y aseguramos que se mantenga dentro del rango de letras (0 a 25)
            $caracterDescifrado = chr($valorDescifrado + 65); // Convertimos el valor numérico descifrado a su correspondiente letra

            $mensajeDescifrado .= $caracterDescifrado;
        } else {
            $mensajeDescifrado .= $caracterCifrado; // Mantenemos cualquier otro tipo de carácter sin cambios
        }
    }

    return $mensajeDescifrado;
}

?>
