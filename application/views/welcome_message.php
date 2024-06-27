<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Bienvenido al torneo de tenis</title>

	<link rel="stylesheet" type="text/css" href="../css/basic.css">

</head>
<body>

<div id="container">
	<h1>Bienvenido al torneo de tenis</h1>

	<div id="body">
		<p>Por favor seleccione el tipo de torneo que quiere generar:</p>
		<a href="http://localhost/torneo/home/torneo?tipo=m"><div class="button">Masculino</div></a>
		<a href="http://localhost/torneo/home/torneo?tipo=f"><div class="button">Femenino</div></a>

	</div>

	<p class="footer">Creado por Diego S. Omil para Geopagos</p>
</div>

</body>
</html>
