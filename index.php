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
                <h2 class="centered">Catálogo</h2>
            </div>
        </header>
        <section class="section">
            <div class="row">
            <?php 
                if ($resultado->num_rows > 0) {
                    //datos de cada columna
                    while($row = $resultado->fetch_assoc()) {
                        echo '';
                    }
                } else {
                    echo "No existe ningún registro";
                }
                ?>  
            </div>
        </section>
        <footer class="page-footer bg-primary">
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bibliopress</a>
        </div>
        </footer>
    </body>
</html>