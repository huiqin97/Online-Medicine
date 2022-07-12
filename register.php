<?php
// Include config file
require_once "db_config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $address = $phone = $email = "";
$err_message = "";

// Processing form data when form is submitted $_SERVER["REQUEST_METHOD"] == "POST"
if(isset($_POST['register'])){

    // Validate username
    if(empty(trim($_POST["cust_name"]))){
        $err_message = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["cust_name"]))&& empty($err_message)){
        $err_message = "Username can only contain letters, numbers, and underscores.";
    } else{
      $username = trim($_POST["cust_name"]);
    }

    if(empty(trim($_POST["cust_email"])) && empty($err_message)){
      $err_message = "Please enter your email."; 
    }else{
       // Prepare a select statement
       $sql = "SELECT cust_id FROM customer WHERE cust_email = ?";
       $param_email = trim($_POST["cust_email"]);
       $ret = getUserInfo($sql,$param_email);

       if($ret != true){
         $err_message = $ret;
       }else{
         $email = trim($_POST["cust_email"]);
       }
    }
    
    // Validate password
    if(empty(trim($_POST["password"])) && empty($err_message)){
        $err_message = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6 && empty($err_message)){
        $err_message = "Password must have at least 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["retry_password"])) && empty($err_message)){
        $err_message = "Please confirm the password.";     
    } else{
        $confirm_password = trim($_POST["retry_password"]);
        if(empty($password_err) && ($password != $confirm_password) && empty($err_message)){
            $err_message = "Password did not match. Please try again";
        }
    }

  
    $phone = trim($_POST["cust_phone"]);
    $address = trim($_POST["cust_address"]);
    
    // Check input errors before inserting in database
    if(empty($err_message)){
      $password_hash=password_hash($password, PASSWORD_DEFAULT);
        // Prepare an insert statement
        $insert_query = "INSERT INTO customer (CUST_NAME, CUST_EMAIL,CUST_PHONE, BILL_ADDRESS,PASSWORD) 
                  VALUES ('$username','$email','$phone','$address','$password_hash')";
        insertUser($insert_query);
        header("location: http://localhost/Online-Medicine/login.php");
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/register.css">

</head>
<body>
    <section class="h-100 bg-dark">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col">
            <div class="card card-registration my-4">
              <div class="row g-0">
                <div class="col-xl-6 d-none d-xl-block">
                  <img src="images/register.jpg"
                    alt="Sample photo" class="img-fluid"
                    style="margin-top: 11rem;margin-left: 2rem;" />
                </div>
                <div class="col-xl-6">
                  <div class="card-body p-md-5 text-black" >
                    <h3 class="mb-5 text-uppercase">Register Now</h3>

                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">

                    <div class="form-outline mb-4">
                      <input type="text" name="cust_name" class="form-control form-control-lg"/>
                      <label class="form-label" for="form3Example8">Name</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="text" name="cust_email" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Example8">Email</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="text" name="cust_phone" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Example8">Phone</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="text" name="cust_address" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Example8">Billing Address</label>
                    </div>

                    <div class="form-outline mb-4">
                      <span class="invalid-feedback"><?php echo $password_err; ?></span>
                      <input type="password" name="password" class="form-control form-control-lg"/>
                      <label class="form-label" for="form3Example8">Password</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="password" name="retry_password" class="form-control form-control-lg"/>
                      <label class="form-label" for="form3Example8">Confirm Password</label>
                    </div>

                    <div class="d-flex justify-content-end pt-3">
                     <button type="button" class="btn btn-light btn-lg ms-2" onclick="window.location.href='login.php'">Cancel</button>
    
                     <input type="submit" class="btn btn-primary btn-lg ms-2" name="register" value="Register">
                    </div>
                </form>
                <?php if(!empty($err_message)): ?>
                 
                  <div class='alert alert-danger' role='alert'>
                      <?php echo $err_message ?> 
                  </div>
                  <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>