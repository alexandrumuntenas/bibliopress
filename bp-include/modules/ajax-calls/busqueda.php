<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';
if (isset($_POST['search'])) {
   $busqueda = $_POST['search'];
   $Queray = "SELECT TITULO, ID, DESCRIPCION, AUTOR, DISPONIBILIDAD FROM `$bbddcatalogo` WHERE TITULO LIKE '%$busqueda%'LIMIT 5";
   $ExecQuery = MySQLi_query($databaseconnection, $Queray);
   echo '<div class="row">';
   while ($Result = MySQLi_fetch_array($ExecQuery)) {
      $long = 250;
      $desc = substr($Result['DESCRIPCION'], 0, $long);
?>
      <div class="tarjetasbusqueda card-body">
         <h6><strong><?php echo $Result['TITULO']; ?></strong> por <em><?php echo $Result['AUTOR']; ?></em></h6>
         <h7></h7>
         <p><em><?php echo $desc; ?></em></p>
         <?php
         if ($Result['DISPONIBILIDAD'] == 1) {
            echo '<p class="badge badge-success">Disponibilidad ✓</p><br>';
         } else {
            echo '<p class="badge badge-danger">Disponibilidad ✗</p><br>';
         } ?>
         <a class="btn btn-light" href="/?view=<?php echo $Result['ID']; ?>">Ver más</a>
      </div>
<?php
   }
}
?>