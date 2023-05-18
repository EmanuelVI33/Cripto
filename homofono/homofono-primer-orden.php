<?php
// Alfabeto homofónico
$alfabetoHomofonico = array(
    'A' =>[191, 83, 37],
    'B' =>[237, 116, 243],
    'C' =>[261, 56, 176, 59],
    'D' =>[60, 8, 223, 230, 126],
    'E' =>[250, 147, 86, 71, 10, 43, 160],
    'F' =>[139, 120, 148, 227],
    'G' =>[254, 109, 46, 105, 32],
    'H' =>[236, 220, 145, 213, 17],
    'I' =>[134],
    'J' =>[172, 163, 205, 240],
    'K' =>[65, 260, 222, 184, 6],
    'L' =>[266],
    'M' =>[38, 210],
    'N' =>[54, 47, 193, 199, 4],
    'Ñ' =>[162, 33, 75, 41, 235, 159],
    'O' =>[186],
    'P' =>[121, 118, 132, 216],
    'Q' =>[232, 78, 11, 138, 156],
    'R' =>[150, 225, 45, 51, 1, 35],
    'S' =>[77, 129, 154, 144],
    'T' =>[135, 140, 188],
    'U' =>[115, 212, 229, 27, 70],
    'V' =>[48],
    'W' =>[136, 18, 130],
    'X' =>[82, 88, 219, 149, 178],
    'Y' =>[102, 133, 177],
    'Z' =>[179, 239]
);

function cifrarMensaje($mensaje) {
    global $alfabetoHomofonico;
    $mensajeCifrado = '';

    foreach (str_split($mensaje) as $letra) {
        $letraMayuscula = strtoupper($letra);
        if (array_key_exists($letraMayuscula, $alfabetoHomofonico)) {
            $simbolos = $alfabetoHomofonico[$letraMayuscula];
            $simboloCifrado = $simbolos[array_rand($simbolos)];
            $mensajeCifrado .= $simboloCifrado . ' ';
        } else {
            $mensajeCifrado .= $letra . ' ';
        }
    }

    return trim($mensajeCifrado);
}

function descifrarMensaje($mensajeCifrado) {
    global $alfabetoHomofonico;
    $mensajeDescifrado = '';

    foreach (explode(' ', trim($mensajeCifrado)) as $simboloCifrado) {
        $letraEncontrada = false;
        foreach ($alfabetoHomofonico as $letra => $simbolos) {
            if (in_array($simboloCifrado, $simbolos)) {
                $mensajeDescifrado .= $letra;
                $letraEncontrada = true;
                break;
            }
        }

        if (!$letraEncontrada) {
            $mensajeDescifrado .= $simboloCifrado;
        }
    }

    return $mensajeDescifrado;
}

$mensajeOriginal = 'BAJA ME LA JAULA JAIME';

$mensajeCifrado = cifrarMensaje($mensajeOriginal);
echo 'Mensaje cifrado: ' . $mensajeCifrado . '<br>';

$mensajeDescifrado = descifrarMensaje($mensajeCifrado);
echo 'Mensaje descifrado: ' . $mensajeDescifrado . '<br>';
