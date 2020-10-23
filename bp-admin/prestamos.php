<html>
<?php 
require '../bp-config.php';
require '../bp-include/head.php';

if ($sessionlogged == 1) {
    if ($sessionclass == 1) {
        echo '<body>';
    } else {
        echo '<body class="err404">';
    }
} else {
    echo '<body class="err404">';
} 
if ($sessionlogged == 1) {
    if ($sessionclass == 1) {
        echo '';
        echo '<header><div class="wrapper">';
        require '../bp-include/menu.php';
        echo '
                    <div class="bp-header">
                        <h2 class="bp-page-title">Gestionar préstamos</h2>
                    </div>
                    </header>';
        echo '
                    <section class="bp-section">
                    </div>
                    ';
        $resulta = mysqli_query($databaseconnection, "SELECT * FROM `" .$tableMySQL. "` WHERE `DISPONIBILIDAD` = 0");
        $qty = mysqli_num_rows($resulta);
        echo '<p class="badge badge-success badge-pill">' . $qty . ' Registros</p>';
        echo '<div class="lectores">
        
                    <table id="tb-pres">
                    <input class="inputbusqueda" type="text" id="titulolibro" onkeyup="ttlibro()" placeholder="Busca por título del libro..." title="Escribe el título del libro">
                        <thead>

                        <tr>
                            <th>Título del Libro</th>
                            <th>Fecha de préstamo</th>
                            <th>Fecha de devolución</th>
                            <th>Usuario</th>
                        </tr>
                        </thead>
                        <tbody>';
        if ($resulta->num_rows > 0) {
            //datos de cada columna
            while ($row = $resulta->fetch_assoc()) {
        $nombre = mysqli_query($databaseconnection, "SELECT * FROM `" .$bbddusuarios. "` WHERE `USUARIO` LIKE '" .$row["PRESTADOA"]. "'");
        $data = $nombre->fetch_assoc();
                echo '<tr>
                            <td>' . $row["TITULO"] . '</td>
                            <td>' . $row["NOMBRE"] . '</td>
                            <td>' . $row["FECHADEV"] . '</td>
                            <td>' . $data["FULLNAME"] . '</td>
                            <td><a style="color:green;" href="functions/devolver.php?id=' . $row["ID"] . '">Devolver</a></td>
                        </tr>';
            }
            echo '
                        </tbody>
                     </table>
                     </div>
                </section><script>function ttlibro() {
                    var input, filter, table, tr, td, i, txtValue;
                    input = document.getElementById("titulolibro");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("tb-pres");
                    tr = table.getElementsByTagName("tr");
                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[0];
                        if (td) {
                            txtValue = td.textContent || td.innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                            } else {
                                tr[i].style.display = "none";
                            }
                        }
                    }
                }
                
                function uslibro() {
                    var input, filter, table, tr, td, i, txtValue;
                    input = document.getElementById("uslibro");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("tb-pres");
                    tr = table.getElementsByTagName("tr");
                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[3];
                        if (td) {
                            txtValue = td.textContent || td.innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                            } else {
                                tr[i].style.display = "none";
                            }
                        }
                    }
                }
                
                </script>';
        }
    } else {

        echo '<section class="error-container">
                    <span><span>4</span></span>
                    <span>0</span>
                    <span><span>4</span></span>
                  </section>
                  <center>
                    <h2 style="color:#FFF; margin-bottom:15px;">Parece que te has perdido</h2>
                    <a class="btn btn-light" href="/">Llévame de vuelta</a></center>';
    }
} else {
    echo '<section class="error-container">
                <span><span>4</span></span>
                <span>0</span>
                <span><span>4</span></span>
              </section>
              <center>
              <h2 style="color:#FFF; margin-bottom:15px;">Parece que te has perdido</h2>
              <a class="btn btn-light" href="/">Llévame de vuelta</a></center>';
};
?>



<footer class="page-footer bg-primary">
    <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bibliopress</a>
    </div>
</footer>
</body>

</html>