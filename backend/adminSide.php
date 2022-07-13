<?php

require_once "db_config.php";

class admin{

    function getProcessPO(){
        $sql = "SELECT * FROM purchase_order where po_status='PROCESS'";
        $resp = getAllProductInfo($sql);
        return $resp['productDetails'];
    }

    function updatePoStatus($po_id){
        $sql="UPDATE PURCHASE_ORDER SET PO_STATUS = 'DELIVER' WHERE PO_ID =$po_id";
        try{
            execStatement($sql);
        }catch(PDOException $error){
            echo 'Error when updating PO status: ' . $error->getMessage();
        }
    }

    function sendEmail($receiver){
        $to      = $receiver;
        $subject = 'Your order is delivered';
        $message = 'Dear customer, your order is picked up by out partner courier. Kindly track the order using the link : ABCD6675544';
        $headers = 'From: onlineMec@email.com';
    
        mail($to, $subject, $message, $headers);
    }

    function getAllProduct(){
        $sql = "SELECT * FROM `product` order by PRODUCT_ID";
        $resp =  getAllProductInfo($sql);
        return $resp['productDetails'];
    }

}