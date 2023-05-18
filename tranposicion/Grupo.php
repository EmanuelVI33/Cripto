<?php

function ordenarText($text, int  $clave)
{
    $new_text = '';
    $cand_dig = intval(log10($clave)) + 1;
    $len_text = strlen($text);
    for ($i = 0; $i < $len_text; $i++) {
        $pot = pow(10, $cand_dig - 1);  // Potencia
        $index = intval($clave / $pot); // Obtener digito el primer digito de la izquierda
        $clave = intval($clave % $pot); // Eliminar el primer digito de la izquierda
        $new_text = $new_text . $text[$index - 1];
        $cand_dig--;
    }
    return $new_text;
}

// Cifrado por grupo
function cifrarGrupo($text, $clave)
{
    $text = str_replace(' ', '', $text);  // Eliminar espacio
    $text_cifrado = '';
    $text_len = strlen($text);
    $clave_len = strlen($clave);
    $n = intval($text_len / $clave_len);

    for ($i = 0; $i < $n; $i++) {
        $s = substr($text, 0, $clave_len);
        $text = substr($text, $clave_len);
        $text_cifrado = $text_cifrado . ordenarText($s, intval($clave));
    }

    if (($text_len % $clave_len) > 0) { // Tiene relleno
        $text_len = strlen($text);
        $relleno = str_repeat("X", $clave_len - $text_len);
        $text_cifrado = $text_cifrado . ordenarText($text . $relleno, $clave);
    }

    return $text_cifrado;
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

$text = cifradoSerie('adiosmundocruel');
// $s = isPrimo(15);
echo $text . "<br></br>";