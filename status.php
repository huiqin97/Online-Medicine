<!DOCTYPE html>
<html>
    <?php
    session_start();
    require_once "backend/manageOrder.php";
	
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
    }

    $order_obj = new manageOrder();
	  $resp = $order_obj->checkPOStatus($_SESSION['id']);

    $line1 = 'Your Order Has Been Placed';
    $line2 = "Thank you for ordering with us, we'll contact you by email with your order details.";
    
    if($resp == 'COMPLETE'){
      $line1 = "You Don't Have Order In Process";
      $line2 = "Grab your daily needs now";
    }
    if ($resp == 'DELIVER'){
      $line1 = 'Your Order Is In Delivery';
      $line2 = "Thank you for ordering with us, please check with the courier to get the delivery details ";
    }

    include('nav-bar/top_nav.php');
    ?>
    <section class="ftco-section">

    <div class="container">
				<div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
          	<span class="subheading">Order Status</span>
            <h2 class="mb-4"><?php echo $line1;?></h2>
            <p><?php echo $line2;?></p>
          </div>
        </div>   		
    	</div>
    </section>


    <?php   include('nav-bar/footer.html');?>

</html>