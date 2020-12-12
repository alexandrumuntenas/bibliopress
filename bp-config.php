<?php
require('bp-settings.php');
# Querry Libros
$bbddcatalogo = $prefix . "_catalogo";
$librosql = "SELECT * FROM $bbddcatalogo";
$libroquerry = mysqli_query($databaseconnection,$librosql);
$libroresultado = mysqli_fetch_assoc($libroquerry);
# Querry Lectores
$bbddusuarios = $prefix . "_usuarios";
$usuariosql = "SELECT * FROM `$bbddusuarios`";
$usuarioquerry = mysqli_query($databaseconnection,$usuariosql);
$usuarioresultado = mysqli_fetch_assoc($usuarioquerry);
# Querry Grupos
$bbddgrupos = $prefix . "_grupo";
$gruposql = "SELECT * FROM `$bbddgrupos`";
$grupoquerry = mysqli_query($databaseconnection, $gruposql);
$gruporesultado = mysqli_fetch_assoc($grupoquerry);
# Querry Sesiones
$bbddsesiones = $prefix . "_sesiones";
$sesionessql = "SELECT * FROM `$bbddsesiones`";
$sesionesquerry = mysqli_fetch_assoc($databaseconnection);
$sessionlogged = $sesionesquerry['LOGGEDIN'];
$sessionclass = $sesionesquerry['PERM'];
$sessionus = $sesionesquerry['USUARIO'];
$phpsessid = session_id();
if ($phpsessid == null) {
    session_start();
    $phpsessid = session_id();
}
#Other PHP Resources
echo mysqli_error($databaseconnection);
$fecha_actual = date('m/d/Y');
$formatofecha = "Y";
$timestamp = date("Y-m-d", strtotime($fecha_actual . "+ 15 days"));
$prorrogafecha = date("Y-m-d", strtotime($aq112['FECHADEV'] . "+ 15 days"));
#Default Settings
date_default_timezone_set('Europe/Berlin');
#ini_set('display_errors', 0);
#error_reporting(0);