<?php
/* send_mail.php
Este programa manda mail para la recuperacion de la contrasenia utilizando la funcion de mail()...
Daniela Requejo y David Parra 
3/11/2015 */
$email= $_POST['email'];
$numcuenta= $_POST['cuenta'];
$newpass= $_POST['newpass'];
$header = 'From: ' . 'rentado.libros.2015@outlook.es'. " \n"; 

$mensaje = "Este mensaje fue enviado para: " . $numcuenta . " \n"; 
$mensaje .= "Su nueva contrase&ntilde;a es: " . $newpass . " \n";

$from='rentado.libros.2015@outlook.es';
$to= $_POST['email'];
$asunto = 'Cambio de Contrase&ntilde;a'; 
try{
 mail($to,$from, $asunto, $mensaje, $header);
}
catch(Exception $e){
echo 'Mensaje enviado correctamente' ,$e->getMessage();
}

?> 
