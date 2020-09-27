<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';
$loggedin = $_COOKIE["loggedin"];
$id = $_REQUEST['id'];
$query = "DELETE FROM $tableMySQL WHERE id=$id";
$result = mysqli_query($databaseconnection, $query);
?>
<?php
//Importación de datos
require '../bp-config.php';

?>
<!DOCTYPE html>
<html>
    <?php require '../bp-include/head.html';?>
    <body>
        <header>
            <div class="wrapper">
            <?php require '../bp-include/menu.html';?>
        </header>
    <div class='loginsection'>
        <?php echo "<p class='btn btn-danger'>Se ha eliminado el registro $id</p><br><br><a class='btn btn-link' href='/bp-admin/panel.php'>Volver al panel</a>"; ?>
</body>

</html>