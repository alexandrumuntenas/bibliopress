<!DOCTYPE html>
<html>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';
require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/head.php';

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
        require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/menu.php';
        echo '
                    <div class="bp-header">
                        <h2 class="bp-page-title">Imprimir Catálogo</h2>
                    </div>
                    </header>';
        echo '
                    <section class="bp-section">
                    <script>
                    function printDiv(divName){
                        var printContents = document.getElementById(divName).innerHTML;
                        var originalContents = document.body.innerHTML;
            
                        document.body.innerHTML = printContents;
            
                        window.print();
            
                        document.body.innerHTML = originalContents;
            
                    }
                </script>
                    </div><input class="btn btn-primary" style="margin-bottom:30px;" type="button" onclick="printDiv(\'imprimircatalogo\')" value="Imprimir catálogo" />
                    ';
        echo '<div id="imprimircatalogo">
<h2>Catálogo del ' . $sname . '</h2>
                    <table>
                        <thead>
                        <tr>
                            <th>Título del libro</th>
                            <th>Autor</th>
                            <th>Ejemplar</th>
                            <th>Editorial</th>
                            <th>Disponibilidad</th>
                        </tr>
                        </thead>
                        <tbody>';
        if ($lectorresultado->num_rows > 0) {
            //datos de cada columna
            while ($row = $resultado->fetch_assoc()) {
                echo '<tr>
                            <td data-label="Título del libro"><br>' . $row["TITULO"] . '</td>
                            <td data-label="Autor"><br>' . $row["AUTOR"] . '</td>
                            <td data-label="Ejemplar"><br>' . $row["EJEMPLAR"] . '</td>
                            <td data-label="Editorial"><br>' . $row["EDITORIAL"] . '</td>
                            <td data-label="Disponibilidad"><br>                    ';
                if ($row['DISPONIBILIDAD'] == 1) {
                    echo '✓</p>';
                } else {
                    echo '✗</p>';
                }
                echo '</tr>';
            }
            echo '
                        </tbody>
                     </table>
                     </div></div>
                </section>
                ';
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
                        <span><span>3</span></span>
                      </section>
                      <center>
                      <h2 style="color:#FFF; margin-bottom:15px;">Parece que te has perdido</h2>
                      <a class="btn btn-light" href="/">Llévame de vuelta</a></center>';
};
?>

<div>
</div>
</div>
<footer class="page-footer bg-primary">
    <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bibliopress</a>
    </div>
</footer>
</body>

</html>