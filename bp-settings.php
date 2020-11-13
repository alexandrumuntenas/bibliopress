<?php

// Valores MYSQL
$serverMySQL = 'localhost'; //Host de la base de datos
$dbMySQL = 'bibliopress'; //Nombre de la base de datos
$userMySQL = 'root'; //Usuario de la base de datos
$pwdMySQL = ''; //Contraseña del usuario de la base de datos        

// Credenciales subida de archivos

$userUpload = 'bibliopress'; //Usuario de carga
$pwdUpload = 'root'; //Contraseña del usuario de carga

// Otros parametros
$sname = 'IES Montevives'; //Nombre de la biblioteca/institución
$sitelink = 'https://localhost.com';

$databaseconnection = mysqli_connect($serverMySQL, $userMySQL, $pwdMySQL, $dbMySQL);

//Parámetro Lista
$CantidadMostrar = 9;
