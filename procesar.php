<?php
$nombre = $_POST['nombre'];
$email = $_POST['email'];

// Realiza cualquier procesamiento adicional con los datos recibidos

// Envía una respuesta al cliente (opcional)
$response = array('status' => 'success', 'message' => 'Formulario enviado correctamente');
echo json_encode($response);
