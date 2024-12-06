<form method='post' enctype="multipart/form-data"  >
	<input 
		type="file"
        accept="image/*"
        capture="environment"
        name='imagen'/>
	<input type = 'submit'/>
</form>
	
<?php
	ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
	require(__DIR__."/persistencia/planta.php");
	print_r( addPlanta( 2, [1,2,3] ) );
?>

<?php
	require( __DIR__.'/helpers/fotoArchivo.php');
	$rutaDestino = saveImage();
?>
	<img src='<?=$rutaDestino?>' />