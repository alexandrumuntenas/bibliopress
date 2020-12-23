<?php require '../bp-config.php';
?>
<html>
<title>
    <?php echo 'Biblioteca del ' . $sname; ?>
</title>
<?php require '../bp-include/head.php';

if ($sessionlogged == 1) {
    if ($sessionclass == 1) {
?>

        <body>
            <?php require '../bp-include/menu.php'; ?>
            <div>
                <header>
                    <div class="bp-header">
                        <h2 class="bp-page-title">Gestionar Préstamos</h2>
                    </div>
                </header>
                <section class="bp-section">
                    <div>
                        <input class="inputbusqueda" type="text" id="titulolibro" onkeyup="ttlibro()" placeholder="Busca por título del libro..." title="Escribe el título del libro">
                        <div class="lectores">
                            <div class="table-responsive">
                                <table class="table table-hover" id="tb-pres">
                                    <div class="row"></div>
                                    <thead class="thead-dark">

                                        <tr>
                                            <th>Título del Libro</th>
                                            <th>Fecha de devolución</th>
                                            <th>Usuario</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($resulta->num_rows > 0) {
                                            //datos de cada columna
                                            while ($row = $resulta->fetch_assoc()) {
                                                $nombre = mysqli_query($databaseconnection, "SELECT * FROM `$bbddusuarios` WHERE `USUARIO` LIKE '" . $row["PRESTADOA"] . "'");
                                                $data = $nombre->fetch_assoc();
                                                echo '<tr>
                                <td data-label="Título del libro"><br>' . $row["TITULO"] . '</td>
                                <td data-label="Fecha de devolución"><br>' . $row["FECHADEV"] . '</td>
                                <td data-label="Título prestado al usuario "><br>' . $data[1] . '</td>
                                <td data-label="Acciones disponibles"><br><a style="color:blue;" href="functions/prorroga.php?id=' . $row["ID"] . '">Aplazar devolución</a>    <a style="color:green;" href="functions/devolver.php?id=' . $row["ID"] . '">Devolver</a></td>
                        </tr>';
                                            }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
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