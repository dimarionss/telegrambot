<?php
function vardump($_var){
    echo '<pre>';
    var_dump($_var);
    echo '</pre>';
}

function vardump_to_file($var){
    file_put_contents('vardump.txt',$var );
}