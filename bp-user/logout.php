<?php
require '../bp-config.php';

if ($sessionlogged == 1) {
  $logoutsql = "DELETE FROM `$bbddsesiones` WHERE `$bbddsesiones`.`PHPSESSID` = '$phpsessid'";
  $logoutquery = $databaseconnection->query($logoutsql);
  echo "<meta http-equiv='refresh' content='5;url=/' /><br><strong>Se ha cerrado la sesión correctamente, volviendo al inicio...</strong>";
} else {
  echo "<strong>Ha habido un error</strong>";
};
