<?php

//Carga el archivo de configuración
require('bp-settings.php');

//Formato de fecha predefinido
$formatofecha = "Y";

//Queries de SQL predefinido
$sql = "SELECT TITULO, AUTOR, ISBN, EDITORIAL, UBICACION, ANOPUB, EJEMPLAR, ID, DESCRIPCION FROM $tableMySQL";
$resultado = $databaseconnection->query($sql);

$lectorsql = "SELECT * FROM `bp_estudiantes`";
$lectorresultado = $databaseconnection->query($lectorsql);

//Cookies para futuro sistema de login
$cnombre = "loggedin";
$cvalor = "0";
setcookie($cnombre, $cvalor, time() + (3600000), "/"); // 86400 = 1 dia

$dformat = date($formatofecha);
?>

