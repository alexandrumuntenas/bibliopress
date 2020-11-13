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
							<input id="element_3" name="element_3" class="element text large" type="text" maxlength="255" value="" />
						</div>
					</li>
					<li id="li_5">
						<label class="description" for="element_5">Nombre de la base de datos </label>
						<div>
							<input id="element_5" name="element_5" class="element text large" type="text" maxlength="255" value="" />
						</div>
					</li>
					<li class="section_break">
						<h3>
							<h3>Configuración del usuario administrativo (Luego podrás asignar a más usuarios)</h3>
						</h3>
						<p></p>
					</li>
					<li id="li_7">
						<label class="description" for="element_7">Usuario (solo podrás establecerlo ahora, luego no se podrá cambiar) </label>
						<div>
							<input id="element_7" name="element_7" class="element text large" type="text" maxlength="255" value="" />
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
						<label class="description" for="element_10">PIN </label>
						<div>
							<input id="element_10" name="element_10" class="element text large" type="text" maxlength="255" value="" />
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
							<input id="element_13" name="element_13" class="element text large" type="text" maxlength="255" value="" />
						</div>
					</li>

					<li class="buttons">
						<input type="hidden" name="form_id" value="4248" />

						<input id="saveForm" class="button_text" type="submit" name="submit" value="Instalar" />
					</li>
				</ul>
			</form>
			<div id="footer">
			</div>
		</div>
		<img id="bottom" src="bottom.png" alt="">
	</body>

	</html>
<?php } ?>