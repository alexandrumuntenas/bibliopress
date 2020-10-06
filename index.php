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
            $qtya = $qty/9;
            $qtyp = round($qtya, 0, PHP_ROUND_HALF_UP);
            echo '<p class="badge badge-success badge-pill">'. $qty . ' Registros</p>                 ';
            echo '<p class="badge badge-danger badge-pill">'. $qtyp . ' Páginas totales</p>';

            echo '<div id="display"></div>';
            ?>
            <div class="row">
            <?php
            if ($databaseconnection->connect_errno) {
                echo "Fallo al conectar a MySQL: (" . $databaseconnection->connect_errno . ") " . $databaseconnection->connect_error;
            }else{
                                // Validado de la variable GET
                    $compag         =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag']; 
                $TotalReg       =$databaseconnection->query("SELECT * FROM `bp_catalogo`");
                //Se divide la cantidad de registro de la BD con la cantidad a mostrar 
                $TotalRegistro  =ceil($TotalReg->num_rows/$CantidadMostrar);
                //Consulta SQL
                $consultavistas ="SELECT * FROM `bp_catalogo`
                                    ORDER BY
                                    id ASC
                                    LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
                $consulta=$databaseconnection->query($consultavistas);
    
                    echo '';
                while ($row=$consulta->fetch_row()) {
                    $long = 250;
                    $desc = substr($row[12], 0, $long);
                    echo '<div class="cardse card-body">
                    <h5><strong>' . $row[6] . '</strong></h5>
                    <p><em>' . $row[1] . '</em></p>
                    <p>' . $desc . '</p>
                    <a class="btn btn-light" href="view.php?id=' . $row[10] . '">Ver más</a>
                    </div>';
                };
                ?>
                </div> 
        <footer class="page-footer" style="margin-top: 50px;">
        <?php
                /*Sector de Paginacion */
                
                //Operacion matematica para botón siguiente y atrás 
                $IncrimentNum =(($compag +1)<=$TotalRegistro)?($compag +1):1;
                $DecrementNum =(($compag -1))<1?1:($compag -1);
            
                echo "<ul class='pagination'><li class=\"page-item\"><a class='page-link' href=\"?pag=".$DecrementNum."\">&laquo;</a></li>";
                //Se resta y suma con el numero de pag actual con el cantidad de 
                //números  a mostrar
                $Desde=$compag-(ceil($CantidadMostrar/2)-1);
                $Hasta=$compag+(ceil($CantidadMostrar/2)-1);
                
                //Se valida
                $Desde=($Desde<1)?1: $Desde;
                $Hasta=($Hasta<$CantidadMostrar)?$CantidadMostrar:$Hasta;
                //Se muestra los números de paginas
                for($i=$Desde; $i<=$Hasta;$i++){
                    //Se valida la paginacion total
                    //de registros
                    if($i<=$TotalRegistro){
                        //Validamos la pag activo
                    if($i==$compag){
                    echo "<li class=\"page-item active\"><a class='page-link' href=\"?pag=".$i."\">".$i."</a></li>";
                    }else {
                        echo "<li><a class='page-link' href=\"?pag=".$i."\">".$i."</a></li>";
                    }     		
                    }
                }
                echo "<li class=\"page-item\"><a class='page-link' href=\"?pag=".$IncrimentNum."\">&raquo;</a></li></ul>";
            
            }
            ?>
        </footer>
        </section>
        <footer class="page-footer bg-primary">
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bibliopress</a>
        </div>
        </footer>
    </body>
</html>