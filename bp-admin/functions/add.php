<?php
//Importación de datos
require $_SERVER['DOCUMENT_ROOT']. '/bp-config.php';
$loggedin = $_COOKIE["loggedin"];

//Tomar datos de formulario añadir registro desde panel.php
$titulo = $_REQUEST["element_1"];
$autor = $_REQUEST["element_2"];
$ISBN = $_REQUEST["element_3"];
$editorial = $_REQUEST["element_4"];
$anopub = $_REQUEST["element_5"];
$ejemplar = $_REQUEST["element_6"];
$ubicacion = $_REQUEST["element_7"];

//Utilizado durante las pruebas
/*$titulo = "Hola";
$autor = "SM";
$ISBN = "181818";
$editorial = "SM";
$anopub = "1919";
$ejemplar = "1191";
$ubicacion = "13";*/

$insert = "INSERT INTO `tabla`(`ANOPUB`, `AUTOR`, `EJEMPLAR`, `EDITORIAL`,`TITULO`, `UBICACION`, `ISBN`) VALUES ('$anopub','$autor','$ejemplar','$editorial','$titulo','$ubicacion','$ISBN')";
$databaseconnection->query($insert);

//Futura interfaz de información
?>