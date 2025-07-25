<?php
function pdoFetchAllToOption($fetch){
    $options = "";
    foreach($fetch as $row){
        $options .= "<option value={$row['id']}>{$row['nombre']}</option>";
    }
    echo json_encode( ['resultado'=>$options] );
}