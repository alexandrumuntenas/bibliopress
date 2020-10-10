<?php

//Carga el archivo de configuración
require('bp-settings.php');

//Formato de fecha predefinido
$formatofecha = "Y";

//Queries de SQL predefinido
$sql = "SELECT TITULO, AUTOR, ISBN, EDITORIAL, UBICACION, ANOPUB, EJEMPLAR, ID, DESCRIPCION FROM $tableMySQL";
$resultado = $databaseconnection->query($sql);

$bbddusuarios = "bp_usuarios";
$lectorsql = "SELECT * FROM `$bbddusuarios`";
$lectorresultado = $databaseconnection->query($lectorsql);

//Cookies para futuro sistema de login

$dformat = date($formatofecha);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
$sessionlogged = $_COOKIE['loggedin'];
$sessionclass = $_COOKIE['perm'];
