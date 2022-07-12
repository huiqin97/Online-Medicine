<?php

require_once "db_config.php";

class manageOrder{

    function addToCart($cust_id,$product_id){
        $sql = "INSERT INTO CART (CUST_ID,PRODUCT_ID) VALUES ('$cust_id','$product_id')";
        try{
            addToCart($sql);
        }catch(PDOException $error){
            echo 'Connection error: ' . $error->getMessage();
        }
    }

}