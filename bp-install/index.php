<?php if (isset($_POST['install'])) { ?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Nueva instalación de Bibliopress 0.5</title>
		<link rel="icon" type="image/png" href="bibliopress.png">
		<link rel="stylesheet" type="text/css" href="view.css" media="all">
		<script type="text/javascript" src="view.js"></script>

	</head>

	<body id="main_body">

		<div id="form_container">

			<h1><a><strong>Nueva instalación de Bibliopress 0.5</strong></a></h1>
			<form id="form_4248" class="appnitro" method="post" action="step2.php">
				<div class="form_description">
					<h2><strong>Nueva instalación de Bibliopress 0.5</h2>
					<p>Una nueva aplicación web para la gestión de bibliotecas escolares! Una alternativa nueva e intuitiva a Abies, Abies Web, Biblioweb, ebiblio...</p>
				</div> <?php
						$servername = $_POST['element_1'];
						$username = $_POST['element_2'];
						$password = $_POST['element_3'];
						$dbname = $_POST['element_5'];

						$conn = mysqli_connect($servername, $username, $password, $dbname);

						$usuario = mysqli_real_escape_string($conn, $_POST["element_7"]);
						$nombre = mysqli_real_escape_string($conn, $_POST["element_8"]);
						$apellidos = mysqli_real_escape_string($conn, $_POST["element_9"]);
						$PASSWD = mysqli_real_escape_string($conn, password_hash($_POST['element_10'], PASSWORD_BCRYPT));
						$fullname = "$nombre $apellidos";
						$sitelinkfrompost = mysqli_real_escape_string($conn, $_POST['element_13']);
						$cname = mysqli_real_escape_string($conn, $_POST["element_12"]);
						$prefixtable = mysqli_real_escape_string($conn, $_POST["element_14"]);
						$ficheroconfig = fopen($_SERVER['DOCUMENT_ROOT'] . "/bp-settings.php", "w") or die("Unable to open file!");
						$txt = "<?php

						// Valores MYSQL
						\$serverMySQL = '$servername'; //Host de la base de datos
						\$dbMySQL = '$dbname'; //Nombre de la base de datos
						\$userMySQL = '$username'; //Usuario de la base de datos
						\$pwdMySQL = '$password'; //Contraseña del usuario de la base de datos
						\$prefix = '$prefixtable'; //Prefijo de tablas. No cambiar

						// Otros parametros
						\$sname = '$cname'; //Nombre de la biblioteca/institución
						\$sitelink = '$sitelinkfrompost'; //Enlace del sitio web para cumplir con GDPR

						\$databaseconnection = mysqli_connect(\$serverMySQL,\$userMySQL,\$pwdMySQL,\$dbMySQL);
						
						//Parámetro Lista
						\$CantidadMostrar=9;
						";
						fwrite($ficheroconfig, $txt);
						echo '<p>Conexión a la BBDD: ';
						if (!$conn) {
							die("<span style='color:red'>Error! Conexión fallida: " . mysqli_connect_error());
						} else {
							echo "<span style='color:green'>OK!";
						};

						$cname = mysqli_real_escape_string($conn, $_POST["element_12"]);
						$bpusuario = "CREATE TABLE `" . $prefixtable . "_usuarios` (
						`ID` int(11) NOT NULL AUTO_INCREMENT,
						`USUARIO` tinytext NOT NULL,
						`FULLNAME` longtext NOT NULL,
						`NOMBRE` text CHARACTER SET utf8mb4 NOT NULL,
						`APELLIDOS` mediumtext CHARACTER SET utf8mb4 NOT NULL,
						`CLASE` text CHARACTER SET utf8mb4 NOT NULL,
						`PASSWD` varchar(128) NOT NULL,
						`PERM` int(1) NOT NULL,
						`AVATAR` varchar(1024) NOT NULL DEFAULT '',
						`THEME` int(11) NOT NULL DEFAULT 0,
						PRIMARY KEY (`ID`)
						) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8";


						$bpcatalogo = "CREATE TABLE `" . $prefixtable . "_catalogo` (
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
						`DESCRIPCION` longtext DEFAULT NULL,
						`DISPONIBILIDAD` int(11) NOT NULL DEFAULT 1,
						`PRESTADOA` varchar(25) DEFAULT NULL,
						`FECHADEV` date DEFAULT NULL,
						`PORTADA` varchar(256) NOT NULL DEFAULT '/bp-include/portada.jpg',
						PRIMARY KEY (`ID`),
						UNIQUE KEY `EJEMPLAR` (`EJEMPLAR`)
						) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4";

						$bpsesiones = "CREATE TABLE `" . $prefixtable . "_sesiones` (
						`PHPSESSID` text DEFAULT NULL,
						`IP` varchar(256) NOT NULL,
						`USER_AGENT` longtext NOT NULL,
						`USUARIO` text NOT NULL,
						`LOGGEDIN` int(11) NOT NULL,
						`PERM` int(11) NOT NULL,
						UNIQUE KEY `PHPSESSID` (`PHPSESSID`(256))
						) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

						$bpgrupos = "CREATE TABLE `" . $prefixtable . "_grupo` (
						`ID` int(11) NOT NULL AUTO_INCREMENT,
						`NOMBRE` text NOT NULL,
						PRIMARY KEY (`ID`)
						) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8";

						$bpcomentarios = "CREATE TABLE IF NOT EXISTS `" . $prefixtable . "_comentarios` (
						`id` int(11) NOT NULL AUTO_INCREMENT,
						`idlibro` int(11) NOT NULL,
						`idpadre` int(11) NOT NULL DEFAULT '-1',
						`usuario` varchar(255) NOT NULL,
						`contenido` text NOT NULL,
						`fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
						PRIMARY KEY (`id`)
						) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";

						$bpsolicitudes = "CREATE TABLE `" . $prefixtable . "_solicitudes` (
						`ID` int(11) NOT NULL AUTO_INCREMENT,
						`ISBN` text NOT NULL,
						`TITULO` text NOT NULL,
						`AUTOR` text NOT NULL,
						`EDITORIAL` text NOT NULL,
						PRIMARY KEY (`ID`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

						$avatar = "https://i2.wp.com/ui-avatars.com/api/" . $nombre . "/128?ssl=1";
						$bpadminuser = "INSERT INTO `" . $prefixtable . "_usuarios` (`USUARIO`,`FULLNAME`,`NOMBRE`,`APELLIDOS`,`CLASE`, `PASSWD`, `PERM`, `AVATAR`) VALUES ('$usuario','$fullname','$nombre','$apellidos','Administrativo', '$PASSWD', '1', '$avatar')";

						$bpadmingroup = "INSERT INTO `" . $prefixtable . "_grupo` (`NOMBRE`) VALUES ('Administrativo')";

						$bpcovidevent = "CREATE DEFINER=`$username`@`%` EVENT `Confinamiento` ON SCHEDULE EVERY 1 DAY STARTS NOW() ON COMPLETION PRESERVE ENABLE DO BEGIN
						SELECT * FROM `" . $prefixtable . "_catalogo` WHERE DISPONIBILIDAD = 2 AND FECHADEV = CURRENT_DATE AND `ENBIBLIO` = 1;
						UPDATE `" . $prefixtable . "_catalogo` SET DISPONIBILIDAD = 1, PRESTADOA = NULL, FECHADEV = NULL;
						END";

						$bpdevolevent = "CREATE DEFINER=`$username`@`%` EVENT `Devolucion` ON SCHEDULE EVERY 1 DAY STARTS NOW() ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
						SELECT * FROM `" . $prefixtable . "_catalogo` WHERE DISPONIBILIDAD = 0 AND FECHADEV = CURRENT_DATE;
						UPDATE `" . $prefixtable . "_catalogo` SET DISPONIBILIDAD = 3;
						END";

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
						echo '<p>Creación de tabla "Comentarios": ';
						if (!mysqli_query($conn, $bpcomentarios)) {
							echo ("<span style='color:red'>Error! Conexión fallida: " . mysqli_error($conn));
						} else {
							echo ("<span style='color: green'>OK!</span>");
						}
						echo '</span></p>';
						echo '<p>Creación de tabla "Solicitudes": ';
						if (!mysqli_query($conn, $bpsolicitudes)) {
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
						echo '<p>Creación de "Grupo Administrativo" ';
						if (!mysqli_query($conn, $bpadmingroup)) {
							echo ("<span style='color:red'>Error!" . mysqli_error($conn));
						} else {
							echo ("<span style='color: green'>OK!</span>");
						}
						echo '</span></p>';
						echo '<p>Creación de Evento "Covid19" ';
						if (!mysqli_query($conn, $bpcovidevent)) {
							echo ("<span style='color:red'>Error!" . mysqli_error($conn));
						} else {
							echo ("<span style='color: green'>OK!</span>");
						}

						echo '</span></p>';
						echo '<p>Creación de Evento "Devolución" ';
						if (!mysqli_query($conn, $bpdevolevent)) {
							echo ("<span style='color:red'>Error!" . mysqli_error($conn));
						} else {
							echo ("<span style='color: green'>OK!</span>");
						}

						echo '</span></p>';
						echo '<p>Redireccionandote a la página principal en 5 segundos...</p><meta http-equiv="refresh" content="5;url=/" />
        ';
						?>
				<div id="footer">
				</div>
		</div>
	</body> <?php exit();
		}
		if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/bp-settings.php")) {
			?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Nueva instalación de Bibliopress 0.5</title>
		<link rel="icon" type="image/png" href="bibliopress.png">
		<link rel="stylesheet" type="text/css" href="view.css" media="all">
		<script type="text/javascript" src="view.js"></script>

	</head>

	<body id="main_body">

		<div id="form_container">

			<h1><a><strong>Nueva instalación de Bibliopress 0.5</strong></a></h1>
			<form id="form_4248" class="appnitro" method="post" action="">
				<div class="form_description">
					<h2><strong>Parece que Bibliopress ya está instalado...</h2>
					<p>Parece que ya has instalado Bibliopress. Para volver a instalarlo, por favor, primero vacía las tablas de tu base de datos antigua y elimina el archivo bp-settings.php de tu servidor</p>
					<a href="/" class="footer button_text">Volver al inicio</a>
					<div id="footer">
					</div>
				</div>
	</body>

	</html>
<?php } else { ?>


	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Nueva instalación de Bibliopress 0.5</title>
		<link rel="icon" type="image/png" href="bibliopress.png">
		<link rel="stylesheet" type="text/css" href="view.css" media="all">
		<script type="text/javascript" src="view.js"></script>

	</head>

	<body id="main_body">

		<img id="top" src="top.png" alt="">
		<div id="form_container">

			<h1><a><strong>Nueva instalación de Bibliopress 0.5</strong></a></h1>
			<form id="form_4248" class="appnitro" method="post" action="">
				<div class="form_description">
					<h2><strong>Nueva instalación de Bibliopress 0.5</h2>
					<p>Una nueva aplicación web para la gestión de bibliotecas escolares! Una alternativa nueva e intuitiva a Abies, Abies Web, Biblioweb, ebiblio...</p>
				</div>
				<ul>

					<h3>
						<h3>Configuración de la Base de Datos</h3>
					</h3>
					<p></p>
					</li>
					<li id="li_1">
						<label class="description" for="element_1">Host de la base de datos </label>
						<div>
							<input id="element_1" name="element_1" class="element text large" type="text" maxlength="255" value="" />
						</div>
					</li>
					<li id="li_2">
						<label class="description" for="element_2">Usuario de la base de datos </label>
						<div>
							<input id="element_2" name="element_2" class="element text large" type="text" maxlength="255" value="" />
						</div>
					</li>
					<li id="li_3">
						<label class="description" for="element_3">Contraseña de la base de datos </label>
						<div>
							<input id="element_3" name="element_3" class="element text large" type="password" maxlength="255" value="" />
						</div>
					</li>
					<li id="li_5">
						<label class="description" for="element_5">Nombre de la base de datos </label>
						<div>
							<input id="element_5" name="element_5" class="element text large" type="text" maxlength="255" value="" />
						</div>
					</li>
					<li id="li_5">
						<label class="description" for="element_5">Prefijo de tabla</label>
						<div>
							<input id="element_5" name="element_14" class="element text large" type="text" maxlength="255" value="bp" />
						</div>
					</li>
					<li class="section_break">
						<h3>
							<h3>Configuración del usuario administrativo (Luego podrás asignar a más usuarios)</h3>
						</h3>
						<p></p>
					</li>
					<li id="li_7">
						<label class="description" for="element_7">Correo Electrónico (solo podrás establecerlo ahora, luego no se podrá cambiar) </label>
						<div>
							<input id="element_7" name="element_7" class="element text large" type="email" maxlength="255" value="" />
						</div>
					</li>
					<li id="li_8">
						<label class="description" for="element_8">Nombre </label>
						<div>
							<input id="element_8" name="element_8" class="element text large" type="text" maxlength="255" value="" />
						</div>
					</li>
					<li id="li_9">
						<label class="description" for="element_9">Apellidos </label>
						<div>
							<input id="element_9" name="element_9" class="element text large" type="text" maxlength="255" value="" />
						</div>
					</li>
					<li id="li_10">
						<label class="description" for="element_10">Contraseña </label>
						<div>
							<input id="element_10" name="element_10" class="element text large" type="password" maxlength="255" value="" />
						</div>
					</li>
					<li class="section_break">
						<h3>
							<h3>Configuración Web</h3>
						</h3>
						<p></p>
					</li>
					<li id="li_12">
						<label class="description" for="element_12">Nombre del Centro (Sin incluir 'Biblioteca del') </label>
						<div>
							<input id="element_12" name="element_12" class="element text large" type="text" maxlength="255" value="" />
						</div>
					</li>
					<li id="li_12">
						<label class="description" for="element_13">Enlace del Sitio Web</label>
						<div>
							<input id="element_13" name="element_13" class="element text large" type="text" maxlength="255" value="/" />
						</div>
					</li>

					<li class="buttons">
						<input type="hidden" name="form_id" value="4248" />

						<input id="saveForm" class="button_text" type="submit" name="install" value="Instalar" />
					</li>
				</ul>
			</form>
			<div id="footer">
			</div>
		</div>
	</body>
<?php
		} ?>