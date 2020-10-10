<?php
require '../bp-config.php';
  setcookie('loggedin', 0, time() + (3600), "/");
  setcookie('perm', 0, time() + (3600), "/");

$logger = $_COOKIE['loggedin'];
if($logger == 1){
    echo "<meta http-equiv='refresh' content='5;url=/' /><br><strong>Se ha cerrado la sesión correctamente, volviendo al inicio...</strong>";
}
else {
    echo "<strong>Ha habido un error</strong>";
};
