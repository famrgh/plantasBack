<form method='post' enctype="multipart/form-data"  >
	<input 
		type="file"
        accept="image/*"
        capture="environment"
        name='imagen'/>
	<input type = 'submit'/>
</form>
	

<?php
	require( __DIR__.'/fotoHelper.php');
	$rutaDestino = saveImage();
?>
	<img src='<?=$rutaDestino?>' />