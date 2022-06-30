<?php
// check the login, if success then only start the connnection
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $conn = mysqli_connect('localhost','root','','onlinemedicine') or die("connnection Failed: ".mysqli_connect_error());
        if(isset($_POST['name']) && isset($_POST['email'])){
            $name = $_POST['name'];
            $email = $_POST['email'];

            $sql = "INSERT INTO .....";
            $query = mysqli_query($conn,$sql);
        }
    }

    // $host = "localhost"; 
    // $username = "root"; 
    // $password = ""; 
    // $db= "onlinemedicine";

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
