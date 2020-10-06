<?php
//Importación de datos
require '../bp-config.php';

?>
<html>
    <?php require '../bp-include/head.html';?>
    <body>
        <header>
            <div class="wrapper">
            <?php require '../bp-include/menu.html';?>

            <div class="header">
                <h2 class="centered">Dashboard</h2>
            </div>
        </header>
        <section class="section">
            <div>
                <h2 class="stitle">Registros</h2>
            </div>
            <center>
            <div class="btn-group" role="group">
            <a href="index.php" type="button" class="btn btn-primary">Inicio</a>
            <div class="btn-group" role="group">
                <a href="panel.php" class="btn btn-secondary">
                Catálogo</a>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <button href="panel.php" class="dropdown-item">
                    Añadir nuevo registro</button>
                    <a href="functions/abies.php" class="dropdown-item">Subir desde Abies</a>
                </div>
            </div>
            <a href="lectores.php" type="button" class="btn btn-secondary">Lectores</a>
            </div>
            </center>
        </section>
        <footer class="page-footer bg-primary">
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bibliopress</a>
        </div>
        </footer>
    </body>
</html>
