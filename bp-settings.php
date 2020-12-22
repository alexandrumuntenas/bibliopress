<?php

// Valores MYSQL
$serverMySQL = 'localhost'; //Host de la base de datos
$dbMySQL = 'bibliopress'; //Nombre de la base de datos
$userMySQL = 'bibliopress'; //Usuario de la base de datos
$pwdMySQL = 'YIK0Y8rNsgk1THZp'; //Contraseña del usuario de la base de datos
$prefix = 'bpg'; //Prefijo de tablas. No cambiar

// Otros parametros
$sname = 'Centro Centro'; //Nombre de la biblioteca/institución
$sitelink = '/'; //Enlace del sitio web para cumplir con GDPR

$databaseconnection = mysqli_connect($serverMySQL, $userMySQL, $pwdMySQL, $dbMySQL);

//Parámetro Lista
$CantidadMostrar = 9;
