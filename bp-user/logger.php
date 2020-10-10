<?php
require '../bp-config.php';
$usuario = mysqli_real_escape_string($databaseconnection, $_POST["usuario"]);
$contrasena = mysqli_real_escape_string($databaseconnection, $_POST["contrasena"]);
setcookie('usuario', $usuario, time() + (3600), "/");

if($usuario != null){
  $logintest = "SELECT * FROM `$bbddusuarios` WHERE `usuario` LIKE $usuario";
  $resultado = $databaseconnection->query($logintest);
  $perm = $resultado[4];
  if($resultado['PIN'] = $contrasena){
    setcookie('loggedin', 1, time() + (3600), "/");
    setcookie('perm', 1, time() + (3600), "/");
  }
};

$logger = $_COOKIE['loggedin'];
if($logger == 1){
    echo "<meta http-equiv='refresh' content='5;url=index.php' /><br><strong>Se ha iniciado sesión correctamente <em>$usuario</em>, accediendo al panel...</strong>";
}
else {
    echo "<strong>Ha habido un error</strong>";
};
