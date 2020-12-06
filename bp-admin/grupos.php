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
                    <?php echo '
            '; ?>
                    <button type="button" style="margin-bottom:10px;" class="btn btn-primary" data-toggle="modal" data-target="#addgroup">
                        Añadir nuevo registro
                    </button>
                    <button type="button" style="margin-bottom:10px;" class="btn btn-success" data-toggle="modal" data-target="#promogrupo">
                        Promocionar
                    </button>
                     <div class="table-responsive"><table class="table table-hover"   >
                        <thead class="thead-dark" >
                            <tr>
                                <th>Nombre</th>
                                <th>Usuarios</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            mysqli_data_seek($gruposql, 0);
                            if ($gruposql->num_rows > 0) {
                                //datos de cada columna
                                while ($gr = $gruposql->fetch_assoc()) {
                                    echo '<tr><form method="POST" action="">
                        <td data-label="Nombre"><br>' . $gr["NOMBRE"] . '</td>
                        <td data-label="Usuarios"><br><button type="button" class="btn btn-light" disabled />Ver usuarios</button></td>
                        <td data-label="Acciones disponibles"><br><form method="POST" action=""><input type="hidden" name="grupodel" value="' . $gr['ID'] . '" /><input name="delgr" type="submit" value="Eliminar"/></form></td>
                        </form></tr>';
                                }
                            }; ?>
                        </tbody>
                    </table></div>
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