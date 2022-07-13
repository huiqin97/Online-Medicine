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
	$productDetails = $product_obj->getLatestProduct();

	$order_obj = new manageOrder();
	if(isset($_POST['addCart'])){
		$prod_id = strval($_POST['product_id']);
		$cust_id = strval($_SESSION['id']);

		$order_obj->addToCart($cust_id,$prod_id);
	}

    include('nav-bar/top_nav.php'); ?>

<!-- UI here -->
    <section id="home-section" class="hero">
		  <div class="home-slider owl-carousel">
	      <div class="slider-item" style="background-image: url(images/banner-header-family.jpg);">
	      	<div class="overlay"></div>
	        <div class="container">
	          <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

	            <div class="col-md-12 ftco-animate text-center">
	              <h1 class="mb-2">For your daily health &amp; living</h1>
	              <h2 class="subheading mb-4">We deliver your needs</h2>
	              <p><a href="index.php#details" class="btn btn-primary">View Details</a></p>
	            </div>

	          </div>
	        </div>
	      </div>

	      <div class="slider-item" style="background-image: url(images/banner-header-pill.jpg);">
	      	<div class="overlay"></div>
	        <div class="container">
	          <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

	            <div class="col-sm-12 ftco-animate text-center">
	              <h1 class="mb-2">Helping you save more on medication</h1>
	              <h2 class="subheading mb-4">Get your medicine in fingertips </h2>
	              <p><a href="index.php#details" class="btn btn-primary">View Details</a></p>
	            </div>

	          </div>
	        </div>
	      </div>
	    </div>
    </section>

    <section class="ftco-section" id='details'>
			<div class="container">
				<div class="row no-gutters ftco-services">
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
            		<span class="flaticon-shipped"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Free Shipping</h3>
                <span>On order over RM100</span>
              </div>
            </div>      
          </div>
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
            		<span class="flaticon-box"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">100% Genuine</h3>
                <span>Product well package</span>
              </div>
            </div>    
          </div>
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
            		<span class="flaticon-award"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Superior Quality</h3>
                <span>Quality Products</span>
              </div>
            </div>      
          </div>
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
            		<span class="flaticon-customer-service"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Support</h3>
                <span>24/7 Support</span>
              </div>
            </div>      
          </div>
        </div>
			</div>
		</section>

		<section class="ftco-section ftco-category ftco-no-pt">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-6 order-md-last align-items-stretch d-flex">
								<div class="category-wrap-2 ftco-animate img align-self-stretch d-flex" style="background-image: url(images/appliances.jpeg);">
									<div class="text text-center">
										<h2>All Products</h2>
										<p>Protect the health of every home</p>
										<p><a href="shop.php?type=" class="btn btn-primary">Shop now</a></p>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url(images/medicine.jpg);">
									<div class="text px-3 py-1">
										<h2 class="mb-0"><a href="shop.php?type=pills">Medicines</a></h2>
									</div>
								</div>
								<div class="category-wrap ftco-animate img d-flex align-items-end" style="background-image: url(images/ointment.jpeg);">
									<div class="text px-3 py-1">
										<h2 class="mb-0"><a href="shop.php?type=first-aid">First Aid Supplies</a></h2>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url(images/vitamin-2.jpg);">
							<div class="text px-3 py-1">
								<h2 class="mb-0"><a href="shop.php?type=vitamins">Vitamins & Supplements</a></h2>
							</div>		
						</div>
						<div class="category-wrap ftco-animate img d-flex align-items-end" style="background-image: url(images/covid.jpg);">
							<div class="text px-3 py-1">
								<h2 class="mb-0"><a href="shop.php?type=covid">Covid-19 </a></h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

    <section class="ftco-section">
    	<div class="container">
				<div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
          	<span class="subheading">Latest Featured Products</span>
            <h2 class="mb-4">Our Products</h2>
            <p>Lowest price guaranteed</p>
          </div>
        </div>   		
    	</div>
    	<div class="container">
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
    					<div class="text py-3 pb-4 px-3 text-center">
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

   <?php include('nav-bar/footer.html');?>
    
  
  
</html>