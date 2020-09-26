<?php
//Configuración (pasar en un futuro a BBDD)
$formatofecha = "Y";

// Valores MYSQL
    
$serverMySQL = 'localhost'; //Host de la base de datos
$dbMySQL = 'bookpress'; //Nombre de la base de datos
$userMySQL = 'bookpress'; //Usuario de la base de datos
$pwdMySQL = 'gkS4hB8kTZ8acKce'; //Contraseña del usuario de la base de datos
$tableMySQL = 'tabla';  //Nombre de la tabla en la base de datos


// Credenciales subida de archivos

    $userUpload = 'bibliopress'; //Usuario de carga
    $pwdUpload = 'bibliopress'; //Contraseña del usuario de carga

// Otros parametros
    $sname = 'I.E.S Montevives'; //Nombre de la biblioteca/institución

    $databaseconnection = mysqli_connect($serverMySQL,$userMySQL,$pwdMySQL,$dbMySQL);
    
//Queries de SQL predefinido
$sql = "SELECT TITULO, AUTOR, ISBN, EDITORIAL, UBICACION, ANOPUB, EJEMPLAR FROM tabla";
$resultado = $databaseconnection->query($sql);

//Cookies para futuro sistema de login
$cnombre = "loggedin";
$cvalor = "0";
setcookie($cnombre, $cvalor, time() + (3600000), "/"); // 86400 = 1 dia

$dformat = date($formatofecha);
?>

