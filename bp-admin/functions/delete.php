<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';
$loggedin = $_COOKIE["loggedin"];
$id = $_REQUEST['id'];
$query = "DELETE FROM $tableMySQL WHERE id=$id";
$result = mysqli_query($databaseconnection, $query);
?>
<!DOCTYPE html>
<html>
<?php require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/head.html';?>
    <body class="headerlogin">
        <header>
            <div class="wrapper">
            <?php require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/menu.html';?>
        </header>
    <div class='loginsection'>
        <?php echo "<p class='btn btn-danger'>Se ha eliminado el registro $id</p><br><br><a class='btn btn-link' href='/bp-admin/panel.php'>Volver al panel</a>"; ?>
    </div>
    <?php require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/footer.html';?>
</body>

</html>