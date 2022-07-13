<!DOCTYPE html>
<html>
    <?php
    session_start();
	
	// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
	}

    include('nav-bar/top_nav.php');
    ?>
    <section class="ftco-section">

    <div class="container">
				<div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
          	<span class="subheading">Order Status</span>
            <h2 class="mb-4">Your Order Has Been Placed</h2>
            <p>Thank you for ordering with us, we'll contact you by email with your order details.</p>
          </div>
        </div>   		
    	</div>
    </section>


    <?php   include('nav-bar/footer.html');?>

</html>