<?php

define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'onlinemedicine');
// define('DB_NAME', 'website');

    function connectDB() {

        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        return $conn;
    }

    function insertUser($sql){
        // Perform query
        $conn = connectDB();
        if($stmt = $conn->prepare($sql)){
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                echo "New user created successfully !";
                header("location: login.php");
            } else{
                echo "Errors: ".mysqli_error($conn);;
            }

            // Close statement
            $stmt->close();
        }
        $conn->close();
     }

     function addToCart($sql){
        $conn = connectDB();
        if($stmt = $conn->prepare($sql)){
            $stmt->execute();
            $stmt->close();
        }
        $conn->close();
     }

     function getUserInfo($sql, $param_username){
        $username_err='';
        $conn = connectDB();
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $username_err = "This username is already taken.";
                } 
            } else{
                $username_err = "Oops! Something went wrong. Please try again later.";
            }

            $stmt->close();
        }
       
        if(!empty($username_err)){
            $ret =  $username_err;
        }else{
            $ret = '';
        }

        $conn->close();
        return $ret;

    }

    function checkProduct($sql,$id){
        $conn = connectDB();

        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("i", $id);
        if($stmt->execute()){
            // store result
            $stmt->store_result();
        }
        $result = $stmt->get_result();

        $conn->close();
        return $result;
    }

    function getItemInfo($sql){
        $conn = connectDB();
        $result = $conn -> query($sql);
        $productDetails = $result->fetch_all();
        $conn->close();
        return $productDetails[0];
    }

    function getAllProductInfo($sql){
        $conn = connectDB();

        $result = $conn -> query($sql);
        $prod = [];
        $totalCount =0;

        if ($result->num_rows) {
            $totalCount = mysqli_num_rows($result);
            while($productDetails = $result->fetch_assoc()){
                array_push($prod,$productDetails);
            }
        } 
        $conn->close();
        $resp = [
            "totalCount" => $totalCount,
            "productDetails" => $prod
        ];
        return $resp;
    }

    function getFeatureProduct($sql,$category)
    {
        $conn = connectDB();
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
   
        $prod = [];
        $totalCount = 0;

        if ($result->num_rows > 0) {
            $totalCount = $result->num_rows;
        
            while($productDetails = $result->fetch_assoc()) {
                array_push($prod,$productDetails);
            }
        } else {
            echo "No results";
        }

        $conn->close();
        $resp = [
            "totalCount" => $totalCount,
            "productDetails" => $prod
        ];
        return $resp;
    }

    function getProductByID($sql,$id)
    {
        $conn = connectDB();
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result

        if ($result->num_rows > 0) {
            $productDetails = $result->fetch_assoc();
        
        } else {
            echo "No results";
        }

        $conn->close();

        return $productDetails;
    }

    function getCartTotal($sql){
        $conn = connectDB();
        $stmt = $conn->prepare($sql); 
        $stmt->execute();
        $result = $stmt->get_result();
        $total = $result->fetch_object()->itemCount;

        $conn->close();
        return $total;
    }

    function execStatement($sql){
        $conn = connectDB();
        if($stmt = $conn->prepare($sql)){
            $stmt->execute();
            $stmt->close();
        }
        $conn->close();
    }
   