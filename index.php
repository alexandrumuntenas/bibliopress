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
            <br>
            <br>
            <?php
            $result = mysqli_query($databaseconnection, "SELECT * FROM $tableMySQL");
            $qty = mysqli_num_rows($result);
            $qtyp = $qty/9;
            echo '<p class="badge badge-success badge-pill">'. $qty . ' Registros</p>                 ';
            echo '<p class="badge badge-danger badge-pill">'. $qtyp . ' Páginas totales</p>';
            ?>
            <div class="row">
                
            <?php 
                if ($resultado->num_rows > 0) {
                    //datos de cada columna
                    
                    while($row = $resultado->fetch_assoc()) {
                        $long = 250;
                        $desc = substr($row['DESCRIPCION'], 0, $long);
                        echo '<div class="cardse card-body">
                        <h5><strong>' . $row["TITULO"] . '</strong></h5>
                        <p><em>' . $row["AUTOR"] . '</em></p>
                        <p>' . $desc . '</p>
                        <a class="btn btn-light" href="view.php?id=' . $row["ID"] . '">Ver más</a>
                        </div>';
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