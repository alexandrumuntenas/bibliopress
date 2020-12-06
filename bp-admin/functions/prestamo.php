<!DOCTYPE html>
<html>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';
$id = $_REQUEST['id'];
$query = "SELECT * FROM `$bbddcatalogo` WHERE `ID` = '" . $id . "'";
$result = mysqli_query($databaseconnection, $query);
$row = mysqli_fetch_assoc($result);
$fecha_actual = date('m/d/Y');
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
        echo '<div class="bp-header">
        <h2 class="bp-page-title">Servicio de Préstamo</h2>
    </div>';
        require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/menu.php';
        $status = "";
        if (isset($_POST['new']) && $_POST['new'] == 1) {
        } else { ?>
            <section class="bp-section flex-column">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row["TITULO"]; ?></h5>
                            <p class="card-text"><em><?php echo $row["AUTOR"]; ?></em></p>
                            <p><strong>ISBN</strong> <em><?php echo $row["ISBN"]; ?></em></p>
                            <p><strong>Ubicación</strong> <em><?php echo $row["UBICACION"]; ?></p></em>
                            <p><strong>Ejemplar</strong> <em><?php echo $row["EJEMPLAR"]; ?></em></p>
                            <p><strong>Año de Publicación</strong> <em><?php echo $row["ANOPUB"]; ?></em></p>
                            <p><strong>Editorial</strong> <em><?php echo $row["EDITORIAL"]; ?></em></p>
                        </div>
                    </div>

                    <?php if ($row['DISPONIBILIDAD'] == 1) { ?>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Prestar libro al usuario</h5>
                                <form id="form_1388" method="post" action="prestar.php?id=<?php echo $id; ?>">
                                    <ul>

                                        <li id="li_1">
                                            <label class="description" for="element_1">Nombre </label>
                                            <div>
                                                <input id="element_1" name="element_1" class="form-control mb-4" type="text" maxlength="255" value="" />
                                            </div>
                                        </li>
                                        <li id="li_2">
                                            <label class="description" for="element_2">Apellido </label>
                                            <div>
                                                <input id="element_2" name="element_2" class="form-control mb-4" type="text" maxlength="255" value="" />
                                            </div>
                                        </li>
                                        <li id="li_3">
                                            <label class="description" for="element_3">Fecha de devolución </label>
                                            <div>
                                                <input class="form-control mb-4" value="<?php echo date("d-m-Y", strtotime($fecha_actual . "+ 15 days")); ?>" readonly />
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="modal-footer">
                                        <input id="saveForm" class="btn btn-success" type="submit" name="submit" value="Prestar" />
                                    </div>
                                </form>
                            </div>
                        </div>
            </section>
<?php } else {
                        $fnamechecksql = "SELECT * FROM `$bbddusuarios` WHERE `USUARIO` = '" . $row['PRESTADOA'] . "'";
                        $fnamedata = mysqli_query($databaseconnection, $fnamechecksql);
                        $fnamecheck = mysqli_fetch_assoc($fnamedata);
                        echo '<div class="bp-card card-body">
                <h5><strong>Gestionar Préstamo Activo</strong></h5>
                 <div class="table-responsive"><table class="table table-hover"   >
                <tbody>
                <tr>
                <th>
                Usuario
                </th>
                <td>
                ' . $fnamecheck['FULLNAME'] . '
                </td>
                </tr>
                <tr>
                <th>
                Fecha de Devolución
                </th>
                <td>
                ' . $row['FECHADEV'] . '
                </td>
                </tr>
                </tbody>
                </table></div>
                <div class="modal-footer">
                            <a class="btn btn-primary" href="prorroga.php?id=' . $row["ID"] . '">Aplazar devolución</a>    <a class="btn btn-danger" style="margin-left: 10px;" href="devolver.php?id=' . $row["ID"] . '">Devolver</a>
                        </div>
                </section>';
                    }
                }
            } else {

                echo '<section class="error-container">
                            <span><span>4</span></span>
                            <span>0</span>
                            <span><span>4</span></span>
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