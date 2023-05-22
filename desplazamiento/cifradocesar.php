<?php 

$text = $_POST['texto'];
$clave = $_POST['desplazamiento'];
$encriptar = $_POST['tarea'] == 'encriptar';

$text = $encriptar
    ? cifradopuro($text, $clave)
    : descifradodesplazamiento($text, $clave);

$reponse = array('status' => 'success', 'message' => $text);
echo json_encode($reponse);


// echo cifradopuro($texto, $desplazamiento);

function cifradopuro($texto, $desplazamiento) {
    $resultado = "";

    for ($i = 0; $i < strlen($texto); $i++) {
        $caracter = $texto[$i];
        
        if (ctype_alpha($caracter)) {
            $caracter=strtoupper($caracter);
            $ascii_inicial = ord('A');
            
            
            $indice = (ord($caracter) - $ascii_inicial + $desplazamiento) % 26;
            $nuevo_caracter = chr($indice + $ascii_inicial);
            $resultado .= $nuevo_caracter;
        } else {
            $resultado .= $caracter;
        }
    }

    return $resultado;
}
$mensaje = "HOLA";
$desplazamiento = 3;

// $textoCifrado = cifradopuro($mensaje, $desplazamiento);
// echo "Texto cifrado: " . $textoCifrado;




function descifradodesplazamiento($textoCifrado, $desplazamiento) {
    $resultado = "";

    for ($i = 0; $i < strlen($textoCifrado); $i++) {
        $caracter = $textoCifrado[$i];
        
        if (ctype_alpha($caracter)) {
            $ascii_inicial = ord('a');
            if (ctype_upper($caracter)) {
                $ascii_inicial = ord('A');
            }
            
            $indice = (ord($caracter) - $ascii_inicial - $desplazamiento + 26) % 26;
            $nuevo_caracter = chr($indice + $ascii_inicial);
            $resultado .= $nuevo_caracter;
        } else {
            $resultado .= $caracter;
        }
    }

    return $resultado;
}
$textoCifrado = "Krod hvwh hv xp phvvdjh gh suhsrvd";
$desplazamiento = 3;

// $textoDescifrado = descifradodesplazamiento($textoCifrado, $desplazamiento);
// echo "Texto descifrado: " . $textoDescifrado;





