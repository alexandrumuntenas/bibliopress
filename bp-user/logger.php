<?php
require '../bp-config.php';
$usuario = mysqli_real_escape_string($databaseconnection, $_POST["usuario"]);
$contrasena = mysqli_real_escape_string($databaseconnection, $_POST["contrasena"]);

if ($logger == 1) {
  echo "<meta http-equiv='refresh' content='5;url=index.php' /><strong>Ya has iniciado sesión! Volviendo al panel...</strong>";
} else {
  if ($usuario != null) {
    $logintest = "SELECT * FROM `$bbddusuarios` WHERE `usuario` LIKE '" . $usuario . "'";
    $resultado = $databaseconnection->query($logintest);
    $login = mysqli_fetch_assoc($resultado);
    if (password_verify($contrasena, $login['PASSWD'])) {
      $sloginsql = "INSERT INTO `$bbddsesiones` (`PHPSESSID`, `USUARIO`, `LOGGEDIN`, `PERM`) VALUES ('$phpsessid', '$usuario', '1', '".$login['PERM']."');";
      $sloginresult = $databaseconnection->query($sloginsql);
      if($sloginresult == true){
        echo "<meta http-equiv='refresh' content='5;url=index.php' /><br><strong>Se ha iniciado sesión correctamente <em>$usuario</em>, accediendo al panel...</strong>";
      } else{echo "Error de servidor, vuelve a intentarlo más tarde";      }
    } else {echo mysqli_error($databaseconnection); echo "<strong>Usuario o contraseña incorrecta. <em>Volviendo al inicio...</em></strong>";}
  };
};
