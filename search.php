<?php
//Importación de datos
require 'bp-config.php';
 
?>
<html>
    <title>
    <?php echo 'Biblioteca del ' . $sname;?>
    </title>
    <?php require 'bp-include/head.html';?>
    <body>
        
        <header>
            <div class="wrapper">
            <?php require 'bp-include/menu.html';?>

            <div class="header">
                <h2 class="centered">Búsqueda</h2>
            </div>
        </header>
        <section class="section">
            <br>
            <br>
            <?php
            echo '<div class="row"><input class="buscador-ajax" type="text" id="search" placeholder="Introduce el título del libro o el nombre del autor" /></div>';
            echo '<div id="display"></div>';
            ?>
        </section>
        <footer class="page-footer bg-primary">
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bibliopress</a>
        </div>
        </footer>
    </body>
</html>