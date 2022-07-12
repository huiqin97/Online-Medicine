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
	
	$productType = "";
	$productType = $product_obj->getProductType();
	$productDetails = $product_obj->getFeatureProductDetails($productType);
 	
	$order_obj = new manageOrder();
	if(isset($_POST['addCart'])){
		$prod_id = strval($_POST['product_id']);
		$cust_id = strval($_SESSION['id']);

		$order_obj->addToCart($cust_id,$prod_id);
	}


    include('nav-bar/top_nav.html'); ?>
   <script src="js/product.js"></script>
 
   <div class="hero-wrap hero-bread" style="background-image: url('images/banner-3.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Products</span></p>
            <h1 class="mb-0 bread">Products</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center">
    			<div class="col-md-10 mb-5 text-center">

    				<ul class="product-category">
    					<li><a href="shop.php?type=" >All</a></li>
    					<li><a href="shop.php?type=health-monitor" >Health Monitors & Test</a></li>
    					<li><a href="shop.php?type=pills" >Medicines</a></li>
    					<li><a href="shop.php?type=first-aid" >First Aid Supplies</a></li>
    					<li><a href="shop.php?type=vitamins">Vitamins & Supplements</a></li>
						<li><a href="shop.php?type=covid">Covid-19</a></li>
    				</ul>
    			</div>
    		</div>
    		<div class="row">

					<!-- Render the cart here -->
				<?php foreach ($productDetails['productDetails'] as $product): ?>
					<div class="col-md-6 col-lg-3 ftco-animate" style="height: 420px;">
						<div class="product">
							<?php 
							echo '<a href="single-product.php?product_id='.$product['PRODUCT_ID'].'">
							<img class="img-fluid" src="data:image/jpeg;base64,'.base64_encode($product['PRODUCT_IMAGE']).'">
							</a>';
							?>
							<div class="text py-3 pb-4 px-3 text-center" >
								<h3 style="height: 63px;"><a href="#"><?=$product['PRODUCT_NAME']?></a></h3>
								<div class="d-flex">
									<div class="pricing">
										<p class="price">RM <?=$product['PRODUCT_PRICE']?></span></p>
									</div>
								</div>
								<div class="bottom-area d-flex px-3">
									<div class="m-auto d-flex">
										<form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?type=';?>" method="post">
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

    <?php   include('nav-bar/footer.html');?>
  
</html>