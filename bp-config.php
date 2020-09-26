<?php

//Carga el archivo de configuración
require('bp-settings.php');

//Formato de fecha predefinido
$formatofecha = "Y";

//Queries de SQL predefinido
$sql = "SELECT TITULO, AUTOR, ISBN, EDITORIAL, UBICACION, ANOPUB, EJEMPLAR, ID FROM $tableMySQL";
$resultado = $databaseconnection->query($sql);

//Cookies para futuro sistema de login
$cnombre = "loggedin";
$cvalor = "0";
setcookie($cnombre, $cvalor, time() + (3600000), "/"); // 86400 = 1 dia

$dformat = date($formatofecha);
?>

