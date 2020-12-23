<?php require '../bp-config.php';
?>
<html>
<title>
    <?php echo 'Gestionar Grupos > Biblioteca del ' . $sname; ?>
</title>
<?php

require '../bp-include/head.php';

if ($sessionlogged == 1) {
    if ($sessionclass == 1) {
?>

        <body>
            <?php require '../bp-include/menu.php'; ?>
            <div>
                <header>
                    <div class="bp-header">
                        <h2 class="bp-page-title">Gestionar Grupos</h2>
                    </div>
                </header>
                <section class="bp-section">
                    <div class="form-inline">
                        <button type="button" style="margin-bottom:10px; margin-left: 0px;" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addgroup">
                            Añadir nuevo registro
                        </button>
                        <button type="button" style="margin-bottom:10px;" class="btn btn-success btn-sm" data-toggle="modal" data-target="#promogrupo">
                            Promocionar
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Usuarios</th>
                                    <th>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $compag         = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];
                                $TotalReg       = $databaseconnection->query("SELECT * FROM `$bbddgrupos`");
                                $TotalRegistro  = ceil($TotalReg->num_rows / $CantidadMostrar);
                                $consultavistas = "SELECT * FROM `$bbddgrupos`
                                    ORDER BY
                                    id ASC
                                    LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar;
                                $consulta = $databaseconnection->query($consultavistas);
                                if ($consulta->num_rows > 0) {
                                    //datos de cada columna
                                    while ($gr = $consulta->fetch_assoc()) {
                                        echo '<tr>
                                    <form method="POST" action="">
                                        <td data-label="Nombre"><br>' . $gr["NOMBRE"] . '</td>
                                        <td data-label="Usuarios"><br><a href="usuarios.php?grupo=' . $gr["NOMBRE"] . '" type="button" class="btn btn-light btn-sm"/>Ver usuarios</a></td>
                                        <td data-label="Acciones disponibles"><br>
                                            <form method="POST" action=""><input type="hidden" name="grupodel" value="' . $gr['ID'] . '" /><input name="delgr" type="submit" value="Eliminar" /></form>
                                        </td>
                                    </form>
                                </tr>';
                                    }
                                }; ?>
                            </tbody>
                        </table>
                        <?php
                        $IncrimentNum = (($compag + 1) <= $TotalRegistro) ? ($compag + 1) : 1;
                        $DecrementNum = (($compag - 1)) < 1 ? 1 : ($compag - 1);
                        echo "<ul class='pagination pg-blue'><li class=\"page-item\"><a class='page-link' href=\"?pag=" . $DecrementNum . "\">&laquo;</a></li>";
                        $Desde = $compag - (ceil($CantidadMostrar / 2) - 1);
                        $Hasta = $compag + (ceil($CantidadMostrar / 2) - 1);
                        $Desde = ($Desde < 1) ? 1 : $Desde;
                        $Hasta = ($Hasta < $CantidadMostrar) ? $CantidadMostrar : $Hasta;
                        for ($i = $Desde; $i <= $Hasta; $i++) {
                            if ($i <= $TotalRegistro) {
                                if ($i == $compag) {
                                    echo "<li class=\"page-item active\"><a class='page-link' href=\"?pag=" . $i . "\">" . $i . "</a></li>";
                                } else {
                                    echo "<li class=\"page-item\"><a class='page-link' href=\"?pag=" . $i . "\">" . $i . "</a></li>";
                                }
                            }
                        }
                        echo "<li class=\"page-item\"><a class='page-link' href=\"?pag=" . $IncrimentNum . "\">&raquo;</a></li></ul>";
                        ?>
                    </div>
                </section>
            </div>
            </div>

            </div>
        <?php } else { ?>

            <body class="err403">
                <section class="error-container">
                    <span><span>4</span></span>
                    <span>0</span>
                    <span><span>3</span></span>
                </section>
                <center>
                    <h2 style="color:#FFF; margin-bottom:15px;">No tienes permiso para acceder a esta página... :/</h2>
                    <a class="btn btn-light" href="/">Llévame de vuelta</a>
                </center>
            <?php };
    } else { ?>

            <body class="err403">
                <section class="error-container">
                    <span><span>4</span></span>
                    <span>0</span>
                    <span><span>3</span></span>
                </section>
                <center>
                    <h2 style="color:#FFF; margin-bottom:15px;">No tienes permiso para acceder a esta página... :/</h2>
                    <a class="btn btn-light" href="/">Llévame de vuelta</a>
                </center>
            <?php } ?>
            <footer class="page-footer bg-primary">
                <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . date("Y") . " " . $sname; ?> | Powered by Bibliopress</a>
                </div>
            </footer>
            </body>

</html>