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
#Bases de Datos
$bbddcatalogo = $prefix . "_catalogo";
$bbddusuarios = $prefix . "_usuarios";
$bbddgrupos = $prefix . "_grupo";
$bbddsesiones = $prefix . "_sesiones";
$bbddcomentarios = $prefix . "_comentarios";
$bbddsolicitudes = $prefix . "_solicitudes";
$bbddlog = $prefix . "_registro";
#Libros
$librosql = "SELECT * FROM $bbddcatalogo";
$libroquery = mysqli_query($databaseconnection, $librosql);
$libroresultado = mysqli_fetch_assoc($libroquery);
#Grupos
$gruposql = "SELECT * FROM `$bbddgrupos`";
$grupoquery = mysqli_query($databaseconnection, $gruposql);
$gruporesultado = mysqli_fetch_assoc($grupoquery);
#Sesiones
$phpsessid = mysqli_real_escape_string($databaseconnection, $_COOKIE['PHPSESSID']);
$sesionessql = "SELECT * FROM `$bbddsesiones` WHERE `PHPSESSID` LIKE '$phpsessid' AND `IP` LIKE '$ip_address' AND `USER_AGENT` LIKE '$uagent'";
$sesionesquery = mysqli_query($databaseconnection, $sesionessql);
$sesionesresultado = mysqli_fetch_assoc($sesionesquery);
echo mysqli_error($databaseconnection);
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
#Lectores
$usuariosql = "SELECT * FROM `$bbddusuarios`";
$usuarioquery = mysqli_query($databaseconnection, $usuariosql);
$usuarioresultado = mysqli_fetch_assoc($usuarioquery);
$usuarioidsql = "SELECT * FROM $bbddusuarios WHERE USUARIO LIKE '$sessionus'";
$usuarioidquery = mysqli_query($databaseconnection, $usuarioidsql);
$usuariodata = mysqli_fetch_row($usuarioidquery);
#Comentarios
#Solicitudes
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