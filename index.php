<?php
//Importación de datos
require 'bp-config.php';

?>
<html>
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
                        echo '<div class="cardse card-body">
                        <h5><strong>' . $row["TITULO"] . '</strong></h5>
                        <p><em>' . $row["AUTOR"] . '</em></p>
                        <p><strong>ISBN</strong> <em>' . $row["ISBN"] . '</em></p>
                        <p><strong>Ubicación</strong> <em>' . $row["UBICACION"] . '</p></em>
                        <p><strong>Ejemplar</strong> <em>' . $row["EJEMPLAR"] . ' </em></p>
                        <p><strong>Año de Publicación</strong> <em>' . $row["ANOPUB"] . '</em></p>
                        <p><strong>Editorial</strong> <em>' . $row["EDITORIAL"] . '</em></p>
                        </div>';
                    }
                } else {
                    echo "No existe ningún registro";
                }
                ?>  
            </div>
        </section>
        <footer class="page-footer bg-primary">
            <?php
            
            ?>
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bibliopress</a>
        </div>
        </footer>
    </body>
</html>