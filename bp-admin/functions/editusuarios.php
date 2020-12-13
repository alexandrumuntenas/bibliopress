<!DOCTYPE html>
<html>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';
$userrequest = $_REQUEST['usuario'];
$getoldsql = "SELECT *  FROM $bbddusuarios WHERE `USUARIO` LIKE '$userrequest'";
$getoldquery = $databaseconnection->query($getoldsql);
$getoldresult = mysqli_fetch_assoc($getoldquery);
mysqli_data_seek($grupoquery, 0);
require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/head.php';
if ($sessionlogged == 1) {
    if ($sessionclass == 1) {
        echo '<div class="form">';
        require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/menu.php';
        if (isset($_POST['update'])) {
            $usuario = $_POST['celectronico'];
            $nombre = $_POST["nombre"];
            $apellidos = $_POST["apellidos"];
            $grupo = $_POST["grupo"];
            $newdatasql = "UPDATE `$bbddusuarios` set `USUARIO` = '" . $usuario . "', `NOMBRE`='" . $nombre . "', `APELLIDOS`='" . $apellidos . "', `CLASE`='" . $grupo . "' where `USUARIO`='" . $userrequest . "'";
            mysqli_query($databaseconnection, $newdatasql);
            echo "<meta http-equiv='refresh' content='0;url=/bp-admin/usuarios.php' />";
        } else { ?>
            <section class="bp-section">
                <div class="row d-flex justify-content">
                    <h2 class="editor">Editar lector <?php echo $getoldresult['FULLNAME']; ?></h2>
                </div>
                <form class="md-form" action="" method="POST">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm">
                                <div class="md-form">
                                    <input type="text" name="nombre" id="form1" class="form-control" value="<?php echo $getoldresult['NOMBRE']; ?>" required>
                                    <label for="form1">Nombre</label>
                                </div>

                                <div class="md-form">
                                    <input type="text" name="apellidos" id="form1" class="form-control" value="<?php echo $getoldresult['APELLIDOS']; ?>" required>
                                    <label for="form1">Apellidos</label>
                                </div>

                                <div class="md-form">
                                    <input type="text" name="celectronico" id="form1" class="form-control" value="<?php echo $getoldresult['USUARIO']; ?>" required>
                                    <label for="form1">Correo Electrónico</label>
                                </div>
                            </div>
                            <div class="col-sm">
                                <select selected="<?php echo $getoldresult['USUARIO']; ?>" class="form-control form-control-sm" id="grupo" name="grupo">
                                    <option value="No asignado"> No Asignado</option>';
                                    <?php
                                    while ($grupos = $grupoquery->fetch_assoc()) {
                                        echo '<option value="' . $grupos['NOMBRE'] . '">' . $grupos['NOMBRE'] . '</option>';
                                    } ?>
                                </select>
                                <img style="margin-right:10px;  vertical-align: middle;  width: 55px;  height: 55px;  border-radius: 50%;" src="<?php echo $getoldresult['AVATAR']; ?>"> </a>
                            </div>
                        </div>

                        <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" name="update" type="submit">Save</button>

                </form>
            </section>
<?php   }
    } else {
        echo "<meta http-equiv='refresh' content='0;url=/' />";
    }
} else {
    echo "<meta http-equiv='refresh' content='0;url=/' />";
};
?>

<div>
</div>
</div>
</body>

</html>