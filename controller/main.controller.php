<?php

require_once('../class/main.class.php');
require_once('../class/connection.php');


$mainClass = new mainClass();


if(isset($_POST['add_item'])){

   $mainClass->addItem($_POST,$mysqli);

}

if(isset($_POST['update_item'])){
    $mainClass->editItem($_POST,$mysqli);
}

if(isset($_POST['delete_item'])){
    $mainClass->deleteItem($_POST['item_id'],$mysqli);
}

if(isset($_GET['getItem'])){
    $mainClass->getItems($mysqli);
}

if(isset($_GET['getItemData'])){
    $mainClass->getItemData($_GET['item_id'],$mysqli);
}



?>