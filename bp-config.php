<?php
require('bp-settings.php'); $formatofecha = "Y"; $sql = "SELECT TITULO, AUTOR, ISBN, EDITORIAL, UBICACION, ANOPUB, EJEMPLAR, ID, DESCRIPCION, DISPONIBILIDAD, PRESTADOA, FECHADEV FROM $tableMySQL"; $resultado = $databaseconnection->query($sql); $bbddusuarios = "bp_usuarios"; $lectorsql = "SELECT * FROM `$bbddusuarios`"; $lectorresultado = $databaseconnection->query($lectorsql); $dformat = date($formatofecha); $numerolibros = mysqli_num_rows($resultado); 
$qtyprestadosql = "SELECT *  FROM ".$tableMySQL." WHERE `DISPONIBILIDAD` = 0"; $qtyprestadoquery = $databaseconnection->query($qtyprestadosql);
$qtyprestados = mysqli_num_rows($qtyprestadoquery); $aq112 = mysqli_fetch_assoc($resultado);
//ini_set('display_errors', 0);
//ini_set('display_startup_errors', 0);
$sessionlogged = $_COOKIE['loggedin'];
$sessionclass = $_COOKIE['perm'];
$sessionus = $_COOKIE['usuario'];
date_default_timezone_set('Europe/Berlin');
$fecha_actual = date('m/d/Y');
$timestamp = date("Y-m-d",strtotime($fecha_actual."+ 15 days"));
$prorrogafecha = date("Y-m-d",strtotime($aq112['FECHADEV']."+ 15 days"));