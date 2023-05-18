<?php

$text = $_POST['texto'];
$clave = $_POST['clave'];
$encriptar = $_POST['tarea'] == 'encriptar';

$text = $encriptar
    ? columna_encriptar($text, $clave)
    : columna_decepcriptar($text, $clave);

$reponse = array('status' => 'success', 'message' => $text);
echo json_encode($reponse);

function columna_encriptar($text, $clave)
{
    $is_numeric_clave = is_numeric($clave);
    $len_clave = $is_numeric_clave
        ? intval($clave)
        : strlen($clave);
    $len_claveText = strlen($text);
    $n = intval($len_claveText / $len_clave);
    $residuo = intval($len_claveText % $len_clave);

    if ($residuo > 0) {
        $relleno = str_repeat('x', $residuo);
        $text .= $relleno;
        $n++;
    }

    $text_cifrado = '';
    for ($col = 0; $col < $len_clave; $col++) {
        $s = '';
        for ($fil = 0; $fil < $n; $fil++) {
            $s .= $text[$col + ($fil * $len_clave)];
        }
        $text_cifrado .= $s;
    }

    if (!$is_numeric_clave) {
        $text_cifrado = ordenar($text_cifrado, $clave, $n);
    }

    return $text_cifrado;
}

function ordenar($text_cifrado, $clave, $n)
{
    $new_text_cifrado = '';
    $vector_ord = getVectorOrd($clave);
    // mostrar($vector_ord);
    $array_cripto = str_split($text_cifrado, $n);
    // mostrar($array_cripto);
    $len = count($array_cripto);
    for ($i = 0; $i < $len; $i++) {
        $menor = min($vector_ord); // Obtener el primero
        $index = array_search($menor, $vector_ord);
        $new_text_cifrado .= $array_cripto[$index];
        unset($array_cripto[$index]);
        unset($vector_ord[$index]);
    }
    return $new_text_cifrado;
}

// function mostrar($array)
// {
//     $len = count($array);
//     for ($i = 0; $i < $len; $i++) {
//         // echo $array[$i] . '<br></br>';
//     }
// }

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



function ordDescencrip($text, $clave, &$array_descrip, $n)
{
    $len_clave = strlen($clave);
    $array_orden_clave = getVectorOrd($clave);
    $array_text_ency = str_split($text, $len_clave);

    for ($i = 0; $i < $n; $i++) {
        $menor = min($array_orden_clave);   // Menor elemento
        $index = array_search($menor, $array_orden_clave);  // Obtener su indice
        $array_descrip[$index] = $array_text_ency[$i];  // Agregar en su posición correspondiente
        unset($array_orden_clave[$index]);  // Eliminar el menor
    }
    return $array_descrip;
}

function columna_decepcriptar($text, $clave)
{
    $len_text = strlen($text);
    $is_clave_numeric = is_numeric($clave);
    $len_clave = $is_clave_numeric
        ? intval($clave)
        : strlen($clave);
    $n = intval($len_text / $len_clave);


    if (!$is_clave_numeric) {
        $array_descrip = array_fill(0, $len_clave, []);
        ordDescencrip($text, $clave, $array_descrip, $n);
    } else {
        $array_descrip = str_split($text, $n);
    }

    $text_descrip = '';
    for ($col = 0; $col < $len_clave; $col++) {
        for ($fil = 0; $fil < $n; $fil++) {
            $text_descrip .= $array_descrip[$fil][$col];
        }
    }

    return $text_descrip;
}