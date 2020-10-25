<!DOCTYPE html>
<html>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';
$id = $_REQUEST['id'];
$query = "SELECT * FROM `bp_catalogo` WHERE `ID` = '" . $id . "'";
$result = mysqli_query($databaseconnection, $query);
$row = mysqli_fetch_assoc($result);
$loggedin = $_COOKIE["loggedin"];
$fecha_actual = date('m/d/Y');
require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/head.php';

if ($sessionlogged == 1) {
    if ($sessionclass == 1) {
        echo '<body>';
    } else {
        echo '<body class="err404">';
    }
} else {
    echo '<body class="err404">';
}
if ($sessionlogged == 1) {
    if ($sessionclass == 1) {
        echo '<div class="bp-header">
        <h2 class="bp-page-title">Servicio de Préstamo</h2>
    </div>';
        require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/menu.php';
        $status = "";
        if (isset($_POST['new']) && $_POST['new'] == 1) {
        } else {
            echo '<section class="bp-section flex-column"><div class="row">
            <div class="bp-card card-body">
            <h5><strong>' . $row["TITULO"] . '</strong>';
            echo '</h5>
            <p><em>' . $row["AUTOR"] . '</em></p>
            <p><strong>ISBN</strong> <em>' . $row["ISBN"] . '</em></p>
            <p><strong>Ubicación</strong> <em>' . $row["UBICACION"] . '</p></em>
            <p><strong>Ejemplar</strong> <em>' . $row["EJEMPLAR"] . ' </em></p>
            <p><strong>Año de Publicación</strong> <em>' . $row["ANOPUB"] . '</em></p>
            <p><strong>Editorial</strong> <em>' . $row["EDITORIAL"] . '</em></p></div>';
            if ($row['DISPONIBILIDAD'] == 1) {
                echo '
            <div class="bp-card card-body">
            <h5><strong>Prestar libro al usuario</strong></h5>
            <form id="form_1388" class="appnitro"  method="post" action="prestar.php?id=' . $id . '">				
                        <ul>
                            
                        <li id="li_1">
                        <label class="description" for="element_1">Nombre </label>
                        <div>
                            <input id="element_1" name="element_1" class="element text large" type="text" maxlength="255" value=""/> 
                        </div> 
                        </li>		<li id="li_2">
                        <label class="description" for="element_2">Apellido </label>
                        <div>
                            <input id="element_2" name="element_2" class="element text large" type="text" maxlength="255" value=""/> 
                        </div> 
                        </li>
                        <li id="li_3">
                        <label class="description" for="element_3">Fecha de devolución </label>
                        <div>';
                echo date("d-m-Y", strtotime($fecha_actual . "+ 15 days"));
                echo '
                        </div> 
                        </li>
                        </ul>
                        <div class="modal-footer">
                            <input id="saveForm" class="btn btn-success" type="submit" name="submit" value="Prestar" />
                        </div>
                        </form>	
            </div></section>';
            } else {
                $fnamechecksql = "SELECT * FROM `$bbddusuarios` WHERE `USUARIO` = '" . $row['PRESTADOA'] . "'";
                $fnamedata = mysqli_query($databaseconnection, $fnamechecksql);
                $fnamecheck = mysqli_fetch_assoc($fnamedata);
                echo '<div class="bp-card card-body">
                <h5><strong>Gestionar Préstamo Activo</strong></h5>
                <table>
                <tbody>
                <tr>
                <th>
                Usuario
                </th>
                <td>
                '.$fnamecheck['FULLNAME'].'
                </td>
                </tr>
                <tr>
                <th>
                Fecha de Devolución
                </th>
                <td>
                '.$row['FECHADEV'].'
                </td>
                </tr>
                </tbody>
                </table>
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
                            <h2 style="color:#FFF; margin-bottom:15px;">Parece que te has perdido</h2>
                            <a class="btn btn-light" href="/">Llévame de vuelta</a></center>';
    }
} else {
    echo '<section class="error-container">
                        <span><span>4</span></span>
                        <span>0</span>
                        <span><span>3</span></span>
                      </section>
                      <center>
                      <h2 style="color:#FFF; margin-bottom:15px;">Parece que te has perdido</h2>
                      <a class="btn btn-light" href="/">Llévame de vuelta</a></center>';
};
?>

<div>
</div>
</div>
<footer class="page-footer bg-primary">
    <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bibliopress</a>
    </div>
</footer>
</body>

</html>