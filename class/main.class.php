<?php


class mainClass{


    function addItem($data,$mysqli){

        $isValid = true;

         $error = array();

        if($data['item_name'] == null || $data['item_name'] == ''){
            $isValid = false;
            $error[] = "Empty Item Name";
        }
        if ($data['item_quantity'] == null || $data['item_quantity'] == ''){
            $isValid = false;
            $error[] = "Empty Item Quantity";
        }

        if ($data['item_amount'] == null || $data['item_amount'] == ''){
            $isValid = false;
            $error[] = "Empty Item Amount";
        }

        $checkItemName = $this->checkItemName($data['item_name'],$mysqli);

        if($checkItemName){
            $isValid = false;
            $error[] = "Item Name already exist";
        }


        if($isValid){
            $flds = array();

            $flds[] ="item_name='".$data['item_name']."'";
            $flds[] ="item_quantity='".$data['item_quantity']."'";
            $flds[] ="item_amount='".$data['item_amount']."'";

            $fields=implode(", ",$flds);

            $sql = "INSERT into items set $fields";

            $result = mysqli_query($mysqli,$sql);

            if($result){
                $msg[] = "Success";
                die(json_encode($msg));
            }


        }else{
            die(json_encode($error));
        }


    }

    function editItem($data,$mysqli){

        $isValid = true;

        $error = array();

        if($data['item_name'] == null || $data['item_name'] == ''){
            $isValid = false;
            $error[] = "Empty Item Name";
        }
        if ($data['item_quantity'] == null || $data['item_quantity'] == ''){
            $isValid = false;
            $error[] = "Empty Item Quantity";
        }

        if ($data['item_amount'] == null || $data['item_amount'] == ''){
            $isValid = false;
            $error[] = "Empty Item Amount";
        }



        if($isValid){
            $flds = array();

            $flds[] ="item_name='".$data['item_name']."'";
            $flds[] ="item_quantity='".$data['item_quantity']."'";
            $flds[] ="item_amount='".$data['item_amount']."'";

            $fields=implode(", ",$flds);

            $sql = "UPDATE items set $fields where item_id='{$data['item_id']}'";
            $result = mysqli_query($mysqli,$sql);

            if($result){
                $msg[] = "Success";
                die(json_encode($msg));
            }


        }else{
            die(json_encode($error));
        }


    }


    function checkItemName($item_name,$mysqli){

        $same = true;

        $sql = "Select item_name from items where item_name='{$item_name}'";

        $result = mysqli_query($mysqli,$sql);

        if($result->num_rows >0){
            $same = true;
        }else{
            $same = false;
        }

        return $same;

    }

    function getItems($mysqli){

        $sql = "Select * from items";

        $result = mysqli_query($mysqli,$sql);

        $arr = array();
        while($rows = mysqli_fetch_assoc($result)){
            $arr[] = $rows;
        }

        die(json_encode($arr));

    }

    function getItemData($item_id,$mysqli){

        $sql = "Select * from items where item_id='{$item_id}'";


        $result = mysqli_query($mysqli,$sql);

        $rows = mysqli_fetch_assoc($result);


        die(json_encode($rows));

    }

    function deleteItem($id,$mysqli){

        $sql = "Delete from items where item_id='{$id}'";
        $result = mysqli_query($mysqli,$sql);

        $msg = array();
        $msg[] = "Success";

        die(json_encode($msg));

    }



}


?>

