<!DOCTYPE html>
<html>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';
$USUARIO = $_REQUEST['USUARIO'];
$query = "SELECT * FROM `$bbddusuarios` WHERE `USUARIO` = '" . $USUARIO . "'";
$result = mysqli_query($databaseconnection, $query);
$row = mysqli_fetch_assoc($result);
require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/head.php';
if ($sessionlogged == 1) {
    if ($sessionclass == 1) {
        echo '<body>';
    } else {
        echo '<body class="err403">';
    }
} else {
    echo '<body class="err403">';
}
if ($sessionlogged == 1) {
    if ($sessionclass == 1) {
        echo '
    <div class="form">';
        require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/menu.php';
        $status = "";
        if (isset($_POST['new']) && $_POST['new'] == 1) {
            $USUARIO = $_REQUEST['USUARIO'];
            $fecha = date("Y-m-d H:i:s"); 
            $nombre = $_REQUEST["nombre"];
            $apellidos = $_REQUEST["APELLIDOS"];
            $grupo = $_REQUEST["GRUPO"];

            $update = "UPDATE `$bbddusuarios` set NOMBRE='" . $nombre . "', APELLIDOS='" . $apellidos . "', CLASE='" . $grupo . "' where USUARIO='" . $USUARIO . "'";
            mysqli_query($databaseconnection, $update);
            $status = "<div class='bp-card-info'><p class='btn btn-success'>Se ha actualizado el registro $USUARIO</p><br><br><a class='btn btn-link' href='/bp-admin/usuarios.php'>Volver al panel</a></div>";
            echo '<p style="color:#FF0000;">' . $status . '</p>';
        } else {
            echo '
            <div class="bp-card-info card-body">
            <h2><i class="fas fa-user-edit"></i> Editar Usuario '.$row['NOMBRE'].' ' .$row['APELLIDOS'].'</h2>
                <form name="form" method="post" action="">
                    <input style="float:right;" class="btn btn-danger" name="submit" type="submit" value="Actualizar" />
        
                         <div class="table-responsive"><table class="table table-hover"    style="overflow-x: scroll;">
                            <thead class="thead-dark" >
                                <tr>
                                    <th><input type="hidden" name="new" value="1" /><input name="USUARIO" type="hidden" value="' . $row['USUARIO'] . '" /><p><strong>Nombre <input class="form-control" type="text" name="nombre" placeholder="Escribe el nombre del lector" required value="' . $row['NOMBRE'] . '" /></p></th>
                                    <th><p>Apellidos <input class="form-control" type="text" name="APELLIDOS" placeholder="Escribe los apellidos del lector" required value="' . $row['APELLIDOS'] .
                '" /></strong></p></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><p><strong>GRUPO <small class="form-text text-muted">Grupo actual: ' . $row['CLASE'] . '</small><select class="form-control form-control-sm" id="GRUPO" name="GRUPO" value="">
                            <option value="No asignado">Selecciona el grupo</option>';
                        if ($gruposql->num_rows > 0) {
                            while ($grupos = $gruposql->fetch_assoc()) {
                                echo '<option value="' . $grupos['NOMBRE'] . '">' . $grupos['NOMBRE'] . '</option>';
                            }
                        }
                        echo '
                        </select></p></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table></div>
                    </form>
                </div>';
        };
    } else {

        echo '<section class="error-container">
                                    <span><span>4</span></span>
                                    <span>0</span>
                                    <span><span>3</span></span>
                                  </section>
                                  <center>
                                    <h2 style="color:#FFF; margin-bottom:15px;">No tienes permiso para acceder a esta página... :/</h2>
                                    <a class="btn btn-light" href="/">Llévame de vuelta</a></center>';
    }
} else {
    echo '<section class="error-container">
                                <span><span>4</span></span>
                                <span>0</span>
                                <span><span>3</span></span>
                              </section>
                              <center>
                              <h2 style="color:#FFF; margin-bottom:15px;">No tienes permiso para acceder a esta página... :/</h2>
                              <a class="btn btn-light" href="/">Llévame de vuelta</a></center>';
};
?>

<div>
</div>
</div>

</body>

</html>