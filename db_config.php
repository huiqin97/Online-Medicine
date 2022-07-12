<?php

define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'onlinemedicine');
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

            // Close statement
            $stmt->close();
        }
        $conn->close();
        
        if(empty($username_err)){
            return true;
        }else{
            return $username_err;
        }

    }

    function checkProduct($sql,$id){
        $conn = connectDB();

        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $conn->close();
        return $result;
    }

    function getAllProductInfo($sql){
        $conn = connectDB();

        $result = $conn -> query($sql);
        $prod = [];

        if ($result->num_rows > 0) {
            $totalCount = mysqli_num_rows($result);
            $productDetails = $result->fetch_assoc();
        
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

    function getFeatureProduct($sql,$category)
    {
        $conn = connectDB();
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
   
        $prod = [];

        if ($result->num_rows > 0) {
            $totalCount = $result->num_rows;
            $productDetails = $result->fetch_assoc();
        
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
   