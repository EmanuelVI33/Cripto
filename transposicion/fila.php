<?php

$text = $_POST['texto'];
$clave = $_POST['clave'];
$encriptar = $_POST['tarea'] == 'encriptar';

$text = $encriptar
    ? filaEncriptar($text, $clave)
    : filaDecepcriptar($text, $clave);

$reponse = array('status' => 'success', 'message' => $text);
echo json_encode($reponse);

function filaEncriptar($text, $clave)
{
    $is_numeric_clave = is_numeric($clave);
    $len_clave = $is_numeric_clave
        ? intval($clave)
        : strlen($clave);
    $len_text = strlen($text);
    $nro_columna = intval($len_text / $len_clave);  // Número de renglones
    $residuo = intval($len_text % $len_clave);

    // echo $is_numeric_clave . ' ' . $len_clave . ' ' . $len_text . '<br></br>';

    if ($residuo > 0) { // Agregar relleno
        $relleno = str_repeat('x', $residuo);
        $text .= $relleno;
        $nro_columna++;  // Aumenta un renglon
    }

    $array_text_cifrado = array_fill(0, $len_clave, '');
    $index = 0;
    while ($index < $len_text) {
        for ($fil = 0; $fil < $len_clave; $fil++) {
            $array_text_cifrado[$fil] .= $text[$index];
            $index++;
        }
    }

    if (!$is_numeric_clave) {
        // Ordenar de aucerdo a la clave
        $array_text_cifrado = ordenar($array_text_cifrado, $clave, $len_clave);
    }

    return implode($array_text_cifrado);
}

function filaDecepcriptar($text, $clave)
{
    $len_text = strlen($text);
    $is_clave_numeric = is_numeric($clave);
    $len_clave = $is_clave_numeric
        ? intval($clave)
        : strlen($clave);
    $nro_columna = intval($len_text / $len_clave);

    $array_text_cifrado = array_fill(0, $nro_columna, '');

    if (!$is_clave_numeric) {
        // Ordenar de aucerdo a la clave
        $text = ordenar_des($text, $clave, $len_clave, $nro_columna);
    }

    $index = 0;
    while ($index < $len_text) {
        for ($col = 0; $col < $nro_columna; $col++) {
            $array_text_cifrado[$col] .= $text[$index];
            $index++;
        }
    }

    return implode($array_text_cifrado);
}

function ordenar_des($texto, $clave, $len_clave, $col)
{
    $array_ord = getVectorOrd($clave);
    $array_text = str_split($texto, $col);
    $array_text_ord = array_fill(0, $len_clave, '');
    for ($i = 0; $i < $len_clave; $i++) {
        $menor = min($array_ord);
        $index = array_search($menor, $array_ord); // Obtener elemento menor 
        $array_text_ord[$i] = $array_text[$index];
        unset($array_ord[$index]);
        unset($array_text[$index]);
    }
    return implode($array_text_ord);
}

function ordenar($array_text_cifrado, $clave, $len_clave)
{
    $array_ord = getVectorOrd($clave);
    $array_text_ord = array_fill(0, $len_clave, '');
    for ($i = 0; $i < $len_clave; $i++) {
        $menor = min($array_ord);
        $index = array_search($menor, $array_ord); // Obtener elemento menor 
        // echo $menor . ' ' . $index . ' ' . $array_text_cifrado[$index] . '<br></br>';
        $array_text_ord[$i] = $array_text_cifrado[$index];
        unset($array_ord[$index]);
        unset($array_text_cifrado[$index]);
    }
    return $array_text_ord;
}

function getVectorOrd($clave)
{
    $array_text = getVecAscii($clave);
    $clave_ord = array_fill(0, strlen($clave), 0);
    $len_clave = strlen($clave);
    for ($i = 0; $i < $len_clave; $i++) {
        $menor = min($array_text);   // Menor elemento
        $index = array_search($menor, $array_text);  // Obtener su indice
        $clave_ord[$index] = $i;   // Coloco su número  
        unset($array_text[$index]); // Elimino el menor elemento
    }
    return $clave_ord;
}

function getVecAscii($clave)
{
    $clave = strtolower($clave);
    $array = array();
    $len_clave = strlen($clave);
    for ($i = 0; $i < $len_clave; $i++) {
        array_push($array, ord($clave[$i]));
    }
    return $array;
}

// function mostrar($array)
// {
//     $len = count($array);
//     for ($i = 0; $i < $len; $i++) {
//         echo $array[$i] . '<br></br>';
//     }
// }