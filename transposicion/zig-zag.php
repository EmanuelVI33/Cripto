<?php

function zigzagEncriptar($texto, $clave)
{
    $len_texto = strlen($texto);
    $nro_fila = intval($clave);
    // echo $nro_fila . '<br></br>';
    $array_enc = array_fill(0, $nro_fila, '');
    $index = 0;
    $bandera = true;
    while ($index < $len_texto) {
        for ($j = 0; $j < $nro_fila && $index < $len_texto; $j++) {
            $x = ($nro_fila - $j - 1);

            // echo $bandera . '   ' . $x . '<br></br>';
            $bandera
                ? $array_enc[$j] .= $texto[$index]
                : $array_enc[$nro_fila - $j - 1] .= $texto[$index];
            $index++;
        }
        mostrar($array_enc);
        $bandera = !$bandera;
    }

    return implode($array_enc);
}

function mostrar($array)
{
    $len = count($array);
    for ($i = 0; $i < $len; $i++) {
        echo $array[$i] . '<br></br>';
    }
}

$text = 'cifrarailfence';
$clave = 3;
$text_cif = zigzagEncriptar($text, $clave);

echo $text . '<br></br>' . $text_cif . '<br></br>';
