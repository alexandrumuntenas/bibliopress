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
                        <h2 class="bp-page-title">Gestionar Usuarios</h2>
                    </div>
                </header>
                <section class="bp-section">
                    <div>
                        
                    </div>
                    <?php
                    $resulta = mysqli_query($databaseconnection, "SELECT * FROM `$bbddusuarios`");
                    $qty = mysqli_num_rows($resulta);
                    echo '<p class="badge badge-success badge-pill">' . $qty . ' Registros</p>';
                    ?>
                    <div class="lectores">
                         <div class="table-responsive"><table class="table table-hover"   >
                            <thead class="thead-dark" >
                                <tr>
                                    <th>Correo Electrónico</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Grupo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($lectorresultado->num_rows > 0) {
                                    //datos de cada columna
                                    while ($row = $lectorresultado->fetch_assoc()) {
                                        echo '<tr>
                    <td data-label="Usuario"><br>' . $row["USUARIO"] . '</td>
                    <td data-label="Nombre"><br>' . $row["NOMBRE"] . '</td>
                    <td data-label="Apellidos"><br>' . $row["APELLIDOS"] . '</td>
                    <td data-label="Grupo"><br>' . $row["CLASE"] . '</td>
                    <td data-label="Acciones disponibles"><br><a style="color:blue;" href="functions/editusuarios.php?USUARIO=' . $row["USUARIO"] . '">Editar</a>       <form method="POST" action=""><input type="hidden" name="usuariodel" value="' . $row['USUARIO'] . '" /><input name="delus" type="submit" value="Eliminar"/></form></td>
                        </tr>';
                                    }
                                } ?>
                            </tbody>
                        </table></div>
                    </div>
            </div>
            </div>
            </div>
            </section>
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