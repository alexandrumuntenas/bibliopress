<?php require '../bp-config.php';
?>
<html>
<title>
    <?php echo 'Biblioteca del ' . $sname; ?>
</title>
<?php
require '../bp-include/head.php';
$query = "SELECT * FROM `$bbddcatalogo` WHERE `PRESTADOA` = '" . $sessionus . "' LIMIT 5";
$result = mysqli_query($databaseconnection, $query);
$querylector = "SELECT *  FROM `bp_usuarios` WHERE `USUARIO` LIKE '" . $sessionus . "'";
$qlectorre = mysqli_query($databaseconnection, $querylector);
$qlector = mysqli_fetch_assoc($qlectorre);
?>

<body>
    <?php if ($sessionlogged == 1) { ?>
        <?php require '../bp-include/menu.php'; ?>
        <div>
            <header>
                <div class="bp-header">
                    <h2 class="bp-page-title">Mi Área Personal</h2>
                </div>
            </header>
            <section class="bp-section">
                <div>
                    <center>
                            <div id="snackbar">Some text some message..</div>
                            <a href="index.php" type="button" class="btn btn-primary">Inicio</a>
                            <a href="miperfil.php" type="button" class="btn btn-secondary">Mi Perfil <i class="fas fa-id-card-alt"></i></a>
                            <a href="logout.php" type="button" class="btn btn-danger">Cerrar Sesión <i class="fas fa-sign-out-alt"></i></a>
                        </div>
                    </center>
                    <div class="row">
                        <div class="bp-card card-body">
                            <h5>Préstamos Activos</h5>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Titulo </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<tr>
                                        <td>' . $row["TITULO"] . '</td>

                                    </tr>';
                                    }
                                    ?>
                                    <tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="bp-card card-body">
                            <h5>En Lista de Espera</h5>
                            <p>No te emociones, seguimos trabajando en ello</p>
                        </div>
                        <div class="bp-card card-body">
                            <h5>Tus Últimas Lecturas</h5>
                            <p>No te emociones, seguimos trabajando en ello</p>
                        </div>
                        <?php if ($sessionclass == 1) {
                            echo '
                            <div class="bp-card card-body">
                                <h5>Sobre la Biblioteca</h5>
                                <p>Biblioteca del ' . $sname . '</p>
                                <p>Hay un total de ' . $numerolibros . ' libros en todo el catálogo, de los cuales, ' . $qtyprestados . ' están prestados</p>
                            </div>
                            ';
                        } ?>
                    </div>
            </section>
        </div>
        </section>
        </div>
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
            </center><?php } ?>
        <footer class="page-footer bg-primary">
            <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . date("Y") . " " . $sname; ?> | Powered by Bibliopress</a>
            </div>
        </footer>
        </body>

</html>