<?php
require('bp-settings.php');
//Configuración (pasar en un futuro a BBDD)
$formatofecha = "Y";

//Queries de SQL predefinido
$sql = "SELECT TITULO, AUTOR, ISBN, EDITORIAL, UBICACION, ANOPUB, EJEMPLAR FROM tabla";
$resultado = $databaseconnection->query($sql);

//Cookies para futuro sistema de login
$cnombre = "loggedin";
$cvalor = "0";
setcookie($cnombre, $cvalor, time() + (3600000), "/"); // 86400 = 1 dia

$dformat = date($formatofecha);
?>

