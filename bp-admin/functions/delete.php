<?php
require $_SERVER['DOCUMENT_ROOT']. '/bp-config.php';
$loggedin = $_COOKIE["loggedin"];
$id=$_REQUEST['id'];
$query = "DELETE FROM $tableMySQL WHERE id=$id"; 
$result = mysqli_query($databaseconnection,$query);
?>