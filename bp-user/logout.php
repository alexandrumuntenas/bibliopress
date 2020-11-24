<?php
require '../bp-config.php';

if ($sessionlogged == 1) {
  $phpsessid = session_id();
  $logoutsql = "DELETE FROM `$bbddsesiones` WHERE `$bbddsesiones`.`PHPSESSID` = '$phpsessid'";
  $logoutquery = $databaseconnection->query($logoutsql);
  echo mysqli_error($databaseconnection)."<meta http-equiv='refresh' content='5;url=/' /><br><strong>Se ha cerrado la sesión correctamente, volviendo al inicio...</strong>";
  session_destroy();
  session_write_close();
  setcookie(session_name(), '', 0, '/');
  session_start();
} else {
  echo "<strong>Ha habido un error</strong>";
};
