<?php
require '../bp-config.php';
if (isset($_POST['search'])) {
   $busqueda = $_POST['search'];
   $Queray = "SELECT TITULO, ID, DESCRIPCION, AUTOR FROM bp_catalogo WHERE TITULO LIKE '%$busqueda%'LIMIT 5";
   $ExecQuery = MySQLi_query($databaseconnection, $Queray);
   echo '<ul class="list-group">
   ';
   while ($Result = MySQLi_fetch_array($ExecQuery)) {
      $long = 250;
      $desc = substr($Result['DESCRIPCION'], 0, $long);
?>
<div class="row">
<a class="livesa" href="view.php?id=<?php echo $Result['ID']; ?>">
   <li class="lives tarjetasbusqueda" onclick='fill("<?php echo $Result['TITULO']; ?>")'>
   
       <h6><?php echo $Result['TITULO']; ?> por <em><?php echo $Result['AUTOR']; ?></em></h6>
       <h7></h7>
       <p><em><?php echo $desc; ?></em></p>
   </li>
</a>
   </div>
   <?php
}}
?>
</ul>
