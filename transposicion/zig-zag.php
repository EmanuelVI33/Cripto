<?php

$text = $_POST['texto'];
$clave = $_POST['clave'];
$encriptar = $_POST['tarea'] == 'encriptar';

$text = $encriptar
    ? encriptorZigZag($text, $clave)
    : descifrarZigZag($text, $clave);

$reponse = array('status' => 'success', 'message' => $text);
echo json_encode($reponse);

function encriptorZigZag($texto, $clave)
{
    $len_texto = strlen($texto);
    $nro_fila = intval($clave);
    //echo $nro_fila . '<br></br>';
    $array_enc = array_fill(0, $nro_fila, '');
    $index = 0;
    $bandera = true;
    while ($index < $len_texto) {
        if ($bandera) {
            // Recorre completo
            $j1 = 0;
            $lim = $nro_fila;
        } else {
            $j1 = 1;
            $lim = $nro_fila - 1;
        }

        for ($j = $j1; $j < $lim && $index < $len_texto; $j++) {
            if ($bandera) {
                $array_enc[$j] .= $texto[$index];
                // ////echo $j . '<br></br>';
            } else {
                $array_enc[$lim - $j] .= $texto[$index];
                // ////echo $lim - $j . '<br></br>';
            }
            $index++;
        }
        $bandera = !$bandera;
    }
    // mostrar($array_enc);


    return implode($array_enc);
}

function descifrarZigZag($texto, $num_filas)
{
    $num_filas = intval($num_filas);
    $longitud_text = strlen($texto);
    $longitud_segmento = ($num_filas - 1) * 2;
    $num_segmentos = intval($longitud_text / $longitud_segmento);
    $elementos_adicionales = $longitud_text % $longitud_segmento;

    // Calcular adicionales
    $cresta_superior = $cresta_inferior = $num_segmentos;
    $resto = $elementos_adicionales;
    if ($elementos_adicionales > 0) {
        if ($elementos_adicionales > ($longitud_segmento / 2)) {
            $cresta_inferior++;
            $resto--;
        }
        $resto--;
        $cresta_superior++;
    }

    $matriz = array_fill(0, $num_filas, ''); // Crear matriz vacía

    //echo 'Cresta superior: ' . $cresta_superior . '<br></br>';
    //echo 'Cresta inferior: ' . $cresta_inferior . '<br></br>';
    //echo 'Resto: ' . $resto . '<br></br>';

    $matriz[0] = substr($texto, 0, $cresta_superior); // Almacenar cresta superior
    $matriz[$num_filas - 1] = substr($texto, $longitud_text - $cresta_inferior); // Almacenar cresta inferior
    $texto = substr($texto, $cresta_superior, $longitud_text - $cresta_inferior - $cresta_superior); // Quitar del string
    //echo $texto . '<br></br>';
    $longitud_text = strlen($texto) - $resto; // No tomar en cuenta el resto
    $incremento = 0;
    // $ban = true;
    for ($i = 1; $i < ($num_filas - 1); $i++) {
        if (($resto - 1) + $i > (($longitud_segmento / 2) + 1)) {
            $incremento = 2;
        } else if ($i <= $resto) {
            $incremento = 1;
        } else {
            $incremento = 0;
        }
        $longitud = ($longitud_text / ($num_filas - 2)) + $incremento;
        $matriz[$i] = substr($texto, 0, $longitud);
        $texto = substr($texto, $longitud);
    }

    $fila = 0;
    $bajar = false; // Bajar
    $msj_decifrado = '';

    // mostrar($matriz);

    for ($i = 0; $i <= $num_segmentos; $i++) {
        for ($j = 0; $j < $num_filas; $j++) {
            if ($fila === 0 || $fila === ($num_filas - 1)) {
                $bajar = !$bajar;
            }

            ////echo 'Número de fila: ' . $fila . '<br></br>';

            $msj = $matriz[$fila];

            ////echo 'Mensaje: ' . $msj . '<br></br>';


            $msj_decifrado .= $msj[0];
            $matriz[$fila] = substr($msj, 1);

            ////echo 'Mensaje modificado: ' . $matriz[$fila] . '<br></br>';
            ////echo 'Mensaje decifrado: ' . $msj_decifrado . '<br></br>';

            $fila += $bajar ? 1 : -1;
        }
    }

    for ($i = 0; $i < $longitud_segmento; $i++) {
        if ($fila === 0 || $fila === ($num_filas - 1)) {
            $bajar = !$bajar;
        }

        $msj = $matriz[$fila];
        if ($msj !== '') {
            $msj_decifrado .= $msj[0];
            $matriz[$fila] = substr($msj, 1);
        }

        $fila += $bajar ? 1 : -1;
    }

    // mostrar($matriz);

    return $msj_decifrado;
}


function mostrar($array)
{
    $len = count($array);
    for ($i = 0; $i < $len; $i++) {
        //echo $array[$i] . '<br></br>';
    }
}

$texto = 'holamellamoemanuelvaca';
$text_cifrado = encriptorZigZag($texto, 5);
//echo $text_cifrado . '<br></br>';

$text_decifrado = descifrarZigZag($text_cifrado, 5);
//echo $text_decifrado . '<br></br>';