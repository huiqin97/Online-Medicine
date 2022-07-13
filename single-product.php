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

	$product_obj = new manageProduct();
	$productID = "";
	$productID = $product_obj->getProductID();
	$productDetails = $product_obj->getProductDetailsByID($productID);

	$relatedProduct =  $product_obj->getRelatedProduct($productDetails['PRODUCT_CAT']);


	$order_obj = new manageOrder();
	if(isset($_POST['addCart'])){
		$prod_id = strval($_POST['product_id']);
		$cust_id = strval($_SESSION['id']);

		$order_obj->addToCart($cust_id,$prod_id);
	}

	if(isset($_POST['addToCart'])){
		$quantity = strval($_POST['quantity']);
		$cust_id = strval($_SESSION['id']);
		// if($quantity> 1){
		// 	$sql = "UPDATE CART SET PROD_AMT = $quantity WHERE PRODUCT_ID = $productID AND CUST_ID = $cust_id";
		// }
		$order_obj->addItemWithAmt($quantity,$cust_id,$productID);
		
	}

    include('nav-bar/top_nav.php'); ?>

<div class="hero-wrap hero-bread" style="background-image: url('images/banner-header-pill.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span class="mr-2"><a href="shop.php">Product</a></span> <span>Product Details</span></p>
            <h1 class="mb-0 bread">Product Details</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-6 mb-5 ftco-animate">
				<?php 
					echo '<img class="img-fluid" src="data:image/jpeg;base64,'.base64_encode($productDetails['PRODUCT_IMAGE']).'">';
				?>
    			</div>
    			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
    				<h3><?=$productDetails['PRODUCT_NAME']?></h3>
    				<div class="rating d-flex">
							<p class="text-left mr-4">
								<a href="#" class="mr-2">5.0</a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
							</p>
							<p class="text-left mr-4">
								<a href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Rating</span></a>
							</p>
						
						</div>
    				<p class="price"><span>RM <?=$productDetails['PRODUCT_PRICE']?></span></p>
    				<p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until.
						</p>
						<div class="row mt-4">
							<div class="col-md-6">

							</div>
							<div class="w-100"></div>
							<div class="input-group col-md-6 d-flex mb-3">
	             	<span class="input-group-btn mr-2">
	            		</span>
					<form method="post">
	             	<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
	             	<span class="input-group-btn ml-2">
	             	</span>
	          	</div>
	          	<div class="w-100"></div>

          	</div>
          	<!-- <p><a href="" class="btn btn-black py-3 px-5">Add to Cart</a></p> -->
			  <input type="submit" value ="Add to Cart" name="addToCart" class="btn btn-black py-3 px-5">
    			</div>
    		</div>
    	</div>
		</form>
    </section>

    <section class="ftco-section">
    	<div class="container">
				<div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
          	<span class="subheading">Products</span>
            <h2 class="mb-4">Related Products</h2>
            <p>View More product here</p>
          </div>
        </div>   		
    	</div>
    	<div class="container">
    		<div class="row">
                <!-- loop here -->
    					<!-- Render the cart here -->
				<?php foreach ($relatedProduct['productDetails'] as $product): ?>
					<div class="col-md-6 col-lg-3 ftco-animate" style="height: 420px;">
						<div class="product">
							<?php 
							echo '<a href="single-product.php?product_id='.$product['PRODUCT_ID'].'">
							<img class="img-fluid" src="data:image/jpeg;base64,'.base64_encode($product['PRODUCT_IMAGE']).'">
							</a>';
							?>
							<div class="text py-3 pb-4 px-3 text-center">
								<h3 style="height: 63px;"><a href="#"><?=$product['PRODUCT_NAME']?></a></h3>
								<div class="d-flex">
									<div class="pricing">
										<p class="price">RM <?=$product['PRODUCT_PRICE']?></span></p>
									</div>
								</div>
								<div class="bottom-area d-flex px-3">
									<div class="m-auto d-flex">
									<form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?product_id='.$productID;?>" method="post">
										<div class="buy-now d-flex justify-content-center align-items-center mx-1">
										<input type="hidden" name="product_id" value="<?=$product['PRODUCT_ID']?>">
										<input type="submit" value ="Add" name="addCart" class="btn btn-black py-2 px-4">
									</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
    			
    		</div>
    	</div>
    </section>

    <?php   include('nav-bar/footer.html');?>
</html>


