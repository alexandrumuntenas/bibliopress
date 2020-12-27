<?php
$registro = mysqli_query($databaseconnection, "SELECT * FROM `$bbddlog` LIMIT 3");
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
                        <h5>Datos del sitio</h5>
                        <p>Versión de bibliopress: 1.0</p>
                        <p>Nombre del centro: <?php echo $sname; ?></p>
                        <p>Ruta del sitio: <?php echo $_SERVER['DOCUMENT_ROOT']; ?></p>
                        <p>Ruta de la instalación de Bibliopress: <?php echo FS_ROOT . '/'; ?>
                    </div>
                    <div class="bp-card card-body">
                        <h5>Importar datos</h5>
                        <a class="btn btn-primary btn-sm" type="link" data-toggle="modal" data-target="#subirabies">Importar catálogo desde Abies</a>
                        <a class="btn btn-primary btn-sm" type="link" data-toggle="modal" data-target="#subirbiblioweb">Importar catálogo desde Biblioweb</a>
                    </div>
                    <div class="bp-card card-body">
                        <h5>Últimos movimientos</h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                    <?php
                                    if ($registro->num_rows > 0) {
                                        while ($registrorow = $registro->fetch_assoc()) {
                                            echo '<tr>
                                        <td>' . $registrorow["TTY"] . ' ejecutado el ' . $registrorow["FECHA"] . ' por ' . $registrorow["USUARIO"] . ' (' . $registrorow["IP"] . ')</td>

                                    </tr>';
                                        }
                                    } else {
                                        echo "<tr><td>No hay registros disponibles</td></tr>";
                                    }
                                    ?>
                                    <tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a class="btn btn-primary btn-sm" href="?r=site/admin/log">Ver movimientos en el sitio</a>
                    </div>
                    <div class="bp-card card-body" style="filter:blur(10px)">
                        <h5>Configuración del sitio</h5>
                        <p>Seguimos trabajando en ello</p>
                    </div>
                    <div class="bp-card card-body" style="filter:blur(10px)">
                        <h5>Actualizaciones</h5>
                        <p>Actualmente no hay actualizaciones disponibles</p>
                    </div>
                </div>
        <?php
            }
        } ?>
    </section>


</body>

</html>