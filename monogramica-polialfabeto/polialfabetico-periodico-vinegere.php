<?php
$alphabet = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "Ñ", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");


function encrypt($message, $key)
{
    global $alphabet;
    $encryptedMessage = "";
    $messageLength = strlen($message);
    $key = strtoupper(str_repeat($key, $messageLength));
    $key = substr($key, 0, $messageLength);
    $key = str_replace(" ", "", $key);
    $message = strtoupper(str_replace(" ", "", $message));

    for ($i = 0; $i < strlen($message); $i++) {
        $indexCharMessage = array_search($message[$i], $alphabet);
        $indexCharKey = array_search($key[$i], $alphabet);

        $encryptedChar = $alphabet[($indexCharMessage + $indexCharKey) % 27];
        $encryptedMessage .= $encryptedChar;
    }

    return $encryptedMessage;
}

function decrypt($encryptedMessage, $key)
{
    global $alphabet;
    $decryptedMessage = "";
    $messageLength = strlen($encryptedMessage);
    $key = strtoupper(str_repeat($key, $messageLength));
    $key = substr($key, 0, $messageLength);
    $key = str_replace(" ", "", $key);
    $encryptedMessage = strtoupper(str_replace(" ", "", $encryptedMessage));

    for ($i = 0; $i < strlen($encryptedMessage); $i++) {
        $indexCharMessage = array_search($encryptedMessage[$i], $alphabet);
        $indexCharKey = array_search($key[$i], $alphabet);

        $newIndex = $indexCharMessage - $indexCharKey;
        if ($newIndex < 0) {
            $newIndex += 27;
        }

        $decryptedChar = $alphabet[$newIndex];
        $decryptedMessage .= $decryptedChar;
    }

    return $decryptedMessage;
}

$text = $_POST['texto'];
$clave = $_POST['clave'];
$tarea = $_POST['tarea'];

if ($tarea === 'encriptar') {
    $mensajeCifrado = encrypt($text, $clave);
    $reponse = array('status' => 'success', 'message' => $mensajeCifrado);
} else {
    $mensajeDescifrado = decrypt($text, $clave);
    $reponse = array('status' => 'success', 'message' => $mensajeDescifrado);
}
echo json_encode($reponse);


$message = "DESASTRE NUCLEAR EN MURUROA";
$key = "SOS";

/*
El cifrado de Vigenère se considera polialfabético periódico porque el patrón de selección de claves se repite periódicamente.
Si la clave tiene una longitud de n, el patrón se repetirá después de cada n caracteres. Esto dificulta el criptoanálisis del cifrado,
ya que no es tan sencillo descubrir el patrón subyacente y romper el mensaje cifrado.
*/