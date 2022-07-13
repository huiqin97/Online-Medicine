<!DOCTYPE html>
<html>

    <?php 
	require_once "backend/manageOrder.php";
    session_start();
 
	// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
	}
	$err_message="";
	

	$order_obj = new manageOrder();
	$resp = $order_obj->getAllOrderDetails();
	$cart_total = 0;
	$name = $addr = $phone =$email ="";
	
	if($resp){
		$totalSum = [];
		foreach($resp as $result){
			$sum = calculateTotal($result['PRODUCT_PRICE'],$result['PROD_AMT']);
			
			array_push($totalSum,$sum);
        }
		$cart_total =array_sum($totalSum);
	}

	function calculateTotal($unitPrice,$unit){
		$totalPrice = floatval($unitPrice)*floatval($unit);
		return $totalPrice;
	}
	
	if(isset($_POST['checkout'])){
		$name = $_POST["name"];
		$addr = $_POST["addr"];
		$phone = $_POST["phone"];
		$email = $_POST["email"];

		if(empty(trim($_POST["name"]))){
			$err_message="Please enter your name";
		}
	
		if(empty(trim($_POST["addr"])) && empty($err_message)){
			$err_message="Please enter the billing address";
		}
	
		if(empty(trim($_POST["phone"])) && empty($err_message)){
			$err_message="Please enter phone number";
		}
	
		if(empty(trim($_POST["email"])) && empty($err_message)){
			$err_message="Please enter email";
		}

		try{
			$cust_id = $_SESSION['id'];
			
			$order_obj->addPO($cart_total,$cust_id,$name,$addr,$phone,$email);
	
			$order_obj->updateCartStatus($cust_id);
			header("location: status.php");
		}catch(PDOException $error){
			
			echo 'Error While Checkout: ' . $error->getMessage();
		}
	}

    include('nav-bar/top_nav.php');  ?>

    <div class="hero-wrap hero-bread" style="background-image: url('images/banner-6.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Checkout</span></p>
            <h1 class="mb-0 bread">Checkout</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-7 ftco-animate">
		 	 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="billing-form">
					
							<h3 class="mb-4 billing-heading">Billing Details</h3>
	          	<div class="row align-items-end">
	          		<div class="col-md-12">
	                <div class="form-group">
	                	<label for="firstname">Name</label>
	                  <input type="text" class="form-control" placeholder="" name='name'>
	                </div>
	              </div>
                <div class="w-100"></div>
		            <div class="w-100"></div>
		            <div class="col-md-12">
		            	<div class="form-group">
	                	<label for="streetaddress">Billing Address</label>
	                  <input type="text" class="form-control" placeholder="" name='addr'>
	                </div>
		            </div>
		            <div class="w-100"></div>
		            <div class="col-md-6">
	                <div class="form-group">
	                	<label for="phone">Phone</label>
	                  <input type="text" class="form-control" placeholder="" name='phone'>
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                	<label for="emailaddress">Email Address</label>
	                  <input type="text" class="form-control" placeholder="" name='email'>
	                </div>
                </div>
                <div class="w-100">

				<?php if(!empty($err_message)): ?>
                 
				 <div class='alert alert-danger' role='alert'>
					 <?php echo $err_message ?> 
				 </div>
				 <?php endif; ?>

				</div>
	            </div>
	         
			  <!-- END -->
			  
					</div>
					<div class="col-xl-5">
	          <div class="row mt-5 pt-3">
	          	<div class="col-md-12 d-flex mb-5">
				  <div class="cart-total mb-3">
								<h3>Cart Totals</h3>
								<p class="d-flex">
									<span>Subtotal</span>
									<span>RM <?=$cart_total ?></span>
								</p>

								<p class="d-flex">
									<span>Delivery</span>
									<span>RM <?php 
									if($cart_total<100){
										echo '5';
									}else{
										echo '0';
									}
									?></span>
								</p>

								<hr>
								<p class="d-flex total-price">
									<span>Total</span>
									<span>RM <?php 
									if($cart_total<100){
										$sum = $cart_total +5;
										echo $sum;
									}else{
										echo $cart_total;
									}
									?></span>
								</p>
							</div>
	          	</div>
	          	<div class="col-md-12">
	          		<div class="cart-detail p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Payment Method</h3>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio" class="mr-2"> Direct Bank Tranfer</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio" class="mr-2"> Check Payment</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio" class="mr-2"> Paypal</label>
											</div>
										</div>
									</div>
									
										<input type="submit" value ="Place an order" name="checkout" class="btn btn-primary py-3 px-4">
										</form>
								</div>
	          	</div>
	          </div>
          </div> <!-- .col-md-8 -->
        </div>
      </div>
    </section> <!-- .section -->

		<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
      <div class="container py-4">
        <div class="row d-flex justify-content-center py-5">
          <div class="col-md-6">
          	<h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
          	<span>Get e-mail updates about our latest shops and special offers</span>
          </div>
          <div class="col-md-6 d-flex align-items-center">
            <form action="#" class="subscribe-form">
              <div class="form-group d-flex">
                <input type="text" class="form-control" placeholder="Enter email address">
                <input type="submit" value="Subscribe" class="submit px-3">
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <?php include('nav-bar/footer.html');?>
  
</html>