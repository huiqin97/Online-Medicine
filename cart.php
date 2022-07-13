<!DOCTYPE html>
<html>

    <?php  
	require_once "backend/manageProduct.php";
	require_once "backend/manageOrder.php";
	session_start();
 
	// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
	}

	$order_obj = new manageOrder();
	$resp = $order_obj->getAllOrderDetails();
	$preprocess_resp = preprocessResp($resp);

	if($resp){
		$totalSum = [];
		foreach($resp as $result){
			$sum = calculateTotal($result['PRODUCT_PRICE'],$result['PROD_AMT']);
			
			array_push($totalSum,$sum);
        }
		$cart_total =array_sum($totalSum);
	}
	function preprocessResp($resp){
		$i =0;
		foreach($resp as $result){
			$sum = calculateTotal($result['PRODUCT_PRICE'],$result['PROD_AMT']);
			$resp[$i]['total'] =$sum;
			$i++;
        }
		return $resp;
	}
	function calculateTotal($unitPrice,$unit){
		$totalPrice = floatval($unitPrice)*floatval($unit);
		return $totalPrice;
	}

	include('nav-bar/top_nav.php'); ?>


	<div class="hero-wrap hero-bread" style="background-image: url('images/banner-5.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Cart</span></p>
            <h1 class="mb-0 bread">My Cart</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-cart">
			<div class="container">
				<div class="row d-flex mb-5">
    			<div class="col-md-8 ftco-animate">
    				<div class="cart-list">
	    				<table class="table">
						    <thead class="thead-primary">
						      <tr class="text-center">
						        <th>&nbsp;</th>
						        <th>Product name</th>
						        <th>Price</th>
						        <th>Quantity</th>
						        <th>Total</th>
						      </tr>
						    </thead>
						    <tbody>
							 <?php foreach ($preprocess_resp as $product): ?>
								<tr class="text-center">
								<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
									<td class="product-remove">
									<input type="hidden" name="product_id" value="<?=$product['PRODUCT_ID']?>">
										<input type="submit" value ="Remove" name="remove" class="btn btn-primary py-2 px-2">
									</td>

								</form>
						        
						        <td class="product-name">
						        	<h3><?=$product['PRODUCT_NAME']?></h3>
						        </td>
						        
						        <td class="price">RM <?=$product['PRODUCT_PRICE']?></td>
						        
						        <td class="quantity">
								<?=$product['PROD_AMT']?>
					          	</div>
					          </td>
							  
						        <td class="total"> RM <?=$product['total'] ?></td>
						        
							  <?php endforeach; ?> 
						    </tbody>
						  </table>
					  </div>
    			</div>
				<div class="col-md-4 ftco-animate">
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
							<p><a href="checkout.php" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>

				</div>
    		</div>
    		<div class="row justify-content-end">
    			
    		</div>
			</div>
		</section>

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

    <?php  include('nav-bar/footer.html'); ?>
    
  <script>
		$(document).ready(function(){

		var quantitiy=0;
		   $('.quantity-right-plus').click(function(e){
		        
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		            
		            $('#quantity').val(quantity + 1);

		          
		            // Increment
		        
		    });

		     $('.quantity-left-minus').click(function(e){
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		      
		            // Increment
		            if(quantity>0){
		            $('#quantity').val(quantity - 1);
		            }
		    });
		    
		});
	</script>
    
</html>