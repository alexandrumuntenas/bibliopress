<?php

// Valores MYSQL
$serverMySQL = 'localhost'; //Host de la base de datos
$dbMySQL = 'bibliopress'; //Nombre de la base de datos
$userMySQL = 'root'; //Usuario de la base de datos
$pwdMySQL = ''; //Contraseña del usuario de la base de datos
$prefix = 'cu1723129'; //Prefijo de tablas. No cambiar

// Otros parametros
$sname = 'Centro Centro'; //Nombre de la biblioteca/institución
$sitelink = 'localhost'; //Enlace del sitio web para cumplir con GDPR

$databaseconnection = mysqli_connect($serverMySQL, $userMySQL, $pwdMySQL, $dbMySQL);

//Parámetro Lista
$CantidadMostrar = 9;
