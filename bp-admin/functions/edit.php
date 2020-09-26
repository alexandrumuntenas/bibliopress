<?php
require $_SERVER['DOCUMENT_ROOT']. '/bp-config.php';
echo '¡Hola ' . htmlspecialchars($_GET["id"]) . '!';
?>