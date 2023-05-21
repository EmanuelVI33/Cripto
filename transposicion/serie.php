<?php

$text = $_POST['texto'];
$encriptar = $_POST['tarea'] == 'encriptar';

$text = $encriptar
    ? cifradoSerie($text)
    : decifradoSerie($text);

$reponse = array('status' => 'success', 'message' => $text);
echo json_encode($reponse);

// $text_cifrado = cifradoSerie('holamundocruel');
// echo $text_cifrado . '<br></br>';
// $text_decifrado = decifradoSerie($text_cifrado);
// echo $text_decifrado . '<br></br>';

function cifradoSerie($text)
{
    $len_text = strlen($text);
    $text_par = '';
    $text_primo = '';
    $text_otro = '';
    for ($i = 0; $i < $len_text; $i++) {
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

function decifradoSerie($text)
{
    $len_text = strlen($text);
    $conj_par = substr($text, 0, $len_text / 2); // Obtener conjunto par
    $len_conj_par = strlen($conj_par);
    $conj_pri = substr($text, $len_conj_par, nroPrimos($len_text)); // Obtener conjunto de primo
    $conj_otro = substr($text, $len_conj_par + strlen($conj_pri));  // Obtener conjunto de otro

    // echo $conj_par . ' ' . $conj_pri . ' ' . $conj_otro;
    $index_par = $index_pri = $index_otro = 0;
    $text_decifrado = '';

    for ($i = 0; $i < $len_text; $i++) {
        if (isPar($i + 1)) {
            $text_decifrado .= $conj_par[$index_par];
            $index_par++;
            continue;
        }

        if (isPrimo($i + 1)) {
            $text_decifrado .= $conj_pri[$index_pri];
            $index_pri++;
        } else {
            $text_decifrado .= $conj_otro[$index_otro];
            $index_otro++;
        }

        // echo $text_decifrado . '<br></br>';
    }
    return $text_decifrado;
}

function nroPrimos($num)
{
    $c = 0;
    for ($i = 1; $i <= $num; $i++) {
        if (!isPar($i) && isPrimo($i)) {
            // No primo y par
            $c++;
        }
    }
    return $c;
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
