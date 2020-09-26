<?php
//Configuración (pasar en un futuro a BBDD)
$sname = "Colegio Colegio Colegio";
$formatofecha = "Y";


//MySQL config
$host = "localhost"; //Host de la base de datos
$usuario = "bookpress"; //Usuario de la base de datos
$pwdusuario = "gkS4hB8kTZ8acKce"; //Contraseña del usuario de la base de datos
$bada = "bookpress"; //Nombre de la base de datos
$databaseconnection = mysqli_connect($host,$usuario,$pwdusuario,$bada);

//Queries de SQL predefinido
$sql = "SELECT TITULO, AUTOR, ISBN, EDITORIAL, UBICACION, ANOPUB, EJEMPLAR, DISPONIBILIDAD FROM tabla";
$resultado = $databaseconnection->query($sql);

//Cookies para futuro sistema de login
$cnombre = "loggedin";
$cvalor = "0";
setcookie($cnombre, $cvalor, time() + (3600000), "/"); // 86400 = 1 dia

$dformat = date($formatofecha);
?>

