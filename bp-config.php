<?php
require('bp-settings.php');
$formatofecha = "Y";
$bbddusuarios = $prefix . "_usuarios";
$bbddcatalogo = $prefix . "_catalogo";
$bbddsesiones = $prefix . "_sesiones";
$bbddgrupos = $prefix . "_grupo";
$sql = "SELECT TITULO, AUTOR, ISBN, EDITORIAL, UBICACION, ANOPUB, EJEMPLAR, ID, DESCRIPCION, DISPONIBILIDAD, PRESTADOA, FECHADEV FROM $bbddcatalogo";
$resultado = $databaseconnection->query($sql);
$lectorsql = "SELECT * FROM `$bbddusuarios`";
$lectorresultado = $databaseconnection->query($lectorsql);
$dformat = date($formatofecha);
$numerolibros = mysqli_num_rows($resultado);
$qtyprestadosql = "SELECT *  FROM `$bbddcatalogo` WHERE `DISPONIBILIDAD` = 0";
$qtyprestadoquery = $databaseconnection->query($qtyprestadosql);
$qtyprestados = mysqli_num_rows($qtyprestadoquery);
$aq112 = mysqli_fetch_assoc($resultado);
date_default_timezone_set('Europe/Berlin');
$fecha_actual = date('m/d/Y');
$timestamp = date("Y-m-d", strtotime($fecha_actual . "+ 15 days"));
$prorrogafecha = date("Y-m-d", strtotime($aq112['FECHADEV'] . "+ 15 days"));
echo mysqli_error($databaseconnection);
ini_set('display_errors', 0);
error_reporting(0);
$phpsessid = session_id();
$secureloginsql = "SELECT * FROM `$bbddsesiones`";
$secureloginquery = $databaseconnection->query($secureloginsql);
$secureloginresult = mysqli_fetch_assoc($secureloginquery);
$sessionlogged = $secureloginresult['LOGGEDIN'];
$sessionclass = $secureloginresult['PERM'];
$sessionus = $secureloginresult['USUARIO'];
if ($phpsessid == null) {
    session_start();
    $phpsessid = session_id();
}
$gruposql = mysqli_query($databaseconnection, "SELECT * FROM `$bbddgrupos`");