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
        $sql = "SELECT product.PRODUCT_ID,product.PRODUCT_NAME,product.PRODUCT_PRICE,cart.PROD_AMT FROM cart JOIN product ON cart.PRODUCT_ID=product.PRODUCT_ID WHERE CART_STATUS='PENDING'";
        $resp = getAllProductInfo($sql);

        return $resp['productDetails'];
    }

    function removeOrder($product_id){
        $sql = "DELETE FROM CART WHERE PRODUCT_ID = $product_id";
        try{
            execStatement($sql);
        }catch(PDOException $error){
            echo 'Error while remove order: ' . $error->getMessage();
        }
    }

    function getProductInCart($custid){
        $sql = "SELECT CART_ID,PRODUCT_ID FROM CART WHERE CART_STATUS='PENDING' AND CUST_ID = $custid";
        $resp = getAllProductInfo($sql);
        return $resp['productDetails'];
    }

    function updateCartStatus($cust_id){
        $sql = "UPDATE CART SET CART_STATUS ='COMPLETE' WHERE CUST_ID = $cust_id";
        try{
            execStatement($sql);
        }catch(PDOException $error){
            echo 'Error While Updating Cart: ' . $error->getMessage();
        }
    }

    function addPO($total,$cust_id,$name,$addr,$phone,$email){
        $sql = "INSERT INTO PURCHASE_ORDER (PO_TOTAL,CUST_ID,PO_NAME,PO_ADDR,PO_PHONE,PO_EMAIL) VALUES ('$total','$cust_id','$name','$addr','$phone','$email')";
        try{
            execStatement($sql);
        }catch(PDOException $error){
            echo 'Error While Adding Purchase Order: ' . $error->getMessage();
        }
    }
    
    function checkPOStatus($cust_id)
    {
        $sql = "SELECT po_status FROM purchase_order where cust_id = $cust_id order by po_id desc";
        $resp = getItemInfo($sql);
        return $resp;
    }

}