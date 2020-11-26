<html>
<?php
require '../bp-config.php';
require '../bp-include/head.php';

if ($sessionlogged == 1) {
    if ($sessionclass == 1) {
        echo '<body>';
    } else {
        echo '<body class="err403">';
    }
} else {
    echo '<body class="err403">';
}

require '../bp-include/menu.php';

if (isset($_POST['submit'])) {
    $nombre = $_POST["element_1"];
    $insert = "INSERT INTO `$bbddgrupos` (`NOMBRE`) VALUES ('$nombre')";
    $databaseconnection->query($insert);
    echo mysqli_error($databaseconnection);
}
if ($sessionlogged == 1) {
    if ($sessionclass == 1) {
        echo '<header>
                    <div class="bp-header">
                        <h2 class="bp-page-title">Gestionar Grupos</h2>
                    </div>
                    </header>
                    <section class="bp-section">
                    ';

        echo '<div class="lectores">
        <button type="button" style="margin-bottom:10px;" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                    Añadir nuevo registro
                    </button>
        <button type="button" style="margin-bottom:10px;" class="btn btn-success" data-toggle="modal" data-target="#promotemodal">
                    Promocionar 
                    </button>
                    <table>
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Usuarios</th>
                        </tr>
                        </thead>
                        <tbody>';
        mysqli_data_seek($gruposql, 0);
        if ($gruposql->num_rows > 0) {
            //datos de cada columna
            while ($gr = $gruposql->fetch_assoc()) {
                echo '<tr>
                            <td data-label="Nombre"><br>' . $gr["NOMBRE"] . '</td>
                            <td data-label="Usuarios"><br><button type="button" class="btn btn-light" disabled/>Ver usuarios</button></td>
                            <td data-label="Acciones disponibles"><br><a style="color:red;" href="functions/delgrupo.php?GRUPO=' . $gr["ID"] . '">Eliminar</a></td>
                        </tr>';
            }
        }
        echo '
                        </tbody>
                     </table>
                     </div>
                </section></div>';
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
                <span><span>4</span></span>
              </section>
              <center>
              <h2 style="color:#FFF; margin-bottom:15px;">No tienes permiso para acceder a esta página... :/</h2>
              <a class="btn btn-light" href="/">Llévame de vuelta</a></center>';
};
?>



<footer class="page-footer bg-primary">
    <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bibliopress</a>
    </div>
</footer>
</body>

</html>