<?php

$mysqli = new mysqli('localhost','root','r00tb33r','inventory');

if($mysqli-> connect_errno){
    echo "Failed to connect to MySQL".$mysqli->connect_errno;
    exit();
}else{
    return $mysqli;
}

?>