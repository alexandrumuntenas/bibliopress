<?php

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
    $sname = 'Colegio Colegio Colegio'; //Nombre de la biblioteca/institución

    $databaseconnection = mysqli_connect($serverMySQL,$userMySQL,$pwdMySQL,$dbMySQL);
    
?>