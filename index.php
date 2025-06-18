<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	</head>
	<body>
		<form class='form' method='post' enctype="multipart/form-data"  >
			<input 
				class='form-control'
				type="file"
				accept="image/*"
				capture="environment"
				name='imagen'/>
			<input class='form-control' type = 'submit' value='Enviar imagen'/>
		</form>

		<?php
			//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
			/*require(__DIR__."/persistencia/foto.php");
			getFotos(2);*/

			if(!empty($_FILES)){

				require( __DIR__.'/helpers/fotoArchivo.php');
				echo "<div class='alert alert-warning' role='alert'>";
				$rutaDestino = saveImage(1);
				echo "</div>";
			}
		?>
		<img src='<?=$rutaDestino?>' />
		
	</body>
</html>