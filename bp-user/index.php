<?php
//Importación de datos
require '../bp-config.php';
$query = "SELECT * FROM `$tableMySQL` WHERE `PRESTADOA` = '" . $sessionus . "' LIMIT 5";
$result = mysqli_query($databaseconnection, $query);
$querylector = "SELECT *  FROM `bp_usuarios` WHERE `USUARIO` LIKE '".$sessionus."'";
$qlectorre = mysqli_query($databaseconnection, $querylector);
$qlector = mysqli_fetch_assoc($qlectorre);
?>

<html>
<?php require '../bp-include/head.php'; ?>

<body>
    <header>

        <div class="wrapper">
            <?php require '../bp-include/menu.php'; ?>
            <?php if ($sessionlogged == 1) {
                echo '
            <div class="bp-header">
                <h2 class="bp-page-title">Área Personal</h2>
            </div>';
            } else {
                echo '
                <div class="bp-header">
                    <h2 class="bp-page-title">Iniciar Sesión</h2>
                </div>';
            }; ?>
    </header>
    <?php if ($sessionlogged == 1) {
        if ($sessionclass == 1) {
            echo '<section class="bp-section flex-column"><center>
            <div class="btn-group" role="group">
            <a href="index.php" type="button" class="btn btn-primary">Inicio</a>
            <a href="logout.php" type="button" class="btn btn-danger">Cerrar Sesión <i class="fas fa-sign-out-alt"></i></a>
            </center><div class="row">
            <div class="bp-card card-body">
            <h5>Préstamos Activos</h5>
            <table>
            <thead>
            <tr>
                <th>Titulo </th>

            </tr>
            </thead>
            <tbody>

            ';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                            <td>' . $row["TITULO"] . '</td>
                        
                        </tr>';
            }
            echo '
            <tr>
            </tr>
            </tbody>
            </table>
            </div>
            <div class="bp-card card-body">
            <h5>En Lista de Espera</h5><p>No te emociones, seguimos trabajando en ello</p></div>
            <div class="bp-card card-body">
            <h5>Tus Últimas Lecturas</h5><p>No te emociones, seguimos trabajando en ello</p>
            </div>
            <div class="bp-card card-body"><h5>Sobre la Biblioteca</h5><p>Biblioteca del ' . $sname . '</p><p>Hay un total de ' . $numerolibros . ' libros en todo el catálogo, de los cuales, ' . $qtyprestados . ' están prestados</p></div><div class="bp-card card-body"><h5>Este es tu código de barras para iniciar sesión</h5><p>Lo siento, los administradores no tienen un código de barras para iniciar sesión.</div>
            </div></section>';
        } else {
            echo '<section class="bp-section flex-column"><center>
            <div class="btn-group" role="group">
            <a href="index.php" type="button" class="btn btn-primary">Inicio</a>
            <a href="logout.php" type="button" class="btn btn-danger">Cerrar Sesión <i class="fas fa-sign-out-alt"></i></a>
            </center><div class="row">
            <div class="bp-card card-body">
            <h5>Préstamos Activos</h5>
            <table>
            <thead>
            <tr>
                <th>Titulo </th>

            </tr>
            </thead>
            <tbody>

            ';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                            <td>' . $row["TITULO"] . '</td>
                        
                        </tr>';
            }
            echo '
            <tr>
            </tr>
            </tbody>
            </table>
            </div>
            <div class="bp-card card-body">
            <h5>En Lista de Espera</h5><p>No te emociones, seguimos trabajando en ello</p></div>
            <div class="bp-card card-body">
            <h5>Tus Últimas Lecturas</h5><p>No te emociones, seguimos trabajando en ello</p>
            </div>
            <div class="bp-card card-body"><h5>Sobre la Biblioteca</h5><p>Biblioteca del ' . $sname . '</p><p>Hay un total de ' . $numerolibros . ' libros en todo el catálogo, de los cuales, ' . $qtyprestados . ' están prestados</p></div><div class="bp-card card-body"><h5>Este es tu código de barras para iniciar sesión</h5><img src="/bp-include/cdgbra.php?codetype=Code39&text='.$qlector['PIN'].'"/></div>
            </div></section>';
        }
    } else {
        echo "<section class='bp-section'><div class='row'><div class='bp-card card-body' style='width: auto;' id=\"scanner-container\"></div><div class='bp-card card-body'><form name='loginform' id='loginform' method='post' action='logger.php'>
                    <p><strong><label>Usuario</strong><br /><input type='text' name='usuario' id='user_login' class='input' value='' /></label></p>
                    <p><strong><label>PIN</strong><br /><input type=\"button\" id=\"btn\" value=\"Escanear\" /><input type='password' name='contrasena' id='user_pass' class='input' value=''  /></label></p>
                    <p class='submit'><input class='btn btn-primary' type='submit' name='pwd_submit' id='pwd_submit' value='Iniciar sesi&oacute;n' /></p></form></div></div></section>";
        echo '
    
        <script src="/bp-include/quagga.js"></script>
    
        <script>
        
            var _scannerIsRunning = false;
        
            function startScanner() {
                Quagga.init({
                    inputStream: {
                        name: "Live",
                        type: "LiveStream",
                        target: document.querySelector(\'#scanner-container\'),
                        constraints: {
                            width: 480,
                            height: 320,
                            facingMode: "environment"
                        },
                    },
                    decoder: {
                        readers: [
                            "code_128_reader",
                            "ean_reader",
                            "ean_8_reader",
                            "code_39_reader",
                            "code_39_vin_reader",
                            "codabar_reader",
                            "upc_reader",
                            "upc_e_reader",
                            "i2of5_reader"
                        ],
                        debug: {
                            showCanvas: true,
                            showPatches: true,
                            showFoundPatches: true,
                            showSkeleton: true,
                            showLabels: true,
                            showPatchLabels: true,
                            showRemainingPatchLabels: true,
                            boxFromPatches: {
                                showTransformed: true,
                                showTransformedBox: true,
                                showBB: true
                            }
                        }
                    },
    
                }, function (err) {
                    if (err) {
                        console.log(err);
                        return
                    }
    
                    console.log("Initialization finished. Ready to start");
                    Quagga.start();
    
                    // Set flag to is running
                    _scannerIsRunning = true;
                });
    
                Quagga.onProcessed(function (result) {
                    var drawingCtx = Quagga.canvas.ctx.overlay,
                    drawingCanvas = Quagga.canvas.dom.overlay;
    
                    if (result) {
                        if (result.boxes) {
                            drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
                            result.boxes.filter(function (box) {
                                return box !== result.box;
                            }).forEach(function (box) {
                                Quagga.ImageDebug.drawPath(box, { x: 0, y: 1 }, drawingCtx, { color: "green", lineWidth: 2 });
                            });
                        }
    
                        if (result.box) {
                            Quagga.ImageDebug.drawPath(result.box, { x: 0, y: 1 }, drawingCtx, { color: "#00F", lineWidth: 2 });
                        }
    
                        if (result.codeResult && result.codeResult.code) {
                            Quagga.ImageDebug.drawPath(result.line, { x: \'x\', y: \'y\' }, drawingCtx, { color: \'red\', lineWidth: 3 });
                        }
                    }
                });
    
    
                Quagga.onDetected(function (result) {
                    console.log("Barcode detected and processed : [" + result.codeResult.code + "]", result);
                    document.getElementById(\'user_pass\').value=result.codeResult.code ; 
                    var audio = new Audio(\'/bp-include/barcode.wav\');
                    audio.play();
                });
            }
            
            
            
            // Start/stop scanner
            document.getElementById("btn").addEventListener("click", function () {
                if (_scannerIsRunning) {
                    Quagga.stop();
                } else {
                    startScanner();
                }
            }, false);
        </script>';
    }
    ?>
    <footer class="page-footer bg-primary">
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bibliopress</a>
        </div>
    </footer>
</body>

</html>