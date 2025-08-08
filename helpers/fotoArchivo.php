<?php

const ALTO_ANCHO_MAXIMO = 1024;
const RUTA_DESTINO = 'fotos/';

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

include(__DIR__."/../persistencia/foto.php");

function getImage(){

	if( empty( $_FILES['imagen'] ) || empty( $_FILES['imagen']['tmp_name'] ) || $_FILES['imagen']['error']!=0){
		throw new Exception("No se cargó una imagen.", 1);	
	}

	$archivoTemporal = $_FILES['imagen']['tmp_name'];
	$tipoImagen = exif_imagetype($archivoTemporal);
	
	switch ($tipoImagen) {
		case IMAGETYPE_JPEG:
			$imagen = imagecreatefromjpeg($archivoTemporal);
			$imgExtension = 'jpg';
			$exif = exif_read_data($archivoTemporal);
			if (isset($exif['Orientation'])) {
				$imagen = setOrientacion($archivoTemporal, $imagen);
			}
		break;
		case IMAGETYPE_PNG:
			$imagen = imagecreatefrompng($archivoTemporal);
			$imgExtension = 'png';
		break;
		case IMAGETYPE_GIF:
			$imagen = imagecreatefromgif($archivoTemporal);
			$imgExtension = 'gif';
		break;
		default:
			die('Formato de imagen no soportado');
	}
	return ['image'=>$imagen, 'ext'=>$imgExtension];
}


function getRutaDestinoImagen($rutaDestino, $ext){
	return $nombre = "$rutaDestino".time().".".$ext;
}

function setOrientacion( $rutaImagenTmp, $imagen ){
	$exif = exif_read_data($rutaImagenTmp);
	if (isset($exif['Orientation'])) {
		$orientacion = $exif['Orientation'];
		// Corregir la orientación según el valor EXIF
		switch ($orientacion) {
			case 3:
				$imagen = imagerotate($imagen, 180, 0); // Rotar 180 grados
				break;
			case 6:
				$imagen = imagerotate($imagen, 270, 0); // Rotar 90 grados en sentido horario
				break;
			case 8:
				$imagen = imagerotate($imagen, 90, 0); // Rotar 90 grados en sentido antihorario
				break;
		}
	}
	return $imagen;
}

function redimensionarImagen( $imagen, $rutaDestino ){

	// Obtener las dimensiones originales de la imagen
	$anchoOriginal = imagesx($imagen);
	$altoOriginal = imagesy($imagen);

	$anchoAltoMaximoOriginal = $anchoOriginal < $altoOriginal ? $altoOriginal : $anchoOriginal;
	$coefReduccion = $anchoAltoMaximoOriginal / ALTO_ANCHO_MAXIMO;

	$anchoNuevo = (int) ($anchoOriginal/$coefReduccion);
	$altoNuevo = (int) ($altoOriginal/$coefReduccion);

	// Crear una nueva imagen vacía con las nuevas dimensiones
	$imagenRedimensionada = imagecreatetruecolor($anchoNuevo, $altoNuevo);

	// Redimensionar la imagen original a la nueva imagen
	imagecopyresampled($imagenRedimensionada, $imagen, 0, 0, 0, 0, $anchoNuevo, $altoNuevo, $anchoOriginal, $altoOriginal);

	// Guardar la imagen redimensionada en un archivo nuevo
	imagejpeg($imagenRedimensionada, $rutaDestino, 90); // 90 es la calidad

	// Liberar la memoria
	imagedestroy($imagen);
	imagedestroy($imagenRedimensionada);

	return $rutaDestino;
}

function saveImage($idPlanta){
	require( __DIR__."/../persistencia/planta.php" );

	['image'=>$imagen, 'ext'=>$ext] = getImage();

	$rutaDestino = getRutaDestinoImagen(RUTA_DESTINO, $ext);

	$imagenRedimensionada = redimensionarImagen( $imagen, $rutaDestino );

	persistirFoto($rutaDestino, 'desc', $idPlanta );

	return $rutaDestino;
}
