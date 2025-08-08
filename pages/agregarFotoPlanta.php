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
	// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
	/*
		require(__DIR__."/persistencia/foto.php");
		getFotos(2);
	*/

	if(!empty($_FILES)){
		require( __DIR__.'/helpers/fotoArchivo.php');
		echo "<div class='alert alert-warning' role='alert'>";
		$idPlanta = $_GET['idPlanta'] ?? null;
		$rutaDestino = saveImage(11);
		echo "</div>";
	}
?>
<img src='<?=$rutaDestino?>' />