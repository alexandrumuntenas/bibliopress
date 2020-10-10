<?php
//Importación de datos
require '../bp-config.php';
?>
<html>
<?php require '../bp-include/head.html'; ?>

<body class="headerlogin">
    <header>
        <title>
            <?php echo 'Biblioteca del ' . $sname; ?>
        </title>
        <div class="wrapper">
            <?php require '../bp-include/menu.php'; ?>
            <?php if ($sessionlogged == 1) {
                echo '
            <div class="header">
                <h2 class="centered">Área Personal</h2>
            </div>';
            } else {
                echo '
                <div class="header">
                    <h2 class="centered">Iniciar Sesión</h2>
                </div>';
            }; ?>
    </header>
    <?php if ($sessionlogged == 1) {
        if ($sessionclass == 1) {
            echo '<section class="section flex-column"><center>
                    <div class="btn-group" role="group">
                    <a href="index.php" type="button" class="btn btn-primary">Inicio</a>
                    <div class="btn-group" role="group">
                        <a href="catalogo.php" class="btn btn-secondary">
                        Catálogo</a>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <button href="catalogo.php" class="dropdown-item">
                            Añadir nuevo registro</button>
                            <a href="functions/abies.php" class="dropdown-item">Subir desde Abies</a>
                        </div>
                    </div>
                    <a href="lectores.php" type="button" class="btn btn-secondary">Lectores</a>
                    </div>
                    </center></section>';
        } else {
            echo '<section class="section"><center>
                    <div class="btn-group" role="group">
                    <a href="index.php" type="button" class="btn btn-primary">Inicio</a>
                    <a href="listadedeseos.php" class="btn btn-secondary">Lista de deseos</a>
                    <a href="unlogger.php" type="button" class="btn btn-danger">Cerrar Sesión</a>
                    </div>
                    </center></section>';
        }
    } else {
        echo "<section class='section'><div class='viewer'><form name='loginform' id='loginform' method='post' action='logger.php'>
                    <p><strong><label>Usuario</strong><br /><input type='text' name='usuario' id='user_login' class='input' value='' /></label></p>
                    <p><strong><label>PIN</strong><br /><input type='password' name='contrasena' id='user_pass' class='input' value=''  /></label></p>
                    <p class='submit'><input class='btn btn-primary' type='submit' name='pwd_submit' id='pwd_submit' value='Iniciar sesi&oacute;n' /></p></form></div></section>";
    }
    ?>
    <footer class="page-footer bg-primary">
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bibliopress</a>
        </div>
    </footer>
</body>

</html>