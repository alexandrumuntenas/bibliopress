<?php
require '../bp-config.php';
$usuario = $_COOKIE['usuario'];
$logger = $_COOKIE['loggedin'];
if($logger == 1){
    echo "<meta http-equiv='refresh' content='5;url=/index.php' /><h1>Biblioteca del " . $sname . "</h1><br><strong>Se ha cerrado la sesión correctamente <em>$usuario</em>, volviendo al inicio...</strong>";
    setcookie('loggedin', 0, time() + (3600000), "/");
    setcookie('usuario', 'notlogged');
  }
else {
    echo "<h1>Biblioteca del " . $sname . "</h1><br><strong>Ha habido un error</strong>";
};
?>
