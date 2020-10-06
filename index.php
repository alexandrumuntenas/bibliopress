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
            <style type="text/css">
            .active > a{
            background: rgb(255,116,0); 
            }
            .ulp{
                margin-left: 0px;
                padding: 0px;
            } 
            .ulp > li{
                list-style: none;
                display: inline-block;
                margin-right:7px;
            }
            .ulp > li > a {
                color: #FFFFFF;
                text-decoration: none;
                padding: 5px 10px 5px 10px;
                display: block;
                background: #1e5799; /* Old browsers */
                border-radius: 20px;
            }
            .btnp > a{
                padding: 2px;
                background: #1e5799; /* Old browsers */
                border-radius: 2px;
                text-align: center;
                width:30px;
            }
            
        </style>
            <br>
            <br>
            <?php
            $result = mysqli_query($databaseconnection, "SELECT * FROM $tableMySQL");
            $qty = mysqli_num_rows($result);
            $qtya = $qty/9;
            $qtyp = round($qtya, 0, PHP_ROUND_HALF_UP);
            echo '<input type="text" id="search" class="buscadorajax" placeholder="Search" />';
            echo '<p class="badge badge-success badge-pill">'. $qty . ' Registros</p>                 ';
            echo '<p class="badge badge-danger badge-pill">'. $qtyp . ' Páginas totales</p>';

            echo '<div id="display"></div>';
            ?>
            <div class="row">
            <?php
            $CantidadMostrar=9;
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
                
                /*Sector de Paginacion */
                
                //Operacion matematica para botón siguiente y atrás 
                $IncrimentNum =(($compag +1)<=$TotalRegistro)?($compag +1):1;
                $DecrementNum =(($compag -1))<1?1:($compag -1);
            
                echo "<ul class='ulp'><li class=\"btnp\"><a href=\"?pag=".$DecrementNum."\"><</a></li>";
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
                    echo "<li class=\"active\"><a href=\"?pag=".$i."\">".$i."</a></li>";
                    }else {
                        echo "<li><a href=\"?pag=".$i."\">".$i."</a></li>";
                    }     		
                    }
                }
                echo "<li class=\"btnp\"><a href=\"?pag=".$IncrimentNum."\">></a></li></ul>";
            
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