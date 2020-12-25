<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bp-settings.php';
#Parámetros
$uagent = mysqli_real_escape_string($databaseconnection, $_SERVER['HTTP_USER_AGENT']);
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip_address = $_SERVER['REMOTE_ADDR'];
}
#Query Libros
$bbddcatalogo = $prefix . "_catalogo";
$librosql = "SELECT * FROM $bbddcatalogo";
$libroquery = mysqli_query($databaseconnection, $librosql);
$libroresultado = mysqli_fetch_assoc($libroquery);
#Query Lectores
$bbddusuarios = $prefix . "_usuarios";
$usuariosql = "SELECT * FROM `$bbddusuarios`";
$usuarioquery = mysqli_query($databaseconnection, $usuariosql);
$usuarioresultado = mysqli_fetch_assoc($usuarioquery);
#Query Grupos
$bbddgrupos = $prefix . "_grupo";
$gruposql = "SELECT * FROM `$bbddgrupos`";
$grupoquery = mysqli_query($databaseconnection, $gruposql);
$gruporesultado = mysqli_fetch_assoc($grupoquery);
#Query Sesiones
$phpsessid = session_id();
$bbddsesiones = $prefix . "_sesiones";
$sesionessql = "SELECT * FROM `$bbddsesiones` WHERE `PHPSESSID` LIKE '$phpsessid' AND `IP` LIKE '$ip_address' AND `USER_AGENT` LIKE '$uagent'";
$sesionesquery = mysqli_query($databaseconnection, $sesionessql);
$sesionesresultado = mysqli_fetch_assoc($sesionesquery);
$sessionlogged = $sesionesresultado['LOGGEDIN'];
$sessionclass = $sesionesresultado['PERM'];
$sessionus = $sesionesresultado['USUARIO'];
if ($phpsessid == null) {
    session_start();
    $phpsessid = session_id();
}
$sesavatarsql = "SELECT * FROM `$bbddusuarios` WHERE USUARIO LIKE '$sessionus'";
$sesavatarquery = mysqli_query($databaseconnection, $sesavatarsql);
$sesavatarresultado = mysqli_fetch_assoc($sesavatarquery);
#Query Comentarios
$bbddcomentarios = $prefix . "_comentarios";
#Other PHP Resources
echo mysqli_error($databaseconnection);
$fecha_actual = date('m/d/Y');
$formatofecha = "Y";
$timestamp = date("Y-m-d", strtotime($fecha_actual . "+ 15 days"));
$prorrogafecha = date("Y-m-d", strtotime($libroresultado['FECHADEV'] . "+ 15 days"));
#Default Settings
date_default_timezone_set('Europe/Berlin');
#ini_set('display_errors', 0);
#error_reporting(0);
