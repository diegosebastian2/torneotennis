<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Torneo de tenis</title>

	<link rel="stylesheet" type="text/css" href="../css/basic.css">
	<link rel="stylesheet" type="text/css" href="../css/torneo.css">
</head>
<body>

<div id="container">

<h1>Torneo de tenis</h1>
<div id="body">
<main id="tournament">

<?php

if(isset($error) && $error){
	echo("<p><span>".$error."</span></p>");
}else{?>
	<?php foreach($partidos as $k => $v){ 
			
			
			//echo("<div>Ronda ".$k."</div>");

		echo('<ul class="round round-'.$k.'">');

			foreach($v as $p){
				echo('<li class="spacer">&nbsp;</li>
		
						<li class="game game-top ');
						if($p['jugador_1']==$p['ganador']){ echo(' winner '); $ultimo_ganador = $p['nombre_1'].'('.$p['puntaje_1'].')'; }

						echo('">'.$p['nombre_1'].'('.$p['puntaje_1'].')</li>
						<li class="game game-spacer">&nbsp;</li>
						<li class="game game-bottom ');
						
						if($p['jugador_2']==$p['ganador']){ echo(' winner '); $ultimo_ganador = $p['nombre_2'].'('.$p['puntaje_2'].')'; }

						echo('">'.$p['nombre_2'].'('.$p['puntaje_2'].')</li>');
			}

		echo('<li class="spacer">&nbsp;</li>');
		
		echo('</ul>');


	} ?>

	<ul class="round round-<?=count($partidos)+1?>">
	<li class="spacer">&nbsp;</li>
	<li class="game game-top winner">Ganador/a: <?=$ultimo_ganador?></li>
	<li class="spacer">&nbsp;</li>
	</ul>
	<?php
} ?>

	
</main>
</body>
<p class="footer"><a href="http://localhost/torneo/home/index"><span class="button">Volver</span></a></p>
</div>

</body>
</html>
