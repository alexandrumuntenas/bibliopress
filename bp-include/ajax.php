<?php
require '../bp-config.php';
if (isset($_POST['search'])) {
   $busqueda = $_POST['search'];
   $Queray = "SELECT TITULO, ID FROM bp_catalogo WHERE TITULO LIKE '%$busqueda%' LIMIT 5";
   $ExecQuery = MySQLi_query($databaseconnection, $Queray);
   echo '
<ul class="list-group">
   ';
   while ($Result = MySQLi_fetch_array($ExecQuery)) {
?>
   <li class="list-group-item lives" onclick='fill("<?php echo $Result['TITULO']; ?>")'>
   <a>
       <?php echo $Result['TITULO']; ?>
   </li></a>
   <?php
}}
?>
</ul>