<?php if (isset($_GET['pag'])) {
    if (mysqli_real_escape_string($databaseconnection, $_REQUEST['pag']) == null) {
        $pir = 1;
    } else {
        $pir = mysqli_real_escape_string($databaseconnection, $_REQUEST['pag']);
    }
} else {
    $pir = 1;
}

if (isset($_GET['resultados'])) {
    if (mysqli_real_escape_string($databaseconnection, $_REQUEST['resultados']) == null) {
        $qtyresultado = $CantidadMostrar;
    } else {
        $qtyresultado = mysqli_real_escape_string($databaseconnection, $_REQUEST['resultados']);
    }
} else {
    $qtyresultado = $CantidadMostrar;
}
?>

<body>
    <div>
        <header>
            <script>
                $(function() {
                    $('[data-toggle="tooltip"]').tooltip()
                })
            </script>
            <div class="bp-header">
                <h2 class="bp-page-title">Bienvenido</h2>
            </div>
        </header>
        <section class="bp-section">
            <div class="row">
                <a class="bp-card card-body" href="?r=site/catalogo">
                    <center><span class="landingicon"><i class="fas fa-book"></i>
                            </br>
                            Catálogo
                        </span>
                    </center>
                </a>
                <?php if ($sessionlogged == 0) { ?>
                    <a class="bp-card card-body" data-toggle="modal" data-target="#loginmodal" data-backdrop="false">
                        <center><span class="landingicon"><i class="fas fa-paper-plane"></i>
                                </br>
                                Solicitar libro
                            </span>
                        </center>
                        <a class="bp-card card-body" data-toggle="modal" data-target="#loginmodal" data-backdrop="false">
                            <center><span class="landingicon"><i class="fas fa-sign-in-alt"></i>
                                    </br>
                                    Iniciar Sesión
                                </span>
                            </center>
                        </a>
                    </a><?php } else { ?>
                    <a class="bp-card card-body" data-toggle="modal" data-target="#solicitar" data-backdrop="false">
                        <center><span class="landingicon"><i class="fas fa-paper-plane"></i>
                                </br>
                                Solicitar libro
                            </span>
                        </center>
                    </a>
                    <a class="bp-card card-body" href="?logout">
                        <center><span class="landingicon"><i class="fas fa-sign-out-alt"></i>
                                </br>
                                Cerrar Sesión
                            </span>
                        </center>
                    </a><?php } ?>
                <?php if ($sessionlogged == 1) { ?>
                    <a class="bp-card card-body" href="?r=site/admin/catalogo&organizacion=table">
                        <center><span class="landingicon"><i class="fas fa-book"></i>
                                </br>
                                Gestionar Catálogo
                            </span>
                        </center>
                    </a>
                    <a class="bp-card card-body" href="?r=site/admin/prestamos">
                        <center><span class="landingicon"><i class="fas fa-people-carry"></i>
                                </br>
                                Gestionar Préstamos
                            </span>
                        </center>
                    </a>
                <?php } ?>
            </div>
        </section>
    </div>
</body>

</html>