<?php
require '../bp-config.php';
$usuario = mysqli_real_escape_string($databaseconnection, $_POST["usuario"]);
$contrasena = mysqli_real_escape_string($databaseconnection, $_POST["contrasena"]);
$logger = $_COOKIE['loggedin'];
if ($logger == 1) {
  echo "<meta http-equiv='refresh' content='5;url=index.php' /><strong>Ya has iniciado sesión! Volviendo al panel...</strong>";
} else {
  if ($usuario != null) {
    setcookie('usuario', $usuario, time() + (3600), "/");
    $logintest = "SELECT * FROM `$bbddusuarios` WHERE `usuario` LIKE '" . $usuario . "'";
    $resultado = $databaseconnection->query($logintest);
    $login = mysqli_fetch_assoc($resultado);
    if ($login['PIN'] == $contrasena) {
      setcookie('loggedin', 1, time() + (3600), "/");
      setcookie('perm', $login['PERM'], time() + (3600), "/");
      echo "<meta http-equiv='refresh' content='5;url=index.php' /><br><strong>Se ha iniciado sesión correctamente <em>$usuario</em>, accediendo al panel...</strong>";
    }
  };
};
