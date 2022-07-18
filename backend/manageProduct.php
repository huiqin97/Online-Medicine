<?php
require_once "db_config.php";

class manageProduct{
    function getProductType()
    {
        $link = $_SERVER['REQUEST_URI'];

        $url_components = parse_url($link);

        parse_str($url_components['query'], $params);
            
        return str_replace('/','',$params['type']);
    }

    function getProductID()
    {
        $link = $_SERVER['REQUEST_URI'];

        $url_components = parse_url($link);

        parse_str($url_components['query'], $params);
            
        return str_replace('/','',$params['product_id']);
    }

    function getLatestProduct()
    {
        $sql = "SELECT * FROM `product` WHERE PRODUCT_AVAILABILITY =1 ORDER BY PRODUCT_ID DESC LIMIT 8";
        $resp = getAllProductInfo($sql);
        return $resp;
    }

    function getFeatureProductDetails($product_cat ="")
    {
        if(empty($product_cat)){
            $sql = "SELECT * FROM `product` WHERE PRODUCT_AVAILABILITY =1 order by PRODUCT_ID";
            $resp =  getAllProductInfo($sql);
        }else{
            $sql = "SELECT * FROM `product`WHERE PRODUCT_AVAILABILITY =1 AND PRODUCT_CAT = ?";
            $resp =  getFeatureProduct($sql,$product_cat);
        }

        return $resp;
    }

    function getNonAvailableProductDetails($product_cat="")
    {
        if(empty($product_cat)){
            $sql = "SELECT * FROM `product` WHERE PRODUCT_AVAILABILITY =0 order by PRODUCT_ID";
            $resp =  getAllProductInfo($sql);
        }else{
            $sql = "SELECT * FROM `product`WHERE PRODUCT_AVAILABILITY =0 AND PRODUCT_CAT = ?";
            $resp =  getFeatureProduct($sql,$product_cat);
        }

        return $resp;
    }

    function getProductDetailsByID($id)
    {
        $sql = "SELECT * FROM PRODUCT WHERE PRODUCT_AVAILABILITY =1 AND  PRODUCT_ID = ? ";
        $resp =  getProductByID($sql,$id);

        return $resp;
    }
    function getRelatedProduct($category){
        $sql = "SELECT * FROM `product` WHERE PRODUCT_AVAILABILITY =1 AND  PRODUCT_CAT = ? limit 5";
        $resp =  getFeatureProduct($sql,$category);
        return $resp;
    }
}
    