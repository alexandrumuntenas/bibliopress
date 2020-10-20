<?php
//Importación de datos
require 'bp-config.php';
 
?>
<html>
    <title>
    <?php echo 'Biblioteca del ' . $sname;?>
    </title>
    <?php require 'bp-include/head.php';?>
    <script type='text/javascript' src='/bp-include/lives.js'></script>
    <link rel='stylesheet' type='text/css' href='/bp-include/lives.css'>
    <body>
        
        <header>
            <div class="wrapper">
            <?php require 'bp-include/menu.php';?>

            <div class="bp-header">
                <h2 class="bp-page-title">Búsqueda</h2>
            </div>
        </header>
        <section class="bp-section">
            <br>
            <br>
            <?php
            echo '<div class="row"><input class="buscador-ajax" type="text" id="search" placeholder="Introduce el título del libro" /></div>';
            echo '<div id="display"></div>';
            ?>
        </section>
        <footer class="page-footer bg-primary">
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bibliopress</a>
        </div>
        </footer>
    </body>
</html>