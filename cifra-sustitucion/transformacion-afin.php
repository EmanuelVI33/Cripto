<?php

function cifradoAfin($mensaje, $a, $b)
{
    $alfabeto = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'Ñ', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
    $n = count($alfabeto);
    $cifrado = '';

    $mensajeArray = str_split($mensaje);

    foreach ($mensajeArray as $letra) {
        if ($letra === ' ') {
            $cifrado .= ' ';
            continue;
        }

        $mi = array_search($letra, $alfabeto);
        $ci = ($a * $mi + $b) % $n;
        $cifrado .= $alfabeto[$ci];
    }

    return $cifrado;
}

function descifradoAfin($mensajeCifrado, $a, $b)
{
    $alfabeto = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'Ñ', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
    $n = count($alfabeto);
    $descifrado = '';

    $a_inverse = modInverseA($a, $n);
    $mensajeArray = str_split($mensajeCifrado);
    foreach ($mensajeArray as $letra) {
        if ($letra === ' ') {
            $descifrado .= ' ';
            continue;
        }

        $ci = array_search($letra, $alfabeto);
        $mi = ($a_inverse * ($ci - $b)) % $n;
        if ($mi < 0) {
            $mi += $n;
        }
        $descifrado .= $alfabeto[$mi];
    }

    return $descifrado;
}

function modInverseA($a, $n)
{
    $t = 0;
    $newt = 1;
    $r = $n;
    $newr = $a;

    while ($newr != 0) {
        $cociente = intdiv($r, $newr);
        $temp = $newt;
        $newt = $t - $cociente * $newt;
        $t = $temp;
        $temp = $newr;
        $newr = $r - $cociente * $newr;
        $r = $temp;
    }

    if ($r > 1) {
        return -1; // El inverso modular no existe
    }

    if ($t < 0) {
        $t += $n;
    }

    return $t;
}

$decimacion = $_POST['decimacion'];
$desplazamiento = $_POST['desplazamiento'];

$text = $_POST['texto'];
$tarea = $_POST['tarea'];


if ($tarea === 'encriptar') {
    $mensajeCifrado = cifradoAfin($text, $decimacion, $desplazamiento);
    $response = array('status' => 'success', 'message' => $mensajeCifrado);
} else {
    $mensajeDescifrado = descifradoAfin($text, $decimacion, $desplazamiento);
    $response = array('status' => 'success', 'message' => $mensajeDescifrado);
}
echo json_encode($response);
?>
