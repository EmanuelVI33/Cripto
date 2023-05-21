<?php
function encPoliAlfa($message, $key)
{
    $message = strtoupper($message); // Convertir el mensaje a mayúsculas
    $key = strtoupper($key); // Convertir la clave a mayúsculas

    $messageLength = strlen($message);
    $keyLength = strlen($key);
    $encryptedMessage = '';

    for ($i = 0; $i < $messageLength; $i++) {
        $char = $message[$i];
        $keyChar = $key[$i % $keyLength];

        if (ctype_alpha($char)) { // Verificar si el carácter es una letra
            $charIndex = ord($char) - ord('A');
            $keyIndex = ord($keyChar) - ord('A');

            $encryptedIndex = ($charIndex + $keyIndex) % 26;
            $encryptedChar = chr($encryptedIndex + ord('A'));

            $encryptedMessage .= $encryptedChar;
        } else {
            $encryptedMessage .= $char; // Mantener cualquier otro carácter sin cambios
        }
    }

    return $encryptedMessage;
}

function desPoliAlfab($ciphertext, $key)
{
    $ciphertext = strtoupper($ciphertext); // Convertir el mensaje cifrado a mayúsculas
    $key = strtoupper($key); // Convertir la clave a mayúsculas

    $ciphertextLength = strlen($ciphertext);
    $keyLength = strlen($key);
    $decryptedMessage = '';

    for ($i = 0; $i < $ciphertextLength; $i++) {
        $char = $ciphertext[$i];
        $keyChar = $key[$i % $keyLength];

        if (ctype_alpha($char)) { // Verificar si el carácter es una letra
            $charIndex = ord($char) - ord('A');
            $keyIndex = ord($keyChar) - ord('A');

            $decryptedIndex = ($charIndex - $keyIndex + 26) % 26;
            $decryptedChar = chr($decryptedIndex + ord('A'));

            $decryptedMessage .= $decryptedChar;
        } else {
            $decryptedMessage .= $char; // Mantener cualquier otro carácter sin cambios
        }
    }

    return $decryptedMessage;
}

$text = $_POST['texto'];
$tarea = $_POST['tarea'];
$clave = $_POST['clave'];

if ($tarea === 'encriptar') {
    $mensajeCifrado = encPoliAlfa($text, $clave);
    $reponse = array('status' => 'success', 'message' => $mensajeCifrado);
} else {
    $mensajeDescifrado = desPoliAlfab($text,$clave);
    $reponse = array('status' => 'success', 'message' => $mensajeDescifrado);
}
echo json_encode($reponse);
?>