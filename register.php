<?php
// Include config file
require_once "db_config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT cust_id FROM customer WHERE cust_name = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO customer (cust_name, password) VALUES (?, ?)";
         
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $mysqli->close();
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

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <!-- <div class="row">
                      <div class="col-md-6 mb-4">
                        <div class="form-outline">
                          <input type="text" id="form3Example1m" class="form-control form-control-lg" />
                          <label class="form-label" for="form3Example1m">First name</label>
                        </div>
                      </div>
                      <div class="col-md-6 mb-4">
                        <div class="form-outline">
                          <input type="text" id="form3Example1n" class="form-control form-control-lg" />
                          <label class="form-label" for="form3Example1n">Last name</label>
                        </div>
                      </div>
                    </div> -->

                    <div class="form-outline mb-4">
                      <input type="text" id="form3Example8" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Example8">Name</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="text" id="form3Example8" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Example8">Email</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="text" id="form3Example8" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Example8">Phone</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="text" id="form3Example8" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Example8">Billing Address</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="password" id="form3Example8" class="form-control form-control-lg"/>
                      <label class="form-label" for="form3Example8">Password</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="password" id="form3Example8" class="form-control form-control-lg"/>
                      <label class="form-label" for="form3Example8">Confirm Password</label>
                    </div>

                    <div class="d-flex justify-content-end pt-3">
                     <button type="button" class="btn btn-light btn-lg ms-2" onclick="window.location.href='login.php'">Cancel</button>
                      <button type="button" class="btn btn-warning btn-lg ms-2">Register</button>
                    </div>
                </form>
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