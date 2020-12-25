<?php require '../bp-include/head.php';
$prpte = "SELECT * FROM `$bbddlog` ORDER BY ID DESC LIMIT 5";
$prptequery = mysqli_query($databaseconnection, $prpte);
?>

<body>
    <header>
        <div class="bp-header">
            <h2 class="bp-page-title"><?php if ($sessionlogged == 1) {
                                            if ($sessionclass == 1) { ?>
                        Configuración del Sitio
                    <?php } else { ?> 4 0 3 <?php }
                                        } else { ?> 4 0 3 <?php } ?></h2>
    </header>
    <section class="bp-section">
        <?php if ($sessionlogged == 1) {
            if ($sessionclass == 1) {
        ?>
                <div class="row">
                    <div class="bp-card card-body">
                        <h5>Configuración del catálogo</h5>
                        <p>Vista predeterminada</p>
                        <p>Cantidad de registros</p>
                    </div>
                    <div class="bp-card card-body">
                        <h5>Registro</h5>
                        <div class="table-responsive">
                            <table class="table table-hover" style="filter:blur(1px)">
                                <tbody>
                                    <?php
                                    if ($prptequery->num_rows > 0) {
                                        while ($prpterow = $prptequery->fetch_assoc()) {
                                            echo '<tr>  
                                        <td>' . $prpterow["TTY"] . ' <em>activado por </em><strong>' . $prpterow["USUARIO"] . '</strong></td>

                                    </tr>';
                                        }
                                    } else {
                                        echo "<tr><td>No tienes préstamos pendiente de devolución</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <a href="registro.php" class="btn-primary btn btn-sm">Ver registro completo</a>
                        </div>
                    </div>
                    <div class="bp-card card-body">
                        <h5>Actualizaciones</h5>
                        <p>Actualmente no hay actualizaciones disponibles</p>
                    </div>
                </div>
        <?php
            }
        } ?>
    </section>

    <footer class="page-footer bg-primary">
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . date("Y") . " " . $sname; ?> | Powered by Bibliopress</a>
        </div>
    </footer>
</body>

</html>