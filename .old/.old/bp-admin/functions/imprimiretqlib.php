<!DOCTYPE html>
<html>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';
require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/head.php';

if ($sessionlogged == 1) {
    if ($sessionclass == 1) {
        echo '<body>';
    } else {
        echo '<body class="err403">';
    }
} else {
    echo '<body class="err403">';
}
if ($sessionlogged == 1) {
    if ($sessionclass == 1) {
        echo '';
        echo '<header><div class="wrapper">';
        require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/menu.php';
        echo '
                    <div class="bp-header">
                        <h2 class="bp-page-title">Imprimir Códigos de Barras</h2>
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
<h2>Catálogo del ' . $sname . '</h2>';
        if ($lectorresultado->num_rows > 0) {
            //datos de cada columna
            while ($row = $resultado->fetch_assoc()) {
                echo '<img alt="' . $row["TITULO"] . '" src="/bp-include/cdgbra.php?text=' . $row["ID"] . '&print=true&size=40"><br>';
            }
        }
    } else {

        echo '<section class="error-container">
                            <span><span>4</span></span>
                            <span>0</span>
                            <span><span>4</span></span>
                          </section>
                          <center>
                            <h2 style="color:#FFF; margin-bottom:15px;">No tienes permiso para acceder a esta página... :/</h2>
                            <a class="btn btn-light" href="/">Llévame de vuelta</a></center>';
    }
} else {
    echo '<section class="error-container">
                        <span><span>4</span></span>
                        <span>0</span>
                        <span><span>3</span></span>
                      </section>
                      <center>
                      <h2 style="color:#FFF; margin-bottom:15px;">No tienes permiso para acceder a esta página... :/</h2>
                      <a class="btn btn-light" href="/">Llévame de vuelta</a></center>';
};
?>

<div>
</div>
</div>
</body>

</html>