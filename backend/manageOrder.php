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

    function getNumOfCart($cust_id){
        $sql = "SELECT COUNT(*) AS itemCount FROM CART WHERE CART_STATUS = 'PENDING' and CUST_ID = $cust_id";
        try{
            $total = getCartTotal($sql);
        }catch(PDOException $error){
            echo 'Connection error: ' . $error->getMessage();
        }

        return $total;
    }

    function addItemWithAmt($quantity,$cust_id,$prod_id){
        $sql = "INSERT INTO CART (CUST_ID,PRODUCT_ID,PROD_AMT) VALUES ('$cust_id','$prod_id','$quantity')";
        try{
            addToCart($sql);
        }catch(PDOException $error){
            echo 'Connection error: ' . $error->getMessage();
        }
    }

    function getAllOrderDetails(){
        $sql = "SELECT product.PRODUCT_ID,product.PRODUCT_NAME,product.PRODUCT_PRICE,cart.PROD_AMT FROM cart JOIN product ON cart.PRODUCT_ID=product.PRODUCT_ID;";
        $resp = getAllProductInfo($sql);

        return $resp['productDetails'];
    }

}