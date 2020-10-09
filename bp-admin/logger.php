<?php
require '../bp-config.php';
$usuario = mysqli_real_escape_string($databaseconnection, $_POST["usuario"]);
$contrasena = mysqli_real_escape_string($databaseconnection, $_POST["contrasena"]);
if($usuario != null){
  $logintest = "SELECT * FROM `$bbddusuarios` WHERE `usuario` LIKE $usuario";
  $resultado = $databaseconnection->query($logintest);
  if($resultado['PIN'] = $contrasena){
    setcookie('loggedin', 1, time() + (3600000), "/");
    setcookie('perm', 1, time() + (3600000), "/");
  }
};

$logger = $_COOKIE['loggedin'];
if($logger == 1){
    echo "<meta http-equiv='refresh' content='5;url=index.php' /><h1>Biblioteca del " . $sname . "</h1><br><strong>Se ha iniciado sesión correctamente <em>$usuario</em>, accediendo al panel...</strong>";
}
else {
    echo "<h1>Biblioteca del " . $sname . "</h1><br><strong>Ha habido un error</strong>";
};
?>
