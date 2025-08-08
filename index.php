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
		<script src="lib/jquery-3.7.1.min.js"></script>
	</head>
	<body>
		<?php
			ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
			$dirPaginas = __DIR__."/pages";
			switch($_GET['accion']){
				case "agregarPlanta":
					include("$dirPaginas/agregarPlanta.php");
					break;
				case "agregarFotoPlanta":
					include("$dirPaginas/agregarFotoPlanta.php");
					break;
				default:
					include("$dirPaginas/default.php");
					break;
			}
		?>
		
	</body>
</html>