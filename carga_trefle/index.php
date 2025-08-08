<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

set_time_limit(6000);

require( '../persistencia/conexionBD.php' );
require( '../persistencia/familia.php');
require( '../persistencia/genero.php');
require( '../persistencia/especie.php');
echo "<pre>";

$url = 'https://trefle.io/api/v1/species?token=DBksPAFsnSQoVJS7OUAGwN7v5-a0cH6OehCdP7bX-XE&page=';

$finDatos= false;
$ind=24468;
while( $datos = json_decode( file_get_contents( "{$url}$ind" ) ) ){
    foreach( $datos->data as $val){
        echo "IND = $ind; id = {$val->id}; scientific_name = {$val->scientific_name}; genus_id = {$val->genus_id}";
//        addFamilia($val->name, $val->id);
        addEspecie($val->scientific_name, $val->id, $val->genus_id);
//        echo "<img src='{$val->image_url}'/>";
        echo " <br>";
    }
    $ind++;
}