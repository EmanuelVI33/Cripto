<?php

function cifrarPorDecimacionPura($mensaje, $factorDecimacion, $modulo)
{
    $mensajeCifrado = '';
    $alfabeto = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'Ñ', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

    for ($i = 0; $i < strlen($mensaje); $i++) {
        $caracter = $mensaje[$i];
        if (in_array($caracter, $alfabeto)) {
            $indice = array_search($caracter, $alfabeto);
            $indiceCifrado = ($factorDecimacion * $indice) % $modulo;
            $caracterCifrado = $alfabeto[$indiceCifrado];
            $mensajeCifrado .= $caracterCifrado;
        } else {
            $mensajeCifrado .= $caracter;
        }
    }

    return $mensajeCifrado;
}

function descifrarPorDecimacionPura($mensajeCifrado, $factorDecimacion, $modulo)
{
    $mensajeDescifrado = '';
    $alfabeto = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'Ñ', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

    for ($i = 0; $i < strlen($mensajeCifrado); $i++) {
        $caracterCifrado = $mensajeCifrado[$i];
        if (in_array($caracterCifrado, $alfabeto)) {
            $indiceCifrado = array_search($caracterCifrado, $alfabeto);
            $indiceDescifrado = (modInverse($factorDecimacion, $modulo) * $indiceCifrado) % $modulo;
            $caracterDescifrado = $alfabeto[$indiceDescifrado];
            $mensajeDescifrado .= $caracterDescifrado;
        } else {
            $mensajeDescifrado .= $caracterCifrado;
        }
    }

    return $mensajeDescifrado;
}

function modInverse($a, $n)
{
    $t = 0;
    $nt = 1;
    $r = $n;
    $nr = $a % $n;

    while ($nr != 0) {
        $quot = intval($r / $nr);
        $tmp = $nt;
        $nt = $t - $quot * $nt;
        $t = $tmp;
        $tmp = $nr;
        $nr = $r - $quot * $nr;
        $r = $tmp;
    }

    if ($r > 1) {
        return -1; // No existe el inverso modular
    }

    if ($t < 0) {
        $t += $n;
    }

    return $t;
}
$factor = $_POST['factor'];
$modulo = $_POST['modulo'];
$text = $_POST['texto'];
$tarea = $_POST['tarea'];

// $factorDecimacion = 20;
// $modulo = 27;

if ($tarea === 'encriptar') {
    $mensajeCifrado = cifrarPorDecimacionPura($text, $factor, $modulo);
    $reponse = array('status' => 'success', 'message' => $mensajeCifrado);
} else {
    $mensajeDescifrado = descifrarPorDecimacionPura($text, $factor, $modulo);
    $reponse = array('status' => 'success', 'message' => $mensajeDescifrado);
}
echo json_encode($reponse);

?>