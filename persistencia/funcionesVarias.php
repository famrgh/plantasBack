<?php
function pdoFetchAllToOption($fetch){
    $options = "";
    foreach($fetch as $row){
        $options .= "<option id={$row['id']}>{$row['nombre']}</option>";
    }
    return $options;
}