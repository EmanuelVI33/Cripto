<?php

$text = $_POST['texto'];
$clave = $_POST['clave'];
$encriptar = $_POST['tarea'] == 'encriptar';

$text = $encriptar
    ? cifradoSerie($text, $clave)
    : filaDecepcriptar($text, $clave);

$reponse = array('status' => 'success', 'message' => $text);
echo json_encode($reponse);

function cifradoSerie($text)
{
    $len = strlen($text);
    $text_par = '';
    $text_primo = '';
    $text_otro = '';
    for ($i = 0; $i < $len; $i++) {
        if (isPar($i + 1)) {
            $text_par .= $text[$i];
            continue;
        }

        isPrimo($i + 1)
            ? $text_primo .= $text[$i]
            : $text_otro .= $text[$i];
    }
    return ($text_par . $text_primo . $text_otro);
}

function isPar($valor)
{
    return ($valor % 2 == 0);
}

function isPrimo($num)
{
    $lim = intval($num / 2);
    // echo $lim . "<br></br>";
    $is_primo = true;
    for ($i = 2; $i <= $lim && $is_primo; $i++) {
        // echo $i . "<br></br>";
        if ($num % $i == 0) {
            $is_primo = false;
        }
    }
    return $is_primo;
}
