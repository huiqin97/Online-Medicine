<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'onlinemedicine');

    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
    // Check connection
    if($conn === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    // $connn = new mysqli($host, $username, $password, $db);

    // // Ensure if MySQLi connnection works
    // if ($conn->connnect_error) {
    // echo "Failed to connnect Database: " . $conn->connnect_error; 
    // exit;
    // }


    // $id = filter_var( $_POST['id'], FILTER_SANITIZE_NUMBER_INT);

    // $sql = "SELECT email, name FROM tbl_employee WHERE id =?"; // SQL with parameters
    // $stmt = $conn->prepare($sql); 
    // $stmt->bind_param("i", $id);
    // $stmt->execute();
    // $result = $stmt->get_result(); // get the mysqli result

    // print_r($result ); // Added For demonstration purpose 

    // $user = $result->fetch_assoc(); // fetch data  

    // print_r($user); 
