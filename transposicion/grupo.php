<?php

// $text = $_POST['texto'];
// $clave = $_POST['clave'];
// $encriptar = $_POST['tarea'] == 'encriptar';

// $text = $encriptar
//     ? cifrarGrupo($text, $clave)
//     : cifrarGrupo($text, $clave);

// $reponse = array('status' => 'success', 'message' => $text);
// echo json_encode($reponse);

function cifrarGrupo($text, $clave)
{
    $text = str_replace(' ', '', $text);  // Eliminar espacio
    $text_cifrado = '';
    $text_len = strlen($text);
    $clave_len = strlen($clave);
    $n = intval($text_len / $clave_len);

    for ($i = 0; $i < $n; $i++) {
        $s = substr($text, 0, $clave_len); // Obtener una parte
        $text = substr($text, $clave_len); // Eliminar esa parte
        $text_cifrado = $text_cifrado . ordenarText($s, intval($clave)); // Agregar ordenado
    }

    if (($text_len % $clave_len) > 0) { // Tiene relleno
        $text_len = strlen($text);
        $relleno = str_repeat("X", $clave_len - $text_len);
        $text_cifrado = $text_cifrado . ordenarText($text . $relleno, $clave);
    }

    return $text_cifrado;
}

function ordenarText($text, int  $clave)
{
    $new_text = '';
    $cand_dig = intval(log10($clave)) + 1;
    $len_text = strlen($text);
    for ($i = 0; $i < $len_text; $i++) {
        $pot = pow(10, $cand_dig - 1);  // Potencia
        $index = intval($clave / $pot); // Obtener el primer digito de la izquierda
        $clave = intval($clave % $pot); // Eliminar el primer digito de la izquierda
        $new_text .= $text[$index - 1];
        echo $index . '  ' . $new_text . '<br></br>';
        $cand_dig--;
    }
    return $new_text;
}

function ordenarTextDes($text, $clave)
{
    $new_text = '';
    $cand_dig = intval(log10($clave)) + 1;
    $len_text = strlen($text);
    for ($i = 0; $i < $len_text; $i++) {
        $pot = pow(10, $cand_dig - 1);  // Potencia
        $index = intval($clave / $pot); // Obtener el primer digito de la izquierda
        $clave = intval($clave % $pot); // Eliminar el primer digito de la izquierda
        $new_text .= $text[$index - 1];
        echo $index . '  ' . $new_text . '<br></br>';
        $cand_dig--;
    }
    return $new_text;
}

function menor($numero)
{
    $cand_dig = intval(log10($numero)) + 1;
    $i = 0;
    $men = $i;
    while ($i < ($cand_dig - 1)) {
        $dig = $numero % 10;
        $numero /= 10;
        if ($dig < $men) {
            $men = $i;
        }
    }
    return $i;
}

$s = ordenarText('adio', 2314);
echo $s;
