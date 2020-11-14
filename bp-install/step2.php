<?php if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/bp-settings.php")) {
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Nueva instalación de Bibliopress 1.0</title>
        <link rel="icon" type="image/png" href="bibliopress.png">
        <link rel="stylesheet" type="text/css" href="view.css" media="all">
        <script type="text/javascript" src="view.js"></script>

    </head>

    <body id="main_body">

        <img id="top" src="top.png" alt="">
        <div id="form_container">

            <h1><a><strong>Nueva instalación de Bibliopress 1.0</strong></a></h1>
            <form id="form_4248" class="appnitro" method="post" action="step2.php">
                <div class="form_description">
                    <h2><strong>Parece que Bibliopress ya está instalado...</h2>
                    <p>Parece que ya has instalado Bibliopress. Para volver a instalarlo, por favor, primero vacía las tablas de tu base de datos antigua y elimina el archivo bp-settings.php de tu servidor</p>
                    <a href="/" class="footer button_text">Volver al inicio</a>
                    <div id="footer">

                    </div>
                </div>
    </body>

    </html>
<?php
} else { ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Nueva instalación de Bibliopress 1.0</title>
        <link rel="icon" type="image/png" href="bibliopress.png">
        <link rel="stylesheet" type="text/css" href="view.css" media="all">
        <script type="text/javascript" src="view.js"></script>

    </head>

    <body id="main_body">

        <img id="top" src="top.png" alt="">
        <div id="form_container">

            <h1><a><strong>Nueva instalación de Bibliopress 1.0</strong></a></h1>
            <form id="form_4248" class="appnitro" method="post" action="step2.php">
                <div class="form_description">
                    <h2><strong>Nueva instalación de Bibliopress 1.0</h2>
                    <p>Una nueva aplicación web para la gestión de bibliotecas escolares! Una alternativa nueva e intuitiva a Abies, Abies Web, Biblioweb, ebiblio...</p>
                </div>
                <?php
                $servername = $_POST['element_1'];
                $username = $_POST['element_2'];
                $password = $_POST['element_3'];
                $dbname = $_POST['element_5'];

                $conn = mysqli_connect($servername, $username, $password, $dbname);

                $usuario = mysqli_real_escape_string($conn, $_POST["element_7"]);
                $nombre = mysqli_real_escape_string($conn, $_POST["element_8"]);
                $apellidos = mysqli_real_escape_string($conn, $_POST["element_9"]);
                $pin = mysqli_real_escape_string($conn, $_POST["element_10"]);
                $fullname = "$nombre $apellidos";
                $sitelinkfrompost = mysqli_real_escape_string($conn, $_POST['element_13']);
                $cname = mysqli_real_escape_string($conn, $_POST["element_12"]);
                echo '<p>Conexión a la BBDD: ';
                if (!$conn) {
                    die("<span style='color:red'>Error! Conexión fallida: " . mysqli_connect_error());
                } else {
                    echo "<span style='color:green'>OK!";
                };

                $bpusuario = "CREATE TABLE `bp_usuarios` (
                    `USUARIO` tinytext NOT NULL,
                    `FULLNAME` longtext NOT NULL,
                    `NOMBRE` text CHARACTER SET utf8mb4 NOT NULL,
                    `APELLIDOS` mediumtext CHARACTER SET utf8mb4 NOT NULL,
                    `CLASE` text CHARACTER SET utf8mb4 NOT NULL,
                    `PIN` int(11) NOT NULL,
                    `PERM` int(1) NOT NULL,
                    PRIMARY KEY (`USUARIO`(64))
                   ) ENGINE=InnoDB DEFAULT CHARSET=utf8";


                $bpcatalogo = "CREATE TABLE `bp_catalogo` (
                    `ANOPUB` varchar(8) DEFAULT NULL,
                    `AUTOR` varchar(30) DEFAULT NULL,
                    `EJEMPLAR` varchar(8) NOT NULL,
                    `EDITORIAL` varchar(50) DEFAULT NULL,
                    `SIGNATURA` varchar(18) DEFAULT NULL,
                    `TIPOEJEMPLAR` varchar(12) DEFAULT NULL,
                    `TITULO` varchar(80) DEFAULT NULL,
                    `UBICACION` varchar(12) DEFAULT NULL,
                    `ISBN` varchar(18) DEFAULT NULL,
                    `CIUDAD` varchar(18) DEFAULT NULL,
                    `ID` int(11) NOT NULL AUTO_INCREMENT,
                    `FECHA` date DEFAULT NULL,
                    `DESCRIPCION` longtext NOT NULL,
                    `DISPONIBILIDAD` int(11) NOT NULL DEFAULT 1,
                    `PRESTADOA` varchar(25) NOT NULL,
                    `FECHADEV` date DEFAULT NULL,
                    PRIMARY KEY (`ID`),
                    UNIQUE KEY `EJEMPLAR` (`EJEMPLAR`)
                   ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4";

                $bpsesiones = "CREATE TABLE `bp_sesiones` (
                    `PHPSESSID` text NOT NULL,
                    `USUARIO` text NOT NULL,
                    `LOGGEDIN` text NOT NULL,
                    `PERM` int(11) NOT NULL,
                    UNIQUE KEY `PHPSESSID` (`PHPSESSID`) USING HASH
                   ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

                $bpgrupos = "CREATE TABLE `bp_grupo` (
                `ID` int(11) NOT NULL AUTO_INCREMENT,
                `NOMBRE` text NOT NULL,
                `USUARIOS` mediumtext NOT NULL,
                PRIMARY KEY (`ID`)
                ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8
                ";

                $bpadminuser = "INSERT INTO `bp_usuarios` (`USUARIO`,`FULLNAME`,`NOMBRE`,`APELLIDOS`,`CLASE`, `PIN`, `PERM`) VALUES ('$usuario','$fullname','$nombre','$apellidos','Administrativo', '$pin', '1')";

                echo '</span></p>';
                echo '<p>Creación de tabla "Usuarios": ';
                if (!mysqli_query($conn, $bpusuario)) {
                    echo ("<span style='color:red'>Error! Conexión fallida: " . mysqli_error($conn));
                } else {
                    echo ("<span style='color: green'>OK!");
                }

                echo '</span></p>';
                echo '<p>Creación de tabla "Catálogo": ';
                if (!mysqli_query($conn, $bpcatalogo)) {
                    echo ("<span style='color:red'>Error! Conexión fallida: " . mysqli_error($conn));
                } else {
                    echo ("<span style='color: green'>OK!</span>");
                }

                echo '</span></p>';
                echo '<p>Creación de tabla "Sesiones": ';
                if (!mysqli_query($conn, $bpsesiones)) {
                    echo ("<span style='color:red'>Error! Conexión fallida: " . mysqli_error($conn));
                } else {
                    echo ("<span style='color: green'>OK!</span>");
                }

                echo '</span></p>';
                echo '<p>Creación de tabla "Grupos": ';
                if (!mysqli_query($conn, $bpgrupos)) {
                    echo ("<span style='color:red'>Error! Conexión fallida: " . mysqli_error($conn));
                } else {
                    echo ("<span style='color: green'>OK!</span>");
                }
                
                echo '</span></p>';
                echo '<p>Creación de "Usuario Administrativo" ';
                if (!mysqli_query($conn, $bpadminuser)) {
                    echo ("<span style='color:red'>Error!" . mysqli_error($conn));
                } else {
                    echo ("<span style='color: green'>OK!</span>");
                }
                echo '</span></p>';
                echo '<p>Redireccionandote a la página principal en 5 segundos...</p><meta http-equiv="refresh" content="5;url=/" />
        ';
                $ficheroconfig = fopen($_SERVER['DOCUMENT_ROOT'] . "/bp-settings.php", "wb") or die("Unable to open file!");
                $txt = "<?php

        // Valores MYSQL
        \$serverMySQL = '$servername'; //Host de la base de datos
        \$dbMySQL = '$dbname'; //Nombre de la base de datos
        \$userMySQL = '$username'; //Usuario de la base de datos
        \$pwdMySQL = '$password'; //Contraseña del usuario de la base de datos
        
        // Otros parametros
        \$sname = '$cname'; //Nombre de la biblioteca/institución
        \$sitelink = '$sitelinkfrompost'; //Enlace del sitio web para cumplir con GDPR

        \$databaseconnection = mysqli_connect(\$serverMySQL,\$userMySQL,\$pwdMySQL,\$dbMySQL);
        
        //Parámetro Lista
        \$CantidadMostrar=9;
        ";
                fwrite($ficheroconfig, $txt);
                ?>
                <div id="footer">
                </div>
        </div>
        <img id="bottom" src="bottom.png" alt="">
    </body>

    </html>
<?php } ?>