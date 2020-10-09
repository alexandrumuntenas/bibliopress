<?php
$cnombre = "loggedin";
$cvalor = "0";
setcookie($cnombre, $cvalor, time() + (3600000), "/"); // 86400 = 1 dia
?>